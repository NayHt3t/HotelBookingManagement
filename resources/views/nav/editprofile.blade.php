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
    <form action="/updateprofile" method="POST">
        @csrf
        <div class="mt-5 shadow">

            <div class="card shadow m-auto p-4" style="width: 30rem; box-shadow: 5px 8px 8px #888888;">
                <input type="hidden" name="id" value="{{$user->id}}">

                <div class=" row">

                    <label for="" class="form-label">Name :</label>
                    <input type="text" name="name" class="form-control" value="{{old('name',$user->name)}}">
                    @error('name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class=" row">

                    <label for="" class="form-label">Email :</label>
                    <input type="email" name="email" class="form-control" value="{{old('email',$user->email)}}">
                    @error('email')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class=" row">

                    <label for="" class="form-label">Enter Your Password :</label>
                    <input type="password" name="password" class="form-control">
                    @error('password')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="card-body d-flex justify-content-between ">


                    <a href="/viewprofile/{{$user->id}}" class="btn-sm btn-primary border-0 text-white">Back</a>
                    <button type="submit"  class="btn-sm btn-primary border-0 text-white">Update</button>

                </div>
              </div>
        </div>
    </form>




    <script src="{{asset('js/bootstrap.min.js')}}"></script>
  </body>
</html>
