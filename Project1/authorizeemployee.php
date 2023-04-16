<?php
session_start();
include_once("config.php");
$id=$_GET['id'];
$id1=$_SESSION["id"];
$ver="Verified";
$sql="UPDATE `reg_tb` SET `astatus`='".$ver."' WHERE id='".$id."'";
if(mysqli_query($conn,$sql)==TRUE)
{
    $q="SELECT * from reg_tb WHERE id='".$id1."'";
    $result = mysqli_query($conn,$q); 
    if(mysqli_num_rows($result)>0)
    {
        $row=mysqli_fetch_assoc($result);
        $type=$row['type'];
        if(strcmp($type,"Level-2 Officer")==0)
        {
            header("Location:level_2_authorizeemployee.php");
        }
        else if(strcmp($type,"Level-3 Officer")==0)
        {
            header("Location:level_3_authorizeemployee.php");
        }
    }
    else
    {
        header("Location:admin_authorize_employee.php");
    }
}
else
{
    echo mysqli_error($conn);
}
?>
