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

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container d-flex ">

      <a class="navbar-brand" href="#">Luxury Hotel</a>


    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>


    <div class="float-end py-2" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Room</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
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

    <div class="container mt-3">

        <div class="row my-3 justify-content-center">
            <div class="col-md-12">
                <form action="/storebooking" method="post">
                    @csrf
                    <div class="row my-3 justify-content-center">
                     <div class="col-md-6">

                        <div class="row">
                            <div class="col-md-6">

                                <label class=" form-label" for="">Name</label>
                                <input type="text" name="name" id="" class="form-control">

                            </div>

                            <div class="col-md-6">
                            <label class=" form-label" for="">NRC or Passport</label>
                            <input type="text" name="nrc" id="" class="form-control">
                            </div>
                        </div>

                        <div class="row my-3 justify-content-center">
                            <div class="col-md-6">
                            <label class=" form-label" for="">Email</label>
                            <input type="text" name="email" id="" class="form-control">
                            </div>
                            <div class="col-md-6">
                            <label class=" form-label" for="">Phone</label>
                            <input type="text" name="phone" id="" class="form-control">
                            </div>
                        </div>


                            <div class="">
                            <label class=" form-label" for="">Address</label>
                            <textarea name="address" rows="5" cols="4" id="" class=" form-control"></textarea>
                            </div>
                            <div class="">
                            <label class=" form-label" for="">Country</label>
                            <input type="text" name="name" id="" class="form-control">
                            </div>

                     </div>
                    </div>

                    <div class="row my-3 justify-content-center">
                        <div class="col-md-6">
                            <div class="row">
                            <div class=" col-md-6">
                                <label for="">Check In</label>
                                <input type="date" name="checkIn" class=" form-control">
                            </div>

                            <div class=" col-md-6">
                                <label for="">Check Out</label>
                                <input type="date" name="checkOut" class=" form-control">
                            </div>

                            </div>

                            <div class="">
                                <label for="">Number of Rooms</label>
                                <select name="qty" class=" form-control" id="">
                                    <option value=""></option>
                                    @for ($i=1; $i<=$roomType->num_rooms;$i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                <label class=" form-label" for="">Adult</label>
                                <input type="number" name="adult" id="" class="form-control">
                                </div>
                                <div class="col-md-6">
                                <label class=" form-label" for="">Child</label>
                                <input type="number" name="child" id="" class="form-control">
                                </div>
                            </div>
                            <input type="hidden" name="roomType_id" value="{{$roomType->id}}" id="">

                        </div>
                    </div>


                        <div class="row my-3 justify-content-center">
                            <div class=" col-md-6 d-flex justify-content-between">
                                <p></p>
                                <button type="submit" class="btn btn-primary">Book Now</button>

                            </div>
                        </div>


                </form>
            </div>
        </div>

    </div>


</body>
<script src="https://kit.fontawesome.com/a67197b46d.js" crossorigin="anonymous"></script>
</html>
