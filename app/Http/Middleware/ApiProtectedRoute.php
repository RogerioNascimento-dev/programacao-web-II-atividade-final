<?php

namespace App\Http\Middleware;

use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;
use Closure;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class ApiProtectedRoute
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {

            if ($e instanceof TokenInvalidException) {
                return response(['error' => 'Token é Inválido.'], 401);
            } else if ($e instanceof TokenExpiredException) {
                return response(['error' => 'Token expirado.'], 401);
            } else {
                return response(['error' => 'Token de autorização não localizado.'], 401);
            }
        }
        return $next($request);
    }
}
