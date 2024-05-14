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
            <div class="shape"></div>
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
            <select id="actionTypeFilter" onchange="filterTable()">
                <option value="all">All</option>
                <option value="add">Add</option>
                <option value="update">Update</option>
                <option value="remove">Remove</option>
            </select>

            <input type="text" id="datepicker" name="selectedDate" placeholder="Select Date" />
            <button id="clearDateBtn">x</button>
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
                    if (isset($_POST['selectedDate']) && $_POST['selectedDate'] !== '') {
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
                        date_default_timezone_set('Asia/Manila');
                        $currentDateTime = date('F j, Y | h:i A');

                        $select_query = "SELECT * FROM `inventory_log` WHERE DATE(date) = '$currentDateTime'";

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

    <script>
        $(function () {
            var currentDate = new Date();
            var currentFormattedDate = currentDate.getFullYear() + '-' + ('0' + (currentDate.getMonth() + 1)).slice(-2) + '-' + ('0' + currentDate.getDate()).slice(-2);

            var initialDate = '<?php echo isset($_POST['selectedDate']) ? date('Y-m-d', strtotime($_POST['selectedDate'])) : ''; ?>';

            $("#datepicker").daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 2024,
                startDate: initialDate || currentFormattedDate,
                locale: {
                    format: 'YYYY-MM-DD'
                }
            });

            $('#datepicker').on('apply.daterangepicker', function (ev, picker) {
                var selectedDate = picker.startDate.format('YYYY-MM-DD');
                $("#selectedDate").val(selectedDate);
                $("#dateForm").submit();
            });

            $('#clearDateBtn').on('click', function () {
                $("#datepicker").val(currentFormattedDate);
                $("#selectedDate").val(currentFormattedDate);
                $("#dateForm").submit();
            }); 
        });
    </script>

    <script>
        // document.getElementById('clearDateBtn').addEventListener('click', function () {
        //     document.getElementById('datepicker').value = '';
        //     document.getElementById('datepicker').placeholder = 'Select Date';
        //     $("#selectedDate").val('');
        //     $("#dateForm").submit();
        // });
    </script>
</body>

</html>
