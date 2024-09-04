<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
//Te
include "include/connect.php";
include "include/functions.php";
include "include/corp_auth.php";
include "include/jobs_class.php";
include "include/website_class.php";
$web = new Website($db); //Website class
$jobs = new Jobs($db);
$emails = new SendEmails($db);
 
if(isset($_POST['saveJob']) || isset($_POST['publish'])){
	$jobId = $jobs->generateJobId();
	$compReg = $corp->getCompEmail();
	$methods= "";
	$requirement="";
	$responsibility ="";
	$jobIntro =$_POST['jobIntro'];
	$jobTitle= $_POST['jobTitle'];
	$jobDesc = $_POST['jobDesc'];
	$minSalary="";
	$maxSalary="";
	$salary=$_POST['salary'];
	$currency=$_POST['currency'];
	$salInterval='';
	$postType=$_POST['postType'];
	$startDate=$_POST['startDate'];
	$appLink=$_POST['appLink'];
	//$appLink="";
	$unsuccessfulPeriod = $_POST['period'];
	$industry = $_POST['industry'];
	if($industry =="other"){
		$industry = $_POST['otherIndustry'];
		$jobs->addIndustry($industry);
	}
	$reportTo = $_POST['reportTo'];
	$qualification = $_POST['qualification'];
	$exp=$_POST['exp'];
	$posLevel=$_POST['postLevel'];	
	$closingDate = $_POST['closingDate'];
	$exper = "";
	//Company info from jobs
	$companyName = $_POST['compName'];
	$companyEmail = $_POST['compEmail'];
	$companyAddress = $_POST['compAddress'];
	$companyTel = $_POST['compTel'];
	$addedBy = $corp->getUserEmail();
	$compId = $jobs->getCompanyNextID();
	//Getting methods
	$workMethods = $_POST['wMethod'];
	if(isset($_POST['saveJob'])){
		$jobStatus="pending";
		$date = new DateTime('now');
		$datePosted = $date->format('Y-m-d');
	}
	else if(isset($_POST['publish'])){
		$mail = new PHPMailer(true);

		$jobStatus="published";
		$date = new DateTime('now');
		$datePosted = $date->format('Y-m-d');
		
		include "emails/job-notification.php";
	}

if(isset($_POST['pp']))
{
	$logo = $_POST['pp'];
}
if($_FILES['logo']['name']!="")
	{
		$file_array = $_FILES['logo'];
		
			if($file_array['error'])
			{
				
			}
			else{
				$allow = array('jpg','png','jpeg','svg');
				$fileExt = explode('.',$file_array['name']);
				$fileActualExt = strtolower(end($fileExt));
				if(!in_array($fileActualExt, $allow))
				{
					
				}
				else
				{
					$new_filename = round(microtime(true)).'.'.$fileActualExt;
					move_uploaded_file($file_array['tmp_name'] ,'img/company logos/'.$new_filename);
					
				$logo= $new_filename;
					if(isset($_POST['pp']))
					{
						$path = "img/company logos/".$_POST['pp'];
						//deleting current file
						if(!unlink($path))
						{
							echo "not Deleted";
						}	
					}						
				}
			}
	
	}

	if(isset($_POST['update_job']))
	{

		$jobId = $_POST['jobId'];
		$jobs->updateJob($jobId,$compReg,$compId,$jobIntro,$jobTitle,$jobDesc,$reportTo,$minSalary,$maxSalary,$salary,$currency,$salInterval,$postType,$workMethods,$startDate,$appLink,$qualification,$exp,$posLevel,$jobStatus,$unsuccessfulPeriod,$datePosted,$closingDate);
		$jobs->updateCompanyForJobs($jobId,$companyName, $companyEmail,$companyTel,$companyAddress,$industry,$logo);
	$query = $db->prepare("delete from job_requirement where job_id =?");
		$query->execute(array($jobId));
	/*$query = $db->prepare("delete from job_responsibilities where job_id =?");
	$query->execute(array($jobId));*/
	foreach ($_POST['requirement'] as $key => $value)
	{
		$jobs->addRequirement($jobId,$value,$exper);
	}
	/*foreach ($_POST['responsibility'] as $key => $value)
	{
		$jobs->addResponsibility($jobId,$value);
	}*/
	}
	else{
//adding
	$jobs->addCompanyForJobs($compId,$companyName, $companyEmail,$companyTel,$companyAddress,$industry,$logo, $addedBy);
	$jobs->addJob($jobId,$compReg,$compId,$jobIntro,$jobTitle,$jobDesc,$reportTo,$minSalary,$maxSalary,$salary,$currency,$salInterval,$postType,$workMethods,$startDate,$appLink,$qualification,$exp,$posLevel,$jobStatus,$unsuccessfulPeriod,$datePosted,$closingDate);

		foreach ($_POST['requirement'] as $key => $value)
		{
			$jobs->addRequirement($jobId,$value,$exper);
		}
		/*foreach ($_POST['responsibility'] as $key => $value)
		{
			$jobs->addResponsibility($jobId,$value);
		}*/
		//save company logo
	}
		
	?>
	<script type="text/javascript">window.location="job-info?id=<?php echo $jobId ?>";</script>
	<?php
}
?>