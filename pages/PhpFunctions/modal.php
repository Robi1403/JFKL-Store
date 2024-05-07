<?php 
include("connection.php");

if (isset($_POST['id'])) {
    $productID = $_POST['id'];

    $query = "SELECT * FROM inventory WHERE product_id = '$productID'";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0 ) {
        while($row = mysqli_fetch_assoc($result)){
?>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="ItemContainer">
                <div class="itemInfo">
                    <img src="../assets/<?php echo $row['picture_url']; ?>" alt="">
                    <div class="Infos">
                        <h1><?php echo $row['product_name'] ?></h1>
                        <h3><?php echo $row['net_weight'] ?></h3>
                        <h1>₱<?php echo $row['retail_price'] ?></h1>
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

                    <input type="hidden" name="productID" value="<?php echo $row['product_id'] ?>">
                    <input type="hidden" name="productURL" value="<?php echo $row['picture_url'] ?>">
                    <input type="hidden" name="productName" value="<?php echo $row['product_name'] ?>">
                    <input type="hidden" name="productRetailPrice" value="<?php echo $row['retail_price'] ?>">
                    <input type="hidden" name="productNetweight" value="<?php echo $row['net_weight'] ?>">
                    <input type="hidden" name="productUnitPrice" value="<?php echo $row['unit_price'] ?>">

                    <div class="addToCart">
                        <button type="button" class="cancel" onclick="exitModal()">Cancel</button> <!-- Changed type to button -->
                        <button type="submit" name="AddToCart" class="AddToCart">Add to cart</button>
                    </div>
                </div>
            </form>

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
                    cancel.style.display ='none';
                }
            </script>


                
            
<?php
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['AddToCart'])) {
    // Display form data for debugging
    

    // Process form submission
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
        var_dump($_SESSION['cart']);

        echo `<script>var cancel = document.querySelector('.addItem');
        cancel.style.display ='none';</script>`;
    }
}
?>
