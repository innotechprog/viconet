<?php
/**
 * 
 */
class Reminder
{
	
	function __construct($db)
	{
		$this->db = $db;
	}
	public function getAllTalentWithoutCV(){
		$query = $this->db->prepare("SELECT c.c_name as c_name, c.c_email as email,c.num_reminder, cv.cv_file as cv_file FROM candidate_tbl c INNER JOIN curriculum_vitae cv on md5(c.c_email) = cv.c_email where (cv.cv_file = '' OR cv.cv_file is null) and c.added_by !='import' and c.c_email on ('innocent38318@gmail.com','emanuel@ttchtech.co.za'");
		$query->execute();
		return $query;
	}
}