<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UIController;
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
    return view('welcome');
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
    Route::get('/login','AuthController@loginForm')->name('login');
    Route::post('/login','AuthController@login');
    Route::get('/logout','AuthController@logout');
    Route::get('/forgot-password','AuthController@ForgotPasswordOtpForm')->name('forgot.password');
    Route::post('/forgot-password-Otp',[AuthController::class,'ForgotPasswordOtp'])->name('ForgotOtp.password');
    Route::post('/verify-otp',[AuthController::class,'verifyOtp']);
    Route::post('/verify-forgot-otp',[AuthController::class,'verifyForgotOtp'])->name('verifyforgot.otp');



    Route::controller(UIController::class)->group(function(){

    Route::post('/booking','booking');
    Route::post('/search','search');
    Route::post('/bookingform','bookingform');
    Route::post('/storebooking','storebooking');
    Route::get('/history/{id}','history');
    Route::get('/viewprofile/{id}','viewprofile');
    Route::post('/updateprofile','updateprofile');
    Route::get('/editprofile/{id}','editprofile');
    Route::get('/updateprofile','updateprofile');
    Route::post('/verifyotp','verifyOtp');
    Route::get('/changepassword/{id}','changepassword');
    Route::post('/updatepassword','updatepassword');

    });

});