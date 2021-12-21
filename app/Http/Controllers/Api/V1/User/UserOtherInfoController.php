<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Helpers\FileUploadHelper;
use App\Http\Controllers\Api\V1\BaseController;
use App\Models\User\UserOtherInfo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserOtherInfoController extends BaseController
{
    /**
     * Get All User all Other info data
     * @return JsonResponse|Response
     */
    public function getUserAllOtherInfoData(Request $request)
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
    public function addUserOtherInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'award_info' => 'sometimes',
            'doc_or_link' => 'sometimes',
            'file' => 'sometimes',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Data validation error', $validator->errors());
        }

        $data = $validator->validated();
        if ($request->has('file')) {
            $allowedFiles = [
                'pdf', 'doc', 'docx', 'jpeg', 'jpg', 'gif', 'png', 'xlsx', 'csv'
            ];

            if (!in_array($request->file('file')->getClientOriginalExtension(), $allowedFiles)) {

                return $this->sendError('Selected file type is not supported to upload', $validator->errors());
            }

            $data['file'] = FileUploadHelper::fileUpload($request, 'user_file', 'user_file', $request->user_id);
        }

        if (UserOtherInfo::create($data)) {
            return $this->sendResponse([], 'User other info successfully added', 201);
        } else {
            return $this->sendError([], 'Failed to insert');
        }
    }

    /**
     * Edit User Other INfo
     * @return void
     * @throws ValidationException
     */
    public function editUserOtherInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'award_info' => 'sometimes',
            'doc_or_link' => 'sometimes',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Data validation error', $validator->errors());
        }

        $data = $request->only(['award_info', 'doc_or_link']);

        $existence = UserOtherInfo::where([
            'id' => $request->id,
            'user_id' => $request->user_id,
        ])->first();

        if ($existence == null) {
            return $this->sendError('No data found to update', []);
        }

        if ($request->has('file')) {
            $allowedFiles = [
                'pdf',
                'doc',
                'docx',
                'jpeg',
                'jpg',
                'gif',
                'png',
                'xlsx',
                'csv',
            ];

            if (File::exists($existence->file)) {
                File::delete($existence->file);
            }

            if (!in_array($request->file('file')->getClientOriginalExtension(), $allowedFiles)) {

                return $this->sendError('Selected file type is not supported to upload', $validator->errors());
            }

            $data['file'] = FileUploadHelper::fileUpload($request, 'user_file', 'user_file', $request->user_id);
        }

        UserOtherInfo::where([
            'id' => $request->id,
            'user_id' => $request->user_id,
        ])->update($data);

        return $this->sendResponse([], 'Acadmic data successfully updated');

    }

    /**
     * Delete User Other INfo
     * @return void
     * @throws ValidationException
     */
    public function deleteUserOtherInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Data validation error', $validator->errors());
        }


        $existence = UserOtherInfo::where([
            'id' => $request->id,
            'user_id' => $request->user_id,
        ])->first();

        if ($existence == null) {
            return $this->sendError('No data found to delete', []);
        }

        UserOtherInfo::where([
            'id' => $request->id,
            'user_id' => $request->user_id,
        ])->delete();

        return $this->sendResponse([], 'User other info successfully deleted');

    }
}
