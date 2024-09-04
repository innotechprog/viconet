<?php
session_start();
include "include/connect.php";
include "include/functions.php";
include 'include/corp_auth.php';
$candidate->address();

$location ="";
$city = "";
$state = "";
$country ="";
$zip_code ="";

$location =$_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$country =$_POST['country'];
$zip_code =$_POST['zipCode'];

if($corp->countCompAddress() > 0){
	$corp->updateAddress($location,$city,$state,$country,$zip_code);
}else{
	$corp->addAddress($location,$city,$state,$country,$zip_code);
}

?>