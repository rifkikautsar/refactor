<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSurveyValidation;
use App\Services\SurveyService;

class SurveyController extends Controller {
    private $surveyService;

    public function __construct(SurveyService $surveyService) {
        $this->surveyService = $surveyService;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function storeSurveyData(CreateSurveyValidation $request) {
        $survey = $this->surveyService->storeSurveyData($request);

        return $survey;
    }
}
