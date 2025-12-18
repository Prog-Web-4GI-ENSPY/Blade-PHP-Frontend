<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\DeliveryGeolocation; // Assurez-vous d'avoir ce modèle
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\OrderResource;

/**
 * @OA\Tag(
 * name="Deliveries",
 * description="API Endpoints for Delivery Management and Logistics"
 * )
 */
class DeliveryController extends Controller
{
    // Rôles autorisés pour la gestion de la logistique
    private const MANAGEMENT_ROLES = [User::ROLE_ADMIN, User::ROLE_MANAGER, User::ROLE_SUPERVISOR];
    
    /**
     * Vérifie si l'utilisateur est autorisé à gérer les livraisons (Admin, Manager, Supervisor).
     * @param User|null $user
     * @return bool
     */
    private function checkManagementAccess(?User $user): bool
    {
        if (!$user) {
            return false;
        }
        return in_array($user->role, self::MANAGEMENT_ROLES);
    }

    /**
     * @OA\Get(
     * path="/api/deliveries/pending",
     * summary="Get orders ready to be assigned to a delivery person (Management Roles only)",
     * tags={"Deliveries"},
     * security={{"bearerAuth":{}}},
     * @OA\Response(response=200, description="List of pending orders"),
     * @OA\Response(response=403, description="Forbidden - Management role required")
     * )
     */
    public function getPendingDeliveries(Request $request)
    {
        /** @var \App\Models\User $authenticatedUser */
        $authenticatedUser = $request->user();

        if (!$this->checkManagementAccess($authenticatedUser)) {
            return response()->json(['message' => 'Access denied. Management role required.'], 403);
        }

        // Filtre : Commandes payées et non encore assignées à un livreur
        $pendingOrders = Order::whereNull('delivery_user_id')
                              // Assurez-vous que ces constantes de statut existent dans votre modèle Order
                              ->whereIn('status', [Order::STATUS_PAID, Order::STATUS_PENDING_PAYMENT ?? Order::STATUS_PAID])
                              ->orderBy('created_at', 'asc')
                              ->get();

        return response()->json([
            'message' => 'Pending orders retrieved successfully',
            'data' => OrderResource::collection($pendingOrders) // Utilisation d'une ressource
        ]);
    }

    /**
     * @OA\Post(
     * path="/api/deliveries/{order}/assign",
     * summary="Assign an order to a delivery person (Management Roles only)",
     * tags={"Deliveries"},
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="order", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\RequestBody(required=true, @OA\JsonContent(required={"delivery_user_id"}, @OA\Property(property="delivery_user_id", type="integer"))),
     * @OA\Response(response=200, description="Order assigned successfully"),
     * @OA\Response(response=403, description="Forbidden"),
     * @OA\Response(response=404, description="Order or Delivery user not found")
     * )
     */
    public function assignDelivery(Request $request, Order $order)
    {
        /** @var \App\Models\User $authenticatedUser */
        $authenticatedUser = $request->user();

        // 1. Restriction de rôle (Utilisation de la méthode sécurisée)
        if (!$this->checkManagementAccess($authenticatedUser)) {
            return response()->json(['message' => 'Access denied. Management role required.'], 403);
        }

        $validated = $request->validate([
            'delivery_user_id' => [
                'required',
                'exists:users,id',
                // Vérifie que l'utilisateur assigné a bien le rôle DELIVERY
                Rule::exists('users', 'id')->where(function ($query) {
                    return $query->where('role', User::ROLE_DELIVERY);
                }),
            ],
        ]);

        $deliveryUser = User::find($validated['delivery_user_id']);

        if (!$deliveryUser || !$deliveryUser->isDelivery()) {
            return response()->json(['message' => 'Invalid delivery user ID or role.'], 404);
        }
        
        // Mise à jour de la commande
        $order->update([
            'delivery_user_id' => $deliveryUser->id,
            'status' => Order::STATUS_ASSIGNED, // Utilisation de la constante
        ]);

        // Recharge l'ordre pour inclure le livreur dans la réponse (si la ressource l'utilise)
        $order->load('deliveryUser'); 

        return response()->json([
            'message' => "Order {$order->id} assigned to delivery user {$deliveryUser->name} successfully",
            'data' => new OrderResource($order)
        ]);
    }

    // =======================================================
    // Méthodes pour l'Application Mobile (Livreur) - React Native
    // =======================================================

    /**
     * @OA\Get(
     * path="/api/deliveries/my",
     * summary="Get deliveries assigned to the authenticated user (Delivery Role only)",
     * tags={"Deliveries"},
     * security={{"bearerAuth":{}}},
     * @OA\Response(response=200, description="List of deliveries"),
     * @OA\Response(response=403, description="Forbidden - Delivery role required")
     * )
     */
    public function getMyDeliveries(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        if (!$user || !$user->isDelivery()) {
            return response()->json(['message' => 'Access denied. Delivery role required.'], 403);
        }
        
        // Récupère les commandes qui sont assignées à ce livreur ET qui ne sont pas encore TERMINÉES
        $myDeliveries = Order::where('delivery_user_id', $user->id)
                             ->whereNotIn('status', [Order::STATUS_DELIVERED, Order::STATUS_FAILED])
                             ->orderBy('created_at', 'asc')
                             ->get();

        return response()->json([
            'message' => 'Assigned deliveries retrieved successfully',
            'data' => OrderResource::collection($myDeliveries)
        ]);
    }

    /**
     * @OA\Get(
     * path="/api/deliveries/history",
     * summary="Affiche l'historique des livraisons terminées (Livré, Échec) pour le livreur connecté (Delivery Role only).",
     * tags={"Deliveries"},
     * security={{"bearerAuth":{}}},
     * @OA\Response(response=200, description="Liste des commandes terminées."),
     * @OA\Response(response=403, description="Accès refusé (non-livreur).")
     * )
     */
    public function getDeliveryHistory(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        if (!$user || !$user->isDelivery()) {
            return response()->json(['message' => 'Forbidden. Only delivery personnel can access this resource.'], 403);
        }

        $finalStatuses = [
            Order::STATUS_DELIVERED, 
            Order::STATUS_FAILED,    
        ];

        $history = Order::where('delivery_user_id', $user->id)
                        ->whereIn('status', $finalStatuses)
                        ->orderByDesc('updated_at')
                        ->paginate(15); 

        return OrderResource::collection($history);
    }
    
    /**
     * @OA\Put(
     * path="/api/deliveries/{order}/status",
     * summary="Update the delivery status of an order (Assigned Delivery Role only)",
     * tags={"Deliveries"},
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="order", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\RequestBody(required=true, @OA\JsonContent(required={"status"}, @OA\Property(property="status", type="string", enum={"EN_ROUTE", "DELIVERED", "FAILED"}, example="EN_ROUTE"))),
     * @OA\Response(response=200, description="Status updated successfully"),
     * @OA\Response(response=403, description="Forbidden"),
     * )
     */
    public function updateStatus(Request $request, Order $order)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        // Restriction : Seul le livreur assigné peut changer le statut
        if (!$user || !$user->isDelivery() || $order->delivery_user_id !== $user->id) {
            return response()->json(['message' => 'Access denied. Not the assigned delivery person.'], 403);
        }

        $validated = $request->validate([
            'status' => ['required', Rule::in([Order::STATUS_EN_ROUTE, Order::STATUS_DELIVERED, Order::STATUS_FAILED])],
        ]);

        $order->update(['status' => $validated['status']]);

        return response()->json([
            'message' => "Delivery status updated to {$validated['status']} for order {$order->id}",
            'data' => new OrderResource($order)
        ]);
    }

    /**
     * @OA\Post(
     * path="/api/deliveries/location",
     * summary="Update the authenticated delivery person's current GPS location (Delivery Role only)",
     * tags={"Deliveries"},
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(required=true, @OA\JsonContent(required={"latitude", "longitude"}, @OA\Property(property="latitude", type="number"), @OA\Property(property="longitude", type="number"))),
     * @OA\Response(response=200, description="Location updated successfully"),
     * @OA\Response(response=403, description="Forbidden - Delivery role required")
     * )
     */
    public function updateLocation(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        if (!$user || !$user->isDelivery()) {
            return response()->json(['message' => 'Access denied. Delivery role required.'], 403);
        }

        $validated = $request->validate([
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);
        
        // Assurez-vous que l'utilisateur a une relation 'geolocation' dans son modèle
        $location = DeliveryGeolocation::updateOrCreate(
            ['user_id' => $user->id],
            [
                'latitude' => $validated['latitude'],
                'longitude' => $validated['longitude'],
            ]
        );

        return response()->json([
            'message' => 'Location updated successfully',
            'data' => $location
        ]);
    }

    /**
     * @OA\Get(
     * path="/api/deliveries/live/map",
     * summary="Get all active delivery persons' live locations for the admin map (Management Roles only)",
     * tags={"Deliveries"},
     * security={{"bearerAuth":{}}},
     * @OA\Response(response=200, description="List of live locations"),
     * @OA\Response(response=403, description="Forbidden - Management role required")
     * )
     */
    public function getLiveLocations(Request $request)
    {
        /** @var \App\Models\User $authenticatedUser */
        $authenticatedUser = $request->user();

        if (!$this->checkManagementAccess($authenticatedUser)) {
            return response()->json(['message' => 'Access denied. Management role required.'], 403);
        }

        // Récupère toutes les dernières géolocalisations des utilisateurs qui sont livreurs
        // Assurez-vous que le modèle DeliveryGeolocation existe et a la relation 'user'
        $liveLocations = DeliveryGeolocation::with('user:id,name,role') // Réduit les champs user
            ->whereHas('user', function ($query) {
                $query->where('role', User::ROLE_DELIVERY);
            })
            ->get();

        return response()->json([
            'message' => 'Live locations retrieved successfully',
            'data' => $liveLocations
        ]);
    }

    /**
     * @OA\Post(
     * path="/api/deliveries/{order}/proof",
     * summary="Uploads the proof of delivery (image) for an order (Assigned Delivery Role only)",
     * tags={"Deliveries"},
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="order", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\RequestBody(required=true, @OA\MediaType(mediaType="multipart/form-data", @OA\Schema(
     * @OA\Property(property="proof_image", type="string", format="binary"),
     * @OA\Property(property="proof_type", type="string", enum={"photo", "signature", "qr"})
     * ))),
     * @OA\Response(response=200, description="Proof uploaded successfully"),
     * @OA\Response(response=403, description="Forbidden"),
     * )
     */
    public function uploadProof(Request $request, Order $order)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        /// 1. Vérification d'accès : Seul le livreur assigné peut uploader la preuve
        if (!$user || !$user->isDelivery() || $order->delivery_user_id !== $user->id) {
            return response()->json(['message' => 'Access denied. Not the assigned delivery person.'], 403);
        }
        
        // 2. Vérification du statut : On n'upload pas une preuve si c'est déjà livré
        if ($order->status === Order::STATUS_DELIVERED) {
             return response()->json(['message' => 'Order is already marked as delivered.'], 400);
        }

        $validated = $request->validate([
            'proof_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // 2MB max
            'proof_type' => ['required', Rule::in(['photo', 'signature', 'qr'])],
        ]);

        if ($request->hasFile('proof_image')) {
            $path = $request->file('proof_image')->store('proofs', 'public');
            
            // 3. Mise à jour de la commande
            $order->update([
                'proof_path' => $path,
                'proof_type' => $validated['proof_type'],
                'status' => Order::STATUS_DELIVERED, 
            ]);

            return response()->json([
                'message' => 'Proof of delivery uploaded successfully.',
                'data' => new OrderResource($order)
            ]);
        }
        
        return response()->json(['message' => 'Image upload failed.'], 500);
    }

    /**
     * @OA\Get(
     * path="/api/deliveries/{order}/proof",
     * summary="Get the delivery proof path (Admin/Manager/Supervisor/Client/Assigned Delivery)",
     * tags={"Deliveries"},
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="order", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Proof URL retrieved successfully"),
     * @OA\Response(response=403, description="Forbidden"),
     * @OA\Response(response=404, description="Proof not found")
     * )
     */
    public function getProof(Order $order)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        if (!$user) {
             return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        // Restriction d'accès :
        $isManagement = $this->checkManagementAccess($user);
        $isClient = $order->user_id === $user->id; 
        $isAssignedDelivery = $order->delivery_user_id === $user->id;

        $hasAccess = $isManagement || $isClient || $isAssignedDelivery;

        if (!$hasAccess) {
            return response()->json(['message' => 'Access denied. You are not authorized to view this proof.'], 403);
        }

        if (!$order->proof_path) {
            return response()->json(['message' => 'Delivery proof not yet available for this order.'], 404);
        }

        // Retourne le chemin complet pour accéder à l'image via le lien symbolique
        $proofUrl = Storage::url($order->proof_path);

        return response()->json([
            'message' => 'Delivery proof path retrieved successfully.',
            'data' => [
                'proof_url' => asset($proofUrl),
                'proof_type' => $order->proof_type,
            ]
        ]);
    }
}