<?php
include("config.php");
session_start();
    $email=$_POST['email'];
    $sql="SELECT * from reg_tb where email='".$email."'";
    $result= mysqli_query($conn,$sql);  
    if(mysqli_num_rows($result) > 0) 
    {
        header("Location:signup.php?msg=Email already exists");
    }
    else
    {
        $status="NotVerified";
        $name=$_POST['name'];
        $password=$_POST['password'];
        $phnum=$_POST['phn'];
        $type=$_POST['type'];
        $district=$_POST['district']; 
        $sql = "INSERT INTO `reg_tb`(`name`, `type`, `password`, `email`, `phnum`, `district`,`astatus`, `status`) VALUES ('$name','$type','$password','$email','$phnum','$district','$status','$status')";
        if(mysqli_query($conn,$sql)==TRUE)
        {
            $sql="SELECT * from reg_tb WHERE email='".$email."'";
            $result = mysqli_query($conn,$sql); 
            if(mysqli_num_rows($result)>0)
            {
                $row=mysqli_fetch_assoc($result);
                $_SESSION["id"]=$row['id'];
                $_SESSION["email"] = $email;
                $_SESSION["password"] = $password;
                header("Location:otpverify.php");
            }   
        }
        else
        {
            header("Location:signup.php?msg=Invalid credinatials");
        }   
    }
?>