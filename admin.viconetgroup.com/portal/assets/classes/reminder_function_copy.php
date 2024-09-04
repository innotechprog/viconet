<?php

function createRandomPassword() {
    $chars = "003232303232023232023456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    srand((double)microtime()*1000000);
    $i = 0;
    $pass = '' ;
    for($i; $i <= 30; $i++) {

      $num = rand() % 33;

      $tmp = substr($chars, $num, 1);

      $pass = $pass . $tmp;


    }
    return $pass;
  }
$pass = createRandomPassword();
class SendEmails
{ 
private $db;
private $username;
private $password;
private $host;
private $port;
function __construct($db)
{
	$this->db = $db;
	$this->username = "info@viconetgroup.com";
	$this->password = "_ENQDbaa0XMTXzL5d74U9OEGLPlIFBsa";
	$this->port = 587;
	$this->host = "mail.viconetgroup.com";
}
public function getUsername(){
	return $this->username;
}
public function getPassword(){
	return $this->password;
}
public function getHost(){
	return $this->host;
}
public function getPort(){
	return $this->port;
}
}

class webinars
{
private $db;
protected $webinar_date;
private $webinar_id;

function __construct($db)
{
	$this->db = $db;
}
function authorData($id)
{
	$query = $this->db->prepare("SELECT * FROM content WHERE webinar_id = '$id' ");
	$query->execute();

	return $query;
}
function webinarsData()
{
	$query = $this->db->prepare("SELECT * FROM webinars");
	$query->execute();

	return $query;
}
}

/**
* 
*/
class Candidates
{
private $db;
private $numCandi;
function __construct($db)
{
	$this->db = $db;

	//count candidates
	$query = $db->prepare("SELECT count(*) as num_candi from candidate_tbl");
	$query->execute();
	$row = $query->fetch();
	$this->numCandi = $row['num_candi'];
}
public function trackEmailSentout($email,$emailType){
	$c_email = $email;
    $email_type = $emailType;
    //$date = date('Y-m-d');
    $num_reminder = 1;
    $sqlQuery = $this->db->prepare("INSERT INTO `reminders_email_tracking`(`c_email`, `email_type`, `num_reminder`,`date_sent`) VALUES(?,?,?,?)");
    	$sqlQuery->execute(array($c_email,$email_type,$num_reminder));
    }
// count number of candidates per status
public function countNumCand($status){
	$query = $this->db->prepare("SELECT count(*) as num_candi from candidate_tbl where c_verified = ?");
	$query->execute(array($status));
	$row = $query->fetch();
	return $row['num_candi'];
}
// count number of candidates per added By
public function countNumCandPerAddedBy($status){
	$query = $this->db->prepare("SELECT count(*) as num_candi from candidate_tbl where added_by = ? and c_verified = 'verified'");
	$query->execute(array($status));
	$row = $query->fetch();
	return $row['num_candi'];
}

//get number of talent without CV
/*public function countTalentWithoutCV(){
	$query = $this->db->prepare("SELECT COUNT(DISTINCT c_email) AS total_count
FROM (
SELECT c.c_email
FROM candidate_tbl c 
INNER JOIN curriculum_vitae cv ON MD5(c.c_email) = cv.c_email 
WHERE cv.cv_file = '' AND c.added_by != 'import'

UNION

SELECT c_email 
FROM candidate_tbl 
WHERE c_verified = 'pending' AND added_by != 'import'

UNION

SELECT c_email 
FROM candidate_tbl 
WHERE c_verified = 'process' AND added_by != 'import'

UNION


SELECT c_email 
FROM candidate_tbl 
WHERE c_verified = 'google-process' AND added_by != 'import'
) AS total_count;
");
	$query->execute();
	$row = $query->fetch();
	return $row['total_count'];
}*/
public function countTalentWithoutCV(){
	$query = $this->db->prepare("SELECT count(c.c_email) as total_count FROM `candidate_tbl` c 
INNER JOIN curriculum_vitae cv on md5(c.c_email) = cv.c_email
WHERE (cv.cv_file = '' OR cv.cv_file is null)");
$query->execute();
$row = $query->fetch();
return $row['total_count'];
}
public function countTalentWithoutCVNI(){
	$query = $this->db->prepare("SELECT COUNT(c.c_email) AS total_count
FROM candidate_tbl c
INNER JOIN curriculum_vitae cv ON MD5(c.c_email) = cv.c_email
WHERE (cv.cv_file = '' OR cv.cv_file IS NULL)
 AND c.added_by != 'import'");
$query->execute();
$row = $query->fetch();
return $row['total_count'];
}

//Get emails or email sent date
public function getEmailSentDate($email,$emailType){

$query = $this->db->prepare("
    SELECT GROUP_CONCAT(date_sent SEPARATOR ', ') AS dates
    FROM email_sentout
    WHERE c_email = ? AND email_type = ?
");
$query->execute(array($email, $emailType));
$result = $query->fetch(); // Fetch the result as an associative array

if ($result && !empty($result['dates'])) {
    return $result['dates'];
} else {
    return "No dates found";
}

}
public function countTalentWithCV()
{
	$query = $this->db->prepare("SELECT COUNT(c.c_email) as total_count
 FROM candidate_tbl c 
 inner JOIN curriculum_vitae cv ON MD5(c.c_email) = cv.c_email 
 WHERE COALESCE(cv.cv_file, '') != '' ");
	$query->execute();
	$row = $query->fetch();
	return $row['total_count'];
} 
public function countTalentWithCVNI()
{
	$query = $this->db->prepare("SELECT COUNT(*) as total_count
 FROM candidate_tbl c 
 inner JOIN curriculum_vitae cv ON md5(c.c_email) = cv.c_email 
 WHERE COALESCE(cv.cv_file, '') != '' AND c.added_by != 'Import'");
	$query->execute();
	$row = $query->fetch();
	return $row['total_count'];
} 
//get number of talent who uploaded their cv after receiving a reminder
public function numTalUploadedCVafterRem(){
	$query = $this->db->prepare("SELECT count(*) as total_count FROM `candidate_tbl` c
inner join curriculum_vitae cv on md5(c.c_email) = cv.c_email  where cv.cv_file != '' and c.num_reminder != 0 ");
	$query->execute();
	$row = $query->fetch();
	return $row['total_count'];
}

//Show talent who uploaded cv after reminder
public function talUploadedCVafterRem($emailNum, $type, $fromDate, $toDate){
	$emailType = 'CV upload reminder';
	/*$query = $this->db->prepare("SELECT c.c_name,c.c_surname,c.c_email, c.c_DOB, c.c_cellphone FROM `candidate_tbl` c
inner join curriculum_vitae cv on md5(c.c_email) = cv.c_email  where cv.cv_file != '' and c.num_reminder = ?");
	$query->execute(array($num_reminder));*/

	$sql = "
        SELECT c.c_name,c.c_surname,c.c_email, c.c_DOB, c.c_cellphone
        FROM candidate_tbl c
        INNER JOIN curriculum_vitae cv ON MD5(c.c_email) = cv.c_email
        INNER JOIN email_sentout es ON c.c_email = es.c_email
        WHERE es.email_type = '$emailType'
    ";

    // Condition based on $emailNum
    if ($type === 'uploaded') {
        $sql .= "AND COALESCE(cv.cv_file, '') != ''";
    } elseif($type === 'notuploaded') {
        $sql .= " AND cv.cv_file ='' OR cv.cv_file is null";
    }
    else{
    	$sql .= " AND (cv.cv_file ='' OR cv.cv_file is null) OR COALESCE(cv.cv_file, '') != ''";
    }

    if ($emailNum !== 0 ) {
        $sql .= " AND c.num_reminder = :emailNum";
    } 

    // Add date range condition if both dates are provided
    if (!empty($fromDate) && !empty($toDate)) {
        $sql .= " AND es.date_sent BETWEEN :fromDate AND :toDate";
    }

   // $sql .= " GROUP BY c.num_reminder";

    // Prepare the SQL query
    $stmt = $this->db->prepare($sql);

    // Bind parameters
    if ($emailNum !== '0') {
        $stmt->bindParam(':emailNum', $emailNum);
    }
    if (!empty($fromDate) && !empty($toDate)) {
        $stmt->bindParam(':fromDate', $fromDate);
        $stmt->bindParam(':toDate', $toDate);
    }

    // Execute the prepared statement
    $stmt->execute();

    // Fetch all results as associative array
    //$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $stmt;


}
//Show talent who uploaded cv after reminder
public function groupTalUploadedCVafterRem(){
	$query = $this->db->prepare("SELECT c.num_reminder , count(c.num_reminder) as num_reminds FROM `candidate_tbl` c
inner join curriculum_vitae cv on md5(c.c_email) = cv.c_email  where cv.cv_file != '' and c.num_reminder != 0 GROUP BY c.num_reminder;");
	$query->execute();
	return $query;
}
public function getFilteredReminderData($emailNum,$fromDate,$toDate){
		$emailType = 'CV upload reminder';
	/* if (!$this->validateDates($fromDate, $toDate)) {
            return 'Invalid date range';
        }*/
$sql = "
        SELECT c.num_reminder, COUNT(c.num_reminder) AS num_reminds
        FROM candidate_tbl c
        INNER JOIN curriculum_vitae cv ON MD5(c.c_email) = cv.c_email
        INNER JOIN reminders_email_tracking es ON c.c_email = es.c_email
        WHERE es.email_type = '$emailType'
    ";

    // Condition based on $emailNum
    if ($emailNum === 'all') {
        $sql .= " AND c.num_reminder != 0";
    } else {
        $sql .= " AND c.num_reminder = :emailNum";
    }

    // Add date range condition if both dates are provided
    if (!empty($fromDate) && !empty($toDate)) {
        $sql .= " AND es.date_sent BETWEEN :fromDate AND :toDate";
    }

    $sql .= " GROUP BY c.num_reminder";

    // Prepare the SQL query
    $stmt = $this->db->prepare($sql);

    // Bind parameters
    if ($emailNum !== 'all') {
        $stmt->bindParam(':emailNum', $emailNum);
    }
    if (!empty($fromDate) && !empty($toDate)) {
        $stmt->bindParam(':fromDate', $fromDate);
        $stmt->bindParam(':toDate', $toDate);
    }

    // Execute the prepared statement
    $stmt->execute();

    // Fetch all results as associative array
    //$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $stmt;

}
public function countFilteredReminderData($emailNum,$fromDate,$toDate){
		$emailType = 'CV upload reminder';
	/* if (!$this->validateDates($fromDate, $toDate)) {
            return 'Invalid date range';
        }*/
$sql = "
        SELECT * FROM candidate_tbl c
        INNER JOIN curriculum_vitae cv ON md5(c.c_email) = cv.c_email
        INNER JOIN reminders_email_tracking es ON c.c_email = es.c_email
        WHERE es.email_type = :emailType
    ";

    // Condition based on $emailNum
    if ($emailNum){
        $sql .= " AND c.num_reminder = :emailNum";
    }

    // Add date range condition if both dates are provided
    if (!empty($fromDate) && !empty($toDate)) {
        $sql .= " AND es.date_sent BETWEEN :fromDate AND :toDate";
    }

    // Prepare the SQL query
    $stmt = $this->db->prepare($sql);

    // Bind parameters
    if ($emailNum) {
        $stmt->bindParam(':emailNum', $emailNum);
    }
    if (!empty($fromDate) && !empty($toDate)) {
        $stmt->bindParam(':fromDate', $fromDate);
        $stmt->bindParam(':toDate', $toDate);
    }
    $stmt->bindParam(':emailType', $emailType);

    // Execute the prepared statement
    $stmt->execute();

    // Fetch all results as associative array
    $result = $stmt->fetchAll();

    return count($result);

}

public function getNotUploaded($emailNum){
	$emailType = 'CV upload reminder';
	$query = $this->db->prepare("SELECT * FROM `candidate_tbl` c
	inner join curriculum_vitae cv on md5(c.c_email) = cv.c_email
	inner join reminders_email_tracking es ON es.c_email = c.c_email
	where (cv.cv_file = '' OR cv.cv_file is null)  and c.num_reminder = ? and email_type = ?");
	$query->execute(array($emailNum,$emailType));
	$result = $query->fetchAll();

	return count($result);
}
public function getUploaded($emailNum){
	$emailType = 'CV upload reminder';
	$query = $this->db->prepare("SELECT * FROM `candidate_tbl` c
	inner join curriculum_vitae cv on md5(c.c_email) = cv.c_email
	inner join reminders_email_tracking es ON es.c_email = c.c_email
	where COALESCE(cv.cv_file, '') != ''  and c.num_reminder = ? and email_type = ?");
	$query->execute(array($emailNum,$emailType));
	$result = $query->fetchAll();

	return count($result);
}
//Get Reminders title
public function getRemindersTitle($type){
	$title = "";
	if($type == 'uploaded'){
		$title = "TALENT UPLOADED CV AFTER REMINDER FOR EMAIL NO: ";
	}
	elseif($type == 'notuploaded'){
		$title = "TALENT NOT UPLOADED CV AFTER REMINDER FOR EMAIL NO: ";
	}
	elseif($type == 'all'){
		$title = "ALL TALENT RECEIVED REMINDER FOR EMAIL NO: ";
	}
	return $title;

}
//Get total number of sent email reminders
public function totalEmailRemindersSent($emailNum){
	$query = $this->db->prepare("SELECT * FROM `candidate_tbl` c
 	where num_reminder = ?");
	$query->execute(array($emailNum));
	$result = $query->fetchAll();
	return count($result);
}

//count number of active candidates that were imported
public function countNumActiveCandPerAddedBy($status){
	$query = $this->db->prepare("SELECT count(*) as num_candi from candidate_tbl where added_by = ? and c_verified = 'verified' and t_and_c !='' and popia_consent != ''");
	$query->execute(array($status));
	$row = $query->fetch();
	return $row['num_candi'];
}
//count number of Pending candidates that were imported
public function countNumPendingCandPerAddedBy($status){
	$query = $this->db->prepare("SELECT count(*) as num_candi from candidate_tbl where added_by = ? and c_verified = 'verified' and t_and_c ='' and popia_consent = ''");
	$query->execute(array($status));
	$row = $query->fetch();
	return $row['num_candi'];
}
public function candidateData()
{
	$query = $this->db->prepare("SELECT * FROM candidate_tbl");
	$query->execute();

	return $query;
}
public function candidateDataByAddedBy($addedBy)
{
	$query = $this->db->prepare("SELECT * FROM candidate_tbl where added_by= ? and popia_consent ='' and t_and_c =''");
	$query->execute(array($addedBy));

	return $query;
}
//Decider which candidate to show
public function candidatePageControl(){
$query="";
if (isset($_GET['type'])) {
  if ($_GET['type'] == $imported) {
     $query = $this->candidateDataByAddedBy('Import');
  }
}
elseif(isset($_GET['st'])){
	$status = $_GET['st'];
	 $query = $this->candidateDataByStatus($status);
} 
else {
  $query = $this->candidateData();
}
return $query;
}
//get talent by status
public function candidateDataByStatus($status)
{
	$query = $this->db->prepare("SELECT * FROM candidate_tbl where md5(c_verified) = ?");
	$query->execute(array($status));

	return $query;
}

//Increment number of reminder 
public function incrementNumRem($email){
	$query = $this->db->prepare("UPDATE candidate_tbl SET num_reminder = (num_reminder + 1) where c_email = ?");
	$query->execute(array($email));
}
public function getCandCv($email){

}
public function getNumReminder($email){
	$query = $this->db->prepare("SELECT num_reminder FROM candidate_tbl where md5($c_email) = ?");
	$query->execute(array($email));
	$row = $query->fetch();

	return $row['num_reminder'];
}
	

function getNumCandi(){
	return $this->numCandi;
}
}
/**
* 
*/
class Staff
{
private $db;
private $id;
protected $surname;
protected $name;
protected $email;
protected $cellNo;
protected $pos;
private $numStaff;
protected $profilePic;

function __construct($db)
{
	$this->db = $db;

	//count staff
	$query = $db->prepare("SELECT count(*) as num_staff from staff");
	$query->execute();
	$row = $query->fetch();
	$this->numStaff = $row['num_staff'];
}
function setStaffData($email)
{
	$query = $this->db->prepare("SELECT * FROM staff WHERE md5(s_email) = '$email'");
	$query->execute();
	for($i = 0; $row = $query->fetch();$i++){
	$this->surname = $row['s_last_name'];
	$this->name = $row['s_first_name'];
	$this->email=$row['s_email'];
	$this->cellNo = $row['s_cell_number'];
	$this->id = $row['s_id'];
	$this->pos = $row['s_position'];
	$this->profilePic = $row['profile_pic'];

	}
}
function getStaffData(){
	$query = $this->db->prepare("SELECT * FROM staff");
	$query->execute();

	return $query;
}
function getSurname(){
	return $this->surname;
}
function getName(){
	return $this->name;
}
function getEmail(){
	return $this->email;
}
function getCell(){
	return $this->cellNo;
}
function getID(){
	return $this->id;
}
function getPos(){
	return $this->pos;
}
function getNumStaff(){
	return $this->numStaff;
}
public function getPP(){
	return $this->profilePic;
}
}
class LandingPage
{
private $db;
private $title;
private $landingPic;
private $landingContent;
function __construct($db)
{
	$this->db = $db;

	//Get data from database and assign it to variables
	$query = $this->db->prepare("SELECT * FROM landing_page WHERE id = 1");
	$query->execute();
	
	while ($row = $query->fetch()) {
		$this->title = $row['l_title'];
		$this->landingContent = $row['l_content'];
		$this->landingPic = $row['l_image'];
	}

}

function getTitle(){
	return $this->title;
}
function getImg(){
	return $this->landingPic;
} 
function getContent()
{
	return $this->landingContent;
}
}

/**
* 
*/
class Insight
{
private $db;
private $title;
private $author;
private $content;
private $date;
private $picture;
function __construct($db)
{
	$this->db = $db;
}
public function getInsights(){
	$query = $this->db->prepare("SELECT * FROM insight");
	$query->execute();
	return $query;
}
public function setInsight($id)
{
	$query = $this->db->prepare("SELECT * FROM insight where md5(id) ='$id'");
	$query->execute();
	$row = $query->fetch();
	$this->title = $row['insight_title'];
	$this->author = $row['insight_author'];
	$this->content = $row['insight_content'];
	$this->date = $row['insight_date'];
	$this->picture = $row['insight_img'];
}
public function getTitle()
{
	return $this->title;
}
public function getAuthor()
{
	return $this->author;
}
public function getContent(){
	return $this->content;
}
public function getDate(){
	return $this->date;
}
public function getImage(){
	return $this->picture;
}

}
/**
* 
*/ 
class Corporates
{

private $db;
function __construct($db)
{
	$this->db = $db;	
}
public function getCorporates(){
	$query = $this->db->prepare("SELECT * FROM corporate");
	$query->execute();
	return $query;
}
public function getCorporateUser($compEmail){
	$query = $this->db->prepare("SELECT * FROM users WHERE company_email = '$compEmail' and added_by='System'");
	$query->execute();
	return $query;
}
public function updateCorporates($status,$email){
	$query = $this->db->prepare("UPDATE corporate SET status='$status' WHERE company_email='$email' ");
	$query->execute();
	return $query;
}
public function updateUser($pass,$email){
	$query = $this->db->prepare("UPDATE users SET password='$pass' WHERE user_email='$email' ");
	$query->execute();
	return $query;
}
public function getNumCorporates(){
	$query = $this->db->prepare("SELECT count(company_email) as num_rows FROM corporate");
	$query->execute();
	$row = $query->fetch();
	return $row['num_rows'];
}
}
class Packages{
private $db;
function __construct($db)
{
	$this->db = $db;	
}
public function getAllPackages(){
	$query = $this->db->prepare("SELECT * FROM packages");
	$query->execute();
	return $query;
}
//Create package_id
private function createPackageId()
{
	$i = 0;
	$x = 1;
	for($i ;$i != $x ; $i++)
	{
	$query = $this->db->prepare("SELECT *, count(package_id) as num_rows FROM packages");
	$query->execute();
	$row = $query->fetch();
	$num_rows = $row['num_rows'];
	//if($pack_id )
	$pack_id = 'vicopac'.$num_rows+$x;
	$query = $this->db->prepare("SELECT count(package_id) as num_rows FROM packages WHERE package_id = '$pack_id'");
	$query->execute();
	$row_ = $query->fetch();
	$num_rows_ = $row_['num_rows'];
	if($num_rows_ > 0){
		$x += 1;
	}
	else{
		return $pack_id;
		//$i += 1;
	}
}
}
//Add package to database
	public function addPackages($package_name_,$package_desc_,$num_users_,$package_duration_,$package_price_)
{
	$package_id = $this->createPackageId();
	$query = $this->db->prepare("INSERT INTO `packages`(`package_id`, `package_name`, `package_desc`, `num_users`, `package_duration`, `package_price`) VALUES (?,?,?,?,?,?)");
	$query->execute(array($package_id,$package_name_,$package_desc_,$num_users_,$package_duration_,$package_price_));
}
public function editPackage($package_id_,$package_name_,$package_desc_,$num_users_,$package_duration_,$package_price_)
{
	$query = $this->db->prepare("UPDATE `packages` SET `package_name`=?,`package_desc`=?,`num_users`=?,`package_duration`=?,`package_price`=? WHERE `package_id`=? ");
	$query->execute(array($package_name_,$package_desc_,$num_users_,$package_duration_,$package_price_,$package_id_));

}
}
?>