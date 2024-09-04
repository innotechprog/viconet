<?php
session_start();
   include '../include/connect.php';
   include 'assets/classes/auth.php';
$id = $_POST['id'];

$query = $db->prepare("SELECT * from candidate_tbl where c_id = '$id'");
$query->execute();
while($rows=$query->fetch())
{
   echo   '<label class="form-control-label" for="">Name</label>
	        <input id="webinar_title" type="text" name="candidate_name" class="form-control" value="'.$rows['c_name'].'" placeholder="Enter webinar tittle...">
	           <input id="webinar_title" type="hidden" name="candidate_id" class="form-control" value="'.$id.'" placeholder="Enter webinar tittle...">
     
   
   
        <label class="form-control-label" for="webinar_date">Surname</label>
        <input id="webinar_date" required type="date" name="candidate_surname" value="'.$rows['c_surname'].'" class="form-control" >
        <label class="form-control-label" for="webinar_date">Email</label>
        <input id="webinar_date" required type="date" name="candidate_surname" value="'.$rows['c_email'].'" class="form-control" >
        <label class="form-control-label" for="webinar_date">Reset Password</label>
        <select name="reset_pass">
        
        <input id="webinar_date" required type="date" name="candidate_surname" value="'.$rows['c_surname'].'" class="form-control" >
    ';
   }

?>