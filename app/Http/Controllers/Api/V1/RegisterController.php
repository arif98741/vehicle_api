<?php

namespace App\Http\Controllers\Api\V1;

use App\Facades\AppFacade;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Data validation error', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);
        //$success['token'] = $user->createToken('MyApp')->accessToken; //this will be used on once
        if ($user) {

            $userData = User::find($user->id);
            $otp = rand(111111, 999999);
            $message = "Your verification code is $otp";
            $response = AppFacade::sendOtp($userData->phone, $message);
            if ($response == false) { //todo:: this will be true

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
     *
     * @return Response
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('TakeCareApp')->accessToken;
            $success['name'] = $user->name;

            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }

    /** Send Otp Again
     * @return void
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

        $otp = rand(111111, 999999);
        $message = "Your verification code is $otp";
        $response = AppFacade::sendOtp($userData->phone, $message);

        if ($response == false) { //todo:: this will be true
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
            return $this->sendResponse($success, 'Register otp resent');
        }

    }

}
