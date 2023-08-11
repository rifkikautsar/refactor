<?php

namespace App\Repositories\Scan;

use App\Models\Result;
use App\Models\Diseases;
use App\Repositories\Scan\ScanRepositoryInterface;

class EloquentScanRepository implements ScanRepositoryInterface {

    /**
     * @param string $name
     * @return Diseases
     */
    public function getDiseaseByName($name){
        $diseaseData = Diseases::join('ingredients', 'diseases.disease_id', '=', 'ingredients.disease_id')
        ->select('diseases.namaPenyakit','diseases.disease_id', 'diseases.rekomendasi','diseases.larangan','ingredients.kandungan')->where('diseases.namaPenyakit',$name)->firstOrFail();

        return $diseaseData;
    }

    /**
     * @param object $data
     * @return Result
     */
    public function storeScanData($data, $imageData){
        $storeScan = Result::create([
            "user_id" => $imageData->userId,
            "disease_id" => $data->diseaseId,
            "urlImage" => $imageData->urlImage
        ]);

        return $storeScan;
    }
    /**
     * @param string $disease
     * 
     */
    public function getDiseasesIdByName($disease) {
        $diseaseId = Diseases::where('namaPenyakit', $disease)->pluck('disease_id')->firstOrFail();

        return $diseaseId;
    }
}