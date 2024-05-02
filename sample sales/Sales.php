<?php
session_start(); // Start session

@include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales</title>
</head>

<body>
    <h1>Sales</h1>

    <form action="" method="POST">
        <button type="button" name="daily" id="daily">Daily</button>
        <button type="button" name="weekly" id="weekly">Weekly</button>
        <button type="button" name="monthly" id="monthly">Monthly</button>
        <button type="button" name="annual" id="annual">Annual</button>
    </form>

    <br><br>
    <input type="button" name="back" id="back" value="back">

    <script>
        document.getElementById("daily").addEventListener("click", function () {
            window.location.href = "Daily_Sales.php";
        });

        document.getElementById("weekly").addEventListener("click", function () {
            window.location.href = "Weekly_Sales.php";
        });

        document.getElementById("monthly").addEventListener("click", function () {
            window.location.href = "Monthly_Sales.php";
        });

        document.getElementById("annual").addEventListener("click", function () {
            window.location.href = "Annual_Sales.php";
        });

        document.getElementById("back").addEventListener("click", function () {
            window.location.href = "Main_Page.php";
        });
    </script>
</body>

</html>