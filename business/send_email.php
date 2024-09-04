<?php

//PHP Mailer Headers
include "include/website_class.php";
$web = new Website($db); //Website class
$emails = new SendEmails($db);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
//require 'PHPMailer/PHPMailerAutoload.php';
//Variable declaring and assigning


    $mail = new PHPMailer(true);
       
    $url = "https://".$web->getWebLinkExt()."business.viconetgroup.com/index";
  
try {
    $mail->isSMTP();                                             
    $mail->Host       = $emails->getHost();                  
    $mail->SMTPAuth   = true;                             
    $mail->Username   = $emails->getUsername();                 
    $mail->Password   = $emails->getPassword();
    $mail->SMTPSecure = 'tls';                              
    $mail->Port       = $emails->getPort(); 
    $mail->setFrom($emails->getUsername(),'Vico.net');           
    $mail->addAddress($userEmail);
  
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
    Welcome to our Virtual collaboration network.
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
                  <p style="margin: 0;">Welcome to Vico.net&#8482; - your Virtual Collaboration Network.<br><br><strong>'.$companyName.'</strong> has added you to their staff list on the Vico.net&#8482; platform.<br> You can LOG IN using this information:<br><br>Username : '.$userEmail.'<br>Password : '.$password2.' </p>
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
                              <td align='center' style='border-radius: 50px;' bgcolor='#1f58a4'><a href=$url target='_blank' style='font-size: 20px; font-family: quicksand, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 50px; border: 1px solid #1f58a4; display: inline-block;'>Login</a></td>
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
                          <p style="margin: 0;">Should you have any enquiries, please do not hesitate to contact us via email at info@viconetgroup.com.<br><br>Best Regards,<br>The Vico.net&#8482; Team<br>info@viconetgroup.com | +27 10 824 7568</p>
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
        <td bgcolor="#f4f4f4" align="center" style="padding: 30px 10px 0px 10px;">
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
    $mail->Subject = 'Vico.net';
    $mail->Body    = $message;
    //$mail->AltBody = 'Body in plain text for non-HTML mail clients';
    $mail->send();
   
} catch (Exception $e) {
    echo "{$mail->ErrorInfo}";
} 
