<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Category;
use App\Models\Guest;
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
        $roomtype = RoomType::where('category_id', '=', $rooms)->get();
       //dd($roomtype->pluck('id'));

        $booking = Booking::whereIn('room_type_id',  $roomtype->pluck('id'))
        ->where('check_in', '!=', $request->checkIn)
        ->where('check_out', '!=', $request->checkOut)->get();
//dd($booking);
        $data = RoomType::whereIn('id',  $booking->pluck('room_type_id'))->get();
        //dd($data);
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
        // dd($request->all());
        $booking = Booking::create([
            'customer_id' => $request->customerId,
            'room_type_id' => $request->roomType_id,
            'qty' => $request->qty,
            "check_in" => $request->checkIn,
            "check_out" => $request->checkOut,
            "adult" => $request->adult,
            "child" => $request->child,
        ]);

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
