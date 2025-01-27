<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{

    //
    public function index()
    {

       $guests = Guest::all();
        return view('admin.guests.guests', compact('guests'));
    }
}
