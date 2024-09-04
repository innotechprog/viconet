<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
include "include/connect.php";
include "include/functions.php";
$corp = new Corporate($db);
$candidate = new Candidates($db);
$emails = new SendEmails($db);
include "head.php";
$mail = new PHPMailer(true);

$perm = md5('offer');
$type = md5('corp');
$ty = $_GET['ty'];
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
            include "emails/user-welcome.php";           
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

        	?>
        	<script type="text/javascript">
        		window.location = "index";
        	</script>
        	<?php
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
                <form method="post" action="resend_link?ty='.$type.'" autocomplete="off">
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
?>
</body>
<?php
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