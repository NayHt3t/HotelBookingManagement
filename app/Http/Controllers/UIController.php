<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Customer;
use App\Models\RoomType;
use App\Models\Promotion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;

class UIController extends Controller
{
    public function promotion()
    {
        $promoions = Promotion::all();

    }

    public function search(Request $request)
    {


        // dd($request->all());
        $rooms = $request->category;
        $checkin = Carbon::parse($request->checkin)->toDateString();
        $checkout = Carbon::parse($request->checkout)->toDateString();
       //dd($checkin,$checkout);

        $roomtype = RoomType::where('category_id', '=', $rooms)
        ->where('available_rooms','>',0)
        ->get();
       dd($roomtype->pluck('id'));

        $booking = Booking::whereNotIn('room_type_id',  $roomtype->pluck('id'))
        ->whereBetween('check_in', [$checkin, $checkout])
        ->get();
        // dd($booking);



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

    public function history($id){
       $user = Customer::findOrFail($id);
       $booking_history = Booking::where('customer_id','=',$id)->get();
       return view('nav.history',['user'=>$user,'booking_history'=>$booking_history]);
    }

    public function viewprofile($id){

        $user = Customer::findOrFail($id);
        return view('nav.viewprofile',['user' => $user]);
    }

    public function editprofile($id){
        $user = Customer::findOrFail($id);
        return view('nav.editprofile',['user'=>$user]);
    }

    public function updateprofile(Request $request){
        // dd($id);
        // dd($request->all());
        $request->validate(
            [
                "name"=>"required",
                "email" =>"required",
                "password" => "required"
            ]);
        $user = Customer::findOrFail($request->id);

        if(!Hash::check($request->password,$user->password)){
            return back()->withErrors(['password' => 'The current password is incorrect!!']);
        }

        Session([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 1,
        ]);

        if($request->email != $user->email){
            $otp = rand(100000,999999);

        //Cache the otp for 5 minutes
        Cache::put('otp_' . $request->email, $otp, now()->addMinutes(5));
        //dd($otp);
        Mail::raw("Your OTP is : $otp",function ($message) use ($request)
        {

            $message->to($request->email)->subject("Your OTP For Login");
        });

       // return response()->json(['message' => 'OTP Code Send To Your Email.Please Check!']);



        return view('nav.updateotp',['id'=>$request->id]);

        }else{

            $user = Customer::findOrFail($request->id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

            return view('nav.viewprofile',['user'=>$user])->with('success','Profile Update Successful!');

        }





    }

    public function verifyOtp(Request $request)
    {
        // dd($request->all());


        $request->validate([


            'otp' => 'required|numeric'
        ]);

        $request->merge([
            'name' => session('name'),
            'email' => session('email'),
            'password' => session('password'),
            'status' => session('status')
        ]);

        //dd($request->all());

        $cachedOtp = Cache::get('otp_'.$request->email);

        if($cachedOtp != $request->otp)
        {
            return response()->json(['message' => 'Invalid or Expired OTP'],401);
            // $token = $user->createToken('auth_token')->plainTextToken;

            // return response()->json([
            //     'message' => 'Login Successful',
            //     'token' => $token
            // ]);
        }

        $customer = Customer::findOrFail($request->id);
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->save();

        $user = Customer::findOrFail($request->id);

        //$user = User::where('email',$request->email)->first();
        auth()->login($customer);
        Cache::forget('otp_'.$request->email);
        //return response()->json(['message' => 'Registration Successful']);

        return view('nav.viewprofile',['user'=>$user])->with('success','Profile Update Successful!');

    }

    public function changepassword($id){
        $user = Customer::findOrFail($id);
        return view('nav.changepassword',['user' => $user]);
    }

    public function updatepassword(Request $request){
        $request->validate(
            [
                "currentPw" => "required",
                "newPw" => "required|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/"
            ]);
        $user = Customer::findOrFail($request->id);

        if(!Hash::check($request->currentPw,$user->password)){
            return back()->withErrors(['currentPw' => 'The current password is incorrect!!']);
        }

        $user->update([
            'password' => Hash::make($request->newPw)
        ]);

        return view('nav.viewprofile',['user'=>$user])->with('success','Profile Update Successful!');
    }


}
