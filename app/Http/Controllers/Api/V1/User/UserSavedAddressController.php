<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Api\V1\BaseController;
use App\Models\User\SavedAddress;
use App\Models\User\UserOtherInfo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserSavedAddressController extends BaseController
{
    /**
     * Get All User all saved address
     * @return JsonResponse|Response
     */
    public function getUserAllSavedAddresses(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Data validation error', $validator->errors());
        }

        $userServices = SavedAddress::where('user_id', $request->user_id)
            ->get();

        if ($userServices->count() == 0) {
            return $this->sendError('No data found', []);
        } else {
            return $this->sendResponse($userServices, 'Fetched User saved address');
        }
    }

    /**
     * Add User saved address
     * @return JsonResponse|Response
     * @throws ValidationException
     */
    public function addUserSavedAddress(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'beneficiary_name' => 'required',
            'user_id' => 'required',
            'district' => 'required',
            'city' => 'required',
            'postcode' => 'sometimes',
            'lon' => 'sometimes',
            'lat' => 'sometimes',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Data validation error', $validator->errors());
        }

        $data = $validator->validated();
        if (SavedAddress::create($data)) {
            return $this->sendResponse([], 'User saved address successfully added', 201);
        } else {
            return $this->sendError([], 'Failed to insert');
        }
    }

    /**
     * Edit User saved address
     * @return JsonResponse|Response
     * @throws ValidationException
     */
    public function editUserSavedAddress(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'user_id' => 'required',
            'beneficiary_name' => 'required',
            'district' => 'required',
            'city' => 'required',
            'postcode' => 'sometimes',
            'lon' => 'sometimes',
            'lat' => 'sometimes',
        ]);


        if ($validator->fails()) {
            return $this->sendError('Data validation error', $validator->errors());
        }

        $existence = SavedAddress::where([
            'user_id' => $request->user_id,
            'id' => $request->id,
        ])->first();

        if ($existence == null) {
            return $this->sendError('No saved address found to update');
        }

        SavedAddress::where([
            'id' => $request->id,
            'user_id' => $request->user_id,
        ])->update($request->only(['beneficiary_name',
            'district',
            'city',
            'postcode',
            'lon',
            'lat']));

        return $this->sendResponse([], 'User saved address successfully updated');

    }

    /**
     * Delete User saved address
     * @return JsonResponse|Response
     * @throws ValidationException
     */
    public function deleteUserSavedAddress(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Data validation error', $validator->errors());
        }


        $existence = SavedAddress::where([
            'id' => $request->id,
            'user_id' => $request->user_id,
        ])->first();


        if ($existence == null) {
            return $this->sendError('No data found to delete');
        }

        SavedAddress::where([
            'id' => $request->id,
            'user_id' => $request->user_id,
        ])->delete();

        return $this->sendResponse([], 'User saved address successfully deleted');

    }
}
