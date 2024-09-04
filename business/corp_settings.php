<?php
session_start();
if(isset($_GET['auth'])){
$_SESSION['corpid'] = getSessionId($_GET['auth']);
//$_SESSION['corpid'] = $_SESSION['corpid'];
}
include "include/connect.php";
include "include/functions.php";
include 'include/corp_auth.php';
//Package
$corp->address();
$corp->getSubscription();
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
<div class="talent-blue-header">
<div class="prof-container ">
	<label class="text-white">Settings</label>
	<div class="row">
		
		<div class="col-lg-4">
			<div class="white-container" style="background: #ECF0F6;margin-top: 12px; border-radius: 0px 0px 15px 15px;">
				
				<div class="row">
					<div class="col-lg-12">						
						<div class="d-flex pdiv active" id="payTab" onclick="viewPaymentType(event,'payTab2')" >
							<label class="l-18">Account</label>
						</div>
					</div>
					<!--<div class="col-lg-12">						
						<div class="d-flex pdiv" onclick="viewPaymentType(event,'payTab2')">
							<label class="l-18">Account</label>
						</div>
					</div>-->
				</div>
			</div>
		</div>
		<div id="notification-m">
			
		</div>
		<div class="col-lg-8">
			<div class="white-container tab-content" id="payTab2">
				<div class="d-flex flex-row justify-content-between">
					<label class="l-18">Account</label>
				</div>

				<hr>		
				<div class="disp-row">
					<div>
						<label class="l-14">Delete Account</label>
						
					</div><button class="bton btn2" id="delAcc">Delete</button>
				</div>
				<hr>
				<label class="l-18">Notes</label>
				<p class="p-12">If you delete your account you will have to undergo registration process to access Vico.net again.</p>
		</div>
	</div>
</div>
<!-- modal -->
</body>
<!-- Javascripts -->
<script type="text/javascript" src="js/toggle.js"></script>
<script type="text/javascript" src="js/getAddr.js"></script>
<script type="text/javascript" src="js/button_click.js"></script>
<script>
var searchInput = 'search_location'; 
$(document).ready(function () {
 var autocomplete;
 autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
  types: ['geocode'],
  /*componentRestrictions: {
   country: "USA"
  }*/
 });  
 google.maps.event.addListener(autocomplete, 'place_changed', function () {
  var near_place = autocomplete.getPlace();
 });
});
</script>
</html>
<script type="text/javascript" src="js/payment-tabs.js"></script>
<script type="text/javascript" src="js/corp_settings.js"></script>