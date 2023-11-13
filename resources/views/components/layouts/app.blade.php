<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>EnviroScan</title>
        <link rel="stylesheet" href="../resources/css/app.css">
    </head>
    <body>
        {{ $slot }}
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            $(document).ready(function() {
                setInterval(function() {
                    $.ajax({
                        url: 'http://192.168.43.137/EnviroScan/public/get-data',
                        method: 'GET',
                        success: function(response) {
                            $('#temperature').text(response.temperature);
                            $('#humidity').text(response.humidity);
                        },
                        error: function() {
                            // Handle the error case
                        }
                    });
                }, 1000);
            });
        </script>

        <script>
            // Create an empty data array to store temperature and humidity values
            const data = {
                temperature: [],
                humidity: []
            };

            // Get the temperature and humidity elements
            const temperatureElement = document.getElementById('temperature');
            const humidityElement = document.getElementById('humidity');

            // Create the chart context
            const ctx = document.getElementById('myChart').getContext('2d');
            const chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Temperature',
                        data: data.temperature,
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1,
                        fill: true,
                        tension: 0.4,   //set the curve of the line
                        pointStyle: 'line',

                    }, {
                        label: 'Humidity',
                        data: data.humidity,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        fill: true,
                        tension: 0.4,
                        pointStyle: 'line',
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            display: true,
                            maxTicksLimit: 10
                        },
                        y: {
                            display: true
                        }
                    }
                }
            });

            // Function to update the chart with new data
            function updateChart(temperature, humidity) {
                // Add the new data to the data array
                const time = new Date().toLocaleTimeString();
                data.temperature.push({ x: time, y: temperature });
                data.humidity.push({ x: time, y: humidity });

                // Keep a maximum of 10 data points on the chart
                // if (data.temperature.length > 10) {
                //     data.temperature.shift();
                //     data.humidity.shift();
                // }

                // Update the chart data and labels
                chart.data.labels.push(time);

                // Update the chart
                chart.update();

                // Update the temperature and humidity elements
                temperatureElement.innerText = temperature;
                humidityElement.innerText = humidity;
            }

            // Simulate real-time updates every second
            setInterval(() => {
                    // Make an AJAX request to fetch the temperature and humidity values
            $.ajax({
                url: 'http://192.168.43.137/EnviroScan/public/get-data',
                method: 'GET',
                success: function(response) {
                    const { temperature, humidity } = response;

                    // Call the updateChart function with the new values
                    updateChart(temperature, humidity);
                },
                error: function() {
                    console.error('Failed to fetch temperature and humidity');
                }
            });
        }, 1000);
        </script>
    </body>
</html>
