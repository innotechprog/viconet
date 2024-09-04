<?php
session_start();
include "include/connect.php";
include "include/functions.php";
//include 'include/auth.php';
$candidate = new Candidates($db);
$c_email ="";
$val ="";
$tableFieldName = "";
$reason= ""; //job notication unsubscription reason
//$reason2 = ""; //podcast notification unsubscription reason
//$date1 = ""; //unsubscription date for job notification
//$date2 = ""; //unsubscription date for podcast notification

$success_message = md5("successful");
if(isset($_POST['gtway'])){
	if($_POST['gtway']== md5("subscr")){
		$c_email = $_POST['enemail'];
		$subscrType = $_POST['id'];
		if($_POST['subscrMessage'] == "Other"){
			$reason = $_POST['otherText'];
		}
		else{
			$reason = $_POST['subscrMessage'];
		}
		$val = "off";
		$tableFieldName = $candidate->setTableFieldName($subscrType);
		$candidate->updateCandSubscription($c_email,$val,$tableFieldName);
		$candidate->unsubscription($c_email,$reason,$subscrType);
	}
	?>
	<script type="text/javascript">window.location = "unsubscribe-message?sucm=<?php echo $success_message; ?>"</script>
	<?php
}
else{

if(isset($_SESSION['id'])){
$seemail = $_SESSION['id'];
$candidate->setCandidate($seemail);
$sess = $candidate->getSession();
}
$c_email = md5($candidate->getCandEmail());
$tableFieldName = $_GET['fld'];
$val = $_GET['val'];
$candidate->updateCandSubscription($c_email,$val,$tableFieldName);

}
?> 