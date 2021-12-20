<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Api\V1\BaseController;
use App\Models\User\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserServiceController extends BaseController
{
    /**
     * Get All Providers
     * @return JsonResponse|Response
     */
    public function getUserAllServices(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Data validation error', $validator->errors());
        }

        $userServices = UserService::with(['service', 'user'])
            ->where('user_id', $request->user_id)
            ->get();

        if ($userServices == null) {
            return $this->sendError([], 'No service found');
        } else {
            return $this->sendResponse($userServices, 'Fetched services');
        }
    }

    /**
     * Add User Service
     * @return void
     * @throws ValidationException
     */
    public function addUserService(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'service_id' => 'required',
            'service_price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Data validation error', $validator->errors());
        }

        $data = $validator->validated();

        $existence = UserService::where([
            'user_id' => $request->user_id,
            'service_id' => $request->service_id,
        ])->first();

        if ($existence != null) {
            return $this->sendError('Service already exist', []);
        }


        if (UserService::create($data)) {
            return $this->sendResponse([], 'User service successfully added');
        } else {
            return $this->sendError([], 'No user found');
        }
    }

    /**
     * Add User Service
     * @return void
     * @throws ValidationException
     */
    public function editUserService(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'user_id' => 'required',
            'service_id' => 'required',
            'service_price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Data validation error', $validator->errors());
        }


        $existence = UserService::where([
            'id' => $request->id,
            'user_id' => $request->user_id,
        ])->first();

        if ($existence == null) {
            return $this->sendError('No service found to update', []);
        }

        UserService::where([
            'id' => $request->id,
            'user_id' => $request->user_id,
        ])->update([
            'service_price' => $request->service_price,
            'service_id' => $request->service_id
        ]);

        return $this->sendResponse([], 'Service successfully updated');

    }
}
