<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use App\Mail\MyMail;
use App\Mail\ResetMail;

class MailService {

    /**
     * send verification email
     * @param $token
     * @param $to
     */
    public static function verification($token, $to){
        $details = [
        'token' => $token 
        ];
        Mail::to($to)->send(new MyMail($details));
    }

    /**
     * send reset password email
     * @param $token
     * @param $to
     */
    public static function resetPassword($token, $to){
        $details = [
        'token' => $token 
        ];
        Mail::to($to)->send(new ResetMail($details));
    }
}