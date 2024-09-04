<?php
/**
 * 
 */
class JobPosting extends Candidates
{
	private $db;
	private $regSource = "Job-seeking";
	function __construct($db)
	{
		$this->db = $db;
	}
	public function totalTalentRegJP($fromDate,$toDate){
		$sql = "SELECT * FROM candidate_tbl c
		inner join registration_source rs on md5(c.c_email) = rs.c_email WHERE rs.source = :regSource";
		if (!empty($fromDate) && !empty($toDate)) {
			$sql .= " AND c.date_registered BETWEEN :fromDate AND :toDate";
		}	
		$stmt = $this->db->prepare($sql);
		if (!empty($fromDate) && !empty($toDate)) {
			$stmt->bindParam(':fromDate', $fromDate);
			$stmt->bindParam(':toDate', $toDate);
		}
		$stmt->bindParam(':regSource', $this->regSource);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return count($result);
	}
	public function countNumCandJP($status,$fromDate,$toDate){
	$sql = "SELECT count(*) as num_candi from candidate_tbl c
		inner join registration_source rs on md5(c.c_email) = rs.c_email where c.c_verified = :status and rs.source = :regSource";
	if (!empty($fromDate) && !empty($toDate)) {
			$sql .= " AND c.date_registered BETWEEN :fromDate AND :toDate";
		}	
		$stmt = $this->db->prepare($sql);
		if (!empty($fromDate) && !empty($toDate)) {
			$stmt->bindParam(':fromDate', $fromDate);
			$stmt->bindParam(':toDate', $toDate);
		}
		$stmt->bindParam(':regSource', $this->regSource);
		$stmt->bindParam(':status', $status);
	$stmt->execute();

	$row = $stmt->fetch();
	return $row['num_candi'];
}
	public function getNumCandi(){
		$query = $this->db->prepare("SELECT * from candidate_tbl c
		 inner join registration_source rs on md5(c.c_email) = rs.c_email ");
	$query->execute();
	$result = $query->fetchAll();
	return count($result);
	}

public function countTalentWithoutCVJP($fromDate,$toDate)
	{
		$sql = "SELECT count(c.c_email) as total_count FROM candidate_tbl c 
INNER JOIN curriculum_vitae cv on md5(c.c_email) = cv.c_email
WHERE (cv.cv_file = '' OR cv.cv_file is null) and md5(c.c_email) in (select c_email from registration_source where source = :regSource)";
if (!empty($fromDate) && !empty($toDate)) {
			$sql .= " AND c.date_registered BETWEEN :fromDate AND :toDate";
		}	
		$stmt = $this->db->prepare($sql);
		if (!empty($fromDate) && !empty($toDate)) {
			$stmt->bindParam(':fromDate', $fromDate);
			$stmt->bindParam(':toDate', $toDate);
		}
		$stmt->bindParam(':regSource', $this->regSource);
		$stmt->execute();
		$row = $stmt->fetch();
		return $row['total_count'];
	}

public function countTalentWithCVJP($fromDate,$toDate)
	{
$sql = "SELECT count(c.c_email) as total_count FROM candidate_tbl c 
INNER JOIN curriculum_vitae cv on md5(c.c_email) = cv.c_email
WHERE COALESCE(cv.cv_file, '') != '' and md5(c.c_email) in (select c_email from registration_source where source =:regSource)";
		if (!empty($fromDate) && !empty($toDate)) {
			$sql .= " AND c.date_registered BETWEEN :fromDate AND :toDate";
		}	
		$stmt = $this->db->prepare($sql);
		if (!empty($fromDate) && !empty($toDate)) {
			$stmt->bindParam(':fromDate', $fromDate);
			$stmt->bindParam(':toDate', $toDate);
		}
		$stmt->bindParam(':regSource', $this->regSource);
		$stmt->execute();
		$row = $stmt->fetch();
		return $row['total_count'];
	}
	
}
