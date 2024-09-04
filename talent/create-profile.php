<?php
session_start();
include "include/connect.php";
include "include/functions.php";
include "include/create-profile-auth.php";
$candidate->address();
$candidate->getCvData();
$candidate->setDate();
?>
<!DOCTYPE html>
<html>
<?php  
include "head.php";
?>
<body class="body-b">

<div class="talent-blue-header">
	<div class="prof-container">
		<div class="preloader-container">
	   	   <div class="c c1" style="--i:1;"></div>
	       <div class="c c2" style="--i:2;"></div>
	       <div class="c c3" style="--i:3;"></div>
	       <div class="c c4" style="--i:4;"></div>
	       <div class="c c5" style="--i:5;"></div> 
	  </div>
		<div class="cont-center col-lg-6">			
		<div class="white-container" id="theform">
			<form name="myForm" id="myForm" action="" method="post"enctype="multipart/form-data">
				<div class="text-center">
					<div>
						<img src="img/viconet-logo.svg" style="margin-bottom:20px;" width="200px">
					</div>
						<label class="l-18">Create a Talent Profile</label>
						 <div style="text-align:center;">
							<span class="step" onclick="changeTabs(0)">1</span>
							<span class="step" onclick="changeTabs(1)">2</span>
							<span class="step" onclick="changeTabs(2)">3</span>
							<span class="step" onclick="changeTabs(3)">4</span>
							<span class="step" onclick="changeTabs(4)">5</span>
							<span class="step" onclick="changeTabs(5)">6</span>
	 					</div>
					</div>
					<hr>

				<div class="tab">					
					<div class="row">
						<?php
						if(isset($_SESSION['goo']))
						{
							?>
						    <div class="col-lg-12 form-group">
                                <label for="phone" class="input-label">Mobile Number</label><label>*</label>
                                <input class="input-label cell-style mendatory_input" id="phone" name="userCellphone"  onkeypress="return onlyNumberKey(event)">
                                <div class="err-mes"></div>
                            </div>
                            <?php
                        }?>
						<div class="col-lg-12 form-group">
							<label for="dateOfBirth" class="input-label">Date Of Birth</label><label>*</label>
							
							<div class="d-flex">
								 <select id="year" onblur="checkInput(this)" name="year" class="cust-input mendatory_input">
							      <option value="">Year</option>
							    </select>
							    <select id="month" name="month" onblur="checkInput(this)" class="cust-input ml-2 mendatory_input">
							      <option value="">Month</option>
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
							    <select id="day" name="day" onblur="checkInput(this)" class="cust-input ml-2 mendatory_input">
							      <option value="">Day</option>
							    </select>
							</div>
							
						</div>
						<div class="col-lg-6 form-group">
							 <label for="gender" class="input-label">Gender</label><label>*</label>
							  <select id="gender" name="gender" onblur="checkInput(this)" onchange="onGenderChange()" class="cust-input mendatory_input">
							  	 <option value="">Select Gender</option>
							    <option value="Male">Male</option>
							    <option value="Female">Female</option>
							    <option value="Unspecified">Unspecified</option>
							  </select>
						</div>
						<div class="col-lg-6 form-group">
							<label for="gender" class="input-label">Race</label><label>*</label>
							<select id="race" name="race" onblur="checkInput(this)" class="cust-input mendatory_input" >
							<option value="">Select Race</option>
							  <option value="Asian">Asian</option>
							  <option value="African">African</option>
							  <option value="Indian">Indian</option>
							  <option value="White">White</option>
							  <option value="Coloured">Coloured</option>
							</select>
						</div>

						<div class="col-lg-12 form-group">
							<label for="search_location" class="input-label">Location Address</label><label>*</label>
												
							<input type="text" name="address" onblur="checkInput(this)" id="search_location" class="cust-input mendatory_input" placeholder="Enter Address" value="<?php echo $candidate->getAddress() ?>">	
						</div>
						<div class="col-lg-6 form-group">
							<label for="country" class="input-label">Country</label><label>*</label>
							<?php 
							$query = $candidate->getCountries();
							?>
							<select name="country" id="country" onblur="checkInput(this)" class="cust-input mendatory_input" onchange="fetchState(this.value)"> 
								<option value="<?php echo $candidate->getCountryId() ?>"><?php if(!empty($candidate->getCountry())){echo $candidate->getCountry(); }else{echo 'Select Country';} ?></option>
								<?php
								for ($i=0; $rows=$query->fetch() ; $i++) { 
									?>
								<option value="<?php echo $rows['id'] ?>" id="<?php echo $rows['name'] ?>"><?php echo $rows['name'] ?></option>
								<?php  
								}
								?>
							</select>							
						</div>
						<div class="col-lg-6 form-group">
						<?php
							$query = $candidate->getStates();
						?>	
						<label for="state" class="input-label">State/Province</label><label>*</label>
						<select name="state" id="state" onblur="checkInput(this)" class="cust-input required mendatory_input">
						<option value="<?php echo $candidate->getStateId() ?>" id="<?php echo $candidate->getState(); ?>"><?php echo $candidate->getState(); ?></option>
							<?php
							for ($i=0; $rows=$query->fetch() ; $i++) { 
								?>
								<option value="<?php echo $rows['id'] ?>" id="<?php echo $rows['name'] ?>"><?php echo $rows['name'] ?></option>
							<?php
							}
							?>
									
						</select>
					</div>
						
						
					</div>
				</div>
				<div class="tab">
					<div class="row">
						<div class="col-lg-12 form-group">
							<label for="" class="input-label">About Career Summary</label><label>*</label>
							<textarea rows="5" onblur="checkInput(this)" name="about_career" id="about_cand" class="cust-input mendatory_input" style="height:unset;" maxlength="700" placeholder="Maximum Characters (700)"><?php echo $candidate->getBio(); ?></textarea>		
							<label  class="input-label" id="count_chars">700 </label> <label class="input-label">Characters remaining</label>
						</div>
						<div class="col-lg-12 form-group">
							<label class="input-label">Years of experience</label><label>*</label>
							<select name="years_experience" onblur="checkInput(this)" class="cust-input mendatory_input">
								<option value="">Select Years of experience</option>
								<option value="0 - 5">0 - 5 years</option>
								<option value="6 - 10">6 - 10 years</option>
								<option value="11 - 15">11- 15 years</option>
								<option value=">16">16 years +</option>
							</select>
						</div>
					</div>
					<h4 class="l-18">Are You currently working?</h4>
					<div class="d-flex">
						
						<div class="input-radio">
							<div>
								<input type="radio" onblur="checkInput(this)" name="emp" value="yes" class="radio-btn wy">
							</div>
							<label class="p-14-n r-label">Yes</label>	
						</div>
						<div class="input-radio">
							<div>
							<input type="radio" onblur="checkInput(this)" name="emp" checked="checked" value="no" class="radio-btn wn">
							</div>
							<label class="p-14-n r-label">No</label>	
						</div>
						
					</div>
					<div id="currwork">
						<?php 
						 	$candidate->getCurrentJob();
						?>
						<div class="row">
						<?php 
						 	$candidate->getCurrentJob();
						 	$numJob = $candidate->countCurrentJob();
						 	if($numJob > 0)
						 	{
						?>
						<div class="col-lg-6 form-group">
						 
							<label for="company_name" class="input-label">Company Name</label><label>*</label>
							<input type="text" onblur="checkInput(this)" name="company_name" id="company_name" class="cust-input " onblur="checkInput(this)" value="<?php echo $candidate->getCurCompName() ?>" placeholder="Enter Company Name">							
						</div>
						<div class="col-lg-6 form-group">
							<label for="start_date" class="input-label">Start Date</label><label>*</label>
							<input type="date" onblur="checkInput(this)" name="start_date" id="start_date" value="<?php echo $candidate->getCurStartDate()?>" onblur="checkInput(this)" class="cust-input" >
						</div>
						<div class="col-lg-6 form-group">
							<input type="hidden" name="experience_id1" id="experience_id" value="<?php echo $candidate->getCurJobID();?>" class="cust-input" >
						</div>
						<div class="col-lg-12 form-group">
							<label for="job_title" class="input-label">Job Title</label><label>*</label>
							<input type="text" onblur="checkInput(this)" name="job_title" id="job_title" class="cust-input" value="<?php echo $candidate->getCurJobTitle() ?>" placeholder="Enter Job Title">							
						</div>
						<?php
							}
							else{
							?>
							<div class="col-lg-6 form-group">
						 
							<label for="company_name" class="input-label">Company Name</label><label>*</label>
							<input type="text" onblur="checkInput(this)" name="company_name" id="company_name" class="cust-input"  placeholder="Enter Company Name">							
						</div>
						<div class="col-lg-6 form-group">
							<label for="start_date" class="input-label">Start Date</label><label>*</label>
							<input type="date" onblur="checkInput(this)" name="start_date" id="start_date"  class="cust-input" >							
						</div>
					
						<div class="col-lg-12 form-group">
							<label for="job_title" class="input-label">Job Title</label><label>*</label>
							<input type="text" onblur="checkInput(this)" name="job_title" id="job_title" class="cust-input"  placeholder="Enter Job Title">							
						</div>
						<?php 	
							}
							?>
						<div class="col-lg-12 form-group">											
							<?php 
							//Get Roles
							$query = $candidate->getRole();
							$num_rows = $candidate->countRoles();
							//echo $num_rows;
							if($num_rows > 0){
								?>
								<label width="100%" class="input-label">Key Role and Responsibility</label><label>*</label>
								<?php
								for($i=0;$row2=$query->fetch();$i++){
								//$idd = 'id'.$i;
								
								?>
									<input type="text" onblur="checkInput(this)" name="role[]" id="" class="cust-input" value="<?php echo $row2['role']; ?>" placeholder="Enter Main Responsibilities">
									<input type="hidden" name="role_id" value="<?php echo $row2['id'] ?>">
								<?php
							
								}	
							}
							else{
								?>
							<table id="dynamic_tbl">
								<thead>
									<tr>
										<th width="100%" class="input-label">Key Role and Responsibility<label>*</label></th>
										<th class="" title="Add More Fields"></th>
									</tr>
								</thead>
								<tbody>
									<tr id="row1">
										<td><input type="text" onblur="checkInput(this)" name="role[]" id="" class="cust-input" placeholder="Enter Main Responsibilities"></td>
										<td><div name="remove" id="1" class=" btn_remove" ><img src="img/subtract.svg" class="dele-btn"></div></td>
									</tr>
								</tbody>
							</table>
							<br>

							<button id="addd" type="button" class="addbton btn2"><img title="Add More Fields" img src="img/addw.svg" style="color:#fff">Add more</button>
									<?php
							}
							
							?>
								
											
						</div>
					</div>
					
				</div>
				</div>
				<div class="tab">
					
					<div class="row">
						
						<div class="col-lg-12 form-group"><h4 class="l-18">Do You Have Previous Work Experience?</h4>
					<div class="d-flex">
						
						<div class="input-radio">
							<div>
								<input type="radio" name="prevwork" value="yes" class="radio-btn pwy">
							</div>
							<label class="p-14-n r-label">Yes</label>	
						</div>
						<div class="input-radio">
							<div>
							<input type="radio" checked="checked" name="prevwork" value="no" class="radio-btn pwn">
							</div>
							<label class="p-14-n r-label">No</label>	
						</div>
						
					</div>
					<div id="prevworkexp">
						<?php 
						$num_jobs = $candidate->countPreviousJobs();
						if($num_jobs > 0)
						{
							$query = $candidate->getExperiences();
							for($i=0;$rows=$query->fetch();$i++)
							{
							?>
									<label class="input-label">Company Name</label><input type="text" name="company_name1[]" onblur="checkInput(this)" id="" value="<?php echo $rows['company_name']; ?>" class="cust-input prevcomp" placeholder="Enter Company name">					

									<label class="input-label">Job Title</label>
									<input type="text" name="job_title1[]" onblur="checkInput(this)" id="" class="cust-input prevjt"  value="<?php echo $rows['job_title']; ?>" placeholder="Enter Job Title"></td>
									 
									 <label class="input-label">Start Date</label><input type="date" name="start_date1[]" onblur="checkInput(this)" value="<?php echo $rows['starting_date']; ?>" id="" class="cust-input prevsd" placeholder="Enter Role">
									
									<label class="input-label">End Date</label><input type="date" name="end_date1[]" id="" onblur="checkInput(this)" value="<?php echo $rows['end_date']; ?>" class="cust-input preved" placeholder="Enter Role">
							<br><br>
							<?php 
							}
						}
						else{
					?>
								<table id="dynamic_tbl2" width="100%">
								<tbody>
									<tr >
										<td>
											<label class="input-label">Company Name</label><input type="text" onblur="checkInput(this)" name="company_name1[]" id="" class="cust-input prevcomp" placeholder="Enter Company name"></td>
											
										</td>
									<tr class="row1">
										<td><label class="input-label">Job Title</label>
											<input type="text" onblur="checkInput(this)" name="job_title1[]" id="" class="cust-input prevjt" placeholder="Enter Job Title"></td>
										<td style="text-align:center"></td>
									</tr>
									<tr class="row1">
										<td><label class="input-label">Start Date</label><input type="date" name="start_date1[]" onblur="checkInput(this)" id="start_date" class="cust-input prevsd" placeholder="Enter Role"></td>
										<td style="text-align:center"></td>
									</tr>
									<tr class="row1">
										<td><label class="input-label">End Date</label><input type="date" name="end_date1[]" onblur="checkInput(this)" id="end_date" class="cust-input preved" placeholder="Enter Role"></td>
										<td style="text-align:center"></td>
									</tr>
								</tbody>								
							</table>
							<br>
							<div>	
							<button id="add2" type="button" class="addbton btn2"><img title="Add More Fields" img src="img/addw.svg" style="color:#fff">Add more</button>
							</div>	
							<?php
							}
							?>				
						</div>
					</div>
					</div>
				</div>
				<div class="tab">
					
					<div class="row">
						<div class="col-lg-12 form-group">							
							<?php
							$num_qualification = $candidate->countQualifications();
							if($num_qualification > 0)
							{
								?>
								<label class="l-18">Education</label><label>*</label><br>
								<?php
								$query = $candidate->getQualifications();
								for($x=0; $rows=$query->fetch();$x++){
								?>
								<label class="input-label">Institution</label>
								<input type="text" onblur="checkInput(this)" name="university[]" id="" class="cust-input mendatory_input" value="<?php echo $rows['institution_name'] ?>" placeholder="Enter Institution">
								<label class="input-label">Qualification</label>
								<input type="text" onblur="checkInput(this)" name="qualification[]" id="" style="margin-top: 5px;" value="<?php echo $rows['q_name'] ?>" class="cust-input mendatory_input" placeholder="Enter Qualification">
								<label class="input-label">Year Completed</label>
								<input type="text" onblur="checkInput(this)" name="end_year[]" id="" class="cust-input mendatory_input" value="<?php echo $rows['qw_date_completed'] ?>" style="margin-top: 5px;" placeholder="Enter Year Completed">
								<br><br>
								<?php
								}
							}
							else
							{
						?>
						<table id="dynamic_tbl3" width="100%" >
								<thead>
									<tr>
										<th width="100%" class="">Education</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><label class="input-label">Institution</label><label>*</label><input type="text" onblur="checkInput(this)" name="university[]" id="" class="cust-input mendatory_input" placeholder="Enter Institution"></td>
									</tr>
									<tr>
										<td><label class="input-label">Qualification</label><label>*</label><input type="text" onblur="checkInput(this)" name="qualification[]" id="" style="margin-top: 5px;" class="cust-input mendatory_input" placeholder="Enter Qualification"></td>

										
									</tr>
									<tr>
										<td><label class="input-label">Year Completed</label><label>*</label><input type="number" onblur="checkInput(this)" name="end_year[]" id="" class="cust-input mendatory_input" style="margin-top: 5px;" placeholder="Enter Year Completed"></td>
										
									</tr>
								</tbody>
							</table>
							<br>
							<div>	
							<button id="add3" type="button" class="addbton btn2"><img title="Add More Fields" img src="img/addw.svg" style="color:#fff">Add</button>
							</div>	
							<?php
							}
							?>					
						</div>
					</div>
				</div>

				<div class="tab">				
					<div class="row">						
						<div class="col-lg-12 form-group">				
						<?php 
						$countKeyCourses = $candidate->countKeyCourses();
						if($countKeyCourses > 0)
						{
							?>
							<label class="l-18">Key Courses</label>
							<?php
							$query = $candidate->getKeyCourses();
							for($x=0; $rows=$query->fetch();$x++){
							?>	
							<input type="text" onblur="checkInput(this)" name="key_course[]" id="" class="cust-input mendatory_input" value="<?php echo $rows['key_course'] ?>" placeholder="Enter Key Course">
							<br>	
							<?php
							}
						}
						else{
						?>
						<table id="dynamic_tbl4" width="100%" >
							<thead>
								<tr>
									<th width="100%" class="">Key Courses</th>
									<th class="" title="Add More Fields"></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><input type="text" name="key_course[]" id="" class="cust-input" onblur="checkInput(this)" placeholder="Enter Key Course"></td>
									
								</tr>
							</tbody>
						</table>
						<br>
						<button id="add4" type="button" class="addbton btn2"><img title="Add More Fields" img src="img/addw.svg" style="color:#fff">Add more</button>
						<?php
						}
						?>

							</div>					
						
						<div class="col-lg-12 form-group">							
						<?php 
						$countKeySkills = $candidate->countKeySkills();
						if($countKeySkills > 0)
						{
							?>
							<label class="l-18">Key Skills</label><label>*</label>
							<?php
							$query = $candidate->getKeySkills();
							for($x=0; $rows=$query->fetch();$x++){
							?>
							<input type="text" onblur="checkInput(this)" name="key_skill[]" id="" class="cust-input mendatory_input" value="<?php echo $rows['skill'] ?>" placeholder="Enter Skill">
							<br>
							<?php 
							}
						}
						else{
							?>
							<table id="dynamic_tbl5" width="100%" >
								<thead>
									<tr>
										<th width="100%" class="">Key Skills<label>*</label></th>
										<th class="" title="Add More Fields"></th>
									</tr>
								</thead>
								<tbody>
									<tr >
										<td><input type="text" onblur="checkInput(this)" name="key_skill[]" id="" class="cust-input mendatory_input" placeholder="Enter Skill"></td>
										
									</tr>
								</tbody>
							</table>
						<br>
						<button id="add5" type="button" class="addbton btn2"><img title="Add More Fields" img src="img/addw.svg" style="color:#fff">Add more</button>
							<?php
						}
						?>
						</div>
						
						<div class="col-lg-12 form-group">
							<label class="input-label">Choose CV File(optional)</label>
							<div class="file-btn">
								
						        <input type="file" name="pdf_cv" accept="application/pdf" <?php if(!empty($candidate->getPdfCV() )){ echo 'disabled'; } ?> onchange="getFileData(this)" id="file-input" >
						        <label for="file-input"class="btn-lbl">Choose File</label>
					      </div>
					      <label class="p_filename p-12-n" id="filename" ><?php echo $candidate->getPdfCV(); ?></label>
					      <?php if(empty($candidate->getPdfCV() )){
					      ?>
					      <div class="progress">
						    <div class="progress-bar" id="progressBar"></div>
						  </div>
						  <?php
					       } ?> 
					      	

						</div>
						<div class="col-lg-12 form-group">
							<label class="input-label">Upload video CV (optional)</label>
							<div class="file-btn">							
						        <input type="file"  id="file-input1"  <?php if(!empty($candidate->getVideoCV() )){ echo 'disabled'; } ?> accept="video/*" onchange="getFileData1(this)" name="video_cv">
						        <label for="file-input1" class="btn-lbl">Choose File</label>
						      </div>
						      <label class="p_filename p-12-n" id="filename1"><?php echo $candidate->getVideoCV(); ?></label>
						      <?php
						      if(empty($candidate->getVideoCV() )){ 
						      	?>
						      	<div class="progress">
							      <div class="progress-bar" id="progressBar2"></div>
							  </div>
							  <?php	
						       } ?>
						       									
						</div>
					</div>
				</div>
				<div class="tab">
					<div class="row">
						<div class="col-lg-12">
						<?php
						$candidate->getCvData();
						$methods = $candidate->getWorkMethods();
						if(!empty($methods))
						{
							$methods = explode(',',$methods);						
						?>
							<label class="l-18">Prefered ways of working</label>	
							<div class="pwm">
								<?php
						foreach($methods as $method)
							{
								if($method == "full"){
									?>
								<div class="work-type">
									<label class="wpl text-black" for="full_work">
										<input type="checkbox" checked value="full" name="wmethod[]" class="wpc" id="full_work">
										<div class="wpc-box">
											
										</div>Full time
									</label>
								</div>
								<?php
								}
								elseif ($method == "part") {
									?>
								<div class="work-type">
									<label class="wpl text-black" for="part_work">
										<input type="checkbox" checked value="part" name="wmethod[]" class="wpc" id="part_work">
										<div class="wpc-box">						
										</div>Part time
									</label>
								</div>
								<?php
								}	
								elseif ($method == "remote") {
									?>
								<div class="work-type">
									<label class="wpl text-black" for="remote_work">
										<input type="checkbox" checked value="remote" name="wmethod[]" class="wpc" id="remote_work">
										<div class="wpc-box">						
										</div>Remote
									</label>
								</div>
								<?php
								}									
							}
							?>
						</div>
						<?php
						}
						else{
						?>
							<label class="l-18">Prefered working method</label>	
							<div class="pwm">
								<div class="work-type">
									<label class="wpl text-black" for="full_work">
										<input type="checkbox" value="full" name="wmethod[]" class="wpc" id="full_work">
										<div class="wpc-box">
											
										</div>Full time
									</label>
								</div>

								<div class="work-type">
									<label class="wpl text-black" for="part_work">
										<input type="checkbox" value="part" name="wmethod[]" class="wpc" id="part_work">
										<div class="wpc-box">						
										</div>Part time
									</label>
								</div>
								<div class="work-type">
									<label class="wpl text-black" for="remote_work">
										<input type="checkbox" value="remote" name="wmethod[]" class="wpc" id="remote_work">
										<div class="wpc-box">						
										</div>Remote
									</label>
								</div>
							</div>			
						<?php
						}
						?>
					</div>
				</div>
				</div>
				<hr>			
				<div class="row">
					<div class="col-lg-12 form-group">
						<div style="overflow:auto;">
							<div style="float:right; margin-left:20px">
								<button type="button" class="bton btn1" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
								<button type="button" class="bton btn2" id="nextBtn" onclick="nextPrev(1)">Next</button>
							</div>
						</div>						
					</div>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>
</body>
<!-- Javascripts -->
<script>
	//Preloader
     function simulateLoading() {
      return new Promise(resolve => {
        setTimeout(resolve, 1000); // Simulating a 3-second loading time
      });
    }
	var preloader = document.querySelector('.preloader-container');
	var content = document.getElementById('theform');
    content.style.display = 'none'; // Show the div content

	// Show the preloader while loading the div content
    window.addEventListener('DOMContentLoaded', function() {

      simulateLoading().then(function() {
        preloader.style.display = 'none'; // Hide the preloader
        content.style.display = 'block'; // Show the div content
      });
    });
</script>
<script type="text/javascript" src="js/toggle.js"></script>
<script src="js/button_click.js"></script>
<script type="text/javascript" src="js/form-set.js"></script>
<script type="text/javascript" src="js/getAddr.js"></script>
<script type="text/javascript">
	i=
	$(document).ready(function(){
	var i=2;
	$('#addd').click(function(){
		if(i<6)
		{
		$('#dynamic_tbl').append('<tr id="row'+i+'"><td><input type="text" name="role[]" placeholder="Enter Main Responsibilities" class="cust-input name_list" style="margin-top:5px;" /></td><td><div name="remove" id="'+i+'" class=" btn_remove" ><img src="img/subtract.svg" class="dele-btn"></div></td></tr>');
		i++;
		}

	});
	$(document).on('click', '.btn_remove', function(){
		var button_id = $(this).attr("id"); 
		$('#row'+button_id+'').remove();
		i--;
	});
});
$(document).ready(function(){
	var i=2;
	$('#add2').click(function(){
		if(i<6)
		{
		$('#dynamic_tbl2').append('<tr class="row'+i+'"><td><label class="input-label">Company Name</label><input type="text" name="company_name1[]" placeholder="Enter Company Name" class="cust-input name_list prevcomp" style="margin-top:5px;" /></td><td><div name="remove" id="'+i+'" class=" btn_remove" ><img src="img/subtract.svg" class="dele-btn align-btn"></div></td></tr><tr class="row'+i+'"><td><label class="input-label">Job Title</label><input type="text" name="job_title1[]" placeholder="Enter Job Title" class="cust-input name_list prevjt" style="margin-top:5px;" /></td><td></td></tr><tr class="row'+i+'"><td><label class="input-label">Start Date</label><input type="date" name="start_date1[]" placeholder="Enter Start Date" class="cust-input name_list prevsd" style="margin-top:5px;" /></td><td></td></tr><tr class="row'+i+'"><td><label class="input-label">End Date</label><input type="date" name="end_date1[]" placeholder="Enter End Date" class="cust-input name_list preved" style="margin-top:5px;" /></td><td></td></tr>');
		i++;
	}

	});
	$(document).on('click', '.btn_remove', function(){
		var button_id = $(this).attr("id"); 
		$('.row'+button_id+'').remove();
		i--;
	});
});
$(document).ready(function(){
	var i=1;
	$('#add3').click(function(){
		if(i<5)
		{
		$('#dynamic_tbl3').append('<tr class="row'+i+'"><td><label class="input-label">Institution</label><label>*</label><input type="text" name="university[]" placeholder="Enter Institution" class="cust-input name_list mendatory_input" style="margin-top:5px;" /></td><td><div name="remove" id="'+i+'" class=" btn_remove" ><img src="img/subtract.svg" class="dele-btn align-btn"></div></td></tr><tr id="row'+i+'" class="row'+i+'"><td><label class="input-label">Qualification</label><label>*</label><input type="text" name="qualification[]" placeholder="Enter Qualification" class="cust-input name_list mendatory_input" style="margin-top:5px;" /></td></tr><tr class="row'+i+'"><td><label class="input-label">Year Completed</label><label>*</label><input type="text" name="end_year[]" placeholder="Enter Year Completed" class="cust-input name_list mendatory_input" style="margin-top:5px;" /></td></tr>');
		i++;
		}

	});
	$(document).on('click', '.btn_remove', function(){
		var button_id = $(this).attr("id"); 
		$('.row'+button_id+'').remove();
		i--;
	});
});
$(document).ready(function(){
	var x=2;
	$('#add4').click(function(){
		if(x<6)
		{
		$('#dynamic_tbl4').append('<tr id="row'+x+'"><td><input type="text" name="key_course[]" placeholder="Enter Key Course" class="cust-input name_list" style="margin-top:5px;" /></td><td><div name="remove" id="'+x+'" class=" btn_remove" ><img src="img/subtract.svg" class="dele-btn"></div></td></tr>');
		x++;
		}

	});
	$(document).on('click', '.btn_remove', function(){
		var button_id = $(this).attr("id"); 
		$('#row'+button_id+'').remove();
		x--;
	});
});
$(document).ready(function(){
	var i=15;
	$('#add5').click(function(){
		if(i<20)
		{
		$('#dynamic_tbl5').append('<tr id="row'+i+'"><td><input type="text" name="key_skill[]" placeholder="Enter Skill" class="cust-input name_list mendatory_input" style="margin-top:5px;" /></td><td><div name="remove" id="'+i+'" class=" btn_remove" ><img src="img/subtract.svg" class="dele-btn"></div></td></tr>');
		i++;
		}

	});
	$(document).on('click', '.btn_remove', function(){
		var button_id = $(this).attr("id"); 
		$('#row'+button_id+'').remove();
		i--;
	});
});


	/*$(document).on('click', '.btn_remove', function(){
		var button_id = $(this).attr("id"); 
		$('#row'+button_id+'').remove();
		i--;
	});
	$(document).on('click', '.btn_remove', function(){
		var button_id = $(this).attr("id"); 
		$('.row'+button_id+'').remove();
		i--;
	});*/

</script>
<script type="text/javascript">
	function getFileData(myFile){
   var file = myFile.files[0];  
   var filename = file.name;
   document.getElementById('filename').innerHTML = filename;

   var xhr = new XMLHttpRequest();
        var progressBar = document.getElementById('progressBar');

        xhr.upload.addEventListener('progress', function(event) {
          if (event.lengthComputable) {
            var percentComplete = (event.loaded / event.total) * 100;
            progressBar.style.width = percentComplete + '%';
          }
        });
         xhr.open('POST', 'upload', true);
        var formData = new FormData();
        formData.append('file', file);
        xhr.send(formData);
 }
 function getFileData1(myFile){
   var file = myFile.files[0];  
   var filename = file.name;
   document.getElementById('filename1').innerHTML = filename;
   var xhr = new XMLHttpRequest();
        var progressBar2 = document.getElementById('progressBar2');

        xhr.upload.addEventListener('progress', function(event) {
          if (event.lengthComputable) {
            var percentComplete = (event.loaded / event.total) * 100;
            progressBar2.style.width = percentComplete + '%';
          }
        });
         xhr.open('POST', 'upload', true);
        var formData = new FormData();
        formData.append('file', file);
        xhr.send(formData);
 }
</script>
<script type="text/javascript" src="js/populate_caddress.js"></script>
 <script src="js/javascript-func.js"></script>
 <?php
if(isset($_SESSION['goo']))
{
	?>
 <script src="js/cell-val.js"></script>
  <script src="build/js/intlTelInput.js"></script>
<script>
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
      // allowDropdown: false,
      autoHideDialCode: false,
      autoPlaceholder: "on",
      // dropdownContainer: document.body,]
      // excludeCountries: ["us"],
      formatOnDisplay: false,
      // geoIpLookup: function(callback) {
      //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
      //     var countryCode = (resp && resp.country) ? resp.country : "";
      //     callback(countryCode);
      //   });
      // },
      //hiddenInput: "full_number",
       initialCountry: "ZA",
      // localizedCountries: { 'de': 'Deutschland' },
       nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
       placeholderNumberType: "MOBILE",
      // preferredCountries: ['cn', 'jp'],
       //separateDialCode: true,
      utilsScript: "build/js/utils.js",
    });
  </script>
<script>
    function onlyNumberKey(evt) {
          
        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }
</script>
<?php } ?>
<script>
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
        	i2 = '0'+i;
        }
         option1.value = i;
        daySelect.add(option1);
      }
       $('#day').val(day);
      $('#year').val(year);
    };
  </script>
   <script>
 	var gender = "<?php echo $candidate->getGender() ?>";
    var race = "<?php echo $candidate->getRace() ?>";
    var year = "<?php echo $candidate->getYear() ?>";
    var month = "<?php echo $candidate->getMonth() ?>";
    var day = "<?php echo $candidate->getDay() ?>";
 
    $('#day').val(day);
    $('#year').val(year);   
    $('#gender').val(gender);
    $('#race').val(race);
    $('#month').val(month);

  </script>

</html>