<?php
include("config.php");
session_start();
date_default_timezone_set('Asia/Kolkata');
$getdate= date("Y-m-d");
$gettime=date("H:i:sa");
echo $gettime;
$email=$_POST['email'];
$password=$_POST['password'];
$sql = "SELECT * from reg_tb WHERE email='".$email."'";
$result = mysqli_query($conn,$sql); 
if(mysqli_num_rows($result)>0)
{
    $row=mysqli_fetch_assoc($result);
    $logid=$row['id'];
    $password2=$row['password'];
    if(strcmp($password,$password2)==0)
    {
        $type=$row['type'];
        $status=$row['status'];
        $astatus=$row['astatus'];
        if(strcmp($type,"Hatchery Owner")==0 and strcmp($status,"Verified")==0)
        {
            $_SESSION["id"] = $logid;
            $q="INSERT INTO `login_tb`(`id`, `log_time`, `log_date`) VALUES ('$logid','$gettime','$getdate')";
            if(mysqli_query($conn,$q)==TRUE)
            {
                header("Location:user_service_dashboard.php");
            }
        }
        else if(strcmp($type,"Hatchery Owner")==0 and strcmp($status,"NotVerified")==0)
        {
            $_SESSION["id"] = $logid;
            $_SESSION["email"] = $email;
            header("Location:otpverify.php");
        }
        else if(strcmp($type,"Level-1 Officer")==0 or strcmp($type,"Level-2 Officer")==0 or strcmp($type,"Level-3 Officer")==0)
        {
            if(strcmp($status,"NotVerified")==0)
            {
                $_SESSION["id"] = $logid;
                $_SESSION["email"] = $email;
                header("Location:otpverify.php");
            }
            else if(strcmp($astatus,"NotVerified")==0)
            {
                session_unset();
                session_destroy();
                header('Location:signup.php?msg=Yet to authorized by officials');
            }
            else if(strcmp($astatus,"Verified")==0)
            {
                if(strcmp($type,"Level-1 Officer")==0)
                {
                    $_SESSION["id"] = $logid;
                    $q="INSERT INTO `login_tb`(`id`, `log_time`, `log_date`) VALUES ('$logid','$gettime','$getdate')";
                    if(mysqli_query($conn,$q)==TRUE)
                    {
                        header("Location:level_1_service_dashboard.php");
                    }
                } 
                if(strcmp($type,"Level-2 Officer")==0)
                {
                    $_SESSION["id"] = $logid;
                    $q="INSERT INTO `login_tb`(`id`, `log_time`, `log_date`) VALUES ('$logid','$gettime','$getdate')";
                    if(mysqli_query($conn,$q)==TRUE)
                    {
                        header("Location:level_2_service_dashboard.php");
                    }
                } 
                if(strcmp($type,"Level-3 Officer")==0)
                {
                    $_SESSION["id"] = $logid;
                    $q="INSERT INTO `login_tb`(`id`, `log_time`, `log_date`) VALUES ('$logid','$gettime','$getdate')"; 
                    if(mysqli_query($conn,$q)==TRUE)
                    {
                        header("Location:level_3_service_dashboard.php");
                    }
                } 
            }
        }
        else
        {
            $_SESSION["id"] = $logid;
            header("Location:admin_dashboard.php");
        }
    }
    else
    {
        session_unset();
        session_destroy();
        header("Location:signup.php?msg=Enter password correctly");
    }
}
else
{
    header("Location:signup.php?msg=Email does not exists");
}

