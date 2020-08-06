<?php

namespace App\Repository;

use App\Article;
use JWTAuth;

class ArticleRepository
{
    public function getUserArticle()
    {    	
        return Article::where('name', '=', JWTAuth::user()->name)->get();             
    }

    public function createArticle($request)
    {           
        return Article::create([
            'name' => JWTAuth::user()->name,
            'title' => $request->title,
            'content' => $request->content,
        ]);
    }

    public function updateArticle($request, $id)
    {           
        return Article::find($id)->update([
            'title' => $request->title,
            'content' => $request->content,
        ]); 
    }

    public function deleteArticle($id)
    {      
        return Article::find($id)->delete();
    }

    public function getArticle($id)
    {
        return Article::find($id);
    }

    public function getAllArticle()
    {
        return Article::all();
    }
}
