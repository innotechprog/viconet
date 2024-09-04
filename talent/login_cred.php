<?php
include "include/connect.php";
include "include/functions.php";
$disp = "";
$query="";

if(isset($_POST['login']))
{
$username = strtolower($_POST['user_email']);
$password = $_POST['user_password'];

$query = $db->prepare("SELECT c_email, c_password, c_verified,count(c_email) as num_rows FROM candidate_tbl WHERE c_email='$username'");
$query->execute();
while($row = $query->fetch())
{
if($row['c_email']==0 ){
$disp ='<div class="alert alert-danger alert-dismissible" role="alert">                  
                   Email address does not exist.
                </div>';
}
else if($username == $row['c_email'] && md5($password) != $row['c_password']){
$disp ='<div class="alert alert-danger alert-dismissible" role="alert">
                  Password is incorrect.
                </div>';
}
else if($row['c_verified']=='Pending')
{
  $link = md5('res-link');
  $type = md5('cand');
    $disp ='<div class="alert alert-danger alert-dismissible" role="alert">
                  Your Account is not verified.<a href="verify?link='.$link.'&ty='.$type.'" class="bton btn1">Resend Link</a>
                </div>';

}
else{ 
$_SESSION[$pass] = $pass;
$email = $row['c_email'];
$query = $db->prepare("UPDATE candidate_tbl SET sess_id='$pass' WHERE c_email ='$email' ");
$query->execute();
if($row['c_verified']=='verified')
{
  $_SESSION['id'] = md5($email);
  if(isset($_SESSION['jobid']))
  {
  ?>
  <script type="text/javascript">window.location = "job?id=<?php echo $_SESSION['jobid'] ?>";</script>
  <?php
  }
  else{
    ?>
  <script type="text/javascript">window.location = "profile-view";</script>
  <?php
  }
}
else if ($row['c_verified']=='process') {
  $_SESSION['id'] = md5($email);
?>
<script type="text/javascript">window.location = "profileopt";</script>
<?php
}

}
}

}

?>