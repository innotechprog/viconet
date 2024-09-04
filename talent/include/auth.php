<?php
if(isset($_SESSION['id'])){
$seemail = $_SESSION['id'];
$candidate= new Candidates($db);
$candidate->setCandidate($seemail);
$sess = $candidate->getSession();
}else{
	?>
	<script>window.location = "index"</script>
	<?php
	exit();
}

$id= md5('verify');

if(!isset($_SESSION[$sess]) || (trim($_SESSION[$sess]) == '')) {
		?>
		<script> window.location = "index"</script>
		<?php
		exit();
	}
	else if ($candidate->getStatus() =='Pending') {
		?>
		<script type="text/javascript">window.location= "message?id=<?php echo $id ?>" </script>
		<?php 
	}
	else if ($candidate->getStatus() =='process') {
		?>
		<script type="text/javascript">window.location= "profileopt" </script>
		<?php
	}
	else if ($candidate->getStatus() =='google-process') {
		?>
		<script type="text/javascript">window.location= "terms" </script>
		<?php
	}

	?>