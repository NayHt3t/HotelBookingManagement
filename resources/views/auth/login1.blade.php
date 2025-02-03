<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Login</title>
      <link rel="stylesheet" href="{{asset('css/login.css')}}">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   </head>
   <body>

   @if(session('success'))
   <script>
      document.addEventListener("DOMContentLoaded", function() {
         Swal.fire({
            title: "Success",
            text: "{{ session('success') }}",
            icon: "success",
            confirmButtonText: "OK"
         });
      });
   </script>
   @endif

      <div class="container">
         <header>Login Form</header>
         <form action="/login" method="post">
            @csrf
            <div class="input-field">
            <input type="email" name="email" value="{{old('email')}}" placeholder="Enter Email" >
               
               @if ($errors->has('email'))

                  <span class="error">
                   {{$errors->first('email')}}
                     </span>

               @endif
            </div>

            

            <div class="input-field">
               <input class="pswrd" id="pswrd" type="password" name="password" placeholder="Enter Password" >
               <span class="show" id="show">SHOW</span>
               @if ($errors->has('password'))

                  <span class="error">
                  {{$errors->first('password')}}
                  </span>

                  @endif
            </div>

            <div class="forgot-password">

            <a href="{{route('forgot.password')}}">Forget Password?</a>

            </div>

            <div class="button">
               <div class="inner"></div>
               <button type="submit">LOGIN</button>
            </div>
         </form>
         <div class="auth">
            Or login with
         </div>
         <div class="links">
            <div class="facebook">
               <i class="fab fa-facebook-square"><span>Facebook</span></i>
            </div>
            <div class="google">
               <i class="fab fa-google-plus-square"><span>Google</span></i>
            </div>
         </div>
         <div class="signup">
            Not a member? <a href="/register">Signup now</a>
         </div>
      </div>


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


   </body>
</html>