<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $img = $data['image'];

    // Extract the base64 data and decode it
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $imgData = base64_decode($img);

    // Save the image
    $imageName = 'chart_' . uniqid() . '_' . time() . '.png';
    $filePath = 'charts/'.$imageName;
    file_put_contents($filePath, $imgData);

    echo json_encode(['success' => true, 'filePath' => $filePath]);
    include "testing_email.php";
}

?>
