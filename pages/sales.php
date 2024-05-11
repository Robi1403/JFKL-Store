<?php
include ("PhpFunctions/connection.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/sales.css">
    <title>JFKL Store</title>
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
            <div class="displayDateTime">
                <div class="display-date">
                    <span id="day">day</span>,
                    <span id="daynum">00</span>
                    <span id="month">month</span>
                    <span id="year">0000</span>
                </div>
                <div class="display-time"></div>
            </div>
            <div class="todayGrossSale">
                <p>Today's Gross Sale: </p>
                <p><span>P1,000,000,000.00</span></p>
            </div>

        </div>
    </div>

    <div class="sideBar">
        <div class="features">
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
                    <img src="../assets/sales_w.svg" alt=""><br>
                    <strong>Sales</strong>
                </button>
            </div>
        </div>
        <div class="logout">
            <div class="sbLogout">
                <button>
                    <img src="../assets/logout.svg" alt=""><br>
                </button>
            </div>

        </div>
    </div>

    <div class="mainContainer">
        <div class="salesDisplay">
            <div class="sales">
                <div class="salesStats">
                    <div class="labelgroup">
                        <div class="salesStatsLabel"><p>Sales Statistics</p></div>
                        <div class="dropdown">
                            <div class="dropdown-select">
                                <span class="select">Daily</span>
                                <div class="caret"></div>
                            </div>
                            <ul class="dropdown-list">
                                <li>Daily</li>
                                <li>Monthly</li>
                                <li>Yearly</li>
                            </ul>
                        </div>
                        
                    </div>
                    
                    <div class="lineShape"></div>

                    <div class="mainContainer">
                        <div class="container1">
                            <div class="grossSale">
                                <h1>P 456.00</h1>
                                <p>Todays <strong>Gross Sale</strong></p>

                            </div>
                            <div class="order">
                                <h1>12</h1>
                                <p><strong>Orders</strong> Today</p>
                            </div>
                        </div>
                        <div class="container2">
                            <div class="totalProfit">
                                <h1>P 5,432.00</h1>
                                <p>Total <strong>Profit</strong></p>
                            </div>
                            <div class="others">
                                <h1>567</h1>
                                <p>Total <strong>Products</strong></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="stockTracker">
                    <div class="stocksLabel">
                        <p>Stock Tracker</p>
                    </div>
                    <div class="lineShape"></div>
                    <div class="mainContainer">
                        <table class="stocksTable">
                            <thead>
                                <tr>
                                    <th class="col1">Product ID</th>
                                    <th class="col2">Product Name</th>
                                    <th class="col3">Net Weight</th>
                                    <th class="col4">Category</th>
                                    <th class="col5">Stock</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $select_query = "SELECT * FROM `inventory`";

                                $result = mysqli_query($conn, $select_query);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) { ?>
                                        <?php
                                        if ($row["stock"] <= 5) { ?>
                                            <tr>
                                                <td class="productID" id="productID"><?php echo $row["product_id"]; ?></td>
                                                <td class="productName" id="productName"><?php echo $row["product_name"]; ?></td>
                                                <td class="netWeight" id="netWeight"><?php echo $row["net_weight"] ?? '-'; ?></td>
                                                <td class="category" id="category"><?php echo $row["category"]; ?></td>
                                                <td class="stock" id="stock">
                                                    <p><?php echo $row["stock"]; ?></p>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                        </form>
                                        <?php
                                    }
                                } else {
                                    echo "<tr><td>No products are low on stock</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="transactions">
                <div class="transactionLabel">
                    <p>Transaction History</p>
                </div>
                <div class="lineShape"></div>
                <div class="mainContainer">
                    <table class="transactionTable">
                        <thead>
                            <tr>
                                <th class="col1">Transaction No.</th>
                                <th class="col2">No. of Items</th>
                                <th class="col3">Total</th>
                                <th class="col4">Date</th>
                                <th class="col5"></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $select_query = "SELECT * FROM `transaction_history`";

                            $result = mysqli_query($conn, $select_query);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) { ?>
                                        <tr>
                                            <td class="transactionNum" id="transactionNum"><?php echo $row["transaction_number"]; ?></td>
                                            <td class="numItems" id="numItems"><?php echo $row["number_of_items"]; ?></td>
                                            <td class="total" id="total"><?php echo $row["gross_sales"] ?? '-'; ?></td>
                                            <td class="date" id="date"><?php echo $row["date"]; ?></td>
                                            <td class="seeDetails" id="seeDetails"><button>See Details</button></td>
                                        </tr>
                                    <?php
                                }
                            } else {
                                echo "<tr><td>No record of transaction.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/sales.js"></script>
</body>

</html>