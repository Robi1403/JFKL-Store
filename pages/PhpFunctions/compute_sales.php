<?php
include ("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the start and end dates from the form
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    // Display the start and end dates (just for testing)
    // echo '<script>alert("Start Date: ' . $startDate . '\\nEnd Date: ' . $endDate . '");</script>';

    if ($startDate == $endDate) {
        // Daily sales
        $search_query = "SELECT COUNT(*) AS total_transactions, SUM(number_of_items) AS total_items, SUM(gross_sales) AS total_sales, SUM(profit) AS total_profit FROM `transaction_history` WHERE `date` = '$startDate'";
    } else {
        // Custom Date Range's Sales
        $search_query = "SELECT COUNT(*) AS total_transactions, SUM(number_of_items) AS total_items, SUM(gross_sales) AS total_sales, SUM(profit) AS total_profit FROM `transaction_history` WHERE `date` BETWEEN '$startDate' AND '$endDate'";
    }

    $search_result = mysqli_query($conn, $search_query);
    if ($search_result) {
        if (mysqli_num_rows($search_result) > 0) {
            // Output the search result
            $row = mysqli_fetch_assoc($search_result);
            $totalTransactions = $row['total_transactions'];
            $totalItems = $row['total_items'];
            $totalSales = $row['total_sales'];
            $totalProfit = $row['total_profit'];

            if ($startDate == $endDate) {
                echo "<h2>Sales Summary for $startDate</h2>";
            } else
            {
                echo "<h2>Sales Summary for $startDate - $endDate</h2>";
            }
            echo "<p>Total Number of Transactions: $totalTransactions</p>";
            echo "<p>Total Number of Items: $totalItems</p>";
            echo "<p>Total Gross Sales: $totalSales</p>";
            echo "<p>Total Profit: $totalProfit</p>";
        } else {
            if ($startDate == $endDate) {
            echo "No sales data found for $startDate";
            } else {
                echo "No sales data found for $startDate - $endDate";
            }
        }
    } else {
        echo "Error searching sales data: " . mysqli_error($conn);
    }
}
?>