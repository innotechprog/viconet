<?php
//PHP Mailer Headers
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'assets/PHPMailer/Exception.php';
require 'assets/PHPMailer/PHPMailer.php';
require 'assets/PHPMailer/SMTP.php';
//require 'PHPMailer/PHPMailerAutoload.php';
//Variable declaring and assigning
use TCPDF as PDF; // Import the TCPDF library

require 'vendor/autoload.php'; // Include PHPMailer autoload.php

// Get the JSON data from the request body
$jsonData = file_get_contents('php://input');
// Decode the JSON data to an associative array
$data = json_decode($jsonData, true);

//isset($data->chartImage)
// Check if the 'pdfData' key exists in the data
if (is_array($data) && isset($data['chartImage'])) {
   // $attachment = $data['pdfData'];
//echo $attachment;

    $mail = new PHPMailer(true);
    
    $url = "https://viconet.co.za/login";
  
try {
    $mail->isSMTP();                                             
    $mail->Host       = 'mail.viconet.co.za';                  
    $mail->SMTPAuth   = true;                             
    $mail->Username   = 'info@viconet.co.za';                 
    $mail->Password   = 'HzHAZ4RRkEJNlP_QaereIhxLJpByQiMM';
    $mail->SMTPSecure = 'tls';                              
    $mail->Port       = 587; 
    $mail->setFrom('info@viconet.co.za','Vico.net profile');           
    $mail->addAddress('emanuel@ttchtech.co.za');
    $mail->addAddress('innocent38318@gmail.com');
        // Create a new instance of TCPDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Add a page to the PDF
$pdf->AddPage();

// Convert the base64 encoded image data to a binary string
$imageData = $data['chartImage'];
//echo $data['chartImage'];
//file_put_contents('image.png', $data['chartImage']);
// Output the image on the PDF
$pdf->Image('@',$imageData, 10, 10, 100, 0, '', '', '', false, 300, '', false, false, 0);

// Close and output the PDF
$pdfData = $pdf->Output('', 'S');

// Attach the PDF to the email
$mail->addStringAttachment($pdfData, 'chart.pdf');


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
                        <a href="javascript:void(0)" target="_blank">
                            <img alt="Logo" src="https://viconet.co.za/img/viconet-logo.png" width="220"  style="display: block; width: 220px; max-width: 400px; min-width: 100px; font-family: poppins, sans-serif; color: #ffffff; font-size: 14px;" border="0">
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
                      <h1 style="font-size: 48px; font-weight: 400; margin: 0;">Hi Innocent</h1>
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
                  <p style="margin: 0;">Please complete your vico.net profile to stand great opportunities of being shortlisted to be part of big projects.</p>
                </td>
              </tr>
              <!-- BULLETPROOF BUTTON -->
              <tr>
                <td bgcolor="#fff" align="center">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>';
                    
                      $message .='<td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
                        <table border="0" cellspacing="0" cellpadding="0">';
                          $message .=" <center><a href=$url target='_blank' style='font-size: 20px; font-family: poppins, Arial, sans-serif; color: #ffffff; text-decoration: none; background-color: green; text-decoration: none; padding: 15px 25px; border-radius: 50px; border: 1px solid #1f58a4; display: inline-block;'>Login </a></center>";
                        $message .='</table>
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
                  <td bgcolor="#111111" align="left" style="padding: 39px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #fff; font-family: Open Sans, sans-serif; font-size: 14px; font-weight: 400; line-height: 25px;" >
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

 $mail->isHTML(true);                                  
    $mail->Subject = 'Reminder to complete your vico.net profile';
    $mail->Body    = $message;
    //$mail->AltBody = 'Body in plain text for non-HTML mail clients';
    $mail->send();
   
} catch (Exception $e) {
    echo "{$mail->ErrorInfo}";
} 

} else {
    echo "Invalid data received.";
}
?>
