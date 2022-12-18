<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProtectRouteAdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        try {
            $user = JWTAuth::parseToken()->authenticate();
            if ($user->roles != 'admin')
                return response()->json(['status' => false, 'message' => 'Rota exclusiva para Administradores...'], 401);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Rota exclusiva para Administradores...'], 401);
        }
        return $next($request);
    }
}
