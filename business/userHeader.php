<script type="text/javascript" src="js/refresher.js"></script>
<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.
?>
<div class="header">
	<div class="header-content">
		<div class="logo">
			<a href="#"><img src="img/viconet-logo.svg" class="logo-img1"><img src="img/logo-fav.png" class="logo-img2"></a>
		</div>
		<div class="toggle-btn">
			<div class="line"></div>
			<div class="line"></div> 
			<div class="line"></div>			
		</div>
		
		<div class="dropdown">
		<div class="user-pic-d drop-down" > 
			<?php
			if(empty($corp->getPP()))
			{
				?>
				<label class="l-14" style=""><?php echo substr($corp->getUserName(), 0,1).substr($corp->getUserSurname(), 0,1); ?></label>
				<?php
			}
			else{
				?>
			<img src="img/<?php echo $corp->getPP() ?>">
			<?php 
			}
		?>
			
		</div>
		
		<div class="dropdown-content">
			
			<div class="prof-det">
				<label class="l-14 text-black"><?php echo $corp->getUserName().' '.$corp->getUserSurname(); ?></label>
				<p class="p-12"style="margin-top: -5px;"><?php echo $corp->getUserEmail(); ?></p>
			</div>
			<div class="view-profBtn">
				<button class="bton prof-btn" id="user_profile">my profile</button>
			</div>
			<?php 
				if($corp->getAddedBy() == "System")
				{
					?>
				<br>
				<div class="view-profBtn">
					<button class="bton prof-btn" id="corp_profile">company profile</button>
				</div>
				<?php
				}
			?>
			<hr>
			<div class="prof-tab">
			    <a href="corp_settings" class="aSet">Settings</a>
			</div>
			<hr>
			<div class="prof-tab">
			    <a href="#" id="corp_logout" class="aL-out">Sign Out</a>
			</div>
	 	 </div>
	</div>
	<a href="view-basket">
		<div class="cand-cart"> 
			<img src="img/resources/user-list.svg">
			<div class="num-cand"><div style="margin-top:-1px;font-size: 13px;" id="num_candidates"></div></div>
		</div>
	</a>

		<div class="links">
			<div class="sidebar">
				<ul>
					<?php
					$id= md5('corp');
					?>
					<li><a href="talent-search">TALENT SEARCH</a></li>
					<li><a href="my-projects">PROJECTS</a></li>
					<?php 
						if($corp->getAddedBy() == "System")
						{
					?>
					<li><a href="packages" class="subscription">PRICING</a></li>
					<?php
						}
					?>
					<li><a href="job-posting" class="bton btn2 text-white">JOB POSTING</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>			