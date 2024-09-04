<?php
require('assets/excelReader/php-excel-reader/excel_reader2.php');
require('assets/excelReader/SpreadsheetReader.php');
include "../include/connect.php";
include "../include/functions.php";
$candidate = new Candidates($db);

$experience = "";
if(isset($_POST['import'])){

  $allow = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.oasis.opendocument.spreadsheet','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
  echo $_FILES["file"]["type"];
  if(in_array($_FILES["file"]["type"],$allow)){
    $uploadFilePath = 'assets/excelReader/uploads/'.basename($_FILES['file']['name']);
    move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath);

    $Reader = new SpreadsheetReader($uploadFilePath);
    error_reporting(0);
    ini_set('display_errors',0);
    $totalSheet = count($Reader->sheets());
    /* For Loop for all sheets */
    $countt = 0;
   
    for($i=0;$i<$totalSheet;$i++){      
      $Reader->ChangeSheet($i);
      //echo $Reader[$i][0];
      foreach ($Reader as $Row)
      {
        $name = isset($Row[0]) ? $Row[0] : '';
        $surname = isset($Row[1]) ? $Row[1] : '';
        $status = isset($Row[2]) ? $Row[2] : '';
        //Current job
        $currJobTitle = isset($Row[3]) ? $Row[3] : '';
        $currJobDesc = isset($Row[12]) ? $Row[12] : '';
        $currSalary = isset($Row[4]) ? $Row[4] : '';
        $currCompanyName = isset($Row[5]) ? $Row[5] : '';
        $currJobIndustry = isset($Row[6]) ? $Row[6] : '';
        $currYearStarted ='N/A';
        $experience = isset($Row[8]) ? $Row[8] : '';
        if($experience > 5 && $experience < 11)
        {
            $experience = '6 - 10';
        }
         else if($experience > 10 && $experience < 16)
        {
            $experience = '11 - 15';
        }
         else if($experience > 15)
        {
            $experience = '16 years + ';
        }
        else{
            $experience = '0 - 5';
        }
        //Address
        $location = isset($Row[7]) ? $Row[7] : '';
        $city ="";
        $state="0";
        $country="204";
        $zip_code="";

        //Previous job
        $prevJobTitle = isset($Row[9]) ? $Row[9] : '';
        $prevCompanyName = isset($Row[10]) ? $Row[10] : '';
        $prevJobIndustry = isset($Row[11]) ? $Row[11] : '';
        //Job Description / roles
        //$roles =isset($Row[12]) ? $Row[12] : '';
        //Skills
        $skills =isset($Row[13]) ? $Row[13] : '';
        $highestQualification = isset($Row[14]) ? $Row[14] : '';
        $fieldOfStudy = isset($Row[15]) ? $Row[15] : '';
        $graduationYear = isset($Row[16]) ? $Row[16] : '';
        $educationLevel = isset($Row[17]) ? $Row[17] : '';
        $institution = isset($Row[18]) ? $Row[18] : '';
        $race = isset($Row[19]) ? $Row[19] : '';
        $gender = isset($Row[20]) ? $Row[20] : '';
        $userCell = (isset($Row[24]) ? $Row[24] : '');
        $candEmail = (isset($Row[25]) ? $Row[25] : '');
        $encryEmail = md5($candEmail);
        $status1 = "verified";
        $password = createRandomPassword();
        $encryPas = md5($password);
        $date_registered = date("Y-m-d");
        $DOB = "";
        $jobStatus1 ="current";
        $jobStatus2 ="post";
        $end_date ="";
        $prevYearStarted = ""; 
        $addedBy = "Import";
        //echo 'innocent'.$candEmail;
        //Insert into database
        if(!$candidate->  checkEmailExist($candEmail)){
        $candidate->addCandidate2($name,$surname,$candEmail,$userCell,$DOB,$race,$gender,$encryPas,$status1,$date_registered,$addedBy);
        $candidate->addEncryPass($candEmail,$pass);
        $candidate->addCandidateRole($encryEmail,$currCompanyName,$currJobTitle,$currYearStarted,$end_date,$jobStatus1);
        $cvName = "";//ucfirst($name).ucfirst($surname).'CV.pdf';
        $candidate->addCVData($encryEmail,$experience,$cvName);
        $candidate->addCandidateRole($encryEmail,$prevCompanyName,$prevJobTitle,$prevYearStarted,$end_date,$jobStatus2);
        $skillsArr = explode(',', $skills);
        foreach($skillsArr as $skill){
            $candidate->addSkills($encryEmail,$skill);
        }
        //$candidate->addKeyRole($encryEmail,$currJobDesc);
        $candidate->addMultQualifications($encryEmail,$institution,$highestQualification,$graduationYear,$fieldOfStudy);
        $candidate->addAddress_($encryEmail,$location,$city,$state,$country,$zip_code);
        $rolesArr = explode(',', $currJobDesc); 
        foreach($rolesArr as $role){
            $candidate->addKeyRole($encryEmail,$role);
        }
      }
       // $query = "insert into items(title,description) values('".$title."','".$description."')";


        //$mysqli->query($query);
        $countt++;
        echo $countt.'innocent';
       }


    }
?>
<script type="text/javascript">window.location = "candidates"</script>
<?php
  }else { 
    die("<br/>Sorry, File type is not allowed. Only Excel file."); 
  }


}
