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
	private $jobSalary;
	private $postType;
	private $workMethod;
	private $jobStatus;
	private $jobExperience;
	private $startDate;
	private $jobActiveDate;
	private $jobCloseDate;

	private $compId;
	private $compName;
	private $compEmail;
	private $compTel;
	private $compLogo;
	private $compLocation;
	private $commIndustry;
	private $dateAdded;
	private $addedBy;
	private $compStatus;
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
	public function addJob($jobId,$compReg,$compId,$jobIntro,$jobTitle,$jobDesc,$reportTo,$jobSalary,$postType,$workMethods,$startDate,$appLink,$exp,$posLevel,$jobStatus,$datePosted,$closingDate)
	{
		$compReg=md5($compReg);
		$query=$this->db->prepare("INSERT INTO `jobs`(`job_id`, `company_reg`,`company_id`, `job_intro`, `job_title`, `job_desc`,`reporting_to`, `salary`, `post_type`, `work_method`, `start_date`, `application_link`, `experience`, `position_level`, `status`, `date_posted`,`closing_date`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$query->execute(array($jobId,$compReg,$compId,$jobIntro,$jobTitle,$jobDesc,$reportTo,$jobSalary,$postType,$workMethods,$startDate,$appLink,$exp,$posLevel,$jobStatus,$datePosted,$closingDate));
	}
	public function addCompanyForJobs($id,$compName, $compEmail,$compTel,$compLocation,$industry, $addedBy){
		$date = new DateTime('now');
		$dateAdded = $date->format('Y-m-d');
		$status = "Active";
		$query = $this->db->prepare("INSERT INTO `jobs_companies`(`id`,`company_name`, `company_email`, `company_cellphone`, `company_location`,`company_industry`, `date_added`, `added_by`,`status`) VALUES(?,?,?,?,?,?,?,?,?)");
		$query->execute(array($id,$compName,$compEmail,$compTel,$compLocation,$industry,$dateAdded,$addedBy,$status));
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
	public function getJobsBySearch($search){
		$query = $this->db->prepare("SELECT * FROM jobs where job_title = ?");
		$query->execute(array($search));
		return $query;
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
	$query = $this->db->prepare("SELECT *,count(job_id) as num_rows FROM jobs WHERE job_id='$job_id'");
	$query->execute();
	$row = $query->fetch();
	return $row['num_rows'];
	}	
	public function countjobs()
	{
		$query = $this->db->prepare("SELECT count(job_id) AS num_rows FROM jobs");
		$query->execute();
		$row = $query->fetch();
		return $row['num_rows'];
	}
	public function generateJobId()
	{
		$job_id ="";		
		$i=1;
		$job_id="";
		$new_id = $this->countJobs() + $i;
		$job_id = 'job-num'.$new_id;
		while($this->checkJobExist_($job_id) > 0)
		{
			$new_id++;
			$job_id = 'vico-inv'.$new_id;
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
			$this->jobSalary = $rows['salary'];
			$this->jobExperience = $rows['experience'];
			$this->postType = $rows['post_type'];
			$this->workMethod = $rows['work_method'];
			$this->jobStatus = $rows['status'];
			$this->startDate = $rows['start_date'];
			$this->jobActiveDate = $rows['date_posted'];
			$this->jobCloseDate = $rows['closing_date'];
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
			$this->dateAdded = $rows['date_added'];
			$this->addedBy = $rows['added_by'];
			$this->compStatus = $rows['status'];
	}
}
	//Get Responsibilities
	public function getResponsibilities($jobId){
		//$email = md5($this->email);
		$query = $this->db->prepare("SELECT * FROM `job_responsibilities` WHERE job_id=?");
		$query->execute(array($jobId));
		return $query;
	}
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
	public function getJobSalary(){
		return $this->jobSalary;
	}
	public function getPostType(){
		return $this->postType;
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
	public function getStartDate(){
		return $this->startDate;
	}
	public function getJobPostedDate(){
		return $this->jobActiveDate;
	}
	public function getJobCloseDate(){
		return $this->jobCloseDate;
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

}

?>