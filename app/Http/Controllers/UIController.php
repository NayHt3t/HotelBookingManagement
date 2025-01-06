<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Promotion;
use App\Models\RoomType;
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
        $rooms = $request->category;
        $data = RoomType::where('category_id', '=', $rooms)->get();
        //dd($data);
        return view('search.searchrooms',['data'=>$data]);
    }


}
