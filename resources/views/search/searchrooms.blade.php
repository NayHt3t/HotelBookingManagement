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

<div class="container py-5">
<div class="card mb-3 p-4" style="max-width: 100%">
  <div class="row g-0 vh-100">
    <div class="col-md-4">
      <img src="{{asset('images/img_1.jpg')}}" class="img-fluid rounded-start" alt="...">
    </div>
    <div class="col-md-4">
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate, recusandae neque doloribus dolorum aut ipsam, officiis autem ratione maiores nesciunt quo pariatur doloremque quae modi commodi, ducimus dicta reiciendis debitis!</p>
    </div>
    <div class="col-md-4 d-flex align-items-end justify-content-end text-end ">
      
      
      <p>Price : 100$</p><br>

      <button class="btn btn-primary">Book</button>

      
  
      
    </div>
  </div>
</div>
</div>
  
</body>
<script src="https://kit.fontawesome.com/a67197b46d.js" crossorigin="anonymous"></script>
</html>
