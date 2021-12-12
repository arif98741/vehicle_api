<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;


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

    /**
     * @return JsonResponse|Response
     */
    public function getAllCategories()
    {
        $categories = ServiceCategory::orderBy('category_name', 'asc')
            ->get();

        if ($categories->count() == 0) {
            return $this->sendError([], 'No category found');
        } else {
            return $this->sendResponse($categories, 'Fetched categories');
        }
    }

    /**
     * @param $id
     * @return JsonResponse|Response
     */
    public function getSingleCategory($id)
    {
        $serviceCategory = ServiceCategory::where('id', $id)
            ->first();

        if ($serviceCategory == null) {
            return $this->sendError([], 'No category found');
        } else {
            return $this->sendResponse($serviceCategory, 'Fetched category');
        }
    }

}
