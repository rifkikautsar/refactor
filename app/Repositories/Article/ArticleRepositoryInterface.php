<?php

namespace App\Repositories\Article;

interface ArticleRepositoryInterface {
    public function storeArticle($data);
    public function getArticle();
    public function getArticleById($id);
}