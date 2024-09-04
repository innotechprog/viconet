<?php
 include 'include/connect.php';
 
$id = $_POST['id'];

$type = $_POST['type'];
if($type == 'skill'){
$query = $db->prepare("SELECT * FROM key_skills where id = '$id'");
$query->execute();
while($rows=$query->fetch())
{
   echo  '<label class="form-control-label" for="">Skill</label>
	        <input type="text" name="skill" class="form-control" value="'.$rows['skill'].'" placeholder="Enter skill">
	           <input  type="hidden" name="skill_id" class="form-control" value="'.$id.'" placeholder="Enter webinar tittle..."><br>';
	          
   }
}
else if($type=='role'){
$query = $db->prepare("SELECT * FROM key_roles where id = '$id'");
$query->execute();
while($rows=$query->fetch())
{
   echo  '<label class="form-control-label" for="">Role</label>
	        <input type="text" name="role" class="form-control" value="'.$rows['role'].'" placeholder="Enter skill">
	           <input  type="hidden" name="role_id" class="form-control" value="'.$id.'"><br>';
	          
   }
}
else if($type=='course'){
$query = $db->prepare("SELECT * FROM key_courses where id = '$id'");
$query->execute();
while($rows=$query->fetch())
{
   echo  '<label class="form-control-label" for="">Role</label>
	        <input type="text" name="course" class="form-control" value="'.$rows['key_course'].'" placeholder="Enter skill">
	           <input  type="hidden" name="course_id" class="form-control" value="'.$id.'"><br>';
	          
   }
}
else if($type=='education'){
$query = $db->prepare("SELECT * FROM qualifications where q_id = '$id'");
$query->execute();
while($rows=$query->fetch())
{
   echo  '<div class="row"><div class="col-lg-12 form-group">
					<label class="input-label">Institution Name</label>
					<input type="text" name="instiName" class="cust-input "value="'.$rows['institution_name'].'" >
				</div>
				<div class="col-lg-12 form-group">
					<label class="input-label">Qualification obtained	</label>
					<input type="text" name="qualification" class="cust-input " value="'.$rows['q_name'].'">
				</div>
				<div class="col-lg-12 form-group">
					<label class="input-label">Date Completed</label>
					<input type="year" name="dateCompleted" class="cust-input "value="'.$rows['qw_date_completed'].'" >
				</div>
					
				

	           <input  type="hidden" name="qualification_id" class="form-control" value="'.$id.'"><br>';

	          
   }
}
else if($type=='experience'){
$query = $db->prepare("SELECT * FROM candidate_role where id = '$id'");
$query->execute();

while($rows=$query->fetch())
{
   echo  '<div class="row">
					<div class="col-lg-12 form-group">
						<label class="input-label">Company Name</label>
						<input type="text" name="company_name" class="cust-input " value="'.$rows['company_name'].'">
					</div>
					<div class="col-lg-12 form-group">
						<label class="input-label">Job Title</label>
						<input type="text" name="job_title" class="cust-input " value="'.$rows['job_title'].'">
					</div>
					<div class="col-lg-6 form-group">
						<label class="input-label">Starting Date</label>
						<input type="date" name="start_date" class="cust-input " value="'.$rows['starting_date'].'" >
					</div>
					<div class="col-lg-6 form-group">
						<label class="input-label">End Date</label>
						<input type="date" name="end_date" class="cust-input " value="'.$rows['end_date'].'">
					</div>				

	           <input  type="hidden" name="experience_id" class="form-control" value="'.$id.'"><br>';

	          
   }
}

?>