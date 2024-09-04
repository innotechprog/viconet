var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar', // You can change this to 'line', 'pie', etc.
    data: {
        labels: labels,
        datasets: [{
            label: 'Email Reminder Number',
            data: data,
            backgroundColor: 'rgba(228, 24, 109, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Email Reminder Number' // Label for the x-axis
                }
            },
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'CV Uploads' // Label for the y-axis
                }
            }
        }
    }
});

