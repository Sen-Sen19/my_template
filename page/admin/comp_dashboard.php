<?php
session_start();

if (!isset($_SESSION['results'])) {
    header('Location: index.php'); // Redirect to index if no results
    exit();
}

$results = $_SESSION['results'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <style>
        body {
            background-color: #f8f9fa; /* Light background color */
            font-family: 'Arial', sans-serif; /* Set font */
        }
        .container {
            margin-top: 50px;
            padding: 30px; /* Inner spacing */
            border-radius: 10px; /* Rounded corners */
            background-color: #ffffff; /* White background for the container */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }
        .chart-container {
            max-width: 800px;
            margin: 0 auto; /* Center the chart */
        }
        h1 {
            text-align: center; /* Center the heading */
            color: #343a40; /* Darker text for heading */
            margin-bottom: 30px; /* Spacing below the heading */
        }
        .btn-custom {
            margin-top: 10px; /* Margin for buttons */
            width: auto; /* Set width to auto for buttons */
            display: inline-block; /* Allow the button to only take up necessary space */
        }
        .button-container {
            text-align: center; /* Center the buttons */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Dashboard</h1>
        <div class="chart-container">
            <div id="chart"></div>
        </div>
        <div class="button-container mt-4">
            <a href="computation.php" class="btn btn-secondary btn-custom">Back</a>
          
        </div>
    </div>

    <script>
        // Prepare data for the chart
        const results = <?php echo json_encode(array_values($results)); ?>;

        // Create the chart
        const options = {
            series: [{
                name: 'Results',
                data: results
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            xaxis: {
                categories: Object.keys(<?php echo json_encode($results); ?>)
            },
            title: {
                text: 'Results Overview',
                align: 'center',
                style: {
                    fontSize: '24px',
                    fontWeight: 'bold',
                    color: '#333'
                }
            }
        };

        const chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
</body>
</html>
