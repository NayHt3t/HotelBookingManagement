<?php

namespace App\Http\Controllers;

use App\Models\Customer;
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
       //  dd($request->all());
        $request->validate([
            "name" => "required",
            "email" => "required|unique:users,email",
            "password" => "required|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/",
            "profile" => "required",
            "confirm_password" => "required|same:password"
        ]);

        Session([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile' => $request->profile,
            'status' => 1,
        ]);


        $otp = rand(100000,999999);

        //Cache the otp for 5 minutes
        Cache::put('otp_' . $request->email, $otp, now()->addMinutes(5));
        //dd($otp);
        // Mail::raw("Your OTP is : $otp",function ($message) use ($request)
        // {

        //     $message->to($request->email)->subject("Your OTP For Login");
        //     //dd($message);


        // });

        Mail::send('auth.EmailOtp', ['otp' => $otp], function ($message) use ($request)
         {
            $message->to($request->email)->subject("Your OTP For Login");
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


            'otp' => 'required|numeric'
        ]);

        $request->merge([
            'name' => session('name'),
            'email' => session('email'),
            'password' => session('password'),
            'profile' => session('profile'),
            'status' => session('status')

        ]);

        //dd($request->all());

        $cachedOtp = Cache::get('otp_'.$request->email);

        if($cachedOtp != $request->otp)
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
            "profile" => session('profile'),
            "status" => session('status')

        ]);

        //$user = User::where('email',$request->email)->first();
        auth()->login($data);
        Cache::forget('otp_'.$request->email);
        //return response()->json(['message' => 'Registration Successful']);

        return redirect()->route('home')->with('success','Registration Successful');

    }

    public function ForgotPasswordOtpForm()
    {

        return view('auth.ForgotOtpForm');
    }

    public function ForgotPasswordOtp(Request $request)
    {
        //dd('reach here');
        $request->validate([

            "email" => "required|unique:users,email",
            "password" => "required|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/",

        ]);

        session([
            'email' => $request->email,
            'password' => $request->password
        ]);

        $otp = rand(100000,999999);

        //Cache the otp for 5 minutes
        Cache::put('otp_' . $request->email, $otp, now()->addMinutes(5));
        //dd($otp);

        Mail::send('auth.ForgotMail', ['otp' => $otp], function ($message) use ($request)
         {
            $message->to($request->email)->subject("Your OTP For Reset Password");
         });

       return view('auth.ForgotOtp');
    }

    public function verifyForgotOtp(Request $request)
    {
        //dd('reach here2');
        $request->validate([


            'otp' => 'required|numeric'
        ]);

        $request->merge([

            'email' => session('email'),
            'password' => session('password')


        ]);

        //dd($request->all());

        $cachedOtp = Cache::get('otp_'.session('email'));

       // dd($cachedOtp. "enter". $request->otp);

        if($cachedOtp != $request->otp)
        {
            return response()->json(['message' => 'Invalid or Expired OTP'],401);

        }

        $data = Customer::where('email',session('email'));

        if(!$data)
        {
            return back()->withErrors(['email' => 'Email Not Found']);
        }

        $data->update([

            "password" => Hash::make(session('password'))
        ]);

        //$user = User::where('email',$request->email)->first();

        Cache::forget('otp_'.session('email'));
        //return response()->json(['message' => 'Registration Successful']);

        return redirect()->route('login')->with('success', 'Password Reset Successful');

    }
}
