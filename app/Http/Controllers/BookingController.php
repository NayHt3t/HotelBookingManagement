<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\PaymentType;
use App\Models\Promotion;
use App\Models\RoomPrice;
use App\Models\RoomType;
use App\Models\Stay;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // Update the 'noti' status of all bookings to true
        Booking::query()->update(['noti' => true]);

        // Retrieve all bookings after updating
        $bookings = Booking::all();
        $paymenTypes = PaymentType::all();

        // $bookings = Booking::latest()->get();

        return view('admin.bookings.bookings', ['bookings' => $bookings, 'paymentTypes' => $paymenTypes]);
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
        //
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


    //cancel
    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = config('booking.status.cancel');
        $booking->save();

        // Redirect to the bookings page
        return redirect('/bookings')->with('success', 'Booking has been canceled successfully.');
    }

    public function check($id)
    {
        // Retrieve the booking with the given ID and its associated guests
        $booking = Booking::findOrFail($id);
        $guests = $booking->guests()->whereDoesntHave('stays')->get();
        $bookingGuests = $booking->guests();
        // Retrieve all stay data
        $stayInfos = Stay::whereIn('guest_id', $bookingGuests->pluck('id'))->get();
        $rooms = Room::where('room_type_id', $booking->room_type_id)
            ->where('assign_booking_id', $id)
            ->get();


        //For Payment
        $days = $booking->check_out->diffInDays($booking->check_in);
        //assume for price type
        $price_type_id = 1;
        $room_type_id = $booking->roomType->id;
        $discount = 0;

        $roomPrice = RoomPrice::where('room_type_id', $room_type_id)
            ->where('price_type_id', $price_type_id)
            ->first();

        if (!$roomPrice) {
            return redirect('/bookings')->with('unsuccess', 'RoomPrice is not Found .');
        }

        $promotion = Promotion::where('room_price_id', $roomPrice->id)
            ->whereDate('start_date', '<=', $booking->created_at) // Fixed 'create_at' to 'created_at'
            ->whereDate('end_date', '>=', $booking->created_at)
            ->first();

        if ($promotion) {
            $discount = $promotion->discount;
        }

        $perDayPrice = $roomPrice->price - ($roomPrice->price * $discount);

        //Total Amount with discount
        $totalAmount = $days * $perDayPrice;

        $currentAmount = $booking->payments()->sum('amount');

        return view('admin.bookings.check_booking', compact('guests', 'stayInfos', 'rooms', 'booking', 'totalAmount', 'currentAmount'));
    }

    public function checkIn($id)
    {


        $booking = Booking::findOrFail($id);


        // Convert check-in and check-out dates to Carbon instances
        $checkInDate = Carbon::parse($booking->check_in);
        $checkOutDate = Carbon::parse($booking->check_out);
        $currentDate = Carbon::now();

        if ($currentDate->between($checkInDate, $checkOutDate)) {
            $availableRooms = Room::where('status', config('roomType.status.available'))
                ->where('room_type_id', $booking->room_type_id)
                ->limit($booking->qty)
                ->get();

            foreach ($availableRooms as $room) {
                $room->assign_booking_id = $booking->id;
                $room->status = config('room.status.unavailable');
                $room->save();
            }

            $booking->status = config('booking.status.staying');
            $booking->save();

            $roomType = $booking->roomType; // Corrected relationship call

            // Get current room count for this room type
            $currentRoomCount = Room::where('room_type_id', $roomType->id)->count();
            $roomType->num_rooms = $currentRoomCount;

            // Get count of available rooms for this room type
            $availableRoomCount = Room::where('room_type_id', $roomType->id)
                ->where('status', config('room.status.available')) // Assuming status '1' means available
                ->count();

            $roomType->available_rooms = $availableRoomCount;

            // Update status based on room availability
            if ($availableRoomCount == 0) {
                $roomType->status = config('roomType.status.unavailable');
            } else {
                $roomType->status = config('roomType.status.available'); // Explicitly set to available
            }

            $roomType->save();
            return redirect('/bookings')->with('success', 'Rooms are assigned.');
        } else {
            return redirect('/bookings')->with('unsuccess', 'Check-in is only allowed between the booking dates.');
        }
    }

    public function checkOut($id)
    {

        $booking = Booking::findOrFail($id);
        $roomType = RoomType::findOrFail($booking->roomType->id);

        //reset Rooms Status
        $rooms = Room::where('assign_booking_id', $booking->id)->get();
        foreach ($rooms as $room) {
            $room->assign_booking_id = null;
            $room->status = config('room.status.available');
            $room->save();
        }

        //Reset RoomType 
        $currentRoomCount = Room::where('room_type_id', $roomType->id)->count();
        $roomType->num_rooms = $currentRoomCount;

        $availableRoomCount = Room::where('room_type_id', $roomType->id)
            ->where('status', 1)
            ->count();
        $roomType->available_rooms = $availableRoomCount;
        if ($availableRoomCount == 0) {
            $roomType->status = config('roomType.status.unavailable');
        }{
            $roomType->status = config('roomType.status.available');
        }
        $roomType->save();


        //Sure All guest check out
        $guests = $booking->guests;  // Assuming this is a relationship

        foreach ($guests as $guest) {
            $stayInfos = Stay::where('guest_id', $guest->id)
                ->whereNull('check_out')  // Only fetch stays without a check-out date
                ->get();

            foreach ($stayInfos as $stayInfo) {
                $stayInfo->check_out = now();  // Update check-out time
                $stayInfo->save();             // Save the updated stay record
            }
        }

        $booking->status = config('booking.status.checkout');
        $booking->save();

        return redirect('/bookings')->with('success', 'Booking Check Out.');
    }
}
