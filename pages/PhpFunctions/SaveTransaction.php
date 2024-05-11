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
    }

}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
        $numberOfItems = $_POST['numberOfItems'];
        $SubTotal = $_POST['SubTotal'];
        $realCostofGoods = $_POST['realCostofGoods'];
        $cart = $_SESSION['cart'];


    saveDataToDatabase($conn,$numberOfItems, $SubTotal, $realCostofGoods, $cart);
    
}






?>