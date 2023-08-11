<?php

namespace App\Services;

use App\Http\Requests\CreateSurveyValidation;
use App\Repositories\Survey\SurveyRepositoryInterface;
use App\Response\ApiResponse;

class SurveyService {
    private $surveyRepository;

    public function __construct(SurveyRepositoryInterface $surveyRepository) {
        $this->surveyRepository = $surveyRepository;
    }

    /**
     * insert survey data to database
     * @param CreateSurveyValidation $request
     * @return mixed
     */
    public function storeSurveyData(CreateSurveyValidation $request) {
        $data = $request->validated();
        
        $this->surveyRepository->storeSurveyData($data);
        
        return ApiResponse::create(200, 'Success', null);
    }
}