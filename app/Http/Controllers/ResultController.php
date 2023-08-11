<?php

namespace App\Http\Controllers;

use App\Services\ResultService;

class ResultController extends Controller {
    private $resultService;

    public function __construct(ResultService $resultService) {
        $this->resultService = $resultService;
    }

    /**
     * Display a listing of the resource.
     */
    public function getResultScan($userId) {
        return $this->resultService->getResultScan($userId);
    }
}
