<?php
session_start();
include "include/connect.php";
include "include/functions.php";	
include "../dev.business.viconetgroup.com/include/jobs_class.php";
if (isset($_SESSION['id'])) {
include "include/auth.php";
}
if(isset($_SESSION['jobid'])){
	unset($_SESSION['jobid']);
}
$jobs = new Jobs($db);
$corp = new Corporate($db);
$id ="";
$access = md5($pass);
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$jobs->setJob($id);
	$jobs->setCompany($jobs->jobCompId());
	$corp->getAddressBy($jobs->jobCompId());
	$jobs->setCurrency($jobs->getJobCurrency());
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Vico.net | Job Opportunities</title>
  <meta content="Our platform connects you with data science, digital, engineering, information systems, technology and analytical group of professionals critical to the future of work and business solutions." name="Jobs">
  <meta content="" name="data science, digital, engineering, information systems, technology">
 
<?php
include "head1.php";
?>	
</head>
<body class="body-b">
<?php
if (isset($_SESSION['id'])) {
	include "candidate-header.php";
}
else{
	include "jobs-header.php";
}
?>
<div class="" style="position:relative;">
<div class="talent-blue-header <?php if(!isset($_SESSION['id'])){?> add-h2<?php }else{ } ?>">
	<div class="prof-container">
		<div  style="" class="mb-4">
			<label class="l-24 text-white<?php if(!isset($_SESSION['id'])){?> mt-5 <?php }else{ echo ' '; } ?>mb-4">Job Information</label>
		</div>		
		<div class="row">
		<div class="col-lg-5">
			<div class="white-container sticky-div">
				<div class="company-details">
					<center>
					<?php 
					if(empty($jobs->getCompLogo())){
						?>
						<div class="complogo">
							<img src="img/comp-logo.svg" style="background:whitesmoke">
						</div>
						<?php
					}
					else{
						?>
						<div class="complogo">
							<img src="<?php echo 'https://business.viconetgroup.com/img/company logos/'.$jobs->getCompLogo(); ?>">
						</div>
						
						<?php 
					}
				?>	
					<label class="l-18"><?php echo $jobs->getCompName() ?></label>
					<p class="p-14-n"><?php echo $jobs->getCompIndustry() ?></p>
									
				</center>
					<hr>
					<div class="d-flex justify-content-between">
						<label class="l-16">Start Date</label>
						<p class="p-14"><?php echo  $jobs->getStartDate(); ?></p>
					</div>
					<div class="d-flex justify-content-between">
						<label class="l-16">Required Qualification</label>
						<p class="p-14"><?php echo  $jobs->getJobQualification() ?></p>
					</div>
					<div class="d-flex justify-content-between">
						<label class="l-16">Required Job Experience</label>
						<p class="p-14"><?php echo  $jobs->getJobExperience() ?></p>
					</div>
					<div class="d-flex justify-content-between">
						<label class="l-16">Position Level</label>
						<p class="p-14"><?php echo  $jobs->getPosLevel() ?></p>
					</div>
					<div class="d-flex justify-content-between">
						<label class="l-16">Position Location</label>
						<p class="p-14"><?php echo  $jobs->getCompLocation() ?></p>
					</div>
					<div class="d-flex justify-content-between">
						<label class="l-16">Work Method</label>
						<p class="p-14"><?php $method = $jobs->getWorkMethods();if($method == "remote"){echo "Remote";}else if ($method == "office") {
							echo "Office Based";}else if ($method == "hybrid") {echo "Hybrid";}?></p>
					</div>
					<div class="d-flex justify-content-between">
						<label class="l-16">Annual CTC</label>
						<p class="p-14"><?php if(!empty($jobs->getJobSalary())){ echo  $jobs->getCurrencySymbol().$jobs->getJobSalary();}else {echo 'Not specified';} ?></p>
					</div>
					<hr>
					<div class="d-flex justify-content-between">
						<label class="l-16">Posted</label>
						<p class="p-14-n"><?php echo getDateDifference($jobs->getJobPostedDate()).' Days ago' ?></p>
					</div>
					<div class="d-flex justify-content-between">
						<label class="l-16">Application Closing Date</label>
						<p class="p-14"><?php echo  $jobs->getJobCloseDate(); ?></p>
					</div>
					<hr>
						<form method="post" action="job-message">
							<input type="hidden" name="email" value="<?php if(isset($_SESSION[$sess])){echo $candidate->getCandEmail();
							} ?>">
							<input type="hidden" name="jobId" value="<?php echo $jobs->getJobId() ?>">
							<?php
							if(!isset($_SESSION['id'])){
								?>
								<button name="indirectApply" class="bton btn2 mr-0 d-block ml-auto" style="width:100%;text-align: center;">Apply Now</button>
								<?php
							}
							else if($jobs->checkApplicationExist(md5($candidate->getCandEmail()),md5($jobs->getJobId())) > 0){
								?>
								<button name="" class="bton btn2 mr-0 d-block ml-auto" style="width:100%" disabled>Applied</button>
								<?php
							}
							else if(!empty($jobs->getAppLink()) && isset($_SESSION['id'])){
								?>
								<button name="applyCompSite" class="bton btn2 mr-0 d-block ml-auto" style="width:100%">Apply Now</button>
								<?php
							}
							else{
								?>
								<button name="apply" class="bton btn2 mr-0 d-block ml-auto" style="width:100%">Apply</button>
								<?php
							}
							?>
							
						</form>						
				</div>
			</div>

			</div>
		<div class="col-lg-7">
				<div class="corp-edit">
				<label class="l-16">Job Title:</label><label class="l-16-n"> <?php echo $jobs->getJobTitle() ?></label>
				<br>
				<label class="l-16">Position Type:</label><label class="l-16-n"> <?php echo $jobs->getPostType() ?></label>			
				<br>
				<label class="l-16">Manager Job Title:</label><label class="l-16-n"> <?php echo $jobs->getReportTo() ?></label>
		
				<hr>	
				<div class="row">
						<div class="col-lg-12">
							<div class="d-block">
								<label class="l-16">Job Purpose</label>
								<p class="p-14-n" ><?php echo $jobs->getJobIntro(); ?></p>
							</div>
							<hr>
						</div>
						<div class="col-lg-12">
							<div class="d-block">
								<label class="l-16">Key Role Responsibilities</label>
								<p class="p-14-n"><?php echo $jobs->getJobDesc() ?></p>
							</div>						
							<hr>
						</div>
					<div class="col-lg-12">
							<div class="d-block">
								<label class="l-16">Required Skills</label>
								<?php 
								$query = $jobs->getRequirements($jobs->getJobId());
								for($x=0; $rows=$query->fetch();$x++){
								?>
								<div>
									
									<div class="d-flex">
										<div><div class="bullet mt-1"></div></div>
											<p class="p-14-n"><?php echo $rows['requirement']?></p>										
									</div>
								</div>								
								<?php
									}
								?>
							</div>	
						<hr>
						
					</div>								
				</div>
	
			</div>
			
			</div>			
		</div>

	</div>

<?php
if (!isset($_SESSION['id'])) {
	include "jobs-footer.php";
}
?>
<?php
if (isset($_POST['apply'])) {
	if (!isset($_SESSION['id'])) {
		$_SESSION['jobid'] = $id;
		?>
		<script type="text/javascript">window.location="https://talent.viconetgroup.com"</script>
		<?php
	}
	else if(isset($_SESSION['id'])){
		//include "job-appli-email.php";
		?>
		<script type="text/javascript">//window.location="jobp2?id=<?php echo $id ?>"</script>
		<?php
	}
}
?>

<!--Modal-->
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
<script type="text/javascript" src="js/delete.js"></script>
</html>