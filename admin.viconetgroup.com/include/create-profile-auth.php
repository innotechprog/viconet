<?php
$seemail = $_SESSION['id'];
$candidate= new Candidates($db);
$candidate->setCandidate($seemail);
$sess = $candidate->getSession();

$id= md5('verify');

if(!isset($_SESSION[$sess]) || (trim($_SESSION[$sess]) == '')) {
		?>
		<script> window.location = "login"</script>
		<?php
		exit();
	}
	else if ($candidate->getStatus() =='Pending') {
		?>
		<script type="text/javascript">window.location= "message?id=<?php echo $id ?>" </script>
		<?php 
	}
	else if ($candidate->getStatus() =='verified') {
		?>
		<script type="text/javascript">window.location= "profile-view" </script>
		<?php
	}

	?>