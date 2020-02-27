<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ApiController;
use App\User;


class ApiUserInfoController extends Controller
{
    public function user_info(Request $request, $id)
    {
        # get data
        $user = User::find($id);
        return ApiController::ApiResponse($user, ApiController::ErrorHandler("getdata"), 200, "getdata");
    }

}
