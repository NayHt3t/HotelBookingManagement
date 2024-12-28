<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Register</title>
      <link rel="stylesheet" href="{{asset('css/login.css')}}">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   </head>
   <body>
      <div class="container">
         <header>Register Form</header>
         <form action="/registration" method="post">
            @csrf
         <div class="input-field">
               <input type="text" name="name" placeholder="Enter User Name" >
               
               @if ($errors->has('name'))

                <span  class="error">
                    {{$errors->first('name')}}
                </span>
            
            @endif

            </div>
            <div class="input-field">
               <input type="text" name="email" placeholder="Enter Email">
                @if ($errors->has('email'))

                <span class="error">
                    {{$errors->first('email')}}
                </span>
            
            @endif
               
            </div>

            <div class="input-field otp-field" style="display: none;">
               <input type="text" id="otp" name="otp" placeholder="Enter OTP">
               <span id="otpError" class="error"></span>
            </div>

            <div class="input-field">
               <input class="pswrd" type="password" name="password" placeholder="Enter Password" >
               <span class="show">SHOW</span>
               @if ($errors->has('password'))

                  <span class="error">
                  {{$errors->first('password')}}
                  </span>

                  @endif
            </div>

            <div class="input-field">
               <input class="pswrd" type="password" name="confirm_password" placeholder="Confirm Password" >
               <span class="show">SHOW</span>

               @if ($errors->has('confirm_password'))

                  <span class="error">
                  {{$errors->first('confirm_password')}}
                  </span>

                  @endif
              
            </div>
            <div class="button" style="padding-top: 5px;">
               <div class="inner"></div>
               <button type="submit">REGISTER NOW</button>
            </div>
         </form>
         
         <div class="signup">
            Already have an account? <a href="/login">Login Now</a>
         </div>
      </div>
      <script>
         var input = document.querySelectorAll('.pswrd');
        // var input1 = document.querySelector('.pswrd1');
         var shows = document.querySelectorAll('.show');
         //var show1 = document.querySelector('.show1');

         shows.forEach((show,index) => {

            show.addEventListener('click',() =>{

               let inputs =input[index];
               if(inputs.type === "password"){
             inputs.type = "text";
             show.style.color = "#1DA1F2";
             show.textContent = "HIDE";
           }else{
             inputs.type = "password";
             show.textContent = "SHOW";
             show.style.color = "#111";
           }

            });
        
           
         
            
         });
         

         
      </script>
   </body>
</html>