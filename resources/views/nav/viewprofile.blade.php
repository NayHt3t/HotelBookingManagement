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
    <div class="mt-5 shadow">

        @if (session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif

        <div class="card shadow m-auto p-4" style="width: 30rem; box-shadow: 5px 8px 8px #888888;">

            <div class=" row">

                <div class="col-md-6"><p>Name :</p></div>
                <div class="col-md-6"><p>{{$user->name}}</p></div>

            </div>
            <div class=" row">

                <div class="col-md-6"><p>Email :</p></div>
                <div class="col-md-6"><p>{{$user->email}}</p></div>

            </div>

            <div class="card-body d-flex justify-content-between ">

                <a href="/" class="btn-sm btn-primary border-0 text-white">Back</a>
                <a href="/editprofile/{{$user->id}}" class="btn-sm btn-primary border-0 text-white">Edit Profile</a>
                <a href="/changepassword/{{$user->id}}" class="btn-sm btn-primary border-0 text-white">Change Password</a>

            </div>
          </div>
    </div>






    <script src="{{asset('js/bootstrap.min.js')}}"></script>
  </body>
</html>
