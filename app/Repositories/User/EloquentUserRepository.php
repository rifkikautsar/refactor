<?php

namespace App\Repositories\User;

use App\Models\Skin;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EloquentUserRepository implements UserRepositoryInterface {

    /**
     * 
     * Store user account to table users and table skin.
     * 
     */
    public function storeUserAccount($data) {
        DB::beginTransaction();
        
        try {
            $user = User::create([
                'nama' => $data['nama'],
                'email' => $data['email'],
                'jenisKelamin' => $data['jenisKelamin'],
                'tanggalLahir' => $data['tanggalLahir'],
                'pass' => Hash::make($data['pass']),
                'aktif' => '0',
                'status' => '0'
            ]);
            Skin::create([
                'user_id' => $user->id,
                'jenisKulit' => $data['jenisKulit'],
                'keluhan' => $data['keluhan']
            ]);
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            return $e->getMessage();
        }
    }

    /**
     * 
     * Get user information.
     * 
     */
    public function getUserDataProfile($user_id){
        $userData = User::join('informasi_kulit', 'users.user_id', '=', 'informasi_kulit.user_id')
        ->select('users.nama','users.email','users.jenisKelamin','users.tanggalLahir', 'informasi_kulit.*')
        ->where('users.user_id', $user_id)->first();
        return $userData;
    }

    public function isUserRegistered($email) {
        return User::where('email', $email)->first();
    }

}