<?php

$phpFileUPloadErrors = array(
	0 => 'there is no error the file is successful uploaded',
	1 => 'the file is too large',
	2 => 'the file exceeded the size that is specified',
	3 => 'the uploaded file was only partially uploaded',
	4 => 'no file was uploaded',
	6 => 'missinng a temporary folder',
	7 => 'failed to write files to disk',
	8 => 'a php extension stopped the file upload'
	);
$DOB =  "";
$methods = "";

if(isset($_POST['add_qualification'])){
	
	if(isset($_POST['qualification_id']))
	{
		$candidate->updateQualification($_POST['instiName'],$_POST['qualification'],$_POST['dateCompleted'], $_POST['qualification_id']);
	}
	else{
		$candidate->addQualification($_POST['instiName'],$_POST['qualification'],$_POST['dateCompleted']);
	}
	
	?>
	<script> window.location = "profile-view"; </script>
	<?php
}

if(isset($_POST['add_experience'])){
	$status = 'post';
	
	if(isset($_POST['experience_id']))
	{
		$candidate->updateExperience($_POST['company_name'],$_POST['job_title'], $_POST['start_date'],$_POST['end_date'],$_POST['experience_id']);
	}
	else{
		$candidate->addExperience1($_POST['company_name'],$_POST['job_title'], $_POST['start_date'],$_POST['end_date'],$status);
	}
	
	?>
	<script> window.location = "profile-view"; </script>
	<?php
}
if(isset($_POST['add_exp_years'])){
	$years_experience =  $_POST['years_experience'];
	$email = md5($candidate->getCandEmail());
		$sql = $db->prepare("UPDATE `curriculum_vitae` SET `years_experience`='$years_experience' WHERE c_email = '$email'");
		$sql->execute();
		?>
	<script> window.location = "profile-view"; </script>
	<?php
}
if(isset($_POST['add_currentJob'])){
	$status = 'current';
	$candidate->addExperience($_POST['company_name'],$_POST['job_title'], $_POST['start_date'],$_POST['end_date'],$status);
	?>
	<script> window.location = "profile-view"; </script>
	<?php
}
if(isset($_POST['add_role'])){
	
	if(isset($_POST['role_id']))
	{
		$candidate->updateKeyRole($_POST['role'],$_POST['role_id']);
	}
	else{
		$candidate->addRole($_POST['role']);
	}
	?>
	<script> window.location = "profile-view"; </script>
	<?php
}

if(isset($_POST['add_course'])){
	
	if(isset($_POST['course_id']))
	{
		$candidate->updateKeyCourses($_POST['course'],$_POST['course_id']);
	}
	else{
		$candidate->addKeyCourses($_POST['course']);
	}
	?>
	<script> window.location = "profile-view"; </script>
	<?php
}
if(isset($_POST['add_skill'])){
	if(isset($_POST['skill_id']))
	{
		$candidate->updateKeySkills($_POST['skill'],$_POST['skill_id']);
	}
	else{
		$candidate->addKeySkills($_POST['skill']);
	}
	?>
	<script> window.location = "profile-view"; </script>
	<?php
}
if(isset($_POST['add_bio'])){
	$candidate->addBio($_POST['bio']);
	?>
	<script> window.location = "profile-view"; </script>
	<?php
}
if(isset($_POST['add_cv'])){
	if(isset($_FILES['long_cv']))
	{
	//$candidate->a >ddCv($_FILES['upload_short_cv']);
	

		$file_array = $_FILES['long_cv'];
		
			if($file_array['error'])
			{
				?> <div class ="alert alert-danger">
				<?php echo $file_array['name']. ' - '.$phpFileUPloadErrors[$file_array['error']];?>
				</div>
				<?php
			}
			else{
				$allow = array('pdf');
				$fileExt = explode('.',$file_array['name']);
				$fileActualExt = strtolower(end($fileExt));
				if(!in_array($fileActualExt, $allow))
				{
					?> <div class ="alert alert-danger">
				<?php echo "{$file_array['name']} -invalid file extension"?>
				</div>
				<?php
				}
				else
				{
					move_uploaded_file($file_array['tmp_name'] ,'cv/'.$file_array['name']);
					?> <div class ="alert alert-danger">
					<?php echo $file_array['name']. ' - '.$phpFileUPloadErrors[$file_array['error']];
					
					?>
					</div>
					<?php  
					
				}
			}
		}
		$date = date('Y-m-d H:i:s');;
		$fileName =$file_array['name'];
		$email = md5($candidate->getCandEmail());
		$sql = $db->prepare("UPDATE `curriculum_vitae` SET `cv_file`=?, date_cv_uploaded = ? WHERE c_email = '$email'");
		$sql->execute(array($fileName,$date));
		?>
	<script> window.location = "profile-view"; </script>
	<?php
}
if(isset($_POST['add_vcv'])){
	if(isset($_FILES['video_cv']))
	{
	//$candidate->a >ddCv($_FILES['upload_short_cv']);
	
		$file_array = $_FILES['video_cv'];
		
			if($file_array['error'])
			{
				?> <div class ="alert alert-danger">
				<?php echo $file_array['name']. ' - '.$phpFileUPloadErrors[$file_array['error']];?>
				</div>
				<?php
			}
			else{
				$allow = array('mp4','avi','wmv','flv','webm','mov');
				$fileExt = explode('.',$file_array['name']);
				$fileActualExt = strtolower(end($fileExt));
				if(!in_array($fileActualExt, $allow))
				{
					?> <div class ="alert alert-danger">
				<?php echo "{$file_array['name']} -invalid file extension"?>
				</div>
				<?php
				}
				else
				{
					move_uploaded_file($file_array['tmp_name'] ,'video cv/'.$file_array['name']);
										
				}
				$fileName =$file_array['name'];
				$email = md5($candidate->getCandEmail());
				$sql = $db->prepare("UPDATE `curriculum_vitae` SET `video_cv`='$fileName' WHERE c_email = '$email'");
				$sql->execute();
			}
		}
		?>
		<script> window.location = "profile-view"; </script>
	<?php
}
if (isset($_POST['save_profile'])) {
	$year ="";
	$month = "";
	$day = "";
	//Assigning values to variables 
	$c_name = $_POST['name'];
	$c_surname = $_POST['surname'];
	$c_cellphone = $_POST['cellphone'];
	$year =$_POST['year'];
	$month = $_POST['month'];
	$day = $_POST['day'];

	$gender = $_POST['gender'];
	if($gender == "Other"){
		$gender = $_POST['otherGender'];
	}
	$race =$_POST['race'];
	$email = md5($candidate->getCandEmail());
	$pp_name = $_POST['profile_pic'];
	$address = $_POST['address'];
	
	$state = $_POST['state'];
	$country = $_POST['country'];
	$city ="";
		//check if the file is empty
		$sql = $db->prepare("UPDATE `candidate_tbl` SET `c_name`='$c_name',`c_surname`='$c_surname',`gender`='$gender',`race`='$race',`c_cellphone`='$c_cellphone',`c_DOB`= CONCAT('$year','-','$month','-',CONVERT('$day',char)) WHERE md5(c_email)='$email'");
		$sql->execute();
		$sql_q = $db->prepare("SELECT count(id) as num_rows FROM address WHERE email='$email'");
		$sql_q->execute();
		$a_rows = $sql_q->fetch();
		
			//Check if email exist in address table
			if ($a_rows['num_rows'] > 0) {
				$a_sql = $db->prepare("UPDATE `address` SET `address`='$address',`city`='$city',`country`='$country' WHERE email ='$email' ");
				$a_sql->execute();
			}
			else{
				$a_sql = $db->prepare("INSERT INTO `address`(`email`, `address`, `city`, `country`) VALUES ('$email','$address','$city','$country')");
				$a_sql->execute();
			}
	
	if(isset($_POST['wmethod'])){
		if (count($_POST['wmethod']) != 0) {
			foreach ($_POST['wmethod'] as $key => $value) {
				$methods = $methods.','.$value;
			}		
		}
		$methods = substr($methods, 1);
		$sql = $db->prepare("UPDATE `curriculum_vitae` SET `work_method`='$methods' WHERE `c_email` = '$email'");
		$sql->execute();
	}
	else if(!isset($_POST['wmethod']))
	{
		$sql = $db->prepare("UPDATE `curriculum_vitae` SET `work_method`='$methods' WHERE `c_email` = '$email'");
		$sql->execute();
	}
?>
	<script>window.location = "profile-view"; </script>
	<?php
}
