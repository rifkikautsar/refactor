<?php

namespace App\Repositories\User;

interface UserRepositoryInterface {
    public function storeUserAccount($data);
    public function getUserDataProfile($user_id);
    public function isUserRegistered($email);
}