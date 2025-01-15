<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="otp.css">
    <title>Otp test</title>
</head>
<body >

<form action="/verify-otp" method="post">
   

            <section >
  <div class="title">OTP</div>
  <div >

    <img src="otp.jpg" alt="" height="200px">

  </div>
  <div class="title">Verification Code</div>
  <p>We have sent a verification code to your Email</p>
  <div id='inputs'>
    <input id='input1' type='text' maxLength="1" />
    <input id='input2' type='text' maxLength="1" />
    <input id='input3' type='text' maxLength="1" />
    <input id='input4' type='text' maxLength="1" />
    <input id='input5' type='text' maxLength="1" />
    <input id='input6' type='text' maxLength="1" />
  </div>
  <button type="submit" id="SendOtp">Verify</button>
</section>


</form>
  
</body>
<script src="otp.js"></script>
</html>