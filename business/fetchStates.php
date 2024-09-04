<?php
include "include/connect.php";
include "include/functions.php";
$id = $_POST['country_id'];
$query = $db->prepare("select * from states where country_id='$id'");
$query->execute();
echo '<option>Select State</option>';
for ($i=0; $rows=$query->fetch() ; $i++) { 
	
	echo '<option value="'.$rows['id'].'">'.$rows['name'].'</option>';
}
?>
