<?php

namespace App\Repositories\Result;

use App\Models\Result;
use App\Repositories\Result\ResultRepositoryInterface;

class EloquentResultRepository implements ResultRepositoryInterface {

    /**
     * 
     * @return Result
     */
    public function getResultScan($userId){
        $resultData = Result::join('diseases', 'results.disease_id', '=', 'diseases.disease_id')->join('ingredients','diseases.disease_id','=','ingredients.disease_id')->select('results.*','diseases.disease_id', 'diseases.namaPenyakit', 'diseases.rekomendasi','diseases.larangan','ingredients.kandungan')->where("user_id",$userId)->get();

        return $resultData;
    }
}