<?php
//session_start();
include "include/connect.php";
include "include/functions.php";
$corp = new Corporate($db);
$disp = "";
$query="";
if(isset($_POST['corp_login']))
{
  //echo "innocent";
  
$username = strtolower($_POST['user_email']);
$password = $_POST['user_password'];
//Select the user
$sqlQuery = $db->prepare("SELECT * FROM users WHERE user_email = ?");
$sqlQuery->execute(array($username));
while($row = $sqlQuery->fetch())
{
$corp->setCompData(md5($row['company_email']));
if($username != $row['user_email']){
$disp ='<div class="alert alert-danger alert-dismissible" role="alert">                 
                   Email address does not exist.
                </div>';
}
else if($username == $row['user_email'] && md5($password) != $row['password']){
$disp ='<div class="alert alert-danger alert-dismissible" role="alert">
                  Password is incorrect.
                </div>';
}
else if($corp->getCompStatus()=='pending')
{
    $link = md5('res-link');
    $type = md5('corp');
  $disp ='<div class="alert alert-danger alert-dismissible" role="alert">
                Your Account is not verified. <a href="verify?link='.$link.'&ty='.$type.'" class="bton btn1">Resend Link</a>
              </div>';
}
else if($corp->getCompStatus()=='Declined')
{
    $disp ='<div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  Your Account Has been Declined for more info contact service provide..
                </div>';

}
else{  
$_SESSION[$pass] = $pass;
$email = $row['user_email'];
$_SESSION['corpid'] = md5($email);
//Updating user
$query = $db->prepare("UPDATE users SET sess_id=? WHERE user_email =? ");
$query->execute(array($pass,$email));

if($corp->getCompStatus()=='Approved')
{
?>
<script type="text/javascript">window.location = "talent-search";</script>
<?php
}
}
}
}

?>