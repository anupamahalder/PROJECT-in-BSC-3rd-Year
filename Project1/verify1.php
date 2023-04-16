<?php
session_start();
include_once('config.php');
$otp=$_SESSION['otp'];
$otp1=$_POST['otp'];
if($otp==$otp1)
{
    $id=$_SESSION["id"];
    header("Location:changepass.php");
}
else
{
    header("Location:otpauthorization.php?msg=OTP did not match please enter correctly");
}
?>