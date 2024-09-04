<?php
session_start();
include "include/connect.php";
include "include/functions.php";
include "include/auth.php";
$email = md5($candidate->getCandEmail());
$candidate->getCvData();
//tab 1
$DOB = "";
$address = "";
$city = "";
$state ="";
$country = "";
//tab 2
$about = "";
$company_name = "";
$start_date = "";
$end_date = "";
$job_title = "";
$years_experience="";
$role = "";
//Qualifications
$university = "";
$qualification = ""; 
$year_completed = "";
//Courses
$course = "";
$skill = "";
$pdf_cv="";
$video_cv="";

//update tab 1
$DOB = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
$gender = $_POST['gender'];
if($gender == "other"){
	$gender = $_POST['otherGender'];
}
$race =$_POST['race'];
$state = $_POST['state'];
$country = $_POST['country'];
$address = $_POST['address'];
$date=""; 


//update tab 2
$about = $_POST['about_career'];
$company_name=$_POST['company_name'];
$start_date=$_POST['start_date'];
$end_date='';
$job_title = $_POST['job_title'];
if(isset($_POST['experience_id1'])){
	$exp1 =$_POST['experience_id1'];
}
if(isset($_POST['years_experience']))
{
	$years_experience = $_POST['years_experience'];
}
//
if(isset($_POST['userCellphone']))
{
	$cellphone = $_POST['userCellphone'];
	$sql = $db->prepare("UPDATE `candidate_tbl` SET `c_DOB`='$DOB', race='$race' , gender ='$gender', c_cellphone ='$cellphone' WHERE md5(c_email)='$email'");
$sql->execute();
}
else{
$sql = $db->prepare("UPDATE `candidate_tbl` SET `c_DOB`='$DOB', race='$race' , gender ='$gender' WHERE md5(c_email)='$email'");
$sql->execute();
}

if($candidate->countAddress() > 0)
{
	$a_sql = $db->prepare("UPDATE `address` SET `address`=?,`state`=?,`country`=? WHERE email =?");
	$a_sql->execute(array($address,$state,$country,$email));
}
else{
$check_query = $db->prepare("SELECT * FROM address WHERE email='$email'");
$check_query->execute();
$check_row = $check_query->fetch();
if($check_row['address'] != $address){
$address_sql = $db->prepare("INSERT INTO `address`(`email`, `address`,`state`, `country`) VALUES (?,?,?,?)");
$address_sql->execute(array($email,$address,$state,$country));
}
}
//bio

$candidate->addBio($about);

//update tab 2
$numJob = $candidate->countCurrentJob();
if($numJob > 0)
{
$candidate->updateExperience($company_name,$job_title, $start_date,$end_date,$exp1);
}
else 
{
	
		$check_query = $db->prepare("SELECT * FROM candidate_role WHERE c_email=? and status=?");
		$check_query->execute(array($email,'current'));
		$check_row = $check_query->fetch();
		if($check_row['company_name'] != $company_name)
		{
			$sql = $db->prepare("INSERT INTO `candidate_role`(`c_email`, `company_name`, `job_title`, `starting_date`, `end_date`, `status`) VALUES (?,?,?,?,?,?)");
			$sql->execute(array($email,$company_name,$job_title,$start_date,$end_date,'current'));
		}
	
}

$countKeyRoles = $candidate->countKeyRoles();
if($countKeyRoles > 0)
{
	foreach ($_POST['role'] as $key1 => $value) {
		$row_id = $_POST['role_id'][$key1];
	$query = $db->prepare("UPDATE `key_roles` SET `role`='$value' WHERE `id`='$row_id'");
	$query->execute();
	} 
}
else{
	if(isset($_POST['role'])){
	foreach ($_POST['role'] as $key => $value) {
	$check_query = $db->prepare("SELECT * FROM key_roles WHERE c_email='$email'");
	$check_query->execute();
	$check_row = $check_query->fetch();
	if($check_row['role'] != $value)
	{
	$query = $db->prepare("INSERT INTO `key_roles`(`c_email`, `role`) VALUES ('$email','$value')");
	$query->execute();
	}
	}
}
}
//tab 3
$num_jobs = $candidate->countPreviousJobs();
if($num_jobs > 0)
{

}
else{
	if(isset($_POST['company_name1']))
	{
	foreach ($_POST['company_name1'] as $key => $value) {
	$check_query = $db->prepare("SELECT * FROM candidate_role WHERE c_email=? and status=?");
	$check_query->execute(array($email,'post'));
	$check_row = $check_query->fetch();
	if($check_row['company_name'] != $value)
	{
	$query = $db->prepare("INSERT INTO `candidate_role`(`c_email`, `company_name`, `job_title`, `starting_date`, `end_date`, `status`) VALUES (?,?,?,?,?,?)");
	$query->execute(array($email,$_POST['company_name1'][$key],$_POST['job_title1'][$key],$_POST['start_date1'][$key],$_POST['end_date1'][$key],'post'));
	}
}
}
}
//tab 4
$num_qualification = $candidate->countQualifications();
if($num_qualification > 0)
{

}
else
{
	foreach ($_POST['qualification'] as $row => $value) 
	{
		$check_query = $db->prepare("SELECT * FROM qualifications WHERE c_email=?");
		$check_query->execute(array($email));
		$check_row = $check_query->fetch();
		if($check_row['q_name'] != $value && $check_row['institution_name'] != $_POST['university'][$row] )
		{
		$query = $db->prepare("INSERT INTO `qualifications`(`c_email`, `q_name`, `q_date_started`, `qw_date_completed`, `institution_name`) VALUES (:email,:qualification,:date_started,:date_ended, :university)");
		$query->execute(['email'=>$email,'qualification'=>$value,'date_started'=>$date,'date_ended'=>$_POST['end_year'][$row],'university'=>$_POST['university'][$row] ]);
		}
	}
}
//tab 5
$countKeyCourses = $candidate->countKeyCourses();
if($countKeyCourses > 0)
{

}
else{
	foreach ($_POST['key_course'] as $key => $value) {
	$check_query = $db->prepare("SELECT * FROM key_courses WHERE c_email=?");
	$check_query->execute(array($email));
	$check_row = $check_query->fetch();
	if($check_row['key_course'] != $value)
	{
	$query = $db->prepare("INSERT INTO `key_courses`(`c_email`, `key_course`) VALUES (?,?)");
	$query->execute(array($email,$value));
	}
}
}
$countKeySkills = $candidate->countKeySkills();
if($countKeySkills > 0)
{

}
else{
	foreach ($_POST['key_skill'] as $key => $value) {
	$check_query = $db->prepare("SELECT * FROM key_skills WHERE c_email=?");
	$check_query->execute(array($email));
	$check_row = $check_query->fetch();
	if($check_row['skill'] != $value)
	{
	$query = $db->prepare("INSERT INTO `key_skills`(`c_email`, `skill`) VALUES (?,?)");
	$query->execute(array($email,$value));
	}
}
}

if(empty($candidate->getPdfCV())){
	if(isset($_FILES['pdf_cv']))
	{
	//$candidate->addCv($_FILES['upload_short_cv']);
		$file_array = $_FILES['pdf_cv'];
		
		if($file_array['error'])
		{
			
		}
		else{
			$allow = array('pdf');
			$fileExt = explode('.',$file_array['name']);
			$fileActualExt = strtolower(end($fileExt));
			if(!in_array($fileActualExt, $allow))
			{
				
			}
			else
			{
				$new_filename = round(microtime(true)).'.'.$fileActualExt;
				move_uploaded_file($file_array['tmp_name'] ,'cv/'.$new_filename);					
				$pdf_cv = $new_filename;
				
			}
		}
	}
}
else{
	$pdf_cv = $candidate->getPdfCV();
}

if(empty($candidate->getVideoCV())){
	if(isset($_FILES['video_cv']))
	{
	//$candidate->addCv($_FILES['upload_short_cv']);	

		$file_array = $_FILES['video_cv'];
		
			if($file_array['error'])
			{
				
			}
			else{
				$allow = array('mp4','avi','wmv','flv','webm','mov');
				$fileExt = explode('.',$file_array['name']);
				$fileActualExt = strtolower(end($fileExt));
				if(!in_array($fileActualExt, $allow))
				{
					
				}
				else
				{
					$new_filename1 = round(microtime(true)).'.'.$fileActualExt;
					move_uploaded_file($file_array['tmp_name'] ,'video cv/'.$new_filename1);					
					$video_cv = $new_filename1;					
				}
				 
			}
		}	
		
	}
	else{
		$video_cv = $candidate->getVideoCV();
	}

	// save methods to database
	$methods = "";
	if(isset($_POST['wmethod'])){
		$email = md5($candidate->getCandEmail());
		if (count($_POST['wmethod']) != 0) {
			foreach ($_POST['wmethod'] as $key => $value) {
				$methods = $methods.','.$value;
			}		 
		}
	}
	$methods = substr($methods, 1);
	$sql = $db->prepare("UPDATE `curriculum_vitae` SET `cv_file`=?,`video_cv`=?,`work_method`=?,`years_experience` = ? WHERE `c_email` = ?");
	$sql->execute(array($pdf_cv,$video_cv,$methods,$years_experience,$email));

?>