<?php
session_start();
$email=$_POST['email'];
$_SESSION['email']= $email;
$code = rand(111111,999999);
$_SESSION['otp']= $code;
$subject = "Email Verification Code";
$message = "Your verification code is $code";
$sender = "From: hatcheryaccredition@outlook.com";
if(mail($email, $subject, $message, $sender))
{
    header("Location:otpauthorization1.php?msg=We've sent a verification code to your email");
}
else
{
    session_unset();
    session_destroy();
    header("Location:signup.php?msg=Failed while sending code!Try after some time");
}