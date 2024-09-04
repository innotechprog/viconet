<?php
session_start();
include "include/connect.php";
include "include/functions.php";
include "include/auth.php";

$email = md5($candidate->getCandEmail());
/*
$DOB = "";
$address = "";
$city = "";
$state ="";
$country = "";
$about = "";
$company_name = "";
$start_date = "";
$end_date = "";
$job_title = "";
$role = "";
//Qualifications
$university = "";
$qualification = ""; 
$year_completed = "";
//Courses
$course = "";
$skill = "";
$long_cv="";
$video_cv="";

$DOB = $_POST['dateOfBirth'];
$state = $_POST['state'];
$country = $_POST['country'];
$address = $_POST['address'];
$date="";
$about = $_POST['about_career'];
$company_name=$_POST['company_name'];
$start_date=$_POST['start_date'];
$end_date='';
$job_title = $_POST['job_title'];
$new_filename="";
*/

//INSERT DATA INTO ADDRESS TABLE


$query4 = $db->prepare("UPDATE candidate_tbl SET c_verified='verified' WHERE md5(c_email) = '$email' ");
$query4->execute();

//INSERT CV INFORMATION

?>
<script type="text/javascript"> window.location.replace(window.location.protocol + "//" + window.location.host + "/success"); </script>