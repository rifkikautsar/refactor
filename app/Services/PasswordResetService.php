<?php

namespace App\Services;

use App\Services\Service;
use App\Response\ApiResponse;
use App\Repositories\PasswordReset\PasswordResetRepositoryInterface;

class PasswordResetService {
    private $resetPasswordRepository;

    public function __construct(PasswordResetRepositoryInterface $resetPasswordRepository) {
        $this->resetPasswordRepository = $resetPasswordRepository;
    }

    /**
     * 
     * Store token to database.
     */
    private function storeToken(string $email, string $token) {
        $storeToken = $this->resetPasswordRepository->storeToken($email, $token);
        
        return $storeToken;
    }

    /**
     * 
     * Send email with token.
     */
    private function sendEmailWithToken(string $token, string $email) {
        MailService::resetPassword($token, $email);

        return ApiResponse::create(200, "Token telah dikirim. Silakan cek Email", null);
    }

    /**
     * 
     * Check token expired time.
     */
    private static function tokenExpiredTime($createdTime) {
        $currentTime = strtotime(Service::currentTime());
        
        $isExpired = $currentTime - $createdTime;
        
        //token expired in 1 hour (3600 s)
        $expiredTime = 3600;
        
        if($isExpired > $expiredTime){
            return true;
        }

        return false;
    }
    
    /**
     * 
     * Send token to email.
     */
    public function sendToken(object $request) {
        $request->validated();

        $email = $request->email;
        $token = Service::generateToken();

        $storeToken = $this->storeToken($email, $token);

        if(empty($storeToken)){
            return ApiResponse::create(200, "Token Gagal disimpan", null);
        }
        
        return $this->sendEmailWithToken($token, $email);
    }

    /**
     * 
     * Verify token and return user.
     * 
     */
    public function verifyToken(object $request) {
        $request->validated();

        $email = $request->email;
        $token = $request->token;
        
        $tokenData = $this->resetPasswordRepository->verifyToken($email, $token);
        
        if(empty($tokenData)) {
            return ApiResponse::create(200, "Data not found", null);
        }
        
        $createdTime = strtotime($tokenData->created_at);

        $isExpired = self::tokenExpiredTime($createdTime);
        
        if($isExpired!==true){
            return ApiResponse::create(200, "Token Expired", null);
        }

        return ApiResponse::create(200, "Verified", null);
    }

    /**
     * 
     * Set new password.
     */
    public function newPassword(object $request) {
        $request->validated();

        $email = $request->email;
        $password = $request->password;

        $newPassword = $this->resetPasswordRepository->newPassword($email, $password);
        
        if(!empty($newPassword)){
            return ApiResponse::create(200, "Password Gagal diupdate", null);
        }

        return ApiResponse::create(200, "Password Berhasil diupdate", null);
    }
}