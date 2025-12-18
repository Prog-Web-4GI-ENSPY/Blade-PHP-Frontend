<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminOrVendorMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return response()->json([
                'message' => 'Unauthenticated.'
            ], 401);
        }

        $user = auth()->user();
        
        if (!$user->isAdmin() && !$user->isVendor()) {
            return response()->json([
                'message' => 'Access denied. Admin or Vendor role required.'
            ], 403);
        }

        return $next($request);
    }
}