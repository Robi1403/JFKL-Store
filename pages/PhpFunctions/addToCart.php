<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['AddToCart'])) {
    //session array to store product data
    $session_array = array(
        'id' => $_POST['productID'],
        'product_name' => $_POST['productName'],
        'retail_price' => $_POST['productRetailPrice'],
        'picture_url' => $_POST['productURL'],
        'net_weight' => $_POST['productNetweight'],
        'quantity' => $_POST['Quantity'],
        'unitPrice' => $_POST['productUnitPrice'],

    );

    //checks if session cart already exists
    if (isset($_SESSION['cart'])) {
        //add the new item to the cart array
        $_SESSION['cart'][] = $session_array;
    } else {
        //create the cart array and add the item
        $_SESSION['cart'] = array($session_array);
    }
}
?>