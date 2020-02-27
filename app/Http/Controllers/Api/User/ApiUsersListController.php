<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Datatables;
use App\User;
use App\Http\Controllers\Api\ApiController;

class ApiUsersListController extends Controller
{
    public function users_list(Request $request)
    {
        #  if request ajax return  datatable data
        if ($request->ajax()) {
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
        } else {
            $users = User::all();
            return ApiController::ApiResponse($users, ApiController::ErrorHandler("getdata"), 200, "getdata");

        }
    }
}
