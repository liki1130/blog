<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;

class Admin
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
        if (JWTAuth::user()->identity != 'admin') {
            return response()->json([
                'success' => false,
                'message' => '不是管理員',
                'data' => '',
            ], 403);
        }
        return $next($request);
    }
}
