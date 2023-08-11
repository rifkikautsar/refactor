<?php

namespace App\Services;

use App\Repositories\User\UserRepositoryInterface;
use App\Response\ApiResponse;

class UserService {
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    /**
     * get user data profile by user id
     * @param $user_id
     * @return mixed
     */
    public function getUserDataProfile($user_id) {
        $userData = $this->userRepository->getUserDataProfile($user_id);
        
        return ApiResponse::create(200, 'Success', $userData);
    }
}