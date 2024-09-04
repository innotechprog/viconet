<?php
$corp= new Corporate($db);
$candidate = new Candidates($db);
$id= md5('verify');
$sess="";
if (isset($_SESSION['corpid'])) {
	$seemail = $_SESSION['corpid'];
	$corp->setUsersData($seemail);
	$sess = $corp->getUserSess();
	$corp->autoDownGradeSubscription();
}
else if (isset($_COOKIE['cookie_cid'])) {
	$cook = $_COOKIE['cookie_cid'];
	$_SESSION['corpid'] = $cook;
	$seemail = $cook;
	$corp->setUsersData($seemail);
	$sess = $corp->getUserSess();
}
else if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 60)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}
else if(!isset($_SESSION[$sess]) || (trim($_SESSION[$sess]) == '')) {
		?>
		<script> 
			clearInterval(refresherDiv);//clearing the set interval 
		</script>
		<script type="text/javascript">window.location = "index";</script>

		<?php 
		exit();
	}
	else if ($corp->getCompStatus() =='pending') {
		?>
		<script type="text/javascript">window.location= "message?id=<?php echo $id ?>" </script>
		<?php 
	}
	/*else if ($corporate->getCompStatus() =='process') {
		?>
		<script type="text/javascript">window.location= "create-profile" </script>
		<?php
	}*/

	?>