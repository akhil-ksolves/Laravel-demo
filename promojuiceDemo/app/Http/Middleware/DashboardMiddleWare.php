<?php

namespace App\Http\Middleware;

use Closure;

use App\User;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class DashboardMiddleWare extends BaseMiddleware
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
        
        $token = $request->cookie('j0');
        $request->headers->set('Authorization', 'Bearer '.$token);
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            return redirect('/');
        }
        return $next($request);
    }
}
