<?php

include ("connection.php");

if (isset($_POST['updateProductInfoBtn'])) {

    $productId = $_POST['productIdInput'];
    $productName = $_POST['productNameInput'];
    $netWeight = $_POST['netWeightInput'];
    $unit = $_POST['unitInput'];
    $category = $_POST['categoryInput'];
    $unitPrice = $_POST['unitPriceInput'];
    $retailPrice = $_POST['retailPriceInput'];
    $stock = $_POST['stockInput'];

    if ($netWeight == NULL) {
        $url = $productName . ".png";

        $update_query = "UPDATE `inventory` SET
        `product_name` = '$productName',
        `net_weight` = NULL,
        `unit` = '$unit', 
        `category` = '$category', 
        `unit_price` = '$unitPrice', 
        `retail_price` = '$retailPrice', 
        `stock` = '$stock',
        `picture_url` =  '$url'
        WHERE `product_id` = '$productId'";

        if (mysqli_query($conn, $update_query)) {
            echo '<script>
                    alert("Data updated successfully."); 
                    window.location.href = "../inventory.php";
                </script>';
        } else {
            echo '<script>alert("Error updating data: ' . mysqli_error($conn) . '");</script>';
        }
    } else {
        $url = $productName . " " . $netWeight . ".png";

        $update_query = "UPDATE `inventory` SET 
        `product_name` = '$productName',
        `net_weight` = '$netWeight',
        `unit` = '$unit', 
        `category` = '$category', 
        `unit_price` = '$unitPrice', 
        `retail_price` = '$retailPrice', 
        `stock` = '$stock',
        `picture_url` =  '$url'
        WHERE `product_id` = '$productId'";

        if (mysqli_query($conn, $update_query)) {
            echo "Data updated successfully.";
        } else {
            echo "Error updating data: " . mysqli_error($conn);
        }
    }
}
?>