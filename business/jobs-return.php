<?php
session_start();
include "include/connect.php";
include "include/functions.php";
$candidate = new Candidates($db);
$corp = new Corporate($db);
include "include/jobs_class.php";
$jobs = new Jobs($db);
$count = 0;
?>
<div class="mt-7">
	<div style="display: flex;justify-content: space-between;">
	<!--Do not remove--><label></label><!---->
	<label class="p-18"><label id="numRows"></label></label>
	</div>
		<?php
		$query = $jobs->getJobsBySearch($_POST['search_field']);
		for($x=0; $rows = $query->fetch();$x++){
			$count +=1;
			$id = md5($rows['job_id']);
			$jobs->setJob($id);
			$jobs->setCompany($rows['company_id']);
		 ?>
		 <a href="job?id=<?php echo $id ?>" target="_blank">
		 <div class="jobrief d-flex justify-content-between">
			<div class="leftcont d-flex">
				<div class="complogo">
					<img src="img/Rectangle-84.jpg">
				</div>
				<div class="">
					<label class="l-16"><?php echo $jobs->getCompName() ?></label>
					<p class="p-14-n"><?php echo $jobs->getCompIndustry() ?></p>
					<p class="p-14-n"><?php echo $jobs->getCompLocation() ?></p>
					<?php
					$methods = $jobs->getWorkMethods();							
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
						elseif ($method == "hybrid") {
							?>
						<label class="wtype">Hybrid</label>
						<?php
						}										
					}
					?>
				</div>
				
			</div>
			<div >
				<label class="l-18 oneline-limit"><?php echo $rows['job_title'] ?></label>
					<p class="p-14-n twoline-limit"><?php echo $rows['job_desc'] ?></p>
				<?php 
			$query1 = $jobs->getRequirements($rows['job_id']);
			for($i=0;$row=$query1->fetch();$i++)
			{
				?>
				<label class="skillfrm"><?php echo $row['requirement'] ?></label><?php
			}
			?>
			<p><?php echo $jobs->getPostType()  ?></p>
			<p><?php echo $jobs->getJobExperience()  ?></p>
			</div>
			<div class="rightcont">
				<div class="">
					<label>Date Posted</label>
					<p><?php echo $rows['date_posted'] ?></p>
					<label>Closing Date</label>
					<p><?php echo $rows['closing_date'] ?></p>
					<p>Salary : <?php echo 'R'.$jobs->getJobSalary(); ?>
				</div>
			</div>
		</div>
	</a>
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