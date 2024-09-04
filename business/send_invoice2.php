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

$companyName = $corp->getCompName();
$mail = new PHPMailer(true);
			try {
			    $mail->isSMTP();                                             
			    $mail->Host       = $emails->getHost();                  
			    $mail->SMTPAuth   = true;                             
			    $mail->Username   = $emails->getUsername();                 
			    $mail->Password   = $emails->getPassword();
			    $mail->SMTPSecure = 'tls';                              
			    $mail->Port       = $emails->getPort(); 
			    $mail->setFrom('info@viconetgroup.com','Vico.net');           
			    $mail->addBCC('info@viconetgroup.com');
			    $mail->addAddress($email);
			   
$message = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
         <link rel="stylesheet" href="http://getbootstrap.com.vn/examples/equal-height-columns/equal-height-columns.css"/>
<style type="text/css">	
	
<style type="text/css">
html { -webkit-text-size-adjust: none; -ms-text-size-adjust: none;}

	@media only screen and (min-device-width: 750px) {
		.table750 {width: 750px !important;}
	}
	@media only screen and (max-device-width: 750px), only screen and (max-width: 750px){
      table[class="table750"] {width: 100% !important;}
      .mob_b {width: 93% !important; max-width: 93% !important; min-width: 93% !important;}
      .mob_b1 {width: 100% !important; max-width: 100% !important; min-width: 100% !important;}
      .mob_left {text-align: left !important;}
      .mob_soc {width: 50% !important; max-width: 50% !important; min-width: 50% !important;}
      .mob_menu {width: 50% !important; max-width: 50% !important; min-width: 50% !important; box-shadow: inset -1px -1px 0 0 rgba(255, 255, 255, 0.2); }
 	}
   @media only screen and (max-device-width: 700px), only screen and (max-width: 700px){
      .mob_div {width: 100% !important; max-width: 100% !important; min-width: 100% !important;}
      .mob_tab {width: 88% !important; max-width: 88% !important; min-width: 88% !important;}
   }
   @media only screen and (max-device-width: 550px), only screen and (max-width: 550px){
      .mod_div {display: block !important;}
   }
	.table750 {width: 750px;}
</style>
</head>
<body style="margin: 0; padding: 0;">

<table cellpadding="0" cellspacing="0" border="0" width="100%" style="background: #F7F8FA; min-width: 350px; font-size: 1px; line-height: normal;">
 	<tr>
   	<td align="center" valign="top">   			
   		<!--[if (gte mso 9)|(IE)]>
         <table border="0" cellspacing="0" cellpadding="0">
         <tr><td align="center" valign="top" width="750"><![endif]-->
   		<table cellpadding="0" cellspacing="0" border="0" width="750" class="table750" style="width: 100%; max-width: 750px; min-width: 350px; background: #F7F8FA;">
   			<tr>
               <td width="3%" style="width: 3%; max-width: 3%; min-width: 10px;">&nbsp;</td>
   				<td align="center" valign="top" style="background: #ffffff;">

                  <table cellpadding="0" cellspacing="0" border="0" width="100%" style="width: 100% !important; min-width: 100%; max-width: 100%; background: #F7F8FA;">
                     <tr>
                        <td align="right" valign="top">
                           <div style="height: 22px; line-height: 22px; font-size: 20px;">&nbsp;</div>
                        </td>
                     </tr>
                  </table>

                  <table cellpadding="0" cellspacing="0" border="0" width="88%" style="width: 88% !important; min-width: 88%; max-width: 88%;">
                     <tr>
                        <td align="center" valign="top">
                           <div style="height: 39px; line-height: 39px; font-size: 37px;">&nbsp;</div>
                           <a href="#" target="_blank" style="display: block; max-width: 200px;">
                              <img src="https://business.viconetgroup.com/img/viconet-logo.png" alt="" width="200" border="0" style="display: block; width: 200px;" />
                           </a>
                           <div style="height: 6px; line-height: 64px; font-size: 62px;">&nbsp;</div>
                           
                           <div style="height: 4px; line-height: 42px; font-size: 40px;">&nbsp;</div>
                        </td>
                     </tr>
                  </table>

                  <table cellpadding="0" cellspacing="0" border="0" width="88%" style="width: 88% !important; min-width: 88%; max-width: 88%;">
                     <tr>
                        <td align="left" valign="top">
                           <div style="height: 37px; line-height: 37px; font-size: 35px;">&nbsp;</div>
                           <font face="Quicksand, sans-serif" color="#000000" style="font-size: 20px; line-height: 28px;">
                              <span style="font-family: Quicksand, Arial, Tahoma, Geneva, sans-serif; color: #000000; font-size: 20px; line-height: 28px;">Dear '.$name.' '.$surname.' </span>
                           </font>
                           <div style="height: 22px; line-height: 22px; font-size: 20px;">&nbsp;</div>
                           <font face="Quicksand, sans-serif" color="#000000" style="font-size: 20px; line-height: 28px;">
                              
                           </font><font face="Quicksand, sans-serif" color="#000000" style="font-size: 16px; line-height: 28px;">
                              <span style="font-family: Quicksand, Arial, Tahoma, Geneva, sans-serif; color: #000000; font-size: 16px; line-height: 28px;">Thank You for subscribing to Vico.net. Below is a summary of your recent purchase.</span>
                           </font>
                           <div style="height: 30px; line-height: 50px; font-size: 16px;">&nbsp;</div>
                        </td>
                     </tr>
                  </table>

                  <table cellpadding="0" cellspacing="0" border="0" width="88%" style="width: 88% !important; min-width: 88%; max-width: 88%;">
                     <tr>
                        <td align="left" valign="top">
                           <!--[if (gte mso 9)|(IE)]>
                           <table border="0" cellspacing="0" cellpadding="0">
                           <tr><td align="center" valign="top" width="309"><![endif]-->
                           <div style="display: inline-block; vertical-align: top; width: 50%; min-width: 296px;">
                              <table cellpadding="0" cellspacing="0" border="0" width="100%" style="width: 100% !important; min-width: 100%; max-width: 100%;">
                                 <tr>
                                    <td align="left" valign="top" style="border-width: 1px; border-style: solid; border-color: #e8e8e8; border-top: none; border-left: none; border-right: none;">
                                       <font face="Quicksand, sans-serif" color="#000000" style="font-size: 20px; line-height: 28px; font-weight: 600;">
                                          <span style="font-family: Quicksand, Arial, Tahoma, Geneva, sans-serif; color: #000000; font-size: 16px; line-height: 28px; font-weight: 600;">Tax Invoice</span>
                                       </font>
                                       <div style="height: 10px; line-height: 10px; font-size: 8px;">&nbsp;</div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td align="left" valign="top">
                                       <div style="height: 12px; line-height: 12px; font-size: 10px;">&nbsp;</div>
                                       <font face="Quicksand, sans-serif" color="#000000" style="font-size: 20px; line-height: 28px;">
                                          <span style="font-family: Quicksand, Arial, Tahoma, Geneva, sans-serif; color: #000000; font-size: 16px; line-height: 28px;">'.$inv_id.'</span>
                                       </font>
                                       <div style="height: 40px; line-height: 40px; font-size: 16px;">&nbsp;</div>
                                    </td>
                                 </tr>
                              </table>
                           </div><!--[if (gte mso 9)|(IE)]></td><td align="center" valign="top" width="309"><![endif]--><div style="display: inline-block; vertical-align: top; width: 50%; min-width: 296px;">
                              <table cellpadding="0" cellspacing="0" border="0" width="100%" style="width: 100% !important; min-width: 100%; max-width: 100%;">
                                 <tr>
                                    <td align="left" valign="top" style="border-width: 1px; border-style: solid; border-color: #e8e8e8; border-top: none; border-left: none; border-right: none;">
                                       <font face="Quicksand, sans-serif" color="#000000" style="font-size: 20px; line-height: 28px; font-weight: 600;">
                                          <span style="font-family: Quicksand, Arial, Tahoma, Geneva, sans-serif; color: #000000; font-size: 16px; line-height: 28px; font-weight: 600;">Date</span>
                                       </font>
                                       <div style="height: 10px; line-height: 10px; font-size: 8px;">&nbsp;</div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td align="left" valign="top">
                                       <div style="height: 12px; line-height: 12px; font-size: 10px;">&nbsp;</div>
                                       <font face="Quicksand, sans-serif" color="#000000" style="font-size: 20px; line-height: 28px;">
                                          <span style="font-family: Quicksand, Arial, Tahoma, Geneva, sans-serif; color: #000000; font-size: 16px; line-height: 28px;">'.$date.'</span>
                                       </font>
                                       <div style="height: 40px; line-height: 40px; font-size: 38px;">&nbsp;</div>
                                    </td>
                                 </tr>
                              </table>
                           </div>
                           <!--[if (gte mso 9)|(IE)]>
                           </td></tr>
                           </table><![endif]-->
                        </td>
                     </tr>
                  </table>

                 <table cellpadding="0" cellspacing="0" border="0" width="88%" style="width: 88% !important; min-width: 88%; max-width: 88%;">
                     <tr>
                        <td align="left" valign="top">
                           <!--[if (gte mso 9)|(IE)]>
                           <table border="0" cellspacing="0" cellpadding="0">
                           <tr><td align="center" valign="top" width="309"><![endif]-->
                           <div style="display: inline-block; vertical-align: top; width: 50%; min-width: 296px;">
                              <table cellpadding="0" cellspacing="0" border="0" width="100%" style="width: 100% !important; min-width: 100%; max-width: 100%;">
                                 <tr>
                                    <td align="left" valign="top" style="border-width: 1px; border-style: solid; border-color: #e8e8e8; border-top: none; border-left: none; border-right: none;">
                                       <font face="ex0 2, sans-serif" color="#000000" style="font-size: 20px; line-height: 28px; font-weight: 600;">
                                          <span style="font-family: Quicksand, Arial, Tahoma, Geneva, sans-serif; color: #000000; font-size: 16px; line-height: 28px; font-weight: 600;">Company Details</span>
                                       </font>
                                       <div style="height: 10px; line-height: 10px; font-size: 8px;">&nbsp;</div>
                                   </td>
                                 </tr>
                                 <tr>
                                    <td align="left" valign="top">
                                      <div style="height: 12px; line-height: 12px; font-size: 10px;">&nbsp;</div>
                                       <p> <font face="Quicksand, sans-serif" color="#000000" style="font-size: 20px; line-height: 28px;"> <span style="font-family: Quicksand, Arial, Tahoma, Geneva, sans-serif; color: #000000; font-size: 16px; line-height: 20px;">'.$companyName.'<br>
                                      '.$corp->getAddress().',<br>
                                         '.$corp->getCity().','.$corp->getState().'</span> </font> </p>
                                       <p><font face="Quicksand, sans-serif" color="#000000" style="font-size: 20px; line-height: 28px;"><span style="font-family: Quicksand, Arial, Tahoma, Geneva, sans-serif; color: #000000; font-size: 16px; line-height: 20px;">VAT Number:'.$corp->getVatNumber().'
                                       </span></font></p>
<div style="height: 40px; line-height: 40px; font-size: 38px;">&nbsp;</div>
                                    </td>
                                 </tr>
                              </table>
                           </div><!--[if (gte mso 9)|(IE)]></td><td align="center" valign="top" width="309"><![endif]--><div style="display: inline-block; vertical-align: top; width: 50%; min-width: 296px;">
                              </div>
                           <!--[if (gte mso 9)|(IE)]>
                           </td></tr>
                           </table><![endif]-->
                        </td>
                     </tr>
                  </table>
                  <table cellpadding="0" cellspacing="0" border="0" width="88%" style="width: 88% !important; min-width: 88%; max-width: 88%;">
                     <tr>
                        <td align="left" valign="top">
                           <font face="Quicksand, sans-serif" color="#000000" style="font-size: 20px; line-height: 26px; font-weight: 600;">
                              <span style="font-family: Quicksand, Arial, Tahoma, Geneva, sans-serif; color: #000000; font-size: 16px; line-height: 26px; font-weight: 600;">Here is what you subscribed to:</span>
                           </font>
                           <div style="height: 12px; line-height: 12px; font-size: 10px;">&nbsp;</div>
                        </td>
                     </tr>
                  </table>

                  <table cellpadding="0" cellspacing="0" border="0" width="88%" style="width: 88% !important; min-width: 88%; max-width: 88%; border-width: 1px; border-style: solid; border-color: #e8e8e8; border-top: none; border-left: none; border-right: none;">
                     <tr>
                        <td align="left" valign="top" width="17%" style="width: 17%; max-width: 17%; min-width: 20px">
                           <div style="height: 10px; line-height: 10px; font-size: 10px;">&nbsp;</div>
                           <font face="Quicksand, sans-serif" color="#000000" style="font-size: 20px; line-height: 28px; font-weight: 600;">
                              <span style="font-family: Quicksand, Arial, Tahoma, Geneva, sans-serif; color: #000000; font-size: 16px; line-height: 28px; font-weight: 600;">Item</span>
                           </font>
                           <div style="height: 10px; line-height: 10px; font-size: 10px;">&nbsp;</div>
                        </td>
                        <td width="7" style="width: 7px; max-width: 7px; min-width: 7px;">&nbsp;</td>
                        <td align="left" valign="top" width="57%" style="width: 57%; max-width: 57%; min-width: 90px">&nbsp;</td>
                        <td width="7" style="width: 7px; max-width: 7px; min-width: 7px;">&nbsp;</td>
                        <td align="left" valign="top" width="10%" style="width: 10%; max-width: 10%; min-width: 40px">
                           <div style="height: 10px; line-height: 10px; font-size: 10px;">&nbsp;</div>
                           <font face="Quicksand, sans-serif" color="#000000" style="font-size: 20px; line-height: 28px; font-weight: bold;">
                              <span style="font-family: Quicksand, Arial, Tahoma, Geneva, sans-serif; color: #000000; font-size: 16px; line-height: 28px; font-weight: bold;">Qty</span>
                           </font>
                           <div style="height: 10px; line-height: 10px; font-size: 10px;">&nbsp;</div>
                        </td>
                        <td width="7" style="width: 7px; max-width: 7px; min-width: 7px;">&nbsp;</td>
                        <td align="right" valign="top" width="12%" style="width: 12%; max-width: 12%; min-width: 70px">
                           <div style="height: 10px; line-height: 10px; font-size: 10px;">&nbsp;</div>
                           <font face="Quicksand, sans-serif" color="#000000" style="font-size: 20px; line-height: 28px; font-weight: bold;">
                              <span style="font-family: Quicksand, Arial, Tahoma, Geneva, sans-serif; color: #000000; font-size: 16px; line-height: 28px; font-weight: bold;">Price</span>
                           </font>
                           <div style="height: 10px; line-height: 10px; font-size: 10px;">&nbsp;</div>
                        </td>
                     </tr>
                  </table>

                  <table cellpadding="0" cellspacing="0" border="0" width="88%" style="width: 88% !important; min-width: 88%; max-width: 88%; border-width: 1px; border-style: solid; border-color: #e8e8e8; border-top: none; border-left: none; border-right: none;">
                     <tr>
                        
                        
                        <td align="left" valign="top" width="80%" style="width: 80%; max-width: 80%; min-width: 90px">
                           <div style="height: 22px; line-height: 22px; font-size: 20px;">&nbsp;</div>
                           <font face="Quicksand, sans-serif" color="#000000" style="font-size: 17px; line-height: 21px; font-weight: 600;">
                              <span style="font-family: Quicksand, Arial, Tahoma, Geneva, sans-serif; color: #000000; font-size: 16px; line-height: 21px; font-weight: 600;">'.$corp->getPackName().'</span>
                           </font>
                           <div style="height: 2px; line-height: 2px; font-size: 1px;">&nbsp;</div>
                           <font face="Quicksand, sans-serif" color="#000000" style="font-size: 17px; line-height: 21px;">
                              <span style="font-family: Quicksand, Arial, Tahoma, Geneva, sans-serif; color: #000000; font-size: 15px; line-height: 21px;">'.$corp->getPackDesc().'</span>
                           </font>
                           <div style="height: 10px; line-height: 10px; font-size: 10px;">&nbsp;</div>
                        </td>
                        <td width="7" style="width: 7px; max-width: 7px; min-width: 7px;">&nbsp;</td>
                        <td align="left" valign="top" width="10%" style="width: 10%; max-width: 10%; min-width: 40px">
                           <div style="height: 22px; line-height: 22px; font-size: 20px;">&nbsp;</div>
                           <font face="Quicksand, sans-serif" color="#000000" style="font-size: 17px; line-height: 21px;">
                              <span style="font-family: Quicksand, Arial, Tahoma, Geneva, sans-serif; color: #000000; font-size: 16px; line-height: 21px;">1</span>
                           </font>
                           <div style="height: 10px; line-height: 10px; font-size: 10px;">&nbsp;</div>
                        </td>
                        <td width="7" style="width: 7px; max-width: 7px; min-width: 7px;">&nbsp;</td>
                        <td align="right" valign="top" width="12%" style="width: 12%; max-width: 12%; min-width: 70px">
                           <div style="height: 22px; line-height: 22px; font-size: 20px;">&nbsp;</div>
                           <font face="Quicksand, sans-serif" color="#000000" style="font-size: 17px; line-height: 21px;">
                              <span style="font-family: Quicksand, Arial, Tahoma, Geneva, sans-serif; color: #000000; font-size: 16px; line-height: 21px;"> R'.$corp->getPackPrice2().'</span>
                           </font>
                           <div style="height: 10px; line-height: 10px; font-size: 10px;">&nbsp;</div>
                        </td>
                     </tr>
                  </table>

                  

                  <table cellpadding="0" cellspacing="0" border="0" width="88%" style="width: 88% !important; min-width: 88%; max-width: 88%; border-width: 4px; border-style: solid; border-color: #000000; border-top: none; border-left: none; border-right: none;">
                     <tr>
                        <td align="right" valign="top">
                           <div style="height: 18px; line-height: 18px; font-size: 16px;">&nbsp;</div>
                           <font face="Quicksand, sans-serif" color="#000000" style="font-size: 20px; line-height: 26px;">
                              <span style="font-family: Quicksand, Arial, Tahoma, Geneva, sans-serif; color: #000000; font-size: 16px; line-height: 26px;">Subtotal: R'.$corp->getPackPrice2().'</span>
                           </font>
                           <div style="height: 2px; line-height: 2px; font-size: 1px;">&nbsp;</div>
                           
                           <div style="height: 2px; line-height: 2px; font-size: 1px;">&nbsp;</div>
                           <font face="Quicksand, sans-serif" color="#000000" style="font-size: 20px; line-height: 26px;">
                              <span style="font-family: Quicksand, Arial, Tahoma, Geneva, sans-serif; color: #000000; font-size: 16px; line-height: 26px;">VAT: R'.$corp->getPackVat().'</span>
                           </font>
                           <div style="height: 18px; line-height: 18px; font-size: 16px;">&nbsp;</div>
                        </td>
                     </tr>
                  </table>

                  <table cellpadding="0" cellspacing="0" border="0" width="88%" style="width: 88% !important; min-width: 88%; max-width: 88%;">
                     <tr>
                        <td align="right" valign="top">
                           <div style="height: 14px; line-height: 14px; font-size: 12px;">&nbsp;</div>
                           <font face="Quicksand, sans-serif" color="#000000" style="font-size: 23px; line-height: 28px; font-weight: bold;">
                              <span style="font-family: Quicksand, Arial, Tahoma, Geneva, sans-serif; color: #000000; font-size: 20px; line-height: 28px; font-weight: bold;">TOTAL: R'.$corp->getTotPrice().'</span>
                           </font>
                           <div style="height: 40px; line-height: 40px; font-size: 38px;">&nbsp;</div>
                        </td>
                     </tr>
                  </table>

                  <table cellpadding="0" cellspacing="0" border="0" width="88%" style="width: 88% !important; min-width: 88%; max-width: 88%;">
                     <tr>
                        <td align="left" valign="top">
                           <font face="Quicksand, sans-serif" color="#000000" style="font-size: 36px; line-height: 45px; font-weight: 300;">
                              <span style="font-family: Quicksand, Arial, Tahoma, Geneva, sans-serif; color: #000000; font-size: 12px; line-height: 13px; font-weight: 300;">No commitment required. Your payment method will automatically be charged in advance every four weeks. Your subscription will continue until you cancel. You can cancel anytime. Cancellations take effect at the end of your current billing period. Offers and pricing are subject to change without notice.</span>
                           </font>
                        </td>
                     </tr>
                  </table>

              

             

                
              

                  <div style="height: 40px; line-height: 40px; font-size: 38px;">&nbsp;</div>

                  <table cellpadding="0" cellspacing="0" border="0" width="100%" style="width: 100% !important; min-width: 100%; max-width: 100%; background: #f3f3f3;">
                     <tr>
                        <td align="center" valign="top">
                           <div style="height: 34px; line-height: 34px; font-size: 32px;">&nbsp;</div>
                           <table cellpadding="0" cellspacing="0" border="0" width="88%" style="width: 88% !important; min-width: 88%; max-width: 88%;">
                              <tr>
                                 <td align="center" valign="top">
                                   <table cellpadding="0" cellspacing="0" border="0" width="78%" style="min-width: 300px;">
                                      
                                    </table>
                                    
                                    <font face="Quicksand, sans-serif" color="#868686" style="font-size: 17px; line-height: 20px;">
                                       <span style="font-family: Quicksand, Arial, Tahoma, Geneva, sans-serif; color: #868686; font-size: 14px; line-height: 20px;">Copyright &copy; 2022 Vico.net. All&nbsp;Rights&nbsp;Reserved. We&nbsp;appreciate&nbsp;you!</span>
                                    </font>
                                    <div style="height: 3px; line-height: 3px; font-size: 1px;">&nbsp;</div>
                                    <font face="Quicksand, sans-serif" color="#1a1a1a" style="font-size: 14px; line-height: 20px;">
                                       <span style="font-family: Quicksand, Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 17px; line-height: 20px;"><a href="#" target="_blank" style="font-family: Quicksand, Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 14px; line-height: 20px; text-decoration: none;">info@viconetgroup.com</a> &nbsp;&nbsp;|&nbsp;&nbsp; <a href="#" target="_blank" style="font-family: Quicksand, Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 14px; line-height: 20px; text-decoration: none;">+27 10 824 7564</a>  </span>
                                    </font>
                                     <br>
                                    <font face="Quicksand, sans-serif" color="#868686" style="font-size: 17px; line-height: 20px;">
                                       <span style="font-family: quicksand, Arial, Tahoma, Geneva, sans-serif; color: #868686; font-size: 14px; line-height: 20px;">Unit C38, Block C Lone Creek, 21 Mac Mac and Howick Close, Waterfall office Park, Midrand 1684</span>
                                    </font>
                                    <div style="height: 35px; line-height: 35px; font-size: 33px;">&nbsp;</div>
                                    <table cellpadding="0" cellspacing="0" border="0">
                                       <tr>
                                          <td align="center" valign="top">
                                             <a href="#" target="_blank" style="display: block; max-width: 19px;">
                                                <img src="https://business.viconetgroup.com/img/soc_1.png" alt="img" width="19" border="0" style="display: block; width: 19px;" />
                                             </a>
                                          </td>
                                          <td width="45" style="width: 45px; max-width: 45px; min-width: 45px;">&nbsp;</td>
                                          <td align="center" valign="top">
                                             <a href="#" target="_blank" style="display: block; max-width: 18px;">
                                                <img src="https://business.viconetgroup.com/img/soc_2.png" alt="img" width="18" border="0" style="display: block; width: 18px;" />
                                             </a>
                                          </td>
                                          <td width="45" style="width: 45px; max-width: 45px; min-width: 45px;">&nbsp;</td>
                                          <td align="center" valign="top">
                                             <a href="#" target="_blank" style="display: block; max-width: 21px;">
                                                <img src="https://business.viconetgroup.com/img/soc_3.png" alt="img" width="21" border="0" style="display: block; width: 21px;" />
                                             </a>
                                          </td>
                                          <td width="45" style="width: 45px; max-width: 45px; min-width: 45px;">&nbsp;</td>
                                          <td align="center" valign="top">
                                             <a href="#" target="_blank" style="display: block; max-width: 20px;">
                                                <img src="https://business.viconetgroup.com/img/soc_4.png" alt="img" width="21" border="0" style="display: block; width: 20px;" />
                                             </a>
                                          </td>
                                       </tr>
                                    </table>
                                    <div style="height: 35px; line-height: 35px; font-size: 33px;">&nbsp;</div>
                                 </td>
                              </tr>
                           </table>
                        </td>
                     </tr>
                  </table>  

               </td>
               <td width="3%" style="width: 3%; max-width: 3%; min-width: 10px;">&nbsp;</td>
            </tr>
         </table>
         <!--[if (gte mso 9)|(IE)]>
         </td></tr>
         </table><![endif]-->
      </td>
   </tr>
</table>
</body>
</html>';
//end of html    
$mail->isHTML(true);                                  
$mail->Subject = 'Vico.net subscription invoice';
$mail->Body    = $message;
//$mail->AltBody = 'Body in plain text for non-HTML mail clients';
$mail->send();

} catch (Exception $e) {
echo "{$mail->ErrorInfo}";
}


?>