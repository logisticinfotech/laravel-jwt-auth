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
    return view('welcome');
});

Route::get('block-user/{id}',function($id){
    $data = App\User::where('id',$id)->update(['is_blocked'=>"block"]);
    return view('welcome');
});
Route::get('unblock-user/{id}',function($id){
    $data = App\User::where('id',$id)->update(['is_blocked'=>"active"]);
    return view('welcome');
});
// Route::get('user/verify/{verification_code}', 'AuthController@verifyUser');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.request');
Route::post('password/reset', 'Auth\ResetPasswordController@postReset')->name('password.reset');
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
