<?php

namespace App\Http\Middleware;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use Closure;

class ViewAuthintication
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
            # get token from session
            $token = session()->get("token");
            # if token not null which mean still in our session
            if ($token) {
                JWTAuth::setToken($token);
                $claim = JWTAuth::getPayload();
                if (!$claim) {
                    return redirect('/');
                }
                return $next($request);
            }
            return redirect('/');
        } catch (Exception $e) {
            return redirect('/');
        }
    }
}
