<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Otp test</title>
</head>
<body>

<form action="/verify-otp" method="post">
    @csrf

    <div class="input-field otp-field" >
               <input type="text" id="otp" name="otp" placeholder="Enter OTP">
               <span id="otpError" class="error"></span>
            </div>

<div>
    <button type="submit" id="SendOtp">Verify Otp</button>
</div>
</form>
    
</body>
</html>