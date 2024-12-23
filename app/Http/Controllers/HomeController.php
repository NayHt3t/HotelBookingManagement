<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function home()
    {
        return view('layouts.index');
    }

    public function about()
    {
        return view('nav.about');
    }

    public function contact()
    {
        return view('nav.contact');
    }

    public function rooms()
    {
        return view('nav.rooms');
    }

    public function blog()
    {
        return view('nav.blog');
    }

}
