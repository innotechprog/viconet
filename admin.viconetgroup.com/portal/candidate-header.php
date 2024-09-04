<div class="header">
	<div class="header-content">
		<div class="logo">
			<a href=""><img src="../img/viconet-logo.svg" class="logo-img1"><img src="../img/logo-fav.png" class="logo-img2"></a>
		</div>
		<div class="toggle-btn">
			<div class="line"></div>
			<div class="line"></div>
			<div class="line"></div>			
		</div>
		<div class="dropdown">
		<div class="user-pic-d drop-down" >
			<?php
				if(!empty($candidate->getPP()))
				{
					?>
				<img src="../img/<?php echo $candidate->getPP() ?>">
				<?php
				}
				else{
					?>
					<label class="l-14" style="color:#ccc"><?php echo substr($candidate->getCandName(), 0,1).substr($candidate->getCandSurname(), 0,1); ?></label>
					<?php
				}
				?>
		</div>
		
		<div class="dropdown-content">
			
			<div class="prof-det">
				<label class="l-14 text-black"><?php echo $candidate->getCandName().' '.$candidate->getCandSurname(); ?></label>
				<p class="p-12"style="margin-top: -5px;"><?php echo $candidate->getCandEmail(); ?></p>
			</div>
			<div class="view-profBtn">
				<a href="../profile-view"><button class="bton prof-btn" style="width:100%" id="cand_profile">view profile</button></a>
			</div>
			<!--<hr>
			<div class="prof-tab">
			    <a href="#" class="aSet">Settings</a>
			</div>-->
			<hr>
			<div class="prof-tab">
			    <a href="../logout" class="aL-out">Sign Out</a>
			</div>
	 	 </div>
	</div> 
		<div class="links">
			<div class="sidebar">
				<ul>
					<?php
					$id= md5('candidate');
					?>
					<li><a href="../webinar?id=<?php echo $id ?>">WEBINARS</a></li>
					<li><a href="../blog?id=<?php echo $id ?>">INSIGHTS</a></li>
					
				</ul>
			</div>
		</div>
	</div>
</div>			