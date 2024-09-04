<?php
include "include/connect.php";

$password1 ="";
$password2 = "";
$email = "";
$type = "";

$password1 = md5($_POST['userPassword']);
$password2 = md5($_POST['userConfPassword']);
$email = $_POST['email'];
$type = $_POST['type'];

if($password1 != $password2){
	echo '<div class="alert alert-danger alert-dismissible" role="alert">
          Password do not match;
        </div>';
}
else{ 
	if($type == md5("staff"))
	{
		$password1=md5($password1);
		$query = $db->prepare("UPDATE `staff` SET`s_password`='$password1' WHERE md5(s_email)='$email'");
		$query->execute();
		echo '<a href="staff_lgn" class="bton btn2">Login</a>';
	}
	else if($type == md5("cand"))
	{
		$query = $db->prepare("UPDATE `candidate_tbl` SET`c_password`='$password1' WHERE md5(c_email)='$email'");
		$query->execute();
		echo '<a href="login" class="bton btn2">Login</a>';
	}
	else if($type == md5("corp"))
	{
		$query = $db->prepare("UPDATE `users` SET`password`='$password1' WHERE md5(user_email)='$email'");
		$query->execute();

	echo '<a href="corp_login" class="bton btn2">Login</a>';
	}
	$query = $db->prepare("UPDATE `pass_encry` SET`encry`='' WHERE md5(email)='$email'");
	$query->execute();
}
