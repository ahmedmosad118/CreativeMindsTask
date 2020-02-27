<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('user/login', 'UserController@login');
Route::post('user/verify-account', 'Api\User\ApiUserVerifyAccountController@verify_account');
Route::post('/user/user-registration', 'Api\User\ApiUserRegistrationController@user_registration');

Route::group([

    // 'middleware' => 'jwt.verify',
    'prefix' => 'user'

], function ($router) {

    Route::get('index', 'UserController@users_list');
    Route::get('delete-user/{id}', 'Api\User\ApiDeleteUserController@delete_user');
    Route::get('user-info/{id}', 'Api\User\ApiUserInfoController@user_info');
});
