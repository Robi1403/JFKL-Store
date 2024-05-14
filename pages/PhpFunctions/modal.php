<?php 
session_start();
include("connection.php");

if (isset($_POST['id'])) {
    $productID = $_POST['id'];

    $query = "SELECT * FROM inventory WHERE product_id = '$productID'";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0 ) {
        while($row = mysqli_fetch_assoc($result)){
        if ($row['stock'] != 0) {
           
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
                            <button type="button" onclick="decreaseQuantity()"> 
                                <img src="../assets/decreaseBtn.svg" alt="Decrease">
                            </button>
                            <input type="number" class="quantityInput" name="Quantity" value="1">
                            <button type="button" onclick="increaseQuantity()"> 
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
                        <button type="button" class="cancel" onclick="exitModal()">Cancel</button> 
                        <button type="submit" name="AddToCart" class="AddToCartBtn">Add to cart</button>
                    </div>
                </div>
            </form>

            
        <?php
       }else{
           ?>
        <div class="ItemOOS">
            <svg xmlns="http://www.w3.org/2000/svg" width="109" height="125" viewBox="0 0 42 46" fill="none">
                <path d="M21 43.8337C19.2958 43.8337 17.6667 43.1462 14.4104 41.7753C6.30417 38.3607 2.25 36.6545 2.25 33.7816V13.7128M21 43.8337C22.7042 43.8337 24.3333 43.1462 27.5896 41.7753C35.6958 38.3607 39.75 36.6545 39.75 33.7816V13.7128M21 43.8337V23.0628M2.25 13.7128C2.25 14.9899 3.92083 15.7962 7.26042 17.4066L13.3437 20.3441C17.1021 22.1566 18.9792 23.0628 21 23.0628M2.25 13.7128C2.25 12.4378 3.92083 11.6316 7.26042 10.0212L10.5833 8.41699M39.75 13.7128C39.75 14.9899 38.0792 15.7962 34.7396 17.4066L28.6562 20.3441C24.8979 22.1566 23.0208 23.0628 21 23.0628M39.75 13.7128C39.75 12.4378 38.0792 11.6316 34.7396 10.0212L31.4167 8.41699M8.5 25.1378L12.6667 27.2149M16.8333 2.16699L21 6.33366M21 6.33366L25.1667 10.5003M21 6.33366L16.8333 10.5003M21 6.33366L25.1667 2.16699" stroke="#F64747" stroke-width="3.125" stroke-linecap="round" stroke-linejoin="round"/>
                
              </svg>
              <h1>Item Out of Stock</h1>
              <button type="button" class="cancel" onclick="exitModal()" style="background-color: #038f59;
              height:30px; border:none; width:100px; margin-top:30px;
              ">Cancel</button> 

        </div>

<?php
       } }
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
