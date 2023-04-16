<?php
include_once('config.php');
session_start();
$email=$_SESSION['email'];
$pass=$_POST['password'];
$pass1=$_POST['password1'];
if($pass!=$pass1)
{
   header("Location:changepass.php?msg=Password does'nt match each other! Re-enter password");
}
else
{
    $sql="UPDATE `reg_tb` SET `password`='".$pass."'WHERE `email`='".$email."'";
    if(mysqli_query($conn,$sql)==TRUE)
    {
        session_unset();
        session_destroy();
        header("Location:signup.php?msg=Password changed successfully");
    }
}