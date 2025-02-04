<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\Promotion;
use App\Models\RoomPrice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\ViewServiceProvider;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $payments = Payment::all();

        return view('admin.payment.payment', compact('payments'));
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
        $request->validate([
            'booking_id' => 'required|integer|exists:bookings,id',
            'payment_type_id' => 'required|integer|exists:payment_types,id',
            'amount' => 'required|numeric|min:0',
        ]);

        $icommingAmount = $request->input('amount');

        $booking_id = request('booking_id');
        $booking = Booking::findOrFail($booking_id);

        $payment_type_id = $request->input('payment_type_id');

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

        // $promotion = Promotion::where('room_price_id', $roomPrice->id)
        //               ->whereDate('start_date', '<=', $booking->created_at) // Fixed 'create_at' to 'created_at'
        //               ->whereDate('end_date', '>=', $booking->created_at)
        //               ->first();

        $bookingDate = Carbon::parse($booking->created_at)->toDateString();

        $promotion = Promotion::where('room_price_id', $roomPrice->id)
            ->whereDate('start_date', '<=', $bookingDate)
            ->whereDate('end_date', '>=', $bookingDate)
            ->first();

        if ($promotion) {
            $discount = $promotion->discount;
        }

        $perDayPrice = $roomPrice->price - ($roomPrice->price * $discount);

        //Total Amount with discount
        $totalAmount = $days * $perDayPrice;

        $currentPaymentAmount = $booking->payments()->sum('amount') + $icommingAmount;

        $payment = new Payment();
        $payment->booking_id = $booking_id;
        $payment->payment_type_id = $payment_type_id;
        $payment->amount = $icommingAmount;

        if ($currentPaymentAmount == $totalAmount) {
            $payment->status = config('payment.status.complete');
        }
        $payment->save();

        return redirect()->back()->with('success', 'Payment confirmed successfully!');
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
