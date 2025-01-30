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
  <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
</head>
<body>

<div class=" container mb-3">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container bg-light d-flex ">

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

       {{-- <li class="nav-item pt-2 pl-3">
         <a class="nav-link fa fa-user pr-1" ></a><span class="text-white" style="font-size:15px">{{auth()->user()->name}}</span>
       </li>


       <li class="nav-item cta">
         <a class="nav-link" href="/logout"><span>Logout</span></a>
       </li> --}}

       <li class="nav-item d-flex align-items-center">
         <div class="dropdown ">
             <a class="" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 {{-- <li class="nav-item pt-2 pl-3 profile" onclick="menuToogle()"> --}}
                     <a class="nav-link fa fa-user pr-1"></a><span class="" style="font-size:15px">{{auth()->user()->name}}</span>
                   {{-- </li> --}}
             </a>
             <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
               {{-- <a class="dropdown-item" href="#"><i class="fa-regular fa-user fa-xs pr-1"></i>My Profile</a> --}}
               <a class="dropdown-item" href="/viewprofile/{{auth()->user()->id}}"><i class="fa-regular fa-pen-to-square fa-xs pr-1"></i>Profile</a>
               <a class="dropdown-item" href="/history/{{auth()->user()->id}}"><i class="fa fa-history fa-xs pr-1"></i>History</a>
               <a class="dropdown-item " href="/logout"><i class="fa-solid fa-reply fa-xs pr-1"></i>Logout</a>
             </div>
           </div>
       </li>





       @endauth
            </ul>
          </div>
        </div>
      </nav>
</div>

    <div class="container">
        <div class="row mt-5 justify-content-center">
            <div class="col-md-10">
                <h3>{{ $booking->name }}</h3>
                <p>category : {{ $booking->category->name }}</p>
            </div>
        </div>
        <div class="row no-gutters my-3 justify-content-center">
            <div class="col-md-5">
                <img class="d-block w-100 h-100" src="{{ $booking->featured_image }}" alt="">
            </div>
            <div class="col-md-5 d-flex">


                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">

                      <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ $booking->featured_image }}" alt="First slide">
                      </div>
                      @php
                      $gallery_photos = explode(',', $booking->gallery);
                      @endphp
                      @foreach ($gallery_photos as $photo)
                      <div class="carousel-item">
                        <img class="d-block w-100 h-50" src="{{ $photo }}" alt="">
                      </div>
                      @endforeach

                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                </div>

            </div>

        </div>


        <div class="row my-4 justify-content-center">
             <div class="col-md-12">
                 <table class="table table-bordered">
                 <thead>
                    <tr>
                        <th>Included Services</th>
                        <th>Price</th>
                        {{-- <th>Price Type</th> --}}
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

                                <td>{{ $roomPrice->price }} : {{$roomPrice->priceType->name}}</td>


                        @endforeach


                    <td>
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Extra Bed</label>
                      </div>
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
<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('js/jquery-migrate-3.0.0.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('js/jquery.stellar.min.js')}}"></script>

    <script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('js/magnific-popup-options.js')}}"></script>

    <script src="{{asset('js/main.js')}}"></script>
<script src="https://kit.fontawesome.com/a67197b46d.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>
