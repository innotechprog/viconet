<?php
include '../include/connect.php';
require_once "assets/classes/functions.php";
//include "../include/functions.php";
$candidate = new Candidates($db);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'assets/PHPMailer/Exception.php';
require 'assets/PHPMailer/PHPMailer.php';
require 'assets/PHPMailer/SMTP.php';
//require 'PHPMailer/PHPMailerAutoload.php';
//Variable declaring and assigning

$status = $_GET['st'];

if($status == md5("process"))
{
$query = $candidate->candidateData();

for($x = 0; $rows = $query->fetch();$x++){
	if($rows['num_reminder'] < 2 ){
		$mail = new PHPMailer(true);
		$userName = $rows['c_name'];
		$userEmail = $rows['c_email'];
		include"reminder_email.php";
		$candidate->incrementNumRem($userEmail);
	}
}
}
else if($status == md5("verify"))
{
$query = $candidate->candidateData();
for($x = 0; $rows = $query->fetch();$x++){
	if($rows['num_reminder'] < 2){
		$mail = new PHPMailer(true);
		$userName = $rows['c_name'];
		$userEmail = $rows['c_email'];
		include"verify_acc.php";
		$candidate->incrementNumRem($userEmail);
	}
}
}
?>
<script type="text/javascript">window.location = "candidates"</script>