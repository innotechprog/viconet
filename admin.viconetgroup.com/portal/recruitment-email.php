<?php
session_start();
include "../include/connect.php";
include "../include/functions.php";
include "head.php";
$candidate = new candidates($db);
$emails = new SendEmails($db);
//PHP Mailer Headers
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';


//Variable declaring and assigning 
$count = 0;

//Adding candidate information to database
//$email = $candidate->getCandEmail();
//$enemail = md5($email);
$pass = "";
//SEND EMAIL TO VERIFY ACCOUNT
//$url = "https://dev.talent.viconetgroup.com/verify?em=".$enemail."&access=".$pass;
/*$query = $db->prepare("SELECT c.c_email as email, c.c_name as name,
CASE WHEN p.interest = 'Graduate Recruitment' THEN 'Graduate Recruitment'
WHEN p.interest = 'Workplace Experience' then 'Workplace Experience for University Students'
WHEN p.interest = 'Job Opening' then 'Business Intelligence Reporting & Analytics Specialist' end as 'programName'
FROM programme_interest p
inner join candidate_tbl c on c.c_email = p.email
where
c.c_verified = 'verified'
and md5(c.c_email) in (SELECT c_email from basket where receipt_id in (select receipt_id from receipts where company_reg = 'b1f5432e9c0a1f649a082065fd7401b1'))
group by p.email, p.interest");
$query->execute();
for($i=0; $rows = $query->fetch();$i++){
	$count = $count + 1;
try {
    $mail = new PHPMailer(true);
     $mail->isSMTP();                                             
    $mail->Host       = $emails->getHost();                    
    $mail->SMTPAuth   = true;                             
    $mail->Username   = $emails->getUsername();                 
    $mail->Password   = $emails->getPassword();
    $mail->SMTPSecure = 'tls';                              
    $mail->Port       = $emails->getPort(); 
    $mail->setFrom($emails->getUsername(),'Vico.net'); 
    $mail->addAddress($rows['email']);          
    $mail->addAddress('info@viconetgroup.com');
    $message = '<!DOCTYPE html>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
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
<div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Open Sans, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
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
                        <a href="https://viconetgroup.com" target="_blank">
                            <img alt="" src="https://talent.viconetgroup.com/img/viconet-logo.png" width="220"  style="display: block; width: 220px; max-width: 400px; min-width: 100px; font-family: poppins, sans-serif; color: #ffffff; font-size: 14px;" border="0">
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
                    <td bgcolor="#ffffff" align="left" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: poppins, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 1px; line-height: 48px;">
                      <h1 style="font-size: 24px; font-weight: 500; margin: 0;">Dear '.ucfirst
                      ($rows["name"]).',</h1>
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
                <td bgcolor="#ffffff" align="left" style="padding: 10px 30px 10px 30px; color: #666666; font-family: poppins, sans-serif; font-size: 14px; font-weight: 400; line-height: 25px;" >
                  <p style="margin: 0;">This is to formally acknowledge the receipt of your application for the <strong>'.$rows["programName"].'</strong> role.<br><br>Please be advised that we have received a significant number of applications in response to this opportunity. Each submission is being diligently reviewed, and the client is currently finalising the screening process.<br><br>Feedback on your application will be provided as soon as the aforementioned process is completed.<br>Should you have any inquiries or require further assistance, please do not hesitate to contact us via email at info@viconetgroup.com.<br><br>Best Regards,<br>The <a style="text-decoration:none" href="https://viconetgroup.com">vico.net&#8482; </a> Team</p>
                </td>
              </tr>
              <!-- BULLETPROOF BUTTON -->
              <tr>
                <td bgcolor="#ffffff" align="left">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
                        <table border="0" cellspacing="0" cellpadding="0">
                          <tr>';
                             
                          $message .='</tr>
                        </table>
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
                <tr>
                  <td bgcolor="#111111" align="left" style="padding: 10px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #fff; font-family: Open Sans, sans-serif; font-size: 14px; font-weight: 400; line-height: 25px;" >
                    <p style="margin: 0;"><a href="mailto:info@viconetgroup.com">info@viconetgroup.com</a> | +27 10 824 7568</p>
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
    <!-- SUPPORT CALLOUT -->
    <tr>
        <td bgcolor="#f4f4f4" align="center" style="padding: 10px 10px 0px 10px;">
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
                <td bgcolor="#f4f4f4" align="center" style="padding: 0px 30px 30px 30px; color: #666666; font-family: Open Sans, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;" >
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
    $mail->Subject = 'Acknowledgment of Your Application for the '.$rows['programName'];
    $mail->Body    = $message;
    //$mail->AltBody = 'Body in plain text for non-HTML mail clients';
    $mail->send();
   
} catch (Exception $e) {
    echo "{$mail->ErrorInfo}";
}
}
echo $count;
?>