<?php

namespace App\Repositories\Scan;

interface ScanRepositoryInterface {
    public function getDiseaseByName($disease);
    public function storeScanData($data, $userId);
    public function getDiseasesIdByName($disease);
}