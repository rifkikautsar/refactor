<?php

namespace App\Http\Controllers;

use App\Services\PasswordResetService;
use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\VerifyTokenRequest;
use App\Http\Requests\NewPasswordRequest;


class PasswordResetController extends Controller {
    private $passwordResetService;

    public function __construct(PasswordResetService $passwordResetService) {
        $this->passwordResetService = $passwordResetService;
    }

    /**
     * 
     * Generate token and send to users email.
     * 
     */
    public function sendToken(PasswordResetRequest $request) {
        return $this->passwordResetService->sendToken($request);
    }

    /**
     * 
     * Verify token and return user.
     * 
     */
    public function verifyToken(VerifyTokenRequest $request) {
        return $this->passwordResetService->verifyToken($request);
    }

    /**
     * 
     * Set new password.
     * 
     */
    public function newPassword(NewPasswordRequest $request) {
        return $this->passwordResetService->newPassword($request);
    }
}