<?php
session_start();

include "include/connect.php";
include "include/functions.php";
if(isset($_GET['auth'])){
$_SESSION['corpid'] = getSessionId($_GET['auth']);
//$_SESSION['corpid'] = $_SESSION['corpid'];
}
include "include/website_class.php";
$web = new Website($db); //Website class
include 'include/corp_auth.php';
$corp->getSubscription();
$userId = $_GET['id'];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">

<title>Projects</title>
<meta content="" name="description">
<meta content="" name="keywords">

<!-- Favicons -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@100;200;400;500;600;700;800;900&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400&display=swap" rel="stylesheet">

<link rel="icon" href="img/small-logo.png" type="image/x-icon">
<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

<!-- Google Fonts -->
<!-- Vendor CSS Files -->
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="vendor/icofont/icofont.min.css" rel="stylesheet">
<link href="vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="vendor/venobox/venobox.css" rel="stylesheet">
<link href="vendor/animate.css/animate.min.css" rel="stylesheet">
<link href="vendor/remixicon/remixicon.css" rel="stylesheet">
<link href="vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
<link href="vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
<script src="js/jquery-3.4.1.min.js"></script>
<!-- Template Main CSS File -->
<link href="css/style.css" rel="stylesheet">
<link rel="stylesheet" href="build/css/intlTelInput.css">
</head>

<body class="body-b">
	<?php
	include "userHeader.php";
	$corp->setUsersData($userId);
	?>
	<div class="talent-blue-header add-h">
		<div class="prof-container">
			<label class="l-18-n text-white mb-3" style="margin-top:-5px"><?php echo $corp->getUserName().' '.$corp->getUserSurname() ?></label>	
			<div class="row">

				<div class="col-lg-3">
					<div class="white-container">
						<div class="profile-info">
							<?php
							if($corp->getPackPrice() ==0){
								?>
								<div class="upgradediv">
								<label class="p-14 text-black">To view full candidate profile, click here to upgrade your package.</label>
								<a href="packages"><button class="bton btn1" style="width:100%">UPGRADE</button></a>
							</div>
							<?php
								}
							?>
						<div class="d-flex flex-row justify-content-between">
							<label class="l-14">Projects</label><label class="p-14-n comp-status" id="numProj" style="background: #FF8EBD"><?php echo $corp->countReceiptsPerUser($userId); ?></label>

						</div>
						<!--<br> 
						<?php
						//if($corp->getAddedBy() == "System")
						//{
							?>
							<button class="bton btn1"style="width: 100%" id="addPro">Company Projects</button>
							<?php
						//}
						?>-->
						<hr>
						<div class="projects"> 
						<?php
						$query = $corp->getReceiptsByUsers($userId);
							for ($i=0; $rows = $query->fetch() ; $i++) { 
								$id = $rows['receipt_id'];
								$tabId = "open".$i;
								?>
								<div class="ptabsbg1">
									<div id="<?php echo $tabId ?>" onclick="viewProject(event,'<?php echo $id ?>')" class="p-14 proj-tab-btn"><strong><?php echo ($i+1).'. ' ?></strong><?php echo $rows['name'] ?>
									</div>
									<div class="delp" id="<?php echo '1'.$id;?>" >
										<img src="img/bin2.svg">
									</div>
								</div>
								<?php
							}
						?>
						</div>
					</div>
					</div>
				</div>
				<div class="col-lg-9">
					<?php
					$query1 = $corp->getReceipts();
					for ($x=0; $row = $query1->fetch() ; $x++) { 
					$ids = $row['receipt_id'];
					$rec_id = $ids;
					//Declaring and assignment
					$accepted = md5('accepted');
					$pending = md5('pending');
					$univited = md5("consid");
					//
					$accepted1 = md5('accepted').$x;
					$pending1 = md5('pending').$x;
					$declined1 = md5('declined').$x;
					$univited1 = md5("consid").$x;
					$btnId = 'xopen'.substr($row['receipt_id'],8);
					?>
					<div id="<?php echo $ids ?>" class="corp-edit project-tab2">				
						<div class="d-flex justify-content-between">
							<label class="l-18">Project Details</label>	
								
						</div>
					<hr>
					<label class="l-14">Project Name</label>
					<p class="p-14-n"><?php echo $row['name'] ?></p>
					<label class="l-14">Project Description</label>
					<p class="p-14-n"><?php echo $row['description'] ?></p>
					
					<div class="ptabsbg">
						<button class="bton btn4 tab-btn activeee defaultOpen" onclick="viewCandidate(event,'<?php echo $univited1 ?>')" id="<?php echo $btnId ?>">Shortlisted <label class="comp-status mt-1" style="background: #FF8EBD" id="del0"><?php echo $corp->countCandInProjPerStatus($rec_id,$univited) ?></label></button>
						<button class="bton btn4 tab-btn" onclick="viewCandidate(event,'<?php echo $pending1 ?>')">Pending <label class="comp-status mt-1" style="background: #FF8EBD" id="del0"><?php echo $corp->countCandInProjPerStatus($rec_id,$pending) ?></label></button> 
						<button class="bton btn4 tab-btn" onclick="viewCandidate(event,'<?php echo $accepted1 ?>')">Accepted <label class="comp-status mt-1" style="background: #FF8EBD" id="del0"><?php echo $corp->countCandInProjPerStatus($rec_id,$accepted) ?></label></button>
						 	<button class="bton btn4 tab-btn" onclick="viewCandidate(event,'<?php echo $declined1 ?>')">Declined <label class="comp-status mt-1" style="background: #FF8EBD" id="del0"><?php echo $corp->countCandInProjPerStatus($rec_id,$accepted) ?></label></button>
					</div>
					
					
					<?php 
					$statusArray = [$univited1,$accepted1,$pending1,$declined1];
					foreach($statusArray as $value)
					{
					?>
					<div id="<?php echo $value ?>" class="tab-content">
						<?php
						if (substr($value,0,32) == $univited) {
							$selectId = "selectAll".$x;
								if ($corp->getPackPrice() != 0) {
								
								?>
							<div class="d-flex justify-content-between pdiv" style="background:#DFDFDF;margin-top: 10px;">
								
								<div class="work-type" style="margin-top: 5px;">
									<label class="wpl text-black" for="<?php echo $selectId ?>">
										<input type="checkbox" value="part" name="[]" class="wpc" id="<?php echo $selectId ?>" onclick="selectAll(this)">
										<div class="wpc-box">						
										</div>Select all
									</label>
								</div>
							</div>
							<?php
							}
							?>
							<form id="<?php echo 'form'.$x;?>" method="post">
								<input type="hidden" name="id" value="Invite">
								<input type="hidden" name="receiptId" value="<?php echo $row['receipt_id'] ?>">
								<?php
						}
						?>

						<div class="row mt-3">
						<?php 
						//Receipt status
						$rec_status = "paid";
						//this function gets candidates in basket where their receipt has been paid
						//$sql = $corp->candidatesInBasket($rec_status);
						$sql = $corp->checkedoutCandidates($rec_status,$ids,substr($value,0,32));

						for($i = 0;$row=$sql->fetch();$i++)
						{
						//Get data for candidate in basket
						$query = $candidate->candidateData($row['c_email']);
						for($i = 0; $rows = $query->fetch();$i++)
						{ 
						//set candidate data
						$candidate->setCandidate(md5($rows['c_email']));
						$candidate->getCurrentJob();
						?>
						<div class="col-lg-6 shortCand">						
						<div class="person-frame boarder-blue">
							<div class="d-flex justify-content-between">
								<?php
									if (substr($value,0,32) == $univited) {
										if ($corp->getPackPrice() != 0) {
										?>
										<input type="checkbox" name="selectCand[]" value="<?php echo $row['id'] ?>" class="cust-checkbox <?php echo 'selectBox'.$x; ?>">
										<?php
										}
									else{
										?>
										<label></label>
										<?php
										}
									}
									else{
										?>
										<label></label>
										<?php
									}
								?>
								<div class="rem-cand1" id="<?php echo $row['id'] ?>">
									<img src="img/rounddel.svg">
								</div>							
							</div>
							<div class="d-flex flex-row justify-content-between">
							<div class="d-flex">
								<div class="prof-img">
									<a href="candidate-profile?id=<?php echo md5($rows['c_email']) ?>">
									<?php 
									if(empty($candidate->getPP()) || $corp->getPackPrice() == 0)
									{
										?>
										<img src="img/user.svg" alt="pp" id="cand_pp">
										<?php
									}
									else{
										?>						
										<img src="https://<?php echo $web->getWebLinkExt() ?>talent.viconetgroup.com/img/<?php echo $candidate->getPP() ?>" id="cand_pp" alt="pp">
										<?php
									}
									?>
								</div>	
								<div class="prof-det pers-det">
								<label for="cand_pp" class="l-14 text-black"><?php echo $corp->getHidden($rows['c_surname']).' '.$corp->getHidden($rows['c_name']) ?></label>
								<p class="p-12"style="margin-top: -5px;"><?php echo $candidate->getCurJobTitle() ?></p>
								<p class="p-12"style="margin-top: -15px;"><?php echo $candidate->getCountry() ?></p>
								<div style="margin-top: -15px;margin-left: -7px;">
										<?php
										$candidate->getCvData();
										$methods = $candidate->getWorkMethods();
										$methods = explode(',',$methods);
										foreach($methods as $method){
											if($method == "remote"){
												?>
											<label class="wtype">Remote</label>
											<?php
											}
											elseif ($method == "part") {
												?>
											<label class="wtype">Part time</label>
											<?php
											}	
											elseif ($method == "full") {
												?>
											<label class="wtype">Full time</label>
											<?php
											}									
										}
										?>
										</div>
								</div>
								</a>
							</div>							
														
						</div>
						</div>
					</div>
						<?php
						}
						}
						?>
						</div>
						<?php
						if (substr($value,0,32) == $univited) {
							if ($corp->getPackPrice() != 0) {
							
							}
						}
						?>
						</form>
					</div> 					
					<?php
					}
					?>
					</div>
					<?php

					}
					?>				
				</div>
			</div>
		</div>
	</div>

	<!--Modal-->
	<?php
		include "modals.php";
	?>
	<!--footer-->
</body>
<!-- Javascripts -->
<script type="text/javascript">
function getFileData(myFile){
var file = myFile.files[0];  
var filename = file.name;
document.getElementById('filename').innerHTML = filename;
}
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#loadCandidates').load("#loadCandidates");
	});
</script>
<script type="text/javascript" src="js/toggle.js"></script>
<script type="text/javascript" src="js/project-tabs.js"></script>
<script type="text/javascript" src="js/button_click.js"></script>

<script type="text/javascript" src="js/delete.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</html>