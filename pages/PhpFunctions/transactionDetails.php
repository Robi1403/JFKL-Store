<?php 
include("connection.php");

if (isset($_POST['id'])) {
    $transactionNumber = $_POST['id'];

    $query = "SELECT * FROM sale_items WHERE transaction_number = '$transactionNumber'";

    $result = mysqli_query($conn, $query);

    $totalItems = 0;
    $totalAmount = 0;

    if (mysqli_num_rows($result) > 0 ) {
        
            ?>

            <div class="transactionContainer">
                            <h1>Transaction Details</h1>
                                <div class="SummaryContainer">
                                    <table>
                                        <tr>
                                            <th>Item</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                            <?php while($row = mysqli_fetch_assoc($result)){
                                $totalItems += $row['quantity'];
                                $totalAmount += $row['total_amount'];?>
                    
                                        <tr>
                                            <th><?php echo $row['product_name'] ?></th>
                                            <th><?php echo $row['retail_price'] ?></th>
                                            <th><?php echo $row['quantity'] ?></th>
                                            <th><?php echo $row['total_amount'] ?></th>
                                        </tr>
                           <?php 
                        }?>

                                    </table>

                                </div>
                                <div class="AmountSummary">
                                    <div class="TotalNumberOfItems">
                                        <h2>Number of Items Sold</h2>
                                        <h1><?php echo $totalItems ?> </h1>
                                    </div>
                                    <div class="dividerDIV"></div>

                                    <div class="TotalAmount" >
                                        <h2>Total Amount</h2>
                                        <h1><?php echo $totalAmount ?> </h1>
                                    </div>
                                </div>
                                <a href="sales.php" class="closeBtn">Close</a>
                            </div>

                            
            <?php
        
    }
}

?>