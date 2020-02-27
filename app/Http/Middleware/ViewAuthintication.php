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
            $token = session()->get("token");
            if ($token) {
                $user = JWTAuth::toUser($token);
                return $next($request);
            }
            return redirect('/');
        } catch (Exception $e) {
            return redirect('/');
        }
    }
}
