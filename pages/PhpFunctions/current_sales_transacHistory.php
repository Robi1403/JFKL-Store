<?php
include ("connection.php");

date_default_timezone_set('Asia/Manila');
$currentDate = date("Y-m-d");

$search_query = "SELECT COUNT(*) AS total_transactions, SUM(number_of_items) AS total_items, SUM(gross_sales) AS total_sales, SUM(profit) AS total_profit FROM `transaction_history` WHERE `date` = '$currentDate'";

$search_result = mysqli_query($conn, $search_query);
if ($search_result) {
    if (mysqli_num_rows($search_result) > 0) {
        $row = mysqli_fetch_assoc($search_result);
        $currentTotalTransactions = $row['total_transactions'];
        $currentTotalItems = $row['total_items'];
        $currentTotalSales = $row['total_sales'];
        $currentTotalProfit = $row['total_profit'];

        $currentTotalTransactions = $currentTotalTransactions ?? 0;
        $currentTotalItems = $currentTotalItems ?? 0;
        $currentTotalSales = $currentTotalSales ?? 0;
        $currentTotalProfit = $currentTotalProfit ?? 0;
    }
} else {
    echo '<script>alert("Error searching sales data: "' . mysqli_error($conn) .'");<script>';
}

$searchTH_query = "SELECT * FROM `transaction_history` WHERE `date` = '$currentDate'";

$searchTH_result = mysqli_query($conn, $searchTH_query);
if ($searchTH_result) {
    if (mysqli_num_rows($searchTH_result) > 0) {
        $row = mysqli_fetch_assoc($searchTH_result);
        $currentTransactionNum = $row['transaction_number'];
        $currentNumItems = $row['number_of_items'];
        $currentTotal = $row['gross_sales'];
        $currentProfit = $row['profit'];
        $currentDates = $row['date'];
    }
} else {
    echo '<script>alert("Error searching sales data: "' . mysqli_error($conn) .'");<script>';
}
?>