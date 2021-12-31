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
use Illuminate\Support\Str;

class RegisterController extends BaseController
{
    /**
     * Register api
     * @param Request $request
     * @return JsonResponse|Response|void
     */
    public function register(Request $request)
    {
        $preRegistered = User::where([
            'phone' => $request->phone,
        ])->first();

        if ($preRegistered != null && $preRegistered->otp_verified == 0) {

            $otpData = Otp::where([
                'purpose' => 'register',
                'purpose_id' => $preRegistered->id,

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
            $response = AppFacade::sendOtp($preRegistered->phone, $message);
            if ($response == true) {

                $data = [
                    'sent' => Carbon::now(),
                    'code' => $otp,
                    'purpose' => 'register',
                    'expiration' => Carbon::now()
                        ->addMinute(10)
                        ->format('Y-m-d H:i:s'),
                    'purpose_id' => $preRegistered->id
                ];
                AppFacade::saveOtp($data);
            }

            return $this->sendError('Phone number already exist without verifying otp; New otp sent. check inbox');
        } else if ($preRegistered != null && $preRegistered->otp_verified == 1) {
            return $this->sendError('Phone number already registered');
        }

        $validator = Validator::make($request->all(), [
            'full_name' => 'required|min:3|max:100',
            'email' => 'sometimes|email|unique:users',
            'phone' => 'required',
            'role' => 'required|int',
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


        if (!in_array($request->role, [3, 4])) {
            return $this->sendError('Role must be 3 or 4; 3 Refers to provider and 4 refers to seeeker', [
                'role' => [
                    'role entry error'
                ]
            ]);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['user_slug'] = Str::slug($input['full_name']) . rand(11111, 99999);
        $input['role_id'] = $request->role;

        $user = User::create($input);
        //  $success['token'] = $user->createToken('MyApp')->accessToken; //this will be used on once
        if ($user) {

            $userData = User::find($user->id);

            $otp = rand(111111, 999999);
            $message = "$otp. Sincerely Takecare";
            $response = AppFacade::sendOtp($userData->phone, $message);
            if ($response == true) {

                $data = [
                    'sent' => Carbon::now(),
                    'code' => $otp,
                    'purpose' => 'register',
                    'expiration' => Carbon::now()
                        ->addMinute(10)
                        ->format('Y-m-d H:i:s'),
                    'purpose_id' => $userData->id
                ];


                AppFacade::saveOtp($data);
                $success['user'] = $userData;
                return $this->sendResponse($success, 'User register successful. Please check otp');
            } else {
                $success['user'] = $userData;
                return $this->sendResponse($success, 'User register successful. Failed to send otp');
            }
        }

    }

    /**
     * Login api
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['phone' => $request->phone, 'password' => $request->password, 'otp_verified' => 1])) {
            $user = Auth::user();

            $tokenName = '';
            if ($user->role_id == 1) {
                $tokenName = 'TakeCareApp';
            } else if ($user->role_id == 3 || $user->role == 4) {
                $tokenName = 'UserToken';
            }

            $success['token'] = $user->createToken($tokenName)->accessToken;
            $success['user'] = $user;

            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Username or password not matched']);
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
