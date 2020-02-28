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




# authrized route group
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

# unauthrized route group

Route::group([

    'middleware' => 'UnAuthrizedUsers',

], function ($router) {


    Route::get('/', function () {
        return view('login');
    });
    Route::get('/verification', 'UserController@verification');

    Route::get('/register', function () {
        return view('register');
    });
});


Route::get('/setSession', 'UserController@setSession');
Route::get('/logout', 'UserController@logout');
