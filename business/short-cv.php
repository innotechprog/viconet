<?php
session_start();
include "include/connect.php";
include "include/functions.php";
$candidate = new Candidates($db);
$candidate->setCandidate(2);
$candidate->address();
include "add-cv.php";

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
<div class="talent-blue-header">
	<div class="prof-container">
		
		<div class="row">
		
			<div class="col-lg-12">
				<div class="corp-edit">
				<label class="l-18">Short CV</label>
			<form action="platform">
				<div class="row">
					<div class="col-lg-12 form-group">
						<label for="company_reg" class="input-label">Career Summary</label>
						<textarea class="cust-input"></textarea>
					</div>
				
					<div class="col-lg-12">
					
					<div class="d-flex flex-row justify-content-between">
						<span ><label class="l-18">CURRENT ROLE & RESPONSIBITY</label></span>
						<span ><a href="#"class="modal-open" data-modal = "modal8"><img src="img/edit-text.svg" class="edit-tab"></a></span>
					</div>
						<?php 
						$query1 = $candidate->getCurrentJob();
						for($i=0; $row1=$query1->fetch();$i++)
						{ 
							?>
						<p>Company Name : <?php echo $row1['company_name'] ?> </p>
						<p>Job Title : <?php echo $row1['job_title'] ?> </p>
						<p>Starting Date : <?php echo $row1['starting_date'] ?> </p>
						
						<div class="d-flex flex-row justify-content-between">
							<span ><p>Key Roles :</p></span>
							<span ><a href="#"class="modal-open" data-modal = "modal9"><img src="img/add.svg" class="edit-tab" style="margin-right:-7px"></a></span>
						</div>
						<p style="margin-top:-20px;">
							<?php 
							$query = $candidate->getRole();
							for($i=0;$row2=$query->fetch();$i++){
								?>
								<div class="disp-row record">			
									<div class="lft-text"><p><li><?php echo $row2['role'] ?></li></p></div>
									<div class="circle"><a href="#" class="delrole" id="<?php echo $row2['id'] ?>"><img src="img/bin.svg" class="edit-ta"></div><div class="circle"><a href="#"class="modal-open" data-modal = "modal10"><img src="img/edit.svg" class="edit-ta"></a></div>
								</div>
								<?php
							}
							?>
							</p>
						<?php 
							}
							?>
					</div>
					<div class="col-lg-12">
					
					<div class="d-flex flex-row justify-content-between">
						<span ><label class="l-18">PREVIOUS WORK EXPERIENCE</label></span>
						<span ><a href="#"class="modal-open" data-modal = "modal10"><img src="img/add.svg" class="edit-tab" style="margin-right:-7px"></a></span>
					</div>
					<?php
					$query = $candidate->getExperiences();
					for($i=0;$rows=$query->fetch();$i++){
						?>
					
					<div class="disp-row record">			
						<div class="lft-text"><p><?php echo $rows['company_name'].' - '.$rows['job_title'].' - '.$rows['starting_date'].' - '.$rows['end_date']; ?> </p></div>
						<div class="circle"><a href="#" class="delexp" id="<?php echo $rows['id'] ?>"><img src="img/bin.svg" class="edit-ta"></a></div><div class="circle"><a href="#"class="modal-open" data-modal = "modal10"><img src="img/edit.svg" class="edit-ta"></a></div>
					</div>
					<?php 
						}
					?>					
								
					</div>
					<div class="col-lg-12">
						<div class="d-flex flex-row justify-content-between">
							<span ><label class="l-18">YEARS OF EXPERIENCE</label></span>
							<span ><a href="#"class="modal-open" data-modal = "modal12"><img src="img/add.svg" class="edit-tab" style="margin-right: -7px;"></a></span>
						</div>
						<p>5 years</p>
					</div>
					<div class="col-lg-12">
					<div class="d-flex flex-row justify-content-between">
						<span ><label class="l-18">EDUCATION</label></span>
						<span ><a href="#"class="modal-open" data-modal = "modal11"><img src="img/add.svg" class="edit-tab" style="margin-right: -7px;"></a></span>
					</div>

					<?php 
					$query = $candidate->getQualifications();
					for($x=0; $rows=$query->fetch();$x++){
					?>	
					<div class="disp-row record">			
						<div class="lft-text"><p><?php echo $rows['institution_name'].' - '.$rows['q_name'].' - '.$rows['qw_date_completed'] ?> </p></div>
						<div class="circle"><a href="#" class="delbutton" id="<?php echo $rows['q_id'] ?>"><img src="img/bin.svg" class="edit-ta"></a></div><div class="circle"><img src="img/edit.svg" class="edit-ta"></div>
					</div>
					<?php
						}
					?>
										
					</div>
					<div class="col-lg-12">
					<div class="d-flex flex-row justify-content-between">
						<span ><label class="l-18">KEY COURSES</label></span>
						<span ><a href="#"class="modal-open" data-modal = "modal13"><img src="img/add.svg" class="edit-tab" style="margin-right: -7px;"></a></span>
					</div>

					<?php 
					$query = $candidate->getKeyCourses();
					for($x=0; $rows=$query->fetch();$x++){
					?>	
					<div class="disp-row record">			
						<div class="lft-text"><p class="move-up"><li><?php echo $rows['key_course'] ?></li> </p></div>
						<div class="circle"><a href="#" class="delcourse" id="<?php echo $rows['id'] ?>"><img src="img/bin.svg" class="edit-ta"></a></div><div class="circle"><img src="img/edit.svg" class="edit-ta"></div>
					</div>
					<?php
						}
					?>
										
					</div>
					<div class="col-lg-12">
					<div class="d-flex flex-row justify-content-between">
						<span ><label class="l-18">KEY SKILLS	</label></span>
						<span ><a href="#"class="modal-open" data-modal = "modal14"><img src="img/add.svg" class="edit-tab" style="margin-right: -7px;"></a></span>
					</div>

					<?php 
					$query = $candidate->getKeySkills();
					for($x=0; $rows=$query->fetch();$x++){
					?>	
					<div class="disp-row record">			
						<div class="lft-text"><p class="move-up"><li><?php echo $rows['skill'] ?></li> </p></div>
						<div class="circle"><a href="#" class="delskill" id="<?php echo $rows['id'] ?>"><img src="img/bin.svg" class="edit-ta"></a></div><div class="circle"><img src="img/edit.svg" class="edit-ta"></div>
					</div>
					<?php
						}
					?>
										
					</div>
					
					
				</div>
			</form>
			</div>
			
			</div>
		</div>

	</div>
</div>
<!-- Modals -->
<div id="modal8" class="modal">
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
					<div class="col-lg-12 form-group">
						<label class="input-label">Starting Date</label>
						<input type="date" name="start_date" class="cust-input " >
					</div>
					<div class="col-lg-12 form-group">
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
<div id="modal11" class="modal">
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
							<option>Select Years of experience</option>
							<option>0 - 5 years</option>
							<option>6 - 10 years</option>
							<option>11- 15 years</option>
							<option>16 years +</option>
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
<?php
include "footer.php";
?>
</body>
<!-- Javascripts -->
<script type="text/javascript" src="js/toggle.js"></script>
<script type="text/javascript" src="js/delete.js"></script>
</html>