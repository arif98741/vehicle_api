<?php

namespace App\Http\Controllers\Api\V1\Provider;

use App\Http\Controllers\Api\V1\BaseController;
use App\Models\User;

class ProviderController extends BaseController
{
    /**
     * Get All Providers
     * @return void
     */
    public function getProviders()
    {
        $provider = User::with('role')->whereIn('role', [3, 4]);
        return $provider->get();

    }
}
