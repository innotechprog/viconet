<!DOCTYPE html>
<html>
<?php
include "head.php";
?>
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
	<meta name="robots" content="index, follow">
    <link rel="shortcut icon" type="image/png" href="favicon.png">
    
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css?6841">
	<link rel="stylesheet" type="text/css" href="css/style2.css">
	<link rel="stylesheet" type="text/css" href="css/ionicons.min.css">
	<link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,500,600,700,40&display=swap&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <title>message-success</title>


    
<!-- Analytics -->
 
<!-- Analytics END -->
    
</head>
<body style="  height: 100%;">
	<?php
	$perm = md5('offer');
	$opt = md5('accepted');
	$what = $_GET['what'];
	if($_GET['perm'] == $perm)
	{
		if($_GET['opt']== $opt){
		?>
<div class="bloc bg-bg d-bloc full-width-bloc bloc-fill-screen " id="container-f">
	<div class="container">
		<div class="row">
			<div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 text-start col-lg-4 offset-lg-4">
				<div class="card-f">
					<div class="row">
						<div class="col align-self-center">
							<img src="img/lazyload-ph.png" data-src="img/logo.svg" class="img-fluid mx-auto d-block mb-lg-3 lazyload" alt="logo" width="179" height="66">
							<div class="row">
								<div class="col">
									<img src="img/lazyload-ph.png" data-src="img/animation_lkb7ocgd_small.gif" class="img-fluid mx-auto d-block img-succe-style lazyload" alt="animation_lkb7ocgd_small" width="92" height="92">
									<p class="p-style mb-md-4 mb-4 text-lg-center mt-lg-0 mt-md-0 float-md-none text-md-center text-sm-center mt-sm-0 text-center mt-0">
										<?php
										$meeting = md5('Meeting'); 
										if($what== $meeting)
										{
											echo 'Thank you for accepting the meeting invitation. A representative of the company will contact you.<br>Have a good day further.';
										}
										else{
											echo 'Thank you for accepting the interview invitation. A representative of the company will contact you.<br>Have a good day further.';
										}
										?>
	
									</p>
								</div>
							</div><a href="index" class="btn btn-d btn-lg mb-md-2 mb-sm-2 btn-12 float-lg-none mt-lg-0 w-100">Login</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	<?php
	}
	else{
		?>
	
<div class="bloc bg-bg d-bloc full-width-bloc bloc-fill-screen " id="container-f">
	<div class="container">
		<div class="row">
			<div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 text-start col-lg-4 offset-lg-4">
				<div class="card-f">
					<div class="row">
						<div class="col align-self-center">
							<img src="img/lazyload-ph.png" data-src="img/logo.svg" class="img-fluid mx-auto d-block mb-lg-3 lazyload" alt="logo" width="179" height="66">
							<div class="row">
								<div class="col">
									<img src="img/lazyload-ph.png" data-src="img/animation_lkb7ocgd_small.gif" class="img-fluid mx-auto d-block img-succe-style lazyload" alt="animation_lkb7ocgd_small" width="92" height="92">
									<p class="p-style mb-md-4 mb-4 text-lg-center mt-lg-0 mt-md-0 float-md-none text-md-center text-sm-center mt-sm-0 text-center mt-0">Thank you for your response.<br> 
										Have a good day further. </p>
									</p>
								</div>
							</div><a href="index" class="btn btn-d btn-lg mb-md-2 mb-sm-2 btn-12 float-lg-none mt-lg-0 w-100">Login</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	<?php
	}
	}
	else{
	?>
	<div class="bloc bg-bg d-bloc full-width-bloc bloc-fill-screen " id="container-f">
	<div class="container">
		<div class="row">
			<div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 text-start col-lg-4 offset-lg-4">
				<div class="card-f">
					<div class="row">
						<div class="col align-self-center">
							<img src="img/lazyload-ph.png" data-src="img/logo.svg" class="img-fluid mx-auto d-block mb-lg-3 lazyload" alt="logo" width="179" height="66">
							<div class="row">
								<div class="col">
									<img src="img/lazyload-ph.png" data-src="img/animation_lkb7ocgd_small.gif" class="img-fluid mx-auto d-block img-succe-style lazyload" alt="animation_lkb7ocgd_small" width="92" height="92">
									<p class="p-style mb-md-4 mb-4 text-lg-center mt-lg-0 mt-md-0 float-md-none text-md-center text-sm-center mt-sm-0 text-center mt-0">
										<strong>Welcome to the Vico.net community.<br></strong><br>To complete your registration please go to your email to verify your account. &nbsp;<br>
									</p>
								</div>
							</div><a href="index" class="btn btn-d btn-lg mb-md-2 mb-sm-2 btn-12 float-lg-none mt-lg-0 w-100">Login</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	<?php
	}
	?>
</body>
<script src="./js/bootstrap.bundle.min.js?1184"></script>
<script src="./js/blocs.min.js?4897"></script>
<script src="./js/lazysizes.min.js" defer></script><!-- Additional JS END -->
<script src="../js/button_click.js"></script>
</html>