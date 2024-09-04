<?php
class Global_search{
	function __construct($db){

	}
	public function globalSearch($email){
		$roles ="";
		$sql = $this->db->prepare("SELECT md5(c_email) as c_email FROM candidate_tbl WHERE c_name like '%no%' or c_surname like '%no%' or concat(c_name,' ',c_surname) like '%no%' or concat(c_surname,' ',c_name) like '%no%' 
		 union
		 select c_email FROM candidate_role WHERE job_title like '%no%' or company_name like '%no%'
		 union
		 SELECT email FROM address WHERE address like  '%no%'
		 union 
		 SELECT c_email FROM key_skills WHERE skill like '%no%'
		 union 
		 SELECT c_email FROM key_roles WHERE role like '%no%'
		 union 
		 SELECT c_email FROM key_courses WHERE key_course like '%no%'
		 ");
		$sql->execute();
	}
}
/*
$roles = $candidate->getCombinedRoles($email);

		$skills = $candidate->getCombinedSkills($email);
		$courses = $candidate->getCombinedCourses($email);
		$experience =$candidate->getCombinedExperience($email);
		$qualification =$candidate->getCombinedQualification($email);		
		$location = $candidate->getCombinedLocation($email);
		$names = $candidate->getCombinedNames($email);
		$names_ = $candidate->getCombinedNames_($email);
		$names__ = $candidate->getCombinedNames__($email);
		//$workMethod = $candidate->getCombinedCV($email);