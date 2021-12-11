<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Image;
use Session;

class ServiceController extends BaseController
{
    /**
     * @return Application|Factory|View
     */
    public function getSingleService($id)
    {
        $serviceData = Service::where('id', $id)
            ->with(['service_category'])
            ->first();

        if ($serviceData == null) {
            return $this->sendError([], 'No service found');
        } else {
            return $this->sendResponse($serviceData, 'Fetched service');
        }


    }

    /**
     * @return JsonResponse|Response
     */
    public function getAllService()
    {
        $serviceData = Service::with(['service_category'])
            ->get();

        if ($serviceData == null) {
            return $this->sendError([], 'No service found');
        } else {
            return $this->sendResponse($serviceData, 'Fetched service');
        }
    }

}
