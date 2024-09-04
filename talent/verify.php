<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
include "include/connect.php";
include "include/functions.php";
//include "include/website_class.php";
//$web = new Website($db); //Website class
$corp = new Corporate($db);
$candidate = new Candidates($db);
$emails = new SendEmails($db);
include "head.php";
$mail = new PHPMailer(true);
$what ="";
$ty="";
$perm = md5('offer');
if(isset($_GET['ty'])){
  $ty = $_GET['ty'];  
}
$type = md5('cand');
if(isset($_GET['em'])&& isset($_GET['access'])){
		$email = $_GET['em'];
		$access = $_GET['access'];
		$query = $db->prepare("SELECT count(id) as num_rows from pass_encry where email='$email' and encry ='$access'");
		$query->execute();
		$row = $query->fetch();

	if ($row['num_rows'] == 1) {
        if($_GET['salt'] == md5("corp-access"))
        {
            $email = $_GET['em'];
           $query = $db->prepare("UPDATE corporate SET status='Approved' WHERE md5(company_email) = '$email' ");
            $query->execute();
            $pass = md5($pass);
            $query1 = $db->prepare("UPDATE pass_encry SET encry='$pass' WHERE email = '$email' ");
            $query1->execute(); 
            $corp->setCompData($email);
            $corp->setUsersData($email);
            include "user-welcome.php";           
            ?>
            <script type="text/javascript">
               window.location = "index";
            </script>
            <?php 
        }
        else{
        	$query = $db->prepare("UPDATE candidate_tbl SET c_verified='process' WHERE md5(c_email) = '$email' ");
        	$query->execute();
            $query1 = $db->prepare("UPDATE pass_encry SET encry='$pass' WHERE email = '$email' ");
            $query1->execute(); 

            if(isset($_SESSION['opportunity'])){
                $pass = $_SESSION['opp_access'];
                $email = $_SESSION['oppo_c_email'];
                $_SESSION[$pass] = $pass;
                $_SESSION['id'] = md5($email);
                $query = $db->prepare("UPDATE candidate_tbl SET sess_id='$pass' WHERE c_email ='$email' ");
                $query->execute();
                ?>
                <script type="text/javascript">
                    window.location = "create-profile";
                </script>
                <?php 
            }
            else
            {
        	?>
        	<script type="text/javascript">
        		window.location = "index";
        	</script>
        	<?php
            }
        }
	}
   	else
	{
        $email1 = $_GET['em'];
		echo '
        <div class="talent-blue-header">
        <div class="prof-container">
        <div class="row">       
            <div class="my-form-frame col-lg-4" style="margin-top: -100px;margin: 0 auto;">
                <div class="mes-frame">
                    <div class="success-tick">
                        <img src="img/ver-envelop.svg">
                    </div>
                    <label class="l-18">Email verification link expired</label>
                    <p class="p-12">Oops! Your verification link has expired. Not to worry, click the link below to get another link.</p>
                    <a href="resend_link?em='.$email1.'&ty='.$type.'"<button class="bton btn2" style="width:100%">Resend Verification Link</button></a>

                </div>
        </div>
    </div>
    </div>
    </div>';
	}
}
else if(isset($_GET['link']))
{

    //$email1 = $_GET['em'];
    if($_GET['link']==md5('res-link')){
        echo '
    <div class="talent-blue-header">
    <div class="prof-container">
    <div class="row">       
        <div class="my-form-frame col-lg-4" style="margin-top: -100px;margin: 0 auto;">
            <div class="mes-frame">
                <div class="success-tick">
                    <img src="img/ver-envelop.svg">
                </div>
                <form method="post" action="resend_link?ty='.$ty.'" autocomplete="off">
                    <div class="row">
                        <div class="col-lg-12 form-group">
                            <label class="input-label" for="email_address">Email Address</label>
                            <input class="cust-input" name="email" id="user_email" placeholder="Enter your email Address" oninput="checkEmail()">
                            <div class="error-message"></div>
                        </div>
                    </div>              
                    <button class="bton btn2" style="width:100%" type="submit" id="login_btn">Resend Verification Link</button>
                </form>
            </div>
    </div>
</div>
</div>
</div>';

    }
}
else if(isset($_GET['perm']) && $_GET['perm']==$perm){
	$email = $_GET['em'];
    $encrEmail = md5($email);//Encrypted candidate email
    $compEmail = $_GET['ce'];//Company email from get method
    $encryCompEmail = md5($compEmail);//Encrypting Company email
	$status = $_GET['st'];//Candidate status
    $what = $_GET['wt']; //Meeting or Interview
	$id = $_GET['id'];
	$corp->updateBasket__($status,$id);
	//Send Email to viconet staff and corporate
	$candidate->setCandidate($encrEmail);
	//$pas = md5($password);
    $corp->setUsersData($encryCompEmail);
    
    $url = "https://business.viconetgroup.com/";
  
try {
    $mail->isSMTP();                                             
    $mail->Host       = $emails->getHost();                  
    $mail->SMTPAuth   = true;                             
    $mail->Username   = $emails->getUsername();                 
    $mail->Password   = $emails->getPassword();
    $mail->SMTPSecure = 'tls';                              
    $mail->Port       = $emails->getPort(); 
    $mail->setFrom($emails->getUsername(),'Vico.net');  
    $mail->addAddress($compEmail);
    $mail->addBCC($corp->getUserEmail());

$message = '<!DOCTYPE html>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="http://getbootstrap.com.vn/examples/equal-height-columns/equal-height-columns.css"/>
<style type="text/css">
    
    /* CLIENT-SPECIFIC STYLES */
    body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
    table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
    img { -ms-interpolation-mode: bicubic; }

    /* RESET STYLES */
    img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
    table { border-collapse: collapse !important; }
    body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }

    /* iOS BLUE LINKS */
    a[x-apple-data-detectors] {
        color: inherit !important;
        text-decoration: none !important;
        font-size: inherit !important;
        font-family: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
    }
    
    /* MOBILE STYLES */
    @media screen and (max-width:600px){
        h1 {
            font-size: 32px !important;
            line-height: 32px !important;
        }
    }

    /* ANDROID CENTER FIX */
    div[style*="margin: 16px 0;"] { margin: 0 !important; }
</style>

</head>
<body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">

<!-- HIDDEN PREHEADER TEXT -->
<div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: quicksand, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
   
</div>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <!-- LOGO -->
    <tr>
        <td bgcolor="#ebf5f7" align="center">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
            <tr>
            <td align="center" valign="top" width="600">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;" >
                <tr>
                    <td align="center" valign="top" style="padding: 40px 10px 40px 10px;">
                        <a href="" target="_blank">
                            <img alt="Logo" src="https://talent.viconetgroup.com/img/viconet-logo.png" width="220"  style="display: block; width: 220px; max-width: 400px; min-width: 100px; font-family: quicksand, sans-serif; color: #ffffff; font-size: 14px;" border="0">
                        </a>
                    </td>
                </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
    <!-- HERO -->
    <tr>
        <td bgcolor="#ebf5f7" align="center" style="padding: 0px 10px 0px 10px;">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
            <tr>
            <td align="center" valign="top" width="600">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;" >
                <tr>
                    <td bgcolor="#ffffff" align="left" valign="top" style="padding: 40px 30px 0px 30px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: quicksand, sans-serif; font-size: 24px; font-weight: 400; letter-spacing: 1px; line-height: 25px;">
                      <label style="font-size: 24px; font-weight: 400; margin: 0;">Dear '.$corp->getUserName().'</label>
                    </td>
                </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
    <!-- COPY BLOCK -->
    <tr>
        <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
            <tr>
            <td align="center" valign="top" width="600">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;" >
              <!-- COPY -->
              <tr>
                <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: quicksand, sans-serif; font-size: 14px; font-weight: 400; line-height: 25px;" >
                  <p style="margin: 0;"><label style="font-size:14px;font-weight:600">We wish to inform you that '.$candidate->getCandName().' '.$candidate->getCandSurname().'</label> '.$candidate->checkOfferStatus($status,$what).'</p>

                </td>
              </tr>
              <!-- BULLETPROOF BUTTON -->
              <tr>
                <td bgcolor="#ffffff" align="left">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 0px 30px;">';

                       $message .=" <table border='0' cellspacing='0' cellpadding='0'>
                          <tr>
                              <td align='center' style='border-radius: 50px;' bgcolor='#1f58a4'><a href=$url target='_blank' style='font-size: 20px; font-family: poppins, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 50px; border: 1px solid #1f58a4; display: inline-block;'>Login</a></td>
                          </tr>
                        </table>";

                      $message .='</td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td bgcolor="#ffffff" align="left" style="padding: 20px 0px 30px 0px;">
                    <table border="0" cellspacing="0" cellpadding="0">
                     <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 0px 30px; color: #666666; font-family: quicksand, sans-serif; font-size: 14px; font-weight: 400; line-height: 25px;" >
                          <p style="margin: 0;">Best Regards,<br>The Vico.net&#8482; Team<br>info@viconetgroup.com | +27 10 824 7568</p>
                        </td>
                    </tr>
                  </table>
                </td>
            </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
    <!-- COPY CALLOUT -->
    <tr>
        <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
            <tr>
            <td align="center" valign="top" width="600">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;" >
               
                
                
				
				<!-- COPY -->
                
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
    <!-- SUPPORT CALLOUT -->
    <tr>
        <td bgcolor="#f4f4f4" align="center" style="padding: 30px 10px 0px 10px;">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
            <tr>
            <td align="center" valign="top" width="600">
            <![endif]-->
            
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
    <!-- FOOTER -->
    <tr>
        <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
            <tr>
            <td align="center" valign="top" width="600">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;" >
              
              <!-- PERMISSION REMINDER -->
              <tr>
                <td bgcolor="#f4f4f4" align="center" style="padding: 0px 30px 30px 30px; color: #666666; font-family: quicksand, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;" >
                  <p style="margin: 0;">Unit C38, Block C, Lone Creek, 21 Mac Mac Road & Howick Close,Waterfall Park, Midrand </p>
                </td>
              </tr>
             
              
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
</table>
    
</body>
</html>';

 $mail->isHTML(true);                                  
    $mail->Subject = 'Talent shortlist feedback';
    $mail->Body    = $message;
    //$mail->AltBody = 'Body in plain text for non-HTML mail clients';
    $mail->send();
   
} catch (Exception $e) {
    echo "{$mail->ErrorInfo}";
} 
//end sending
	?>
	<script type="text/javascript">
		window.location = "action-message?perm=<?php echo $perm ?>&opt=<?php echo $status ?>&what=<?php echo $what; ?>";
	</script>
	<?php
	}
if($ty==md5('corp'))
{
?>
<script type="text/javascript" src="js/corp-loginval.js"></script>
<?php
}
else{
?>
<script type="text/javascript" src="js/login-validation.js"></script>
<?php  
}