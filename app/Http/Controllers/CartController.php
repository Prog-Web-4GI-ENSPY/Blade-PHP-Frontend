<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Tag(
 *     name="Cart",
 *     description="API Endpoints for Shopping Cart"
 * )
 */
class CartController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/cart",
     *     summary="Get user's cart",
     *     tags={"Cart"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="user_id", type="integer", nullable=true, example=1),
     *                 @OA\Property(property="session_id", type="string", example="abc123"),
     *                 @OA\Property(property="items_count", type="integer", example=3),
     *                 @OA\Property(property="total", type="number", format="float", example=99.99),
     *                 @OA\Property(
     *                     property="items",
     *                     type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="id", type="integer", example=1),
     *                         @OA\Property(property="quantity", type="integer", example=2),
     *                         @OA\Property(property="unit_price", type="number", format="float", example=29.99),
     *                         @OA\Property(property="total", type="number", format="float", example=59.98),
     *                         @OA\Property(
     *                             property="product_variant",
     *                             type="object",
     *                             @OA\Property(property="id", type="integer", example=1),
     *                             @OA\Property(property="price", type="number", format="float", example=29.99),
     *                             @OA\Property(property="stock", type="integer", example=10),
     *                             @OA\Property(
     *                                 property="product",
     *                                 type="object",
     *                                 @OA\Property(property="id", type="integer", example=1),
     *                                 @OA\Property(property="name", type="string", example="Product Name"),
     *                                 @OA\Property(property="slug", type="string", example="product-name")
     *                             )
     *                         )
     *                     )
     *                 )
     *             ),
     *             @OA\Property(property="message", type="string", example="Panier récupéré avec succès"),
     *             @OA\Property(property="code", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
    public function show()
    {
        try {
            $cart = $this->getOrCreateCart(request());
            $cart->load(['items.productVariant.product', 'items.productVariant.images']);
            
            return response()->json([
                'status' => 'success',
                'data' => $cart,
                'message' => 'Panier récupéré avec succès',
                'code' => 200
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur serveur: ' . $e->getMessage(),
                'code' => 500
            ], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/cart/add",
     *     summary="Add item to cart",
     *     tags={"Cart"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"product_variant_id", "quantity"},
     *             @OA\Property(property="product_variant_id", type="integer", example=1),
     *             @OA\Property(property="quantity", type="integer", example=2)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Item added to cart",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Article ajouté au panier"),
     *             @OA\Property(property="data", type="object"),
     *             @OA\Property(property="code", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Erreur de validation"),
     *             @OA\Property(property="errors", type="object"),
     *             @OA\Property(property="code", type="integer", example=422)
     *         )
     *     )
     * )
     */
    public function addItem(Request $request)
{
    try {
        // CORRECTION : valider sur product_variants
        $validated = $request->validate([
            'product_variant_id' => 'required|integer|exists:product_variants,id', // ✅
            'quantity' => 'required|integer|min:1'
        ]);
        
        // CORRECTION : chercher ProductVariant, pas Product
        $productVariant = \App\Models\ProductVariant::findOrFail($validated['product_variant_id']); // ✅
        
        // Vérifier le stock de la variante
        if ($productVariant->stock < $validated['quantity']) {
            return response()->json([
                'status' => 'error',
                'message' => 'Stock insuffisant. Disponible: ' . $productVariant->stock,
                'code' => 422
            ], 422);
        }
        
        DB::beginTransaction();
        
        $cart = $this->getOrCreateCart($request);
        
        $existingItem = $cart->items()
            ->where('product_variant_id', $validated['product_variant_id'])
            ->first();
        
        if ($existingItem) {
            $newQuantity = $existingItem->quantity + $validated['quantity'];
            
            if ($productVariant->stock < $newQuantity) {
                DB::rollBack();
                return response()->json([
                    'status' => 'error',
                    'message' => 'Stock insuffisant pour la quantité demandée',
                    'code' => 422
                ], 422);
            }
            
            $existingItem->update([
                'quantity' => $newQuantity
            ]);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_variant_id' => $validated['product_variant_id'],
                'quantity' => $validated['quantity'],
                'unit_price' => $productVariant->price
            ]);
        }
        
        $this->updateCartTotals($cart);
        DB::commit();
        
        $cart->load(['items.productVariant.product']); // ✅
        
        return response()->json([
            'status' => 'success',
            'message' => 'Article ajouté au panier',
            'data' => $cart,
            'code' => 200
        ], 200);
        
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Erreur de validation',
            'errors' => $e->errors(),
            'code' => 422
        ], 422);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'status' => 'error',
            'message' => 'Erreur serveur: ' . $e->getMessage(),
            'code' => 500
        ], 500);
    }
}


    /**
     * @OA\Put(
     *     path="/api/cart/items/{cartItem}",
     *     summary="Update cart item quantity",
     *     tags={"Cart"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="cartItem",
     *         in="path",
     *         required=true,
     *         description="Cart Item ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"quantity"},
     *             @OA\Property(property="quantity", type="integer", example=2)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Cart item updated",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Quantité mise à jour"),
     *             @OA\Property(property="data", type="object"),
     *             @OA\Property(property="code", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Cart item not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Article non trouvé dans votre panier"),
     *             @OA\Property(property="code", type="integer", example=404)
     *         )
     *     )
     * )
     */
    public function updateItem(Request $request, CartItem $cartItem)
{
    try {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);
        
        $cart = $this->getOrCreateCart($request);
        if ($cartItem->cart_id !== $cart->id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Article non trouvé dans votre panier',
                'code' => 404
            ], 404);
        }
        
        // CORRECTION : utiliser productVariant
        $productVariant = $cartItem->productVariant; // ✅
        if ($request->quantity > $productVariant->stock) {
            return response()->json([
                'status' => 'error',
                'message' => 'Stock insuffisant. Disponible: ' . $productVariant->stock,
                'code' => 422
            ], 422);
        }
        
        $cartItem->update([
            'quantity' => $request->quantity
        ]);
        
        $this->updateCartTotals($cart);
        $cart->load(['items.productVariant.product']); // ✅ Correction
        
        return response()->json([
            'status' => 'success',
            'message' => 'Quantité mise à jour',
            'data' => $cart,
            'code' => 200
        ], 200);
        
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Erreur serveur: ' . $e->getMessage(),
            'code' => 500
        ], 500);
    }
}

    /**
     * @OA\Delete(
     *     path="/api/cart/items/{cartItem}",
     *     summary="Remove item from cart",
     *     tags={"Cart"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="cartItem",
     *         in="path",
     *         required=true,
     *         description="Cart Item ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Item removed from cart",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Article retiré du panier"),
     *             @OA\Property(property="data", type="object"),
     *             @OA\Property(property="code", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Cart item not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Article non trouvé dans votre panier"),
     *             @OA\Property(property="code", type="integer", example=404)
     *         )
     *     )
     * )
     */
    
public function removeItem(Request $request, CartItem $cartItem)
{
    try {
        $cart = $this->getOrCreateCart($request);
        if ($cartItem->cart_id !== $cart->id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Article non trouvé dans votre panier',
                'code' => 404
            ], 404);
        }
        
        $cartItem->delete();
        $this->updateCartTotals($cart);
        $cart->load(['items.productVariant.product', 'items.productVariant.images']); // ✅ Correction
        
        return response()->json([
            'status' => 'success',
            'message' => 'Article retiré du panier',
            'data' => $cart,
            'code' => 200
        ], 200);
        
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Erreur serveur: ' . $e->getMessage(),
            'code' => 500
        ], 500);
    }
}
    /**
     * @OA\Delete(
     *     path="/api/cart/clear",
     *     summary="Clear the cart",
     *     tags={"Cart"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Cart cleared successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Panier vidé avec succès"),
     *             @OA\Property(property="data", type="object"),
     *             @OA\Property(property="code", type="integer", example=200)
     *         )
     *     )
     * )
     */
   public function clear(Request $request)
{
    try {
        $cart = $this->getOrCreateCart($request);
        $cart->items()->delete();
        $this->updateCartTotals($cart);
        
        $cart->load(['items.productVariant.product', 'items.productVariant.images']); // ✅ Correction
        
        return response()->json([
            'status' => 'success',
            'message' => 'Panier vidé avec succès',
            'data' => $cart,
            'code' => 200
        ], 200);
        
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Erreur serveur: ' . $e->getMessage(),
            'code' => 500
        ], 500);
    }
}

    /**
     * @OA\Post(
     *     path="/api/cart",
     *     summary="Create or get cart",
     *     tags={"Cart"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Cart retrieved or created",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data", type="object"),
     *             @OA\Property(property="message", type="string", example="Panier récupéré"),
     *             @OA\Property(property="code", type="integer", example=200)
     *         )
     *     )
     * )
     */
    
public function store(Request $request)
{
    try {
        $cart = $this->getOrCreateCart($request);
        $cart->load(['items.productVariant.product', 'items.productVariant.images']); // ✅ Correction
        
        return response()->json([
            'status' => 'success',
            'data' => $cart,
            'message' => 'Panier récupéré',
            'code' => 200
        ], 200);
        
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Erreur serveur: ' . $e->getMessage(),
            'code' => 500
        ], 500);
    }
}

    /**
     * @OA\Delete(
     *     path="/api/cart/user/{userId}/empty",
     *     summary="Empty user's cart (Admin only or self)",
     *     tags={"Cart"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="userId",
     *         in="path",
     *         required=true,
     *         description="User ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Cart emptied successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Panier vidé avec succès"),
     *             @OA\Property(property="code", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Non autorisé"),
     *             @OA\Property(property="code", type="integer", example=403)
     *         )
     *     )
     * )
     */
    public function emptyCart($userId)
    {
        try {
            // Vérifier les permissions
            $currentUser = auth()->user();
            if ($currentUser->id != $userId && !$currentUser->isAdmin()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Non autorisé',
                    'code' => 403
                ], 403);
            }
            
            $cart = Cart::where('user_id', $userId)->first();
            
            if ($cart) {
                $cart->items()->delete();
                $this->updateCartTotals($cart);
                
                return response()->json([
                    'status' => 'success',
                    'message' => 'Panier vidé avec succès',
                    'code' => 200
                ], 200);
            }
            
            return response()->json([
                'status' => 'success',
                'message' => 'Aucun panier trouvé pour cet utilisateur',
                'code' => 200
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur serveur: ' . $e->getMessage(),
                'code' => 500
            ], 500);
        }
    }

    /**
     * Get or create cart for current user/session
     */
    private function getOrCreateCart(Request $request)
    {
        if (auth()->check()) {
            return Cart::firstOrCreate(
                ['user_id' => auth()->id()],
                [
                    'session_id' => Str::random(32),
                    'items_count' => 0,
                    'total' => 0
                ]
            );
        }

        $sessionId = $request->header('X-Cart-Session') ?? $request->session()->get('cart_session_id');
        
        if (!$sessionId) {
            $sessionId = Str::random(32);
            $request->session()->put('cart_session_id', $sessionId);
        }

        return Cart::firstOrCreate(
            ['session_id' => $sessionId],
            [
                'user_id' => null,
                'items_count' => 0,
                'total' => 0
            ]
        );
    }

    /**
     * Update cart totals (items count and total price)
     */
   private function updateCartTotals(Cart $cart)
    {
        $items = $cart->items()->get();
        
        // Calculer le total en multipliant unit_price * quantity
        $total = $items->sum(function($item) {
            return ($item->unit_price ?? 0) * ($item->quantity ?? 0);
        });
        
        $cart->update([
            'items_count' => $items->sum('quantity'),
            'total' => $total
        ]);
    }
}