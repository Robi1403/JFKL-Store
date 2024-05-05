<?php
session_start();
include("PhpFunctions/connection.php");
include("PhpFunctions/modal.php");


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
            <div class="shape">

            </div>
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
            <div class="todayGrossSaleLabel">
                <p>Today's Gross Sale: </p>
            </div>
            <div class="todayGrossSale">
                <p><strong>P969.00</strong></p>
            </div>
            <div class="date">
                <p>May 13, 2024</p>
            </div>
        </div>
    </div>
    <div class="SearchBg" id="SearchBg">
        <div class="SearchResult"  id="SearchResult">
        </div>
    </div>
    
    <div class="mainContainer">
        <div class="sideBar">
            <div id="POSBtn" class="sbPOS">
                <button id="POSBtn">
                    <img src="../assets/POS.svg" alt=""><br>
                    <strong>POS</strong>
                </button>
            </div>
            <div class="sbInventory">
                <button id="inventoryBtn">
                    <img src="../assets/inventory.svg" alt=""><br>
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

        <div class="productDisplay">

            <form class="category" id="categoryContainer" name="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <button class="categoryBtn" type="submit" name="category" value="All">All</button>
                <button class="categoryBtn" type="submit" name="category" value="Canned Goods">Canned Goods</button>
                <button class="categoryBtn" type="submit" name="category" value="Coffee">Coffee</button>
                <button class="categoryBtn" type="submit" name="category" value="Biscuits">Biscuits</button>
                <button class="categoryBtn" type="submit" name="category" value="Ice Cream">Ice Cream</button>
                <button class="categoryBtn" type="submit" name="category" value="Bread">Bread</button>
                <button class="categoryBtn" type="submit" name="category" value="Health and Beauty">Health and Beauty</button>
                <button class="categoryBtn" type="submit" name="category" value="Household & Cleaning Supply">Household & Cleaning Supply</button>
                <button class="categoryBtn" type="submit" name="category" value="Personal Care Products">Personal Care Products</button>
                <button class="categoryBtn" type="submit" name="category" value="Drinks">Drinks</button>
                <button class="categoryBtn" type="submit" name="category" value="Powered Drinks">Powered Drinks</button>
                <button class="categoryBtn" type="submit" name="category" value="Junkfoods">Junkfoods</button>
                <button class="categoryBtn" type="submit" name="category" value="Cigarettes">Cigarettes</button>
                <button class="categoryBtn" type="submit" name="category" value="Frozen Foods">Frozen Foods</button>
                <button class="categoryBtn" type="submit" name="category" value="Instant Noodles">Instant Noodles</button>
                <button class="categoryBtn" type="submit" name="category" value="Alcoholic Beverages">Alcoholic Beverages</button>
                <button class="categoryBtn" type="submit" name="category" value="Candies & Chocolates">Candies & Chocolates</button>
                <button class="categoryBtn" type="submit" name="category" value="Dairy Products">Dairy Products</button>
                <button class="categoryBtn" type="submit" name="category" value="Condiments">Condiments</button>
                <button class="categoryBtn" type="submit" name="category" value="Cooking Ingredients & Seasoning">Cooking Ingredients & Seasoning</button>
                <button class="categoryBtn" type="submit" name="category" value="Spreads and Fillings">Spreads and Fillings</button>
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
                </div>
                <div class="buttons">
                    <button>New Order</button>
                    <button>Hold Order</button>
                    <a href="POS.php?action=clearAll">Clear</a>
                </div>

                <?php
                if (isset($_GET['action']) && $_GET['action'] == "clearAll") {
                    unset($_SESSION['cart']);
                }

                ?>

                <?php

                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['AddToCart'])) {
                    // Create a session array to store product data
                    $session_array = array(
                        'id' => $_POST['productID'],
                        'product_name' => $_POST['productName'],
                        'retail_price' => $_POST['productRetailPrice'],
                        'picture_url' => $_POST['productURL'],
                        'net_weight' => $_POST['productNetweight'],
                        'quantity' => $_POST['Quantity'],
                        'unitPrice' => $_POST['productUnitPrice'],

                    );

                    // Check if the session cart already exists
                    if (isset($_SESSION['cart'])) {
                        // If it exists, add the new item to the cart array
                        $_SESSION['cart'][] = $session_array;
                    } else {
                        // If it doesn't exist, create the cart array and add the item
                        $_SESSION['cart'] = array($session_array);
                    }
                }
                ?>

                <div class="orderList">
                    
                
                    <?php

                    var_dump($_SESSION['cart']);

                    $SubTotal = 0;
                    $realCostofGoods = 0;
                    $numberOfItems = 0;
                    $quantity = 1;


                    function add($quantity){
                        return $quantity += 1;
                    }
                    function minus($quantity){
                        return $quantity -= 1;
                    }

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
                                    <h1>₱<?php echo  $value['retail_price']  ?></h1>
                                   
                                </div>

                                <div class="quantity">
                                    <h3>Quantity</h3>
                                    <div class="qty">
                                        <button>
                                        <img src="../assets/decreaseBtn.svg" alt=" ">
                                        </button>
                                        
                                        <input type="number" value="1">
                                        <button>
                                            <img src="../assets/buttonAdd.svg " alt="">
                                        </button>
                                        
                                    </div>
                                </div>

                                <div class="total">

                                    <?php
                                    $total = $value['retail_price'] * $value['quantity'];
                                    $CostOfGoods =  $value['unitPrice']  * $value['quantity'];
                                    ?>

                                    <h3>Total</h3>
                                    <h1>₱<?php echo $total ?></h1>
                                </div>

                                <div class="select">
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </div>
                            </div>
                    <?php

                            $SubTotal = $SubTotal + $total;
                            $realCostofGoods =  $realCostofGoods + $CostOfGoods;
                            $numberOfItems += 1;
                        }
                    }
                    echo $realCostofGoods ;
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
                        <button class="HoldOrder">Hold Order</button>
                        <button id="Checkout" class="ProceedBtn">Proceed</button>
                    </div>

                </div>
            </div>
        </div>
   
        <div class="addItem">

                        <!-- <div class="ItemContainer">
                                <div class="itemInfo">
                                    <img src="../assets/samplePic.svg" alt="">
                                    <div class="Infos">
                                        <h1>aRGRNTINA</h1>
                                        <h3>150g</h3>
                                        <h1>100</h1>
                                    </div>
                                </div>
                                <div class="ItemQuantity">
                                    <div class="addQuantity">
                                        <h3>Quantity</h3>
                                        <div class="addMinusQuantity">0
                                        <button onclick="decreaseQuantity(this)">
                                            <img src="../assets/decreaseBtn.svg" alt="">
                                        </button>
                                        
                                        <input type="number" id="quantityInput" name="Quantity" value="<?php echo $quantity ?>">
                                        
                                        <button onclick="increaseQuantity(this)">
                                            <img src="../assets/buttonAdd.svg" alt="">
                                        </button>
                                            
                                        </div>
                                    </div>
                                    <div class="addToCart">
                                        <button class="cancel" >Cancel</button>
                                        <button class="toCart">Add to cart</button>
                                    </div>
                                </div>
                            </div> -->

            
            </div>

    
          
        <div class="OrderSummary">
            <div class="OrderSummaryConatiner">
                <h1>Order Summary</h1>
                <div class="SummaryContainer">
                    <table>
                        <tr>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>

                        <tr>
                            <td>
                                Argentina Meat Loaf
                            </td>

                            <td>
                                P 27.00
                            </td>

                            <td>
                                1
                            </td>
                            <td>
                                P 27.00
                            </td>
                        </tr>


                    </table>

                </div>

                <div class="AmountSummary">
                    <div class="TotalPayment">
                        <h2>Total</h2>
                        <h1>P 1,024.00</h1>
                    </div>

                    <div class="dividerDIV"></div>

                    <div class="AmountReceived">
                        <h2>Amount Receive</h2>
                        <h1>P 1,024.00</h1>
                    </div>
                    <div class="dividerDIV"></div>

                    <div class="change">
                        <h2>Change</h2>
                        <h1>P 1,024.00</h1>
                    </div>
                </div>

                <div class="ConfirmSection">
                    <button class="BackBtn">Back</button>
                    <button class="ConfirmBtn">Confirm Order</button>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script src="../js/script.js"></script>
        <script>
        $(document).ready(function() {
            $(document).on('click', '.toCart', function(event) { 

                event.preventDefault(); 
                var id = $(this).siblings(".ProductID").val();
                $.ajax({
                    method: 'POST',
                    url: 'PhpFunctions/modal.php',
                    data: {id: id},
                    success: function(response) {
                        $(".addItem").css("display", "flex");
                        $('.addItem').html(response);
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