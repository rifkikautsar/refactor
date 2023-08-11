<?php

namespace App\Http\Controllers;

use App\Services\ScanService;
use App\Http\Requests\ScanRequest;


class ScanController extends Controller {
    private $scanService;
    
    public function __construct(ScanService $scanService) {
        $this->scanService = $scanService;
    }
    
    /**
     * Store new uploaded image to GCS.
     */
    public function scanImage(ScanRequest $request) {
        $request->validated();

        $imageData = $this->scanService->storeImageToGCS($request);
        
        $predictionDisease = $this->scanService->sendImageToAI($imageData->imageName);

        $this->scanService->storeScanData($predictionDisease, $imageData);
        
        $reccomendation = $this->scanService->getReccomendation($predictionDisease);
        
        return $reccomendation;
    }
}
