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



    <header role="banner">

      <nav class="navbar navbar-expand-md navbar-dark bg-light">
        <div class="container">
          <a class="navbar-brand" href="/">LuxuryHotel</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse navbar-light" id="navbarsExample05">
            <ul class="navbar-nav ml-auto pl-lg-5 pl-0 nav justify-content-end align-items-center">
              <li class="nav-item">
                <a class="nav-link active" href="/">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/rooms">Rooms</a>
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
                            <a class="nav-link fa fa-user pr-1"></a><span class="text-white" style="font-size:15px">{{auth()->user()->name}}</span>
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
    </header>

    <!-- END header -->
