<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\RoomType;
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


    public function rooms(Request $request)
    {
        $rooms = RoomType::paginate(9);
        return view('nav.rooms',['rooms'=>$rooms])->with('i',$request->input('page',-1)*5);
    }

    public function blog()
    {
        return view('nav.blog');
    }

}
