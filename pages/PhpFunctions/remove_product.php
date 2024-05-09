<?php
include ("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['selectedProducts'])){

    if (is_string($_POST['selectedProducts']) && !empty($_POST['selectedProducts'])) {

        //split string selectedProducts to array based on ,
        $selectedProducts = explode(',', $_POST['selectedProducts']);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        foreach ($selectedProducts as $product_id) {
            $delete_query = "DELETE FROM inventory WHERE product_id = '$product_id'";

            if ($conn->query($delete_query) !== TRUE) {
                echo '<script>alert("Error deleting product with ID $product_id: " . $conn->error")</script>';
            }

            echo '<script>alert("Product with ID ' .$product_id .' deleted successfully.")</script>';
        }

        $conn->close();

    } else {
        echo '<script>alert("No products selected for deletion.")</script>';
    }

    $date = DATE_FORMAT(NOW(), '%Y-%M-%d %h:%i:%s %p');
    $insert_query = "INSERT INTO `inventory_log`(`product_id`, `action_type`, `date`, `previous_state`) VALUES ('$productId', 'Remove', '$date', '$productName, $netWeight, $unit, $category, $unitPrice, $retailPrice, $stock, $url')"; 
    if (mysqli_query($conn, $insert_query)) {
        echo '<script>
                alert("Data inserted successfully to inventory log."); 
                window.location.href = "../inventory.php";
            </script>';
    } else {
        echo '<script>alert("Error inserting data to inventory log: ' . mysqli_error($conn) . '")</script>';
    }
} 
?>
