<?php

namespace App\Service;

use App\Repository\ArticleRepository;

class ArticleService
{
    protected $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function getUserArticle()
    {
        return $this->articleRepository->getUserArticle();                     
    }

    public function createArticle($request)
    {        
        return $this->articleRepository->createArticle($request);
    }

    public function updateArticle($request, $id)
    {   
        return $this->articleRepository->updateArticle($request, $id);
    }

    public function deleteArticle($id)
    {
        return $this->articleRepository->deleteArticle($id);           
    }

    public function getArticle($id)
    {
        return $this->articleRepository->getArticle($id);
    }

    public function getAllArticle()
    {
        return $this->articleRepository->getAllArticle();
    }
    
}
