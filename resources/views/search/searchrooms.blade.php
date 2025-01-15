<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search</title>

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

<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container bg-light d-flex ">

    <a class="navbar-brand" href="/">LuxuryHotel</a>




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



@forelse ($data as $rooms )

<form action="/booking" method="post">
  @csrf
<div class="container py-2">
<div class="card shadow mb-3 p-4 "style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); " style="max-width: 100%">
  <div class="row g-0 vh-100">
    <div class="col-md-4">
      <img src="{{$rooms->featured_image}}" class="img-fluid rounded-start" alt="...">
    </div>

    <div class="col-md-4">
      <h3>{{$rooms->category_name}}</h3>
      <h4>{{$rooms->name}}</h4>
      <p>{{$rooms->description}}</p>
      <p>{{"Available Rooms : ".$rooms->avaliable_rooms}}</p>
    </div>
    <input type="hidden" name="roomType_id" value="{{$rooms->id}}">

    <div class="col-md-4 position-relative">

      <div class="position-absolute " style="bottom: 10px; right: 10px">
      <p>Price : 100$</p><br>
    @if ($rooms->num_rooms == 0)
    <button type="submit" class="btn btn-danger">Book Now</button>
    @else
    <button type="submit" class="btn btn-primary">Book Now</button>
    @endif
      </div>

    </div>

  </div>
</div>
</div>
</form>
@empty

<div class="col-md-12 heading-wrap text-center">
  <h2 class="heading text-black-50">There is no rooms available now......</h2>
</div>

@endforelse

</body>
<script src="https://kit.fontawesome.com/a67197b46d.js" crossorigin="anonymous"></script>
</html>
