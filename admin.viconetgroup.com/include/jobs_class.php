<?php
/**
 * 
 */
class Jobs
{
	private $db;
	//Job information
	private $jobId;
	private $jobIntro;
	private $jobTitle;
	private $jobDesc;
	private $jobSalary;
	private $postType;
	private $workMethod;
	private $jobStatus;

	
	function __construct($db)
	{
		$this->db = $db;
	}
	public function addJob($jobId,$compReg,$jobIntro,$jobTitle,$jobDesc,$jobSalary,$postType,$workMethods,$startDate,$appLink,$exp,$posLevel,$jobStatus,$datePosted)
	{
		$compReg=md5($compReg);
		$query=$this->db->prepare("INSERT INTO `jobs`(`job_id`, `company_reg`, `job_intro`, `job_title`, `job_desc`, `salary`, `post_type`, `work_method`, `start_date`, `application_link`, `experience`, `position_level`, `status`, `date_posted`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$query->execute(array($jobId,$compReg,$jobIntro,$jobTitle,$jobDesc,$jobSalary,$postType,$workMethods,$startDate,$appLink,$exp,$posLevel,$jobStatus,$datePosted));
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
			$this->jobIntro = $rows['job_intro'];
			$this->jobTitle = $rows['job_title'];
			$this->jobDesc = $rows['job_desc'];
			$this->jobSalary = $rows['salary'];
			$this->postType = $rows['post_type'];
			$this->workMethod = $rows['work_method'];
			$this->jobStatus = $rows['status'];
		}
	}
	//Get Responsibilities
	public function getResponsibilities($jobId){
		//$email = md5($this->email);
		$query = $this->db->prepare("SELECT * FROM `job_responsibilities` WHERE job_id=?");
		$query->execute(array($jobId));
		return $query;
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
	public function getJobSalary(){
		return $this->jobSalary;
	}
	public function getPostType(){
		return $this->postType;
	}
	public function getWorkMethod()
	{
		return $this->workMethod;
	}
	public function getJobStatus(){
		return $this->jobStatus;
	}

}

?>