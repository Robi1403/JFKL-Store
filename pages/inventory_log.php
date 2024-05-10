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
                <p>Today's Gross Sale: </p>
            </div>
            <div class="todayGrossSale">
                <p><strong>P969.00</strong></p>
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

    <div class="mainContainer">
        <div class="inventoryLog">
            <table class="inventoryTable">
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
                    $select_query = "SELECT * FROM `inventory_log`";

                    $result = mysqli_query($conn, $select_query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row["log_id"]; ?></td>
                                <td><?php echo $row["product_id"]; ?></td>
                                <td><?php echo $row["action_type"]; ?></td>
                                <td><?php echo $row["date"] ?? '-'; ?></td>
                                <td style="text-align:left";><?php echo $row["previous_state"]; ?></td>
                                <td style="text-align:left";><?php echo $row["new_state"]; ?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="delAddProduct">
        <button class="inventoryLogBtn" id="backBtn" onclick="window.location.href = 'inventory.php';">Back </button>
    </div>

    <script src="../js/inventory.js"></script>

</body>

</html>