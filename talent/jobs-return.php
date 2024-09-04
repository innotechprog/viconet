<?php
session_start();
include "include/connect.php";
include "include/functions.php";
include "include/website_class.php";
$candidate = new Candidates($db);
$corp = new Corporate($db);
$web = new Website($db); //Website class
include "../".$web->getWebLinkExt()."business.viconetgroup.com/include/jobs_class.php";
$jobs = new Jobs($db);
$count = 0;
?>
<div class="mt-7 jobs">
	<div style="display: flex;justify-content: space-between;">
	<!--Do not remove--><label></label><!---->
	<label class="p-18"><label id="numRows"></label></label>
	</div>
		<?php 
		$query = $jobs->getJobsBySearch($_POST['search_field'],$_POST['job_category']);
		for($x=0; $rows = $query->fetch();$x++){
			$count +=1;
			$id = md5($rows['job_id']);
			$jobs->setJob($id);
			$jobs->setCompany($rows['company_id']);
			$jobs->setCurrency($jobs->getJobCurrency());
		 ?>
		 <a href="job?id=<?php echo $id ?>" target="_blank" class="box">
		 <div class="jobrief row">
		 	<div class="col-lg-5">
			<div class="leftcont d-flex">
				<?php 
					if(empty($jobs->getCompLogo())){
						?>
						<div class="complogo">
							<img src="img/comp-logo.svg">
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
				<div class="">
					<label class="l-16"><?php echo $jobs->getCompName() ?></label>
					<p class="p-14-n"><?php echo $jobs->getCompIndustry() ?></p>
					<p class="p-14-n"><?php echo $jobs->getCompLocation() ?></p>
					<?php
					$methods = $jobs->getWorkMethods();							
					$methods = explode(',',$methods);
					foreach($methods as $method){
						
						if($method == "office"){
							?>
						<label class="wtype">Office Based</label>
						<?php
						}
						elseif ($method == "remote") {
							?>
						<label class="wtype">Remote</label>
						<?php
						}
						elseif ($method == "hybrid") {
							?>
						<label class="wtype">Hybrid</label>
						<?php
						}										
					}
					?>
				</div>				
			</div>
		</div>
			<div class="col-lg-4">
				<label class="l-16 oneline-limit"><?php echo $rows['job_title'] ?></label>
				<p class="p-14"><?php echo $jobs->getJobExperience()  ?> Experience</p>
				<div class="twoline-limit">
				<?php 
			$query1 = $jobs->getRequirements($rows['job_id']);
			for($i=0;$row=$query1->fetch();$i++)
			{
				?>
				<label class="skillfrm2"><?php echo $row['requirement'] ?></label><?php
			}
			?>
			</div> 
			
			</div>
			<div class="col-lg-3">
				<?php if(getDateDifference($rows['date_posted'] ) < 6){
					?>
					<label class="newjobfrm">New</label>
				<?php
					}
					?>			
				<label class="l-14"><?php echo getDateDifference($rows['date_posted']).' Days ago'; ?></label>
				<p class="p-14">Closing Date : <?php echo $rows['closing_date'] ?></p>
				<p class="p-14">CTC : <?php if(!empty($jobs->getJobSalary())){ echo  $jobs->getCurrencySymbol().$jobs->getJobSalary();}else {echo 'Not specified';} ?></p>
				<p class="p-14 text-capitalize"><?php echo $jobs->getPostType()  ?></p>				
			</div>
		</div>
	</a>
		 <?php
		} 
		if($count == 0)
		{
		 ?>
		 <p class="p-18">No Job found on this category </p>
		 <?php
		}
		?>
	</div>
	 <div id="pagin">
 	</div>

	 <script type="text/javascript">
	 numRow = <?php echo $count ?>;

	 document.getElementById("numRows").innerHTML = 'Search Result ('+numRow+')';
 </script>