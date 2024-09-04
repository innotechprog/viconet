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
?>
<!DOCTYPE html>
<html>
<?php
include "head.php";
?>
<body class="body-b">
	<?php
	include "userHeader.php";
	//Get data
	$rec_id = $_GET['id'];
	//Declaring varible to carry project information
	$projectName = "";
	$projectDesc = "";
	$ext_projDesc = "";
	$projectId = "";
	?>
	<div class="talent-blue-header">
		<div class="prof-container">
			<div class="row">
				<div class="col-lg-3">
					<div class="white-container">
						<div class="profile-info">
							<?php
							if($corp->getPackPrice() ==0){
								?>
								<div class="upgradediv">
								<label class="p-14 text-black">To view full Talent profile, click here to upgrade your package.</label>
								<a href="packages"><button class="bton btn1" style="width:100%">UPGRADE</button></a>
							</div>
							<?php
								}
							?>
						<div class="d-flex justify-content-between">
							<label class="l-14">Talent</label>
							<div class="p-14-n comp-status" id="numCand" style="background: #FF8EBD"><?php echo $corp->countCandidatesInProj($rec_id); ?>
							</div>
						</div>
						<hr> 
						<button class="modal-open bton btn2" data-modal= "addCandidates" style="width:100%">Add Talent</button>
					</div>
					</div>
				</div>
				<div class="col-lg-9">
					<?php
					$receiptId = "";
					$query1 = $corp->getReceiptById($rec_id);
					for ($x=0; $row = $query1->fetch() ; $x++) { 

					$ids = $row['receipt_id'];
					$projectName = $row['name'];
					$projectDesc = $row['description'];
					$ext_projDesc = $row['external_desc'];
					$projectId = $ids;
					//Declaring and assignment
					$accepted = md5('accepted');
					$pending = md5('pending');
					$univited = md5("consid");
					$declined = md5("declined");
					//
					$accepted1 = md5('accepted').$x;
					$pending1 = md5('pending').$x;
					$declined1 = md5('declined').$x;
					$univited1 = md5("consid").$x;
					$btnId = 'xopen'.substr($row['receipt_id'],8);
					?>
					<div id="<?php echo $ids ?>" class="corp-edit project-tab">				
						<div class="d-flex justify-content-between">
							<label class="l-18">Project Details</label>
							<a href="#" class="modal-open" data-modal = "modal7"><img src="img/edit-text.svg" class="edit-tab"></a>
						</div>
					<hr>
					<label class="l-14">Project Name</label>
					<p class="p-14-n"><?php echo $row['name'] ?></p>
					<label class="l-14">Project Description</label>
					<p class="p-14-n"><?php echo $row['description'] ?></p>
					<label class="l-14">External project Description (Visible to talent)</label>
					<p class="p-14-n"><?php echo $row['external_desc'] ?></p>
					
					<div class="ptabsbg">
						<button class="bton btn4 tab-btn active" onclick="viewCandidate(event,'<?php echo $univited1 ?>')" id="defaultOpen">Shortlisted   <label class="comp-status mt-1" style="background: #FF8EBD" id="del0"><?php echo $corp->countCandInProjPerStatus($rec_id,$univited) ?></label>	</button>
						<button class="bton btn4 tab-btn" onclick="viewCandidate(event,'<?php echo $pending1 ?>')">Pending   <label class="comp-status mt-1" style="background: #FF8EBD" id="del1"><?php echo $corp->countCandInProjPerStatus($rec_id,$pending) ?></label>	</button> 
						<button class="bton btn4 tab-btn" onclick="viewCandidate(event,'<?php echo $accepted1 ?>')">Accepted   <label class="comp-status mt-1" style="background: #FF8EBD" id="del2"><?php echo $corp->countCandInProjPerStatus($rec_id,$accepted) ?></label>	</button>
						 	<button class="bton btn4 tab-btn" onclick="viewCandidate(event,'<?php echo $declined1 ?>')">Declined <label class="comp-status mt-1" style="background: #FF8EBD" id="del3"><?php echo $corp->countCandInProjPerStatus($rec_id,$declined) ?></label>	</button>
					</div>
					
					
					<?php 
					//variable to be incremented
					$y = 0;
					$statusArray = [$univited1,$pending1,$accepted1,$declined1];
					foreach($statusArray as $value)
					{
	 					$delNum = "del".$y;
			
					?>
					<div id="<?php echo $value ?>" class="tab-content">
						<?php
						if (substr($value,0,32) == $univited) {
							$selectId = "selectAll".$x;
								if ($corp->getPackPrice() != 0) {
								if($corp->countCandInProjPerStatus($rec_id,$univited) > 0){
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
									else{
										?>
										<br>
										<label class="l-24">No talent under this tab</label>
										<?php
									}
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
								<div class="rem-cand1" id="<?php echo $row['id'].'-'.$delNum ?>">
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
								<label for="cand_pp" class="l-14 text-black"><?php echo $corp->getHidden($rows['c_name']).' '.$corp->getHidden($rows['c_surname']) ?></label>
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
								if($corp->countCandInProjPerStatus($rec_id,$univited) > 0){
							?>
							<hr>
							<button type="button" id="<?php echo 'form'.$x; ?>" onclick="inviteCand(this)" class="bton btn1 mr-0 d-block ml-auto invite">Invite</button>
							<?php
								}
							}
						}
						?>
						</form>
					</div> 					
					<?php
					$y++;
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
<?php
include "modals.php";
?>
<?php
if(isset($_POST['search'])){
	$method = "";
	$search="";
	if(isset($_POST['wmethod'])){
	foreach ($_POST['wmethod'] as $key => $value) {
		$method = $method.','.$value;
	}
	$search = $_POST['search'].$method;
}
else{
	$search = $_POST['search'].$method;
}
	//$method = substr($method, 1);
	
	?>
	<script type="text/javascript">	
	var input = "<?php echo $search ?>";
		document.getElementById('inputBox').value = input;
	</script>
	<script type="text/javascript">
		$( window ).on("load", function() {
			
        var button = document.getElementById('tal_search');		    
		        
$(function() {
    $('#tal_search').click(function() {
       	preloader.style.display = 'flex'; 
  	   simulateLoading().then(function() {
        preloader.style.display = 'none'; // Hide the preloader
        content.style.display = 'block'; // Show the div content
      });
    }).click();
});
		});	
	</script>]
	<?php
}
?>
</body>
<!-- Javascripts -->
<script type="text/javascript" src="js/proj.js"></script>
<script type="text/javascript" src="js/toggle.js"></script>
  <script type="text/javascript" src="js/shortlist.js"></script>
  <script type="text/javascript" src="js/button_click.js"></script>
 <script type="text/javascript" src="js/pagination2.js"></script>
  <script>
    // Function to simulate the loading process
    function simulateLoading() {
      return new Promise(resolve => {
        setTimeout(resolve, 1000); // Simulating a 3-second loading time
      });
    }
			var preloader = document.querySelector('.preloader-container');
      var content = document.getElementById('search_return');

    // Show the preloader while loading the div content
    window.addEventListener('DOMContentLoaded', function() {

      simulateLoading().then(function() {
        preloader.style.display = 'none'; // Hide the preloader
        content.style.display = 'block'; // Show the div content
      });
    });
  </script>
 <script>
 	 var button = document.getElementById('tal_search');	
var input = document.getElementById("inputBox");
input.addEventListener("keypress", function(event) {
  if (event.key === "Enter") {
  	preloader.style.display = 'flex'; 
  	   simulateLoading().then(function() {
        preloader.style.display = 'none'; // Hide the preloader
        content.style.display = 'block'; // Show the div content
      });
    event.preventDefault();
    document.getElementById("tal_search").click();
  }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</html>