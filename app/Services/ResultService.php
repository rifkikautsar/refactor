<?php

namespace App\Services;

use App\Repositories\Result\ResultRepositoryInterface;
use App\Response\ApiResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ResultService {
    private $resultRepository;

    public function __construct(ResultRepositoryInterface $resultRepository) {
        $this->resultRepository = $resultRepository;
    }

    /**
     * Get result scan by user id
     * 
     * @param int $userId
     */
    public function getResultScan($userId) {
        try {
            $resultData = $this->resultRepository->getResultScan($userId);

            return ApiResponse::create(200, 'Success', $resultData);
        } catch (ModelNotFoundException $exception) {
            $message = 'Error: ' . $exception->getMessage();

            return ApiResponse::create(400, $message, null);
        }
    }
}