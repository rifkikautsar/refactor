<?php

namespace App\Services;

use App\Repositories\Diseases\DiseasesRepositoryInterface;
use App\Services\Service;
use Illuminate\Database\QueryException;
use Exception;
use App\Response\ApiResponse;

class DiseasesService {
    private $diseasesRepository;

    public function __construct(DiseasesRepositoryInterface $diseasesRepository) {
        $this->diseasesRepository = $diseasesRepository;
    }

    /**
     * get diseases data from database
     * @return mixed
     */
    public function getDiseases() {
        $diseases = $this->diseasesRepository->getDiseases();

        return ApiResponse::create(200, 'Success', $diseases);
    }

    /**
     * insert diseases data to database
     * @param object $request
     * @return mixed
     */
    public function createDiseases(object $request) {
        try{
            $data = $request->validated();
            
            //Store image and return a unique name
            $uploadedImageName = Service::handleUploadedImage($data['image'], 'articles');

            //Replace image name with a unique name
            $data['image'] = $uploadedImageName;

            $this->diseasesRepository->storeDiseases($data);

            return ApiResponse::create(200, 'Success', null);

        } catch (QueryException $e) {
            // Handle database-related exceptions
            $message = 'Database Error: ' . $e->getMessage();

            return ApiResponse::create(500, $message, null);
        } catch (Exception $e) {
            // Handle other exceptions
            $message = 'Error: ' . $e->getMessage();

            return ApiResponse::create(500, $message, null);
        }
    }
}