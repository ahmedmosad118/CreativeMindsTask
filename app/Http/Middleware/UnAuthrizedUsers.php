<?php

namespace App\Http\Middleware;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Auth;
use Closure;

class UnAuthrizedUsers
{
    # this middlearw handle unauthrized users which if user is login ,
    # he can't access (login , register route )
    public function handle($request, Closure $next)
    {
        try {
            # get token from session
            $token = session()->get("token");
            # if token not null which mean still in our session
            if ($token) {
                JWTAuth::setToken($token);
                $claim = JWTAuth::getPayload();
                if (!$claim) {
                    return $next($request);
                }
                return back();
            }
            return $next($request);
        } catch (Exception $e) {
            return $next($request);
        }
    }
}
