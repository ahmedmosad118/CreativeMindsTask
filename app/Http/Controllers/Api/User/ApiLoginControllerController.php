<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Api\ApiController;
use Datatables;
use App\User;

class ApiLoginControllerController extends Controller
{
    public function login(Request $request)
    {
        # validation roles
        $rules = [
            "mobile_number"    => "required",
            "password"         => "required",
        ];

        # valdiation messages
        $messages = [];

        #return valdiation
        $validate = validator($request->all(), $rules, $messages);

        session()->forget("token");

        # auhtrized user and login
        $credentials = $request->only('mobile_number', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return ApiController::ApiResponse(null, ApiController::ErrorHandler("Unauthorized"), 401, "error");
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return ApiController::ApiResponse(null, 'could_not_create_token', 500, "error");
        }
        # chech if user not verified
        if (!Auth::user()->is_verified) {
            return ApiController::ApiResponse(compact('token'), ApiController::ErrorHandler("not_verified"), 422, "error");
        }
        # return success response
        return ApiController::ApiResponse(compact('token'), ApiController::ErrorHandler("getdata"), 200, "getdata");
    }
}
