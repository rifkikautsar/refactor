<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDiseasesPost;
use App\Services\DiseasesService;

class DiseasesController extends Controller {
    private $diseasesService;

    public function __construct(DiseasesService $diseasesService) {
        $this->diseasesService = $diseasesService;
    }

    /**
     * Display all Diseases data.
     */
    public function getDiseases() {
        $diseases = $this->diseasesService->getDiseases();

        return $diseases;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createDiseases(CreateDiseasesPost $request) {
        $diseases = $this->diseasesService->createDiseases($request);

        return $diseases;
    }
}
