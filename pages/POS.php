<?php
session_start();
include ("PhpFunctions/connection.php");
include ("PhpFunctions/SaveTransaction.php");
include ("PhpFunctions/current_sales_transacHistory.php");

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
    <link rel="stylesheet" href="../css/pos.css?v=<?php echo time(); ?>">

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

        <div class="searchBar">
            <form action="">
                <input type="text" id="search" placeholder="Search">
                <button type="submit"><img src="../assets/search.svg" alt=""></button>
            </form>
        </div>

        <div class="right">
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
            <div class="displayDateTime">
                <div class="display-date">
                    <span id="day">day</span>,
                    <span id="daynum">00</span>
                    <span id="month">month</span>
                    <span id="year">0000</span>
                </div>
                <div class="display-time"></div>
            </div>
        </div>
    </div>
    <div class="SearchBg" id="SearchBg">
        <div class="SearchResult" id="SearchResult">
        </div>
    </div>

    <div class="mainContainer">
        <div class="sideBar">
            <div class="features">
                <div id="POSBtn" class="sbPOS">
                    <button id="POSBtn">
                        <img src="../assets/POS.svg" alt=""><br>
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
            <div class="logout">
                <div class="sbLogout">
                    <button id="logoutBtn">
                        <img src="../assets/logout.svg" alt=""><br>
                    </button>
                </div>
            </div>
        </div>

        <div class="productDisplay">


            <form class="category" id="categoryContainer" name="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <button class="categoryBtn" type="submit" name="category" value="All">All</button>
                <button class="categoryBtn" type="submit" name="category" value="Canned Goods">Canned Goods</button>
                <button class="categoryBtn" type="submit" name="category" value="Coffee">Coffee</button>
                <button class="categoryBtn" type="submit" name="category" value="Biscuits">Biscuits</button>
                <button class="categoryBtn" type="submit" name="category" value="Ice Cream">Ice Cream</button>
                <button class="categoryBtn" type="submit" name="category" value="Bread">Bread</button>
                <button class="categoryBtn" type="submit" name="category" value="Health & Beauty">Health & Beauty</button>
                <button class="categoryBtn" type="submit" name="category" value="Household & Cleaning Supplies">Household & Cleaning Supplies</button>
                <button class="categoryBtn" type="submit" name="category" value="PC Products">Personal Collection Products</button>
                <button class="categoryBtn" type="submit" name="category" value="Cold Drinks">Cold Drinks</button>
                <button class="categoryBtn" type="submit" name="category" value="Powdered Drinks">Powdered Drinks</button>
                <button class="categoryBtn" type="submit" name="category" value="Junk Foods">Junk Foods</button>
                <button class="categoryBtn" type="submit" name="category" value="Cigarettes">Cigarettes</button>
                <button class="categoryBtn" type="submit" name="category" value="Frozen Foods">Frozen Foods</button>
                <button class="categoryBtn" type="submit" name="category" value="Instant Noodles">Instant Noodles</button>
                <button class="categoryBtn" type="submit" name="category" value="Alcoholic Beverages">Alcoholic Beverages</button>
                <button class="categoryBtn" type="submit" name="category" value="Candies & Chocolates">Candies & Chocolates</button>
                <button class="categoryBtn" type="submit" name="category" value="Dairy Products">Dairy Products</button>
                <button class="categoryBtn" type="submit" name="category" value="Condiments & Sauces">Condiments & Sauces</button>
                <button class="categoryBtn" type="submit" name="category" value="Cooking Ingredients & Seasonings">Cooking Ingredients & Seasonings</button>
                <button class="categoryBtn" type="submit" name="category" value="Spreads & Fillings">Spreads & Fillings</button>
                <button class="categoryBtn" type="submit" name="category" value="School Supplies">School Supplies</button>
            </form>
            <div class="ItemView">

                <div class="products">
                    <?php
                    $category = $_POST['category'] ?? 'All';

                    if ($category == "All") {
                        $query = "SELECT * FROM inventory";
                    } else {
                        $query = "SELECT * FROM inventory WHERE category='$category'";
                    }

                        $result = mysqli_query($conn, $query);


                    while ($row = mysqli_fetch_array($result)) { ?>

                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="ItemCardView">
                            <div class="image">
                                <img src="../assets/InventoryItems/<?php echo $row['picture_url']; ?>">
                            </div>
                            <div class="productName">
                                <p><?php echo $row['product_name']; ?></p>
                            </div>
                            <div class="netWeight">
                                <p><?php echo $row['net_weight']; ?></p>
                            </div>
                            <div class="priceAddCart">
                                <div class="price">
                                    <p>₱<?php echo $row['retail_price']; ?></p>
                                </div>

                                <input type="hidden" class="ProductID" name="productId" value="<?php echo $row['product_id']; ?>">
                                <input type="hidden" name="quantity" value="1"> 
                                <button type="button" name="toCart" class="toCart"><img src="../assets/buttonAdd.svg"></button>
                            </div>
                        </form>

                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="cartSection">
            <div class="cart">
                <div class="cartLabel">
                    <p>Cart</p>
                    <div class="buttons">
                        <a href="POS.php?action=clearAll">New Transaction</a>
                    </div>
                </div>

                <?php
                if (isset($_GET['action'])) {
                    if ($_GET['action'] == "clearAll") {
                        unset($_SESSION['cart']);
                    }

                    if ($_GET['action'] == "remove") {
                        foreach ($_SESSION['cart'] as $key => $value) {
                            if ($value['id'] == $_GET['id']) {
                                unset($_SESSION['cart'][$key]);
                            }
                        }
                    }

                    if ($_GET['action'] == "decreaseQty") {
                        foreach ($_SESSION['cart'] as &$value) {
                            if ($value['id'] == $_GET['id']) {
                                if ($value['quantity'] > 1) {
                                    $value['quantity'] -= 1;
                                }
                            }
                        }
                        unset($value);
                    }

                    if ($_GET['action'] == "increaseQty") {
                        foreach ($_SESSION['cart'] as &$value) {
                            if ($value['id'] == $_GET['id']) {
                                $value['quantity'] += 1;
                            }
                        }
                        unset($value);
                    }

                }
                ?>

                <div class="orderList">


                    <?php
                    $SubTotal = 0;
                    $realCostofGoods = 0;
                    $numberOfItems = 0;
                    $quantity = 1;


                    if (!empty($_SESSION['cart'])) {

                        foreach ($_SESSION['cart'] as $key => $value) { ?>
                            <div class="container">
                                <img src="../assets/InventoryItems/<?php echo $value['picture_url'] ?>" alt="">

                                <div class="items">
                                    <h3>Item</h3>
                                    <h1><?php echo $value['product_name'] ?></h1>
                                    <h2><?php echo $value['net_weight'] ?></h2>
                                </div>

                                <div class="Price">
                                    <h3>Price</h3>
                                    <h1>₱<?php echo $value['retail_price'] ?></h1>
                                </div>

                                <div class="quantity">
                                    <h3>Quantity</h3>
                                    <div class="qty">
                                        <a href="POS.php?action=decreaseQty&id=<?php echo $value['id'] ?>">
                                            <img src="../assets/decreaseBtn.svg" alt=" ">
                                        </a>

                                        <p><?php echo $value['quantity'] ?></p>
                                        <a href="POS.php?action=increaseQty&id=<?php echo $value['id'] ?>" >
                                            <img src="../assets/buttonAdd.svg " alt="">
                                        </a>
                                        
                                    </div>
                                </div>

                                <div class="total">

                                    <?php
                                    $total = $value['retail_price'] * $value['quantity'];
                                    $CostOfGoods = $value['unitPrice'] * $value['quantity'];
                                    ?>

                                    <h3>Total</h3>
                                    <h1>₱<?php echo $total ?></h1>
                                </div>

                                <a href="POS.php?action=remove&id=<?php echo $value['id'] ?>" class="delete">
                                    <button>
                                        <img src="../assets/delete.svg" alt="">
                                    </button>
                                </a>
                            </div>
                            <?php

                            $SubTotal = $SubTotal + $total;
                            $realCostofGoods = $realCostofGoods + $CostOfGoods;
                            $numberOfItems = $numberOfItems + $value['quantity'];
                        }
                    }
                    ?>



                </div>

                <div class="CheckoutSection">
                    <div class="Subtotal">
                        <div class="lineDiv"></div>
                        <div class="CustomerAmount">
                            <h1>Amount Received</h1>
                            <input type="number" id="ClientAmount">
                        </div>
                        <div class="SubTotal">
                            <h1>Subtotal</h1>
                            <h1 id="OverAllTotal"><?php echo $SubTotal ?></h1>
                        </div>
                        <div class="lineDiv"></div>
                        <div class="Total">
                            <h1>Change</h1>
                            <h1 id="change">P 1,100</h1>
                        </div>
                    </div>
                    <div class="Checkoutbuttons">

                        <button id="Checkout" class="ProceedBtn" onclick="openSummaryModal()">Proceed</button>
                    </div>


                </div>
            </div>
        </div>


        <div class="addItem"></div>



        <div class="OrderSummary">
            <div class="OrderSummaryContainer">
                <p>Order Summary</p>
                <div class="SummaryContainer">
                    <table>
                        <tr>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                        <?php


                        if (!empty($_SESSION['cart'])) {

                            foreach ($_SESSION['cart'] as $key => $value) { ?>
                                <tr>
                                    <td>
                                        <?php echo $value['product_name'] ?>
                                    </td>

                                    <td>
                                        <?php echo $value['retail_price'] ?>
                                    </td>

                                    <td>
                                        <?php echo $value['quantity'] ?>
                                    </td>

                                    <?php
                                    $total = $value['retail_price'] * $value['quantity'];
                                    $CostOfGoods = $value['unitPrice'] * $value['quantity'];
                                    ?>
                                    <td>
                                        <?php echo $total ?>
                                    </td>
                                </tr>
                            <?php }
                        } else {
                            echo "<tr><td>Cart is empty</td></tr>";
                        }
                        ?>

                    </table>
                </div>

                <div class="AmountSummary">
                    <div class="TotalPayment">
                        <h2>Total</h2>
                        <h1><?php echo "₱ " . $SubTotal ?></h1>
                    </div>

                    <div class="dividerDIV"></div>

                    <div class="AmountReceived">
                        <h2>Amount Received</h2>
                        <h1 class="showReceive">0</h1>
                    </div>
                    <div class="dividerDIV"></div>

                    <div class="change">
                        <h2>Change</h2>
                        <h1 class="showChange">0</h1>
                    </div>
                </div>

                <div class="buttons">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"class="ConfirmSection">
                        <button class="BackBtn" onclick="cancel()">Back</button>
                        <button type="submit" name="ConfirmOrder" class="ConfirmBtn">Confirm Order</button>
                    </form>
                </div>

            </div>
        </div>

        <div class="successPrompt">
            <div class="sucessContainer">
                <img src="../assets/check.png" alt="">
                <h1>Success</h1>
                <a href="POS.php?action=clearAll">New Transaction</a>
            </div>
        </div>
    </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        
    </div>
        </div>
    </div>
        </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/script.js"></script>
    <script>
        // $(document).ready(function () {
        //     $(document).on('click', '.toCart', function (event) {

        //         event.preventDefault();
        //         var id = $(this).siblings(".ProductID").val();
        //         console.log(id);
        //         $.ajax({
        //             method: 'POST',
        //             url: 'PhpFunctions/modal.php',
        //             data: { id: id },
        //             success: function (response) {
        //                 $(".addItem").css("display", "flex");
        //                 $('.addItem').html(response);
        //             },
        //             error: function (xhr, status, error) {
        //                 alert("An error occurred: " + error);
        //             }
        //         });
        //     });
        // });

        $(document).ready(function () {
            $(document).on('click', '.ConfirmBtn', function (event) {
                event.preventDefault();
                $.ajax({
                    method: 'POST',
                    url: '',
                    data: {
                        action: 'saveData',
                        numberOfItems: '<?php echo $numberOfItems; ?>',
                        SubTotal: '<?php echo $SubTotal; ?>',
                        realCostofGoods: '<?php echo $realCostofGoods; ?>',

                    },
                    success: function (response) {
                        $(".OrderSummary").css("display", "none");
                        $(".successPrompt").css("display", "flex");
                    },
                    error: function (xhr, status, error) {
                        alert("An error occurred: " + error);
                    }
                });
            });
        });

    </script>

    <script>
        function decreaseQuantity() {
            var inputElement = document.querySelector('.quantityInput');
            var currentValue = parseInt(inputElement.value);
            if (currentValue > 1) {
                inputElement.value = currentValue - 1;
            }
        }

        function increaseQuantity() {
            var inputElement = document.querySelector('.quantityInput');
            var currentValue = parseInt(inputElement.value);
            inputElement.value = currentValue + 1;
        }

        function exitModal() {
            var cancel = document.querySelector('.addItem');
            cancel.style.display = 'none';
        }

        function cancel() {
            var cancel = document.querySelector('.OrderSummary');
            cancel.style.display = 'none';
        }

        function openSummaryModal() {
            var show = document.querySelector('.OrderSummary');
            show.style.display = 'flex';
        }

    </script>

<script>
    function updateDate() {
        let today = new Date();

        let dayName = today.getDay(),
            dayNum = today.getDate(),
            month = today.getMonth(),
            year = today.getFullYear();

        const months = [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December",
        ];
        const dayWeek = [
            "Sunday",
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
            "Saturday",
        ];
        const IDCollection = ["day", "daynum", "month", "year"];
        const val = [dayWeek[dayName], dayNum, months[month], year];
        for (let i = 0; i < IDCollection.length; i++) {
            document.getElementById(IDCollection[i]).textContent = val[i];
        }
    }

    function updateTime() {
        const displayTime = document.querySelector(".display-time");
        let time = new Date();
        displayTime.innerText = time.toLocaleTimeString("en-US", { hour12: true });
    }

    function updateDateTime() {
        updateDate(); 
        updateTime(); 
        setTimeout(updateDateTime, 1000);
    }

    updateDateTime();
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const categoryContainer = document.querySelector('.category');

        categoryContainer.addEventListener('wheel', function(event) {
            if (event.deltaY > 0) {
                categoryContainer.scrollLeft += 50;
            } else {
                categoryContainer.scrollLeft -= 50;
            }
            event.preventDefault();
        });
    });
    </script>

</body>

</html>