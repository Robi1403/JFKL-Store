<?php
include ("PhpFunctions/connection.php");
include ("PhpFunctions/remove_product.php");
include ("PhpFunctions/add_product.php");
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
                <button class="categoryBtn" onclick="filterInventory('All')">All</button>
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
                        $category = $_POST['category'] ?? 'All';

                        if ($category == 'All') {
                            $select_query = "SELECT * FROM `inventory`";
                        } else {
                            $select_query = "SELECT * FROM `inventory` where category = '$category'";
                        }

                        $result = mysqli_query($conn, $select_query);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <form name="productTable" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                                    method="POST">
                                    <tr>
                                        <td><input type="checkbox" name="selectedProducts[]"
                                                value="<?php echo $row["product_id"]; ?>"></td>
                                        <td><?php echo $row["product_id"]; ?></td>
                                        <td><?php echo $row["product_name"]; ?></td>
                                        <?php
                                        if ($row["net_weight"] == NULL) { ?>
                                            <td>-</td>
                                            <?php
                                        } else { ?>
                                            <td><?php echo $row["net_weight"]; ?></td> <!-- Net Weight -->
                                            <?php
                                        } ?>
                                        <td><?php echo $row["category"]; ?></td>
                                        <td><?php echo $row["unit_price"]; ?></td>
                                        <td><?php echo $row["retail_price"]; ?></td>
                                        <td><?php echo $row["stock"]; ?></td>
                                        <td>
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                                <input type="hidden" name="productId_info" value="<?php echo $row["product_id"]; ?>">
                                                <button type="submit" name="passProductInfoBtn" id="passProductInfoBtn"><img
                                                        src='../assets/edit.svg'></button>
                                            </form>
                                        </td>
                                    </tr>
                                </form>
                                <?php
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

    <div id="addProductModal">
        <div class="background">
            <div class="ItemContainer">
                <h3>Add New Product</h3>
                <form id="addProductForm" name="addProductForm" action="PhpFunctions/add_product.php" method="POST">
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
                                <input type="text" id="username" name="productName" required><br><br>
                            </div>
                            <div class="labelInput">
                                <label>Net Weight</label>
                                <input type="text" id="username" name="netWeight"><br><br>
                            </div>
                            <!-- <div class="labelInput">
                            <label>Product ID</label>
                            <input type="text" id="username" required><br><br>
                        </div> -->
                            <div class="labelInput">
                                <label for="category">Category</label>
                                <select id="category" name="category" required>
                                    <option value=""></option>
                                    <option value="Canned Goods">Canned Goods</option>
                                    <option value="Coffee">Coffee</option>
                                    <option value="Biscuits">Biscuits</option>
                                    <option value="Ice Cream">Ice Cream</option>
                                    <option value="Bread">Bread</option>
                                    <option value="Health & Beauty">Health & Beauty</option>
                                    <option value="Household & Cleaning Supplies">Household & Cleaning Supplies</option>
                                    <option value="PC Products">Personal Collection Products</option>
                                    <option value="Cold Drinks">Cold Drinks</option>
                                    <option value="Powdered Drinks">Powdered Drinks</option>
                                    <option value="Junk Foods">Junk Foods</option>
                                    <option value="Cigarettes">Cigarettes</option>
                                    <option value="Frozen Foods">Frozen Foods</option>
                                    <option value="Instant Noodles">Instant Noodles</option>
                                    <option value="Alcoholic Beverages">Alcoholic Beverages</option>
                                    <option value="Candies & Chocolates">Candies & Chocolates</option>
                                    <option value="Dairy Products">Dairy Products</option>
                                    <option value="Condiments & Sauces">Condiments & Sauces</option>
                                    <option value="Cooking Ingredients & Seasonings">Cooking Ingredients & Seasonings
                                    </option>
                                    <option value="Spreads and Fillings">Spreads & Fillings</option>
                                    <option value="School Supplies">School Supplies</option>
                                </select>
                            </div>
                            <div class="labelInput">
                                <label for="unit">Unit</label>
                                <select id="unit" name="unit" required>
                                    <option value=""></option>
                                    <option value="Piece">Piece</option>
                                    <option value="Pack">Pack</option>
                                </select>
                            </div>
                        </div>
                        <div class="additionalInfo">
                            <div class="pricingInfo">
                                <label for="pricingInfo">Pricing Info</label><br><br>
                                <div class="labelInput">
                                    <label>Unit Price</label>
                                    <input type="text" id="username" name="unitPrice" required><br><br>
                                </div>
                                <div class="labelInput">
                                    <label>Retail Price</label>
                                    <input type="text" id="username" name="retailPrice" required><br><br>
                                </div>
                            </div>
                            <div class="stockInfo">
                                <label for="stockInfo">Stock Info</label><br><br>
                                <div class="labelInput">
                                    <label>Stock</label>
                                    <input type="text" id="username" name="stock" required><br><br>
                                </div>
                            </div>
                            <div class="updateButtons">
                                <button class="addProduct" id="addNewProductBtn" name="addNewProductBtn"
                                    type="submit">Add Product</button>
                                <button class="cancel" id="cancelBtn">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- tama man -->
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['passProductInfoBtn'])) {
        $productId = $_POST['productId_info'];

        
        // Fetch data from the database

        $select_query = "SELECT * FROM `inventory` WHERE `product_id` = '$productId'";
        $result = mysqli_query($conn, $select_query);

        // Check if the query was successful
        if ($result && mysqli_num_rows($result) > 0) {
            // Fetch the product details
            $row = mysqli_fetch_assoc($result);
            $productName_info = $row['product_name'];
            $netWeight_info = $row['net_weight'];
            $unit_info = $row['unit'];
            $category_info = $row['category'];
            $unitPrice_info = $row['unit_price'];
            $retailPrice_info = $row['retail_price'];
            $stock_info = $row['stock'];
            $url_info = $row['picture_url'];

        } else {
            // No matching product found
            echo "Product not found!";
        }
    }
    ?>

    <div id="updateProductModal">
        <div class="background">
            <div class="ItemContainer">
                <h3>Update Product Information</h3>
                <form id="addProductForm" name="addProductForm" action="PhpFunctions/update_product.php" method="POST">
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
                            <input type="hidden" id="productIdInput" name="productId">
                            <div class="labelInput">
                                <label>Product Name</label>
                                <input type="text" id="username" name="productName" id="productNameInput"
                                    value="<?php echo $productName_info; ?>" required><br><br>
                            </div>
                            <div class="labelInput">
                                <label>Net Weight</label>
                                <?php if ($netWeight_info != NULL) { ?>
                                    <input type="text" id="username" name="netWeight" id="netWeightInput"
                                        value="<?php echo $netWeight_info; ?>"><br><br>
                                <?php } ?>
                            </div>
                            <!-- <div class="labelInput">
                            <label>Product ID</label>
                            <input type="text" id="username" required><br><br>
                        </div> -->
                            <div class="labelInput">
                                <label for="category">Category</label>
                                <select id="category" name="category" id="categoryInput" required>
                                    <option value="" <?php if ($category_info == '')
                                        echo 'selected'; ?>></option>
                                    <option value="Canned Goods" <?php if ($category_info == 'Canned Goods')
                                        echo 'selected'; ?>>Canned Goods</option>
                                    <option value="Coffee" <?php if ($category_info == 'Coffee')
                                        echo 'selected'; ?>>Coffee
                                    </option>
                                    <option value="Biscuits" <?php if ($category_info == 'Biscuits')
                                        echo 'selected'; ?>>
                                        Biscuits</option>
                                    <option value="Ice Cream" <?php if ($category_info == 'Ice Cream')
                                        echo 'selected'; ?>>Ice
                                        Cream</option>
                                    <option value="Bread" <?php if ($category_info == 'Bread')
                                        echo 'selected'; ?>>Bread
                                    </option>
                                    <option value="Health & Beauty" <?php if ($category_info == 'Bread')
                                        echo 'selected'; ?>>
                                        Health & Beauty</option>
                                    <option value="Household & Cleaning Supplies" <?php if ($category_info == 'Bread')
                                        echo 'selected'; ?>>Household & Cleaning Supplies</option>
                                    <option value="PC Products" <?php if ($category_info == 'PC Products')
                                        echo 'selected'; ?>>
                                        Personal Collection Products</option>
                                    <option value="Cold Drinks" <?php if ($category_info == 'Cold Drinks')
                                        echo 'selected'; ?>>
                                        Cold Drinks</option>
                                    <option value="Powdered Drinks" <?php if ($category_info == 'Powdered Drinks')
                                        echo 'selected'; ?>>Powdered Drinks</option>
                                    <option value="Junk Foods" <?php if ($category_info == 'Junk Foods')
                                        echo 'selected'; ?>>
                                        Junk Foods</option>
                                    <option value="Cigarettes" <?php if ($categor_infoy == 'Cigarettes')
                                        echo 'selected'; ?>>
                                        Cigarettes</option>
                                    <option value="Frozen Foods" <?php if ($category_info == 'Frozen Foods')
                                        echo 'selected'; ?>>Frozen Foods</option>
                                    <option value="Instant Noodles" <?php if ($category_info == 'Instant Noodles')
                                        echo 'selected'; ?>>Instant Noodles</option>
                                    <option value="Alcoholic Beverages" <?php if ($category_info == 'Alcoholic Beverages')
                                        echo 'selected'; ?>>Alcoholic Beverages</option>
                                    <option value="Candies & Chocolates" <?php if ($category_info == 'Candies & Chocolates')
                                        echo 'selected'; ?>>Candies & Chocolates</option>
                                    <option value="Dairy Products" <?php if ($category_info == 'Dairy Products')
                                        echo 'selected'; ?>>Dairy Products</option>
                                    <option value="Condiments & Sauces" <?php if ($category_info == 'Condiments & Sauces')
                                        echo 'selected'; ?>>Condiments & Sauces</option>
                                    <option value="Cooking Ingredients & Seasonings" <?php if ($category_info == 'Cooking Ingredients & Seasonings')
                                        echo 'selected'; ?>>Cooking Ingredients & Seasonings
                                    </option>
                                    <option value="Spreads & Fillings" <?php if ($category_info == 'Spreads & Fillings')
                                        echo 'selected'; ?>>Spreads & Fillings</option>
                                    <option value="School Supplies" <?php if ($category_info == 'School Supplies')
                                        echo 'selected'; ?>>School Supplies</option>
                                </select>
                            </div>
                            <div class="labelInput">
                                <label for="unit">Unit</label>
                                <select id="unitInput" name="unit" value="<?php echo $unit_info; ?>" required>
                                    <option value="" <?php if ($unit_info == '')
                                        echo 'selected'; ?>></option>
                                    <option value="Piece" <?php if ($unit_info == 'Piece')
                                        echo 'selected'; ?>>Piece</option>
                                    <option value="Pack" <?php if ($unit_info == 'Pack')
                                        echo 'selected'; ?>>Pack</option>
                                </select>
                            </div>
                        </div>
                        <div class="additionalInfo">
                            <div class="pricingInfo">
                                <label for="pricingInfo">Pricing Info</label><br><br>
                                <div class="labelInput">
                                    <label>Unit Price</label>
                                    <input type="text" id="username" name="unitPrice" id="unitPriceInput"
                                        value="<?php echo $unitPrice_info; ?>" required><br><br>
                                </div>
                                <div class="labelInput">
                                    <label>Retail Price</label>
                                    <input type="text" id="username" name="retailPrice" id="retailPriceInput"
                                        value="<?php echo $retailPrice_info; ?>" required><br><br>
                                </div>
                            </div>
                            <div class="stockInfo">
                                <label for="stockInfo">Stock Info</label><br><br>
                                <div class="labelInput">
                                    <label>Stock</label>
                                    <input type="text" id="username" name="stock" id="stockInput"
                                        value="<?php echo $stock_info; ?>" required><br><br>
                                </div>
                            </div>
                            <div class="updateButtons">
                                <button class="addProduct" id="updateProductInfoBtn" name="updateProductInfoBtn"
                                    type="submit">Update Product</button>
                                <button class="cancel" id="cancelUpdateBtn" name="cancelUpdateBtn">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
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
            var addProductModal = document.getElementById("addProductModal");

            addProductModal.style.display = "block";
        });

        var cancelBtn = document.getElementById("cancelBtn");

        cancelBtn.addEventListener("click", function () {
            var addProductModal = document.getElementById("addProductModal");

            addProductModal.style.display = "none";
        });
    </script>


    <script>

        var updateProductBtn = document.getElementById("passProductInfoBtn");

        updateProductBtn.addEventListener("click", function (event) {
            // Prevent the default form submission behavior
            event.preventDefault();

            var productId = this.parentNode.querySelector('[name="productId_info"]').value;
            document.getElementById('productIdInput').value = productId;
            var updateProductModal = document.getElementById("updateProductModal");
            updateProductModal.style.display = "block";
        });

        var cancelUpdateBtn = document.getElementById("cancelUpdateBtn");

        cancelUpdateBtn.addEventListener("click", function (event) {
            // Prevent the default form submission behavior
            event.preventDefault();

            var updateProductModal = document.getElementById("updateProductModal");
            updateProductModal.style.display = "none";
        });

    </script>

    <script>
        //filter category
        function filterInventory(category) {
            var rows = document.querySelectorAll('.inventoryTable tbody tr');
            rows.forEach(function (row) {
                var categoryCell = row.cells[4].textContent;
                if (category === 'All' || categoryCell === category) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</body>

</html>