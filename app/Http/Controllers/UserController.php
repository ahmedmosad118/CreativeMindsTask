<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use JWTAuth;

class UserController extends Controller
{
    # set session in browser
    public function setSession(Request $request)
    {
        session()->forget("token");
        session()->put('token', $request->token);
        session()->save();

        return response()->json(['success' => session()->get("token")], 200);
    }

    # verification page
    public function verification()
    {
        $token = session()->get("token");
        $user = JWTAuth::toUser($token);
        $data["id"] = $user->id;
        return view('verification')->with($data);
    }
    # log out
    public function logout()
    {
        $token = session()->forget("token");
        Auth::logout();
        return redirect('/');
    }
}
