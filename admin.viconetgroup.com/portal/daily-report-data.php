<?php
      include '../include/connect.php';
      //include 'assets/classes/auth.php';
      include 'assets/classes/functions.php';
      include '../include/reports_class.php';
   
      $report = new Reports($db);
     

// Replace this with your actual data retrieval logic
/*$data = [
    "2023-09-01" => 10,
    "2023-09-02" => 30,
    "2023-09-03" => 25,
    "2023-09-05" => 24,
    "2023-09-06" => 8,
    // Add more data as needed
];*/

$myArray = $report->getDates();
$data = array(); // Create an empty array to store the data

foreach ($myArray as $date) {
    $data[$date] = $report->getNumberOfTalentPerDate($date);
}

$jsonData = json_encode($data); // Convert the array to a JSON string


//header('Content-Type: application/json');
echo $jsonData; // Output the JSON data
?>