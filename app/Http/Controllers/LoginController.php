<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginValidation;
use App\Services\LoginService;

class LoginController extends Controller
{
    private $userLoginService;

    /**
     * LoginController constructor.
     * @param LoginService $userLoginService
     */
    public function __construct(LoginService $userLoginService) {
        $this->userLoginService = $userLoginService;
    }

    /**
     * @param UserLoginValidation $request
     * @return mixed
     */
    public function authUserLogin(UserLoginValidation $request){
        return $this->userLoginService->userLogin($request);
    }
}
