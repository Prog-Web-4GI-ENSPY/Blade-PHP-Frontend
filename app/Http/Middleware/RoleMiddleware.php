<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Gère la vérification des rôles d'accès pour la route.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string ...$roles  Liste des rôles autorisés, séparés par des virgules dans la définition de la route.
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Vérification de l'utilisateur
        $user = $request->user();

        if (!$user) {
            // L'utilisateur n'est pas authentifié (bien que 'auth:sanctum' doive le gérer)
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        // 2. Vérification des rôles
        // Note: $roles est un tableau où chaque élément est une chaîne ('ADMIN,VENDOR')
        // Nous devons éclater ces chaînes pour obtenir un tableau plat de tous les rôles autorisés.
        $allowedRoles = [];
        foreach ($roles as $roleString) {
            // Explose les chaînes comme "ADMIN,VENDOR"
            $allowedRoles = array_merge($allowedRoles, explode(',', $roleString));
        }

        // Nettoyage et suppression des espaces blancs
        $allowedRoles = array_map('trim', $allowedRoles);

        // Utilise la méthode hasAnyRole du modèle User
        if (!$user->hasAnyRole($allowedRoles)) {
            return response()->json([
                'message' => 'Access denied. You do not have the required role(s).',
                'required_roles' => $allowedRoles
            ], 403);
        }

        return $next($request);
    }
}