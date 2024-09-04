<?php
require_once('jpgraph/src/jpgraph.php');
require_once('jpgraph/src/jpgraph_line.php');

// Sample data (replace with your data)
$data = [10, 20, 30, 40, 50];

// Create a new graph
// Create a new graph
// Create a new graph
$graph = new Graph(400, 300);
//var_dump($graph); // Debugging line


// Check if the graph object was created successfully
if (!$graph) {
    die('Error: Unable to create the graph object.');
}
else{
// Set up the title
$graph->title->Set("Registered Talents");

// Create a line plot
$lineplot = new LinePlot($data);

// Add the plot to the graph
$graph->Add($lineplot);
// Set the grace margin for the X-axis
$graph->xaxis->scale->SetGrace(0.1); // 10% grace margin

// Set the grace margin for the Y-axis
$graph->yaxis->scale->SetGrace(0.1); // 10% grace margin


// Render the graph (e.g., to a file)
$graph->Stroke();

require_once('tcpdf/tcpdf.php');

// Create a new PDF document
$pdf = new TCPDF();

// Add a page to the PDF
$pdf->AddPage();

// Load the graph image
$image = 'talents_graph.png';

// Place the graph image in the PDF
$pdf->Image($image, 10, 10, 180, 120);

// Save the PDF to a file
$pdf->Output('talents_graph.pdf', 'F');

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer();

// Set up your email settings
$mail->isSMTP();                                             
$mail->Host       = 'mail.viconet.co.za';                  
$mail->SMTPAuth   = true;                             
$mail->Username   = 'info@viconet.co.za';                 
$mail->Password   = 'HzHAZ4RRkEJNlP_QaereIhxLJpByQiMM';
$mail->SMTPSecure = 'tls';                              
$mail->Port       = 587; 
$mail->setFrom('info@viconet.co.za', 'Vico.net profile');           
$mail->addAddress('emanuel@ttchtech.co.za');
$mail->addAddress('innocent38318@gmail.com');

// Attach the PDF file
$mail->addAttachment('talents_graph.pdf', 'Registered_Talents.pdf');

// Email subject and body
$mail->Subject = 'Registered Talents Report';
$mail->Body = 'Please find the attached graph representing registered talents.';

// Send the email
if ($mail->send()) {
    echo 'Email sent successfully!';
} else {
    echo 'Email could not be sent. Error: ' . $mail->ErrorInfo;
}
}
?>
