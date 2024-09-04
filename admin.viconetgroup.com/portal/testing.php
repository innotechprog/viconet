<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="myChart" width="400" height="200"></canvas>
    <script>
        function fetchData() {
            fetch('daily-report-data.php')
                .then(response => response.json())
                .then(data => {
                    const labels = Object.keys(data);
                    const values = Object.values(data);

                    // Create the Chart.js chart
                    const ctx = document.getElementById('myChart').getContext('2d');
                    const chart = new Chart(ctx, {
                        type: 'bar',
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

                    // Convert the chart to a base64 image
                    const chartImage = chart.toBase64Image();

                    // Send the chart image data to the PHP script
                    sendChartImageToPHP(chartImage);
                });
        }

        function sendChartImageToPHP(imageData) {
            fetch('save_chart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ image: imageData })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Chart image saved successfully.');
                } else {
                    console.error('Error saving chart image.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        // Call the fetchData function to render the chart
        fetchData();
    </script>
</body>
</html>

</body>
</html>
