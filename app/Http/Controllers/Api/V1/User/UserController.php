<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Api\V1\BaseController;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{
    /**
     * Get All Providers
     * @return JsonResponse|Response
     */
    public function getUsers()
    {
        $users = User::with('role')->whereIn('role_id', [3, 4])->get();

        if ($users == null) {
            return $this->sendError([], 'No user found');
        } else {
            return $this->sendResponse($users, 'Fetched user');
        }

    }

    /**
     * @return string
     */
    public function getUsersByRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role_name' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Data validation error', $validator->errors());
        }

        $users = User::with('role')
            ->whereHas('role', function ($query) use ($request) {
                $query->where('name', $request->role_name);
                $query->whereNotIn('id', [1,2,5]);
            })->get();

        if ($users == null) {
            return $this->sendError([], 'No user found');
        } else {
            return $this->sendResponse($users, 'Fetched user');
        }
    }

    /**
     * Get All Provider by Role
     * @return JsonResponse|Response
     */
    public function getSingleUser(Request $request, $id)
    {
        $user = User::with('role')->whereIn('role_id', [3])
            ->where('id', $id)
            ->first();

        if ($user == null) {
            return $this->sendError([], 'No user found');
        } else {
            return $this->sendResponse($user, 'Fetched user');
        }

    }
}
