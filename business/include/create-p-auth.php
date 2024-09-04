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

	?>