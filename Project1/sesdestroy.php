<?php
include('config.php');
// remove all session variables
session_unset();

// destroy the session
session_destroy();
header('Location:signup.php');
?>