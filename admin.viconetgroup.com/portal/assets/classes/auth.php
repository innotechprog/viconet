<?php
if(!isset($_SESSION['staff_id']) || (trim($_SESSION['staff_id']) == '')) {
	?>
	<script> window.location = "https://admin.viconetgroup.com"</script>
	<?php
	exit();
}

?>