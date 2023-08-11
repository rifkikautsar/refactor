<?php

namespace App\Repositories\Diseases;

use App\Models\Diseases;
use Illuminate\Support\Facades\DB;
use App\Repositories\Diseases\DiseasesRepositoryInterface;

class EloquentDiseasesRepository implements DiseasesRepositoryInterface {

    /**
     * @return Diseases
     */
    public function getDiseases() {
        $data = DB::table('diseases')->get();
        return $data;
    }

    /**
     * @param array $data
     * @return Diseases
     */ 
    public function storeDiseases($data) {
        return Diseases::create($data);
    }
}

?>