<?php 
include('connection.php');


function createTransactionNumber(){
    $current_date = date('mdY');
    $current_time = 60000+ date('His');
    $random_number = mt_rand(1000, 9999); 
    
    $transaction_number = $current_date . $current_time . $random_number;

    return $transaction_number;
}

function saveDataToDatabase ($conn,$numberOfItems ,$SubTotal,$realCostofGoods,$cart){

    $transaction_number = createTransactionNumber();
    $current_date = date('Y-m-d');
    $profit = $SubTotal -$realCostofGoods;

    $InsertData = "INSERT INTO transaction_history VALUES('$transaction_number','$current_date','$numberOfItems ','$SubTotal',' $profit')";

    mysqli_query($conn,$InsertData);

    foreach ($cart as $item){
        $id = $item['id'];
        $productName = $item['product_name'];
        $retailPrice = $item['retail_price'];
        $quantity = $item['quantity'];
        $totalAmount = $retailPrice * $quantity;

        $ItemData = "INSERT INTO sale_items VALUES('','$transaction_number','$id','$productName','$retailPrice', '$quantity','$totalAmount')";

        mysqli_query($conn, $ItemData);

        $Stock = "SELECT * FROM inventory WHERE product_id = '$id'";

        $result = mysqli_query($conn, $Stock);
        

        if (mysqli_num_rows($result) > 0 ) {
            while($row = mysqli_fetch_assoc($result)){
                $oldStock = $row['stock'];
                $UpdatedStock  = $oldStock - $quantity;

                $UpdateStockDatabase = "UPDATE inventory SET stock = '$UpdatedStock' WHERE product_id = '$id'";
                mysqli_query($conn,$UpdateStockDatabase);
            }
        }
   
    }

}





?>