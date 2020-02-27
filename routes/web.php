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
    return view('login');
});

// Route::get('/', function () {
//     if (Auth::check()) {
//         return redirect()->guest('/user/users-list');
//     }
//     return view('login');
// });
Route::get('/users/users-list', function () {
    return view('users.users_list');
});

Route::get('/users/users-list', function () {
    return view('users.users_list');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::get('/verification', 'UserController@verification');

Route::get('/setSession', 'UserController@setSession');
