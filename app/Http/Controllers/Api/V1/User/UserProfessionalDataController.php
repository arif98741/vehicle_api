<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Api\V1\BaseController;
use App\Models\User\UserProfessionalData;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserProfessionalDataController extends BaseController
{
    /**
     * Get All Providers
     * @return JsonResponse|Response
     */
    public function getUserAllProfData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Data validation error', $validator->errors());
        }

        $userServices = UserProfessionalData::with(['user'])
            ->where('user_id', $request->user_id)
            ->get();

        if ($userServices->count() == 0) {
            return $this->sendError('No data found', []);
        } else {
            return $this->sendResponse($userServices, 'Fetched user professional data');
        }
    }

    /**
     * Add User Service
     * @return void
     * @throws ValidationException
     */
    public function addUserProfData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'license_no' => 'required',
            'year_of_experience' => 'sometimes',
            'speciality' => 'sometimes',
            'other_speciality' => 'sometimes',
            'personal_commitment' => 'sometimes',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Data validation error', $validator->errors());
        }

        $data = $validator->validated();

        $existence = UserProfessionalData::where([
            'user_id' => $request->user_id,
            'license_no' => $request->license_no,
        ])->first();

        if ($existence != null) {
            return $this->sendError('Professional data already exist', []);
        }

        if (UserProfessionalData::create($data)) {
            return $this->sendResponse([], 'User service successfully added');
        } else {
            return $this->sendError([], 'No user found');
        }
    }

    /**
     * Edit User Service
     * @return void
     * @throws ValidationException
     */
    public function editUserProfData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'user_id' => 'required',
            'license_no' => 'required',
            'year_of_experience' => 'sometimes',
            'speciality' => 'sometimes',
            'other_speciality' => 'sometimes',
            'personal_commitment' => 'sometimes',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Data validation error', $validator->errors());
        }

        $data = $validator->validated();

        $existence = UserProfessionalData::where([
            'id' => $request->id,
            'user_id' => $request->user_id,
        ])->first();

        if ($existence == null) {
            return $this->sendError('No data found to update', []);
        }

        UserProfessionalData::where([
            'id' => $request->id,
            'user_id' => $request->user_id,
        ])->update($data);

        return $this->sendResponse([], 'Service successfully updated');

    }

    /**
     * Delete User Service
     * @return void
     * @throws ValidationException
     */
    public function deleteUserProfData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Data validation error', $validator->errors());
        }


        $existence = UserProfessionalData::where([
            'id' => $request->id,
            'user_id' => $request->user_id,
        ])->first();

        if ($existence == null) {
            return $this->sendError('No data found to delete', []);
        }

        UserProfessionalData::where([
            'id' => $request->id,
            'user_id' => $request->user_id,
        ])->delete();

        return $this->sendResponse([], 'User professional data successfully deleted');

    }
}
