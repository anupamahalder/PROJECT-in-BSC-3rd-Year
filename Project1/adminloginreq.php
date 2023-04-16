<?php
include("config.php");
session_start();
$email=$_POST['email'];
$password=$_POST['password'];
$sql = "SELECT * from admin_tb WHERE email='".$email."'";
$result = mysqli_query($conn,$sql); 
if(mysqli_num_rows($result)>0)
{
    $row=mysqli_fetch_assoc($result);
    $logid=$row['id'];
    $password2=$row['password'];
    if(strcmp($password,$password2)==0)
    {
        $_SESSION["id"] = $logid;
        header("Location:admin_service_dashboard.php");
    }
    else
    {
        session_unset();
        session_destroy();
        header("Location:adminlogin.php?msg=Enter password correctly");
    }
}
else
{
    header("Location:adminlogin.php?msg=Email does not exists");
}

