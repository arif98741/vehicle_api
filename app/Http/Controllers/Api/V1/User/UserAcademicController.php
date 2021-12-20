<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Api\V1\BaseController;
use App\Models\User\UserAcademicInfo;
use App\Models\User\UserProfessionalData;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserAcademicController extends BaseController
{
    /**
     * Get All Providers
     * @return JsonResponse|Response
     */
    public function getUserAllAcadmicData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Data validation error', $validator->errors());
        }

        $userServices = UserAcademicInfo::where('user_id', $request->user_id)
            ->get();

        if ($userServices->count() == 0) {
            return $this->sendError('No data found', []);
        } else {
            return $this->sendResponse($userServices, 'Fetched user professional data');
        }
    }

    /**
     * Add User Academic Info
     * @return void
     * @throws ValidationException
     */
    public function addUserAcadmicData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'institute' => 'required',
            'major' => 'required',
            'passing_year' => "required|numeric|min:1920|digits_between: 4,4",
            'cgpa_grade' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Data validation error', $validator->errors());
        }

        $data = $validator->validated();

        $existence = UserAcademicInfo::where([
            'user_id' => $request->user_id,
            'institute' => $request->institute,
            'major' => $request->major,
        ])->first();

        if ($existence != null) {
            return $this->sendError('User academic data already exist', []);
        }


        if (UserAcademicInfo::create($data)) {
            return $this->sendResponse([], 'User academic data successfully added');
        } else {
            return $this->sendError([], 'Failed to insert');
        }
    }

    /**
     * Edit User Academic info
     * @return void
     * @throws ValidationException
     */
    public function editUserAcadmicData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'institute' => 'required',
            'major' => 'required',
            'passing_year' => "required|numeric|min:1920|digits_between: 4,4",
            'cgpa_grade' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Data validation error', $validator->errors());
        }

        $data = $validator->validated();

        $existence = UserAcademicInfo::where([
            'id' => $request->id,
            'user_id' => $request->user_id,
        ])->first();

        if ($existence == null) {
            return $this->sendError('No data found to update', []);
        }

        UserAcademicInfo::where([
            'id' => $request->id,
            'user_id' => $request->user_id,
        ])->update($data);

        return $this->sendResponse([], 'Acadmic data successfully updated');

    }

    /**
     * Delete User Service
     * @return void
     * @throws ValidationException
     */
    public function deleteUserAcadmicData (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Data validation error', $validator->errors());
        }


        $existence = UserAcademicInfo::where([
            'id' => $request->id,
            'user_id' => $request->user_id,
        ])->first();

        if ($existence == null) {
            return $this->sendError('No data found to delete', []);
        }

        UserAcademicInfo::where([
            'id' => $request->id,
            'user_id' => $request->user_id,
        ])->delete();

        return $this->sendResponse([], 'User academic data successfully deleted');

    }
}
