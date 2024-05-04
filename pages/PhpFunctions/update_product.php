<?php

include ("connection.php");

if (isset($_POST['updateProductInfoBtn'])) {
    echo'updating info';
    $productName = $_POST['productName'];
    $netWeight = $_POST['netWeight'];
    $unit = $_POST['unit'];
    $category = $_POST['category'];
    $unitPrice = $_POST['unitPrice'];
    $retailPrice = $_POST['retailPrice'];
    $stock = $_POST['stock'];

    if ($netWeight == NULL) {
        $url = $productName . ".png";

        // Construct the UPDATE query
        $update_query = "UPDATE `inventory` SET
        `net_weight` = NULL,
        `unit` = '$unit', 
        `category` = '$category', 
        `unit_price` = '$unitPrice', 
        `retail_price` = '$retailPrice', 
        `stock` = '$stock',
        `picture_url` =  '$url'
        WHERE `product_name` = '$productName'";

        // Execute the UPDATE query
        if (mysqli_query($conn, $update_query)) {
            echo "Data updated successfully.";
        } else {
            echo "Error updating data: " . mysqli_error($conn);
        }
    } else {
        $url = $productName . " " . $netWeight . ".png";

        // Construct the UPDATE query
        $update_query = "UPDATE `inventory` SET 
        `net_weight` = '$netWeight',
        `unit` = '$unit', 
        `category` = '$category', 
        `unit_price` = '$unitPrice', 
        `retail_price` = '$retailPrice', 
        `stock` = '$stock',
        `picture_url` =  '$url'
        WHERE `product_name` = '$productName'";

        // Execute the UPDATE query
        if (mysqli_query($conn, $update_query)) {
            echo "Data updated successfully.";
        } else {
            echo "Error updating data: " . mysqli_error($conn);
        }
    }
}
?>