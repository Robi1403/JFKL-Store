<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['selectedProducts'])){

    if (is_string($_POST['selectedProducts']) && !empty($_POST['selectedProducts'])) {

        //split string selectedProducts to array based on ,
        $selectedProducts = explode(',', $_POST['selectedProducts']);

        $conn = new mysqli('localhost', 'root', '', 'dbms_sari_sari_store');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        foreach ($selectedProducts as $product_id) {
            $delete_query = "DELETE FROM inventory WHERE product_id = '$product_id'";

            if ($conn->query($delete_query) !== TRUE) {
                echo "Error deleting product with ID $product_id: " . $conn->error;
            }

            echo '<script>alert("Product with ID ' .$product_id .' deleted successfully.")</script>';
        }

        $conn->close();

    } else {
        echo '<script>alert("No products selected for deletion.")</script>';
    }
} 
?>
