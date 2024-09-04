<?php
include "include/connect.php";
$email = "";
if($_POST['user']=='cand'){
    $email= $_POST['email'];
 $query = $db->prepare("SELECT count(c_email) AS count_ FROM candidate_tbl WHERE c_email ='$email'");
 $query->execute();
 $row = $query->fetch();

 if($row['count_'] > 0){
 	echo 1;
 }
 else{
 	echo 0;
 }
}
else if($_POST['user']=='corp'){
$email= $_POST['email'];
$query = $db->prepare("SELECT count(user_email) AS count_ FROM users WHERE user_email ='$email'");
 $query->execute();
 $row = $query->fetch();

 if($row['count_'] > 0){
    echo 1;
 }
 else{
    echo 0;
 }
}
 else if($_POST['user'] == 'compr'){
$reg = $_POST['reg'];
$query = $db->prepare("SELECT count(company_reg) AS count_ FROM corporate WHERE company_reg ='$reg'");
 $query->execute();
 $row = $query->fetch();

 if($row['count_'] > 0){
    echo 1;
 }
 else{
    echo 0;
 }
}
else if($_POST['user']=='corpe'){
$email= $_POST['email'];
$query = $db->prepare("SELECT count(company_email) AS count_ FROM corporate WHERE company_email ='$email'");
 $query->execute();
 $row = $query->fetch();

 if($row['count_'] > 0){
    echo 1;
 }
 else{
    echo 0;
 }
}