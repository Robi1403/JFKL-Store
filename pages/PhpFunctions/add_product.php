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

    if($netWeight == NULL) {
        $url = $productName .".png";

        $insert_query = "INSERT INTO `inventory`(`product_name`, `unit`, `category`, `unit_price`, `retail_price`, `stock`, `picture_url`) VALUES ('$productName', '$unit', '$category', '$unitPrice', '$retailPrice', '$stock', '$url')";
        if (mysqli_query($conn, $insert_query)) {
            echo '<script>
                    alert("Data inserted successfully."); 
                    window.location.href = "../inventory.php";
                </script>';
        } else {
            echo '<script>alert("Error inserting data: ' . mysqli_error($conn) . '");</script>';
        }
    }
    else {
        $url = $productName ." " .$netWeight .".png";

        $insert_query = "INSERT INTO `inventory`(`product_name`, `net_weight`, `unit`, `category`, `unit_price`, `retail_price`, `stock`, `picture_url`) VALUES ('$productName', '$netWeight', '$unit', '$category', '$unitPrice', '$retailPrice', '$stock', '$url')";
        if (mysqli_query($conn, $insert_query)) {
            echo '<script>
                    alert("Data inserted successfully."); 
                    window.location.href = "../inventory.php";
                </script>';
        } else {
            echo '<script>alert("Error inserting data: ' . mysqli_error($conn) . '");</script>';
        }
    }
}
?>