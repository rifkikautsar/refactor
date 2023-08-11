<?php

namespace App\Repositories\Auth;

interface AuthRepositoryInterface {
    public function getUserLoginData($email);
    public function verifyPasswordLogin($data);
}