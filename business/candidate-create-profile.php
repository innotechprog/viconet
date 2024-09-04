
<div class="left-container">
	<div class="l-content">
		<div class="web-logo">
			<a href="index"  title="Click to go to home page"><img src="img/viconet-logowhite.svg" width="200px" ></a>
		</div>
		<h1 class="lblur-bg-h1">Create A Talent Profile</h1>
		<div class="short-line"></div>
		<p class="p-16 text-white">Join a community of peers, industry
leaders and broaden your career
horizon.</p>
	</div>
</div>
<div class="right-container">
	<div class="r-content">
		<div class="form-header">
				<div class="d-flex flex-row justify-content-between">
					<span ><a href="#" id="back_btn"><img src="img/go-back.svg"><label class="hrder-txt" style="margin-left: 10px;"><strong>Back</strong></label></a></span>
					<span ><label class="hrder-txt">Already have an account?<a href="login" class="checkLink"> Log in</a></label></span>
				</div>
			</div>
			 <div class="alert alert-success alert-dismissible reg-success" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             Please check your email to verify your account
            </div>
			
			<form name="myForm" id="myForm" method="post"enctype="multipart/form-data">
				<div class="row">
					<div class="col-lg-6 form-group">
						<label for="userName" class="input-label">Full Name</label>
						<input type="text" name="userName" id="userName" oninput="checkName()"  class="cust-input " placeholder="Enter Full Name">
						<div class="error-message"></div>
					</div>
					<div class="col-lg-6 form-group">
						<label for="userSurname" class="input-label">Surname</label>
						<input type="text" id="userSurname" name="userSurname" class="cust-input " oninput="checkSurname()"  placeholder="Enter Surname">
						<div class="error-message"></div>
					</div>
					<div class="col-lg-6 form-group">
						<label for="userEmail" class="input-label">Email Address</label>
						<input type=" " name="userEmail" id="userEmail" oninput="checkEmail()" class="cust-input " placeholder="Enter Email Address">
						<div class="error-message"></div>
					</div>
			 		<div class="col-lg-6 form-group">
						
						<label for="phone" class="input-label">Mobile Number</label>
						<input type="text" id="phone" name="userCellphone"  onkeypress="return onlyNumberKey(event)" class="cell-style" style="max-width:100%!important">
						<div class="err-mes"></div>
					</div>
					<div class="col-lg-6 form-group">
						<label for="userPassword"class="input-label">Password</label>
						<input type="Password" id="userPassword" name="userPassword" oninput="checkPassword()" class="cust-input " placeholder="Enter Password">
						<div id="error_m" class="error-message">
							<h5>Password must contain the following:</h5>
							  <p id="letter" class="invalid">A <b>lowercase</b>  letter</p>
							  <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
							  <p id="number" class="invalid">A <b>number</b></p>
							  <p id="chars" class="invalid">A <b>special character</b></p>
							  <p id="length" class="invalid">Minimum <b>8 characters</b></p>
						</div>

					</div>

					<div class="col-lg-6 form-group">
						<label for="userConfPassword" class="input-label">Confirm Password</label>
						<input type="password" id="userConfPassword" name="userConfPassword" oninput="checkConfirmPassword()" class="cust-input " placeholder="Confirm Password"/>
						<div class="error-message"></div>
					</div>				
					<div class="col-lg-12 form-group">
						<div class="checkbox-input">
							<input type="checkbox" id="consent" name="consent" class="cust-checkbox" placeholder="">

							<label class="checkbox-lbl">I accept <a href="#" class="checkLink open-modal" data-modal ="checkOut_modal" id="openConsent">POPIA consent notice</a></label>	
							<div class="error-message"></div>					
						</div>
					</div>
					<div class="col-lg-12 form-group">
						<div class="checkbox-input">
							<input type="checkbox" id="userT_and_c" name="userT_and_c" class="cust-checkbox" placeholder="">
							
							<label class="checkbox-lbl">I accept <a href="legal documents/CANDIDATE TERMS.pdf" class="checkLink"  target="_blank"> terms and condition</a></label>	
							<div class="error-message"></div>					
						</div>
					</div>
					<div class="col-lg-12 form-group">
						<button type="button" class="bton btn2"style="width: 100%" id="add_candidate">CREATE PROFILE</button>
					</div>
					
				</div>
			</form>
	</div>	
</div>
<?php 
include "modals.php";
?>