<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\ArticleService;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }
    //文章瀏覽
    public function read($id)
    {
        $data = $this->articleService->getArticle($id);
        if ($data == null) {
            return response()->json([
                'success' => false,
                'message' => '找不到文章',
                'data' => '',
            ], 200);
        }
        return response()->json([
            'success' => true,
            'message' => 'get article',
            'data' => $data,
        ], 200);
    }
    //僅能看到登入者自己的文章
    public function user()
    {
        $data = $this->articleService->getUserArticle();
        if ($data->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => '沒有該user的文章',
                'data' => $data,
            ], 200);
        }
        return response()->json([
            'success' => true,
            'message' => 'get user',
            'data' => $data,
        ], 200);
    }
    //新增文章功能
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' =>'required|max:25|regex:/(^[a-zA-Z0-9 ]*$)/',
            'content' => 'required|regex:/(^[,.&a-zA-Z0-9]*$)/',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => '',
            ], 422);
        }
        $data = $this->articleService->createArticle($request);
        return response()->json([
            'success' => true,
            'message' => '新增成功',
            'data' => '',
        ], 200);
    }
    //編輯文章頁面顯示(取得該篇文章)
    public function edit($id)
    {
        $data = $this->articleService->getArticle($id);
        return response()->json([
            'success' => true,
            'message' => 'article edit',
            'data' => $data,
        ], 200);
    }
    //更新文章功能
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' =>'required|max:25|regex:/(^[a-zA-Z0-9 ]*$)/',
            'content' => 'required|regex:/(^[,.&a-zA-Z0-9]*$)/',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => '',
            ], 422);
        }
        if ($this->articleService->updateArticle($request, $id) == 'true') {
            return response()->json([
                'success' => true,
                'message' => '更新成功',
                'data' => '',
            ], 200);
        }
    }
    //刪除文章
    public function delete($id)
    {
        $this->articleService->deleteArticle($id);
        return response()->json([
            'success' => true,
            'message' => '刪除成功',
            'data' => '',
        ], 200);
    }
    //主頁文章顯示
    public function index()
    {
        $data = $this->articleService->getAllArticle();
        if (empty($data)) {
            return response()->json([
                'success' => true,
                'message' => '沒有文章',
                'data' => '',
            ], 200);
        }
        return response()->json([
            'success' => true,
            'message' => '文章列表',
            'data' => $data,
        ], 200);
    }
}
