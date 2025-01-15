<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Category;
use App\Models\Guest;
use App\Models\Promotion;
use App\Models\RoomType;
use Carbon\Carbon;
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
        $checkin = Carbon::parse($request->checkin)->toDateString();
        $checkout = Carbon::parse($request->checkout)->toDateString();
       //dd($checkin,$checkout);
        $roomtype = RoomType::where('category_id', '=', $rooms)
        ->where('available_rooms','>',0)
        ->get();
       //dd($roomtype->pluck('id'));

        $booking = Booking::whereIn('room_type_id',  $roomtype->pluck('id'))
        ->whereBetween('check_in', [$checkin, $checkout])
        ->get();
        //dd($booking);
        
   $data = RoomType::whereIn('id',  $booking->pluck('room_type_id'))->get();

   
        //dd($data);
     // Fetch room types that do not have conflicting bookings and have available rooms
    //  $data = RoomType::where('category_id', $rooms)
    //  ->where('available_rooms', '>', 0) // Ensure rooms with availability
    //  ->get()
    //  ->filter(function ($room) use ($checkin, $checkout) {
    //       //Check if room has bookings that overlap the given date range
    //      $hasBookingConflict = Booking::where('room_type_id', $room->id)
    //          ->where(function ($query) use ($checkin, $checkout) {
    //              $query->whereBetween('check_in', [$checkin, $checkout])
    //                    ->orWhereBetween('check_out', [$checkin, $checkout])
    //                    ->orWhere(function ($q) use ($checkin, $checkout) {
    //                        $q->where('check_in', '<=', $checkin)
    //                          ->where('check_out', '>=', $checkout);
    //                    });
    //          })->exists();
    //          return !$hasBookingConflict || $room->available_rooms > 0;
    //         });
        
        return view('search.searchrooms',['data'=>$data]);
    }

    public function booking(Request $request)
    {
        // dd($request->all());
        $id = $request->roomType_id;
        $booking = RoomType::find($id);
        // dd($booking);
        // $booking = RoomType::where()
        return view('search.booking',['booking'=>$booking]);
    }

    public function bookingform(Request $request){
        $id = $request->roomType_id;
        $roomType = RoomType::find($id);
        return view('booking.form',['roomType'=>$roomType]);
    }

    public function storebooking(Request $request){
         dd($request->all());
        $booking = Booking::create([
            'customer_id' => $request->customerId,
            'room_type_id' => $request->roomType_id,
            'qty' => $request->qty,
            "check_in" => $request->checkIn,
            "check_out" => $request->checkOut,
            "adult" => $request->adult,
            "child" => $request->child,
        ]);

        $roomType = RoomType::find($request->roomType_id);
        $roomType->available_rooms = $roomType->num_rooms - $request->qty;
        $roomType->save();

        $guest = Guest::create([
            "booking_id" => $booking->id,
            "name" => $request->name,
            "nrc_or_passport" => $request->nrc,
            "email" => $request->email,
            "phone" => $request->phone,
            "address" => $request->address,
            "country" => $request->country
        ]);


    }


}
