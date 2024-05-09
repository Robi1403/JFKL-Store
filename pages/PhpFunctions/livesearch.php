<?php 
include("connection.php");

if (isset($_POST['input'])) {
    $input = $_POST['input'];

    $query = "SELECT * FROM inventory WHERE product_name LIKE '{$input}%' OR  product_id LIKE '{$input}%' LIMIT 10";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0 ) {?>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                while($row = mysqli_fetch_assoc($result)){
                    $id = $row['product_id'];
                    $name = $row['product_name'];
                    $price = $row['retail_price'];
                    $pic = $row['picture_url'];

<<<<<<< Updated upstream
                    ?>           
=======
                    ?>
    
>>>>>>> Stashed changes
                        <tr>
                            <td><img src="../assets/InventoryItems/<?php echo $pic ?>" alt=""></td>
                            <td><?php echo $id ?></td>
                            <td><?php echo $name ?></td>
                            <td><?php echo $price ?></td>

                        </tr>
                        
                    <?php

                }
                
                
                ?>
            </tbody>
        </table>

        

        <?php
    }else {
        echo "product not found";
    }
}

?>