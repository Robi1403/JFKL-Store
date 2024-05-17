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
                            <p>Transaction Details</p>
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
                                            <td><?php echo $row['product_name'] ?></td>
                                            <td><?php echo $row['retail_price'] ?></td>
                                            <td><?php echo $row['quantity'] ?></td>
                                            <td><?php echo $row['total_amount'] ?></td>
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
                                <button  class="closeBtn" onclick="close();function close() {
                                    var cancel = document.querySelector('.TransactionDetails');
                                    cancel.style.display = 'none';
                                 }">Close</button>
                            </div>
                        

                            
            <?php
        
    }
}

?>