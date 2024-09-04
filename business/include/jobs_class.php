<?php
/**
 * 
 */
class Jobs
{
	private $db;
	//Job information
	private $compReg;
	private $compID;
	private $jobId;
	private $jobIntro;
	private $jobTitle;
	private $jobDesc;
	private $reportTo;
	private $minSalary;
	private $maxSalary;
	private $salary;
	private $currency;
	private $salInterval;
	private $postType;
	private $positionLevel;
	private $workMethod;
	private $jobStatus;
	private $unsuccessfulPeriod;
	private $quali;
	private $jobExperience;
	private $startDate;
	private $appLink;
	private $jobActiveDate;
	private $jobCloseDate;

	//Company
	private $compId;
	private $compName;
	private $compEmail;
	private $compTel;
	private $compLogo;
	private $compLocation;
	private $compIndustry;
	private $dateAdded;
	private $addedBy;
	private $compStatus;

	//Job Applications
	private $candId;
	private $dateApplied;
	private $applicationStatus;

	//Currency
	private $currencyName;
	private $currencyCode;
	private $currencySymbol;


	function __construct($db)
	{
		$this->db = $db;
	}
	public function getCompanyNextID(){
		$query = $this->db->prepare("SELECT (count(id) + 1) as nextVal from jobs_companies");
		$query->execute();
		$row = $query->fetch();
		return $row['nextVal'];
	}
	public function addJob($jobId,$compReg,$compId,$jobIntro,$jobTitle,$jobDesc,$reportTo,$minSalary,$maxSalary,$salary,$currency,$salInterval,$postType,$workMethods,$startDate,$appLink,$quali,$exp,$posLevel,$jobStatus,$unsuccessfulPeriod,$datePosted,$closingDate)
	{
		$compReg=md5($compReg);
		$query=$this->db->prepare("INSERT INTO `jobs`(`job_id`, `company_reg`,`company_id`, `job_intro`, `job_title`, `job_desc`,`reporting_to`, `min_salary`,`max_salary`,`job_salary`,`currency`,`sal_interval`, `post_type`, `work_method`, `start_date`, `application_link`, `qualification`,`experience`, `position_level`, `status`,`unsuccessful_period`, `date_posted`,`closing_date`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$query->execute(array($jobId,$compReg,$compId,$jobIntro,$jobTitle,$jobDesc,$reportTo,$minSalary,$maxSalary,$salary,$currency,$salInterval,$postType,$workMethods,$startDate,$appLink,$quali,$exp,$posLevel,$jobStatus,$unsuccessfulPeriod,$datePosted,$closingDate));
	}
	public function updateJob($jobId,$compReg,$compId,$jobIntro,$jobTitle,$jobDesc,$reportTo,$minSalary,$maxSalary,$salary,$currency,$salInterval,$postType,$workMethods,$startDate,$appLink,$quali,$exp,$posLevel,$jobStatus,$unsuccessfulPeriod,$datePosted,$closingDate){
		$query = $this->db->prepare("UPDATE `jobs` SET `job_intro`=?,`job_title`=?,`job_desc`=?,`reporting_to`=?,`min_salary`=?,`max_salary`=?,`job_salary`=?,`currency`=?,`sal_interval`=?,`post_type`=?,`work_method`=?,`start_date`=?,`application_link`=?,`qualification`=?, `experience`=?,`position_level`=?,`num_pos`=?,`status`=?,`unsuccessful_period`=?, `date_posted`=?,`closing_date`=? WHERE job_id = ?");
		$query->execute(array($jobIntro,$jobTitle,$jobDesc,$reportTo,$minSalary,$maxSalary,$salary,$currency,$salInterval,$postType,$workMethods,$startDate,$appLink,$quali, $exp,$posLevel,'0',$jobStatus,$unsuccessfulPeriod,$datePosted,$closingDate,$jobId));
	}
	public function addCompanyForJobs($id,$compName, $compEmail,$compTel,$compLocation,$industry,$logo, $addedBy){
		$date = new DateTime('now');
		$dateAdded = $date->format('Y-m-d');
		$status = "Active";
		$query = $this->db->prepare("INSERT INTO `jobs_companies`(`id`,`company_name`, `company_email`, `company_cellphone`, `company_location`,`company_industry`,`company_logo`,`date_added`, `added_by`,`status`) VALUES(?,?,?,?,?,?,?,?,?,?)");
		$query->execute(array($id,$compName,$compEmail,$compTel,$compLocation,$industry,$logo,$dateAdded,$addedBy,$status));
	}
	public function updateCompanyForJobs($jobId,$compName, $compEmail,$compTel,$compLocation,$industry,$logo){
		$query = $this->db->prepare("UPDATE `jobs_companies` SET `company_name`=?,`company_email`=?,`company_cellphone`=?,`company_location`=?,`company_industry`=?,`company_logo`=? WHERE id = (select company_id from jobs where job_id = ?)");
		$query->execute(array($compName, $compEmail,$compTel,$compLocation,$industry,$logo,$jobId));
	}
	public function getCompJobs($email){
		$compReg = md5($email);
		$query = $this->db->prepare("SELECT * FROM jobs WHERE company_reg = ?");
		$query->execute(array($compReg));
		return $query;
	}
	public function getAllJobs(){
		$query = $this->db->prepare("SELECT * FROM jobs");
		$query->execute();
		return $query;
	}
	public function getJobsBySearch($search,$category){
		$date = new DateTime('now');
		$todayDate = $date->format('Y-m-d');

		if($category!="all" && !empty($search))
		{
		$query = $this->db->prepare("SELECT * FROM jobs where status='published' and job_title like '%$search%' and company_id in (select id from jobs_companies where company_industry = ?) and closing_date <= $todayDate order by date_posted desc");
		$query->execute(array($category));
		return $query;
		}
		else if($category=="all" && !empty($search))
		{
		$query = $this->db->prepare("SELECT * FROM jobs where status='published' and job_title like '%$search%' and closing_date <= $todayDate order by date_posted desc");
		$query->execute();
		return $query;
		}
		else if($category=="all")
		{
		$query = $this->db->prepare("SELECT * FROM jobs where status='published' and closing_date <= $todayDate order by date_posted desc");
		$query->execute();
		return $query;
		}
		else if($category!="all" && empty($search))
		{
		$query = $this->db->prepare("SELECT * FROM jobs where status='published' and company_id in (select id from jobs_companies where company_industry = ?) and closing_date <= $todayDate order by date_posted desc");
		$query->execute(array($category));
		return $query;
		}
	}
	public function addRequirement($jobId,$requirement,$exper)
	{
		
		$query= $this->db->prepare("INSERT INTO `job_requirement`(`job_id`, `requirement`, `experience`) VALUES(?,?,?)");
		$query->execute(array($jobId,$requirement,$exper));
	}
	public function getRequirements($job_id){
		$query = $this->db->prepare("select * from job_requirement where job_id =? ");
		$query->execute(array($job_id));
		return $query;
	}
	public function addResponsibility($jobId,$responsibility)
	{
		$query= $this->db->prepare("INSERT INTO `job_responsibilities`(`job_id`, `responsibility`) VALUES(?,?)");
		$query->execute(array($jobId,$responsibility));
	}
	public function checkJobExist_($job_id){
	$query = $this->db->prepare("SELECT job_id FROM jobs WHERE job_id='$job_id'");
	$query->execute();
	$num_rows = 0;
	while ($query->fetch()) {
	    $num_rows++;
	}
	return $num_rows;
	}	
	public function countjobs()
	{
		$query = $this->db->prepare("SELECT count(job_id) AS num_rows FROM jobs");
		$query->execute();
		$row = $query->fetch();
		return $row['num_rows'];
	}
	public function getNextIncrementValue()
	{
		$increment_value = 0;
		$query = $this->db->prepare("SELECT id FROM `jobs` ORDER BY id DESC LIMIT 1");
		$query->execute();
		for($i =0;$row = $query->fetch();$i++){
		$increment_value = $row['id'] + 1;
	}
	return $increment_value;
	}
	public function generateJobId()
	{
		$job_id ="";		
		$new_id = $this->getNextIncrementValue();
		$job_id = 'job-num'.$new_id;
		while($this->checkJobExist_($job_id) > 0)
		{
			$new_id++;
			$job_id = 'job-num'.$new_id;
		}			
		return $job_id;
	}
	public function setJob($jobId){
		$query = $this->db->prepare("SELECT * FROM jobs WHERE md5(job_id) = ?");
		$query->execute(array($jobId));
		for($i =0; $rows = $query->fetch();$i++){
			$this->jobId = $rows['job_id'];
			$this->compID = $rows['company_id'];
			$this->compReg= $rows['company_reg'];
			$this->jobIntro = $rows['job_intro'];
			$this->jobTitle = $rows['job_title'];
			$this->jobDesc = $rows['job_desc'];
			$this->reportTo = $rows['reporting_to'];
			$this->minSalary = $rows['min_salary'];
			$this->maxSalary = $rows['max_salary'];
			$this->salary = $rows['job_salary'];
			$this->currency = $rows['currency'];
			$this->salInterval = $rows['sal_interval'];
			$this->quali = $rows['qualification'];
			$this->jobExperience = $rows['experience'];
			$this->positionLevel = $rows['position_level'];
			$this->postType = $rows['post_type'];
			$this->workMethod = $rows['work_method'];
			$this->jobStatus = $rows['status'];
			$this->unsuccessfulPeriod = $rows['unsuccessful_period'];
			$this->startDate = $rows['start_date'];
			$this->jobActiveDate = $rows['date_posted'];
			$this->jobCloseDate = $rows['closing_date'];
			$this->appLink = $rows['application_link'];
		}
	}
	public function setCompany($compId){
		$query = $this->db->prepare("SELECT * FROM jobs_companies WHERE id = ?");
		$query->execute(array($compId));
		for($i =0; $rows = $query->fetch();$i++){
			$this->compId = $rows['id'];
			$this->compName = $rows['company_name'];
			$this->compEmail = $rows['company_email'];
			$this->compTel = $rows['company_cellphone'];
			$this->compLocation = $rows['company_location'];
			$this->compIndustry = $rows['company_industry'];
			$this->compLogo = $rows['company_logo'];
			$this->dateAdded = $rows['date_added'];
			$this->addedBy = $rows['added_by'];
			$this->compStatus = $rows['status'];
	}
}
public function setJobApplication($jobId,$status){
	$query = $this->db->prepare("SELECT * from job_applications WHERE job_id = ? and app_status = ?");
	$query->execute(array($jobId,$status));
	return $query;
}
public function updateJobAppliStatus($jobId,$enemail,$status){
	$query = $this->db->prepare("UPDATE job_applications SET app_status=? WHERE c_email =? and job_id =?");
	$query->execute(array($status,$enemail,$jobId));
	return $query;
}
public function getApplicationsByEnemail($enemail){
	$query = $this->db->prepare("SELECT * from job_applications WHERE c_email = ?");
	$query->execute(array($enemail));
	return $query;
}
public function checkApplicationExist($enemail,$jobId){
	$query = $this->db->prepare("SELECT count(*) as num_rows from job_applications WHERE c_email = ? and job_id =?");
	$query->execute(array($enemail,$jobId));
	$row = $query->fetch();
	return $row['num_rows'];
}
public function countNumJobApplicants($jobId)
{
	$query = $this->db->prepare("SELECT count(*) as num_jobs from job_applications WHERE job_id = ?");
	$query->execute(array($jobId));
	$row = $query->fetch();
	return $row['num_jobs'];
}
//Count number of application bby status
public function countNumJobAppliByStatus($jobId,$status)
{
	$query = $this->db->prepare("SELECT count(*) as num_jobs from job_applications WHERE job_id = ? and app_status = ?");
	$query->execute(array($jobId,$status));
	$row = $query->fetch();
	return $row['num_jobs'];
}
	//Get Responsibilities
	public function getResponsibilities($jobId){
		//$email = md5($this->email);
		$query = $this->db->prepare("SELECT * FROM `job_responsibilities` WHERE job_id=?");
		$query->execute(array($jobId));
		return $query;
	}
	//set work method to be checked
	  public function setWorkType($methods,$wt){
  	$checked = "checked";
		if(str_contains($methods,$wt))
		{
			return $checked;
		} 
		else{
			return '';
		}  	
  }
  //get all currencies
  public function getAllCurrency(){
  	$query = $this->db->prepare("SELECT * FROM `currency` order by code");
  	$query->execute();
  	return $query;
  }
  public function setCurrency($currencyCode){
  	$query = $this->db->prepare("SELECT * FROM currency where code =?");
  	$query->execute(array($currencyCode));
  	for($i = 0;$rows = $query->fetch();$i++){
  		$this->currencyName = $rows['name'];
  		$this->currencyCode = $rows['code'];
  		$this->currencySymbol = $rows['symbol'];
  	}
  }
  	//insert into industry table
  public function addIndustry($industry){
  	$query = $this->db->prepare("SELECT count(*) as numIndustry from industries where industry =?");
  	$query->execute(array($industry)); 
  	$row = $query->fetch();
  	if($row['numIndustry'] == 0)
  	{
	  	$query  = $this->db->prepare("INSERT INTO industries(industry) VALUES(?)");
	  	$query->execute(array($industry));
	 }
  }

	//get all talents who applied for the positions in the parameters
	public function getApplicantsBy(){
		$query = $this->db->prepare("SELECT c.c_name as name, c.c_surname as surname, q.q_name as qualification from candidate_tbl c
		 inner join qualifications q on md5(c.c_email) = q.c_email
		  where (q.q_name like '%bcom%' or q.q_name like '%Bachelor of Commerce%')
		   and md5(c.c_email) in (select c_email from basket where receipt_id = 'vico-inv36' or receipt_id ='vico-inv40') order by c.c_email");
		$query->execute();
		return $query;
	}
	//Talents that should receive notication
	/*public function notifiedTalents(){
		$query = $this->db->prepare("SELECT ")
	}*/

	public function jobCompID(){
		return $this->compID;
	}
	public function jobCompReg(){
		return $this->compReg;
	}
	public function getJobId(){
		return $this->jobId;
	}
	public function getJobIntro(){
		return $this->jobIntro;
	}
	public function getJobTitle(){
		return $this->jobTitle;
	}
	public function getJobDesc(){
		return $this->jobDesc;
	}
	public function getReportTo(){
		return $this->reportTo;
	}
	public function getJobMinSalary(){
		return $this->minSalary;
	}
	public function getJobMaxSalary(){
		return $this->maxSalary;
	}
	public function getJobSalary(){
		return $this->salary;
	}
	public function getJobCurrency(){
		return $this->currency;
	}
	public function getJobSalInterval(){
		return $this->salInterval;
	}
	public function getPostType(){
		return $this->postType;
	}
	public function getPosLevel(){
		return $this->positionLevel;
	}
	public function getJobQualification(){
		return $this->quali;
	}	
	public function getJobExperience(){
		return $this->jobExperience;
	}
	public function getWorkMethods()
	{
		return $this->workMethod;
	}
	public function getJobStatus(){
		return $this->jobStatus;
	}
	public function getUnsuccessfulPeriod(){
		return $this->unsuccessfulPeriod;
	}
	public function getStartDate(){
		return $this->startDate;
	}
	public function getJobPostedDate(){
		return $this->jobActiveDate;
	}
	public function getJobCloseDate(){
		return $this->jobCloseDate;
	}
	public function getAppLink(){
		return $this->appLink;
	}

	//company
	public function getCompId(){
		return $this->compId;
	}
	public function getCompName(){
		return $this->compName;
	}
	public function getCompEmail(){
		return $this->compEmail;
	} 
	public function getCompTel(){
		return $this->compTel;
	}
	public function getCompLocation(){
		return $this->compLocation;
	}
	public function getCompIndustry(){
		return $this->compIndustry;
	}
	public function getCompLogo(){
		return $this->compLogo;
	}
	public function getCompDateAdded(){
		return $this->dateAdded;
	}
	public function getCompAddedBy(){
		return $this->addedBy;
	}
	public function getCompStatus(){
		return $this->compStatus;
	}

	//Currency 
	public function getCurrencyName(){
		return $this->currencyName;
	}
	public function getCurrencyCode(){
		return $this->currencyCode;
	}
	public function getCurrencySymbol(){
		return $this->currencySymbol;
	}

}

?>