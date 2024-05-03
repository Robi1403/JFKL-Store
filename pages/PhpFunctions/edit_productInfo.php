<?php
include ("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['AddToCart'])) {
    // Create a session array to store product data
    $session_array = array(
        'id' => $_POST['productId'],
        'product_name' => $_POST['productName'],
        'retail_price' => $_POST['productPrice'],
        'picture_url' => $_POST['productPictureUrl'],
        'net_weight' => $_POST['netWeight'],
        'quantity' => $_POST['quantity'],

    );
}

?>