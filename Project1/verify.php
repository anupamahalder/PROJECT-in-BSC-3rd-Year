<?php
session_start();
include_once('config.php');
$otp=$_SESSION['otp'];
$otp1=$_POST['otp'];
if($otp==$otp1)
{
    $ver="Verified";
    $id=$_SESSION["id"];
    $sql="UPDATE `reg_tb` SET `status`='".$ver."' WHERE `id`='".$id."'";
    if(mysqli_query($conn,$sql)==TRUE)
    {
        session_unset();
        session_destroy();
        header("Location:signup.php?msg=Registration Successful and Login Now");
    }
}
else
{
    header("Location:otpauthorization.php?msg=OTP did not match please enter correctly");
}
?>