<?php
session_start();
include "../include/connect.php";
include "../include/functions.php";
include "../include/website_class.php";
include "head.php";
$candidate = new candidates($db);
$emails = new SendEmails($db);
$web = new Website($db); //Website class
//PHP Mailer Headers
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';
$imported = md5("imported");

//Getting selected candidates
foreach ($_POST['selectCand'] as $key => $value) {
	$email = $value;
	$enemail = md5($email);
 $candidate->setCandidate($enemail);
 $mail = new PHPMailer(true);
 include "email/imported-talent-email.php";

}
?>
<script>
	window.location = "candidates?type=<?php echo $imported ?>";
</script>