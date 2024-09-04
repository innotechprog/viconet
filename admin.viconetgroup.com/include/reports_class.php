<?php

class Reports{

private $db;
	function __construct($db)
	{
		$this->db = $db;

	}
	public function getDates(){
	// Get the current date
$currentDate = new DateTime();

// Create an array to store the seven dates
$dates = array();

// Loop to get seven dates going back
for ($i = 0; $i < 15; $i++) {
    // Clone the current date and subtract $i days
    $date = clone $currentDate;
    $date->sub(new DateInterval('P' . $i . 'D'));
    
    // Format the date as desired (e.g., Y-m-d for YYYY-MM-DD)
    $formattedDate = $date->format('Y-m-d');
    
    // Add the formatted date to the array
    $dates[] = $formattedDate;
}

// Sort the array of dates in ascending order
usort($dates, function ($a, $b) {
    return strtotime($a) - strtotime($b);
});

// Print the sorted array of dates
return $dates;

}
	public function getNumberOfTalentPerDate($date){
		$query = $this->db->prepare("SELECT count(c_name) as num_rows from candidate_tbl WHERE date_registered =?");
		$query->execute(array($date));
		$numRows = $query->fetch()['num_rows'];
		return $numRows;
	}
}
?>