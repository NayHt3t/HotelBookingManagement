<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search</title>
  <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-danger">
  <div class="container bg-warning d-flex ">
    
      <a class="navbar-brand" href="#">Luxury Hotel</a>

   
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
   
    
    <div class="float-end py-2" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/rooms">Room</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/about">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/contact">Contact</a>
        </li>
        @guest
               <li class="nav-item cta">
                <a class="nav-link" href="/register"><span>register</span></a>
              </li>
              <li class="nav-item cta">
                <a class="nav-link" href="/login"><span>Login</span></a>
              </li>
              @endguest

              @auth

              <li class="nav-item pt-1 pl-3">
                <a class="nav-link fa fa-user pr-1" ></a><span class="text-dark" style="font-size:15px">{{auth()->user()->name}}</span>
              </li>

              <li class="nav-item cta">
                <a class="nav-link" href="/logout"><span>Logout</span></a>
              </li>

              @endauth
      </ul>
    </div>
  </div>
</nav>

    <div class="container mt-2">
        <div class="row">
            
        </div>

        <div class="row">

        

        <div class="col-md-10 m-auto">

        <table class="table table-hover table-bordered">

        <thead>
            <tr>
                <th>Included Services</th>
                <th>Price</th>
                <th>Extra Bed</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                @php
                $facilities = explode(',', $booking->facilities);
                @endphp
                <td>
                    <ul>
                @foreach ($facilities as $facility)

                <li>{{$facility}}</li>
                
                @endforeach
                </ul>
                </td>

                @foreach ($booking->roomPrices as $roomPrice)
                    <td>{{ $roomPrice->price }}</td>
                @endforeach
               <td>
                <button class="btn btn-sm btn-secondary">add extra bed</button>
               </td>
               <td>
                <form action="/bookingform" method="post">
                    @csrf
                    <input type="hidden" value="{{$booking->id}}" name="roomType_id">
                    <button class="btn btn-sm btn-primary">Book Now</button>
                </form>
               </td>
            </tr>
        </tbody>
            
        </table>

        </div>

        </div>
            
    </div>

  
</body>
<script src="https://kit.fontawesome.com/a67197b46d.js" crossorigin="anonymous"></script>
</html>
