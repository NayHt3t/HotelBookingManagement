<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function registerForm(){

        return view('auth.register1');
    }

    public function registration(Request $request)
    {
        //dd('pk');
        // dd($request->all());
        $request->validate([
            "name" => "required",
            "email" => "required|unique:users,email",
            "password" => "required|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/",
            "confirm_password" => "required|same:password"
        ]);

        Session([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 1,
        ]);



        $otp = rand(100000,999999);

        //Cache the otp for 5 minutes
        Cache::put('otp_' . $request->email, $otp, now()->addMinutes(5));
        //dd($otp);
        Mail::raw("Your OTP is : $otp",function ($message) use ($request)
        {

            $message->to($request->email)->subject("Your OTP For Login");
            //dd($message);


        });

       // return response()->json(['message' => 'OTP Code Send To Your Email.Please Check!']);



        return view('auth.otp');

        //return redirect('/');
    }

    public function loginForm()
    {
        return view('auth.login1');
    }

    public function login(Request $request)
    {
        $request->validate([
            "email" => "required",
            "password" => "required"
        ]);

        $credentials = $request->except('_token');

        if(Auth::attempt($credentials))
        {
            return redirect('/');
        }

        return redirect('/login');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/');
    }




    public function verifyOtp(Request $request)
    {

        $request->validate([
            'input1' => 'required|numeric|digits:1',
            'input2' => 'required|numeric|digits:1',
            'input3' => 'required|numeric|digits:1',
            'input4' => 'required|numeric|digits:1',
            'input5' => 'required|numeric|digits:1',
            'input6' => 'required|numeric|digits:1',
        ]);

        $request->merge([
            'name' => session('name'),
            'email' => session('email'),
            'password' => session('password'),
            'status' => session('status')
        ]);

        $otp = $request->input('input1') .
               $request->input('input2') .
               $request->input('input3') .
               $request->input('input4') .
               $request->input('input5') .
               $request->input('input6');


        //dd($request->all());

        $cachedOtp = Cache::get('otp_'.$request->email);

        if($cachedOtp != $otp)
        {
            return response()->json(['message' => 'Invalid or Expired OTP'],401);
            // $token = $user->createToken('auth_token')->plainTextToken;

            // return response()->json([
            //     'message' => 'Login Successful',
            //     'token' => $token
            // ]);
        }

        $data = Customer::create([

            "name" => session('name'),
            "email" => session('email'),
            "password" => session('password'),
            'status' => session('status')

        ]);

        //$user = User::where('email',$request->email)->first();
        auth()->login($data);
        Cache::forget('otp_'.$request->email);
        //return response()->json(['message' => 'Registration Successful']);

        return redirect()->route('home')->with('success','Registration Successful');

    }
}