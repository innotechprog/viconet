<div class="header">
	<div class="header-content">
		<div class="logo">
			<a href=""><img src="img/viconet-logo.svg" class="logo-img1"><img src="img/logo-fav.png" class="logo-img2"></a>
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
				<img src="img/<?php echo $candidate->getPP() ?>">
				<?php
				}
				else{
					?>
					<label class="l-14" ><?php echo substr($candidate->getCandName(), 0,1).substr($candidate->getCandSurname(), 0,1); ?></label>
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
				<button class="bton prof-btn" style="width:100%" id="cand_profile">view profile</button>
			</div>
			<hr>
			<div class="prof-tab">
			    <a href="cand-settings" class="aSet">Settings</a>
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
					<li><a href="my-applications" class="">my applications</a></li>
					<li><a href="jobs" class="bton btn2 text-white">Find a Job</a></li>						
				</ul>
			</div>
		</div>
	</div>
</div>			