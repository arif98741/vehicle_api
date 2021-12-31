<?php

namespace App;

use App\Models\Otp;
use Illuminate\Support\Facades\Config;
use Xenon\LaravelBDSms\Facades\SMS;

/**
 * This app setting class mainly refers to the facade inside Facades/AppFacade
 */
class AppSetting
{
    /**
     * @param $mobile
     * @param $message
     * @return bool
     */
    public function sendOtp($mobile, $message): bool
    {
        if (env('sms_otp_local') == 1) //this will alwa
            return true;

        $defaultSMSProvider = Config::get('sms.default_provider');
        SMS::shoot($mobile, $message);
        return true;
    }

    /** save otp
     * @param array $data
     * @return void
     */
    public function saveOtp(array $data)
    {
        Otp::create($data);
    }
}
