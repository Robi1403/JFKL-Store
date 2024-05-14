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
    $url = $_POST['productURLInput'];

    $select_query = "SELECT * FROM `inventory` WHERE `product_id` = '$productId'";
    $result = mysqli_query($conn, $select_query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $previous_state = "";
        $new_state = "";

        if ($productName != $row['product_name']) {
            $previous_state = "Product Name: " . $row['product_name'] . "\n";
            $new_state = "Product Name: " . $productName ."\n";
        }

        if ($netWeight != $row['net_weight']) {
            if ($netWeight != NULL) {
                if ( $row['net_weight'] != NULL) {
                    $previous_state .= "Net Weight: " . $row['net_weight'] ."\n";
                } else {
                    $previous_state .= "Net Weight: NULL\n";
                }

                $new_state .= "Net Weight: " . $netWeight ."\n";
            } else {
                if ($row['net_weight'] != NULL) {
                    $previous_state .= "Net Weight: " .$row['net_weight'] ."\n";
                } else {
                    $previous_state .= "Net Weight: NULL\n";
                }
                $new_state .= "Net Weight: NULL\n";
            }
        }

        if ($unit != $row['unit']) {
            $previous_state .= "Unit: "  .$row['unit'] ."\n";
            $new_state .= "Unit: " .$unit . "\n";
        }

        if ($category != $row['category']) {
            $previous_state .= "Category: "  .$row['category'] ."\n";
            $new_state .= "Category: "  .$category . "\n";
        }

        if ($unitPrice != $row['unit_price']) {
            $previous_state .= "Unit Price: "  .$row['unit_price'] ."\n";
            $new_state .= "Unit Price: "  .$unitPrice . "\n";
        }

        if ($retailPrice != $row['retail_price']) {
            $previous_state .= "Retail Price: "  .$row['retail_price'] ."\n";
            $new_state .=  "Retail Price: "  .$retailPrice ."\n";
        }

        if ($stock != $row['stock']) {
            $previous_state .=  "Stock: "  .$row['stock'] ."\n";
            $new_state .=  "Stock: "  .$stock ."\n";
        }

        if ($url != $row['picture_url']) {
            $previous_state .= "Url: "  .$row['picture_url'] ."\n";
            $new_state .= "Url: "  .$url ."\n";
        }

        if ($new_state == NULL) {
            echo '<script> alert("Nothing was changed");
            window.location.href = "../inventory.php";  </script>';
        }

        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');
        
        $insert_query = "INSERT INTO `inventory_log`(`product_id`, `action_type`, `date`, `previous_state`, `new_state`) VALUES ('$productId', 'Update', '$date', '$previous_state', '$new_state')";
        if (mysqli_query($conn, $insert_query)) {
        } else {
            echo '<script>alert("Error inserting data to inventory log: ' . mysqli_error($conn) . '");</script>';
        }
    } else {
        echo '<script>alert("Error retrieving data from the database: ' . mysqli_error($conn) . '");</script>';
    }

    if ($netWeight == NULL) {

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
                    window.location.href = "../inventory.php";
                </script>';
        } else {
            echo '<script>alert("Error updating data: ' . mysqli_error($conn) . '");</script>';
        }
    } else {

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
            echo '<script>
                    window.location.href = "../inventory.php"; 
                </script>';
        } else {
            echo '<script>alert("Error updating data: ' . mysqli_error($conn) . '");</script>';
        }
    }
}
?>