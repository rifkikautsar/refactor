<?php

namespace App\Services;

use App\Http\Requests\UserLoginValidation;
use App\Repositories\Auth\AuthRepositoryInterface;
use App\Response\ApiResponse;

class LoginService {
    private $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository) {
        $this->authRepository = $authRepository;
    }
    
    /**
     * @param UserLoginValidation $request
     * @return ApiResponse
     */
    public function userLogin(UserLoginValidation $request) {
        $data = $request->validated();
        
        $isPasswordMatch = $this->authRepository->verifyPasswordLogin($data);

        if($isPasswordMatch === true){
            $userLogin = $this->authRepository->getUserLoginData($data['email']);

            return ApiResponse::create(200, 'Success', $userLogin);
        }

        return ApiResponse::create(400, 'Email dan Password tidak cocok', null);
    }
}