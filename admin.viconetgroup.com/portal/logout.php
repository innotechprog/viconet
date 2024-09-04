<?php 
session_start();
//session_destroy();
include "include/connect.php";
include "include/functions.php";

unset($_SESSION['staff_id']);
header('location:https://admin.viconetgroup.com/');
?>
