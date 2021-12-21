<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Helpers\FileUploadHelper;
use App\Http\Controllers\Api\V1\BaseController;
use App\Models\User\UserAddress;
use App\Models\User\UserOtherInfo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserAddressController extends BaseController
{
    /**
     * Get All User all Other info data
     * @return JsonResponse|Response
     */
    public function getUserAllAddresses(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Data validation error', $validator->errors());
        }

        $userServices = UserOtherInfo::where('user_id', $request->user_id)
            ->get();

        if ($userServices->count() == 0) {
            return $this->sendError('No data found', []);
        } else {
            return $this->sendResponse($userServices, 'Fetched user other info');
        }
    }

    /**
     * Add User Other info
     * @return void
     * @throws ValidationException
     */
    public function addUserAddress(Request $request)
    {
        $validator = Validator::make($request->all(), [
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


        $existence = UserAddress::where([
            'user_id' => $request->user_id,
        ])->first();

        if ($existence != null) {
            return $this->sendError('User address already exist');
        }

        $data = $validator->validated();
        if (UserAddress::create($data)) {
            return $this->sendResponse([], 'User address successfully added', 201);
        } else {
            return $this->sendError([], 'Failed to insert');
        }
    }

    /**
     * Edit User Address
     * @return JsonResponse|Response
     * @throws ValidationException
     */
    public function editUserAddress(Request $request)
    {
        $validator = Validator::make($request->all(), [
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

        $existence = UserAddress::where([
            'user_id' => $request->user_id,
        ])->first();

        if ($existence == null) {
            return $this->sendError('No address found to update');
        }

        UserAddress::where([
            'user_id' => $request->user_id,
        ])->update($request->only(['district',
            'city' ,
            'postcode',
            'lon' ,
            'lat' ]));

        return $this->sendResponse([], 'User address successfully updated');

    }

    /**
     * Delete User Other INfo
     * @return void
     * @throws ValidationException
     */
    public function deleteUserAddress(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Data validation error', $validator->errors());
        }


        $existence = UserAddress::where([
            'user_id' => $request->user_id,
        ])->first();


        if ($existence == null) {
            return $this->sendError('No data found to delete');
        }

        UserAddress::where([
            'user_id' => $request->user_id,
        ])->delete();

        return $this->sendResponse([], 'User address successfully deleted');

    }
}
