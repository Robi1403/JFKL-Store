
<?php
include ("PhpFunctions/connection.php");
include ("PhpFunctions/current_sales_transacHistory.php");
include ("PhpFunctions/transactionDetails.php");
include ("PhpFunctions/login.php");
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
    header('Location: LoginPage.php');
    exit;
}  
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/storeLogo.svg">
    <link rel="stylesheet" href="../css/sales.css">
    <title>JFKL Store</title>

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
                <p><span><?php if (isset($totalSales)) {
                    echo $totalSales; ?></span></p>
                    <?php
                } else { ?>
                    <p><span><?php echo $currentTotalSales; ?></span></p>
                    <?php
                }
                ?>
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
                <a href="sales.php?action=logout" id="logoutBtn">
                    <img src="../assets/logout.svg" alt=""><br>
                </a>
            </div>
        </div>
    </div>

    <div class="mainContainer">
        <div class="salesDisplay">
            <div class="sales">
                <div class="salesStats">
                    <div class="labelgroup">
                        <div class="salesStatsLabel">
                            <p>Sales Statistics</p>
                        </div>
                        <div id="reportrange" class="daterange">
                            <img src="../assets/calendar.svg" alt="">
                            <span></span> <i class="fa fa-caret-down"></i>
                        </div>
                    </div>

                    <div class="lineShape"></div>

                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $startDate = $_POST['startDate'];
                        $endDate = $_POST['endDate'];

                        $totalTransactions = 0;
                        $totalItems = 0;
                        $totalSales = 0;
                        $totalProfit = 0;

                        if ($startDate == $endDate) {
                            $search_query = "SELECT COUNT(*) AS total_transactions, SUM(number_of_items) AS total_items, SUM(gross_sales) AS total_sales, SUM(profit) AS total_profit FROM `transaction_history` WHERE `date` = '$startDate'";
                        } else {
                            $search_query = "SELECT COUNT(*) AS total_transactions, SUM(number_of_items) AS total_items, SUM(gross_sales) AS total_sales, SUM(profit) AS total_profit FROM `transaction_history` WHERE `date` BETWEEN '$startDate' AND '$endDate'";
                        }

                        $search_result = mysqli_query($conn, $search_query);
                        if ($search_result) {
                            if (mysqli_num_rows($search_result) > 0) {
                                $row = mysqli_fetch_assoc($search_result);
                                $totalTransactions = $row['total_transactions'];
                                $totalItems = $row['total_items'];
                                $totalSales = $row['total_sales'];
                                $totalProfit = $row['total_profit'];

                                $totalTransactions = $totalTransactions ?? 0;
                                $totalItems = $totalItems ?? 0;
                                $totalSales = $totalSales ?? 0;
                                $totalProfit = $totalProfit ?? 0;

                            }
                        } else {
                            echo "<script>alert('Error searching sales data: " . mysqli_error($conn) . "');</script>";
                        }
                    }
                    ?>

                    <div class="mainContainer">
                        <div class="container1">
                            <div class="grossSale">
                                <h1><?php
                                if (isset($totalSales)) {
                                    echo $totalSales; ?></h1>
                                    <?php
                                    date_default_timezone_set('Asia/Manila');
                                    $currentDate = date("Y-m-d");

                                    if ($startDate == $currentDate && $endDate == $currentDate) { ?>
                                        <p>Today's <strong>Gross Sale</strong></p>
                                    <?php } else { ?>
                                        <p> Total <strong>Gross Sale</strong><span></p>
                                        <?php
                                    }
                                } else { ?>
                                    <h1><?php echo $currentTotalSales; ?></h1>
                                    <p>Today's <strong>Gross Sale</strong></p>
                                    <?php
                                }
                                ?>

                            </div>

                            <div class="order">
                                <h1><?php
                                if (isset($totalTransactions)) {
                                    echo $totalTransactions; ?></h1>
                                    <?php
                                    date_default_timezone_set('Asia/Manila');
                                    $currentDate = date("Y-m-d");

                                    if ($startDate == $currentDate && $endDate == $currentDate) { ?>
                                        <p><strong>Orders</strong> Today</p>
                                    <?php } else { ?>
                                        <p> Total <strong>Orders</strong><span></p>
                                        <?php
                                    }
                                } else { ?>
                                    <h1><?php echo $currentTotalTransactions; ?></h1>
                                    <p><strong>Orders</strong> Today</p>
                                    <?php
                                }
                                ?>

                            </div>
                        </div>
                        <div class="container2">
                            <div class="totalProfit">
                                <h1><?php echo isset($totalProfit) ? $totalProfit : $currentTotalProfit; ?></h1>
                                <p>Total <strong>Profit</strong></p>
                            </div>
                            <div class="others">
                                <h1><?php echo isset($totalItems) ? $totalItems : $currentTotalItems; ?></h1>
                                <p>Total <strong>Products Sold</strong></p>
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
                                <th class="col3">Gross Sales</th>
                                <th class="col3">Profit</th>
                                <th class="col4">Date</th>
                                <th class="col5"></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($totalTransactions)) {
                                if ($startDate == $endDate) {
                                    $select_query = "SELECT * FROM `transaction_history` WHERE `date` = '$startDate'";
                                } else {
                                    $select_query = "SELECT * FROM `transaction_history` WHERE `date` BETWEEN '$startDate' AND '$endDate'";
                                }

                                $result = mysqli_query($conn, $select_query);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) { ?>
                                        <tr>
                                            <td class="transactionNum" id="transactionNum"><?php echo $row["transaction_number"]; ?>
                                            </td>
                                            <td class="numItems" id="numItems"><?php echo $row["number_of_items"]; ?></td>
                                            <td class="total" id="total"><?php echo $row["gross_sales"] ?? '-'; ?></td>
                                            <td class="profit" id="profit"><?php echo $row["profit"] ?? '-'; ?></td>
                                            <td class="date" id="date"><?php echo $row["date"]; ?></td>
                                            <td class="seeDetails" id="seeDetails"><button type="button" name="seeProductDetails" class="ProductDetails" data-transaction="<?php echo $row['transaction_number']; ?>">See Details</button></td>

                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "<tr><td>No record of transaction</td></tr>";
                                }
                            } else {
                                $select_query = "SELECT * FROM `transaction_history` WHERE `date` = '$currentDate'";
                                $result = mysqli_query($conn, $select_query);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <tr>
                                        <td class="transactionNum" id="transactionNum"><?php echo $row["transaction_number"]; ?>
                                            </td>
                                            <td class="numItems" id="numItems"><?php echo $row["number_of_items"]; ?></td>
                                            <td class="total" id="total"><?php echo $row["gross_sales"] ?? '-'; ?></td>
                                            <td class="profit" id="profit"><?php echo $row["profit"] ?? '-'; ?></td>
                                            <td class="date" id="date"><?php echo $row["date"]; ?></td>
                                            <td class="seeDetails" id="seeDetails"><button type="button" name="seeProductDetails" class="ProductDetails" data-transaction="<?php echo $row['transaction_number']; ?>">See Details</button></td>
                                        </tr>
                                        <?php
                                    }
                                }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="TransactionDetails">
    
        </div>

        
    </div>

    <form id="dateform" name="dateform" action="" method="POST">
        <input type="hidden" id="startDate" name="startDate">
        <input type="hidden" id="endDate" name="endDate"> 
    </form>

    <script src="../js/sales.js"></script>
    <script>
            $(document).ready(function() {
                $(document).on('click', '.ProductDetails', function(event) { 
                    event.preventDefault(); 
                    var id = $(this).data("transaction");
                    $.ajax({
                        method: 'POST',
                        url: 'PhpFunctions/transactionDetails.php',
                        data: {id: id},
                        success: function(response) {
                            $(".TransactionDetails").css("display", "flex");
                            $('.TransactionDetails').html(response);
                        },
                        error: function(xhr, status, error) {
                            alert("An error occurred: " + error); 
                        }
                    });
                });
            });
    </script>
</body>

</html>
