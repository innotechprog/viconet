<?php
session_start();
include "include/connect.php";
include "include/functions.php";
if(isset($_GET['auth'])){
$_SESSION['corpid'] = getSessionId($_GET['auth']);
//$_SESSION['corpid'] = $_SESSION['corpid'];
}
include 'include/corp_auth.php';
$corp->getSubscription();
if(isset($_POST['refreshApplicants'])){
	$corp->refreshApplicants();
	//header("")
}
else if(isset($_POST['exportBcomTal'])){
	
	require_once "queries/export-candidates.php";

}
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
<div class="talent-blue-header add-h">
	<div class="prof-container">
		<label class="l-36-n text-white mb-3" style="margin-top:-55px">My Projects</label>		
		<div class="row">
			
				<div class="col-lg-3">
					<div class="white-container">
						<div class="profile-info">
							<?php
							if($corp->getPackPrice() ==0){
								?>
								<div class="upgradediv">
								<label class="p-14 text-black">To view full talent profile, click here to upgrade your package.</label>
								<a href="packages"><button class="bton btn1" style="width:100%">UPGRADE</button></a>
							</div>
							<?php
								}
							?>
						<div class="d-flex flex-row justify-content-between">
							<label class="l-14">Projects</label><label class="p-14-n comp-status" id="numProj" style="background: #FF8EBD"><?php echo $corp->countReceiptsPerUser(md5($corp->getUserEmail())); ?></label>

						</div>
						<hr> 
						<button class="bton btn2"style="width: 100%" id="addPro">New project</button>
						<div class="projects"> 
						<?php
						if($corp->getAddedBy() == "System" && $corp->getPackPrice() !=0)
						{
							?>
							<br>
							<a href="company-projects"><button class="bton btn1"style="width: 100%">Company Projects</button></a>
							<?php
						}
						?>
						</div>
					</div>
					</div>
				</div>
	<div class="col-lg-9">				
		<div class="corp-edit">	
				<?php 
				if($corp->getUserEmail() =="neo@viconetgroup.com")
				{
					?>
				<form action="" method="post">
					<button type="submit" name="refreshApplicants" class="bton btn1">Refresh Projects</button>
					<button type="submit" name="exportBcomTal" id="" class="bton btn2">Export Bcom Talents</button>
				</form>
					
				<hr>
				<?php
				}
				?>
			<div class="row">
			<?php $query = $corp->getReceiptsByUsers(md5($corp->getUserEmail()));
				for ($i=0; $rows = $query->fetch(); $i++) {
				$receiptId = $rows['receipt_id'];
					?>
				<div class="col-lg-4 projtabs">
					<a href="project?id=<?php echo $receiptId ?>">
					<div class="white-container" style="background: #EEEEFA;">
						<div class="record">
							<div class="delproj" id="<?php echo '1'.$receiptId;?>" ><img src="img/bin2.svg">
							</div>
							<div class="" style="text-align:center;">
								<img src="img/corp img/project.svg" class="prof-pic prof-pic2">
							</div>
							
						
						<div class="text-black" style="text-align: center;">
							<label class="p-18 oneline-limit" ><?php echo $rows['name'] ?></label>
							<div class="projdesc">
								<p class="p-14 oneline-limit"><?php echo $rows['description'] ?></p>
							</div>
						</div>
						<hr>
						<div class="d-flex flex-row justify-content-between">
							<label class="l-14">Talent</label><label class="p-14-n comp-status" id="numProj" style="background: #FF8EBD"><?php echo $corp->countCandidatesInProj($receiptId); ?></label>
						</div>
					</div>
				</div>
				</a>
			</div>
				<?php
				}
				?>
			</div>
			
			</div>
			
			</div>
		</div>

	</div>
</div>


<?php
include "modals.php";
?>
</body>
<!-- Javascripts -->
<script type="text/javascript" src="js/toggle.js"></script>
<script type="text/javascript" src="js/project-tabs.js"></script>
<script type="text/javascript" src="js/button_click.js"></script>
<script type="text/javascript" src="js/delete.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</html>