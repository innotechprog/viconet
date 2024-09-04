<?php
//Headers
session_start();
include "include/connect.php";
include "include/functions.php";
include 'include/corp_auth.php';
//end of headers

if($corp->getAddedBy() != "System")
{
	?>
	<script type="text/javascript">window.location= "talent-search"</script>
	<?php
}
?>
<!DOCTYPE html>
<html>
<?php
include "head.php";
?>
<script type="text/javascript" src="js/shwcursubsc.js?version=<?php echo time() ?>"></script>
<body class="body-b">
<?php
	include "userHeader.php";
?>
<div class="talent-blue-header add-h">
<div class="my-container ">
	<label class="l-36-n text-white mb-5" style="margin-top:-55px">Get Unlimited Access To The <label class="text-purple">Talent</label> Database</label>
	<div class="row mt-5 equal">
		<?php
		$query= $corp->getAllPackages();
		for($i=0; $rows = $query->fetch();$i++)
		{
			$id = md5($rows['package_id']);
			$package_price = $rows['package_price'];
			$package_name = $rows['package_name'];
			$priceId = "price".$i;
			$initialPrice = "pprice".$i;
			?>
		<div class="col-lg-3">
			<div class="white-container zoom-div footer-widget" >			
				<div class="package-frame"> 
					<label class="pack-dur"><?php echo $rows['package_duration'] ?></label>
					<p class="pack-name" style="color:#000"><?php echo $rows['package_name'] ?></p>
				<div class="pack-price" id="<?php echo $priceId ?>" style="margin-bottom:-15px;"><?php echo 'R'.number_format($rows['package_price'],0,'.',' ')."" ?><label style="font-size: 12px;letter-spacing: 1px;"><?php if($rows['package_price'] != 0){
					echo "Excl";} ?></label></div>
				<hr>
				<?php 
				$specs = explode(',', $rows['package_desc']);
				foreach ($specs as $key => $value) {
					?>

					<div class="d-flex"><?php
					if(str_contains($value, 'No'))
					{
						?>
						<img src="img/n-access.svg"><label class="pack-desc mt-1"><?php echo substr($value,3) ?></label>
						<?php
					}
					else{
						?>
						<img src="img/access.svg"  style="margin-top:-5px"><label class="pack-desc"><?php echo $value ?></label>
						<?php
					}?>
					</div>
					<?php
				}
				?>
				</div>
				<hr>
				<form action="billing-info" method="post">
				   <input type="hidden" name="p_id" value="<?php echo $rows['package_id'] ?>">
				   <input type="hidden" name="pPrice" id="<?php echo $initialPrice ?>" value="<?php echo $rows['package_price'] ?>">
				   <?php 
				   if($rows['package_price'] != 0)
				   {
				   	?>
				   <div class="num-users mb-2"><label class="l-14 mt-3">License per user</label><input type="number" min="1" name="numUsers" onchange="changePrice(this,'<?php echo $priceId;?>')" value="1" class="num-user-inp"></div>
				   <?php
					}
					?>
				<div class="p-p">					
					<input type="submit" class="bton btn1 pack-btn" id="<?php echo $rows['package_id'] ?>" value="Change Package">	
				</div>
				</form> 					
			</div>
		</div>
		<?php 
			} 
			?>
		
	</div>
</div>

</body>
<!-- Javascripts -->
<script type="text/javascript" src="js/toggle.js"></script>
<script type="text/javascript" src="js/button_click.js"></script>
</html>