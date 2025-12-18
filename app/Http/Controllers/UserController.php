<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\UserResource; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

/**
 * @OA\Tag(
 * name="Users",
 * description="API Endpoints for User Management (Admin/Manager/Supervisor)"
 * )
 */
class UserController extends Controller
{
    /**
     * Rôles autorisés pour la gestion des utilisateurs.
     * @var array
     */
    private const MANAGEMENT_ROLES = ['ADMIN', 'MANAGER', 'SUPERVISOR'];

    /**
     * Tous les rôles disponibles dans le système.
     * @var array
     */
    private const ALL_ROLES = ['CUSTOMER', 'ADMIN', 'VENDOR', 'DELIVERY', 'MANAGER', 'SUPERVISOR'];

    /**
     * Vérifie si l'utilisateur est autorisé à gérer les utilisateurs.
     * * @param User $user
     * @return bool
     */
    private function checkManagementAccess(User $user): bool
    {
        // Supposons que les méthodes isAdmin(), isManager(), isSupervisor() existent dans le modèle User
        return $user->isAdmin() || $user->isManager() || $user->isSupervisor();
    }


    /**
     * @OA\Get(
     * path="/api/users",
     * summary="Get all users with filtering and pagination (Management Roles only)",
     * tags={"Users"},
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(
     * name="role",
     * in="query",
     * description="Filter by role",
     * required=false,
     * @OA\Schema(type="string", enum={"CLIENT", "ADMIN", "VENDOR", "DELIVERY", "MANAGER", "SUPERVISOR"})
     * ),
     * @OA\Parameter(
     * name="per_page",
     * in="query",
     * description="Items per page",
     * required=false,
     * @OA\Schema(type="integer", default=15)
     * ),
     * @OA\Response(
     * response=200,
     * description="List of users",
     * @OA\JsonContent(
     * @OA\Property(property="message", type="string", example="Users retrieved successfully"),
     * @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/UserResource"))
     * )
     * ),
     * @OA\Response(response=403, description="Forbidden - Management role required")
     * )
     */
    public function index(Request $request)
    {
        /** @var \App\Models\User $authenticatedUser */
        $authenticatedUser = auth()->user();

        if (!$authenticatedUser || !$this->checkManagementAccess($authenticatedUser)) {
            return response()->json([
                'message' => 'Access denied. Management role required.'
            ], 403);
        }

        $query = User::orderBy('created_at', 'desc');

        // Filtrage par rôle
        if ($request->has('role')) {
            $requestedRole = strtoupper($request->role);
            if (in_array($requestedRole, self::ALL_ROLES)) {
                $query->where('role', $requestedRole);
            }
        }

        $users = $query->paginate($request->get('per_page', 15));

        return response()->json([
            'message' => 'Users retrieved successfully',
            'data' => UserResource::collection($users), // Utilisation de la ressource
            'total' => $users->total(),
            'per_page' => $users->perPage(),
            'current_page' => $users->currentPage(),
        ], 200);
    }

   /**
    * @OA\Post(
    * path="/api/users",
    * summary="Create a new user (Admin/Manager/Supervisor only)",
    * tags={"Users"},
    * security={{"bearerAuth":{}}},
    * @OA\RequestBody(
    * required=true,
    * @OA\JsonContent(
    * required={"name", "email", "password", "role"},
    * @OA\Property(property="name", type="string", example="Jane Doe"),
    * @OA\Property(property="email", type="string", format="email", example="jane@example.com"),
    * @OA\Property(property="password", type="string", format="password", example="password123"),
    * @OA\Property(property="password_confirmation", type="string", format="password", example="password123"),
    * @OA\Property(
    * property="role",
    * type="string",
    * enum={"CLIENT", "ADMIN", "VENDOR", "DELIVERY", "MANAGER", "SUPERVISOR"},
    * example="CLIENT"
    * ),
    * @OA\Property(property="phone", type="string", example="+33612345678"),
    * @OA\Property(property="address", type="string", example="123 Rue de Paris")
    * )
    * ),
    * @OA\Response(
    * response=201,
    * description="User created successfully",
    * @OA\JsonContent(
    * @OA\Property(property="message", type="string", example="User created successfully"),
    * @OA\Property(property="data", ref="#/components/schemas/UserResource")
    * )
    * ),
    * @OA\Response(
    * response=403,
    * description="Forbidden - Admin/Manager/Supervisor role required"
    * ),
    * @OA\Response(
    * response=422,
    * description="Validation error"
    * )
    * )
    */
    public function store(Request $request)
    {
        if (!auth()->check() || !$this->checkManagementAccess(auth()->user())) {
            return response()->json(['message' => 'Access denied. Management role required.'], 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'role' => ['required', Rule::in(self::ALL_ROLES)],
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            // Le hachage du mot de passe doit toujours se faire avant l'enregistrement
            'password' => Hash::make($validated['password']), 
            'role' => strtoupper($validated['role']),
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
        ]);

        return response()->json([
            'message' => 'User created successfully',
            'data' => new UserResource($user)
        ], 201);
    }
    
    /**
     * @OA\Get(
     * path="/api/users/me",
     * summary="Get authenticated user's profile details",
     * tags={"Users"},
     * security={{"bearerAuth":{}}},
     * @OA\Response(
     * response=200,
     * description="User profile retrieved successfully",
     * @OA\JsonContent(
     * @OA\Property(property="message", type="string", example="Profile retrieved successfully"),
     * @OA\Property(property="data", ref="#/components/schemas/UserResource")
     * )
     * )
     * )
     */
    public function me()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        
        if (!$user) {
             return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        return response()->json([
            'message' => 'Profile retrieved successfully',
            'data' => new UserResource($user)
        ]);
    }


    /**
     * @OA\Get(
     * path="/api/users/{user}",
     * summary="Get user details by ID (Management Roles only)",
     * tags={"Users"},
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="user", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(
     * response=200,
     * description="User details",
     * @OA\JsonContent(
     * @OA\Property(property="message", type="string", example="User retrieved successfully"),
     * @OA\Property(property="data", ref="#/components/schemas/UserResource")
     * )
     * ),
     * @OA\Response(response=404, description="User not found")
     * )
     */
    public function show(User $user)
    {
        if (!auth()->check() || !$this->checkManagementAccess(auth()->user())) {
             // Rediriger la vérification d'accès : seulement les rôles de gestion pour voir les détails de n'importe quel utilisateur
             return response()->json(['message' => 'Access denied. Management role required.'], 403);
        }

        return response()->json([
            'message' => 'User retrieved successfully',
            'data' => new UserResource($user)
        ]);
    }

/**
* @OA\Put(
* path="/api/users/{user}",
* summary="Update user (Admin/Manager/Supervisor only)",
* tags={"Users"},
* security={{"bearerAuth":{}}},
* @OA\Parameter(
* name="user",
* in="path",
* required=true,
* description="User ID",
* @OA\Schema(type="integer")
* ),
* @OA\RequestBody(
* required=true,
* @OA\JsonContent(
* required={"name", "email", "role"},
* @OA\Property(property="name", type="string", example="John Doe Updated"),
* @OA\Property(property="email", type="string", format="email", example="john.updated@example.com"),
* @OA\Property(
* property="role",
* type="string",
* enum={"CLIENT", "ADMIN", "VENDOR", "DELIVERY", "MANAGER", "SUPERVISOR"},
* example="ADMIN"
* ),
* @OA\Property(property="password", type="string", format="password", example="newpassword123"),
* @OA\Property(property="password_confirmation", type="string", format="password", example="newpassword123")
* )
* ),
* @OA\Response(
* response=200,
* description="User updated successfully",
* @OA\JsonContent(
* @OA\Property(property="message", type="string", example="User updated successfully"),
* @OA\Property(property="data", ref="#/components/schemas/UserResource")
* )
* ),
* @OA\Response(
* response=403,
* description="Forbidden - Admin/Manager/Supervisor role required"
* ),
* @OA\Response(
* response=422,
* description="Validation error"
* ),
* @OA\Response(
* response=404,
* description="User not found"
* )
* )
*/
    public function update(Request $request, User $user)
    {
        if (!auth()->check() || !$this->checkManagementAccess(auth()->user())) {
            return response()->json(['message' => 'Access denied. Management role required.'], 403);
        }

        // Ajout d'une vérification pour éviter qu'un utilisateur ne se dégrade lui-même d'un rôle de gestion
        $newRole = $request->filled('role') ? strtoupper($request->role) : $user->role;

        if ($user->id === auth()->id() && $user->role !== $newRole) {
             if (in_array($user->role, self::MANAGEMENT_ROLES) && !in_array($newRole, self::MANAGEMENT_ROLES)) {
                return response()->json([
                    'message' => "Forbidden. You cannot demote yourself from a management role."
                ], 403);
            }
        }


        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'role' => ['required', Rule::in(self::ALL_ROLES)],
            'password' => 'nullable|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => strtoupper($validated['role']),
            // Utiliser les valeurs existantes si les champs ne sont pas fournis (pour les champs nullable)
            'phone' => $validated['phone'] ?? $user->phone, 
            'address' => $validated['address'] ?? $user->address,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $user->update($updateData);

        return response()->json([
            'message' => 'User updated successfully',
            'data' => new UserResource($user)
        ]);
    }

    /**
     * @OA\Delete(
     * path="/api/users/{user}",
     * summary="Delete user (Management Roles only)",
     * tags={"Users"},
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="user", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="User deleted successfully"),
     * @OA\Response(response=403, description="Forbidden"),
     * @OA\Response(response=404, description="User not found")
     * )
     */
    public function destroy(User $user)
    {
        if (!auth()->check() || !$this->checkManagementAccess(auth()->user())) {
            return response()->json(['message' => 'Access denied. Management role required.'], 403);
        }

        // Protection : Empêcher un utilisateur de se supprimer lui-même
        if ($user->id === auth()->id()) {
            return response()->json([
                'message' => 'Forbidden. You cannot delete your own account via this endpoint.'
            ], 403);
        }

        // TODO: Implémentez ici les vérifications des dépendances :
        // 1. Si l'utilisateur est un VENDOR, a-t-il des produits ?
        // 2. Si l'utilisateur est un DELIVERY, a-t-il des commandes assignées ?
        // Si oui, renvoyer 422 avec un message d'erreur.

        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully'
        ]);
    }


    /**
     * @OA\Get(
     * path="/api/users/stats",
     * summary="Get user statistics by role (Management Roles only)",
     * tags={"Users"},
     * security={{"bearerAuth":{}}},
     * @OA\Response(
     * response=200,
     * description="User statistics",
     * @OA\JsonContent(
     * type="object",
     * @OA\Property(property="message", type="string", example="User statistics retrieved successfully"),
     * @OA\Property(property="data", type="object",
     * @OA\Property(property="total_users", type="integer", example=150),
     * @OA\Property(property="clients_count", type="integer", example=120),
     * @OA\Property(property="admins_count", type="integer", example=5),
     * @OA\Property(property="vendors_count", type="integer", example=15),
     * @OA\Property(property="delivery_count", type="integer", example=5),
     * @OA\Property(property="managers_count", type="integer", example=3),
     * @OA\Property(property="supervisors_count", type="integer", example=2)
     * )
     * )
     * )
     * )
     */
    public function roleStats()
    {
        if (!auth()->check() || !$this->checkManagementAccess(auth()->user())) {
            return response()->json(['message' => 'Access denied. Management role required.'], 403);
        }

        // Utilisation des requêtes optimisées pour le comptage
        $stats = [
            'total_users' => User::count(),
            'clients_count' => User::where('role', 'CLIENT')->count(),
            'admins_count' => User::where('role', 'ADMIN')->count(),
            'vendors_count' => User::where('role', 'VENDOR')->count(),
            'delivery_count' => User::where('role', 'DELIVERY')->count(),
            'managers_count' => User::where('role', 'MANAGER')->count(),
            'supervisors_count' => User::where('role', 'SUPERVISOR')->count(),
        ];

        return response()->json([
            'message' => 'User statistics retrieved successfully',
            'data' => $stats
        ]);
    }

    /**
     * @OA\Post(
     * path="/api/user/fcm-token",
     * summary="Enregistre le token Firebase Cloud Messaging (FCM) de l'utilisateur pour les notifications Push.",
     * tags={"Users"},
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"fcm_token"},
     * @OA\Property(property="fcm_token", type="string", description="Le token FCM unique de l'appareil mobile.")
     * )
     * ),
     * @OA\Response(
     * response=200,
     * description="Token FCM enregistré avec succès.",
     * @OA\JsonContent(type="string", example="FCM token updated successfully.")
     * ),
     * @OA\Response(response=401, description="Non authentifié.")
     * )
     */
    public function updateFcmToken(Request $request)
    {
        $request->validate([
            'fcm_token' => 'required|string',
        ]);

        $user = $request->user();

        // 1. Mise à jour de la colonne dans la base de données
        // ASSUMPTION: La colonne 'fcm_token' existe sur la table 'users'
        $user->fcm_token = $request->fcm_token;
        $user->save();

        return response()->json(['message' => 'FCM token updated successfully.'], 200);
    }
}