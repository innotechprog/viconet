<?php
session_start();
require 'vendor/vendor-goo/autoload.php';

include "include/connect.php"; 
include "include/functions.php";
include "include/website_class.php";
$web = new Website($db); //Website class
$candidate = new candidates($db);
$emails = new SendEmails($db);
//PHP Mailer Headers
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

// Replace with your actual Client ID and Client Secret
$clientId = trim('748757386943-mpirvpftkeop6qvds0i81dsjjhlqms99.apps.googleusercontent.com');
$clientSecret = trim('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');
$redirectURI = "https://".$web->getWebLinkExt()."talent.viconetgroup.com/callback.php";

$client = new Google_Client();
$client->setClientId($clientId);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectURI);
$scopes = [
    'https://www.googleapis.com/auth/userinfo.email', // Access to the user's email address
    'https://www.googleapis.com/auth/userinfo.profile', // Access to basic profile information
    // Add any additional scopes you need here
];
$client->setScopes($scopes);

if (isset($_GET['code'])) {
   $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
 
    $client->setAccessToken($token);
   $service = new Google_Service_Oauth2($client);
   $google_account_info = $service->userinfo->get();
   $userInfo = [
    'email' => $google_account_info['email'],
    'first_name' => $google_account_info['givenName'],
    'last_name' => $google_account_info['familyName'],
    'gender' => $google_account_info['gender'],
    'full_name' => $google_account_info['name'],
    'picture' => $google_account_info['picture'],
    'verifiedEmail' => $google_account_info['verifiedEmail'],
    'token' => $google_account_info['id'],
  ];

    // Now you can access user information
$name = $userInfo['first_name'];
$surname= $userInfo['last_name'];
$email= strtolower($userInfo['email']);
$dateOB = "";
$userCell = ''; 
$gender = $userInfo['gender'];
$password = $pass;
$status = "google-process";
$date_registered = date("Y-m-d");
if($candidate->checkEmailExist($email))
{
  $candidate->setCandidate(md5($email));
    $_SESSION[$pass] = $pass;
    $_SESSION['id'] = md5($email);
    $_SESSION['goo'] = "google_login";
    $query = $db->prepare("UPDATE candidate_tbl SET sess_id='$pass' WHERE c_email ='$email' ");
    $query->execute();
if ($candidate->getStatus() =='Pending') {
 $query = $db->prepare("UPDATE candidate_tbl SET c_verified='google-process' WHERE c_email ='$email' ");
    $query->execute();

    ?>
<script>window.location = "terms";</script>
<?php
  }
  else{
if(isset($_SESSION['jobid'])){
  ?>
  <script type="text/javascript">window.location = "job?id=<?php echo $_SESSION['jobid'] ?>";</script>
  <?php
  }
  else{
    ?>
     <script type="text/javascript">window.location = "profile-view";</script>
<?php
}
}
}
else{
  $query = $db->prepare("INSERT INTO `candidate_tbl`(`c_name`, `c_surname`, `c_email`, `c_cellphone`, `c_DOB`, `c_password`, `c_verified`, `popia_consent`, `t_and_c`, `date_registered`,`added_by`) VALUES ('$name','$surname','$email','$userCell','$dateOB','$password','$status','Accepted','Accepted','$date_registered','google-signup')");
$query->execute();
$enemail = md5($email);
$pass = $pass;
$source = "";
if(isset($_SESSION['jobid'])){
 $source = "Job-seeking";
}
else{
  $source = "normal-registration";
}
$candidate->registrationSource($enemail,$source);  
$candidate->addEncryPass($email,$pass);
$mail = new PHPMailer(true);
include "emails/google-registered-success.php";
$_SESSION[$pass] = $pass;
$_SESSION['id'] = md5($email);
$_SESSION['goo'] = "google_login";
$query = $db->prepare("UPDATE candidate_tbl SET sess_id='$pass' WHERE c_email ='$email' ");
$query->execute();
?>
<script>window.location = "terms";</script>
<?php
}
}
?>
<script src="https://apis.google.com/js/platform.js" async defer></script>