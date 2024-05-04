<?php
include ("PhpFunctions/connection.php");
include ("PhpFunctions/remove_product.php");
include ("PhpFunctions/add_product.php");
include ("PhpFunctions/update_product.php");
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
                            while ($row = $result->fetch_assoc()) { ?>
                                <form name="productTable" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                    <tr>
                                        <td><input type="checkbox" name="selectedProducts[]" value="<?php echo $row["product_id"]; ?>"></td>
                                        <td><?php echo $row["product_id"]; ?></td>
                                        <td><?php echo $row["product_name"]; ?></td>
                                        <td><?php echo $row["net_weight"] ?? '-'; ?></td>
                                        <td><?php echo $row["category"]; ?></td>
                                        <td><?php echo $row["unit_price"]; ?></td>
                                        <td><?php echo $row["retail_price"]; ?></td>
                                        <td><?php echo $row["stock"]; ?></td>
                                        <td>
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                                <!-- hidden inputs for the UpdateProductModal with product information -->
                                                <input type="hidden" name="productId_info" value="<?php echo $row["product_id"]; ?>">
                                                <input type="hidden" name="productName_info" value="<?php echo $row["product_name"]; ?>">
                                                <input type="hidden" name="netWeight_info" value="<?php echo $row["net_weight"]; ?>">
                                                <input type="hidden" name="category_info" value="<?php echo $row["category"]; ?>">
                                                <input type="hidden" name="unit_info" value="<?php echo $row["unit"]; ?>">
                                                <input type="hidden" name="unitPrice_info" value="<?php echo $row["unit_price"]; ?>">
                                                <input type="hidden" name="retailPrice_info" value="<?php echo $row["retail_price"]; ?>">
                                                <input type="hidden" name="stock_info" value="<?php echo $row["stock"]; ?>">
                                                <input type="hidden" name="url_info" value="<?php echo $row["picture_url"]; ?>">
                                                
                                                <button type="submit" name="passProductInfoBtn" id="passProductInfoBtn" class="updateProduct"><img src='../assets/edit.svg'></button>
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
                                        <img src="../assets/addImage.svg" id="editProductImage">
                                    </div>
                                    <div class="addImageBtn">
                                        <label>Add image</label>
                                        <label for="input-file" class="addProduct">Upload Image</label>
                                        <input type="file" accept="image/jpeg, image/png, image/jpg," id="input-file">
                                    </div>
                                </div>
                            </div>
                            <div class="labelInput">
                                <label>Product ID</label>
                                <input type="text" id="productIdInput" readonly><br><br>
                            </div>

                            <div class="labelInput">
                                <label>Product Name</label>
                                <input type="text" id="productNameInput" required><br><br>
                            </div>
                            <div class="labelInput">
                                <label>Net Weight</label>
                                <input type="text" id="netWeightInput"><br><br>
                            </div>
                            
                            <div class="labelInput">
                                <label for="category">Category</label>
                                <select name="category" id="categoryInput" required>
                                    <option value="" selected></option>
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
                                    <option value="Cooking Ingredients & Seasonings">Cooking Ingredients & Seasonings</option>
                                    <option value="Spreads & Fillings">Spreads & Fillings</option>
                                    <option value="School Supplies">School Supplies</option>
                                </select>

                            </div>
                            <div class="labelInput">
                                <label for="unit">Unit</label>
                                <select id="unitInput" name="unit" required>
                                    <option></option>
                                    <option>Piece</option>
                                    <option>Pack</option>
                                </select>
                            </div>
                        </div>
                        <div class="additionalInfo">
                            <div class="pricingInfo">
                                <label for="pricingInfo">Pricing Info</label><br><br>
                                <div class="labelInput">
                                    <label>Unit Price</label>
                                    <input type="text" id="unitPriceInput" name="unitPrice" id="unitPriceInput" required><br><br>
                                </div>
                                <div class="labelInput">
                                    <label>Retail Price</label>
                                    <input type="text" id="retailPriceInput" name="retailPrice" id="retailPriceInput" required><br><br>
                                </div>
                            </div>
                            <div class="stockInfo">
                                <label for="stockInfo">Stock Info</label><br><br>
                                <div class="labelInput">
                                    <label>Stock</label>
                                    <input type="text" id="stockInput" name="stock" id="stockInput" required><br><br>
                                </div>
                            </div>
                            <div class="updateButtons">
                                <button class="addProduct" id="updateProductInfoBtn" name="updateProductInfoBtn" type="submit">Update Product</button>
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
        //selects all buttons with the class updateProduct
        var updateProductBtns = document.querySelectorAll(".updateProduct");

        //loops through each button and attach the event listener
        updateProductBtns.forEach(function(btn) {
            btn.addEventListener("click", function(event) {
                //prevents from soubmitting the form and redirecting to update_product.php
                event.preventDefault();

                //gets the product information associated with these (from the hidden inputs)
                var productId = this.parentNode.querySelector('[name="productId_info"]').value;
                var productName = this.parentNode.querySelector('[name="productName_info"]').value;
                var netWeight = this.parentNode.querySelector('[name="netWeight_info"]').value;
                var category = this.parentNode.querySelector('[name="category_info"]').value;
                var unit = this.parentNode.querySelector('[name="unit_info"]').value;
                var unitPrice = this.parentNode.querySelector('[name="unitPrice_info"]').value;
                var retailPrice = this.parentNode.querySelector('[name="retailPrice_info"]').value;
                var stock = this.parentNode.querySelector('[name="stock_info"]').value;
                var url = this.parentNode.querySelector('[name="url_info"]').value;

                //sets the product info in the input fields inside the UpdateProductModal
                var productIdInput = document.getElementById('productIdInput');
                productIdInput.value = productId;

                var productNameInput = document.getElementById('productNameInput');
                productNameInput.value = productName;

                var netWeightInput = document.getElementById('netWeightInput');
                netWeightInput.value = netWeight;

                //gets the category value from the hidden input field
                var categoryValue = document.querySelector('[name="category_info"]').value;

                //selects the corresponding option in the dropdown menu
                var categoryInput = document.getElementById('categoryInput');
                for (var i = 0; i < categoryInput.options.length; i++) {
                    if (categoryInput.options[i].value === categoryValue) {
                        categoryInput.selectedIndex = i;
                        break;
                    }
                }

                //sets the unit value from the hidden input field
                var unitValue = document.querySelector('[name="unit_info"]').value;

                //selects the corresponding option in the dropdown menu
                var unitInput = document.getElementById('unitInput');
                for (var i = 0; i < unitInput.options.length; i++) {
                    if (unitInput.options[i].value === unitValue) {
                        unitInput.selectedIndex = i;
                        break;
                    }
                }

                var unitPriceInput = document.getElementById('unitPriceInput');
                unitPriceInput.value = unitPrice;

                var retailPriceInput = document.getElementById('retailPriceInput');
                retailPriceInput.value = retailPrice;

                var stockInput = document.getElementById('stockInput');
                stockInput.value = stock;

                //appends "../assets/InventoryItems/" to the url
                var pictureUrl = "../assets/InventoryItems/" + url;

                //changes the src of image (from ../assets/addImage.svg to current product's url)
                var editProductImage = document.getElementById('editProductImage');
                editProductImage.src = pictureUrl;

                var updateProductModal = document.getElementById("updateProductModal");
                updateProductModal.style.display = "block";
            });
        });

        var cancelUpdateBtn = document.getElementById("cancelUpdateBtn");

        cancelUpdateBtn.addEventListener("click", function (event) {
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