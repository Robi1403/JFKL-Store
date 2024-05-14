<?php
include ("connection.php");

if (isset($_POST['addNewProductBtn'])) {
    $productName = $_POST['productName'];
    $netWeight = $_POST['netWeight'];
    $unit = $_POST['unit'];
    $category = $_POST['category'];
    $unitPrice = $_POST['unitPrice'];
    $retailPrice = $_POST['retailPrice'];
    $stock = $_POST['stock'];
    $url =  $_POST['productURL'];

    if ($netWeight == NULL) {
         
        $insert_query = "INSERT INTO `inventory`(`product_name`, `unit`, `category`, `unit_price`, `retail_price`, `stock`, `picture_url`) VALUES ('$productName', '$unit', '$category', '$unitPrice', '$retailPrice', '$stock', '$url')";
        if (mysqli_query($conn, $insert_query)) {
            $productId = mysqli_insert_id($conn); 
        } else {
            echo '<script>alert("Error inserting data: ' . mysqli_error($conn) . '");</script>';
        }
    } else {

        $insert_query = "INSERT INTO `inventory`(`product_name`, `net_weight`, `unit`, `category`, `unit_price`, `retail_price`, `stock`, `picture_url`) VALUES ('$productName', '$netWeight', '$unit', '$category', '$unitPrice', '$retailPrice', '$stock', '$url')";
        if (mysqli_query($conn, $insert_query)) {
            $productId = mysqli_insert_id($conn);
        } else {
            echo '<script>alert("Error inserting data to inventory: ' . mysqli_error($conn) . '");</script>';
        }
    }

    $previous_state = "No previous state";
    $new_state = "Product Name: " . $productName . "\n";

    if ($netWeight != NULL) {
        $new_state .= "Net Weight: " . $netWeight . "\n";
    }

    $new_state .= "Unit: " . $unit . "\n";
    $new_state .= "Category: " . $category . "\n";
    $new_state .= "Unit Price: " . $unitPrice . "\n";
    $new_state .= "Retail Price: " . $retailPrice . "\n";
    $new_state .= "Stock: " . $stock . "\n";
    $new_state .= "Url: " . $url;

    date_default_timezone_set('Asia/Manila');
    $date = date('Y-m-d H:i:s');

    $insert = "INSERT INTO `inventory_log`(`product_id`, `action_type`, `date`, `previous_state`, `new_state`) VALUES ('$productId', 'Add', '$date', '$previous_state', '$new_state')";
    if (mysqli_query($conn, $insert)) {
        echo '<script>
                window.location.href = "../inventory.php"; 
            </script>';
    } else {
        echo '<script>alert("Error inserting data to inventory log: ' . mysqli_error($conn) . '");</script>';
    }
}
?>