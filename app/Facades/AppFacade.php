<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static AppSetting sendOtp($mobile, $message)
 * @method static AppSetting saveOtp(array $data)
 *
 * @see AppSetting
 */
class AppFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'TakeCareAppFacade';
    }
}
