<?php
// Developer: Ali Abu Taleb | Reviewed: 2025-10-17
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!$request->user()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        // Allow admin to access any role's routes
        if ($request->user()->role === 'admin') {
            return $next($request);
        }

        if ($request->user()->role !== $role) {
            return response()->json([
                'error' => 'Unauthorized. Required role: ' . $role
            ], 403);
        }

        return $next($request);
    }
}