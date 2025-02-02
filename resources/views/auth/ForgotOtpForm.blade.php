<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Reset Password</title>
      <link rel="stylesheet" href="{{asset('css/login.css')}}">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   </head>
   <body>
      <div class="container">
         <h4>Please Enter Your Email To Send Otp</h4>
         <form action="{{route('ForgotOtp.password')}}" method="post">
            @csrf
            <div class="input-field">
            <input type="email" name="email" value="{{old('email')}}" placeholder="Enter Email " >
               
               @if ($errors->has('email'))

                  <span class="error">
                   {{$errors->first('email')}}
                     </span>

               @endif
            </div>

            <div class="input-field">
               <input class="pswrd" type="password" name="password" placeholder="Enter New Password" >
               <span class="show">SHOW</span>
               @if ($errors->has('password'))

                  <span class="error">
                  {{$errors->first('password')}}
                  </span>

                  @endif
            </div>

            
            <div class="button">
               <div class="inner"></div>
               <button type="submit">Reset</button>
            </div>
            

            
     
      
   </body>
</html>