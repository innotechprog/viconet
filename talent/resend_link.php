<?php
session_start();
include "include/connect.php";
include "include/functions.php";
include "head.php";
include "include/website_class.php";
$candidate = new Candidates($db);
$corp = new Corporate($db);
$web = new Website($db); //Website class
//PHP Mailer Headers
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
//require 'PHPMailer/PHPMailerAutoload.php';
$emails = new SendEmails($db);
 
//Send data to database


$mail = new PHPMailer(true);
//Adding candidate information to database
$name = "";
$email="";
$enemail = "";
if(isset($_GET['ty']))
{
    if($_GET['ty']==md5('cand'))
    {
        if(isset($_GET['em'])){
            $enemail = $_GET['em'];
            $candidate->setCandidate($enemail);
            $email = $candidate->getCandEmail();
            $name = $candidate->getCandName();
        }
        else if(isset($_POST['email']))
        {
            $email = $_POST['email'];
            $enemail = md5($email);
            $candidate->setCandidate($enemail);
            $name = $candidate->getCandName();
            $pass1 = $pass;
            $candidate->addEncryPass($email,$pass1);
            //SEND EMAIL TO VERIFY ACCOUNT
            include "emails/resend-link.php";
        } 
    }
}


//Redirecting 
if($_GET['ty']== md5('cand'))
{
?>
<script type="text/javascript">window.location = "candidate-message";</script>
<?php
}
else{
?>
<script type="text/javascript">window.location = "corp-message";</script>
<?php 
}
?>