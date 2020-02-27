<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ApiController;
use Auth;
use App\User;

class ApiUserVerifyAccountController extends Controller
{
    public function verify_account(Request $request)
    {
        # validation roles
        $rules = [
            "id"                    => "required",
            "verification_code"     => "required",
        ];

        # valdiation messages
        $messages = [];

        #return valdiation
        $validate = validator($request->all(), $rules, $messages);
        if ($validate->fails()) {
            $error = implode(",", $validate->getMessageBag()->all());
            return ApiController::ApiResponse(null, $error, 422, "error");
        }

        $user = User::find($request->id);
        # if code is valid
        if ($user->verification_code == $request->verification_code) {
            $user->verification_code = null;
            $user->is_verified = 1;
            $save = $user->save();
            if ($save) {
                return ApiController::ApiResponse(null, ApiController::ErrorHandler("data_added"), 200, "data_added");
            }
        }
        return ApiController::ApiResponse(null, ApiController::ErrorHandler("invalid_verification"), 422, "error");
    }
}
