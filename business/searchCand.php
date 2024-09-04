<?php
//Headers
session_start();
include "include/connect.php";
include "include/functions.php";
$corp = new Corporate($db);
$corp->setCompData($_SESSION['id']);
$corp->setUsersData($_SESSION['id']);
$candidate = new Candidates($db);
$corp->getSubscription();
//end of headers
include "head.php";
?>
<div class="row">
<?php
$search = $_POST['search_field'];
$location = $_POST['loc'];
$count = 0;

if(empty($search) && empty($location))
{
	//echo $location;
	$query = $candidate->getAllCandidates();
	for($i = 0; $rows = $query->fetch();$i++)
	{ 
		$candidate->setCandidate(md5($rows['c_email']));
		$candidate->getCurrentJob();
		?>
		<div class="col-lg-4">
			<a href="view-profile?id=<?php echo md5($rows['c_email']) ?>">
				<div class="person-frame" id="">
					<div class="prof-img">
						<?php 
						if(empty($candidate->getPP()) || $corp->getPackPrice() == 0)
						{
							?>
							<img src="img/user.svg">
							<?php
						}
						else{
							?>						
							<img src="img/<?php echo $candidate->getPP() ?>">
							<?php
						}
						?>
					</div>
					<div class="prof-det pers-det">
						<label class="l-14 text-black"><?php echo $corp->getHidden($rows['c_surname']).' '.$corp->getHidden($rows['c_name']) ?></label>
						<p class="p-12"style="margin-top: -5px;"><?php echo $candidate->getCurJobTitle() ?></p>
					</div>
				</div>
			</a>
		</div>
		<?php
	}
}
else if(!empty($search) || !empty($location))
{
	//echo $location;

	$query = $candidate->searchTalent($search,$location);

	for($i = 0; $rows = $query->fetch();$i++)
	{ 
		$candidate->setCandidate($rows['c_email']);
		$candidate->getCurrentJob();
		$skills = $candidate->getCombinedSkills($rows['c_email']);
		if($candidate->searchTalentBySkills($search,$skills)== true)
		{
			?>
			
			<div class="col-lg-4">
				<a href="view-profile?id=<?php echo $rows['c_email'] ?>">
					<div class="person-frame" id="">
						<div class="prof-img">
							<?php 

							if(empty($candidate->getPP()) || $corp->getPackPrice() == 0)
							{
							?>
							<img src="img/user.svg">
							<?php
							}
							else{
							?>						
							<img src="img/<?php echo $candidate->getPP() ?>">
							<?php
							}
							?>
						</div>	
						<div class="prof-det pers-det">
							<label class="l-14 text-black"><?php echo $corp->getHidden($candidate->getCandName()).' '.$corp->getHidden($candidate->getCandSurname()); ?></label>
							<p class="p-12"style="margin-top: -5px;"><?php echo $candidate->getCurJobTitle() ?></p>
						</div>
					</div>
				</a>
			</div>
			<?php
		}
		else
		{
		?>
		<div class="col-lg-4">
			<label>No results found</label>
		</div>
		<?php
		}
	}
}
else{
echo '<p class="p-14">No results found</p>';
}

?>
</div>