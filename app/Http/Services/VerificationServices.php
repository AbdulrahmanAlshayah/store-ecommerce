<?php

namespace App\Http\Services;

use App\Models\User;
use App\Models\User_verfication;
use Illuminate\Support\Facades\Auth;


class VerificationServices
{
    /** set OTP code for mobile
     * @param $data
     *
     * @return User_verfication
     */
    public function setVerificationCode($data)
    {
        $code = mt_rand(100000, 999999);
        $data['code'] = $code;
        User_verfication::whereNotNull('user_id')->where(['user_id' => $data['user_id']])->delete();
        return User_verfication::create($data);
    }

}
