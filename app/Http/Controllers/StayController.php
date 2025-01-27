<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Stay;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class StayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     // Validate the incoming request
    $request->validate([
        'guest_id' => [
            'required',
            'exists:guests,id', // Ensures guest_id exists in the guests table
            Rule::unique('stays', 'guest_id'), // Ensures guest_id is unique in the stays table
        ],
        'room_id' => 'required|exists:rooms,id',  // Ensures room_id exists in the rooms table
        'days' => 'required|integer|min:1',      // Number of days must be at least 1
    ], [
        // Custom error message
        'guest_id.unique' => 'This guest already has a stay record.',
    ]);

    // Create a new Stay record
    $stay = Stay::create([
        'guest_id' => $request->guest_id,       // ID of the guest
        'room_id' => $request->room_id,         // ID of the room
        'days' => $request->days,               // Number of days for the stay
        'start_date' => Carbon::now()->toDateString(), // Current date (start date)
    ]);

    $booking = Booking::findOrFail($request->booking_id);
    $booking->status = config('booking.status.staying');
    $booking->save();

    // Redirect or respond with success message
    return redirect()->back()->with('success', 'Stay record created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
