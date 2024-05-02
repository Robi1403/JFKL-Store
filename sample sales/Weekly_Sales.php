<?php

@include 'config.php';

// Check if the form is submitted
if (isset($_GET['year']) && isset($_GET['month']) && isset($_GET['week'])) {
    $year = $_GET['year'];
    $month = $_GET['month'];
    $week = $_GET['week'];

    // Find the first day of the selected month
    $firstDayOfMonth = date("Y-m-01", strtotime("$year-$month"));

    // Find the first day of the selected week
    $startDate = date("Y-m-d", strtotime("$firstDayOfMonth +". ($week - 1) * 7 ." days"));

    // Find the last day of the selected week
    $endDate = date("Y-m-d", strtotime("$startDate +6 days"));

    // Perform a query to get sales data for the specified week
    $search_query = "SELECT SUM(`total_sale`) AS `Weekly Sales` FROM `daily_sales_summary` WHERE `sale_date` BETWEEN '$startDate' AND '$endDate'";
    $search_result = mysqli_query($conn, $search_query);

    if ($search_result) {
        $row = mysqli_fetch_assoc($search_result);
        $weeklySales = $row['Weekly Sales'];
        
        // Get the month name
        $monthName = date("F", mktime(0, 0, 0, $month, 1));

        if ($weeklySales !== null) {
            // Output the search result
            echo "<h2>Weekly Sales Summary for Week $week of $monthName $year</h2>";
            echo "<p>Date Range: $startDate to $endDate</p>";
            echo "<p>Total Sales: $weeklySales</p>";
        } else {
            echo "No sales data found for Week $week of $monthName $year";
        }
    } else {
        echo "Error searching sales data: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weekly Sales Summary</title>
</head>

<body>
    <h1>Weekly Sales Summary</h1>

    <form action="" method="GET">
        <label for="year">Year:</label><br>
        <input type="number" id="year" name="year" min="2000" max="<?php echo date('Y'); ?>" value="<?php echo date('Y'); ?>"><br><br>

        <label for="month">Month:</label><br>
        <select id="month" name="month">
            <?php
            $maxMonth = (date('Y') == $_GET['year']) ? date('m') : 12;
            for ($i = 1; $i <= $maxMonth; $i++) {
                $monthName = date("F", mktime(0, 0, 0, $i, 1));
                printf('<option value="%02d">%s</option>', $i, $monthName);
            }
            ?>
        </select><br><br>

        <label for="week">Week of the Month:</label><br>
        <select id="week" name="week">
            <?php
            for ($i = 1; $i <= 4; $i++) {
                printf('<option value="%02d">%02d</option>', $i, $i);
            }
            ?>
        </select><br><br>


        <!-- <label for="week">Week of the Month:</label><br>
        <input type="number" id="week" name="week" min="1" max="<?php echo ceil(date('d') / 7); ?>" value="<?php echo ceil(date('d') / 7); ?>"><br><br> -->

        <input type="submit" value="Search">
    </form>

    <br><br>
    <input type="button" name="back" id="back" value="back">

    <script>
        document.getElementById("back").addEventListener("click", function () {
            window.location.href = "Sales.php";
        });

        // Function to update month options based on the selected year
        function updateMonthOptions() {
            var year = parseInt(document.getElementById("year").value);
            var maxMonth = (year === <?php echo date('Y'); ?>) ? <?php echo date('m'); ?> : 12;
            var monthSelect = document.getElementById("month");
            monthSelect.innerHTML = ''; // Clear previous options
            for (var i = 1; i <= maxMonth; i++) {
                var option = document.createElement("option");
                var monthName = new Date(year, i - 1, 1).toLocaleString('en-us', { month: 'long' });
                option.value = ("0" + i).slice(-2);
                option.text = monthName;
                monthSelect.appendChild(option);
            }
        }

        function updateWeekOptions() {
            var year = parseInt(document.getElementById("year").value);
            var month = parseInt(document.getElementById("month").value);
            var currentYear = new Date().getFullYear();
            var currentMonth = new Date().getMonth() + 1;

            var weekSelect = document.getElementById("week");
            weekSelect.innerHTML = ''; // Clear previous options

            // If the current month is selected, only show options up to the current week
            if (year === currentYear && month === currentMonth) {
                var currentWeek = <?php echo ceil(date('d') / 7); ?>;
                for (var i = 1; i <= currentWeek; i++) {
                    var option = document.createElement("option");
                    option.value = ("0" + i).slice(-2);
                    option.text = ("0" + i).slice(-2);
                    weekSelect.appendChild(option);
                }
            } else {
                // Otherwise, show default options 1, 2, 3, 4
                for (var i = 1; i <= 4; i++) {
                    var option = document.createElement("option");
                    option.value = ("0" + i).slice(-2);
                    option.text = ("0" + i).slice(-2);
                    weekSelect.appendChild(option);
                }
            }
        }

        window.onload = function () {
            updateWeekOptions();
            updateMonthOptions();
        };

        document.getElementById("year").addEventListener("change", function () {
            updateWeekOptions();
            updateMonthOptions();
        });

        document.getElementById("month").addEventListener("change", updateWeekOptions);
    </script>

</body>

</html>



