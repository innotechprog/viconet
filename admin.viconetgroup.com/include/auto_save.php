<?php
session_start();
include "include/connect.php";
include "include/functions.php";
include "include/auth.php";
$email = md5($candidate->getCandEmail());
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
$DOB = $_POST['dateOfBirth'];
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
$exp1 =$_POST['experience_id1'];
//
$sql = $db->prepare("UPDATE `candidate_tbl` SET `c_DOB`='$DOB' WHERE md5(c_email)='$email'");
$sql->execute();
if($candidate->getAddressEmail() == $email)
{
	$a_sql = $db->prepare("UPDATE `address` SET `address`='$address',`state`='$state',`country`='$country' WHERE email ='$email' ");
	$a_sql->execute();
}
else{
$address_sql = $db->prepare("INSERT INTO `address`(`email`, `address`,  `code`,`state`, `country`) VALUES ('$email','$address','','$state','$country')");
$address_sql->execute();
}
//bio

$candidate->addBio($about);

//update tab 2
$numJob = $candidate->countCurrentJob();
if($numJob == $email)
{
$candidate->updateExperience($company_name,$job_title, $start_date,$end_date,$exp1);
}
else 
{	
$sql = $db->prepare("INSERT INTO `candidate_role`(`c_email`, `company_name`, `job_title`, `starting_date`, `end_date`, `status`) VALUES ('$email', '$company_name','$job_title','$start_date','$end_date','current')");
$sql->execute();
}

$countKeyRoles = $candidate->countKeyRoles();

//tab 3
$num_jobs = $candidate->countPreviousJobs();
if($num_jobs > 0)
{

}
else{
	foreach ($_POST['company_name1'] as $key => $value) {
	$check_query = $db->prepare("SELECT * FROM candidate_role WHERE c_email='$email' and status='post'");
	$check_query->execute();
	$check_row = $check_query->fetch();
	if($check_row['company_name'] != $value)
	{
	$query = $db->prepare("INSERT INTO `candidate_role`(`c_email`, `company_name`, `job_title`, `starting_date`, `end_date`, `status`) VALUES (:email, :company, :job, :start_date,:end_date,:status)");
	$query->execute(['email'=>$email,'company'=>$_POST['company_name1'][$key],'job'=>$_POST['job_title1'][$key],'start_date'=>$_POST['start_date1'][$key],'end_date'=>$_POST['end_date1'][$key],'status'=>'post']);
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
		$check_query = $db->prepare("SELECT * FROM qualifications WHERE c_email='$email'");
		$check_query->execute();
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
	$check_query = $db->prepare("SELECT * FROM key_courses WHERE c_email='$email'");
	$check_query->execute();
	$check_row = $check_query->fetch();
	if($check_row['key_course'] != $value)
	{
	$query = $db->prepare("INSERT INTO `key_courses`(`c_email`, `key_course`) VALUES ('$email','$value')");
	$query->execute();
	}
}
}
$countKeySkills = $candidate->countKeySkills();
if($countKeySkills > 0)
{

}
else{
	foreach ($_POST['key_skill'] as $key => $value) {
	$check_query = $db->prepare("SELECT * FROM key_skills WHERE c_email='$email'");
	$check_query->execute();
	$check_row = $check_query->fetch();
	if($check_row['skill'] != $value)
	{
	$query = $db->prepare("INSERT INTO `key_skills`(`c_email`, `skill`) VALUES ('$email','$value')");
	$query->execute();
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
if(empty($candidate->getVideoCV())){
	if(isset($_FILES['video_cv']))
	{
	//$candidate->addCv($_FILES['upload_short_cv']);	

		$file_array = $_FILES['video_cv'];
		
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
					move_uploaded_file($file_array['tmp_name'] ,'video cv/'.$new_filename);					
					$video_cv = $new_filename;					
				}
			}
		}	
		
	}
	$sql = $db->prepare("UPDATE `curriculum_vitae` SET `cv_file`='$pdf_cv',`video_cv`='$video_cv' WHERE `c_email` = '$email'");
	$sql->execute();
?>