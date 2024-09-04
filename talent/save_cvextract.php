<?php
session_start();
include "include/connect.php";
include "include/functions.php";
include "include/auth.php";
$email = md5($candidate->getCandEmail());
$candidate->getCvData();
//tab 1
$DOB = "";
$address = "";
$city = "";
$state ="";
$country = "";
//tab 2
$about = "";
$company_name = "";
$start_date = "";
$end_date = "";
$job_title = "";
$years_experience="";
$role = "";
//Qualifications
$university = "";
$qualification = ""; 
$year_completed = "";
//Courses
$course = "";
$skill = "";
$pdf_cv="";
$video_cv="";

//update tab 1
$DOB = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
$gender = $_POST['gender'];
if($gender == "other"){
	$gender = $_POST['otherGender'];
}
$race =$_POST['race'];
$state = $_POST['state'];
$country = $_POST['country'];
$address = $_POST['address'];
$date=""; 


//update tab 2
if(isset($_POST['experience_id1'])){
	$exp1 =$_POST['experience_id1'];
}
if(isset($_POST['years_experience']))
{
	$years_experience = $_POST['years_experience'];
}
//
if(isset($_POST['userCellphone']))
{
	$cellphone = $_POST['userCellphone'];
	$sql = $db->prepare("UPDATE `candidate_tbl` SET `c_DOB`='$DOB', race='$race' , gender ='$gender', c_cellphone ='$cellphone' WHERE md5(c_email)='$email'");
$sql->execute();
}
else{
$sql = $db->prepare("UPDATE `candidate_tbl` SET `c_DOB`='$DOB', race='$race' , gender ='$gender' WHERE md5(c_email)='$email'");
$sql->execute();
}

if($candidate->countAddress() > 0)
{
	$a_sql = $db->prepare("UPDATE `address` SET `address`=?,`state`=?,`country`=? WHERE email =?");
	$a_sql->execute(array($address,$state,$country,$email));
}
else{
$check_query = $db->prepare("SELECT * FROM address WHERE email='$email'");
$check_query->execute();
$check_row = $check_query->fetch();
if($check_row['address'] != $address){
$address_sql = $db->prepare("INSERT INTO `address`(`email`, `address`,`state`, `country`) VALUES (?,?,?,?)");
$address_sql->execute(array($email,$address,$state,$country));
}
?>