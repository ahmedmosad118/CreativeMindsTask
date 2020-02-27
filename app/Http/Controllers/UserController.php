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
