<?php
session_start();
include "include/connect.php";
include "include/functions.php";
include 'include/corp_auth.php';
//Package
$package_id = $_POST['p_id'];
$numUsers = $_POST['numUsers'];
$corp->compPackage2($package_id,$numUsers);
$corp->address();
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
	<label class="text-white">Checkout</label>
	<div class="row">
		<?php
		if($corp->getPackPrice()== 0){
			?>
			<div class="col-lg-8">
			<div class="white-container" style="background: #ECF0F6;margin-top: 12px; border-radius: 0px 0px 15px 15px;">
				<label class="l-18">Billing Information</label>
				<hr>
				<form action="save_data" method="post" enctype="">
				<div class="row">
					<div class="col-lg-12 form-group">
						<label for="companyName" class="input-label">Company Name</label>
						<input type="text" disabled id="companyName" name="companyName" required class="cust-input " placeholder="Enter Company Name" value="<?php echo $corp->getCompName() ?>">
						<div class="error-message"></div>
					</div>
					<div class="col-lg-6 form-group">
						<label for="name" class="input-label">Full Name</label>
						<input type="text" name="name" disabled id="name" required class="cust-input " placeholder="Enter Your Name" value="<?php echo $corp->getUserName()?>">
						<div class="error-message"></div>
					</div>
					<div class="col-lg-6 form-group">
						<label for="surname" class="input-label">Surname</label>
						<input type="text" name="surname" disabled id="surname" required class="cust-input " placeholder="Enter Your Surname" value="<?php echo $corp->getUserSurname()?>">
						<div class="error-message"></div>
					</div>
					<div>
						<input type="hidden" name="id" value="downGrade">
						<input type="hidden" name="compEmail" value="<?php echo $corp->getCompEmail()?>">
					</div>
					<div class="col-lg-12">
						<label class="l-18">Terms and condition</label>
						<p class="p-14-n">You are downgrading to free subscription important information and other functionality will be disabled.
						by clicking the button below you are agree</p>						
					</div>
					<!--<div class="col-lg-12 form-group">
						<label for="notes" class="input-label">Notes(Optional)</label>
						<textarea placeholder="" name="notes" id="notes" class="cust-input"></textarea>
						<div class="error-message"></div>
					</div>-->
					<input type="hidden" name="p_id" class="cust-input " value="<?php echo $package_id; ?>">
					<div class="col-lg-12 form-group">						
						<div style="float: right; text-align: right;"><label class="l-14">Total Amount</label><label class="l-18 d-block" style="color:#000;text-align: right;">R <?php echo $corp->getTotPrice() ?></label>
						<button type="submit" class="bton btn2" id="conti">Continue downgrade</button>
						</div>	
					</div>
				</div>
			</form>
			</div>
		</div>
			<?php 
		}
		else{
		?>
		<div class="col-lg-8">
			<div class="white-container" style="background: #ECF0F6;margin-top: 12px; border-radius: 0px 0px 15px 15px;">
				<label class="l-18">Billing Information</label>
				<hr>
				<form action="users-checkout" method="post" enctype="">
				<div class="row">
					<div class="col-lg-12 form-group">
						<label for="companyName" class="input-label">Company Name</label>
						<input type="text" disabled id="companyName" name="companyName" required class="cust-input " placeholder="Enter Company Name" value="<?php echo $corp->getCompName() ?>">
						<div class="error-message"></div>
					</div>
					<div class="col-lg-6 form-group">
						<label for="name" class="input-label">Full Name</label>
						<input type="text" name="name" disabled id="name" required class="cust-input " placeholder="Enter Your Name" value="<?php echo $corp->getUserName()?>">
						<div class="error-message"></div>
					</div>
					<div class="col-lg-6 form-group">
						<label for="surname" class="input-label">Surname</label>
						<input type="text" name="surname" disabled id="surname" required class="cust-input " placeholder="Enter Your Surname" value="<?php echo $corp->getUserSurname()?>">
						<div class="error-message"></div>
					</div>
					<div class="col-lg-12 form-group">
						<label for="streetAddress" class="input-label">Street Address</label>
						<input type="text" name="address" id="search_location" class="cust-input mendatory_input" required placeholder="Enter Address" value="<?php echo $corp->getAddress() ?>">
					</div>
					<div class="col-lg-6 form-group">
						<label for="country" required class="input-label">Country</label>
						<?php 
					$query = $candidate->getCountries();
					?>
					<select name="country" id="country" required class="cust-input mendatory_input" onchange="fetchState(this.value)"> 
						<option value="<?php echo $corp->getCountryId() ?>"><?php echo $corp->getCountry() ?></option>
						<?php
						for ($i=0; $rows=$query->fetch() ; $i++) { 
							?>
						<option value="<?php echo $rows['id'] ?>"><?php echo $rows['name'] ?></option>
						<?php  
						}
						?>
					</select>
					</div>
					<div class="col-lg-6 form-group">
					<label for="state" class="input-label">State/Province</label>
					<select name="state" id="state" class="cust-input required mendatory_input">
						<option value="<?php echo $corp->getStateId() ?>"><?php echo $corp->getState(); ?></option>		
					</select>
				</div>
					<div class="col-lg-4 form-group">
						<label for="city" class="input-label">City</label>
						<input type="text" name="city" value="<?php echo $corp->getCity() ?>" id="city" required class="cust-input " placeholder="Enter Your City">
						<div class="error-message"></div>
					</div>
					<div class="col-lg-4 form-group">
						<label for="zipCode" class="input-label">Zip Code</label>
						<input type="text" name="zipCode" value="<?php echo $corp->getCode() ?>" id="zipCode" required class="cust-input " placeholder="Enter Your Zip Code">
						<div class="error-message"></div>
					</div>
					
					<div class="col-lg-4 form-group">
						<label for="country" class="input-label">VAT Number</label>
						<input type="text" name="vatNum" value="<?php echo $corp->getVatNumber();?>" id="vatNum" class="cust-input " placeholder="Enter VAT Number">
						<div class="error-message"></div>
					</div>
					<div class="col-lg-12">
						<label class="l-18">users.</p>						
					</div>
					<!--<div class="col-lg-12 form-group">
						<label for="notes" class="input-label">Notes(Optional)</label>
						<textarea placeholder="" name="notes" id="notes" class="cust-input"></textarea>
						<div class="error-message"></div>
					</div>-->
					<input type="hidden" name="p_id" class="cust-input " value="<?php echo $package_id; ?>">
					<input type="hidden" name="numUsers" class="cust-input " value="<?php echo $numUsers; ?>">
					<div class="col-lg-12 form-group">

						<div style="float: right; text-align: right;"><label class="l-14">Total Amount</label><label class="l-18 d-block" style="color:#000;text-align: right;">R <?php echo $corp->getTotPrice() ?></label>
						<button type="submit" class="bton btn2" id="conti">Continue to payment</button>
						</div>	
					</div>
				</div>
			</form>
			</div>
		</div>
		<?php
		}
		?>
		<div class="col-lg-4">
			<div class="white-container">
				<div class="d-flex flex-row justify-content-between">
					<label class="l-18">Order Summary</label>
					<a href="packages" class="bton btn1">Change plan</a>
				</div>

				<hr>
				<div class="disp-row">
					<label class="l-14"><?php echo "Subscription" ?></label><label class="l-18" style="color:#000"><?php echo $corp->getPackName() ?></label>
				</div>
				<div class="disp-row">
					<label class="l-14"><?php echo "Price per unit" ?></label><label class="l-18" style="color:#000">R <?php echo $corp->getPackPrice()/$numUsers ?></label>
				</div>
				<div class="disp-row">
					<label class="l-14">Number of users</label><label class="l-18" style="color:#000"><?php echo $numUsers ?></label>
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
				
			</div>
		</div>
	</div>
</div>
<!-- modal -->

<?php
include "footer.php";
?>
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