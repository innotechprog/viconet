<?php
include "include/connect.php";
include "include/functions.php";

$query = $db->prepare("SELECT c.c_name as name, c.c_email as email, cv.cv_file as cv FROM candidate_tbl c INNER JOIN curriculum_vitae cv on md5(c.c_email) = cv.c_email WHERE cv.cv_file != '' ");
$query->execute();
while($rows = $query->fetch()){
// Fetch the file name from the database
$cv_name = $rows['cv'];
$email = md5($rows['email']);
// Define the path to the folder where files are stored
$folder_path = 'cv/';

// Check if the file exists
if (file_exists($folder_path . $cv_name)) {
    echo "The file ". $cv_name ."exists in the folder. for ". $rows['name']."<br>";
} else {
    echo "The file $cv_name does not exist in the folder. for ". $rows['name']."<br>";
    $query1 = $db->prepare("UPDATE curriculum_vitae SET cv_file = '' WHERE c_email = ?");
    $query1->execute(array($email));
}
}
?>