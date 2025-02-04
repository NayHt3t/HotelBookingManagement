<!DOCTYPE html>
<html>
<head>
    <title>Booking Information</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; text-align: center;">
    <div style="max-width: 500px; margin: 50px auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
        <h2 style="color: #333;">Your Booking is received!!</h2>
        <p style="font-size: 18px; color: #555;">Dear {{auth()->user()->name}},</p>
        <p style="font-size: 17px;">Thank you for booking your stay with Our LUXURYHOTEL.We are looking forward to your visit.</p>
        <p style="font-size: 17px; font-weight: bold;">Your booking details are as follows:</p>

        <h5>Booking ID - {{$booking->id}}</h5>
        <h5>Room Type - {{$roomType}}</h5>
        <h5>Check In - {{$booking->check_in}}</h5>
        <h5>Check Out - {{$booking->check_out}}</h5>
        @if ($promotions->isNotEmpty())
        @foreach ($promotions as $promotion)
        <h5>Promotion - {{$promotion->discount}}%</h5>
        @endforeach
        @else
        <h5>Promotion - 0.00%</h5>
        @endif


        <h5>Total Amount - {{$totalamount}}</h5>
        <span>(The rate provided is for one room only)</span><br>

        <small>If you have any questions please don't hesitate to contact us.</small>
        <hr>
        <p style="font-size: 14px; color: #888;">Thanks, <br>LUXURYHOTEL</p>
    </div>
</body>
</html>
