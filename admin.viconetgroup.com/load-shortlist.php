<?php
session_start();
if(isset($_GET['auth'])){
$_SESSION['corpid'] = $_GET['auth'];
//$_SESSION['corpid'] = $_SESSION['corpid'];
}
?>
<!DOCTYPE html>
<html>
<?php
//include "head.php";
include "include/connect.php";
include "include/functions.php";
include 'include/corp_auth.php';
$compReg = $corp->getCompReg();
$corp->getSubscription();
?>
<body>
	<?php
// Tell PayFast that this page is reachable by triggering a header 200
if(!isset($_COOKIE['cookie_cid']))
{
	$cookie_id = "cookie_cid";
	$cookie_value = $_SESSION['corpid'];
	setcookie($cookie_id,$cookie_value,time() + (86400 * 30), "/");
}
?>
			<div class="row">

		<div class="col-lg-8">
			<div class="white-container">
				<div class="row">
				<?php
				//receipt status
				$rec_status = 'not paid';
				$count = 0;
				$counter = 0;
				$sql = $corp->candidatesInBasket($rec_status);
				for($x = 0; $row = $sql->fetch();$x++)
				{
					$count += 1;
					$query = $candidate->candidateData($row['c_email']);
					for($i = 0; $rows = $query->fetch();$i++)
						{  
							$counter += 1;
							$candidate->setCandidate(md5($rows['c_email']));
							$candidate->getCurrentJob();
							$candidate->address();
							?>
					<div class="col-lg-6">						
						<div class="person-frame boarder-blue" id="">
							<div class="d-flex justify-content-between">
								<label class="candnum" style="margin-left:-10px"><?php echo '#'.$row['shortlist_id']; ?></label>
								<div class="rem-cand" style="margin-top:-3px" id="<?php echo $row['id'] ?>">
								<img src="img/rounddel.svg">
							</div>
								
							</div>
							<a href="view-profile?id=<?php echo md5($rows['c_email']) ?>&num=<?php echo $row['shortlist_id']; ?>">
							<div class="d-flex flex-row justify-content-between">
							<div class="d-flex">
								<div class="prof-img">
									<?php 
									if(empty($candidate->getPP()) || $corp->getPackPrice() == 0)
									{
										?>
										<img src="img/user.svg" alt="pp" id="cand_pp">
										<?php
									}
									else{
										?>						
										<img src="img/<?php echo $candidate->getPP() ?>" id="cand_pp" alt="pp">
										<?php
									}
									?>									
								</div>	
								<div class="prof-det pers-det">
								<label for="cand_pp" class="l-14 text-black"><?php echo $corp->getHidden($rows['c_surname']).' '.$corp->getHidden($rows['c_name']) ?></label>
								<p class="p-12"style="margin-top: -5px;"><?php echo $candidate->getCurJobTitle() ?></p>
								<p class="p-12"style="margin-top: -15px;"><?php echo $candidate->getCountry() ?></p>
								<div style="margin-top: -15px;margin-left: -7px;">
										<?php
										$candidate->getCvData();
										$methods = $candidate->getWorkMethods();
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
										}
										?>
										</div>
								</div>
							</div>					
						</div>
						</a>
						</div>
					</div>
					<?php
					}
				}
				if ($count == 0) {
					echo "<div class='col-lg-12'><label style='font-size:34px'>No candidate selected </label></div>";	
				}
					?>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="white-container mt-4" style="background: #ECF0F6;border-radius: 0px 0px 15px 15px;">
				<div class="disp-row">
					<label class="l-14">Candidates shortlisted</label><label class="l-18" style="color:#000" id="num_candidats"></label>
				</div>
				<hr>
				<div class="d-flex justify-content-between">
				<a href="talent-search" style="width:100%"><button class="bton btn1" style="width:100%">continue searching</button></a>
				</div>
				<center><label class="l-14 text-center">Or</label></center>
				<?php
				if ($count == 0) {
					?>
				<button class="bton btn2" style="width:100%" disabled id="checkOut">Save to project</button>
				<?php 
				}
				else{
	 				?>
					<button class="bton btn2" style="width:100%" id="checkOut">Add to project</button>
					<?php 
				}
				?>
			</div>
		</div>
	</div>
</body>
<?php
include "modals.php";
?>
<div id="projli" class="modal">
	<div class="edit-modal">
		<div class="live-chat-header">
			<div class="d-flex flex-row justify-content-between">
				<span class="l-18">Project</span>
				<span ><img src="img/close.svg" class="close"></span>
			</div>
		</div>
		<hr>
		<div class="edit-content">
			<button class="bton btn1"style="width: 100%" id="addPro">New project</button>
			<hr>
			<?php if($corp->countReceiptsPerUser(md5($corp->getUserEmail())) >0)
			{?>
			<form method="post" action="save_data">
				<label class="l-18">Add to existing project</label>

				<div class="row">

					<?php
						$query = $corp->getReceiptsByUsers(md5($corp->getUserEmail()));
							for ($i=0; $rows = $query->fetch() ; $i++) { 
								$id = $rows['receipt_id'];
								
								?>
								<label class="col-lg-12">
								  <input type="checkbox" value="<?php echo $id?>" name="project[]">
								  <span class="checkmark l-14"><strong><?php echo ($i+1).'. ' ?></strong><?php echo $rows['name'] ?></span>
								</label>
								<?php
							}
						?>
						<input type="hidden" name="id" value="addCand">
					<div class="col-lg-12 form-group">
						<button class="bton btn2"style="width: 100%" name="add_experience">SAVE</button>
					</div>
				</div>	
			</form>
			<?php 
			}
			?>
		</div>
	</div>
</div>

</html>
<script type="text/javascript" src="js/button_click.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>