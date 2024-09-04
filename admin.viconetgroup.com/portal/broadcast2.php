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
$type = md5("podcast");
$pass = "";
//SEND EMAIL TO VERIFY ACCOUNT
//$query = $db->prepare("SELECT c.c_email as email, c.c_name as name from candidate_tbl c WHERE added_by != 'import' and c_email not in (SELECT c_email FROM email_sentout where email_type = 'Podcast recap1') and c_email not in ('andrewncama@gmail.om','kgadi93@gmail.comom','leonardohobeni@gmail.co.com','lszkomape@gmail.comom','mmenuqetello@gmail.co','thamsanqacyril35@gmai.coml','tloumabotja29@gmail.con','zmndlebe@gamil.con','kylesamuels711@gmail.fom')
union
select c_email, c_name as name from candidate_tbl where t_and_c !='' and popia_consent !='' and added_by='import' and c_email not in (SELECT c_email FROM email_sentout where email_type = 'Podcast recap1')");
$query->execute();
for($i=0; $rows = $query->fetch();$i++){
	$count = $count + 1;
    $enemail = md5($rows['email']);
    //$url = "https://dev.talent.viconetgroup.com/unsubscribe-message?em=".$enemail."&access=".$pass."&ty=".$type; //unsubscription
	$mail = new PHPMailer(true);
try {
     $mail->isSMTP();                                             
    $mail->Host       = $emails->getHost();                    
    $mail->SMTPAuth   = true;                             
    $mail->Username   = $emails->getUsername();                 
    $mail->Password   = $emails->getPassword();
    $mail->SMTPSecure = 'tls';                              
    $mail->Port       = $emails->getPort(); 
    $mail->setFrom($emails->getUsername(),'Vico.net');          
    $mail->addAddress($rows['email']);
    //$mail->addBCC('innocent38318@gmail.com');
    //$mail->addBCC('george@ttchtech.co.za');
    //$mail->addBCC('inyambo@viconetgroup.com');
    //$mail->addAttachment('image/blog.jpg','image.jpg');

     $imagePath = 'https://viconetgroup.com/images/podcast/podcastRecap.png'; // Replace with the actual path to your image file
     $tracking_pixel = 'https://admin.viconetgroup.com/portal/tracking-pixels.php?enemail='.$enemail;
    // Attach the image and get the CID (Content-ID)
    //$imageCid = $mail->addEmbeddedImage($imagePath, 'image_cid', 'image.jpg');
    $message = '<!DOCTYPE html>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Quicksand, sans-serif:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
    .registered-trademark {
        position: relative;
    }

    .superscript 
    {        
        margin-top:-3px!important;
        font-size: 0.8em; /* Adjust the font size as needed */
    }
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
                        <a href="">
                            <img alt="" src="https://talent.viconetgroup.com/img/viconet-logo.png" width="220"  style="display: block; width: 220px; max-width: 400px; min-width: 100px; font-family: quicksand, sans-serif; color: #ffffff; font-size: 14px;" border="0">
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
    <!-- COPY BLOCK -->
    <tr>
        <td bgcolor="#f4f4f4" align="center" st]yle="padding: 30px 10px 0px 10px;">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
            <tr>
            <td align="center" valign="top" width="600">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;" >
              <!-- COPY -->
              <tr>
                <td bgcolor="#ffffff" align="left" style="padding: 10px 30px 10px 30px; color: #666666; font-family: quicksand, sans-serif; font-size: 14px; font-weight: 400;line-height: 25px;" >
                <img src="'.$tracking_pixel.'" style="width:1px; height:1px">
                <a href="https://youtu.be/0UsgW2sAjoA">
                     <img alt="" src="'. $imagePath .'" width="100%"  style="display: block; width: 100%; min-width: 100px; font-family: quicksand, sans-serif; color: #ffffff; font-size: 14px;" border="0">
                        </a>
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;" >
                <tr>
                    <td bgcolor="#ffffff" align="left" valign="top" style="padding: 15px 0px 15px 0px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: quicksand, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 1px; line-height: 25px;">
                      <h1 style="font-size: 24px; font-weight: 500; margin: 0;">Dear '.ucfirst
                      ($rows["name"]).'</h1>
                    </td>
                </tr>
            </table>
                  <p style="margin: 0;">As we hit the mid-season mark on &quot;Discover Talent with Vico.net&#8482;&quot; '. htmlspecialchars("we're").' thrilled to share a quick recap of the incredible journey so far: <br><br> https://youtu.be/0UsgW2sAjoA<br><br>Look back on our captivating episodes and the remarkable insights gained from our showcased talent, spanning global experiences to mastering medical editing, liquidity analysis, and a passion for nuclear science. Each episode has added a unique layer to our exploration of STEM excellence.<br><br>Get ready for an exciting second half with more intriguing conversations, deeper insights, and a closer look at diverse STEM facets.<br><br>
'. htmlspecialchars("Don't") .' miss out on future episodes! <a style="text-decoration:none" href="https://www.youtube.com/@VirtualCollaborationNetwork">Subscribe</a> to our YouTube channel for more inspiring stories.<br><br>Best Regards,<br>Vico.net&#8482; Team<br>info@viconetgroup.com | +27 10 824 7568</p> 
                </td>
              </tr>
              <!-- BULLETPROOF BUTTON -->
              <tr>
                <td bgcolor="#ffffff" align="left">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 0px 30px;">
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
                <td bgcolor="#f4f4f4" align="center" style="padding: 0px 30px 30px 30px; color: #666666; font-family: quicksand, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;" >
                  <p style="margin: 0;">Unit C38, Block C, Lone Creek, 21 Mac Mac Road & Howick Close,Waterfall Park, Midrand<hr>
                   </p>
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
    $mail->Subject = 'Discover Talent with Vico.net';
    $mail->Body    = $message;
    //$mail->AltBody = 'Body in plain text for non-HTML mail clients';
    $mail->send();

    $c_email = $rows['email'];
    $email_type = "Podcast recap1";
    $date = date('Y-m-d');
    $num_sent = 1;
    $sqlQuery = $db->prepare("INSERT INTO `email_sentout`(`c_email`, `email_type`, `num_sent`,`date_sent`) VALUES(?,?,?,?)");
    	$sqlQuery->execute(array($c_email,$email_type,$num_sent,$date));
   
} catch (Exception $e) {
    echo "{$mail->ErrorInfo}";
    //$content->loadFailedEmails($c_email,$email_type,$mail->ErrorInfo,$date);
}
}
echo $count;
?>