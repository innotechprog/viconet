<?php
session_start();
include "../include/connect.php";
include "../include/functions.php";
$insights = new Insights($db);
$seemail = $_SESSION['id'];
$candidate= new Candidates($db);
$candidate->setCandidate($seemail);

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Talent Trek</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@100;200;400;500;600;700;800;900&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400&display=swap" rel="stylesheet">
<link rel="icon" href="../img/favicon.png" type="image/x-icon">

  <!-- Google Fonts -->
  <!-- Vendor CSS Files -->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="../vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../vendor/venobox/venobox.css" rel="stylesheet">
  <link href="../vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="../vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="../vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
  <script src="../js/jquery-3.4.1.min.js"></script>
  <script src="../js/button_click.js"></script>
  <!-- Template Main CSS File -->
  <link href="../css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Medilab - v2.1.1
  * Template URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<body class="" style="background-color:#F7F8FA!important">
<?php
if(empty($_SESSION['id'])){
	?>
	<div class="header">
	<div class="header-content">
		<div class="logo">
			<a href="../index"><img src="../img/viconet-logo.svg" class="logo-img1"><img src="../img/logo-fav.png" class="logo-img2"></a>
		</div>
			<div class="toggle-btn">
				<div class="line"></div>
				<div class="line"></div>
				<div class="line"></div>			
			</div>
		
			
			<div class="header-btn">
				<button class="bton btn1" id="create_p2">CREATE PROFILE</button>
				<button class="bton btn2" id="sign_up2">SIGN UP</button>
			</div>
			<div class="links">
				<div class="sidebar">
					<ul>
						<li><a href="../webinar">WEBINAR</a></li>
						<li><a href="../blog">INSIGHT</a></li>
					
					</ul>
				</div>
			</div>
	</div>
</div>
<?php 
}
else{
	if($_GET['allow']==md5('staff'))
	{
		include "userHeader.php";
	}
	else if($_GET['allow']==md5('candidate'))
	{
		include 'include/create-p-auth.php';
		include 'candidate-header.php';
	}
}

?>	

<div class="my-container">
	<div style="display:flex;">
	<div id="my-blog-bg" class="my-blog">
	</div>
	<?php
		$query=$insights->getInsight($_GET['id']);
		for($i=0; $rows = $query->fetch();$i++)
		{
			?>
			<div class="blog-details">
		
			<div class="blog-flex" >
				<div class="blog-img1" >
					<img src="../img/<?php echo $rows['insight_img'] ?>">
				</div>			
				<div class="view-blog-detail">
					<label><?php echo $rows['insight_date'].' By '.$rows['insight_author'] ?></label>
					<h5><?php echo $rows['insight_title'] ?></h5>
				</div>
			</div>
		</div>
		</div>
	</div>

<div class="insight-content">
	<div class="content-frame">
	<?php echo nl2br(html_entity_decode($rows['insight_content'])); 
		}
		?>
	</div>
</div>


<?php
include "../footer.php";
?>
</body>
<!-- Javascripts -->
<script type="text/javascript" src="../js/toggle.js"></script>
<script src="../js/button_click.js"></script>
</html>