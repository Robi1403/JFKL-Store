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

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
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
                <img src="../assets/inventory_g.svg" alt=""><br>
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

    <!-- halion nalang style, nilaag ko lang para kung sain siya pwede ilaag HAHAHH -->
    <select id="actionTypeFilter" style="width: 20%; margin-left: 11%;" onchange="filterTable()">
        <option value="all">All</option>
        <option value="add">Add</option>
        <option value="update">Update</option>
        <option value="remove">Remove</option>
    </select>

    <!-- halion nalang style, nilaag ko lang para kung sain siya pwede ilaag HAHAHH -->
    <input type="text" id="datepicker" name="selectedDate" style="width: 20%; margin-left: 11%;"
        value="<?php echo empty($_POST['selectedDate']) ? '' : $_POST['selectedDate']; ?>">
    <button id="clearDateBtn">x</button>

    <div class="mainContainer">

        <div class="inventoryLog" style="max-height: 450px; overflow-y: auto;">
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
                    if (isset($_POST['selectedDate'])) {
                        $selectedDate = date('Y-m-d', strtotime($_POST['selectedDate']));

                        $select_query = "SELECT * FROM `inventory_log` WHERE DATE(date) = '$selectedDate'";

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
                                <td colspan="6"><?php echo 'No logs recorded for the selected date.'; ?></td>
                            </tr>
                            <?php
                        }
                    } else {
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
                                <td colspan="6"><?php echo 'No logs recorded.'; ?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
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
            var filterValue = document.getElementById("actionTypeFilter").value.toLowerCase(); 
            var tableRows = document.querySelectorAll("#inventoryTable tbody tr");

            tableRows.forEach(function (row) {
                var actionType = row.cells[2].textContent.toLowerCase(); 

                if (filterValue === "all" || actionType === filterValue) {
                    row.style.display = ""; 
                } else {
                    row.style.display = "none"; 
                }
            });
        }
    </script>

    <script src="../js/inventory.js"></script>

    <script type="text/javascript">
        $(function () {
            $("#datepicker").datepicker({
                onSelect: function (dateText, inst) {
                    $("#selectedDate").val(dateText);
                    $("#dateForm").submit();
                }
            });
        });
    </script>

    <script>
        document.getElementById('clearDateBtn').addEventListener('click', function () {
            document.getElementById('datepicker').value = '';
            document.getElementById('datepicker').placeholder = 'Select Date';

            window.location.href = window.location.href;
        });
    </script>
</body>

</html>