<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

</head>
<body>

<script>
 function fetchData() {
     fetch('daily-report-data.php')
         .then(response => response.json())
         .then(data => {
             const labels = Object.keys(data);
             const values = Object.values(data);

             const ctx = document.getElementById('barChart').getContext('2d');
             new Chart(ctx, {
                 type: 'line',
                 data: {
                     labels: labels,
                     datasets: [{
                         label: 'Number of Registered Talent',
                         data: values,
                         backgroundColor: '#27276c',
                         borderColor: 'rgba(75, 192, 192, 1)',
                         borderWidth: 1
                     }]
                 },
                 options: {
                     scales: {
                         y: {
                             beginAtZero: true
                         }
                     }
                 }
             });

             // Generate PDF
             generatePDF();
         });
 }

 // Call the fetchData function to render the chart and generate PDF
 fetchData();

 function generatePDF() {
     const elementToExport = document.body; // You can select the specific element to export

     const pdfOptions = {
         margin: 10,
         filename: 'chart.pdf',
         image: { type: 'jpeg', quality: 0.98 },
         html2canvas: { scale: 2 },
         jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
     };

     html2pdf()
         .from(elementToExport)
         .set(pdfOptions)
         .outputPdf()
         .then(pdf => {
             // Now you can send the PDF via email, possibly using a server-side script.
             sendPDFViaEmail(pdf);
         });
 }

 function sendPDFViaEmail(pdfData) {
     // Here, you would typically make an AJAX request to a server-side script
     // to send the PDF as an email attachment.
     // You can use PHP, Node.js, Python, etc., to send the email.
     // Example: Use PHP's mail() function to send the email with the PDF attachment.
     // Example PHP code:
     /*
     <?php
     $to = "recipient@example.com";
     $subject = "Daily Report";
     $message = "Please find the attached report.";
     $headers = "From: your@example.com";
     $filename = "chart.pdf";

     $attachment = chunk_split(base64_encode($pdfData));

     $boundary = md5(time());

     $headers .= "\nMIME-Version: 1.0\n";
     $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\n";

     $message = "This is a multi-part message in MIME format.\n\n" .
         "--$boundary\n" .
         "Content-Type: text/plain; charset=\"iso-8859-1\"\n" .
         "Content-Transfer-Encoding: 7bit\n\n" .
         $message . "\n\n";

     $message .= "--$boundary\n";
     $message .= "Content-Type: application/octet-stream; name=\"$filename\"\n";
     $message .= "Content-Transfer-Encoding: base64\n";
     $message .= "Content-Disposition: attachment\n\n" .
         $attachment . "\n\n";
     
     mail($to, $subject, $message, $headers);
     ?>
     */

     // Replace the above PHP code with a server-side script that suits your environment.
     // Ensure that your server-side script sends the email with the PDF attachment.
 }
</script>

</body>
</html>
