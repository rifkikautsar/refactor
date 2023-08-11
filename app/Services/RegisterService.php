<?php

namespace App\Services;

use App\Http\Requests\UserRegistrationValidation;
use App\Repositories\User\UserRepositoryInterface;
use App\Response\ApiResponse;

class RegisterService {
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    /**
     * This function will create user account
     * @param UserRegistrationValidation $request
     * @return mixed
     */
    public function createAccount(UserRegistrationValidation $request) {
        $data = $request->validated();

        $data['tanggalLahir'] = $this->formatDate($data['tanggalLahir']);

        $userRegistered = $this->userRepository->isUserRegistered($data['email']);

        if(!empty($userRegistered)) {
            return ApiResponse::create(400, 'Email sudah terdaftar', null);
        }

        $userRegistration = $this->userRepository->storeUserAccount($data);

        if($userRegistration === true) {
            return ApiResponse::create(200, 'Success', null);
        }

        return ApiResponse::create(400, 'Gagal mendaftar ', null);
    }

    /**
     * This function will format date from d-m-Y to Y-m-d
     */
    private function formatDate(string $date) {
        $formattedDate = date('Y-m-d',strtotime($date));

        return $formattedDate;
    }
}