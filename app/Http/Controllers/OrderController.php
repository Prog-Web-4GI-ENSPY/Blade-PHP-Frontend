<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Cart;
use App\Http\Resources\OrderResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateOrderStatusRequest;

/**
 * @OA\Tag(
 *     name="Orders",
 *     description="API Endpoints for Orders"
 * )
 */
class OrderController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/orders",
     *     summary="Get user's orders",
     *     tags={"Orders"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Order")),
     *             @OA\Property(property="links", type="object"),
     *             @OA\Property(property="meta", type="object")
     *         )
     *     )
     * )
     */
    public function index()
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }
        try{
            $orders = Order::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

       if ($orders->isEmpty()){
                return response()->json([
                    'message' => 'No orders found for this user.',
                    'data' => [],
                    'total' => 0
                ], 200);
            }
            
            // Format de réponse minimal
            return response()->json([
                'message' => 'Orders retrieved successfully',
                'data' => OrderResource::collection($orders->items()),
                'total' => $orders->total(),
                'per_page' => $orders->perPage(),
                'current_page' => $orders->currentPage(),
            ], 200);

        }
        catch (\Exception $e){
            // Utilisez le message d'erreur pour le débogage, mais un message générique pour le client
            return response()->json([
                'message' => 'Erreur server while retrieving orders.',
                'error_detail' => $e->getMessage()
            ], 500);
        }
    }

   /**
     * @OA\Post(
     * path="/api/orders",
     * summary="Create a new order",
     * tags={"Orders"},
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"customer_name", "customer_email", "customer_phone", "shipping_address", "shipping_city", "shipping_zipcode", "shipping_country", "payment_method"},
     * @OA\Property(property="customer_name", type="string", example="John"),
     * @OA\Property(property="customer_email", type="string", format="email", example="john@example.com"),
     * @OA\Property(property="customer_phone", type="string", example="+1234567890"),
     * @OA\Property(property="shipping_address", type="string", example="123 Main St"),
     * @OA\Property(property="shipping_city", type="string", example="New York"),
     * @OA\Property(property="shipping_zipcode", type="string", example="10001"),
     * @OA\Property(property="shipping_country", type="string", example="USA"),
     * @OA\Property(property="billing_address", type="string", example="123 Main St"),
     * @OA\Property(property="billing_city", type="string", example="New York"),
     * @OA\Property(property="billing_zipcode", type="string", example="10001"),
     * @OA\Property(property="billing_country", type="string", example="USA"),
     * @OA\Property(property="payment_method", type="string", example="credit_card"),
     * @OA\Property(property="notes", type="string", example="Please deliver in the morning")
     * )
     * ),
     * @OA\Response(
     * response=201,
     * description="Order created successfully",
     * @OA\JsonContent(
     * @OA\Property(property="message", type="string"),
     * @OA\Property(property="order", ref="#/components/schemas/Order")
     * )
     * ),
     * @OA\Response(
     * response=422,
     * description="Validation error"
     * )
     * )
     */
    public function store(Request $request)
    {
       $cart = $this->getCurrentCart($request);
       $userId = auth()->id();

        if (!$cart || $cart->items_count === 0) {
            return response()->json([
                'message' => 'Your cart is empty or could not be found.'
            ], 422);
        }
        
        // --- 1. Validation de la Requête ---
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string',
            'shipping_city' => 'required|string',
            'shipping_zipcode' => 'required|string',
            'shipping_country' => 'required|string',
            'billing_address' => 'nullable|string',
            'billing_city' => 'nullable|string',
            'billing_zipcode' => 'nullable|string',
            'billing_country' => 'nullable|string',
            'payment_method' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        // --- Pré-chargement des relations pour éviter l'erreur "Attempt to read property 'stock' on null" ---
        // Si vous utilisez des variantes, utilisez 'productVariant'. Si vous n'utilisez pas de variantes, utilisez 'product'.
        $cart->load('items.productVariant', 'items.product');

        // --- 2. Vérification des stocks ---
        foreach ($cart->items as $item) {
            // Utilise la variante si elle est présente, sinon le produit principal (fallback)
            $stockSource = $item->productVariant ?? $item->product; 
            
            // Sécurité : Vérifie si le produit/variante a été supprimé
            if (!$stockSource) {
                return response()->json([
                    'message' => "An item in your cart is no longer available (ID: {$item->product_id} / Variant ID: {$item->product_variant_id}). Please refresh your cart."
                ], 422);
            }
            
            // Vérification du stock
            if ($item->quantity > $stockSource->stock) {
                return response()->json([
                    'message' => "Product {$stockSource->name} does not have enough stock. Available: {$stockSource->stock}, Requested: {$item->quantity}."
                ], 422);
            }
        }

        try {
            DB::beginTransaction();

           // Déterminer le statut initial
            $initialStatus = ($validated['payment_method'] === 'cash_on_delivery') ? 'PENDING' : 'PENDING_PAYMENT';

            // --- 3. Création de l'entête de commande ---
            $order = Order::create([
                'order_number' => 'ORD-' . date('Ymd') . '-' . Str::random(6),
                'status' => $initialStatus, // Statut initial
                'subtotal' => $cart->total,
                // TODO: Calculer la livraison et la taxe ici si elles ne sont pas nulles.
                'shipping' => 0.00, 
                'tax' => 0.00,
                'total' => $cart->total, // Total simple pour l'instant (subtotal + shipping + tax)
                'user_id' => $userId,
                // Informations Client
                'customer_email' => $validated['customer_email'],
                'customer_name' => $validated['customer_name'],
                'customer_phone' => $validated['customer_phone'],
                // Adresses
                'shipping_address' => $validated['shipping_address'],
                'shipping_city' => $validated['shipping_city'],
                'shipping_zipcode' => $validated['shipping_zipcode'],
                'shipping_country' => $validated['shipping_country'],
                'billing_address' => $validated['billing_address'] ?? $validated['shipping_address'],
                'billing_city' => $validated['billing_city'] ?? $validated['shipping_city'],
                'billing_zipcode' => $validated['billing_zipcode'] ?? $validated['shipping_zipcode'],
                'billing_country' => $validated['billing_country'] ?? $validated['shipping_country'],
                'payment_method' => $validated['payment_method'],
                'notes' => $validated['notes'] ?? null,
            ]);
           
           // --- 4. Transfert des articles et mise à jour des stocks ---
            foreach ($cart->items as $cartItem) {
                $stockSource = $cartItem->productVariant ?? $cartItem->product;
                
                // Création de l'article de commande
                $order->items()->create([
                    // Utiliser product_id (du produit parent) et potentiellement product_variant_id
                    'product_id' => $cartItem->product_id, 
                    'product_variant_id' => $cartItem->product_variant_id, // Ajouter la variante ID dans l'Order Item
                    'quantity' => $cartItem->quantity,
                    'unit_price' => $cartItem->unit_price,
                    'total' => $cartItem->total,
                    // Utiliser le nom et le SKU de la source de stock (variante ou produit)
                    'product_name' => $stockSource->name, 
                    'product_sku' => $stockSource->sku,
                ]);

                // Décrémentation du stock sur l'objet source (qui est garanti non null)
                $stockSource->decrement('stock', $cartItem->quantity);
            }
          
          // --- 5. Nettoyage du panier ---
            $cart->items()->delete();
            $this->updateCartTotals($cart); // Met à jour les totaux du panier à zéro

            DB::commit();

            // --- 6. Réponse Client (Minimaliste) ---
            // Le chargement doit correspondre à la structure utilisée (items.productVariant/items.product)
            $order->load(['items.productVariant', 'items.product', 'deliveryUser']); 

            return response()->json([
                'message' => 'Order created successfully. Status: ' . $initialStatus,
                'data' => new OrderResource($order)
            ], 201);

     } catch (\Exception $e) {
            DB::rollBack();
            
            // Vous pouvez renvoyer $e->getMessage() pour le débogage si l'erreur n'est pas critique (comme celle du stock)
            return response()->json([
                'message' => 'An error occurred during the checkout process.',
                'error_detail' => $e->getMessage()
            ], 500);
        }
    }
    /**
     * @OA\Put(
     * path="/api/orders/{order}/status",
     * summary="Update the status of a specific order (Management Only)",
     * tags={"Orders"},
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(
     * name="order",
     * in="path",
     * required=true,
     * @OA\Schema(type="integer"),
     * description="ID of the order to update"
     * ),
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * @OA\Property(property="status", type="string", description="New status for the order", enum={"PENDING", "PROCESSING", "PAID", "SHIPPED", "DELIVERED", "CANCELED", "FAILED", "IN_DELIVERY"})
     * )
     * ),
     * @OA\Response(
     * response=200,
     * description="Order status updated successfully",
     * @OA\JsonContent(
     * @OA\Property(property="message", type="string", example="Order status updated to SHIPPED"),
     * @OA\Property(property="data", ref="#/components/schemas/Order")
     * )
     * ),
     * @OA\Response(response=403, description="Forbidden - Only management roles can update status"),
     * @OA\Response(response=404, description="Order not found"),
     * @OA\Response(response=422, description="Validation error")
     * )
     */
    public function updateStatus(UpdateOrderStatusRequest $request, Order $order)
    {
        // La validation d'accès (authorize) et des données est faite par UpdateOrderStatusRequest

        try {
            DB::beginTransaction();

            $newStatus = $request->validated('status');
            $order->status = $newStatus;
            $order->save();

            // Logique supplémentaire selon le statut (ex: envoyer un email)
            // if ($newStatus === Order::STATUS_SHIPPED) { 
            //     // Envoi de notification au client
            // }

            DB::commit();

            return response()->json([
                'message' => "Order status updated to {$newStatus}",
                'data' => $order,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to update order status.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    /**
     * @OA\Get(
     *     path="/api/orders/{id}",
     *     summary="Get order details",
     *     tags={"Orders"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Order ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Order")
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Order not found"
     *     )
     * )
     */
    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $order->load('items.product');

        return new OrderResource($order);
    }

    private function getCurrentCart(Request $request)
    {
        if (auth()->check()) {
            return Cart::where('user_id', auth()->id())->first();
        }

        $sessionId = $request->header('X-Cart-Session') ?? $request->session()->get('cart_session_id');
        return Cart::where('session_id', $sessionId)->first();
    }

    private function updateCartTotals(Cart $cart)
    {
        $cart->load('items');
        
        $cart->update([
            'items_count' => $cart->items->sum('quantity'),
            'total' => $cart->items->sum('total')
        ]);
    }

    /**
     * @OA\Get(
     * path="/api/orders/my",
     * summary="Get list of orders for the authenticated user (Client Only)",
     * tags={"Orders"},
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="status", in="query", @OA\Schema(type="string"), description="Filter by order status"),
     * @OA\Response(
     * response=200,
     * description="User's orders retrieved successfully",
     * @OA\JsonContent(
     * @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/OrderResource")),
     * )
     * ),
     * @OA\Response(response=401, description="Unauthenticated"),
     * @OA\Response(response=404, description="No orders found")
     * )
     */
    public function myOrders(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        // Si l'utilisateur n'est pas authentifié, la route ne devrait pas être atteinte, mais on vérifie
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        // Commence la requête pour les commandes de l'utilisateur
        $query = $user->orders()->latest(); // Assuming a 'orders()' relationship exists in User model

        // Filtrage optionnel par statut
        if ($request->has('status')) {
            $query->where('status', $request->query('status'));
        }

        // Récupération et pagination des commandes
        $orders = $query->paginate(15); 

        return OrderResource::collection($orders);
    }
}