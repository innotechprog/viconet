<?php
$seemail = $_SESSION['id'];
$candidate= new Candidates($db);
$candidate->setCandidate($seemail);
$sess = $candidate->getSession();
//echo $seemail.' '.$sess.'  '.$_SESSION[$sess];

$id= md5('verify');
if(!isset($_SESSION[$sess]) || (trim($_SESSION[$sess]) == '')) {
		?>
		<script>window.location = "index"</script>
		<?php
		exit();
	}
	else if ($candidate->getStatus() =='Pending') {
		?>
		<script type="text/javascript">window.location= "index" </script>
		<?php 
	}
	/*else if ($candidate->getStatus() =='google-process') {
		?>
		<script type="text/javascript">window.location= "terms" </script>
		<?php 
	}*/
	else if ($candidate->getStatus() =='verified') {
		?>
		<script type="text/javascript">window.location= "profile-view" </script>
		<?php
	}

	?>