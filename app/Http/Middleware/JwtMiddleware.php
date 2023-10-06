<?php

namespace App\Http\Middleware;

use App\Http\Models\ResponseGeneralModel;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth as FacadesJWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        try {
            //$user = FacadesJWTAuth::parseToken()->authenticate();
            $token = $request->header('Authorization');
            FacadesJWTAuth::setToken($token)->getPayload();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(new ResponseGeneralModel(
                    null,
                    'Token no valido',
                    ''
                ), 401);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(new ResponseGeneralModel(
                    null,
                    'Sesion caducada',
                    'Token caducado'
                ), 401);
            }else{
                return response()->json(new ResponseGeneralModel(
                    null,
                    'Error al validar la sesion',
                    'Authorization Token not found'
                ), 401);
            }
        }
        return $next($request);
    }
}
