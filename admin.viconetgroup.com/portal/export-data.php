<?php
ob_start(); // Start output buffering
session_start();
$_SESSION['adid'] = md5('admin');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include '../include/connect.php';
include 'assets/classes/auth.php';
include 'assets/classes/functions.php';

$webinar = new webinars($db);
$candidate = new Candidates($db);
$staff = new Staff($db);
$staff->setStaffData($_SESSION['staff_id']);
$landing = new LandingPage($db);

$uploadedCV = md5("uploadedCV");
if (isset($_GET['id2'])) {
    $numRemindId = $_GET['id2'];
}
$talentUploaded = md5("talentUploaded");
$allTalent = md5("allTalent");

$data = []; // Initialize the data array with headers
if (isset($_GET['id'])) {
    if ($_GET['id'] == $uploadedCV) {
        $emailNum = $_GET['em'];
        $fromDate = $_GET['sd'];
        $toDate = $_GET['ed'];
        $data = [
            ['Email Number', 'Number of talent uploaded', 'Number of talent not uploaded', 'Total talent received email reminders']
        ];
        try {
            $query = $candidate->getFilteredReminderData($emailNum, $fromDate, $toDate);
            while ($row = $query->fetch()) {
                $data[] = ['Email no '.$row['num_reminder'],$candidate->getUploaded($row['num_reminder']), $candidate->getNotUploaded($row['num_reminder']), $candidate->countFilteredReminderData($row['num_reminder'], $fromDate, $toDate)];
            }
        } catch (Exception $e) {
            echo 'Error fetching data: ' . $e->getMessage();
            exit;
        }
    } else if ($_GET['id'] == $talentUploaded) {
         $numRemindId = "";
   $fromDate = "";
   $toDate = "";
   $type = "";
   if(isset($_GET['id2'])){
    $numRemindId = $_GET['id2'];
   }
   if(isset($_GET['sd'])){
      $fromDate = $_GET['sd'];
   }
   if(isset($_GET['ed'])){
      $toDate = $_GET['ed'];
   }
   if(isset($_GET['ty'])){
      $type = $_GET['ty'];
   }
        $data = [
            ['Names', 'Email', 'Cell Number', 'Date Of Birth', 'Date Email Received']
        ];
        try {
            $query = $candidate->talUploadedCVafterRem($numRemindId, $type, $fromDate, $toDate);
            while ($row = $query->fetch()) {
                $data[] = [$row['c_name'] . ' ' . $row['c_surname'], $row['c_email'], $row['c_cellphone'], $row['c_DOB'], $row['date_sent']];
            }
        } catch (Exception $e) {
            echo 'Error fetching data: ' . $e->getMessage();
            exit;
        }
    } else if ($_GET['id'] == $allTalent) {
        $data = [
            ['Name', 'Last Name', 'Email', 'Cell Number', 'Date Of Birth','Race','Gender', 'Date Registered','Status','Added by','Years of Experience','Work Method','CV Uploaded','Address','City','State','Country','Current Job Title','Current Company Name','Current Job Description','Previous Job Title','Previous Company','Technical Skills','Highest Qualification','Field of Study','Year of Graduation','Tertiary Institution Attended']
        ];
        try {
            $query = $candidate->candidateAllData();
            while ($row = $query->fetch()) {
                $currJobDesc = "";
                $getCurCompName ="";
                //$candidate->setCandidate(md5($row['email']));
                $candidate->getAddressBy(md5($row['email']));
                $candidate->getCurrentJob(md5($row['email']));
                $candidate->getLatestPreviousJob(md5($row['email']));
                $getCurCompName =
                $currJobDesc = $candidate->getCurrentJobRoles(md5($row['email']));
                $candidate->getLatestQualification(md5($row['email']));
                //$candidate->getCurrentJob();
                $data[] = [$row['c_name'],$row['c_surname'], $row['email'], $row['c_cellphone'], $row['c_DOB'],$row['race'],$row['gender'], $row['date_registered'],$row['c_verified'],$row['added_by'],$row['years_experience'], $row['work_method'],$row['cv_file'], $candidate->getAddress(), $candidate->getCity(), $candidate->getState(), $candidate->getCountry(),$candidate->getCurJobTitle(),$candidate->getCurCompName(),$currJobDesc,$candidate->getPrevJobTitle(),$candidate->getPrevCompName(), $candidate->getSkills(md5($row['email'])),$candidate->getQualificationName(), $candidate->getFieldOfStudy(), $candidate->getYearCompleted(), $candidate->getInstitution()];
            }
        } catch (Exception $e) {
            echo 'Error fetching data: ' . $e->getMessage();
            exit;
        }
    }
}

// Create a new spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Populate the spreadsheet with data
$rowNumber = 1;
foreach ($data as $row) {
    $colNumber = 'A';
    foreach ($row as $cellValue) {
        $sheet->setCellValue($colNumber . $rowNumber, $cellValue);
        $colNumber++;
    }
    $rowNumber++;
}

// Set the headers to force download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="data.xlsx"');
header('Cache-Control: max-age=0');
ob_end_clean();
ob_end_flush(); // End output buffering and flush the output
// Write the spreadsheet to the output buffer
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');


exit;
?>
