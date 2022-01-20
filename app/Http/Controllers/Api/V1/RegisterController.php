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
 * $time
 */

namespace App\Http\Controllers\Api\V1;

use App\Facades\AppFacade;
use App\Helpers\DataHelper;
use App\Models\Otp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends BaseController
{
    /**
     * User Registration
     *
     * @group Authentication
     * @header X-api-version
     * For registration, you should pass data and other parameters
     * @param Request $request
     * @return JsonResponse|Response|void
     * @version   v1.0.1
     */
    public function register(Request $request)
    {
        User::where([
            'phone' => $request->phone,
        ])->first();

        $validator = Validator::make($request->all(), [
            'full_name' => 'required|min:3|max:100',
            'email' => 'sometimes|email|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Data validation error', $validator->errors());
        }

        if (DataHelper::checkNumberValidity($request->phone) == false) {
            return $this->sendError('Invalid phone number', [
                'phone' => [
                    'provided phone number is invalid'
                ]
            ]);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);
        //  $success['token'] = $user->createToken('MyApp')->accessToken; //this will be used on once
        if ($user) {
            $userData = User::find($user->id);

            $success['user'] = $userData;
            if ($userData) {
                return $this->sendResponse($success, 'User register successful. Please check otp');
            } else {
                return $this->sendResponse($success, 'User register successful. Failed to send otp');
            }
        }

    }

    /**
     * Login api
     *
     * @group Authentication
     * @bodyParam phone string required Phone number. Example: 017XXXXXXXX
     * @bodyParam password string required Password of user. Example: test@example.com 
     * @return JsonResponse|Response
     * @response 200 {
     * "success": true,
     * "message": "User login successfully.",
     * "code": 200,
     * "data": {
     * "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNGU2MjkzYjk3NjgxMzgyMjM4OTIxYjQzNTlkYzRkN2YxNWJjODc5MDdjMTFjY2JkM2I0YzM3ODlmNjQyMDBkOTM0YjhmODNiYzgyNzkwNmEiLCJpYXQiOjE2NDI2NzM4NTguNjU1MzE5LCJuYmYiOjE2NDI2NzM4NTguNjU1MzI0LCJleHAiOjE2NDM5Njk4NTguNjQ4NTAxLCJzdWIiOiI0Iiwic2NvcGVzIjpbXX0.O5NNZdmSoqbwK2-wWg6rrAFtWaUUe9JnybMtuoHJBReohF0ois9N9-x7CzOPuX4aKmE61LlPsM6DbIm-yidvqfGOT73mVYoREwu2mISiqTUqsbu8mnq6Nsq6Z_rj21VbOp2-DqkWh86PPI5kpf-t_-pt1QlLAwveTVpefbnmUmfc49m-_aOnXDM2H6QKhXt9zVqlkj2tgFjKgfISqLGJ_iWxUvaHzCSNDMvp7K1Cu620rT5VXCBzDi5NIXuHaCQ7KOzoMT5m5Upb-kG0TjERWogVPUjP8sY4H5AY3PYGkmZfjaRFn6QDth2Fk1fl1-DQffDFsUzuzLvfnbplLr6LfHJnAJFUvsbQpYd_F8-yOcP0JmMn-_Q8P2gtLxD4kL_ofy4cPxi66h6Apc3IeN-7bqd059lmo2uBn_mAZYUdpT8Zo83PeM2ShioUlpUXCCtqnmN4N6R3w2whZfp0Qm-9-9Hy9uGbVb5eNS24rN1XZ27JveT7LRSMU213wqdiKIOOhBXTr3frz2MzXDEk7Fisx9BkzvrHBHbV0ES2mm2zZgha3GqTXw1qH7ENr_W4BClsJL0ArT_a-oifyBFIi_QNKzeNPz439hnSy6YLRKD-3O35ZizIh4u2i7kYpwm25gnxp01zj9PG4Mg0BVrP8OlSuZJyfPslXWmmtg6_NEEh1BY",
     * "user": {
     * "id": 4,
     * "full_name": "Ariful Islam",
     * "email": null,
     * "phone": "01750840217",
     * "email_verified_at": null,
     * "last_login": null,
     * "created_at": "2022-01-20T09:38:29.000000Z",
     * "updated_at": "2022-01-20T09:38:29.000000Z"
     * }
     * }
     * }
     */
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['phone' => $request->phone, 'password' => $request->password])) {
            $user = Auth::user();
            $tokenName = 'UserToken';
            $success['token'] = $user->createToken($tokenName)->accessToken;
            $success['user'] = $user;

            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Username or password not matched'], '401');
        }
    }

    /**
     * Send Otp Again
     * @param Request $request
     * @return JsonResponse|Response|void
     */
    public function resendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',

        ]);

        if ($validator->fails()) {
            return $this->sendError('Data validation error', $validator->errors());
        }

        $userData = User::where([
            'otp_verified' => 0,
            'phone' => $request->phone,
        ])->select('id', 'phone', 'otp_verified')->first();

        if ($userData == null) {
            return $this->sendError('Already verified or not exist', ['error' => '']);
        }


        $otpData = Otp::where([
            'purpose' => 'register',
            'purpose_id' => $userData->id,

        ])->select('sent', 'code', 'expiration')
            ->orderBy('id', 'desc')
            ->first();

        $sentTime = $otpData->sent;
        $nextSentTime = Carbon::createFromDate($sentTime)
            ->addMinute(1)
            ->format('Y-m-d H:i:s');
        if (Carbon::now() < $nextSentTime) {

            return $this->sendError('You can request otp after 1 minute', ['error' => 'Flood api request']);
        }


        $otp = rand(111111, 999999);
        $message = "$otp. Sincerely Takecare";
        $response = AppFacade::sendOtp($userData->phone, $message);

        if ($response == true) { //todo:: this will be true
            $data = [
                'sent' => Carbon::now(),
                'code' => $otp,
                'purpose' => 'register',
                'expiration' => Carbon::now()
                    ->addMinute(10)
                    ->format('Y-m-d H:i:s'),
                'purpose_id' => $userData->id
            ];

            Otp::where('purpose', 'register')
                ->where('purpose_id', $userData->id)
                ->delete();

            AppFacade::saveOtp($data);
            $success['user'] = $userData;
            return $this->sendResponse($success, 'Register otp resent');
        }

    }

    /**
     * verify otp for user
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'otp' => 'required|int|min:6',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Data validation error', $validator->errors());
        }

        $userData = User::where([
            'phone' => $request->phone,
        ])->select('id')->first();

        if ($userData == null) {
            return $this->sendError('Phone number not exist');
        }

        $otpData = Otp::where([
            'purpose' => 'register',
            'purpose_id' => $userData->id,
            'code' => $request->otp,
            'status' => 0,
        ])->orderBy('id', 'desc')->first();

        if ($otpData == null) {
            return $this->sendError('Otp is invalid');
        }

        User::where('id', $userData->id)
            ->update(['otp_verified' => 1]);
        Otp::where('id', $otpData->id)
            ->update(['status' => 1]);


        return $this->sendResponse([], 'Otp verification successful. You can login now');

        return $this->sendError('Unknown error');

    }

}
