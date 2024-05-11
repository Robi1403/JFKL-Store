<?php
include ("connection.php");

    date_default_timezone_set('Asia/Manila');
    $currentDate = date("Y-m-d");

    $search_query = "SELECT COUNT(*) AS total_transactions, SUM(number_of_items) AS total_items, SUM(gross_sales) AS total_sales, SUM(profit) AS total_profit FROM `transaction_history` WHERE `date` = '$currentDate'";

    $search_result = mysqli_query($conn, $search_query);
    if ($search_result) {
        if (mysqli_num_rows($search_result) > 0) {
            // Output the search result
            $row = mysqli_fetch_assoc($search_result);
            $currentTotalTransactions = $row['total_transactions'];
            $currentTotalItems = $row['total_items'];
            $currentTotalSales = $row['total_sales'];
            $currentTotalProfit = $row['total_profit'];

            // echo "<h2>Sales Summary for $currentDate</h2>";

            // echo "<p>Total Number of Transactions: $currentTotalTransactions</p>";
            // echo "<p>Total Number of Items: $currentTotalItems</p>";
            // echo "<p>Total Gross Sales: $currentTotalSales</p>";
            // echo "<p>Total Profit: $currentTotalProfit</p>";
            // echo '<script>
            //     window.location.href = "../sales.php"; 
            // </script>';
        } else {
            echo "No sales data found for $currentDate";
        }
    } else {
        echo "Error searching sales data: " . mysqli_error($conn);
    }

?>