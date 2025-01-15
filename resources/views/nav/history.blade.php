<!doctype html>
<html lang="en">
  <head>
    <title>Hotel Sedo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700,900|Rubik:300,400,700" rel="stylesheet">


    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">

    <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">

    <!-- Theme Style -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
  </head>

  <body>
<div class="container mb-5">
    <h3>{{$user->name}}'s Booking History</h3>
    <table class="table table-striped">
        <thead>
            <tr>
            <td>Booking ID</td>
            <td>Room Type</td>
            <td>Quantity</td>
            <td>Check In</td>
            <td>Check Out</td>
            </tr>

        </thead>
        <tbody>
            @foreach ($booking_history as $history)
            <tr>
            <td>{{$history->id}}</td>
            <td>{{$history->roomType->name}}</td>
            <td>{{$history->qty}}</td>
            <td>{{$history->check_in}}</td>
            <td>{{$history->check_out}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="/" class="btn-sm btn-primary border-0 text-white">Back</a>

</div>

<script src="{{asset('js/bootstrap.min.js')}}"></script>
</body>
</html>

