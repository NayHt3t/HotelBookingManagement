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
               <input class="pswrd" id="pswrd" type="password" name="password" placeholder="Enter New Password" >
               <span class="show" id="show">SHOW</span>
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
   <script>
   document.addEventListener('DOMContentLoaded', function () {
       var passwordField = document.getElementById('pswrd');
       var togglePassword = document.getElementById('show');

       if (passwordField.value === "") {
           togglePassword.style.visibility = "hidden";
       }

       passwordField.addEventListener('input', function () {
           if (passwordField.value === '') {
               togglePassword.style.visibility = 'hidden';
           } else {
               togglePassword.style.visibility = 'visible';
           }
       });

       togglePassword.addEventListener('click', function () {
           if (passwordField.type === "password") {
               passwordField.type = "text";
               togglePassword.style.color = "#1DA1F2";
               togglePassword.textContent = "HIDE";
           } else {
               passwordField.type = "password";
               togglePassword.textContent = "SHOW";
               togglePassword.style.color = "#111";
           }
       });
   });
</script>
</html>