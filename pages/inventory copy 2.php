<?php
//include ("PhpFunctions/connection.php");

//ini muna since sa db ko
$conn = new mysqli('localhost', 'root', '', 'dbms_sari_sari_store');
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

            <form class="category" id="categoryContainer" name="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <button class="categoryBtn" type="submit" name="category" value="All">All</button>
                <button class="categoryBtn" type="submit" name="category" value="Canned Goods">Canned Goods</button>
                <button class="categoryBtn" type="submit" name="category" value="Coffee">Coffee</button>
                <button class="categoryBtn" type="submit" name="category" value="Biscuits">Biscuits</button>
                <button class="categoryBtn" type="submit" name="category" value="Ice Cream">Ice Cream</button>
                <button class="categoryBtn" type="submit" name="category" value="Bread">Bread</button>
                <button class="categoryBtn" type="submit" name="category" value="Health & Beauty">Health & Beauty</button>
                <button class="categoryBtn" type="submit" name="category" value="Household & Cleaning Supplies">Household & Cleaning Supplies</button>
                <button class="categoryBtn" type="submit" name="category" value="PC Products">Personal Collection Products</button>
                <button class="categoryBtn" type="submit" name="category" value="Cold Drinks">Cold Drinks</button>
                <button class="categoryBtn" type="submit" name="category" value="Powdered Drinks">Powdered Drinks</button>
                <button class="categoryBtn" type="submit" name="category" value="Junk Foods">Junk Foods</button>
                <button class="categoryBtn" type="submit" name="category" value="Cigarettes">Cigarettes</button>
                <button class="categoryBtn" type="submit" name="category" value="Frozen Foods">Frozen Foods</button>
                <button class="categoryBtn" type="submit" name="category" value="Instant Noodles">Instant Noodles</button>
                <button class="categoryBtn" type="submit" name="category" value="Alcoholic Beverages">Alcoholic Beverages</button>
                <button class="categoryBtn" type="submit" name="category" value="Candies & Chocolates">Candies & Chocolates</button>
                <button class="categoryBtn" type="submit" name="category" value="Dairy Products">Dairy Products</button>
                <button class="categoryBtn" type="submit" name="category" value="Condiments & Sauces">Condiments & Sauces</button>
                <button class="categoryBtn" type="submit" name="category" value="Cooking Ingredients & Seasonings">Cooking Ingredients & Seasonings</button>
                <button class="categoryBtn" type="submit" name="category" value="Spreads & Fillings">Spreads & Fillings</button>
                <button class="categoryBtn" type="submit" name="category" value="School Supplies">School Supplies</button>
            </form>

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
                            $category = $_POST['category'] ?? 'All';

                            if ($category == 'All'){
                                $select_query = "SELECT * FROM `inventory`";
                            } else {
                                $select_query = "SELECT * FROM `inventory` where category = '$category'";
                            }

                            $result = mysqli_query($conn, $select_query);
                            
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td><input type='checkbox'></td>"; // Blank space for checkbox
                                    echo "<td>" . $row["product_id"] . "</td>"; // Product ID
                                    echo "<td>" . $row["product_name"] . "</td>"; // Product Name
                                    
                                    if ($row["net_weight"] == NULL) {
                                        echo "<td>-</td>";
                                    } else {
                                        echo "<td>" . $row["net_weight"] . "</td>"; // Net Weight
                                    }

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

        // Function to get the selected checkboxes
        function getSelectedCheckboxes() {
            var checkboxes = document.querySelectorAll('.inventoryTable tbody input[type="checkbox"]');
            var selectedCheckboxes = [];
            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    selectedCheckboxes.push(checkbox.parentNode.parentNode); // Pushing the whole row
                }
            });
            return selectedCheckboxes;
        }

        // Example function to use the selected checkboxes
        function handleCheckboxSelection() {
            var selectedRows = getSelectedCheckboxes();
            var selectedIds = [];
            selectedRows.forEach(function(row) {
                var productId = row.querySelector('td:nth-child(2)').innerText; // Assuming Product ID is in the second column
                selectedIds.push(productId);
            });
            console.log('Selected Product IDs:', selectedIds);
        }

        // Example of how to use the function with a button click
        document.getElementById("removeProductBtn").onclick = function () {
            handleCheckboxSelection();
        };
    </script>
</body>

</html>