<?php
// Include necessary files and libraries
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
include "include/connect.php";

// Load PhpSpreadsheet library
require 'vendor/autoload.php';

// Create new PhpSpreadsheet object
$spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();

// Set document properties
$spreadsheet->getProperties()->setCreator("Creator")
                              ->setLastModifiedBy("Last Modified By")
                              ->setTitle("File List")
                              ->setSubject("File List")
                              ->setDescription("File List")
                              ->setKeywords("file list");

// Retrieve data for XLS generation
$directory = '../talent/cv';
$files = scandir($directory);

// Add worksheet
$worksheet = $spreadsheet->getActiveSheet();

// Set headers
$worksheet->setCellValue('A1', 'Talent Name')
          ->setCellValue('B1', 'Curriculum Vitae')
          ->setCellValue('C1', 'Video CV')
          ->setCellValue('D1', 'Added By');

// Loop through files and retrieve associated data
$row = 2; // Start from row 2 to skip headers
$query=$db->prepare("SELECT c.c_name,c.c_email,c.c_cellphone, cv.cv_file AS 'curriculumVitae' FROM candidate_tbl c INNER JOIN curriculum_vitae cv ON MD5(c.c_email) = cv.c_email inner join basket b on b.c_email = cv.c_email where b.receipt_id in ('vico-inv40','vico-inv41') "); 
 /*foreach ($files as $file) {  
 if ($file != "." && $file != "..") {               
    $query->execute();
    while ($data = $query->fetch()) {
    if($data['curriculumVitae']){
    echo $data['curriculumVitae'];
    $c_email = $data['c_email'];
    //$query1 = $db->prepare("UPDATE curriculum_vitae SET cv_file ='' where c_email = '$c_email'");
    //$query1->execute();
}
}
}
}*/
    while ($data = $query->fetch()) {
        echo $data['curriculumVitae'].' '.$file.'<br>';
        if($data['curriculumVitae'] == $file){   
        //echo $file."<br>";//.' '.$data['curriculumVitae']."<br>";
        $cv = "";       
        }
    }
?>
