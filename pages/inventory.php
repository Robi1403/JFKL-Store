<?php
//include ("PhpFunctions/connection.php");

include ("PhpFunctions/remove_product.php");

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

                        if ($category == 'All') {
                            $select_query = "SELECT * FROM `inventory`";
                        } else {
                            $select_query = "SELECT * FROM `inventory` where category = '$category'";
                        }

                        $result = mysqli_query($conn, $select_query);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td><input type='checkbox' name='selectedProducts[]' value='" . $row["product_id"] . "'></td>"; // Blank space for checkbox
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

                <form id="removeProductForm" name="form" action="" method="post">
                    <input type="hidden" id="selectedProducts" name="selectedProducts">
                </form>
            </div>
        </div>
    </div>

    <div class="background" id="modal">
        <div class="ItemContainer">
            <h3>Add New Product</h3>
            <form>
                <div class="formContent">
                    <div class="productInfo">
                        <label for="productInfo">Product Info</label><br><br>
                        <div class="labelInput">
                            <label>Product Image</label>
                            <div class="addImage">
                                <div class="imageContainer">
                                    <img src="../assets/addImage.svg" id="productImage">
                                </div>
                                <div class="addImageBtn">
                                    <label>Add image</label>
                                    <label for="input-file" class="addProduct">Upload Image</label>
                                    <input type="file" accept="image/jpeg, image/png, image/jpg," id="input-file">
                                </div>
                            </div>
                        </div>
                        <div class="labelInput">
                            <label>Product Name</label>
                            <input type="text" id="username" required><br><br>
                        </div>
                        <div class="labelInput">
                            <label>Net Weight</label>
                            <input type="text" id="username" required><br><br>
                        </div>
                        <div class="labelInput">
                            <label>Product ID</label>
                            <input type="text" id="username" required><br><br>
                        </div>
                        <div class="labelInput">
                            <label for="category">Category</label>
                            <select id="category" required>
                                <option value=""></option>
                                <option value="Canned Goods">Canned Goods</option>
                                <option value="Coffee">Coffee</option>
                                <option value="Biscuits">Biscuits</option>
                                <option value="Ice Cream">Ice Cream</option>
                                <option value="Bread">Bread</option>
                                <option value="Health and Beauty">Health and Beauty</option>
                                <option value="Household & Cleaning Supply">Household & Cleaning Supply</option>
                                <option value="Personal Care Products">Personal Care Products</option>
                                <option value="Drinks">Drinks</option>
                                <option value="Powered Drinks">Powered Drinks</option>
                                <option value="Junkfoods">Junkfoods</option>
                                <option value="Cigarettes">Cigarettes</option>
                                <option value="Frozen Foods">Frozen Foods</option>
                                <option value="Instant Noodles">Instant Noodles</option>
                                <option value="Alcoholic Beverages">Alcoholic Beverages</option>
                                <option value="Candies & Chocolates">Candies & Chocolates</option>
                                <option value="Dairy Products">Dairy Products</option>
                                <option value="Condiments">Condiments</option>
                                <option value="Cooking Ingredients & Seasoning">Cooking Ingredients & Seasoning</option>
                                <option value="Spreads and Fillings">Spreads and Fillings</option>
                                <option value="School Supplies">School Supplies</option>
                            </select>
                        </div>
                        <div class="labelInput">
                            <label>Unit</label>
                            <input type="text" id="username" required><br><br>
                        </div>
                    </div>
                    <div class="additionalInfo">
                        <div class="pricingInfo">
                            <label for="pricingInfo">Pricing Info</label><br><br>
                            <div class="labelInput">
                                <label>Unit Price</label>
                                <input type="text" id="username" required><br><br>
                            </div>
                            <div class="labelInput">
                                <label>Retail Price</label>
                                <input type="text" id="username" required><br><br>
                            </div>
                        </div>
                        <div class="stockInfo">
                            <label for="stockInfo">Stock Info</label><br><br>
                            <div class="labelInput">
                                <label>Stock</label>
                                <input type="text" id="username" required><br><br>
                            </div>
                        </div>
                        <div class="updateButtons">

                            <button class="addProduct" id="addNewProductBtn">Add Product</button>
                            <button class="cancel" id="cancelBtn">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
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

        //get the selected checkboxes
        function getSelectedCheckboxes() {
            var checkboxes = document.querySelectorAll('.inventoryTable tbody input[type="checkbox"]:checked');
            var selectedProducts = [];
            checkboxes.forEach(function (checkbox) {
                selectedProducts.push(checkbox.value);
            });
            return selectedProducts;
        }

        //removal of selected products
        function removeSelectedProducts() {
            var selectedProducts = getSelectedCheckboxes();

            //confirms deletion
            var confirmation = confirm("Are you sure you want to delete the selected products?");
            if (confirmation) {
                //update the hidden input field with selected products 
                document.getElementById("selectedProducts").value = selectedProducts.join(',');

                document.getElementById("removeProductForm").submit();
            }
        }

        document.getElementById("removeProductBtn").onclick = function () {
            removeSelectedProducts();
        };

    </script>

    <script>
        let productImage = document.getElementById("productImage");
        let inputFile = document.getElementById("input-file");

        inputFile.onchange = function () {
            productImage.src = URL.createObjectURL(inputFile.files[0]);
        } 
    </script>

    <script>
        var addProductBtn = document.getElementById("addProductBtn");

        addProductBtn.addEventListener("click", function () {
            var modal = document.getElementById("modal");

            modal.style.display = "block";
        });

        var cancelBtn = document.getElementById("cancelBtn");

        cancelBtn.addEventListener("click", function () {
            var modal = document.getElementById("modal");

            modal.style.display = "none";
        });
    </script>

</body>

</html>