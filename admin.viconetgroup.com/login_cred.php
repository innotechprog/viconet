<?php
//session_start();
include "include/connect.php";
include "include/functions.php";
$corp = new Corporate($db);
$disp = "";
$query="";

if(isset($_POST['login_btn']))
{
$username = strtolower($_POST['user_email']);
$password = md5($_POST['user_password']);

$query = $db->prepare("SELECT * FROM staff WHERE s_email = ?");
$query->execute(array($username));
while($row=$query->fetch())
{ 
  //echo $row['num_rows'];
if($row['s_email']!= $username){
$disp ='<div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                   Email address does not exist.
                </div>';
}
else if($username == $row['s_email'] && $password != $row['s_password']){
$disp ='<div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  Password is incorrect.
                </div>';
}
else{
$_SESSION['staff_id'] = md5($row['s_email']);
?>
<script type="text/javascript">window.location = "portal/index";</script>
<?php
}
}
}
?>