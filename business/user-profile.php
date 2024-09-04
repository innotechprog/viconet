<?php
session_start();
include "include/connect.php";
include "include/functions.php";
include 'include/corp_auth.php';
$type = md5("corp");
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
	<div class="my-container">
	<label class="l-36-n text-white mb-3" style="margin-top:-55px">User profile</label>		 
		<div class="row">
			<div class="col-lg-4">
				<div class="white-container">
					<div class="profile-info">
						<form id="myForm" method="post" enctype="multipart/form-data">
							<div class="personal-info">						
								<label class="profile-pic" for="p_pic">	
									<label class="user-initials" style="color:#fff" id="user_ini">
										  <?php echo substr(strtoupper($corp->getUserName()),0,1).substr(strtoupper($corp->getUserSurname()),0,1); ?> 
								 	</label><img class="" id="display_image" src="<?php if(empty($corp->getPP())){}
									else{
										echo 'img/'.$corp->getPP();
									}?>"></label>
			                </div>
			                <input type="hidden" name="idss" value="updatePP" class="cust-input ">
                              <input type="hidden" name="sid" value="<?php echo $corp->getUserID() ?>">
                              <input type="hidden" name="pp" value="<?php echo $corp->getPP() ?>">
			                <input type="file" class="form-control" id="p_pic" accept="image/*" onchange="loadFile(event)" name="p_pic"/>
		              </form>
						<hr>
						
						<div class="other-info">
							
							<p class="p-18"><?php echo $corp->getUserName().' '.$corp->getUserSurname(); ?></p>
							
							<p class="p-14-n"><?php echo $corp->getUserCell() ?></p>
							
							<p class="p-14-n"><?php echo $corp->getUserEmail() ?></p>
							<hr>
							<a href="corporate-profile" class="bton btn2" type="button" id="" style="width:100%">company profile</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-8">
				
				<div class="corp-edit">
				<label class="l-18">Edit Information</label>
			<form method="post" id="myForm1" enctype="multipart/form-data">
				<div id="success_mes"></div>
				<div class="row">					
					<div class="col-lg-6 form-group">
						<label for="userName" class="input-label">Full Name</label>
						<input type="text" name="userName" id="userName" oninput="checkName()" value="<?php echo $corp->getUserName() ?>" class="cust-input " placeholder="Enter Full Name">
						<div class="error-message"></div>
					</div>
					<input type="hidden" name="id" value="<?php echo $corp->getUserId() ?>" class="cust-input ">
					<input type="hidden" name="idss" value="updateUser" class="cust-input ">
				 	<div class="col-lg-6 form-group">
						<label for="userSurname" class="input-label">Surname</label>
						<input type="text" id="userSurname" name="userSurname" value="<?php echo $corp->getUserSurname() ?>" class="cust-input " oninput="checkSurname()"  placeholder="Enter Surname">
						<div class="error-message"></div>
					</div>
					<div class="col-lg-3 form-group">
						<label for="position" class="input-label">Position</label>
						<input type="text" id="position" name="position" class="cust-input" value="<?php echo $corp->getUserPos() ?>" disabled oninput="checkPosition()" placeholder="Enter Position">
						<div class="error-message"></div>
					</div>
					<div class="col-lg-3 form-group">
						<label for="userCell" class="input-label">Mobile Number</label>
						<input type="tel" id="userCell" name="userCellphone" oninput="checkCell()" value="<?php echo $corp->getUserCell() ?>" onkeypress="return onlyNumberKey(event)" class="cust-input " placeholder="Enter Mobile Number">
						<div class="error-message"></div>
					</div>
					<div class="col-lg-6 form-group">
						<label for="userEmail" class="input-label">Email Address</label>
						<input type="text" name="userEmail" id="userEmail" oninput="checkEmail()" value="<?php echo $corp->getUserEmail() ?>" disabled class="cust-input " placeholder="Enter Email Address">
						<div class="error-message"></div>
					</div>
					
					<div class="col-lg-12 form-group">
						<button class="bton btn2"style="float: right;width: 108px;" id="update_corpu" type="button">SAVE</button>
					</div>
					
				</div>
			</form>
			</div>
			<div class="corp-edit">
				<label class="l-14 resetp" id="resetp">Reset Password</label>
				<form id="myForm2" method="post" enctype="multipart/form-data">
					<div id="disppasf">
						<div id="suc-m"></div>
						<div class="row">
							<div class="col-lg-6 form-group">
								<label for="userPassword"class="input-label">Password</label>
								<input type="hidden" name="email" value="<?php echo md5($corp->getUserEmail()); ?>">
								<input type="hidden" name="type" value="<?php echo $type; ?>">
								<input type="Password" id="userPassword" name="userPassword" oninput="checkPassword()" class="cust-input " placeholder="Enter Password">
								<div id="error_m" class="error-message">
									<h5>Password must contain the following:</h5>
									  <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
									  <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
									  <p id="number" class="invalid">A <b>number</b></p>
									  <p id="chars" class="invalid">A <b>special character</b></p>
									  <p id="length" class="invalid">Minimum <b>8 characters</b></p>
								</div>

							</div>
							<div class="col-lg-6 form-group">
								<label for="userConfPassword" class="input-label">Confirm Password</label>
								<input type="password" id="userConfPassword" name="userConfPassword" oninput="checkConfirmPassword()" class="cust-input " placeholder="Confirm Password">
								<div class="error-message"></div>
							</div>
						<div class="col-lg-12 form-group">
							<button type="button" class="bton btn2"style="float: right;width: 108px;" id="change_pas">SAVE</button>
						</div>
						</div>
					</div>
				</form>
			</div>
			</div>
		</div>

	</div>
</div>

</body>
<!-- Javascripts -->

<script type="text/javascript" src="js/toggle.js"></script>
<script type="text/javascript" src="js/pass-reset-val.js"></script>
<script type="text/javascript" src="js/button_click.js"></script>
<script src="js/view-image.js"></script>
</html>