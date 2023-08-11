<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegistrationValidation;
use App\Services\RegisterService;

class RegisterController extends Controller
{
    private $userRegistrationService;

    /**
     * RegisterController constructor.
     * @param RegisterService $userRegistrationService
     */
    public function __construct(RegisterService $userRegistrationService) {
        $this->userRegistrationService = $userRegistrationService;
    }

    /**
     * @param UserRegistrationValidation $request
     * @return mixed
     */
    public function createUserAccount(UserRegistrationValidation $request) {
        $userAccount = $this->userRegistrationService->createAccount($request);

        return $userAccount;
    }
}
