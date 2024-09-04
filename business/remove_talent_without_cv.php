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
                              ->setTitle("Workplace Experience for University Students

")
                              ->setSubject("File List")
                              ->setDescription("File List")
                              ->setKeywords("file list");

// Retrieve data for XLS generation
//$directory = '../talent/cv';
//$files = scandir($directory);

// Add worksheet
$worksheet = $spreadsheet->getActiveSheet();

// Set headers
$worksheet->setCellValue('A1', 'Talent Name')
          ->setCellValue('B1', 'Curriculum Vitae')
          ->setCellValue('C1', 'Video CV')
          ->setCellValue('D1', 'Added By');

// Loop through files and retrieve associated data
$row = 2; // Start from row 2 to skip headers
$query=$db->prepare("SELECT *, cv.cv_file AS 'curriculumVitae', cv.video_cv AS 'vcv' FROM candidate_tbl c INNER JOIN curriculum_vitae cv ON MD5(c.c_email) = cv.c_email right join basket b on b.c_email = md5(c.c_email) where b.receipt_id in ('vico-inv36') order by c.c_email"); 
$query->execute();
while ($data = $query->fetch()) {
    $cv = "";
        //foreach ($files as $file) {  
            if(!empty($data['curriculumVitae'])){
                $cv = "Uploaded";
            }
            else{
                $cv = "Not uploaded";
            }
        //}
    $vcv = "";
    //foreach ($files as $file) {  
            if(!empty($data['vcv'])){
                $vcv = "Uploaded";
            }
            else{
                $vcv = "Not uploaded";
            }
        //}
    // Write data to worksheet
    $worksheet->setCellValue('A'.$row, $data['c_surname'].' '.$data['c_name'])
              ->setCellValue('B'.$row, $cv)
              ->setCellValue('C'.$row, $vcv)
              ->setCellValue('D'.$row, $data['added_by']);
    $row++;
}

// Auto-size columns
foreach(range('A', 'D') as $column) {
    $worksheet->getColumnDimension($column)->setAutoSize(true);
}

// Rename worksheet
$worksheet->setTitle('Report');

// Redirect output to a client's web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="file_list.xls"');
header('Cache-Control: max-age=0');

$writer = new PhpOffice\PhpSpreadsheet\Writer\Xls($spreadsheet);
$writer->save('php://output');
?>
