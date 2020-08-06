<?php

namespace App\Http\Middleware;

use JWTAuth;
use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;


class RefreshToken extends BaseMiddleware
{
     /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     *
     * @throws \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 使用 try 包裹，以捕捉 token 過期所拋出的 TokenExpiredException 異常
        try {
            // 檢測用戶的登錄狀態，如果正常則通過
            if (JWTAuth::parseToken()->authenticate()) {
                return $next($request);
            }
        } catch (TokenExpiredException $exception) {
            // 捕獲到了 token 過期所拋出的 TokenExpiredException 異常，我們在這裡需要做的是刷新該用戶的 token 並將它添加到響應中
            try {
                // 刷新用户的 token
                $token = JWTAuth::refresh(JWTAuth::getToken());
                var_dump($token);
                JWTAuth::setToken($token);
            } catch (JWTException $exception) {
                // 如果捕獲到此異常，即代表 refresh 也過期了，用戶無法刷新令牌，需要重新登錄。
                return response()->json([
                    'success' => false,
                    'message' => $exception->getMessage(),  
                    'data' => '',     
                ], 403);
            }
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(), 
                'data' => '',        
            ], 403);
        }
        // 返回新的 token
        return $this->setAuthenticationHeader($next($request), $token);
    }
}
