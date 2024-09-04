<?php
include "../include/connect.php";
include "../include/functions.php";

$name = $_POST['staff_name'];
$surname = $_POST['staff_surname'];
$cellphone = $_POST['staff_cellphone'];
$email = $_POST['staff_email'];
$position = $_POST['staff_position'];
//echo $w_title.' '.$w_desc.' '.$w_date;
$password = md5($pass);


$query = $db->prepare("INSERT INTO `staff`(`s_email`, `s_password`, `s_first_name`, `s_last_name`, `s_cell_number`, `s_position`) VALUES ('$email','$password','$name','$surname','$cellphone','$position')");
$query->execute();


	$subject = "Registration";
	$headers = "From:info@viconetgroup.com\r\n";
        //$headers .= "CC:innocent38318@gmail.com\r\n";
        $headers .= "MIME-Version:1.0\r\n";
        $headers .= "Content-Type:text/html; charset=ISO-8859-1\r\n";

        $message = '<html><body>';
        $message .= '<h3>hello :'.$name.'</h3>';
        $message .= '<h4>You have been successfully registered added to Vico.net admin platform, use your email and temporary password : '.$pass.' to login.</h4>';
        
        $message .= "<h5>www.viconetgroup.com .</h5><br/>";
        $message .= "<h5>thank you for registering with us.</h5><br/>";
        $message .= '</body></html>';

        mail($email, $subject, $message, $headers);
?>