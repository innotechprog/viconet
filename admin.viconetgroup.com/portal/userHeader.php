<div class="header">
	<div class="header-content">
		<div class="logo">
			<a href="index"><img src="img/viconet-logo.svg" class="logo-img1"><img src="img/logo-fav.png" class="logo-img2"></a>
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
				<label class="l-14" style="color:#fff"><?php echo substr($corp->getCompName(), 0,1); ?></label>
				<?php
			}
			else{
				?>
			<img src="img/<?php //echo $candidate->getPP() ?>">
			<?php 
			}
		?>
			
		</div>
		
		<div class="dropdown-content">
			<div class="prof-img" style="border:1px solid #cccccc;">
				<?php
			if(empty($corp->getPP()))
			{
				?>
				<label class="l-14" style="color:#000"><?php echo substr($corp->getCompName(), 0,1); ?></label>
				<?php
			}
			else{
				?>
			<img src="img/<?php //echo $candidate->getPP() ?>">
			<?php 
			}
		?>
			
			</div>
			<div class="prof-det">
				<label class="l-14 text-black"><?php echo $corp->getUserSurname().' '.$corp->getUserName(); ?></label>
				<p class="p-12"style="margin-top: -5px;"><?php echo $corp->getCompEmail(); ?></p>
			</div>
			<div class="view-profBtn">
				<button class="bton prof-btn" id="corp_profile">view profile</button>
			</div>
			<hr>
			<div class="prof-tab">
			    <a href="#" class="aSet">Settings</a>
			</div>
			<hr>
			<div class="prof-tab">
			    <a href="logout" class="aL-out">Sign Out</a>
			</div>
	 	 </div>
	</div>
		<div class="links">
			<div class="sidebar">
				<ul>
					<?php
					$id= md5('staff');
					?>
					<li><a href="webinar?id=<?php echo $id ?>">WEBINARS</a></li>
					<li><a href="blog=<?php echo $id ?>">INSIGHTS</a></li>
					<li><a href="talent-profile">TALENT PROFILE</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>			