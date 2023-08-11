<?php

namespace App\Http\Controllers;

use App\Services\ApiResponseService;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller {
    private $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    /**
     * Retrieve user data profile
     */
    public function getUserDataProfile($user_id) {
        $userDataProfile = $this->userService->getUserDataProfile($user_id);

        return $userDataProfile;
    }

    /**
     * Edit User Profile
     */
    public function editUserProfile(){
        
    }
}
