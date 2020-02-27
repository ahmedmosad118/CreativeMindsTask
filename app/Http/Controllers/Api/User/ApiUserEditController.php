<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ApiController;
use App\User;

class ApiUserEditController extends Controller
{
    public function edit_user(Request $request)
    {

        $rules = [
            "mobile_number"            => "required|unique:users,id," . $request->id . "|regex:/^(?=[+])(?=.*[0-9])(?!.*[()a-zA-Z-_!@#$&%*.]).{12,15}$/",
            "username"                 => "required",
            "id"                       => "required",
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
        $st               =  User::find($request->id);
        $st->username     = $request->username;
        if ($request->has("password")) {
            $st->password      = $request->password;
        }
        $st->mobile_number = $request->mobile_number;
        $save = $st->save();

        # return response
        return ApiController::ApiResponse(null, ApiController::ErrorHandler("data_added"), 200, "data_added");
    }
}
