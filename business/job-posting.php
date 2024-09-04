<?php
session_start();
include "include/connect.php";
include "include/functions.php";
include "include/corp_auth.php";
include "include/jobs_class.php";
$jobs = new Jobs($db);
//include "add-cv.php";
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
		<label class="l-36-n text-white mb-4">Job Posting</label>
		<div class="row">
			<div class="col-lg-3">
			<div class="white-container" style="background:#ECF0F6">
				<a href="create-job"><button class="bton btn2" style="width:100%">CREATE A JOB</button></a> 
			</div>
		</div>	<div class="col-lg-9">				
		<div class="corp-edit">	
			<div class="row">
			<?php
			$compEmail = $corp->getCompEmail();
			 $query = $jobs->getCompJobs($compEmail);
				for ($i=0; $rows = $query->fetch(); $i++) {
					$id = md5($rows['job_id']);
					$jobs->setJob($id);
					$jobs->setCompany($rows['company_id']);
					?>
				<div class="col-lg-4 projtabs">
					<a href="job-info?id=<?php echo $jobs->getJobId() ?>">
					<div class="white-container" style="background: #EEEEFA;">
						<div class="record">
							<div class="delJob" id="<?php echo '1'.$jobs->getJobId();?>" ><img src="img/bin2.svg">
							</div>
							<div class="" style="text-align:center;">
								<?php 
								if(empty($jobs->getCompLogo())){
									?>
									<img src="img/corp img/project.svg" class="prof-pic prof-pic2">
									<?php
								}
								else{
									?>
									<img src="<?php echo 'img/company logos/'.$jobs->getCompLogo(); ?>" class="prof-pic prof-pic2">
									<?php 
								}
							?>								
							</div>
							
						
						<div class="text-black" style="text-align: center;">
							<label class="p-18 oneline-limit"><?php echo $jobs->getJobTitle(); ?></label>
							
							<label class="l-14 oneline-limit"><?php echo $jobs->getCompName(); ?></label>
							<div class="projdesc">
								<p class="p-14-n text-capitalize"><?php echo $jobs->getJobStatus(); ?></p>
							</div>
						</div>
						<hr>
						<div class="d-flex flex-row justify-content-between">
							<label class="l-14">Applicants</label><label class="p-14-n comp-status" id="numProj" style="background: #FF8EBD"><?php echo $jobs->countNumJobApplicants(md5($jobs->getJobId())) ?></label>
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

<!--Modal-->
<?php
include "job_modals.php";
?>
<div id="modal7" class="modal">
	<div class="edit-modal">

		<div class="live-chat-header">
			<div class="d-flex flex-row justify-content-between">
				<span class="l-18">Edit Information</span>
				<span ><img src="img/close.svg" class="close"></span>
			</div>
		</div>
		<form method="post" enctype="multipart/form-data">
		<div class="edit-content">
			<div class="row">
				<div class="col-lg-12 form-group">
					<label for="upload_pp"><?php
								if(!empty($candidate->getPP()))
								{
									?>
								<img src="img/<?php echo $candidate->getPP() ?>" class="upload-pp">
								<?php
								}
								else{
									?>
									<p class="l-14 pp-ini" style="cursor:pointer"><?php echo substr($candidate->getCandName(), 0,1).substr($candidate->getCandSurname(), 0,1); ?></p>
									<?php
								}
								?></label>
					<input type="file" id="upload_pp" name="pp" onchange="getFileData(this)">
					<label class="l-14" >Upload your image size 400x400px</label>
					<p id="pp-name"></p>
				</div>
			</div>
		
			<hr>
			<div class="row">
				<div class="col-lg-6 form-group">
					<label class="input-label">Name</label>
					<input type="text" name="name" class="cust-input " value="<?php echo $candidate->getCandName() ?>" >
				</div>
				<div class="col-lg-6 form-group">
					<label class="input-label">Surname</label>
					<input type="text" name="surname" value="<?php echo $candidate->getCandSurname() ?>" class="cust-input " >
				</div>
				<div class="col-lg-6 form-group">
					<label class="input-label">Date of Birth</label>
					<input type="date" name="d_of_b" value="<?php echo $candidate->getCandDOB() ?>" class="cust-input " >
				</div>
				<div class="col-lg-6 form-group">
					<label class="input-label">Cellphone</label>
					<input type="text" name="cellphone" value="<?php echo $candidate->getCandCell() ?>" class="cust-input " >
				</div>
				
					<input type="hidden" name="profile_pic" value="<?php echo $candidate->getPP() ?>" class="cust-input " >
				
				
				<div class="col-lg-12 form-group">
					<label class="input-label">Address</label>
					<input type="text" name="address" id="search_location" class="cust-input " value="<?php echo $candidate->getAddress(); ?>">
				</div>
				
				
				<div class="col-lg-6 form-group">
					<label for="country" class="input-label">Country</label>
					<?php 
					$query = $candidate->getCountries();
					?>
					<select name="country" id="country" class="cust-input mendatory_input" onchange="fetchState(this.value)"> 
						<option value="<?php echo $candidate->getCountryId() ?>"><?php echo $candidate->getCountry() ?></option>
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
					<select name="state" id="state" class="cust-input mendatory_input">
						<option value="<?php echo $candidate->getStateId() ?>"><?php echo $candidate->getState(); ?></option>		
					</select>
				</div>
				<div class="col-lg-12 form-group">
					<button class="bton btn2"style="width: 100%" name="save_profile">SAVE</button>
				</div>

			</div>
		</div>
	</form>
	</div>
</div>

<div id="modal8" class="modal">
	<div class="edit-modal">

		<div class="live-chat-header">
			<div class="d-flex flex-row justify-content-between">
				<span class="l-18">Edit Information</span>
				<span ><img src="img/close.svg" class="close"></span>
			</div>
		</div>
		<div class="edit-content">
			
			<div class="row">
				<div class="col-lg-12 form-group">
					<label class="input-label">Current Position</label>
					<input type="text" name="" class="cust-input " >
				</div>
				<div class="col-lg-12 form-group">
					<label class="input-label">Current Company</label>
					<input type="text" name="" class="cust-input " >
				</div>
				<div class="col-lg-12 form-group">
					<label class="input-label">Are you a Student</label>
					<select class="cust-input">
						<option value="yes">Yes</option>
						<option value="No">No</option>
					</select>
				</div>
				<div class="col-lg-12 form-group">
					<label class="input-label">Select Qualification</label>
					<select class="cust-input">
						<option value="yes">Yes</option>
						<option value="No">No</option>
					</select>
				</div>
				<div class="col-lg-12 form-group">
					<label class="input-label">University/Tertiary Qualification</label>
					<input type="text" name="" class="cust-input ">
				</div>
				
				<div class="col-lg-12 form-group">
					<button class="bton btn2"style="width: 100%">SAVE</button>
				</div>

			</div>
		</div>
	</div>
</div>
<!-- -->
<div id="modal9" class="modal">
	<div class="edit-modal">

		<div class="live-chat-header">
			<div class="d-flex flex-row justify-content-between">
				<span class="l-18">Edit Information</span>
				<span ><img src="img/close.svg" class="close"></span>
			</div>
		</div>
		<div class="edit-content">
			<form method="post">
				<div class="row">
					<div class="col-lg-12 form-group">
						<label class="input-label">Job Introduction</label>
						<textarea class="cust-input" name="jobIntro" cols="12"><?php echo $candidate->getBio() ?></textarea>
					</div>
					
					<div class="col-lg-12 form-group">
						<button class="bton btn2"style="width: 100%" name="addJobIntro">SAVE</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="modal11" class="modal">
	<div class="edit-modal">
		<div class="live-chat-header">
			<div class="d-flex flex-row justify-content-between">
				<span class="l-18">Upload</span>
				<span ><img src="img/close.svg" class="close"></span>
			</div>
		</div>
		<div class="edit-content">	
			<form method="post" id="myForm" enctype="multipart/form-data">
				<div class="upload-frame1">
					<label class="l-14">Upload CV in PDF</label>
					<div class="upload-frame">
						<label class="upload_cv"  for="short_cv"><img src="img/upload.svg"></label>
						<input type="file" id="short_cv" accept="application/pdf" name="long_cv" onchange="getFileData(this)">
					</div>
					<div class="d-flex flex-row justify-content-between">
					<span class="l-14 upload-filename" id="filename"></span>
					<span ><img src="img/delete.svg" class="delete-upload"></span>
				</div>
				</div>
				
				<div class="">
					<button class="bton btn2"style="width: 100%" name="add_cv">SAVE</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div id="modal18" class="modal">
	<div class="edit-modal">
		<div class="live-chat-header">
			<div class="d-flex flex-row justify-content-between">
				<span class="l-18">Upload</span>
				<span ><img src="img/close.svg" class="close"></span>
			</div>
		</div>
		<div class="edit-content">	
			<form method="post" id="myForm" enctype="multipart/form-data">
				<div class="upload-frame1">
					<label class="l-14">Upload Video CV</label>
					<div class="upload-frame">
						<label class="upload_cv"  for="long_cv"><img src="img/upload.svg"></label>
						<input type="file" id="long_cv" accept="video/*" name="long_cv" onchange="getFileData(this)">
					</div>
					<div class="d-flex flex-row justify-content-between">
					<span class="l-14 upload-filename" id="filename"></span>
					<span ><img src="img/delete.svg" class="delete-upload"></span>
				</div>
				</div>
				
				<div class="">
					<button class="bton btn2"style="width: 100%" name="add_cv">SAVE</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- -->
<div id="modal15" class="modal">
	<div class="edit-modal">

		<div class="live-chat-header">
			<div class="d-flex flex-row justify-content-between">
				<span class="l-18">Edit Information</span>
				<span ><img src="img/close.svg" class="close"></span>
			</div>
		</div>
		<div class="edit-content">
			<form method="post">
				<div class="row">
					<div class="col-lg-12 form-group">
						<label class="input-label">Company Name</label>
						<input type="text" name="company_name" class="cust-input " >
					</div>
					<div class="col-lg-12 form-group">
						<label class="input-label">Job Title</label>
						<input type="text" name="job_title" class="cust-input " >
					</div>
					<div class="col-lg-12 form-group">
						<label class="input-label">Starting Date</label>
						<input type="date" name="start_date" class="cust-input " >
					</div>
					<div class="col-lg-12 form-group">
						<label class="input-label">End Date</label>
						<input type="date" name="end_date" class="cust-input " >
					</div>
						
					<div class="col-lg-12 form-group">
						<button type="submit" class="bton btn2"style="width: 100%" name="add_currentJob">SAVE</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<div id="modal16" class="modal">
	<div class="edit-modal">

		<div class="live-chat-header">
			<div class="d-flex flex-row justify-content-between">
				<span class="l-18">Edit Information</span>
				<span ><img src="img/close.svg" class="close"></span>
			</div>
		</div>
		<div class="edit-content">
			<form method="post">
				<div class="row">
					<div class="col-lg-12 form-group">
						<label class="input-label">Key Role</label>
						<input type="text" name="role" class="cust-input " >
					</div>		
								
					<div class="col-lg-12 form-group">
						<button class="bton btn2"style="width: 100%" name="add_role">SAVE</button>
					</div>
				</div>
			</form>	
		</div>
	</div>
</div>
<div id="modal10" class="modal">
	<div class="edit-modal">

		<div class="live-chat-header">
			<div class="d-flex flex-row justify-content-between">
				<span class="l-18">Add Work Experience</span>
				<span ><img src="img/close.svg" class="close"></span>
			</div>
		</div>
		<div class="edit-content">
			<form method="post">
				<div class="row">
					<div class="col-lg-12 form-group">
						<label class="input-label">Company Name</label>
						<input type="text" name="company_name" class="cust-input " >
					</div>
					<div class="col-lg-12 form-group">
						<label class="input-label">Job Title</label>
						<input type="text" name="job_title" class="cust-input " >
					</div>
					<div class="col-lg-6 form-group">
						<label class="input-label">Starting Date</label>
						<input type="date" name="start_date" class="cust-input " >
					</div>
					<div class="col-lg-6 form-group">
						<label class="input-label">End Date</label>
						<input type="date" name="end_date" class="cust-input " >
					</div>
								
					<div class="col-lg-12 form-group">
						<button class="bton btn2"style="width: 100%" name="add_experience">SAVE</button>
					</div>

				</div>
			</form>
		</div>
	</div>
</div>
<div id="modal17" class="modal">
	<div class="edit-modal">

		<div class="live-chat-header">
			<div class="d-flex flex-row justify-content-between">
				<span class="l-18">Edit Information</span>
				<span ><img src="img/close.svg" class="close"></span>
			</div>
		</div>
		<div class="edit-content">
			<form method="post" >
			<div class="row">
				<div class="col-lg-12 form-group">
					<label class="input-label">Institution Name</label>
					<input type="text" name="instiName" class="cust-input " >
				</div>
				<div class="col-lg-12 form-group">
					<label class="input-label">Qualification obtained	</label>
					<input type="text" name="qualification" class="cust-input " >
				</div>
				<div class="col-lg-12 form-group">
					<label class="input-label">Date Completed</label>
					<input type="year" name="dateCompleted" class="cust-input " >
				</div>
					
				<div class="col-lg-12 form-group">
					<button class="bton btn2"style="width: 100%" name="add_qualification">SAVE</button>
				</div>

			</div>
		</form>
		</div>
	</div>
</div>
<div id="modal12" class="modal">
	<div class="edit-modal">

		<div class="live-chat-header">
			<div class="d-flex flex-row justify-content-between">
				<span class="l-18">Edit Information</span>
				<span ><img src="img/close.svg" class="close"></span>
			</div>
		</div>
		<div class="edit-content">
			<form method="post">
				<div class="row">
					<div class="col-lg-12 form-group">
						<label class="input-label">Years of experience</label>
						<select name="years_experience" class="cust-input">
							<option value="">Select Years of experience</option>
							<option value="0 - 5">0 - 5 years</option>
							<option value="6 - 10">6 - 10 years</option>
							<option value="11 - 15">11- 15 years</option>
							<option value=">16">16 years +</option>
						</select>
					</div>		
								
					<div class="col-lg-12 form-group">
						<button class="bton btn2"style="width: 100%" name="add_exp_years">SAVE</button>
					</div>
				</div>
			</form>	
		</div>
	</div>
</div>
<div id="modal13" class="modal">
	<div class="edit-modal">

		<div class="live-chat-header">
			<div class="d-flex flex-row justify-content-between">
				<span class="l-18">Edit Information</span>
				<span ><img src="img/close.svg" class="close"></span>
			</div>
		</div>
		<div class="edit-content">
			<form method="post">
				<div class="row">
					<div class="col-lg-12 form-group">
						<label class="input-label">Key Course</label>
						<input type="text" name="course" class="cust-input " >
					</div>		
								
					<div class="col-lg-12 form-group">
						<button class="bton btn2"style="width: 100%" name="add_course">SAVE</button>
					</div>
				</div>
			</form>	
		</div>
	</div>
</div>
<div id="modal14" class="modal">
	<div class="edit-modal">

		<div class="live-chat-header">
			<div class="d-flex flex-row justify-content-between">
				<span class="l-18">Edit Information</span>
				<span ><img src="img/close.svg" class="close"></span>
			</div>
		</div>
		<div class="edit-content">
			<form method="post">
				<div class="row">
					<div class="col-lg-12 form-group">
						<label class="input-label">Key Skill</label>
						<input type="text" name="skill" class="cust-input " >
					</div>		
								
					<div class="col-lg-12 form-group">
						<button class="bton btn2"style="width: 100%" name="add_skill">SAVE</button>
					</div>
				</div>
			</form>	
		</div>
	</div>
</div>
<div id="modal20" class="modal">
	<div class="edit-modal">

		<div class="live-chat-header">
			<div class="d-flex flex-row justify-content-between">
				<span class="l-18">Edit Skill</span>
				<span ><img src="img/close.svg" class="close"></span>
			</div>
		</div>
		<div class="edit-content">
			<form method="post">
				<div class="row">
					<div id="output1" class="col-lg-12">
						
					</div>	
								
					<div class="col-lg-12 form-group">
						<button class="bton btn2"style="width: 100%" name="add_skill">SAVE</button>
					</div>
				</div>
			</form>	
		</div>
	</div>
</div>
<div id="modal19" class="modal">
	<div class="edit-modal">

		<div class="live-chat-header">
			<div class="d-flex flex-row justify-content-between">
				<span class="l-18">Edit Role</span>
				<span ><img src="img/close.svg" class="close"></span>
			</div>
		</div>
		<div class="edit-content">
			<form method="post">
				<div class="row">
					<div id="output" class="col-lg-12">
						
					</div>	
								
					<div class="col-lg-12 form-group">
						<button class="bton btn2"style="width: 100%" name="add_role">SAVE</button>
					</div>
				</div>
			</form>	
		</div>
	</div>
</div>
<div id="modal21" class="modal">
	<div class="edit-modal">

		<div class="live-chat-header">
			<div class="d-flex flex-row justify-content-between">
				<span class="l-18">Edit Course</span>
				<span ><img src="img/close.svg" class="close"></span>
			</div>
		</div>
		<div class="edit-content">
			<form method="post">
				<div class="row">
					<div id="output2" class="col-lg-12">
						
					</div>	
								
					<div class="col-lg-12 form-group">
						<button class="bton btn2"style="width: 100%" name="add_course">SAVE</button>
					</div>
				</div>
			</form>	
		</div>
	</div>
</div>
<div id="modal22" class="modal">
	<div class="edit-modal">

		<div class="live-chat-header">
			<div class="d-flex flex-row justify-content-between">
				<span class="l-18">Edit Qualification</span>
				<span ><img src="img/close.svg" class="close"></span>
			</div>
		</div>
		<div class="edit-content">
			<form method="post" >
			
				<div id="output3" class="col-lg-12">

				</div>
				<div class="col-lg-12 form-group">
					<button class="bton btn2"style="width: 100%" name="add_qualification">SAVE</button>
				</div>	
		</form>
		</div>
	</div>
</div>
<div id="modal23" class="modal">
	<div class="edit-modal">
		<div class="live-chat-header">
			<div class="d-flex flex-row justify-content-between">
				<span class="l-18">Add Work Experience</span>
				<span ><img src="img/close.svg" class="close"></span>
			</div>
		</div>
		<div class="edit-content">
			<form method="post">
				
				<div id="output4" class="col-lg-12">
				</div>			
				<div class="col-lg-12 form-group">
					<button class="bton btn2"style="width: 100%" name="add_experience">SAVE</button>
				</div>
			</form>
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
<script type="text/javascript" src="js/toggle.js"></script>
<script type="text/javascript" src="js/button_click.js"></script>
<script type="text/javascript" src="js/jobs-tabs.js"></script>
<script type="text/javascript" src="js/delete.js"></script>
<script type="text/javascript" src="js/edit-boxes.js"></script>
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