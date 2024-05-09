<?php
include ("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['selectedProducts'])) {

    if (is_string($_POST['selectedProducts']) && !empty($_POST['selectedProducts'])) {

        //split string selectedProducts to array based on ,
        $selectedProducts = explode(',', $_POST['selectedProducts']);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $num_selected_products = count($selectedProducts);

        // echo '<script>alert("no. of products: ' . $num_selected_products . '")</script>';

        foreach ($selectedProducts as $productId) {
            // echo '<script>alert("selected products: ' . $product_id . '")</script>';

            $select_query = "SELECT * FROM `inventory` WHERE `product_id` = '$productId'";
            $result = mysqli_query($conn, $select_query);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);

                $productName = $row['product_name'];
                $netWeight = $row['net_weight'];
                $unit = $row['unit'];
                $category = $row['category'];
                $unitPrice = $row['unit_price'];
                $retailPrice = $row['retail_price'];
                $stock = $row['stock'];
                $url = $row['picture_url'];

                $new_state = "Removed from the inventory.";

                $previous_state = "Product ID: " . $productId . "\n";
                $previous_state .= "Product Name: " . $productName . "\n";
                $previous_state .= "Net Weight: " . $netWeight . "\n";
                $previous_state .= "Unit: " . $unit . "\n";
                $previous_state .= "Category: " . $category . "\n";
                $previous_state .= "Unit Price: " . $unitPrice . "\n";
                $previous_state .= "Retail Price: " . $retailPrice . "\n";
                $previous_state .= "Stock: " . $stock . "\n";
                $previous_state .= "Url: " . $url;

                date_default_timezone_set('Asia/Manila');
                $date = date('Y-m-d H:i:s');

                $insert = "INSERT INTO `inventory_log`(`product_id`, `action_type`, `date`, `previous_state`, `new_state`) VALUES ('$productId', 'Remove', '$date', '$previous_state', '$new_state')";
                if (mysqli_query($conn, $insert)) {
                } else {
                    echo '<script>alert("Error inserting data to inventory log: ' . mysqli_error($conn) . '");</script>';
                }
            }

            $delete_query = "DELETE FROM inventory WHERE product_id = '$productId'";

            if ($conn->query($delete_query) !== TRUE) {
                echo '<script>alert("Error deleting product with ID: ' .$product_id .'" . $conn->error")</script>';
            }
        }

        echo '<script>
                alert("' . $num_selected_products . ' data successfully inserted to inventory log and removed from inventory.");
            </script>';

        $conn->close();

    } else {
        echo '<script>alert("No products selected for deletion.")</script>';
    }
}
?>