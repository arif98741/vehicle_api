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

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Api\V1\BaseController;
use App\Models\Speciality;
use App\Models\User;
use App\Models\User\UserSpeciality;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserSpecialityController extends BaseController
{
    /**
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function getSpecialities(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Data validation error', $validator->errors());
        }
        $userSpecialities = User::with(['specialities'])->where('id',$request->user_id)->get();

        if ($userSpecialities->count() == 0) {
            return $this->sendError('No data found');
        } else {
            return $this->sendResponse($userSpecialities, 'Fetched user other info');
        }

    }

    /**
     * @param Request $request
     * @return JsonResponse|Response
     * @throws ValidationException
     */
    public function addSpeciality(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'speciality_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Data validation error', $validator->errors());
        }

        $providerOrSeekerCount = User::where('id', $request->user_id)->whereIn('role_id', [3, 4])->count();
        if ($providerOrSeekerCount == 0) {
            return $this->sendError("Provided user id $request->user_id does not exist in system");
        }

        $specialityCount = Speciality::where('id', $request->speciality_id)->count();
        if ($specialityCount == 0) {
            return $this->sendError("Provided speciality id $request->speciality_id does not exist in system");
        }

        $existence = UserSpeciality::where([
            'user_id' => $request->user_id,
            'speciality_id' => $request->speciality_id,
        ])->first();

        if ($existence != null) {
            return $this->sendError('User speciality already exist');
        }

        $data = $validator->validated();
        if (UserSpeciality::create($data)) {
            return $this->sendResponse([], 'User speciality successfully added', 201);
        } else {
            return $this->sendError([], 'Failed to insert');
        }
    }
}
