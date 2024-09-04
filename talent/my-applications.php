<?php
session_start();
include "include/connect.php";
include "include/functions.php";
include "../business.viconetgroup.com/include/jobs_class.php";
include "include/job_appli_class.php";
include "include/auth.php";
$application = new Application($db);
$jobs = new Jobs($db);
$candidate->address();
$candidate->getCvData();
include "add-cv.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php
include "head.php";  
?>
<body class="body-b">
<?php
include "candidate-header.php";
	$candidate->getCurrentJob();
	$candidate->setDate();
?>
<div class="talent-blue-header">
	<div class="prof-container">		
		<div class="row">
			<div class="col-lg-4">
				<div class="white-container sticky-div">
					<div class="profile-info">
						<div class="personal-info">
							<div class="circular-progress" data-inner-circle-color="lightgrey" data-percentage="<?php echo $candidate->checkProfileCompletion(); ?>" data-progress-color="#E4186D" data-bg-color="gray">
							<div class="inner-circle">
							<form id="myFormPP" method="post" enctype="multipart/form-data">					
								<label class="profile-pic" for="p_pic" title="Click to upload Profile Picture"><label class="user-initials" for="p_pic" style="color:#000" id="user_ini"> <?php echo substr(strtoupper($candidate->getCandName()),0,1).substr(strtoupper($candidate->getCandSurname()),0,1); ?></label><img class="" id="display_image" src="<?php if(empty($candidate->getPP())){}else{
										echo 'img/'.$candidate->getPP();}?>"></label>			               
			                <input type="hidden" name="idss" value="updatePP" class="cust-input ">
                              <input type="hidden" name="sid" value="<?php echo $candidate->getCandID() ?>">
                              <input type="hidden" name="pp" value="<?php echo $candidate->getPP() ?>">
			                <input type="file" class="form-control" id="p_pic" accept="image/*" onchange="loadFile(event)" name="p_pic"/>
		              	</form>
							</div>
							<p class="percentage"></p>
							</div>
						</center>
							
		              <label class="profcomplition"><?php echo $candidate->checkProfileCompletion(); ?>% Completed</label>
							<p class="l-18"><?php echo $candidate->getCandName().' '.$candidate->getCandSurname(); ?></p>
							<p class="p-14-n"><?php echo $candidate->getCurJobTitle() ?></p>
							<p class="p-14-n"><?php echo $candidate->getCandDOB() ?></p>
								<div class="d-row" style="text-align: center!important;align-content: center;">
								<?php
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
						<div class="profsummaryframe">
							<div class="d-flex justify-content-between">
								<p class="p-14-n"><?php echo $candidate->getAddress() ?></p>
								<a href="#" class="modal-open"   data-modal = "modal7"><img src="img/edit-text.svg" class="edit-tab" style="float: unset; margin-right: 10px;position:unset;"></a>		
							</div>
							<p class="p-14-n"><?php echo $candidate->getCountry() ?></p>
							<p class="p-14-n"><?php echo $candidate->getCandEmail() ?></p>
							<p class="p-14-n"><?php echo $candidate->getCandCell() ?></p>
							<p class="p-14-n">Gender : <?php echo $candidate->getGender() ?></p>
							<p class="p-14-n">Race : <?php echo $candidate->getRace() ?></p>
						</div>
							
						</div>
					</div>
				</div>
			</div><div class="col-lg-8">
				<div class="corp-edit">					
					<label class="l-18">Jobs Applications</label>
					<hr>
					<div class="row">
					<?php
					
					$enemail = md5($candidate->getCandEmail());
					$query = $jobs->getApplicationsByEnemail($enemail);
				for ($i=0; $rows = $query->fetch(); $i++) {
					$id = $rows['job_id'];
					$jobs->setJob($id);
					$jobs->setCompany($jobs->jobCompId());
					?>
				<div class="col-lg-6 projtabs">
					<a href="job?id=<?php echo $id ?>">
					<div class="white-container" style="background: #EEEEFA;">
						<div class="record">
								<?php 
					if(empty($jobs->getCompLogo())){
						?>
						<div class="" style="text-align:center;">
								<img src="img/corp img/project.svg" class="prof-pic prof-pic2">
							</div>
						<?php
					}
					else{
						?>
						<div class="" style="text-align:center;">
								<img src="<?php echo 'https://business.viconetgroup.com/img/company logos/'.$jobs->getCompLogo(); ?>" class="prof-pic prof-pic2">
							</div>
						<?php 
					}
				?>
						
						<div class="text-black" style="text-align: center;">
							<label class="p-18 oneline-limit"><?php echo $jobs->getJobTitle(); ?></label>
							
							<label class="l-14 oneline-limit"><?php echo $jobs->getCompName(); ?></label>
						</div>
						<hr>
						<div class="d-flex flex-row justify-content-between">
							<label class="l-14">Applied</label><label class="p-14-n" ><?php echo getDateDifference($rows['app_date']).' Days ago' ?></label>
						</div>
						<div class="d-flex flex-row justify-content-between">
							<label class="l-14">Status</label><label class="p-14-n" ><?php echo ucfirst($rows['app_status']) ?></label>
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
   document.getElementById('pp-name').innerHTML = filename;
 }
</script>
<script type="text/javascript" src="js/toggle.js"></script>
<script type="text/javascript" src="js/button_click.js"></script>
<script type="text/javascript" src="js/delete.js"></script>
<script type="text/javascript" src="js/edit-boxes.js"></script>
<script src="js/view-image.js"></script>
<script src="js/progress-bar.js"></script>
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
 <script>
 	var gender = "<?php echo $candidate->getGender() ?>";
    var race = "<?php echo $candidate->getRace() ?>";
    var year = "<?php echo $candidate->getYear() ?>";
    var month = "<?php echo $candidate->getMonth() ?>";
    var day = "<?php echo $candidate->getDay() ?>";
    window.onload = function() {
      var currentYear = new Date().getFullYear();
      var minYear = currentYear - 18;

      var yearSelect = document.getElementById("year");
      for (var i = minYear; i >= 1905; i--) {
        var option = document.createElement("option");
        option.text = i;
        option.value = i;
        yearSelect.add(option);
      }

      var daySelect = document.getElementById("day");
      for (var i = 1; i < 32; i++) {
        var option1 = document.createElement("option");
        option1.text = i;
        if(i < 10)
        {
        	i = '0'+i;
        }
        
         option1.value = i;
        
        daySelect.add(option1);
      }
      $('#day').val(day);
      $('#year').val(year);

    };
   
    $('#gender').val(gender);
    $('#race').val(race);
    //alert('gender');
    $('#month').val(month);

  </script>
</html>