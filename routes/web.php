<?php

use Illuminate\Support\Facades\Route;

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
    return view('dashboard');
});

Route::prefix('admin')->group(function() {

    Route::resource('/categories', CategoryController::class);
    Route::resource('/room-types', RoomTypeController::class);
    Route::resource('/rooms', RoomController::class);


});

// Route::get('/otp', function () {
//     return view('auth.otp');
// });



Route::group(['namespace'=>'App\Http\Controllers'],function(){

    Route::get('/','HomeController@home')->name('home');
    Route::get('/about','HomeController@about');
    Route::get('/contact','HomeController@contact');
    Route::get('/blog','HomeController@blog');
    Route::get('/rooms','HomeController@rooms');
    Route::get('/register','AuthController@registerForm');
    Route::post('/registration','AuthController@registration');
    Route::get('/login','AuthController@loginForm');
    Route::post('/login','AuthController@login');
    Route::get('/logout','AuthController@logout');
    Route::post('/verify-otp',[AuthController::class,'verifyOtp']);


});