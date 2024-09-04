<?php
// Replace this with your actual data retrieval logic
$data = [
    "2023-09-01" => 10,
    "2023-09-02" => 30,
    "2023-09-03" => 8,
    "2023-09-05" => 8,
    "2023-09-06" => 8,
    // Add more data as needed
];

header('Content-Type: application/json');
echo json_encode($data);
?>