<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\ProductVariant;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Exceptions\ProductInsufficientException;
use Illuminate\Support\Facades\DB;

class CartItemController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/cartItems/cart/{cartId}",
     *     summary="Get all cart items for a specific cart",
     *     tags={"CartItem"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="cartId",
     *         in="path",
     *         required=true,
     *         description="Cart ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of cart items",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="cart_id", type="integer", example=5),
     *                     @OA\Property(property="product_variant_id", type="integer", example=10),
     *                     @OA\Property(property="quantity", type="integer", example=2),
     *                     @OA\Property(property="unit_price", type="number", format="float", example=29.99),
     *                     @OA\Property(property="total", type="number", format="float", example=59.98),
     *                     @OA\Property(property="created_at", type="string", format="date-time"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time"),
     *                     @OA\Property(
     *                         property="product_variant",
     *                         type="object",
     *                         @OA\Property(property="id", type="integer", example=10),
     *                         @OA\Property(property="price", type="number", format="float", example=29.99),
     *                         @OA\Property(property="stock", type="integer", example=50),
     *                         @OA\Property(
     *                             property="product",
     *                             type="object",
     *                             @OA\Property(property="id", type="integer", example=1),
     *                             @OA\Property(property="name", type="string", example="Product Name"),
     *                             @OA\Property(property="description", type="string", example="Product description")
     *                         )
     *                     )
     *                 )
     *             ),
     *             @OA\Property(property="message", type="string", example="Articles du panier récupérés"),
     *             @OA\Property(property="code", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized access",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Accès non autorisé à ce panier"),
     *             @OA\Property(property="code", type="integer", example=403)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Cart not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Panier non trouvé"),
     *             @OA\Property(property="code", type="integer", example=404)
     *         )
     *     )
     * )
     */
    public function getAllCartItems($cartId)
    {
        try {
            // Vérifier que l'utilisateur a accès à ce panier
            $cart = Cart::findOrFail($cartId);
            
            // Vérifier les permissions
            $this->checkCartPermission($cart);
            
            $cartItems = CartItem::where("cart_id", $cartId)
                ->with(['productVariant.product', 'productVariant.images'])
                ->get();
                
            return response()->json([
                'status' => 'success',
                'data' => $cartItems,
                'message' => 'Articles du panier récupérés',
                'code' => 200
            ], 200);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Panier non trouvé',
                'code' => 404
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur serveur: ' . $e->getMessage(),
                'code' => 500
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/cartItems/{cartItemId}",
     *     summary="Get a single cart item by ID",
     *     tags={"CartItem"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="cartItemId",
     *         in="path",
     *         description="ID of the cart item",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Cart item retrieved successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="cart_id", type="integer", example=5),
     *                 @OA\Property(property="product_variant_id", type="integer", example=10),
     *                 @OA\Property(property="quantity", type="integer", example=2),
     *                 @OA\Property(property="unit_price", type="number", format="float", example=29.99),
     *                 @OA\Property(property="total", type="number", format="float", example=59.98),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-11-13T12:00:00Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-11-13T12:05:00Z")
     *             ),
     *             @OA\Property(property="message", type="string", example="Article récupéré avec succès"),
     *             @OA\Property(property="code", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Accès non autorisé à cet article"),
     *             @OA\Property(property="code", type="integer", example=403)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Cart item not found"
     *     )
     * )
     */
    public function getCartItem($cartItemId)
    {
        try {
            $cartItem = CartItem::with(['productVariant.product', 'productVariant.images'])
                ->findOrFail($cartItemId);
            
            // Vérifier que l'utilisateur a accès à cet article
            $this->checkCartItemPermission($cartItem);
            
            return response()->json([
                'status' => 'success',
                'data' => $cartItem,
                'message' => 'Article récupéré avec succès',
                'code' => 200
            ], 200);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Article non trouvé',
                'code' => 404
            ], 404);
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
     *     path="/api/cartItems",
     *     summary="Add a new cart item",
     *     tags={"CartItem"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"quantity", "cart_id", "product_variant_id"},
     *             @OA\Property(property="quantity", type="integer", example=2),
     *             @OA\Property(property="cart_id", type="integer", example=5),
     *             @OA\Property(property="product_variant_id", type="integer", example=10)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Cart item created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data", type="object"),
     *             @OA\Property(property="message", type="string", example="Article ajouté au panier"),
     *             @OA\Property(property="code", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Accès non autorisé à ce panier"),
     *             @OA\Property(property="code", type="integer", example=403)
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error or insufficient stock",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="errors", type="object", nullable=true),
     *             @OA\Property(property="code", type="integer", example=422)
     *         )
     *     )
     * )
     */
    public function addCartItem(Request $request)
    {
        try {
            $data = $request->validate([
                "quantity" => "required|integer|min:1",
                "cart_id" => "required|integer|exists:carts,id",
                "product_variant_id" => "required|integer|exists:product_variants,id"
            ]);
            
            // Vérifier les permissions sur le panier
            $cart = Cart::findOrFail($data["cart_id"]);
            $this->checkCartPermission($cart);
            
            $productVariant = ProductVariant::findOrFail($data["product_variant_id"]);
            
            // Vérifier le stock
            if ($productVariant->stock < $data["quantity"]) {
                throw new ProductInsufficientException();
            }
            
            DB::beginTransaction();
            
            // Vérifier si l'article existe déjà dans le panier
            $existingItem = CartItem::where('cart_id', $data['cart_id'])
                ->where('product_variant_id', $data['product_variant_id'])
                ->first();
            
            if ($existingItem) {
                // Mettre à jour la quantité existante
                $newQuantity = $existingItem->quantity + $data["quantity"];
                
                if ($productVariant->stock < $newQuantity) {
                    DB::rollBack();
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Stock insuffisant pour la quantité totale',
                        'code' => 422
                    ], 422);
                }
                
                $existingItem->update([
                    'quantity' => $newQuantity,
                    'total' => $productVariant->price * $newQuantity
                ]);
                
                $cartItem = $existingItem;
            } else {
                // Créer un nouvel article
                $cartItem = CartItem::create([
                    "quantity" => $data['quantity'],
                    "cart_id" => $data["cart_id"],
                    "product_variant_id" => $data["product_variant_id"],
                    "unit_price" => $productVariant->price,
                    "total" => $productVariant->price * $data['quantity']
                ]);
            }
            
            // Mettre à jour les totaux du panier
            $this->updateCartTotals($cart);
            
            DB::commit();
            
            $cartItem->load(['productVariant.product', 'productVariant.images']);
            
            return response()->json([
                'status' => 'success',
                'data' => $cartItem,
                'message' => 'Article ajouté au panier',
                'code' => 200
            ], 200);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur de validation',
                'errors' => $e->errors(),
                'code' => 422
            ], 422);
        } catch (ProductInsufficientException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Stock insuffisant',
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
     *     path="/api/cartItems/{cartItemId}",
     *     summary="Update an existing cart item",
     *     tags={"CartItem"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="cartItemId",
     *         in="path",
     *         description="ID of the cart item to update",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"quantity", "cart_id", "product_variant_id"},
     *             @OA\Property(property="quantity", type="integer", example=3),
     *             @OA\Property(property="cart_id", type="integer", example=5),
     *             @OA\Property(property="product_variant_id", type="integer", example=10)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Cart item updated successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Article mis à jour avec succès"),
     *             @OA\Property(property="data", type="object"),
     *             @OA\Property(property="code", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Accès non autorisé à cet article"),
     *             @OA\Property(property="code", type="integer", example=403)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Cart item not found"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error or insufficient stock"
     *     )
     * )
     */
    public function updateCartItem(Request $request, $cartItemId)
    {
        try {
            $data = $request->validate([
                "quantity" => "required|integer|min:1",
                "cart_id" => "required|integer|exists:carts,id",
                "product_variant_id" => "required|integer|exists:product_variants,id"
            ]);
            
            $cartItem = CartItem::findOrFail($cartItemId);
            
            // Vérifier les permissions
            $this->checkCartItemPermission($cartItem);
            
            // Vérifier que l'article appartient bien au cart_id spécifié
            if ($cartItem->cart_id != $data["cart_id"]) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'L\'article n\'appartient pas à ce panier',
                    'code' => 422
                ], 422);
            }
            
            $productVariant = ProductVariant::findOrFail($data["product_variant_id"]);
            
            // Vérifier le stock
            if ($productVariant->stock < $data["quantity"]) {
                throw new ProductInsufficientException();
            }
            
            DB::beginTransaction();
            
            $cartItem->update([
                'quantity' => $data['quantity'],
                'product_variant_id' => $data['product_variant_id'],
                'unit_price' => $productVariant->price,
                'total' => $productVariant->price * $data['quantity']
            ]);
            
            // Mettre à jour les totaux du panier
            $cart = Cart::findOrFail($data["cart_id"]);
            $this->updateCartTotals($cart);
            
            DB::commit();
            
            $cartItem->load(['productVariant.product', 'productVariant.images']);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Article mis à jour avec succès',
                'data' => $cartItem,
                'code' => 200
            ], 200);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Article ou variante de produit non trouvé',
                'code' => 404
            ], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur de validation',
                'errors' => $e->errors(),
                'code' => 422
            ], 422);
        } catch (ProductInsufficientException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Stock insuffisant',
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
     * @OA\Delete(
     *     path="/api/cartItems/{cartItemId}",
     *     summary="Delete a cart item",
     *     tags={"CartItem"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="cartItemId",
     *         in="path",
     *         description="ID of the cart item to delete",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Cart item deleted successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Article supprimé du panier"),
     *             @OA\Property(property="code", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Accès non autorisé à cet article"),
     *             @OA\Property(property="code", type="integer", example=403)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Cart item not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Article non trouvé"),
     *             @OA\Property(property="code", type="integer", example=404)
     *         )
     *     )
     * )
     */
    public function deleteCartItem($cartItemId)
    {
        try {
            $cartItem = CartItem::findOrFail($cartItemId);
            
            // Vérifier les permissions
            $this->checkCartItemPermission($cartItem);
            
            DB::beginTransaction();
            
            $cart = $cartItem->cart;
            $cartItem->delete();
            
            // Mettre à jour les totaux du panier
            $this->updateCartTotals($cart);
            
            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Article supprimé du panier',
                'code' => 200
            ], 200);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Article non trouvé',
                'code' => 404
            ], 404);
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
     * Vérifier que l'utilisateur a accès à ce panier
     */
    private function checkCartPermission(Cart $cart)
    {
        $user = auth()->user();
        
        // Si le panier a un user_id, vérifier que c'est l'utilisateur connecté
        if ($cart->user_id && $cart->user_id !== $user->id) {
            // Vérifier si l'utilisateur est admin
            if (!$user->isAdmin()) {
                throw new \Exception('Accès non autorisé à ce panier');
            }
        }
        
        // Pour les paniers de session, vérifier la session ID
        if (!$cart->user_id) {
            $sessionId = request()->header('X-Cart-Session') ?? request()->session()->get('cart_session_id');
            if ($cart->session_id !== $sessionId) {
                throw new \Exception('Accès non autorisé à ce panier');
            }
        }
    }

    /**
     * Vérifier que l'utilisateur a accès à cet article de panier
     */
    private function checkCartItemPermission(CartItem $cartItem)
    {
        $cart = $cartItem->cart;
        $this->checkCartPermission($cart);
    }

    /**
     * Mettre à jour les totaux du panier
     */
    private function updateCartTotals(Cart $cart)
    {
        $cart->load('items');
        
        $cart->update([
            'items_count' => $cart->items->sum('quantity'),
            'total' => $cart->items->sum('total')
        ]);
    }
}