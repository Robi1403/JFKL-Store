<?php

@include 'config.php';

// Check if the form is submitted
if (isset($_GET['year']) && isset($_GET['month'])) {
    $year = $_GET['year'];
    $month = $_GET['month'];

    // Perform a query to get the total sales for the specified month and year
    $search_query = "SELECT YEAR(`sale_date`) AS `Year`, MONTH(`sale_date`) AS `Month`, SUM(`total_sale`) AS `total_sale` FROM `daily_sales_summary` WHERE YEAR(`sale_date`) = '$year' AND MONTH(`sale_date`) = '$month' GROUP BY YEAR(`sale_date`), MONTH(`sale_date`)";
    $search_result = mysqli_query($conn, $search_query);

    if ($search_result) {
        $monthName = date("F", mktime(0, 0, 0, $month, 1));

        if (mysqli_num_rows($search_result) > 0) {
            // Output the search result
            $row = mysqli_fetch_assoc($search_result);
            $year = $row['Year'];
            $totalSales = $row['total_sale'];
            
            echo "<h2>Monthly Sales Summary for $monthName $year</h2>";
            echo "<p>Total Sales: $totalSales</p>";
        } else {
            echo "No sales data found for $monthName $year";
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
    <title>Monthly Sales Summary</title>
</head>

<body>
    <h1>Monthly Sales Summary</h1>

    <form action="" method="GET">
        <label for="year">Enter Year:</label><br>
        <input type="number" id="year" name="year" max="<?php echo date('Y'); ?>" value="<?php echo date('Y'); ?>" ><br><br>

        <label for="month">Month:</label><br>
        <input type="number" id="month" name="month" min="1" max="<?php echo date('m'); ?>" value="<?php echo date('m'); ?>"><br><br>

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
