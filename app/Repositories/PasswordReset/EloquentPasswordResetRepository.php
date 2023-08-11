<?php

namespace App\Repositories\PasswordReset;

use App\Models\PasswordReset;
use App\Models\User;

class EloquentPasswordResetRepository implements PasswordResetRepositoryInterface {

    /**
     * 
     * Generate token and send to users email.
     */
    public function storeToken($email, $token) {
        PasswordReset::create([
            'email' => $email,
            'token' => $token
        ]);

        $storeToken = PasswordReset::where('email',$email)->firstOrFail();

        return $storeToken;
    }

    /**
     * 
     * Verify token and return user.
     */
    public function verifyToken($email, $token) {
        $isVerified = PasswordReset::select('email', 'token', 'created_at', 'updated_at')->where('email', $email)->firstOrFail();
        return $isVerified;
    }

    /**
     * 
     * Set new password.
     */
    public function newPassword($email, $password) {
        $hashPasswd = password_hash($password, PASSWORD_DEFAULT);
        $newPassword = User::where('email', $email)->update(['pass' => $hashPasswd]);
        
        return $newPassword;
    }
}