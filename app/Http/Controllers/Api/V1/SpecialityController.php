<?php
/*
 * Copyright (c) 2021.
 * This file is originally created and maintained by Ariful Islam.
 * You are not allowed to modify any parts of this code or copy or even redistribute
 * full or small portion to anywhere. If you have any question
 * fee free to ask me at arif98741@gmail.com.
 * Ariful Islam
 * Software Engineer
 * https://github.com/arif98741
 */

namespace App\Http\Controllers\Api\V1;

use App\Models\Speciality;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class SpecialityController extends BaseController
{
    /**
     * @return JsonResponse|Response
     */
    public function index()
    {
        $specialities = Speciality::orderBy('speciality_name', 'asc')->get();

        if ($specialities->count() == 0) {
            return $this->sendError( 'No speciality found');
        } else {
            return $this->sendResponse($specialities, 'Fetched specialities');
        }
    }
}
