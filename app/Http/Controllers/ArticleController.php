<?php

namespace App\Http\Controllers;

use App\Services\ArticleService;
use App\Http\Requests\CreateArticlePost;

class ArticleController extends Controller {
    private $articleService;

    public function __construct(ArticleService $articleService) {
        $this->articleService = $articleService;
    }

    /**
     * Display a listing of the articles.
     */
    public function getArticles() {
        $articles = $this->articleService->getArticle();

        return $articles;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createArticle(CreateArticlePost $request) {
        $article = $this->articleService->createArticle($request);

        return $article;
    }
    
    /**
     * Display the specified article.
     */
    public function getArticleById($id){
        $article = $this->articleService->getArticleById($id);

        return $article;
    }
}
