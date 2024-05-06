<?php
session_start();
include ("PhpFunctions/connection.php");

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

            <form class="category" id="categoryContainer" name="form"
                action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <button class="categoryBtn" type="submit" name="category" value="All">All</button>
                <button class="categoryBtn" type="submit" name="category" value="Canned Goods">Canned Goods</button>
                <button class="categoryBtn" type="submit" name="category" value="Coffee">Coffee</button>
                <button class="categoryBtn" type="submit" name="category" value="Biscuits">Biscuits</button>
                <button class="categoryBtn" type="submit" name="category" value="Ice Cream">Ice Cream</button>
                <button class="categoryBtn" type="submit" name="category" value="Bread">Bread</button>
                <button class="categoryBtn" type="submit" name="category" value="Health and Beauty">Health and
                    Beauty</button>
                <button class="categoryBtn" type="submit" name="category" value="Household & Cleaning Supply">Household
                    & Cleaning Supply</button>
                <button class="categoryBtn" type="submit" name="category" value="Personal Care Products">Personal Care
                    Products</button>
                <button class="categoryBtn" type="submit" name="category" value="Drinks">Drinks</button>
                <button class="categoryBtn" type="submit" name="category" value="Powered Drinks">Powered Drinks</button>
                <button class="categoryBtn" type="submit" name="category" value="Junkfoods">Junkfoods</button>
                <button class="categoryBtn" type="submit" name="category" value="Cigarettes">Cigarettes</button>
                <button class="categoryBtn" type="submit" name="category" value="Frozen Foods">Frozen Foods</button>
                <button class="categoryBtn" type="submit" name="category" value="Instant Noodles">Instant
                    Noodles</button>
                <button class="categoryBtn" type="submit" name="category" value="Alcoholic Beverages">Alcoholic
                    Beverages</button>
                <button class="categoryBtn" type="submit" name="category" value="Candies & Chocolates">Candies &
                    Chocolates</button>
                <button class="categoryBtn" type="submit" name="category" value="Dairy Products">Dairy Products</button>
                <button class="categoryBtn" type="submit" name="category" value="Condiments">Condiments</button>
                <button class="categoryBtn" type="submit" name="category"
                    value="Cooking Ingredients & Seasoning">Cooking Ingredients & Seasoning</button>
                <button class="categoryBtn" type="submit" name="category" value="Spreads and Fillings">Spreads and
                    Fillings</button>
                <button class="categoryBtn" type="submit" name="category" value="School Supplies">School
                    Supplies</button>
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

                        <form method="post" id="itemView" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                            class="ItemCardView">
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
                                <input type="hidden" name="productId" value="<?php echo $row['product_id']; ?>">
                                <input type="hidden" name="productName" value="<?php echo $row['product_name']; ?>">
                                <input type="hidden" name="netWeight" value="<?php echo $row['net_weight']; ?>">
                                <input type="hidden" name="productRetailPrice" value="<?php echo $row['retail_price']; ?>">
                                <input type="hidden" name="productUnitPrice" value="<?php echo $row['unit_price']; ?>">
                                <input type="hidden" name="productURL" value="<?php echo $row['picture_url']; ?>">
                                <input type="hidden" name="quantity" value="1">

                                <button type="submit" name="AddToCart" class="showthemodal"><img
                                        src="../assets/buttonAdd.svg"></button>
                            </div>
                        </form>



                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>

        <script>

            document.addEventListener("DOMContentLoaded", function () {
                // Select all buttons with the class showModalButton
                var showModalButtons = document.querySelectorAll(".showthemodal");

                // Select the modal by its ID
                var modal = document.getElementById("modalmodal");

                // Add click event listener to each button
                showModalButtons.forEach(function (button) {
                    button.addEventListener("click", function () {
                        event.preventDefault();


                        // Traverse up the DOM to the parent form
                        var parentForm = button.closest("form");

                        // Find the hidden input field within the form by name
                        var productIdInput = parentForm.querySelector("input[name='productId']");
                        var productNameInput = parentForm.querySelector("input[name='productName']");
                        var netWeight = parentForm.querySelector("input[name='netWeight']");
                        var productRetailPrice = parentForm.querySelector("input[name='productRetailPrice']");
                        var productUnitPrice = parentForm.querySelector("input[name='productUnitPrice']");
                        var productURL = parentForm.querySelector("input[name='productURL']");
                        var quantity = parentForm.querySelector("input[name='quantity']");

                        // Retrieve the value of the hidden input field
                        var productId = productIdInput.value;
                        var productName = productNameInput.value;
                        var netWeight = netWeight.value;
                        var productRetailPrice = productRetailPrice.value;
                        var productUnitPrice = productUnitPrice.value;
                        var productURL = productURL.value;
                        var quantity = quantity.value;

                        // alert("Product ID: " + productId +
                        //     "\nProduct Name: " + productName +
                        //     "\nNet Weight: " + netWeight +
                        //     "\nRetail Price: " + productRetailPrice +
                        //     "\nUnit Price: " + productUnitPrice +
                        //     "\nProduct URL: " + productURL +
                        //     "\nQuantity: " + quantity);

                        document.getElementById("productIdHidden").value = productId;
                        document.getElementById("productNameHidden").value = productName;
                        document.getElementById("netWeightHidden").value = netWeight;
                        document.getElementById("productRetailPriceHidden").value = productRetailPrice;
                        document.getElementById("productUnitPriceHidden").value = productUnitPrice;
                        document.getElementById("quantityHidden").value = quantity;
                        document.getElementById("productURLHidden").value = productURL;

                        // Populate the modal elements with the retrieved data
                        document.getElementById("productNameInfo").textContent = productName;
                        document.getElementById("netWeightInfo").textContent = netWeight;
                        document.getElementById("productRetailPriceInfo").textContent = "₱" + productRetailPrice;

                        // Set the src attribute of the img element
                        var imgElement = document.getElementById("productImage");
                        imgElement.src = "../assets/InventoryItems/" + productURL;

                        // Change the display style of the modal
                        modal.style.display = "flex";
                    });
                });

                var forms = document.querySelectorAll(".itemView form");

                // Add submit event listener to each form
                forms.forEach(function (form) {
                    form.addEventListener("submit", function (event) {
                        // Prevent the default form submission
                        event.preventDefault();
                    });
                });

            });
        </script>

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
                        'id' => $_POST['productId'],
                        'product_name' => $_POST['productName'],
                        'unit_price' => $_POST['productUnitPrice'],
                        'retail_price' => $_POST['productRetailPrice'],
                        'picture_url' => $_POST['productURL'],
                        'net_weight' => $_POST['netWeight'],
                        'quantity' => $_POST['quantity'],

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
                    $SubTotal = 0;
                    $numberOfItems = 0;
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

                                        <img src="../assets/decreaseBtn.svg" alt=" ">
                                        <input type="number" name="quantity" value="1">
                                        <img src="../assets/buttonAdd.svg " alt="">
                                    </div>
                                </div>

                                <div class="total">

                                    <?php
                                    $total = $value['retail_price'] * $value['quantity'];
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
                            $numberOfItems += 1;
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
                        <button class="HoldOrder">Hold Order</button>
                        <button id="Checkout" class="ProceedBtn">Proceed</button>
                    </div>

                </div>
            </div>
        </div>

        <?php

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['AddToCart'])) {
            // Check if the product ID is set
            if (isset($_POST['productId'])) {
                // Escape the product ID to prevent SQL injection
                $productId = mysqli_real_escape_string($conn, $_POST['productId']);

                // Query to fetch product details based on the product ID
                $query = "SELECT * FROM inventory WHERE product_id = '$productId'";
                $result = mysqli_query($conn, $query);

                // Check if the query was successful
                if ($result) {
                    // Fetch the product details
                    $productData = mysqli_fetch_assoc($result);
                } else {
                    // Handle query error
                    echo "Error: " . mysqli_error($conn);
                }
            } else {
                // Handle missing product ID
                echo "Product ID is missing.";
            }
        }
        ?>

        <!-- Your HTML code with the form -->
        <div id="modalmodal" class="modalmodal">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="ItemContainer">
                <input type="hidden" name="productId" id="productIdHidden">
                <input type="hidden" name="productName" id="productNameHidden">
                <input type="hidden" name="netWeight" id="netWeightHidden">
                <input type="hidden" name="productRetailPrice" id="productRetailPriceHidden">
                <input type="hidden" name="productUnitPrice" id="productUnitPriceHidden">
                <input type="hidden" name="quantity" id="quantityHidden">
                <input type="hidden" name="productURL" id="productURLHidden">

                <!-- Display product details fetched from the database -->
                <div class="itemInfo">
                    <img src="../assets/InventoryItems/" alt="" id="productImage">
                    <div class="Infos">
                        <h1 id="productNameInfo"></h1>
                        <h3 id="netWeightInfo"></h3>
                        <h1 id="productRetailPriceInfo">₱</h1>
                    </div>
                </div>
                <div class="ItemQuantity">
                    <div class="addQuantity">
                        <h3>Quantity</h3>
                        <div class="addMinusQuantity">
                            <button type="button" onclick="decreaseQuantity()"> <!-- Changed type to button -->
                                <img src="../assets/decreaseBtn.svg" alt="Decrease">
                            </button>
                            <input type="number" class="quantityInput" name="Quantity" value="1">
                            <button type="button" onclick="increaseQuantity()"> <!-- Changed type to button -->
                                <img src="../assets/buttonAdd.svg" alt="Increase">
                            </button>
                        </div>
                    </div>

                    <div class="addToCart">
                        <button type="button" class="cancel" onclick="exitModal()">Cancel</button>
                        <!-- Changed type to button -->
                        <button type="submit" name="AddToCart" class="AddToCart">Add to cart</button>
                    </div>
                </div>
            </form>
        </div>


        <script>
            function decreaseQuantity() {
                alert('click');
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
                var cancel = document.querySelector('.modalmodal');
                cancel.style.display = 'none';
            }
        </script>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            document.getElementById("inventoryBtn").onclick = function () {
                window.location.href = "inventory.php";
            };

            //redirect to POS
            document.getElementById("POSBtn").onclick = function () {
                window.location.href = "POS.php";
            };

            function decreaseQuantity(button) {
                var input = button.nextElementSibling;
                if (parseInt(input.value) > 1) {
                    input.value = parseInt(input.value) - 1;
                }
            }

            function increaseQuantity(button) {
                var input = button.previousElementSibling;
                input.value = parseInt(input.value) + 1;
            }

            var OverAllTotal = parseFloat(document.getElementById('OverAllTotal').innerText);
            var ClientAmount = parseFloat(document.getElementById('ClientAmount').value);
            var changeDiv = document.getElementById('change');

            var Change = ClientAmount - OverAllTotal;

            changeDiv.innerHTML = Change;



            function Compute() {

                var OverAllTotal = parseFloat(document.getElementById('OverAllTotal').innerText);
                var ClientAmount = parseFloat(document.getElementById('ClientAmount').value);
                var changeDiv = document.getElementById('change');

                var Change = ClientAmount - OverAllTotal;

                if (isNaN(Change)) {
                    changeDiv.innerHTML = 0;
                } else {
                    changeDiv.innerHTML = Change;
                }
            }

            Compute();

            setInterval(Compute, 1000);

            // Select all buttons with a specific class
            var addToCartButtons = document.querySelectorAll('.AddToCart');

            // Iterate through each button and attach the event listener
            addToCartButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    var addItemElement = document.getElementById('modalmodal');
                    // addItemElement.style.display = 'block';
                });
            });



        </script>


</body>

</html>