<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/otp.css')}}">
    <title>Otp </title>
</head>
<body >

<form action="/verify-otp" method="post">
    @csrf
   

            <section >
  <div class="title">OTP</div>
  <div >

    <img src="otp.jpg" alt="" height="200px">

  </div>
  <h4>Expired In : <span id="countdown"></span></h4>

  <div class="title">Verification Code</div>
  <p>We have sent a verification code to your Email</p>

  <div class="input-field otp-field" >
    <input type="text" id="otp" name="otp" class="form-control" style="width: 200px;" placeholder="Enter OTP">
    <span id="otpError" class="error"></span>
 </div>
 
  <button type="submit" id="SendOtp">Verify</button>
</section>


</form>



<script>
    function startCountdown(minutes) {
        let seconds = minutes * 60;
        let countdownElement = document.getElementById('countdown');

        function updateCountdown() {
            let minutesLeft = Math.floor(seconds / 60);
            let secondsLeft = seconds % 60;
            countdownElement.textContent = `${minutesLeft}m ${secondsLeft}s`;

            if (seconds > 0) {
                seconds--;
                setTimeout(updateCountdown, 1000);
            } else {
                countdownElement.textContent = "Time's up!";
            }
        }

        updateCountdown();
    }

    startCountdown(5); // Set countdown for 5 minutes
</script>
  
</body>

</html>