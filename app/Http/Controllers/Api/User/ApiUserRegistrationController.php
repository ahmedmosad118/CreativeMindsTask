<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Api\ApiController;
use Auth;
use App\User;

class ApiUserRegistrationController extends Controller
{
    public function user_registration(Request $request)
    {
        # validation roles
        $rules = [
            "mobile_number"            => "required|unique:users|regex:/^(?=[+])(?=.*[0-9])(?!.*[()a-zA-Z-_!@#$&%*.]).{12,15}$/",
            "password"                 => "required|min:4|max:50",
            "username"                 => "required",
        ];

        # valdiation messages
        $messages = [
            'mobile_number.regex' => __('Phone number must start with + and should be a minimum of 12 and maximum of 15 characters'),

        ];

        #return valdiation
        $validate = validator($request->all(), $rules, $messages);
        if ($validate->fails()) {
            $error = implode(",", $validate->getMessageBag()->all());
            return ApiController::ApiResponse(null, $error, 422, "error");
        }
        #  save user data

        $st = new User;
        $st->username          = $request->username;
        $st->password          = $request->password;
        $st->mobile_number     = $request->mobile_number;
        $st->verification_code = rand(1000, 10000);
        $save = $st->save();
        # return response
        if ($save) {
            # call send sms function
            // $send_mobile_otp =  Apicontroller::send_mobile_opt($request->mobile_number, $st->verification_code);
            // if ($send_mobile_otp["code"] == 200) {
            // } else {
            //     return ApiController::ApiResponse(null, $send_mobile_otp["response"], 404, "error");
            // }
            $user = User::find($st->id);
            $token = JWTAuth::fromUser($user);
            return ApiController::ApiResponse(compact('token'), ApiController::ErrorHandler("data_added"), 200, "data_added");
        }
    }
}
