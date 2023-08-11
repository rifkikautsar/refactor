<?php

namespace App\Repositories\PasswordReset;

interface PasswordResetRepositoryInterface {
    public function storeToken($email, $token);
    public function verifyToken($email, $token);
    public function newPassword($email, $password);
}