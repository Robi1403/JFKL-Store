<?php

@include 'config.php';

// Check if the form is submitted
if (isset($_GET['year'])) {
    $searchYear = $_GET['year'];

    // Perform a query to get the total sales for the specified year
    $search_query = "SELECT YEAR(`sale_date`) AS `Year`, SUM(`total_sale`) AS `total_sale` FROM `daily_sales_summary` WHERE YEAR(`sale_date`) = '$searchYear' GROUP BY YEAR(`sale_date`)";
    $search_result = mysqli_query($conn, $search_query);

    if ($search_result) {
        if (mysqli_num_rows($search_result) > 0) {
            // Output the search result
            $row = mysqli_fetch_assoc($search_result);
            $year = $row['Year'];
            $totalSales = $row['total_sale'];
            
            echo "<h2>Annual Sales Summary for $year</h2>";
            echo "<p>Total Sales: $totalSales</p>";
        } else {
            echo "No sales data found for $searchYear";
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
    <title>Annual Sales Summary</title>
</head>

<body>
    <h1>Annual Sales Summary</h1>

    <form action="" method="GET">
        <label for="year">Enter Year:</label><br>
        <input type="number" id="year" name="year" max="<?php echo date('Y'); ?>" value="<?php echo date('Y'); ?>" ><br><br>

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
