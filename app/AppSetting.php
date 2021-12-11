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
     * @return void
     */
    public function sendOtp($mobile, $message)
    {
        $defaultSMSProvider = Config::get('sms.default_provider');
        $response = SMS::shoot($mobile, $message);
        if ($defaultSMSProvider == 'Xenon\LaravelBDSms\Provider\Ssl') {
            $responseObject = $response->getData();
            $responseObject = json_decode($responseObject->response);
            if ($responseObject->status_code == 200) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
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
