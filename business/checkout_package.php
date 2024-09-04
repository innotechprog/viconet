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
$candidate->address();
$candidate->getCvData();

if(isset($_POST['p_id']))
{
	$package_id = $_POST['p_id'];
	$numUsers = $_POST['numUsers'];
	$corp->compPackage2($package_id,$numUsers);
	$location ="";
$city = "";
$state = "";
$country ="";
$zip_code ="";

$location =$_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$country =$_POST['country'];
$zip_code =$_POST['zipCode'];
$switch = $_POST['recurSwitch'];
$vatNum = $_POST['vatNum'];
$compReg = "";

if($corp->countCompAddress() > 0){
	$corp->updateAddress($location,$city,$state,$country,$zip_code);
	$corp->updateVatNumber($vatNum,$compReg);
}else{
	$corp->addAddress($location,$city,$state,$country,$zip_code);
	$corp->updateVatNumber($vatNum,$compReg);
}

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
<div class="talent-blue-header">
<div class="prof-container ">
	<label class="l-36-n text-white mb-3" style="margin-top:-60px">Payment Options</label>
	<div class="row">
		
		<div class="col-lg-7">
			<div class="white-container" style="background: #ECF0F6;margin-top: 12px; border-radius: 0px 0px 15px 15px;">
				<label class="l-18">Your Payment Gateway</label>
				<hr>
				<div class="row">
					<div class="col-lg-12">						
						<div class="d-flex pdiv active" id="payTab" onclick="viewPaymentType(event,'payTab1')" >
							<img src="img/PayFast-Logo-2-Colour.svg" class="mr-3"><img src="img/visa.svg" class="mr-3"><img src="img/mastercard.svg">
						</div>
					</div>
					<div class="col-lg-12">						
						<div class="d-flex pdiv" onclick="viewPaymentType(event,'payTab2')">
							<img src="img/phome.svg" class="mr-3"><img src="img/Bank EFT.svg" class="mr-3">
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-5">
			<div class="white-container tab-content" id="payTab1">
				<div class="d-flex flex-row justify-content-between">
					<label class="l-18">Order Summary</label>
					<a href="packages" class="bton btn1">Change plan</a>
				</div>

				<hr>
				<div class="disp-row">
					<label class="l-14"><?php echo $corp->getPackName() ?></label><label class="l-18" style="color:#000">R <?php echo $corp->getPackPrice2() ?></label>
				</div>
				<hr>
				<div class="disp-row">
					<label class="l-14">Sub Total</label><label class="l-18" style="color:#000">R <?php echo $corp->getPackPrice2() ?></label>
				</div>
				<div class="disp-row">
					<label class="l-14">VAT</label><label class="l-18" style="color:#000">R <?php echo $corp->getPackVat() ?></label>
				</div>
				<hr>
				<div class="disp-row">
					<label class="l-14"><strong>Total Amount</strong></label><label class="l-18" style="color:#000">R <?php echo $corp->getTotPrice() ?></label>
				</div>
				<hr>
				<?php 
				if (isset($switch)) {
					include "include/recurring_payment.php";
			 		echo $htmlForm;
				}
				else{
					include "include/payfast.php";
					echo $htmlForm;
				}
					
				 ?>
			</div>
		
			<div class="white-container tab-content" id="payTab2">
				<div class="d-flex flex-row justify-content-between">
					<label class="l-18">Order Summary</label>
					<a href="packages" class="bton btn1">Change plan</a>
				</div>

				<hr>
				<div class="disp-row">
					<label class="l-14"><?php echo $corp->getPackName() ?></label><label class="l-18" style="color:#000">R <?php echo $corp->getPackPrice2() ?></label>
				</div>
				<hr>
				<div class="disp-row">
					<label class="l-14">Sub Total</label><label class="l-18" style="color:#000">R <?php echo $corp->getPackPrice2() ?></label>
				</div>
				<div class="disp-row">
					<label class="l-14">VAT</label><label class="l-18" style="color:#000">R <?php echo $corp->getPackVat() ?></label>
				</div>
				<hr>
				<div class="disp-row">
					<label class="l-14"><strong>Total Amount</strong></label><label class="l-18" style="color:#000">R <?php echo $corp->getTotPrice() ?></label>
				</div>

				<p class="p-12">Account Name: VIRTUAL COLLABORATION NETWORK (PTY) LTD<br>Bank:  Nedbank Limited<br>Account Number: 1234295466<br>Account Type: Current Account<br>Branch Code: 198765<br>Branch: SBS TRANSACTIONAL (3951)<br>Swift code: NEDSZAJJ</p>
					<form method="post" id="invForm">
						<input type="hidden" name="packId" value="<?php echo $package_id ?>">
						<button type="button" class="bton btn2 mt-2" id="sendInvoic" style="width:100%">Send invoice</button>
						<div id="inv_mes"></div>
					</form>
					<br>
				 <p class="p-12 mt-2">When submitting your payment, please make sure to refer to the invoice number provided in the system-generated email sent to you. Additionally, kindly send the proof of payment to: <a href="mailto:info@viconetgroup.com">info@viconetgroup.com</a> </p>
			</div>
		</div>
	</div>
</div>
<!-- modal -->
<div id="checkOu
t_modal" class="modal">
	<div class="edit-modal">
		<div class="live-chat-header">
			<div class="d-flex flex-row justify-content-between">
				<span class="l-18">Fill project info</span>
				<span ><img src="img/close.svg" class="close"></span>
			</div>
		</div>
		<hr>
		<div class="edit-content">
			<form method="post" action="save_data">
				<div class="row">
					<div class="col-lg-12 form-group">
						<label class="input-label">name</label>
						<input type="text" class="cust-input" name="proj_name" placeholder="Enter project name">
					</div>	 
					<input type="hidden" class="cust-input" name="id" value="projectId">
					<div class="col-lg-12 form-group">
						<label class="input-label">Description</label>
						<input type="text" class="cust-input" name="proj_desc" placeholder="Enter project description">
					</div>
					<div class="col-lg-12">
						<input type="radio" name="eType" checked value="Meeting"><label style="margin-left:10px" class="">Meeting</label>
					</div>
					<div class="col-lg-12">
						<input type="radio" name="eType" value="Inteview"><label style="margin-left:10px">Interview</label>
					</div>						
					<div class="col-lg-12 form-group">
						<button class="bton btn2"style="width: 100%" name="add_experience">SAVE</button>
					</div>
				</div>	
			</form>
		</div>
	</div>
</div>
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