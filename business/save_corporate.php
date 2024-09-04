<?php 
//PHP Mailer Headers
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
//require 'PHPMailer/PHPMailerAutoload.php';
include "include/connect.php";
include "include/functions.php";
include "include/website_class.php";
$web = new Website($db); //Website class
$emails = new SendEmails($db);
$corp = new Corporate($db);
$candidate = new candidates($db);
$id="";
 
if(isset($_POST['id'])){
$tel = $_POST['telephone'];
$comp_industry = $_POST['industry'];
$id = $_POST['id']; 
}

if(!empty($id)){
	   $corp->updateCorporateDetails($comp_industry,$tel,$id);
    ?>
    <script type="text/javascript">window.location = "corporate-profile.php"</script>
    <?php
}
else{
//Assigning values to variables on register
$regNo = $_POST['company_reg'];;
$compName = $_POST['company_name'];
$userName = $_POST['userName'];
$userSurname = $_POST['userSurname'];
$userCell = $_POST['userCellphone'];
$tel = $_POST['telephone'];
//$userEmail = $_POST['userEmail'];
$companyEmail = $_POST['company_email'];
$pos = $_POST['position'];
$password = md5($_POST['userPassword']);
$status = "pending";
//Address
$location = "";
if(isset($_POST['address']))
{
$location = $_POST['address'];
}
$city = "";
$state = "";
$country ="";
$zip_code ="";
$addedBy = "System";
$dateAdded = date('d-m-Y');
$endDate = "";
$corp->addCorporate($compName,$tel,$companyEmail,$regNo,$status);
$corp->addCorporateUser($companyEmail,$userName,$userSurname,$userCell,$companyEmail,$password,$pos,$addedBy,$dateAdded,$endDate);
$compEm = md5($companyEmail);
$corp->addCompSubscription($compEm); 
$corp->addLocation($compEm,$location);
$candidate->addEncryPass($companyEmail,$pass);
$salt = md5('corp-access');
$enemail = md5($companyEmail);
//SEND EMAIL TO VERIFY ACCOUNT
$url = "https://".$web->getWebLinkExt()."business.viconetgroup.com/verify?em=".$enemail."&access=".$pass."&salt=".$salt;
$mail = new PHPMailer(true);
try {
            $mail->isSMTP();                                             
            $mail->Host       = $emails->getHost();                 
            $mail->SMTPAuth   = true;                             
            $mail->Username   = $emails->getUsername();                 
            $mail->Password   = $emails->getPassword();
            $mail->SMTPSecure = 'tls/ssl';                              
            $mail->Port       = $emails->getPort(); 
            $mail->setFrom('info@viconetgroup.com','Vico.net');   
            $mail->addAddress($companyEmail);
            $mail->addBCC('info@viconetgroup.com');
            $mail->AddAttachment('legal documents/Membership Terms.pdf', 'Membership Terms.pdf');
             $mail->AddAttachment('legal documents/VICONET SUBSCRIPTION.pdf', 'Subscription Terms.pdf');
            $mail->AddAttachment('legal documents/Viconet Privacy Notice.pdf', 'Privacy Policy.pdf');

$message = '<!DOCTYPE html>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
    Thank you for registering with Vico.net
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
                        <a href="#" target="_blank">
                            <img alt="Logo" src="https://business.viconetgroup.com/img/viconet-logo.png" width="220"  style="display: block; width: 220px; max-width: 400px; min-width: 100px; font-family: quicksand, sans-serif; color: #ffffff; font-size: 14px;" border="0">
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
                      <h1 style="font-size: 24px; font-weight: 400; margin: 0;">Dear '.$userName.'</h1>
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
                  <p style="margin: 0;"><b></b>Thank you for registering with Vico.net&#8482; - your Virtual Collaboration Network.<br>One more step to go!<br><br>Please click on the button below to verify your account, then complete your business profile.</p>
                </td>
              </tr>
              <!-- BULLETPROOF BUTTON -->
              <tr>
                <td bgcolor="#ffffff" align="left">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td bgcolor="#ffffff" align="center" style="padding: 0px 30px 0px 30px;">
                        <table border="0" cellspacing="0" cellpadding="0">
                         <tr>
                              <td align="center" style="border-radius: 50px;" bgcolor="#1f58a4">';
                                $message .=" <a href=$url target='_blank' style='font-size: 20px; font-family: quicksand,sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 50px; border: 1px solid #1f58a4; display: inline-block;'>Verify </a></td>";
                                
                          $message .='</tr>

                        </table>
                      </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 20px 0px 30px 0px;">
                            <table border="0" cellspacing="0" cellpadding="0">
                             <tr>
                                <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 0px 30px; color: #666666; font-family: quicksand, sans-serif; font-size: 14px; font-weight: 400; line-height: 25px;" >
                                  <p style="margin: 0;">We look forward to having you on board.<br><br>Best Regards,<br>The Vico.net&#8482; Team<br>info@Viconetgroup.com | +27 10 824 7568</p>
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
                
                <tr><td bgcolor="#ebf5f7" align="left" style="padding: 39px 30px 0px 30px; border-radius: 0px 0px 4px 4px;  font-family: Quicksand, sans-serif; font-size: 14px; font-weight: 400; line-height: 25px;" ><p style="color:#212529"> Alternatively, please copy the following link to your browser</p>';
                    $message .= '<p style="color:#212529!important; word-break: break-all;">'.$url.'</p></td></tr>
                 
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
//end of html    
    $mail->isHTML(true);                                  
    $mail->Subject = 'Registration at Vico.net';
    $mail->Body    = $message;
    //$mail->AltBody = 'Body in plain text for non-HTML mail clients';
    $mail->send();       
    } catch (Exception $e) {
        echo "{$mail->ErrorInfo}";
    }
}

?>