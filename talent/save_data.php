<?php
session_start();
include "include/connect.php";
include "include/functions.php";
include 'include/corp_auth.php';
$candidate = new Candidates($db);
$accessId = $_POST['id'];
if($accessId=="projectId"){
//Data assignment
$receipt_id = $corp->generateReceiptId();
$comp_reg = md5($corp->getCompReg());
$projName=$_POST['proj_name'];
$projDesc = $_POST['proj_desc'];
$status= "not paid";
$userEmail = md5($corp->getUserEmail());
$date = date('Y-m-d');
//include "send_emails.php";
//$corp->updateReceipt();
if($receipt_id)
{
$corp->addToReceipt($receipt_id,$comp_reg,$userEmail,$status,$projName,$projDesc,$date);
$corp->updateBasket_($receipt_id);
echo $receipt_id;
} 
}
if($accessId=="addCand"){
//Data assignment
if (count($_POST['project']) != 0) {
		foreach ($_POST['project'] as $key => $receipt_id) {
			//$corp->checkCandAddedProj()
			$corp->updateBasket_($receipt_id);
		}		
	} 
//include "send_emails.php";
?>
<script type="text/javascript">window.location="my-projects"</script>
<?php
}
else if($accessId=="addUser"){
//Data assignment
$userName=$_POST['name'];
$userSurname = $_POST['surname'];
$userCellphone = $_POST['cellphone'];
$userEmail = $_POST['email'];
$userPos = "other";
$addedBy = md5($corp->getUserEmail());
$dateAdded = $date = date('Y-m-d');
$companyEmail = $corp->getCompEmail();
$companyName = $corp->getCompName();
$password1 = createRandomPassword();
$password2 = substr($password1,0,16);
$password = md5($password2);
$password4 = md5('rfMGJoK3wdA2932P');
include "send_email.php";
  $endDate = $corp->createEndDate($corp->getPackDuration());
$corp->addCorporateUser($companyEmail, $userName,$userSurname,$userCellphone,$userEmail,$password,$userPos,$addedBy,$dateAdded,$endDate);
$corp->addCompSubscription(createEncry($userEmail));
?>
<script type="text/javascript">window.location = "corporate-profile";</script>
	<?php
}
else if($accessId=="Invite"){
	$receipt_id = $_POST['receiptId'];
	$prevStatus = md5("consid");
	$status = md5("consid");
	$what = $_POST['eType'];
	include "send_emails.php";
	echo $receipt_id;	
}
else if($accessId=="downGrade"){
	$corp->updateSubscription($_POST['p_id'],"free",$_POST['compEmail'],"","");
	?>
	<script type="text/javascript">window.location="my-projects"</script>
	<?php
}
else if($accessId =="addToProj") {
	$receipt_id = $_POST['receipt_id'];
	$corp->updateCompBasket($receipt_id);
	?>
	<script type="text/javascript">window.location="project?id=<?php echo $receipt_id ?>"</script>
	<?php
}
else if($accessId =="edtp")
{
	$receipt_id = $_POST['r_id'];
	$receiptName = $_POST['r_name'];
	$receiptDesc = $_POST['r_desc'];
	$corp->updateProject($receipt_id,$receiptName,$receiptDesc);
?>
	<script type="text/javascript">window.location="project?id=<?php echo $receipt_id ?>"</script>
	<?php
}
?>