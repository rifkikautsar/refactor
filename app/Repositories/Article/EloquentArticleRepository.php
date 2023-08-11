<?php

namespace App\Repositories\Article;

use App\Models\Article;
use App\Repositories\Article\ArticleRepositoryInterface;

class EloquentArticleRepository implements ArticleRepositoryInterface {

    /**
     * @return Article
     */
    public function getArticle() {
        $articleData = Article::join('users', 'users.user_id', '=', 'articles.user_id')
        ->select('id','nama','title','description','image','articles.created_at','articles.updated_at')
        ->get();
        return $articleData;
    }

    /**
     * @param array $data
     * @return Article
     */
    public function storeArticle($data) {
        return Article::create($data);
    }

    /**
     * @param int $id
     * @return Article
     */
    public function getArticleById($id) {
        return Article::findOrFail($id);
    }
}

?>