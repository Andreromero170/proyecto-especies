<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRolMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {
        if (! $user = $request->user()) {
            return response()->json([
                'error'   => 'No autenticado',
                'message' => 'Debes iniciar sesión para acceder a este recurso',
            ], 401);
        }

        $rolList = explode('|', $roles);

        if (! in_array($user->rol, $rolList)) {
            return response()->json([
                'error'   => 'No autorizado',
                'message' => 'No tienes los roles requeridos para acceder a esta ruta',
            ], 403);
        }

        return $next($request);
    }
}