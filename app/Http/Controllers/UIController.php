<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Guest;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Category;
use App\Models\Customer;
// use App\Models\RoomType;
use App\Models\RoomType;
use App\Models\Promotion;
use App\Models\PaymentType;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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

        Session([
            'check_in' => $checkin,
            'check_out' => $checkout
        ]);

        $roomtype = RoomType::where('category_id', '=', $rooms)
            ->where('available_rooms', '>', 0)
            ->get();
        //    dd($roomtype->pluck('id'));

        // $booking = Booking::whereIn('room_type_id',  $roomtype->pluck('id'))
        // ->whereBetween('check_in', [$checkin, $checkout])
        // ->orWhereBetween('check_out', [$checkin, $checkout])
        // ->groupBy('room_type_id')->get();

        // $booking = Booking::select('room_type_id', DB::raw('COUNT(*) AS booking_count'))
        //     ->whereIn('room_type_id',  $roomtype->pluck('id'))
        //     ->whereBetween(DB::raw("check_in"), [$checkin, $checkout])
        //     ->whereBetween(DB::raw("check_out"), values: [$checkin, $checkout])
        //     ->groupBy('room_type_id')
        //     ->get();

        // //dd($booking);

        // $data = RoomType::whereIn('id',  $booking->pluck('room_type_id'))->get();

        $availableRooms = RoomType::select('room_types.id', 'room_types.name','room_types.featured_image','room_types.description',
        DB::raw('room_types.num_rooms - IFNULL(SUM(bookings.qty), 0) AS available_rooms'))
    ->leftJoin('bookings', function ($join) use ($checkin, $checkout) {
        $join->on('room_types.id', '=', 'bookings.room_type_id')
             ->where('bookings.check_in', '<', $checkout)
             ->where('bookings.check_out', '>', $checkin);
    })
    ->groupBy('room_types.id', 'room_types.name', 'room_types.num_rooms', 'room_types.featured_image', 'room_types.description')
    ->havingRaw('available_rooms > 0')
    ->get();
//dd($availableRooms);
    session([
        'availableRooms' => $availableRooms
    ]);
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

        return view('search.searchrooms', ['data' => $availableRooms]);
    }

    public function booking(Request $request)
    {

        if (Auth::check()) {
            // dd($request->all());
            $id = $request->roomType_id;
            $booking = RoomType::find($id);
            // dd($booking);
            // $booking = RoomType::where()
            return view('search.booking', ['booking' => $booking]);
        } elseif (Auth::guest()) {
            return view('auth.login1');
        }
    }


    public function viewrooms(Request $request)
    {
       // dd($request->all());
        $id = $request->roomType_id;
        $booking = RoomType::find($id);
        return view('search.viewrooms', ['booking' => $booking]);
    }


    public function bookingform(Request $request)
    {
        // dd($request->all());
        $id = $request->roomType_id;
        $extra_bed = $request->extra_bed;

        $availableRooms = session('availableRooms');

        //dd("this is a ".$availableRooms);

        $msg = '';
        if ($extra_bed == 1) {
            $msg = "included extra bed";
        } else {
            $msg = 'not included extra bed';
        }
        $roomType = RoomType::find($id);
        $paymentType = PaymentType::all();


        $promotions = DB::table('promotions')
        ->join('room_prices', 'promotions.room_price_id', '=', 'room_prices.id')
        ->join('room_types', 'room_prices.room_type_id', '=', 'room_types.id')
        ->where('room_types.id', $id)
        ->select('promotions.*')
        ->get();

        return view('booking.form', ['roomType' => $roomType, 'paymentType' => $paymentType,'promotions' => $promotions])->with('msg', $msg);
    }

    public function storebooking(Request $request)
    {


        //  dd($request->all());
        // dd(auth()->user()->id);


        $request->merge([
            "check_in" => session('check_in'),
            "check_out" => session('check_out')
        ]);


        $booking = Booking::create([
            'customer_id' => auth()->user()->id,
            'room_type_id' => $request->roomType_id,
            'qty' => $request->qty,
            "check_in" => session('check_in'),
            "check_out" => session('check_out'),
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

        $payment = Payment::create([
            "booking_id" => $booking->id,
            "payment_type_id" => $request->paymentType,
            "amount" => $request->amount
        ]);

        $promotions = DB::table('promotions')
        ->join('room_prices', 'promotions.room_price_id', '=', 'room_prices.id')
        ->join('room_types', 'room_prices.room_type_id', '=', 'room_types.id')
        ->where('room_types.id', $request->roomType_id)
        ->select('promotions.*')
        ->get();

        $totalamount = $request->amount;

        Mail::send('booking.booking_comfirm', ['payment' => $payment,'totalamount'=>$totalamount,'booking' => $booking,'promotions'=>$promotions,'customer'=> auth()->user()], function ($message) use ($request)
        {
           $message->to(auth()->user()->email)->subject("Booking Information");
        });

        return view('booking.success')->with('msg',"Your booking is pending. We will inform you later.");
    }

    public function history($id)
    {
        $user = Customer::findOrFail($id);
        $booking_history = Booking::where('customer_id', '=', $id)->get();
        return view('nav.history', ['user' => $user, 'booking_history' => $booking_history]);
    }

    public function viewprofile($id)
    {

        $user = Customer::findOrFail($id);
        return view('nav.viewprofile', ['user' => $user]);
    }

    public function editprofile($id)
    {
        $user = Customer::findOrFail($id);
        return view('nav.editprofile', ['user' => $user]);
    }

    public function updateprofile(Request $request)
    {
        // dd($id);
        // dd($request->all());
        $request->validate(
            [
                "name" => "required",
                "email" => "required",
                "password" => "required"
            ]
        );
        $user = Customer::findOrFail($request->id);

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'The current password is incorrect!!']);
        }

        Session([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 1,
        ]);

        if ($request->email != $user->email) {
            $otp = rand(100000, 999999);

            //Cache the otp for 5 minutes
            Cache::put('otp_' . $request->email, $otp, now()->addMinutes(5));
            //dd($otp);
            Mail::send('nav.updatemail', ['otp' => $otp], function ($message) use ($request)
            {
               $message->to($request->email)->subject("Your OTP For Update Profile");
            });

            // return response()->json(['message' => 'OTP Code Send To Your Email.Please Check!']);



            return view('nav.updateotp', ['id' => $request->id]);
        } else {

            $user = Customer::findOrFail($request->id);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            return view('nav.viewprofile', ['user' => $user])->with('success', 'Profile Update Successful!');
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
            // 'status' => session('status')
        ]);

        //dd($request->all());

        $cachedOtp = Cache::get('otp_'.session('email'));

        if ($cachedOtp != $request->otp) {
            return response()->json(['message' => 'Invalid or Expired OTP'], 401);
            // $token = $user->createToken('auth_token')->plainTextToken;

            // return response()->json([
            //     'message' => 'Login Successful',
            //     'token' => $token
            // ]);
        }

        $customer = Customer::findOrFail(auth()->user()->id);
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->save();

        $user = Customer::findOrFail(auth()->user()->id);

        //$user = User::where('email',$request->email)->first();
        auth()->login($customer);
        Cache::forget('otp_' . $request->email);
        //return response()->json(['message' => 'Registration Successful']);

        return view('nav.viewprofile', ['user' => $user])->with('success', 'Profile Update Successful!');
    }

    public function changepassword($id)
    {
        $user = Customer::findOrFail($id);
        return view('nav.changepassword', ['user' => $user]);
    }

    public function updatepassword(Request $request)
    {
        $request->validate(
            [
                "currentPw" => "required",
                "newPw" => "required|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/"
            ]
        );
        $user = Customer::findOrFail($request->id);

        if (!Hash::check($request->currentPw, $user->password)) {
            return back()->withErrors(['currentPw' => 'The current password is incorrect!!']);
        }

        $user->update([
            'password' => Hash::make($request->newPw)
        ]);

        return view('nav.viewprofile', ['user' => $user])->with('success', 'Profile Update Successful!');
    }
}
