<?php
session_start();
include "include/connect.php";
include "include/functions.php";
include 'include/auth.php';
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
							<div class="circular-progress" data-inner-circle-color="lightgrey" data-percentage="<?php echo $candidate->checkProfileCompletion(); ?>" data-progress-color="#E4186D" data-bg-color="gray" >
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
							
		              <label class="profcomplition"><label id="profcomplition"><?php echo $candidate->checkProfileCompletion(); ?></label>% Completed</label>
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
			</div>
		<div class="col-lg-8">
				<div class="corp-edit">						
				<div class="row">
						<div class="col-lg-12">
							<div class="d-flex justify-content-between">
								<div class="d-flex">				
										<div class="rounddiv">
											<img src="img/about-icon.svg">
										</div>							
									<div>
									<label class="l-18-n">About <?php echo $candidate->getCandName().' '.$candidate->getCandSurname() ?></label>							
									<p class="p-14-n"><span class="text"><?php echo $candidate->getBio() ?></span></p>
									<?php 
									if(empty($candidate->getBio()))
									{
										?>
										<label class="missingfield">About summary required</label>
										<?php
									}
									?>
									</div>
								</div>
								<div>									
									<a href="#" class="modal-open" data-modal = "modal9"><img src="img/edit-text.svg" class="edit-tab" style="margin-right: -7px;"></a>	
								</div>
							</div>
							<hr>
						</div>
						
					<div class="col-lg-12">
					<div class="d-flex flex-row justify-content-between">
						<div class="d-flex">
							<div class="rounddiv">
								<img src="img/roles.svg">
							</div>							
						<div>
							<label class="l-18-n"><label class="l-18-n">CURRENT JOB</label>
							</label>
							<?php 
						?>
						<p class="p-14-n">Company Name : <?php echo $candidate->getCurCompName() ?> </p>
						<p class="p-14-n">Job Title : <?php echo $candidate->getCurJobTitle() ?> </p>
						<p class="p-14-n">Starting Date : <?php 
						if(empty($candidate->getCurStartDate())){
							?>
							<label class="missingfield">Date field required</label><?php
						}
						else if($candidate->checkDateField($candidate->getCurStartDate())){
							?>
							<label class="missingfield">Please use the correct date format (YYYY/MM/DD)</label><?php
						}
						else{
							echo $candidate->getCurStartDate(); } ?> </p>
							</div>
						</div>
						<a href="#"class="modal-open" data-modal = "modal15"><img src="img/edit-text.svg" class="edit-tab" style="margin-right: -7px;"></a>
					</div>
					<hr>
				</div>				
				<div class="col-lg-12">
					<div class="d-flex">
						<div class="rounddiv">
							<img src="img/roles.svg">
						</div>						
						<div class="d-flex justify-content-between" style="width:100%">
						<div style="width:100%">
						<label class="l-18-n">KEY RESPONSIBILITIES</label>
							<?php 
						$query = $candidate->getRole();
						for($i=0;$row2=$query->fetch();$i++){
							$idd = 'id'.$i;
							?>
								<div class="disp-row record user_roles justify-content-between">		
									<div class="d-flex">
										<div style="margin-top: 3px;"> 
											<label class="bullet"></label>
										</div>
										<p class="p-14-n "><?php echo $row2['role'] ?></p>
									</div>
									<div class="d-flex" style="">
										<div class="circle modal-open edit-role" data-id="<?php echo $row2['id'] ?>" data-modal = "modal19"><img src="img/edit.svg" class="edit-ta"></div><div class="circle"><a href="#" class="delrole" id="<?php echo $row2['id'] ?>"><img src="img/bin.svg" class="edit-ta"></a></div>
									</div>
								</div>
						
							<?php
						}
						?>
					</div>
						
					</div>
						
					</div>
					<div class="addbtnframe">
						<a href="#"class="modal-open addbton btn2" data-modal = "modal16"><img src="img/addw.svg" class="" >Add More</a>
					</div>
					<hr>
				</div>
					<div class="col-lg-12">
					
					<div class="d-flex">
						<div class="rounddiv">
							<img src="img/p-w-e-b.svg">
						</div>	
						<div class="d-flex flex-row justify-content-between" style="width:100%">
							<div style="width:100%">
						<label class="l-18-n">PREVIOUS WORK EXPERIENCE</label>
						
					
					<?php
					$query = $candidate->getExperiences();
					for($i=0;$rows=$query->fetch();$i++){
						?>
					
					<div class="disp-row flex-row record justify-content-between">			
						<div class="d-flex">
						<div style="margin-top: 3px;"> 
								<label class="bullet"></label>
							</div>
							<p class="p-14-n"><?php echo $rows['company_name'].' - '.$rows['job_title'].' - '.$rows['starting_date'].' - '.$rows['end_date']; ?> </p>
						</div>
						<div class="d-flex">
							<div class="circle modal-open edit-experience" data-id="<?php echo $rows['id'] ?>" data-modal = "modal23"><img src="img/edit.svg" class="edit-ta"></div><div class="circle"><a href="#" class="delexp" id="<?php echo $rows['id'] ?>"><img src="img/bin.svg" class="edit-ta"></a></div>
						</div>
					</div>
					<?php 
						if($candidate->checkDateField($rows['starting_date'])){
							?>
							<label class="missingfield">Please use the correct date format (YYYY/MM/DD)</label><?php
						}
						else if($candidate->checkDateField($rows['end_date'])){
							?>
							<label class="missingfield">Please use the correct date format (YYYY/MM/DD)</label><?php
						}
						 
						}
					?>					
						</div>
					</div>
					</div>
					<div class="addbtnframe">
						<a href="#"class="modal-open addbton btn2" data-modal = "modal10"><img src="img/addw.svg" class="" >Add More</a>
					</div>
					<hr>
				</div>
					<div class="col-lg-12">
						<div class="d-flex">							
							<div class="rounddiv">
								<img src="img/exp-blue.svg">
							</div>						
							<div class="d-flex flex-row justify-content-between" style="width:100%">
								<div>
									<label class="l-18-n">YEARS OF EXPERIENCE</label>
									<p class="p-14-n"><?php echo $candidate->getYearsExperience() ?></p>
								</div>
								<div>
								
								</div>
							</div>
						</div>
						<div class="addbtnframe">
						<a href="#"class="modal-open addbton btn2" data-modal = "modal12">Edit</a>
					</div>
						<hr>
					</div>
					<div class="col-lg-12">
					<div class="d-flex">
						<div class="rounddiv">
							<img src="img/edu-blue.svg">
						</div>
						<div class="d-flex flex-row justify-content-between" style="width: 100%;">
							<div style="width:100%">
								<label class="l-18-n">EDUCATION</label>
								<?php 
					$query = $candidate->getQualifications();
					for($x=0; $rows=$query->fetch();$x++){
					?>
					<div class="disp-row record">
						<div class="d-flex">
							<div style="margin-top: 3px;"> 
								<label class="bullet"></label>
							</div>
						<p class="p-14-n"><?php echo $rows['institution_name'].' - '.$rows['q_name'].' - '.$rows['qw_date_completed'] ?> </p></div>
						<div class="right-text">
							
							<div class="circle  modal-open edit-education" data-id="<?php echo $rows['q_id'] ?>" data-modal = "modal22"><img src="img/edit.svg" class="edit-ta"></div><div class="circle"><a href="#" class="delbutton" id="<?php echo $rows['q_id'] ?>"><img src="img/bin.svg" class="edit-ta"></a></div>
						</div>

					</div>
					<?php
							//put warning if the year format is wrong 
						if(!$candidate->checkYearField($rows['qw_date_completed'])){
							?>
							<label class="missingfield">Please use the correct date format (YYYY/MM/DD)</label><?php
						}
						}
					?>
						
							</div>
							
						</div>						
					</div>
					<div class="addbtnframe">
						<a href="#"class="modal-open addbton btn2" data-modal = "modal17"><img src="img/addw.svg" class="" >Add More</a>
					</div>

					<hr>				
					</div>
					<div class="col-lg-12">
					<div class="d-flex">
						<div class="rounddiv">
							<img src="img/key-course-blue.svg">
						</div>						
						<div class="d-flex flex-row justify-content-between" style="width:100%">
							<div  style="width:100%">
								<label class="l-18-n">KEY COURSES COMPLETED</label>
								<?php 
					$query = $candidate->getKeyCourses();
					for($x=0; $rows=$query->fetch();$x++){
					?>	
					<div class="disp-row record justify-content-between">			
						<div class="d-flex">
							<div style="margin-top: 3px;"> 
								<label class="bullet"></label>
							</div>
							<p class="p-14-n"><?php echo $rows['key_course'] ?></p></div>
						<div class="d-flex">
							<div class="circle modal-open edit-course" data-id="<?php echo $rows['id'] ?>" data-modal = "modal21"><img src="img/edit.svg" class="edit-ta"></div><div class="circle"><a href="#" class="delcourse" id="<?php echo $rows['id'] ?>"><img src="img/bin.svg" class="edit-ta"></a></div>
						</div>
					</div>
					<?php
						}
					?>
							</div>
	
						
						</div>
					</div>
					<div class="addbtnframe">
						<a href="#"class="modal-open addbton btn2" data-modal = "modal13"><img src="img/addw.svg" class="" >Add More</a>
					</div>
					<hr>
				</div>

					<div class="col-lg-12">
					<div class="d-flex">
						<div class="rounddiv">
							<img src="img/skills-blue.svg">
						</div>
						<div class="d-flex flex-row justify-content-between" style="width:100%">
							<div style="width:100%">
								<label class="l-18-n">KEY SKILLS</label>
								<div id="skillsline">
					<?php 
					$query = $candidate->getKeySkills();
					for($x=0; $rows=$query->fetch();$x++){
					?>		
					<div class="disp-row record" >			
						<div class="d-flex">
							<div style="margin-top: 3px;"> 
								<label class="bullet"></label>
							</div>
							<p class=" p-14-n"><?php echo $rows['skill'] ?></p></div>
						<div class="right-text">
							<div class="circle modal-open edit-skill" data-id="<?php echo $rows['id'] ?>" data-modal = "modal20"><img src="img/edit.svg" class="edit-ta"></div><div class="circle"><a href="#" class="delskill" id="<?php echo $rows['id'] ?>"><img src="img/bin.svg" class="edit-ta"></a></div>
						</div>
					</div>
					<?php
						}
					?>
										
					</div>
							</div>
					
						</div>						
					</div>
					<div class="addbtnframe">
						<a href="#"class="modal-open addbton btn2" data-modal = "modal14"><img src="img/addw.svg" class="" >Add More</a>
					</div>
					<hr>
				</div>
					<div class="col-lg-6">
						<?php
						if(empty($candidate->getPdfCV()))
						{
							?>
							<div href="#" class="modal-open" data-modal = "modal11">
								<div class="person-frame d-flex justify-content-between" style="background: #8888d8">							
									<div class="d-flex">
										<div>
											<img src="img/file-upload.svg">
										</div>
										<div class=""><label class="l-18-n text-white" style="margin: 10px 10px;cursor:pointer">Upload CV</label></div>
									</div>
									<div class="edit-tab2">
										<img src="img/edit-text.svg" class="">
									</div>							
								</div>
							</div>
							<?php
						}
						else
						{
							?>
						<div class="person-frame d-flex justify-content-between" style="background: #8888d8">
						<a href="cv/<?php echo $candidate->getPdfCV() ?>" class="d-flex">
							<div>
								<img src="img/pdf2.svg">
							</div>
							<div class=""><label class="l-18-n text-white" style="margin: 10px 10px;cursor:pointer">Download CV</label></div>
						</a>
							<div class="d-flex">
								<div class="edit-tab2 modal-open" style="margin-right:5px" data-modal="modal11">
									<img src="img/edit-text.svg" class="">
								</div>
								<div class="edit-tab2" id="delete-vcv">
									<div class="modal-open" data-modal = "delcv" title="Delete CV"><img src="img/delete.svg" class=""></div>
								</div>
							</div>
						</div>
						<?php
						}
							?>
					</div>
					<div class="col-lg-6">
						<?php
						if(empty($candidate->getVideoCV()))
						{
						?>
						<a href="#" class="modal-open" data-modal = "modal18">
							<div class="person-frame d-flex justify-content-between" style="background: #8888d8">
								<div class="d-flex">
									<div>
										<img src="img/video-upload.svg" id="download_vcv">
									</div>
									<div class=""><label for="download_vcv" class="l-18-n text-white" style="margin: 10px 10px;cursor:pointer">Upload Video CV</label></div>
								</div>
								<div class="">
									<div class="edit-tab2" style="margin-right:5px">
										<img src="img/edit-text.svg" class="">
									</div>
								</div>
							</div>
						</a>
						<?php
						}
						else
						{
							?>
						<div class="person-frame d-flex justify-content-between" style="background: #8888d8" id="test">
							<a href="video cv/<?php echo $candidate->getVideoCV() ?>" class="d-flex">
							<div>
								<img src="img/downloading-1.svg" id="download_vcv">
							</div>
							<div class=""><label for="download_vcv" class="l-18-n text-white" style="margin: 10px 10px;cursor:pointer">Download Video CV</label></div>
						    </a>
							<div class="d-flex">
								<div class="edit-tab2 modal-open" style="margin-right:5px" data-modal="modal18">
									<img src="img/edit-text.svg" class="">
								</div>
								<div class="edit-tab2">
									<div href="#" class="modal-open" data-modal = "delvcv"><img src="img/delete.svg" class=""></div>
								</div>
							</div>
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
</div>


<div id="modal7" class="modal">
	<div class="edit-modal" style="max-height: unset">

		<div class="live-chat-header">
			<div class="d-flex flex-row justify-content-between">
				<span class="l-18">Edit Information</span>
				<span ><img src="img/close.svg" class="close"></span>
			</div>
		</div>
		<form method="post" enctype="multipart/form-data">
		<div class="edit-content " style="max-height: 80vh;">
			
			<div class="row">
				<div class="col-lg-12 form-group">
							<label for="dateOfBirth" class="input-label">Date Of Birth</label>
							
							<div class="d-flex">
								 <select id="year" name="year" class="cust-input" required>
							      <option value=""></option>
							    </select>
							    <select id="month" name="month" class="cust-input ml-2" required>
							      <option value="01">January</option>
							      <option value="02">February</option>
							      <option value="03">March</option>
							      <option value="04">April</option>
							      <option value="05">May</option>
							      <option value="06">June</option>
							      <option value="07">July</option>
							      <option value="08">August</option>
							      <option value="09">September</option>
							      <option value="10">October</option>
							      <option value="11">November</option>
							      <option value="12">December</option>
							    </select>
							    <select id="day" name="day" class="cust-input ml-2">
							      <option value="">Select</option>
							    </select>
							</div>
							
						</div>
						<div class="col-lg-6 form-group">
							 <label for="gender" class="input-label">Gender</label>
							  <select id="gender" name="gender" class="cust-input" required>						
							    <option value="Male">Male</option>
							    <option value="Female">Female</option>
							    <option value="Unspecified">Unspecified</option>
							  </select>
						</div>
						<div class="col-lg-6 form-group">
							<label for="gender" class="input-label">Race</label>
							<select id="race" name="race" class="cust-input" >
							  <option value="Asian">Asian</option>
							  <option value="African">African</option>
							  <option value="Indian">Indian</option>
							  <option value="White">White</option>
							  <option value="Coloured">Coloured</option>
							</select>
						</div>

				<div class="col-lg-6 form-group">
					<label class="input-label">Name</label>
					<input type="text" name="name" class="cust-input " required value="<?php echo $candidate->getCandName() ?>" >
				</div>
				<div class="col-lg-6 form-group">
					<label class="input-label">Surname</label>
					<input type="text" name="surname" required value="<?php echo $candidate->getCandSurname() ?>" class="cust-input " >
				</div>
				
				<div class="col-lg-6 form-group">
					<label class="input-label">Cellphone</label>
					<input type="text" name="cellphone" required value="<?php echo $candidate->getCandCell() ?>" class="cust-input " >
				</div>
				
					<input type="hidden" name="profile_pic" value="<?php echo $candidate->getPP() ?>" class="cust-input " >
				<div class="col-lg-6 form-group">
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
					<?php
					 	$candidate->getCvData();
						$wm = $candidate->getWorkMethods();
					?>
					<div class="pwm">
								<div class="work-type">
									<label class="wpl text-black" for="full_work">
										<input type="checkbox" value="full" name="wmethod[]" <?php echo $candidate->setWorkType($wm,'full') ?> class="wpc" id="full_work">
										<div class="wpc-box">
											
										</div>Full time
									</label>
								</div>

								<div class="work-type">
									<label class="wpl text-black" for="part_work">
										<input type="checkbox" value="part" name="wmethod[]" class="wpc" <?php echo $candidate->setWorkType($wm,'part') ?> id="part_work">
										<div class="wpc-box">						
										</div>Part time
									</label>
								</div>
								<div class="work-type">
									<label class="wpl text-black" for="remote_work">
										<input type="checkbox" value="remote" name="wmethod[]" class="wpc" <?php echo $candidate->setWorkType($wm,'remote') ?> id="remote_work">
										<div class="wpc-box">						
										</div> Remote
									</label>
								</div>
							</div>
				</div >
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
					<input type="text" name="" required class="cust-input " >
				</div>
				<div class="col-lg-12 form-group">
					<label class="input-label">Current Company</label>
					<input type="text" name="" required class="cust-input " >
				</div>
				<div class="col-lg-12 form-group">
					<label class="input-label">Are you a Student</label>
					<select class="cust-input" required>
						<option value="yes">Yes</option>
						<option value="No">No</option>
					</select>
				</div>
				<div class="col-lg-12 form-group">
					<label class="input-label">Select Qualification</label>
					<select class="cust-input" required>
						<option value="yes">Yes</option>
						<option value="No">No</option>
					</select>
				</div>
				<div class="col-lg-12 form-group">
					<label class="input-label">University/Tertiary Qualification</label>
					<input type="text" name="" required class="cust-input ">
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
						<label class="input-label">Bio</label>
						<textarea class="cust-input" name="bio" required cols="12"><?php echo $candidate->getBio() ?></textarea>
					</div>
					
					<div class="col-lg-12 form-group">
						<button class="bton btn2"style="width: 100%" name="add_bio">SAVE</button>
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
					<span class="l-14 upload-filename" id="pp-name"></span>
					<!--<span ><img src="img/delete.svg" class="delete-upload"></span>-->
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
						<input type="file" id="long_cv" accept="video/*" name="video_cv" onchange="getFileData2(this)">
					</div>
					<div class="d-flex flex-row justify-content-between">
					<span class="l-14 upload-filename" id="vcv-name"></span>
					<!--<span ><img src="img/delete.svg" class="delete-upload"></span>-->
				</div>
				</div>
				
				<div class="">
					<button class="bton btn2"style="width: 100%" name="add_vcv">SAVE</button>
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
						<input type="text" name="company_name" required value="<?php echo $candidate->getCurCompName() ?>" class="cust-input " >
					</div>
					<div class="col-lg-12 form-group">
						<label class="input-label">Job Title</label>
						<input type="text" name="job_title" required value="<?php echo $candidate->getCurJobTitle() ?>" class="cust-input " >
					</div>
					<div class="col-lg-12 form-group">
						<label class="input-label">Starting Date</label>
						<input type="date" name="start_date" required value="<?php echo $candidate->getCurStartDate()?>" class="cust-input " >
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
						<label class="input-label">Key Responsibilities</label>
						<input type="text" name="role" required class="cust-input " >
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
						<input type="text" name="company_name" required class="cust-input " >
					</div>
					<div class="col-lg-12 form-group">
						<label class="input-label">Job Title</label>
						<input type="text" name="job_title" required class="cust-input " >
					</div>
					<div class="col-lg-6 form-group">
						<label class="input-label">Starting Date</label>
						<input type="date" name="start_date" required class="cust-input " >
					</div>
					<div class="col-lg-6 form-group">
						<label class="input-label">End Date</label>
						<input type="date" name="end_date" required class="cust-input " >
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
					<input type="text" name="instiName" required class="cust-input " >
				</div>
				<div class="col-lg-12 form-group">
					<label class="input-label">Qualification obtained	</label>
					<input type="text" name="qualification" required class="cust-input " >
				</div>
				<div class="col-lg-12 form-group">
					<label class="input-label">Date Completed</label>
					<input type="number" name="dateCompleted" required class="cust-input " >
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
						<select name="years_experience" required class="cust-input">
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
						<label class="input-label">Key Courses Completed</label>
						<input type="text" name="course" required class="cust-input " >
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
						<input type="text" name="skill" required class="cust-input " >
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
				<span class="l-18">Edit Work Experience</span>
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
<div id="delvcv" class="modal">
	<div class="confirm-modal">
		<div class="live-chat-header">
			<div class="d-flex flex-row justify-content-between">
				<span class="l-18"></span>
				<span ><img src="img/close.svg" class="close"></span>
			</div>
		</div>
		<hr>			
		<form method="post" id="myForm" action="delete" enctype="multipart/form-data">		
			<div class="text-center"><label class="l-14 text-center">Are you sure you want to delete this file?</label></div>
			<hr>				
			<div class="text-center" style="">
				<input type="hidden" name="id" value="delvcv">
				<button class="bton btn1" type="submit" name="add_vcv">Yes</button>
				<button class="bton btn2" type="button">No</button>
			</div>
		</form>		
	</div>
</div>
<div id="delcv" class="modal">
	<div class="confirm-modal">
		<div class="live-chat-header">
			<div class="d-flex flex-row justify-content-between">
				<span class="l-18"></span>
				<span ><img src="img/close.svg" class="close"></span>
			</div>
		</div>
		<hr>			
		<form method="post" id="myForm" action="delete" enctype="multipart/form-data">			<div class="text-center"><label class="l-14 text-center">Are you sure you want to delete this file?</label></div>
				<hr>				
			<div class="text-center">
				<input type="hidden" name="id" value="delcv">
				<button class="bton btn1" type="submit" name="add_vcv">Yes</button>
				<button class="bton btn2">No</button>
			</div>
		</form>		
	</div>
</div>
</body>
<!-- Javascripts -->
<script type="text/javascript">
	var profilePic = '<?php echo $candidate->getPP(); ?>';
	function getFileData(myFile){
   var file = myFile.files[0];  
   var filename = file.name;
   document.getElementById('pp-name').innerHTML = filename;
 }
</script>
<script type="text/javascript">
	function getFileData2(myFile){
   var file = myFile.files[0];  
   var filename = file.name;
   document.getElementById('vcv-name').innerHTML = filename;
 }
</script>
<script type="text/javascript" src="js/toggle.js"></script>
<script type="text/javascript" src="js/button_click.js"></script>
<script type="text/javascript" src="js/delete.js"></script>
<script type="text/javascript" src="js/edit-boxes.js"></script>
<script src="js/progress-bar.js"></script>
<script src="js/view-image.js"></script>
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