<?php

//PHP Mailer Headers
$emails = new SendEmails($db);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
//require 'PHPMailer/PHPMailerAutoload.php';
//Variable declaring and assigning

//Get receipt data
$sql_query = $corp->getReceiptById($receipt_id);
for($i = 0; $row_ = $sql_query->fetch();$i++)
{
	$projName = $row_['name'];
	$projDesc = $row_['description'];
}
//Send data to database
$rec_status = 'paid';
	
foreach ($_POST['selectCand'] as $key => $value) {
	$query = $corp->inviteCandidates($status,$receipt_id,$value);
	for($i = 0; $row = $query->fetch();$i++)
	{	
		$sql = $candidate->candidateData($row['c_email']);
		for($x= 0; $rows = $sql->fetch();$x++)	
		{	
			$mail = new PHPMailer(true);

			//SEND EMAIL TO ACCept or Decline
			$c_email = $rows['c_email'];
			$b_id = md5($row['id']);
			$st2 = md5('declined');
			$st1 = md5('accepted');
			$st3 = md5('pending');
			$perm = md5('offer');
			 $url2 = "https://viconet.co.za/verify?em=".$c_email."&st=".$st2."&id=".$b_id."&perm=".$perm;
	 		$url1 = "https://viconet.co.za/verify?em=".$c_email."&st=".$st1."&id=".$b_id."&perm=".$perm;

	 //Update status for user in basket
	 		$encryEmail = md5($c_email);
	 		$corp->updateBasket2($st3,$receipt_id,$prevStatus,$value);
	 		$corp->updateReceiptStatus($rec_status,$receipt_id);
			try {
			    $mail->isSMTP();                                             
			    $mail->Host       = 'mail.viconet.co.za';                  
			    $mail->SMTPAuth   = true;                             
			    $mail->Username   = $emails->getUsername();                 
			    $mail->Password   = $emails->getPassword();
			    $mail->SMTPSecure = 'tls';                              
			    $mail->Port       = 587; 
			    $mail->setFrom('info@viconet.co.za','Vico.net');           
			    $mail->addAddress('info@viconet.co.za');
			    $mail->addAddress($rows['c_email']);
			   
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
	    <strong>'.$corp->getCompName().'</strong> would like to schedule '.$corp->scheduleDetails($what).' with you.
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
			                        <a href="viconet.co.za" target="_blank">
			                            <img src="https://viconet.co.za/img/viconet-logo.png" width="220"  style="display: block; width: 220px; max-width: 400px; min-width: 100px; font-family: poppins, sans-serif; color: #ffffff; font-size: 14px;" border="0">
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
			                      <h1 style="font-size: 48px; font-weight: 400; margin: 0;">Hi '.$rows['c_name'].'</h1>
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
			                <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: poppins, sans-serif; font-size: 14px; font-weight: 400; line-height: 25px;" >
			                  <p style="margin: 0;"><strong>'.$corp->getCompName().'</strong>'.$corp->scheduleDetails($what).'</p>
			                  <hr>
			                  <label style="font-weight:700;font-size:14px;">Project Name</label>
			                  <p style="font-weight:500;font-size:12px">'.$projName.'</p>
			                  <label style="font-weight:700;font-size:14px;">Project Description</label>
			                  <p>'.$projDesc.'</p>
			                </td>
			              </tr>
			              <!-- BULLETPROOF BUTTON -->
			              <tr>
			                <td bgcolor="#ffffff" align="left">
			                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
			                    <tr>
			                      <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
			                        <table border="0" cellspacing="0" cellpadding="0">
			                          <tr>
			                              <td align="center" style="border-radius: 50px; border: 2px solid #fff;" bgcolor="#1f58a4">';
			                                $message .=" <a href=$url1 target='_blank' style='font-size: 20px;margin:5px; font-family: poppins, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 50px;display: inline-block;'>Accept </a></td> <td align='center' style='border-radius: 50px; border: 2px solid #fff;' bgcolor='red'><a href=$url2 target='_blank' style='font-size: 20px; font-family: poppins, Arial, sans-serif; color: #ffffff; margin:5px;text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 50px; display: inline-block; '>Decline</a></td>";
			                                
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
			               
			                
			                <tr><td bgcolor="#111111" align="left" style="padding: 39px 30px 20px 30px; border-radius: 0px 0px 4px 4px;  font-family: Open Sans, sans-serif; font-size: 14px; font-weight: 400; line-height: 25px;" ><p style="color:#fff!important;">Or Copy below link to your browser</p>';
			                    $message .= '<p style="color:#5EC0E2">'.$url1.'</p></td></tr>
			                
			                <!-- COPY -->
			                <tr>
			                  <td bgcolor="#111111" align="left" style="padding: 10px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #fff; font-family: Open Sans, sans-serif; font-size: 14px; font-weight: 400; line-height: 25px;" >
			                    <p style="margin: 0;">
			                        Need any help? If you have any queries, please contact us via email at info@viconet.co.za</p>
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
			    $mail->Subject = $what.' Opportunity '.$corp->getCompName().' via Vico.net';
			    $mail->Body    = $message;
			    //$mail->AltBody = 'Body in plain text for non-HTML mail clients';
			    $mail->send();
			   
			} catch (Exception $e) {
			    echo "{$mail->ErrorInfo}";
			}
		}
	}
}

?>