
<div id="land-page" class="my-container">
	<div class="content" style="margin-left:15px; margin-right: 15px;">
		<div class="row">
			<div class="col-lg-6">
				<div class="landing-img">
					<img src="img/<?php echo $landing->getImg() ?>">
				</div>
			</div>
			<div class="col-lg-6">
				<div id="container-blur">
				<div class="landing-content">
					<h1 class="text-white"><?php echo $landing->getTitle() ?></h1>
					<p class="p-18 text-white">
						<?php echo $landing->getContent() ?>
						
					</p>
					
				</div>
			</div>
			</div>	
		</div>
	</div>
</div>