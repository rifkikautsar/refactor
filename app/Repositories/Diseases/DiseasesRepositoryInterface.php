<?php

namespace App\Repositories\Diseases;

interface DiseasesRepositoryInterface {
    public function storeDiseases($data);
    public function getDiseases();
}