<?php

namespace App\Repositories\Survey;

use App\Models\Survey;
use App\Services\ApiResponseService;
use App\Repositories\Survey\SurveyRepositoryInterface;

class EloquentSurveyRepository implements SurveyRepositoryInterface {

    /**
     * @param array $data
     * @return Survey
     */
    public function storeSurveyData($data) {
        $insertSurvey = Survey::create([
            'user_id' => $data['user_id'],
            'porsi_minum' => $data['porsi_minum'],
            'jam_tidur' => $data['jam_tidur'],
            'olahraga'  => $data['olahraga'],
            'sinar_matahari' => $data['sinar_matahari'],
            'kondisi_kulit1' => $data['kondisi1'],
            'kondisi_kulit2' => $data['kondisi2'],
            'kondisi_kulit3' => $data['kondisi3']
        ]);

        return $insertSurvey;
    }
}