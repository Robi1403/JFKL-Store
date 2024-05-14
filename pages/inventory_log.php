<?php
include ("PhpFunctions/connection.php");
include ("PhpFunctions/remove_product.php");
include ("PhpFunctions/add_product.php");
include ("PhpFunctions/update_product.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JFKL Store</title>
    <link rel="stylesheet" href="../css/inventory.css">
    <link rel="icon" href="../assets/storeLogo.svg">

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/daterangepicker.css" />

</head>

<body>
    <div class="navbar">
        <div class="left">
            <div class="shape">

            </div>
            <div class="logo">
                <img src="../assets/storeLogo.svg" alt="">
                <p>JFKL Store</p>
            </div>
        </div>

        <div class="right">
            <div class="todayGrossSaleLabel">
                <p>Today's Logs: </p>
            </div>

            <?php
            date_default_timezone_set('Asia/Manila');
            $currentDate = date("Y-m-d");

            $search_query = "SELECT COUNT(*) AS total_logs FROM `inventory_log` WHERE DATE(date) = '$currentDate'";

            $search_result = mysqli_query($conn, $search_query);
            if ($search_result) {
                if (mysqli_num_rows($search_result) > 0) {
                    $row = mysqli_fetch_assoc($search_result);
                    $currentTotalLogs = $row['total_logs'];

                    $currentTotalLogs = $currentTotalLogs ?? 0;
                }
            }
            ?>

            <div class="todayGrossSale">
                <p><strong><?php echo $currentTotalLogs; ?></strong></p>
            </div>
            <div class="date">
                <p>
                    <?php
                    date_default_timezone_set('Asia/Manila');
                    $currentDateTime = date('F j, Y h:i A');
                    echo $currentDateTime;
                    ?>
                </p>
            </div>
        </div>
    </div>

    <div class="sideBar">
        <div class="sbPOS">
            <button id="POSBtn">
                <img src="../assets/POS_g.svg" alt=""><br>

                <strong>POS</strong>
            </button>
        </div>
        <div class="sbInventory">
            <button id="inventoryBtn">
                <img src="../assets/inventorygreen.svg" alt=""><br>
                <strong>Inventory</strong>
            </button>
        </div>
        <div class="sbSales">
            <button id="salesBtn">
                <img src="../assets/sales.svg" alt=""><br>
                <strong>Sales</strong>
            </button>
        </div>
    </div>



    <div class="mainContainerLog">
        <div class="group">
            <select id="actionTypeFilter" " onchange="filterTable()">
                <option value="all">All</option>
                <option value="add">Add</option>
                <option value="update">Update</option>
                <option value="remove">Remove</option>
            </select>
            
            <input type="text" id="datepicker" placeholder="Select Date"/>
        

        </div>
    

        <div class="inventoryLog">
            <table class="inventoryTable" id="inventoryTable">
                <thead>
                    <tr>
                        <th>Log ID</th>
                        <th>Product ID</th>
                        <th>Action Type</th>
                        <th>Date</th>
                        <th>Previous State</th>
                        <th>New State</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    date_default_timezone_set('Asia/Manila');
                    $currentDate = date("Y-m-d");

                    $select_query = "SELECT * FROM `inventory_log`";

                    $result = mysqli_query($conn, $select_query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row["log_id"]; ?></td>
                                <td><?php echo $row["product_id"]; ?></td>
                                <td><?php echo $row["action_type"]; ?></td>
                                <td><?php echo $row["date"] ?? '-'; ?></td>
                                <td style="text-align:left" ;><?php echo $row["previous_state"]; ?></td>
                                <td style="text-align:left" ;><?php echo $row["new_state"]; ?></td>
                            </tr>
                            <?php
                        }
                    } else { ?>
                        <tr>
                            <td colspan="6"><?php echo 'No logs recorded today.'; ?></td>
                        </tr>
                        <?php
                    }
                    ?>

                    <!-- FOR THE DATE PICKER
                        <php


                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if (isset($_POST['selectedDate'])) {
                            $selectedDate = $_POST['selectedDate'];
                            // Do something with the selected date
                            echo "<script>alert('Selected date: " . $selectedDate ."');</script>";
                            $select_query = "SELECT * FROM `inventory_log` WHERE DATE(date) = '$selectedDate'";

                            $result = mysqli_query($conn, $select_query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><php echo $row["log_id"]; ?></td>
                                <td><php echo $row["product_id"]; ?></td>
                                <td><php echo $row["action_type"]; ?></td>
                                <td><php echo $row["date"] ?? '-'; ?></td>
                                <td style="text-align:left" ;><php echo $row["previous_state"]; ?></td>
                                <td style="text-align:left" ;><php echo $row["new_state"]; ?></td>
                            </tr>
                            <php
                        }
                    } else { ?>
                        <tr>
                            <td colspan="6"><php echo 'No logs recorded today.'; ?></td>
                        </tr>
                        <php
                    }

                        } else {
                            echo "No date selected.";
                        }
                    }

                    ?> -->
                </tbody>
            </table>
        </div>
    </div>

    <form id="dateForm" action="" method="post">
        <input type="hidden" id="selectedDate" name="selectedDate">
    </form>

    <div class="delAddProduct">
        <button class="inventoryLogBtn" id="backBtn" onclick="window.location.href = 'inventory.php';">Back
        </button>
    </div>


    <script>
        function filterTable() {
            var filterValue = document.getElementById("actionTypeFilter").value.toLowerCase(); // Convert to lowercase for case-insensitive comparison
            var tableRows = document.querySelectorAll("#inventoryTable tbody tr");

            // Loop through each table row and hide/show based on the filter value
            tableRows.forEach(function (row) {
                var actionType = row.cells[2].textContent.toLowerCase(); // Get the action type from the third cell (index 2)

                if (filterValue === "all" || actionType === filterValue) {
                    row.style.display = ""; // Show row
                } else {
                    row.style.display = "none"; // Hide row
                }
            });
        }
    </script>

    <script src="../js/inventory.js"></script>

    <script>
        $(function () {
            $("#datepicker").daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 2024,
                onSelect: function (dateText, inst) {
                    $("#selectedDate").val(dateText);
                    $("#dateForm").submit();
                }
            });
        });
    </script>


</body>

</html>