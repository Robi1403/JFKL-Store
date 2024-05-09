<?php 
include("connection.php");

if (isset($_POST['input'])) {
    $input = $_POST['input'];

    $query = "SELECT * FROM inventory WHERE product_name LIKE '{$input}%' OR  product_id LIKE '{$input}%' LIMIT 10";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0 ) {?>
        <div class="liveSearchContainer">
            <div class="header">
                <div class="image">
                
                </div>
                <div class="productID">
                    <p>Product ID</p>
                </div>
                <div class="productName">
                    <p>Product Name</p>
                </div>
                <div class="netWeight">
                    <p>Net Weight</p>
                </div>
                <div class="productPrice">
                    <p>Price</p>
                </div>
            </div>
            
            <div class="content">
                <?php 
                while($row = mysqli_fetch_assoc($result)){
                    $id = $row['product_id'];
                    $name = $row['product_name'];
                    $price = $row['retail_price'];
                    $pic = $row['picture_url'];
                    $netweight = $row['net_weight'];

                    ?>
                        <button class="select">
                            <div class="image">
                                <img src="../assets/InventoryItems/<?php echo $pic ?>" alt="">
                            </div>
                            <div class="productID">
                                <?php echo $id ?>
                            </div>
                            <div class="productName">
                                <?php echo $name ?>
                            </div>
                            <div class="netWeight">
                                <?php echo $netweight ?>
                            </div>
                            <div class="productPrice">
                                <?php echo $price ?>
                            </div>
                        </button>
                    <?php
                }
                ?>
            </div>


        
        </div>
        <?php
    }else {
        echo '
        <div class="liveSearchContainer">
            <div class="header">
                <div class="image">
                
                </div>
                <div class="productID">
                    <p>Product ID</p>
                </div>
                <div class="productName">
                    <p>Product Name</p>
                </div>
                <div class="netWeight">
                    <p>Net Weight</p>
                </div>
                <div class="productPrice">
                    <p>Price</p>
                </div>
            </div>
        </div>';
        echo "Product not found";
    }
}

?>