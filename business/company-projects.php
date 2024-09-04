<?php
session_start();
include "include/connect.php";
include "include/functions.php";
if(isset($_GET['auth'])){
$_SESSION['corpid'] = getSessionId($_GET['auth']);
//$_SESSION['corpid'] = $_SESSION['corpid'];
}
include 'include/corp_auth.php';
$corp->getSubscription();
$corp->compPackage($corp->getCompSubscrId());
if($corp->getAddedBy() != "System")
{
	?>
	<script type="text/javascript">window.location= "user-profile"</script>
	<?php
}
?>
<!DOCTYPE html>
<html>
<?php
include "head.php";
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body class="body-b">
<?php
include "userHeader.php";
?>
<div class="talent-blue-header add-h">
	<div class="prof-container">
		<label class="l-36-n text-white mb-3" style="margin-top:-55px">Company Users Projects</label>		
		<div class="row">
			
			<div class="col-lg-12">
				
			<div class="corp-edit">
				<div class="d-flex flex-row justify-content-between">
				</div>		
			<div class="row">
			<?php $query = $corp->getAllUsers( );
				for ($i=0; $rows = $query->fetch(); $i++) {
				$userId = md5($rows['user_email']) 
					?>
				<div class="col-lg-3">
					<a href="user-projects?id=<?php echo $userId ?>">
					<div class="white-container" style="background: #EEEEFA;">
						<div class="record">
							<div class="" style="text-align:center;">
								<?php
									if(empty($rows['user_pp']))
									{
										?>
										<img src="img/user.svg" class="prof-pic prof-pic2">
										<?php
									}
									else{
										?>
									<img src="img/<?php echo $rows['user_pp'] ?>" class="prof-pic prof-pic2">
									<?php 
									}
								?>
							</div>
						
						<div class="text-black" style="text-align: center;">
							<label class="p-18"><?php echo $rows['user_name'].' '.$rows['user_surname'] ?></label>
						</div>
						<hr>
						<div class="d-flex flex-row justify-content-between">
							<label class="l-14">Project(s)</label><label class="p-14-n comp-status" id="numProj" style="background: #FF8EBD"><?php echo $corp->countReceiptsPerUser($userId); ?></label>
						</div>
					</div>
				</div>
				</a>
			</div>
				<?php
				}
				?>
			</div>
			
			</div>
			
			</div>
		</div>

	</div>
</div>

<!-- Edit company profile modal -->
<div id="modal1" class="modal">
	<div class="edit-modal">

		<div class="live-chat-header">
			<div class="d-flex flex-row justify-content-between">
				<span class="l-18">Add staff members</span>
				<span ><img src="img/close.svg" class="close"></span>
			</div>
		</div>
		<hr>
		<div class="edit-content">
			<form method="post" id="myForm" action="save_data">
				<div id="error_"></div>
				<div class="row">
 					<div class="col-lg-6 form-group">
						<label for="name" class="input-label">Name</label>
						<input type="text" id="name" required name="name" class="cust-input " placeholder="Enter user name">
						<div class="error-message"></div>
					</div>
					<input type="hidden" name="id" value="addUser" class="cust-input ">
					<div class="col-lg-6 form-group">
						<label for="surname" class="input-label">Surname</label>
						<input type="text" id="surname" name="surname" value="" required class="cust-input" placeholder="Enter Surname">
						<div class="error-message"></div>
					</div>					
					<div class="col-lg-6 form-group">
						<label for="cellphone" class="input-label">Cellphone</label>
						<input type="tel" id="cellphone" name="cellphone" class="cust-input " value="" required onkeypress="return onlyNumberKey(event)" oninput="checkTelephone()" required placeholder="+27 72 345 6789">
						<div class="error-message"></div>
					</div>
					<div class="col-lg-6 form-group">
						<label for="celphone" class="input-label">Email</label>
						<input type="tel" id="email" name="email" class="cust-input " required placeholder="innocent@example.com">
						<div class="error-message"></div>
					</div>	
														
					<div class="col-lg-12 form-group">
						<button class="bton btn2"style="float: right;width: 108px;" type="submit">SAVE</button>
					</div>
					
				</div>
			</form>
			</div>
		</div>
	</div>
	<div id="modal2" class="modal">
	<div class="edit-modal col-lg-4" style="max-height: unset;" >

		<div class="live-chat-header">
			<div class="d-flex flex-row justify-content-between">
				<span class="l-18"></span>
				<span ><img src="img/close.svg" class="close"></span>
			</div>
		</div>
		<hr>
		<div class="edit-content" style="max-height: unset;">	
			<div style="margin: 0 auto;">
			<div class="mes-frame" style="margin-top:-20px">
				<div class="success-tick">
					<img src="img/undraw_update_re_swkp 2.svg">
				</div>
				
			</div>
			<center><label class="l-16">You have reached limit to add users, click uprade below to increase limit</label>
			<button class="bton btn2">Uprade</button></center>
		</div>
		</div>
	</div>
	</div>
	<div id="modal3" class="modal">
	<div class="edit-modal col-lg-5" style="max-height: unset;" >

		<div class="live-chat-header">
			<div class="d-flex flex-row justify-content-between">
				<span class="l-18"></span>
				<span ><img src="img/close.svg" class="close"></span>
			</div>
		</div>
		<hr>
		<div class="edit-content" style="max-height: unset;">
		<label class="l-18">Current subscription details</label>

		<div class="d-flex justify-content-between">
			<div>
				<label>Name : <?php echo $corp->getPackName(); ?> </label>
				<a href="packages" class="bton btn2" style="width:100%">Upgrade subscription</a>
			</div>
			<div>
				<label>Number of users : <?php echo $corp->countUsersPerComp() ?></label>
				
			</div>
		</div>
		<hr>
		<form method="post" action="add_users">
			<?php
			$priceId = 'pack';
			$initialPId = "initial";
			$initialPrice = $corp->getPackPrice();
			?>
		<label class="l-18">Add users to current subscription</label>
		<div class="d-flex justify-content-between">
				<label class="mt-2">Number of users</label>
				 <input type="number" min="1" name="numUsers" onchange="changePrice2(this,'<?php echo $initialPId;?>')" value="1" class="num-user-inp">
				 <input type="hidden" name="pPrice" id="<?php echo $initialPId ?>" value="<?php echo $initialPrice ?>">
				 <input type="hidden" name="p_id" id="" value="<?php echo $corp->getPackID(); ?>">
			</div>
		</div>
		<p class="l-16" >Total price :<label id="<?php echo $priceId ?>">R <?php echo number_format($corp->getPackPrice(),2,'.',' ') ?></label></p>
		<button class="bton btn2" style="width: 100%;">Add users</button>
		</form>
		</div>
	</div>
	</div>
	<div id="modal7" class="modal">
	<div class="edit-modal">

		<div class="live-chat-header">
			<div class="d-flex flex-row justify-content-between">
				<span class="l-18">Edit company information</span>
				<span ><img src="img/close.svg" class="close"></span>
			</div>
		</div>
		<hr>
		<div class="edit-content">
			<form method="post" id="myForm" action="save_corporate">
				<div id="error_"></div>
				<div class="row">
					<div class="col-lg-6 form-group">
						<label for="company_reg" class="input-label">Company Email</label>
						<input type="text" id="company_email" disabled value="<?php echo $corp->getCompReg() ?>"  name="company_email" class="cust-input " placeholder="2022/232/02">
						<div class="error-message"></div>
					</div>
					<input type="hidden" name="id" value="<?php echo $corp->getCompReg() ?>" class="cust-input ">
					<div class="col-lg-6 form-group">
						<label for="company_name" class="input-label">Company Name</label>
						<input type="text" id="company_name" disabled name="company_name" value="<?php echo $corp->getCompName() ?>" class="cust-input" oninput="checkCompanyName()" placeholder="Enter Company Name">
						<div class="error-message"></div>
					</div>
					<div class="col-lg-6 form-group">
						<label class="input-label">Industry Sector</label>
						<select name="industry" class="cust-input">
							<option value="<?php echo $corp->getCompIndustry() ?>"><?php echo $corp->getCompIndustry() ?></option>
							<?php 
							$query = $corp->getAllIndustries();
							for ($i=0; $rows = $query->fetch() ; $i++) { ?>
								<option value="<?php echo $rows['industry'] ?>"><?php echo $rows['industry'] ?></option>
								<?php
							}
							?>
							
						</select>
					</div>					
					<div class="col-lg-6 form-group">
						<label for="telephone" class="input-label">Telephone</label>
						<input type="tel" id="telephone" name="telephone" class="cust-input " value="<?php echo $corp->getCompTel() ?>" required onkeypress="return onlyNumberKey(event)" oninput="checkTelephone()" placeholder="+27 12 345 6789">
						<div class="error-message"></div>
					</div>					
					<div class="col-lg-12 form-group">
						<button class="bton btn2"style="float: right;width: 108px;" id="update_corp" type="submit">SAVE</button>
					</div>
					
				</div>
			</form>
			</div>
		</div>
	</div>

</body>
<!-- Javascripts -->
<script type="text/javascript" src="js/toggle.js"></script>
<script src="portal/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="portal/assets/plugins/datatables/responsive/dataTables.responsive.js"></script>
<script src="portal/assets/plugins/datatables/extensions/dataTables.jqueryui.min.js"></script>
<script type="text/javascript" src="js/button_click.js"></script>
<script src="js/view-image2.js"></script>
</html>