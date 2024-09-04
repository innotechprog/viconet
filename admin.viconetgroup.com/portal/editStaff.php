<?php
 include '../include/connect.php';
$id=$_GET['id'];
$result = $db->prepare("SELECT * FROM staff WHERE s_id= :userid");
$result->bindParam(':userid', $id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
	?>

	<?php 
    include "head.php";
    ?>
	<form action="saveeditusers.php" method="post" class = "form-group">
		<div id="ac">
			<input type="hidden" name="memi" value="<?php echo $id; ?>" />
			<span>First Name : </span><input type="text" name="name" class = "form-control" value="<?php echo $row['s_first_name']; ?>" />
			<span>Surname : </span><input type="text" name="surname" class = "form-control" value="<?php echo $row['s_last_name']; ?>" />
			<span>Email : </span><input type="text" name="email" class = "form-control" value="<?php echo $row['s_email']; ?>" />
			<span>Cellphone : </span><input type="text" name="cellphone" class = "form-control" value="<?php echo $row['s_cell_number']; ?>" />
			
			<span>&nbsp;</span><input class="btn btn-primary btn-block" type="submit" class = "form-control" value="Update" />
		</div>
	</form>
	<?php
}
?>