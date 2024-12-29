<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Promotion;
use Illuminate\Http\Request;

class UIController extends Controller
{
    public function promotion()
    {
        $promoions = Promotion::all();
        
    }

    public function search(Request $request)
    {
        //dd($request->all());
        return view('search.searchrooms',);
    }


}
