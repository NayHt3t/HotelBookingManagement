<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function registerForm(){

        return view('auth.register');
    }

    public function registration(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required|unique:users,email",
            "password" => "required|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/",
            "confirm_password" => "required|same:password"
        ]);

        $data = User::create([

            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)

        ]);

        auth()->login($data);

        return redirect('/');
    }

    public function loginForm()
    {
        return view('auth.login');
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
}
