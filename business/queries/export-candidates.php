<?php
// Include the PhpSpreadsheet classes
include "include/jobs_class.php";
require 'vendor/autoload.php';
$jobs = new Jobs($db);
// Create a new PhpSpreadsheet spreadsheet object
$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

// Create a worksheet
$worksheet = $spreadsheet->getActiveSheet();

// Add data to the worksheet
$worksheet->setCellValue('A1', 'Name');
$worksheet->setCellValue('B1', 'Surname');
$worksheet->setCellValue('C1', 'Qualification');
$query = $jobs->getApplicantsBy();
for($i = 2; $rows = $query->fetch(); $i++){
$worksheet->setCellValue('A'.$i, $rows['name']);
$worksheet->setCellValue('B'.$i, $rows['surname']);
$worksheet->setCellValue('C'.$i, $rows['qualification']);	
}


// Set headers for download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="example.xlsx"');
header('Cache-Control: max-age=0');

// Create an Xlsx writer and save the spreadsheet to php://output
$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
exit;
