<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Api\ApiController;
use Datatables;
use App\User;

class UserController extends Controller
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
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        # chech if user not verified
        if (!Auth::user()->is_verified) {
            return ApiController::ApiResponse(null, ApiController::ErrorHandler("not_verified"), 422, "error");
        }
        # return success response
        return ApiController::ApiResponse(compact('token'), ApiController::ErrorHandler("getdata"), 200, "getdata");
    }

    # set session
    public function setSession(Request $request)
    {
        session()->forget("token");

        session()->put("token", $request->token);
        return response()->json(['success' => session()->get("token")], 200);
    }

    # user list api
    public function users_list(Request $request)
    {
        return Datatables::eloquent(User::query())
            ->addColumn('action', function ($row) {
                return '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-success edit-user">Edit
                        </a>
                        <a href="javascript:void(0);" id="delete-user" data-toggle="tooltip" data-original-title="Delete" data-id="' . $row->id . '"  class="delete btn btn-danger">
                            Delete
                        </a>';
            })

            ->rawColumns(['action' => 'action'])
            ->make(true);
    }
    # verification page
    public function verification()
    {
        $token = session()->get("token");
        $user = JWTAuth::toUser($token);
        $data["id"] = $user->id;
        return view('verification')->with($data);
    }
}
