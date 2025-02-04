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

    public function store(Request $request){
            $request->validate([
                'booking_id'       => 'required|integer|exists:bookings,id',
                'name'             => 'required|string|max:255',
                'email'            => 'required|email|max:255',
                'city'             => 'required|string|max:255',
                'nrc_or_passport'  => 'required|string|max:255',
                'country'          => 'required|string|max:255',
                'address'          => 'required|string|max:255',
            ]);
        
            // ✅ Create and save the guest
            $guest = new Guest();
            $guest->booking_id      = $request->booking_id;
            $guest->name            = $request->name;
            $guest->email           = $request->email;
            $guest->city            = $request->city;
            $guest->nrc_or_passport = $request->nrc_or_passport;
            $guest->country         = $request->country;
            $guest->address         = $request->address;
        
            // ✅ Set check-in time to now
           
            $guest->save();
        
            // ✅ Redirect with success message
            return redirect("/bookings/{$request->booking_id}/check")
            ->with('success', 'Guest Info is added successfully!');
        }
        
    }

