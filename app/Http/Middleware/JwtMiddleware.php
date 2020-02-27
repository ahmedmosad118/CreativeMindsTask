<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use App\Http\Controllers\Api\ApiController;

class JwtMiddleware
{
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return ApiController::ApiResponse(null, "Token is Invalid", 401, "error");
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return ApiController::ApiResponse(null, "Token is Expired", 401, "error");
            } else {
                return ApiController::ApiResponse(null, "Authorization Token not found", 401, "error");
            }
        }
        return $next($request);
    }
}
