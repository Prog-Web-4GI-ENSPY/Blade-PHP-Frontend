<?php

namespace App\Http\Controllers;

use App\Mail\UserRegistered; // Import du Mailable pour l'envoi d'e-mail
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail; // Ajout pour l'envoi d'e-mail
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

/**
 * @OA\Tag(
 * name="Auth",
 * description="Opérations d'authentification et de gestion des utilisateurs."
 * )
 * @OA\Components(
 * @OA\SecurityScheme(
 * securityScheme="bearerAuth",
 * type="http",
 * scheme="bearer",
 * bearerFormat="Sanctum",
 * description="Entrez le jeton Bearer obtenu après la connexion."
 * )
 * )
 */

class AuthController extends Controller
{
    /**
     * @OA\Post(
     * path="/api/register",
     * operationId="registerUser",
     * tags={"Auth"},
     * summary="Enregistrement d'un nouvel utilisateur",
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"name", "email", "password", "password_confirmation"},
     * @OA\Property(property="name", type="string", example="Raoul Ossombe"),
     * @OA\Property(property="email", type="string", format="email", example="raoulOssombe@shopcart.com"),
     * @OA\Property(property="password", type="string", format="password", example="secret123"),
     * @OA\Property(property="password_confirmation", type="string", format="password", example="secret123"),
     * @OA\Property(property="phone", type="string", nullable=true, example="+237653982736"),
     * @OA\Property(property="address", type="string", nullable=true, example="Yaounde,Melen") 
     * )
     * ),
     * @OA\Response(
     * response=201,
     * description="Enregistrement réussi. Retourne le jeton d'accès.",
     * @OA\JsonContent(
     * @OA\Property(property="message", type="string", example="Registered"),
     * @OA\Property(property="token", type="string", example="1|xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"),
     * @OA\Property(property="user", type="object")
     * )
     * ),
     * @OA\Response(
     * response=422,
     * description="Erreur de validation des données."
     * )
     * )
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'CUSTOMER', // Rôle par défaut
            'phone' => $request->phone,
            'address' => $request->address,
        ]);


        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Registered',
            'token' => $token,
            'user' => $user->only(['id', 'name', 'email', 'role', 'phone', 'address'])
        ], 201);
    }

    /**
     * @OA\Post(
     * path="/api/login", 
     * operationId="loginUser",
     * tags={"Auth"},
     * summary="Connexion de l'utilisateur",
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"email", "password"},
     * @OA\Property(property="email", type="string", format="email", example="raoulossombe@shopcart.com"),
     * @OA\Property(property="password", type="string", format="password", example="secret123")
     * )
     * ),
     * @OA\Response(
     * response=200,
     * description="Connexion réussie. Retourne le jeton d'accès.",
     * @OA\JsonContent(
     * @OA\Property(property="message", type="string", example="Login successful"),
     * @OA\Property(property="token", type="string", example="2|yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy"),
     * @OA\Property(property="user", type="object")
     * )
     * ),
     * @OA\Response(
     * response=401,
     * description="Identifiants invalides."
     * )
     * )
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user->only(['id', 'name', 'email', 'role','phone','address'])
        ]);
    }

    /**
     * @OA\Post(
     * path="/api/logout", 
     * operationId="logoutUser",
     * tags={"Auth"},
     * summary="Déconnexion de l'utilisateur",
     * description="Supprime le jeton d'accès actuel de l'utilisateur.",
     * security={{"bearerAuth": {}}},
     * @OA\Response(
     * response=200,
     * description="Déconnexion réussie."
     * ),
     * @OA\Response(
     * response=401,
     * description="Non authentifié."
     * )
     * )
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out']);
    }

 /**
 * @OA\Get(
 *     path="/api/user", 
 *     operationId="getCurrentUser",
 *     tags={"Auth"},
 *     summary="Obtenir les informations de l'utilisateur actuel",
 *     description="Retourne les données de l'utilisateur authentifié via le jeton Bearer.",
 *     security={{"bearerAuth": {}}},
 *     @OA\Response(
 *         response=200,
 *         description="Informations utilisateur récupérées.",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="name", type="string", example="John Doe"),
 *             @OA\Property(property="email", type="string", format="email", example="john@example.com"),
 *             @OA\Property(property="role", type="string", example="USER"),
 *             @OA\Property(property="created_at", type="string", format="date-time", example="2025-11-13T12:00:00Z"),
 *             @OA\Property(property="updated_at", type="string", format="date-time", example="2025-11-13T12:00:00Z")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Non authentifié."
 *     )
 * )
 */

    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}