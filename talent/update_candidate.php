<?php
session_start();
include "include/connect.php";
include "include/functions.php";
include "include/website_class.php";
include "head.php";
$web = new Website($db); //Website class
$candidate = new candidates($db);
$emails = new SendEmails($db);
//PHP Mailer Headers
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
//require 'PHPMailer/PHPMailerAutoload.php';

//Variable declaring and assigning 
$enemail = $_POST['enemail'];
$password = md5($_POST['userPassword']);
$userConf = $_POST['userConfPassword'];
if(isset($_POST['consent'])){
$consent = "Accepted";
}
else{
$consent = "Not accepted";  
}
//Check if t_and_c acepted
if(isset($_POST['consent'])){
$t_and_c = "Accepted";
}
else{
$t_and_c = "Not accepted";  
}
$status = "Pending";
$date_registered = date("Y-m-d");
$candidate->setCandidate($enemail);
$email = $candidate->getCandEmail();
//Send data to database
$candidate->updateCandConsent($consent, $t_and_c, $password, $enemail);
$_SESSION[$pass] = $pass;
$_SESSION['id'] = $enemail;
$query = $db->prepare("UPDATE candidate_tbl SET sess_id='$pass' WHERE c_email ='$email' ");
    $query->execute();
$mail = new PHPMailer(true);
include "emails/completing-prof-email.php";
?>
<script type="text/javascript">window.location = "create-profile"</script>