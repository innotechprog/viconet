<?php
session_start();
include "include/connect.php";
include "include/functions.php";
include 'include/auth.php';

$c_email = md5($candidate->getCandEmail());
if(isset($_POST['id']))
{
	$cvtype = $_POST['id'];
	$candidate->updateCV($cvtype,$c_email);	
	?>
		<script type="text/javascript">window.location = "profile-view"</script>
		<?php	
}
/*else{
$id= $_GET['id'];
$table = $_GET['ta'];
$field = $_GET['fi'];
$query=$db->prepare("DELETE FROM $table WHERE $field ='$id'");
$query->execute();
}*/
?>