<?php

class Application{

	private $cEmail;
	private $jobId;
	private $dateApplied;
	private $appliStatus;
	private $db;

	function __construct($db)
	{
		$this->db = $db;
	}
	protected function getTodayDate(){
			$date = date('Y-m-d');
		return $date;
	}
	public function addJobApplication($c_email,$jobId){
		$c_email = md5($c_email);
		$jobId = md5($jobId);
		$dateApplied = $this->getTodayDate();
		$appliStatus = "pending";
		$query = $this->db->prepare("SELECT count(c_email) as num_rows FROM job_applications WHERE c_email =? and job_id =?");
		$query->execute(array($c_email, $jobId));
		$row = $query->fetch();
		if($row['num_rows'] == 0){
		$query = $this->db->prepare("INSERT INTO `job_applications`(`c_email`, `job_id`, `app_date`, `app_status`) VALUES (?,?,?,?)");
		$query->execute(array($c_email,$jobId,$dateApplied,$appliStatus));
	}
	}
	public function checkApplication($c_email,$jobId){
		
	}
}