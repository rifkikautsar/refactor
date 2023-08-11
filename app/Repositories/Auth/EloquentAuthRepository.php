<?php

namespace App\Repositories\Auth;

use App\Models\User;
use App\Repositories\Auth\AuthRepositoryInterface;

class EloquentAuthRepository implements AuthRepositoryInterface {
    
    /**
     * @param string $email
     * @return User
     */
    public function getUserLoginData($email) {
        $userData = User::join('informasi_kulit', 'users.user_id', '=', 'informasi_kulit.user_id')
        ->select('users.nama','users.email','users.jenisKelamin','users.tanggalLahir', 'informasi_kulit.*')
        ->where('email', $email)->first();

        return $userData;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function verifyPasswordLogin($data) {
        $userData = User::where('email', $data['email'])->first();

        if(!$userData){
            return false;
        }
        
        $isPasswordMatch = password_verify($data['pass'],$userData->pass);

        return $isPasswordMatch;
    }
}