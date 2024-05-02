<?php
$conn = new mysqli('localhost', 'root', '', 'dbms_sari_sari_store');

$select_query = "SELECT * FROM `inventory`";
$result = mysqli_query($conn, $select_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/inventory.css">
    <title>JFKL Store</title>
</head>

<body>
    <div class="navbar">
        <div class="left">
            <div class="shape">

            </div>
            <div class="logo">
                <img src="../assets/storeLogo.svg" alt="">
                <p>JFKL Store</p>
            </div>
        </div>

        <div class="right">
            <div class="todayGrossSaleLabel">
                <p>Today's Gross Sale: </p>
            </div>
            <div class="todayGrossSale">
                <p><strong>P969.00</strong></p>
            </div>
            <div class="date">
                <p>May 13, 2024</p>
            </div>
        </div>
    </div>

    <div class="sideBar">
        <div class="sbPOS">
            <button id="POSBtn">
                <img src="../assets/POSbnw.svg" alt=""><br>
                <strong>POS</strong>
            </button>
        </div>
        <div class="sbInventory">
            <button id="inventoryBtn">
                <img src="../assets/inventorybnw.svg" alt=""><br>
                <strong>Inventory</strong>
            </button>
        </div>
        <div class="sbSales">
            <button id="salesBtn">
                <img src="../assets/sales.svg" alt=""><br>
                <strong>Sales</strong>
            </button>
        </div>
    </div>

    <div class="mainContainer">
        <div class="productDisplay">

            <div class="delAddProduct">
                <div class="searchBar">
                    <input type="text" id="search" placeholder="Search">
                </div>
                <button class="removeProduct" id="removeProductBtn">Remove Product</button>
                <button class="addProduct" id="addProductBtn">Add Product</button>
            </div>

            <div class="category" id="categoryContainer">
                <button class="categoryBtn" onclick="showAll()">All</button>
                <button class="categoryBtn" onclick="filterInventory('Canned Goods')">Canned Goods</button>
                <button class="categoryBtn" onclick="filterInventory('Coffee')">Coffee</button>
                <button class="categoryBtn" onclick="filterInventory('Biscuits')">Biscuits</button>
                <button class="categoryBtn" onclick="filterInventory('Ice Cream')">Ice Cream</button>
                <button class="categoryBtn" onclick="filterInventory('Bread')">Bread</button>
                <button class="categoryBtn" onclick="filterInventory('Health & Beauty')">Health & Beauty</button>
                <button class="categoryBtn" onclick="filterInventory('Household & Cleaning Supplies')">Household &
                    Cleaning Supplies</button>
                <button class="categoryBtn" onclick="filterInventory('PC Products')">Personal Collection
                    Products</button>
                <button class="categoryBtn" onclick="filterInventory('Cold Drinks')">Cold Drinks</button>
                <button class="categoryBtn" onclick="filterInventory('Powdered Drinks')">Powdered Drinks</button>
                <button class="categoryBtn" onclick="filterInventory('Junk Foods')">Junk Foods</button>
                <button class="categoryBtn" onclick="filterInventory('Cigarettes')">Cigarettes</button>
                <button class="categoryBtn" onclick="filterInventory('Frozen Foods')">Frozen Foods</button>
                <button class="categoryBtn" onclick="filterInventory('Instant Noodles')">Instant Noodles</button>
                <button class="categoryBtn" onclick="filterInventory('Alcoholic Beverages')">Alcoholic
                    Beverages</button>
                <button class="categoryBtn" onclick="filterInventory('Candies & Chocolates')">Candies &
                    Chocolates</button>
                <button class="categoryBtn" onclick="filterInventory('Dairy Products')">Dairy Products</button>
                <button class="categoryBtn" onclick="filterInventory('Condiments & Sauces')">Condiments &
                    Sauces</button>
                <button class="categoryBtn" onclick="filterInventory('Cooking Ingredients & Seasonings')">Cooking
                    Ingredients & Seasonings</button>
                <button class="categoryBtn" onclick="filterInventory('Spreads & Fillings')">Spreads & Fillings</button>
                <button class="categoryBtn" onclick="filterInventory('School Supplies')">School Supplies</button>
            </div>

            <div class="inventory">
                <table class="inventoryTable">
                    <thead>
                        <tr>
                            <th></th> <!-- Checkbox column -->
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Net Weight</th>
                            <th>Category</th>
                            <th>Unit Price</th>
                            <th>Retail Price</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td><input type='checkbox'></td>"; // Blank space for checkbox
                                echo "<td>" . $row["product_id"] . "</td>"; // Product ID
                                echo "<td>" . $row["product_name"] . "</td>"; // Product Name
                                echo "<td>" . $row["net_weight"] . "</td>"; // Net Weight
                                echo "<td>" . $row["category"] . "</td>"; // Category
                                echo "<td>" . $row["unit_price"] . "</td>"; // Unit Price
                                echo "<td>" . $row["retail_price"] . "</td>"; // Retail Price
                                echo "<td>" . $row["stock"] . "</td>"; // Stock
                                echo "<td><button><img src='../assets/edit.svg'></button></td>"; // Action Column
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='9'>No products found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        //redirect to inventory
        document.getElementById("inventoryBtn").onclick = function () {
            window.location.href = "inventory.php";
        };

        //redirect to POS
        document.getElementById("POSBtn").onclick = function () {
            window.location.href = "POS.php";
        };



    </script>
</body>

</html>