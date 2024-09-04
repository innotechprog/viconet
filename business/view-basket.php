<?php
session_start();

include "include/connect.php";
include "include/functions.php";
if(isset($_GET['auth'])){
$_SESSION['corpid'] = getSessionId($_GET['auth']);
//$_SESSION['corpid'] = $_SESSION['corpid'];
}
include 'include/corp_auth.php';
$compReg = $corp->getCompReg();
$corp->getSubscription();
// Tell PayFast that this page is reachable by triggering a header 200
if(!isset($_COOKIE['cookie_cid']))
{
	$cookie_id = "cookie_cid";
	$cookie_value = $_SESSION['corpid'];
	setcookie($cookie_id,$cookie_value,time() + (86400 * 30), "/");
}
?>
<!DOCTYPE html>
<html>
<?php
include "head.php";
?>
<body class="body-b">
<?php 
include "userHeader.php";
?>
<div class="talent-blue-header add-h">
<div class="my-container ">
	<label class="l-36-n text-white mb-3" style="margin-top:-55px">Shortlisted Talent</label>
	<?php
	if($corp->getPackPrice() == 0){ 
		echo $corp->getUpgradeMessage();
	}
	?>

<div id="loadCandidates"></div>
		 
	</div>
</div>

</body>
<!-- Javascripts -->
<script type="text/javascript">
	$(document).ready(function(){
		$('#loadCandidates').load('load-shortlist.php');
	});
</script>
<script type="text/javascript" src="js/toggle.js"></script>
<script type="text/javascript" src="js/shortlist.js"></script>
<script type="text/javascript" src="js/button_click.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</html>