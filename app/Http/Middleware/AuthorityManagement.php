<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use App\Article;

class AuthorityManagement
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
        //權限判斷
        $articleId = $request->route('id');
        $name = Article::where('id', $articleId)->value('name');
        if ($name == NULL) {
            return response()->json([
                'success' => false,
                'message' => '找不到文章',
                'data' => '',
            ], 200);
        } elseif (JWTAuth::user()->name == $name || JWTAuth::user()->identity == 'admin') {
            return $next($request);
        } else {
            return response()->json([
                'success' => false,
                'message' => '不是作者或管理員',
                'data' => '',
            ], 403);
        }
    }
}
