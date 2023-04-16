<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");
$dbHost="localhost";
$dbUsername="root";
$dbpassword="";
$dbname="hatchery";
$conn=new mysqli($dbHost,$dbUsername,$dbpassword,$dbname);
if($conn->connect_error)
{
    die("Connection failed: ".$conn->connect_error);
}
?>