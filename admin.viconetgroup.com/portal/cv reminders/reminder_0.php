<?php
   $emails = new SendEmails($db);

    $password = $pass;
	$pas = md5($password);
    
    $url = "https://talent.viconetgroup.com";
    $imagePath = "https://viconetgroup.com/images/reminders/cv_img2.jpg";

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
    //$mail->addBCC('emanuel@ttchtech.co.za');
    //$mail->addBCC('george@ttchtech.co.za');
    $mail->addBCC('info@viconetgroup.com');
    //$mail->addAttachment('image/blog.jpg','image.jpg');

     
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
                
                
               <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;" >
                <tr>
                    <td bgcolor="#ffffff" align="left" valign="top" style="padding: 15px 0px 15px 0px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: quicksand, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 1px; line-height: 25px;">
                      <h1 style="font-size: 24px; font-weight: 500; margin: 0;">Dear '.ucfirst
                      ($userName).'</h1>
                    </td>
                </tr>
            </table>
                  <p style="margin: 0;">We noticed that you '.htmlspecialchars("haven't").' uploaded your CV to your talent profile yet. Did you know that adding your CV can significantly boost your chances of landing exciting opportunities? <br><br>Your profile is your digital handshake, and having a complete profile with a CV showcases your skills and experiences to potential employers or collaborators.<br><br> <a href="https://talent.viconetgroup.com">
                     <img alt="" src="'. $imagePath .'" width="100%"  style="display: block; width: 100%; min-width: 100px; font-family: quicksand, sans-serif; color: #ffffff; font-size: 14px;" border="0">
                        </a>'.htmlspecialchars("Don't").' miss out on unlocking the full potential of your profile! Take a few moments to upload your CV today and let opportunities find you effortlessly.<br><br>Remember, your next big opportunity could be just a '.'<a style="text-decoration:none"  href="https://talent.viconetgroup.com">click</a> away!.<br><br>Best Regards,<br>The Vico.net&#8482; Team<br>info@viconetgroup.com | +27 10 824 7568</p> 
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
                  <p style="margin: 0;">Unit C38, Block C, Lone Creek, 21 Mac Mac Road & Howick Close,Waterfall Park, Midrand
                  <br>
                  
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
    $mail->Subject = 'Maximize Your Profile Potential Today!';
    $mail->Body    = $message;
    //$mail->AltBody = 'Body in plain text for non-HTML mail clients';
    $mail->send();
}
catch (Exception $e) {
    echo "{$mail->ErrorInfo}";
} 
    
?>