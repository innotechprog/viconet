<?php
session_start();
include "include/connect.php";
include "include/functions.php";
include "include/corp_auth.php";
include "include/jobs_class.php";
$jobs = new Jobs($db);
include "include/website_class.php";
$web = new Website($db); //Website class

if(isset($_GET['jobid']))
{
	$jobId = md5($_GET['jobid']);
	//$id = md5($jobId);
	$_SESSION['jobAppliSess'] = $jobId;
	$jobs->setJob($jobId);
	$jobs->setCompany($jobs->jobCompID());
}
?>
<!DOCTYPE html>
<html lang="en">
<?php
include "head.php";  
?>
<body class="body-b">
<?php
include "userHeader.php";
?>
<div class="talent-blue-header add-h">
	<div class="prof-container">
		<label class="l-24 text-white mb-4">Job Applicants</label>
		<div class="row">
			<div class="col-lg-3">
				<div class="white-container">
					<label class="l-18">Job Information</label>
					<hr>
					<p><?php echo $jobs->getJobTitle() ?></p>
					<hr>
					<a href="">
					<div class="d-flex justify-content-between">
						<label class="l-14">Total Applicants</label>
						<div class="p-14-n comp-status" id="numCand" style="background: #FF8EBD"><?php echo $jobs->countNumJobApplicants($jobId) ?>
						</div>
					</div>
					</a>
				</div>
			</div>

			<div class="col-lg-9">
				<div class="white-container">
					<label class="l-18">Job Applicants</label>
					<hr>
					 <div class="tab-container">
        <div class="tab-buttons">
            <button class="tab-button" onclick="openTab(event, 'tab1')"><div class="d-flex"><div class="p-14-n comp-status" style="background: #FF8EBD"><?php echo $jobs->countNumJobAppliByStatus($jobId,'pending') ?></div>&nbsp; Applications</div></button>
            <button class="tab-button" onclick="openTab(event, 'tab2')"><div class="d-flex"><div class="p-14-n comp-status" style="background: #FF8EBD"><?php echo $jobs->countNumJobAppliByStatus($jobId,'viewed') ?></div>&nbsp; Viewed Application</div></button>
        </div>
    <!-- Applications that are not viewed -->
    <div class="tab-content" id="tab1">
	<div class="row">
	<?php 
	if($jobs->countNumJobAppliByStatus($jobId,'pending') == 0){
		echo '<label class="l-36-n">No new applications</label>';
	} ?>
	<?php
	$query = $jobs->setJobApplication($jobId,'pending');
	for ($i=0; $rows = $query->fetch(); $i++) { 
		$candidate->setCandidate($rows['c_email']);
		?>		 
	<div class="col-lg-6 shortCand">
	<a href="candidate-profile?id=<?php echo $rows['c_email']; ?>">				
		<div class="person-frame boarder-blue">
			<div class="d-flex flex-row justify-content-between">
			<div class="d-flex">
				<div class="prof-img">
					
					<?php  
					if(empty($candidate->getPP()) || $corp->getPackPrice() == 0)
					{
						?>
						<img src="img/user.svg" alt="pp" id="cand_pp">
						<?php
					}
					else{
						?>						
						<img src="https://<?php echo $web->getWebLinkExt() ?>viconetgroup.com/img/<?php echo $candidate->getPP() ?>" id="cand_pp" alt="pp">
						<?php
					}
					?>
				</div>	
				<div class="prof-det pers-det">
				<label for="cand_pp" class="l-14 text-black"><?php echo $corp->getHidden($candidate->getCandSurname()).' '.$corp->getHidden($candidate->getCandName()) ?></label>
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
			<!-- Viewed Applications -->
<div class="tab-content" id="tab2">
	<div class="row">
	<?php
	//displaying message when there is no viewed application
	if($jobs->countNumJobAppliByStatus($jobId,'viewed') == 0){
		echo '<label class="l-36-n">No viewed applications</label>';
	}
	//displaying talent when there is viewed application
	$query = $jobs->setJobApplication($jobId,'viewed');
	for ($i=0; $rows = $query->fetch(); $i++) { 
		$candidate->setCandidate($rows['c_email']);
		?>		
	<div class="col-lg-6 shortCand">
	<a href="candidate-profile?id=<?php echo $rows['c_email']; ?>">				
		<div class="person-frame boarder-blue">
			<div class="d-flex flex-row justify-content-between">
			<div class="d-flex">
				<div class="prof-img">
					
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
				<label for="cand_pp" class="l-14 text-black"><?php echo $corp->getHidden($candidate->getCandSurname()).' '.$corp->getHidden($candidate->getCandName()) ?></label>
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
var i=1;
$('#add').click(function(){

	$('#dynamic_tbl').append('<tr id="row'+i+'"><td><input type="text" name="reqirement[]" placeholder="Enter requirement" class="cust-input name_list" style="margin-top:5px;" /></td><td><div name="remove" id="'+i+'" class=" btn_remove" ><img src="img/subtract.svg" class="dele-btn"></div></td></tr>');
	i++;

});
});
$(document).ready(function(){
var i=1;
$('#add1').click(function(){

	$('#dynamic_tbl1').append('<tr id="row'+i+'"><td><input type="text" name="responsibility[]" placeholder="Enter responsibility" class="cust-input name_list" style="margin-top:5px;" /></td><td><div name="remove" id="'+i+'" class=" btn_remove" ><img src="img/subtract.svg" class="dele-btn"></div></td></tr>');
	i++;

});
});
	$(document).on('click', '.btn_remove', function(){
		var button_id = $(this).attr("id"); 
		$('#row'+button_id+'').remove();
	});
</script>
<script type="text/javascript" src="js/toggle.js"></script>
<script type="text/javascript" src="js/button_click.js"></script>
<script type="text/javascript" src="js/delete.js"></script>
<script type="text/javascript" src="js/edit-boxes.js"></script>
<script type="text/javascript" src="js/applicants_tabs.js"></script>
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
<script type="text/javascript">
	function fetchState(id) {
		$('#state').html = "";
		$('#state').html('<option>Select City</option>');
		$.ajax({
			type:'post',
			url:'fetchStates.php',
			data:{country_id:id},
			success: function(data){
				$('#state').html(data);
			}
		});
	}
</script>
</html>