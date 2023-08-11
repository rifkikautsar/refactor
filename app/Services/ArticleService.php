<?php

namespace App\Services;

use App\Repositories\Article\ArticleRepositoryInterface;
use App\Services\Service;
use App\Response\ApiResponse;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class ArticleService {
    private $articleRepository;

    public function __construct(ArticleRepositoryInterface $articleRepository) {
        $this->articleRepository = $articleRepository;
    }

    /**
     * insert article data to database
     * @param object $request
     * @return mixed
     */
    public function createArticle(object $request) {
        try {
            $articleData = $request->validated();
            
            //Store image and return a unique name
            $uploadedImageName = Service::handleUploadedImage($articleData['image'], 'articles');

            //Replace image name with a unique name
            $articleData['image'] = $uploadedImageName;

            $this->articleRepository->storeArticle($articleData);

            return ApiResponse::create(200, 'Success', null);

        } catch (QueryException $e) {
            // Handle database-related exceptions
            $message = 'Database Error: ' . $e->getMessage();

            return ApiResponse::create(400, $message, null);
        }
    }

    /**
     * get article data from database
     * @return mixed
     */
    public function getArticle() {
        $articles = $this->articleRepository->getArticle();

        if(empty($articles)) {
            return ApiResponse::create(400, 'Data not found', null);
        }
        
        //add url image and url article by id
        foreach ($articles as $item) {
            $item->title = Str::limit($item->title, 20);
            $item->urlImage = "https://api.skinpals.id/images/articles/".$item->image;
            $item->ArticleById = "https://api.skinpals.id/article/".$item->id;
        }
        
        return ApiResponse::create(200, 'Success', $articles);
    }

    /**
     * get article data by id from database
     * @return mixed
     */
    public function getArticleById($id){
        try{
            $article = $this->articleRepository->getArticleById($id);
            
            return ApiResponse::create(200, 'Success', $article);
        } catch (ModelNotFoundException $e){
            $message = 'Error: ' . $e->getMessage();

            return ApiResponse::create(400, $message, null);
        }
    }
}