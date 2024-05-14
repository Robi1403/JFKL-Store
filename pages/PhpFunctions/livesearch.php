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

                    <input type="hidden" class="ProductID" name="productId" value="<?php echo $id?>">
                    <button type="button" class="select toCart" name="toCart" data-product-id="<?php echo $id ?>">

                            <div class="image">
                                <img src="../assets/InventoryItems/<?php echo $pic ?>" alt="">
                            </div>
                            <div  class="productID">
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
        <script>
            // gets the product id and prompt the add item modal
           $(document).ready(function() {
            $(document).on('click', '.toCart', function(event) { 
                event.preventDefault(); 
                var id = $(this).data("product-id"); /
                $.ajax({
                    method: 'POST',
                    url: 'PhpFunctions/modal.php',
                    data: {id: id},
                    success: function(response) {
                        $(".addItem").css("display", "flex");
                        $('.addItem').html(response);
                    },
                    error: function(xhr, status, error) {
                        alert("An error occurred: " + error); 
                    }
                });
            });
        });      
                </script>
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