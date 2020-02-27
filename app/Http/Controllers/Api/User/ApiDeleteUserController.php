<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ApiController;
use App\User;

class ApiDeleteUserController extends Controller
{
    public function delete_user(Request $request, $id)
    {
        User::where('id', $id)->delete();
        return ApiController::ApiResponse(null, ApiController::ErrorHandler("data_delete"), 200, "data_added");

    }
}
