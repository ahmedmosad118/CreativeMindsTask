<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {
    try {
        $token = session()->get("token");
        $user = JWTAuth::toUser($token);
        return view('/dashboard');
    } catch (Exception $e) {
        return view('login');
    }
});

Route::group([

    'middleware' => 'ViewAuthintication',

], function ($router) {

    Route::get('/users/users-list', function () {
        return view('users.users_list');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    });
});


Route::get('/setSession', 'UserController@setSession');
Route::get('/register', function () {
    return view('register');
});


Route::get('/verification', 'UserController@verification');
