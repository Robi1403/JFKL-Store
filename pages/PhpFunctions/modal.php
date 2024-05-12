<?php 
session_start();
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
                    <img src="../assets/InventoryItems/<?php echo $row['picture_url']; ?>" alt="">
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
                        <button type="submit" name="AddToCart" class="AddToCartBtn">Add to cart</button>
                    </div>
                </div>
            </form>

            
<?php
        }
    }
}else{
    echo "not found";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['AddToCart'])) {

    $session_array = array(
        'id' => $_POST['productID'],
        'product_name' => $_POST['productName'],
        'retail_price' => $_POST['productRetailPrice'],
        'picture_url' => $_POST['productURL'],
        'net_weight' => $_POST['productNetweight'],
        'quantity' => $_POST['Quantity'],
        'unitPrice' => $_POST['productUnitPrice'],
    );


    if (isset($_SESSION['cart'])) {
        $_SESSION['cart'][] = $session_array;
    } else {
        $_SESSION['cart'] = array($session_array);
    }

    header('Location: ../POS.php');
}
?>