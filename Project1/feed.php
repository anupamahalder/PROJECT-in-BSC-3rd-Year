<?php
include("config.php");
$name=$_POST['name'];
$email=$_POST['email'];
$subject=$_POST['subject'];
$message=$_POST['message'];
$sql="INSERT INTO `user_feedback`(`name`, `email`, `subject`, `message`) VALUES ('$name','$email','$subject','$message')";
if(mysqli_query($conn,$sql)==TRUE)
{
    header("Location:index.php");
}