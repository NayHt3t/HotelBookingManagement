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

  <body >


    
    <header role="banner">
     
      <nav class="navbar navbar-expand-md navbar-dark bg-light">
        <div class="container">
          <a class="navbar-brand" href="/">LuxuryHotel</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse navbar-light" id="navbarsExample05">
            <ul class="navbar-nav ml-auto pl-lg-5 pl-0">
              <li class="nav-item">
                <a class="nav-link active" href="/">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/rooms">Rooms</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/blog">Blog</a>
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

              <li class="nav-item pt-2 pl-3">
                <a class="nav-link fa fa-user pr-1" ></a><span class="text-white" style="font-size:15px">{{auth()->user()->name}}</span>
              </li>

              <li class="nav-item cta">
                <a class="nav-link" href="/logout"><span>Logout</span></a>
              </li>

              @endauth
            </ul>
            
          </div>
        </div>
      </nav>
    </header>
    <!-- END header -->

    <section class="site-hero overlay" data-stellar-background-ratio="0.5" style="background-image: url(images/big_image_1.jpg);">
      <div class="container">

      

        <div class="row align-items-center site-hero-inner justify-content-center">

       
       
    

          <div class="col-md-12 text-center">

            <div class="mb-5 element-animate">
              <h1>Welcome To Our Luxury Rooms</h1>
              <p>Discover our world's #1 Luxury Room For VIP.</p>
              
            </div>

           

          </div>