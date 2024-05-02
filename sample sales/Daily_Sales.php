<?php

@include 'config.php';

// Check if the form is submitted
if (isset($_GET['date'])) {
    $date = $_GET['date'];

    // Perform a query to get sales data for the specified date
    $search_query = "SELECT * FROM `daily_sales_summary` WHERE `sale_date` = '$date'";
    $search_result = mysqli_query($conn, $search_query);

    if ($search_result) {
        if (mysqli_num_rows($search_result) > 0) {
            // Output the search result
            echo "<h2>Sales Summary for $date</h2>";
            echo '<table border="1">';
            echo '<tr><th>Date</th><th>Total Sales</th></tr>';

            while ($row = mysqli_fetch_assoc($search_result)) {
                echo "<tr>";
                echo "<td>{$row['sale_date']}</td>";
                echo "<td>{$row['total_sale']}</td>";
                echo "</tr>";
            }

            echo '</table>';
        } else {
            echo "No sales data found for $date";
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
    <title>Daily Sales Summary</title>
</head>

<body>
    <h1>Daily Sales Summary</h1>

    <form action="" method="GET">
        <label for="date">Enter Date:</label><br>
        <input type="date" id="date" name="date" max="<?php echo date('Y-m-d'); ?>"><br><br>

        <input type="submit" value="Search">
    </form>

    <br><br>
    <input type="button" name="back" id="back" value="back">

    <script>
        document.getElementById("back").addEventListener("click", function () {
            window.location.href = "Sales.php";
        });
    </script>

</body>

</html>