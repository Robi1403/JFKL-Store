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

            <form class="category" id="categoryContainer" name="categoryform"
                action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <button class="categoryBtn" type="submit" name="category" value="All">All</button>
                <button class="categoryBtn" type="submit" name="category" value="Canned Goods">Canned Goods</button>
                <button class="categoryBtn" type="submit" name="category" value="Coffee">Coffee</button>
                <button class="categoryBtn" type="submit" name="category" value="Biscuits">Biscuits</button>
                <button class="categoryBtn" type="submit" name="category" value="Ice Cream">Ice Cream</button>
                <button class="categoryBtn" type="submit" name="category" value="Bread">Bread</button>
                <button class="categoryBtn" type="submit" name="category" value="Health & Beauty">Health &
                    Beauty</button>
                <button class="categoryBtn" type="submit" name="category"
                    value="Household & Cleaning Supplies">Household & Cleaning Supplies</button>
                <button class="categoryBtn" type="submit" name="category" value="PC Products">Personal Collection
                    Products</button>
                <button class="categoryBtn" type="submit" name="category" value="Cold Drinks">Cold Drinks</button>
                <button class="categoryBtn" type="submit" name="category" value="Powdered Drinks">Powdered
                    Drinks</button>
                <button class="categoryBtn" type="submit" name="category" value="Junk Foods">Junk Foods</button>
                <button class="categoryBtn" type="submit" name="category" value="Cigarettes">Cigarettes</button>
                <button class="categoryBtn" type="submit" name="category" value="Frozen Foods">Frozen Foods</button>
                <button class="categoryBtn" type="submit" name="category" value="Instant Noodles">Instant
                    Noodles</button>
                <button class="categoryBtn" type="submit" name="category" value="Alcoholic Beverages">Alcoholic
                    Beverages</button>
                <button class="categoryBtn" type="submit" name="category" value="Candies & Chocolates">Candies &
                    Chocolates</button>
                <button class="categoryBtn" type="submit" name="category" value="Dairy Products">Dairy Products</button>
                <button class="categoryBtn" type="submit" name="category" value="Condiments & Sauces">Condiments &
                    Sauces</button>
                <button class="categoryBtn" type="submit" name="category"
                    value="Cooking Ingredients & Seasonings">Cooking Ingredients & Seasonings</button>
                <button class="categoryBtn" type="submit" name="category" value="Spreads & Fillings">Spreads &
                    Fillings</button>
                <button class="categoryBtn" type="submit" name="category" value="School Supplies">School
                    Supplies</button>
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
                        
                                echo '<form name="productInfo_form" action="' .htmlspecialchars($_SERVER["PHP_SELF"]) .'" method="POST" >';
                                echo '<input type="hidden" name="productId_info" value="' . $row["product_id"] . '">';
                                echo '<input type="hidden" name="productName_info" value="' . $row["product_name"] . '">';
                                echo '<input type="hidden" name="netWeight_info" value="' . $row["net_weight"] . '">';
                                echo '<input type="hidden" name="category_info" value="' . $row["category"] . '">';
                                echo '<input type="hidden" name="unit_info" value="' . $row["unit"] . '">';
                                echo '<input type="hidden" name="unitPrice_info" value="' . $row["unit_price"] . '">';
                                echo '<input type="hidden" name="retailPrice_info" value="' . $row["retail_price"] . '">';
                                echo '<input type="hidden" name="stock_info" value="' . $row["stock"] . '">';
                                echo '<input type="hidden" name="url_info" value="' . $row["picture_url"] . '">';

                                echo '<td><button type="submit" name="passProductInfo"<img src="../assets/edit.svg"></button></td>'; // Action Column
                                echo "</form>";
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

    <div class="background" id="addProductModal">
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
                            <button class="addProduct" id="addNewProductBtn" name="addNewProductBtn" type="submit">Add
                                Product</button>
                            <button class="cancel" id="cancelBtn">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['passProductInfo'])) {
        // Create a session array to store product data
        $session_array = array(
            'product_name' => $_POST['productName_info'],
            'net_weight' => $_POST['netWeight_info'],
            'category' => $_POST['category_info'],
            'unit' => $_POST['unit_info'],
            'unit_price' => $_POST['unitPrice_info'],
            'retail_price' => $_POST['retailPrice_info'],
            'picture_url' => $_POST['url_info'],
            'stock' => $_POST['stock_info'],
        );
    }
    ?>

    <div class="background" id="editProductInfoModal">
        <div class="ItemContainer">
            <h3>Update Product Information</h3>
            <form id="editProductInfoForm" name="editProductInfoForm" action="PhpFunctions/edit_productInfo.php"
                method="POST">
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
                            <input type="text" id="username" name="productName" <?php echo $value['product_name'] ?>
                                required><br><br>
                        </div>
                        <div class="labelInput">
                            <label>Net Weight</label>
                            <input type="text" id="username" name="netWeight" <?php echo $value['net_weight'] ?>><br><br>
                        </div>
                        <!-- <div class="labelInput">
                            <label>Product ID</label>
                            <input type="text" id="username" required><br><br>
                        </div> -->
                        <div class="labelInput">
                            <label for="category">Category</label>
                            <select id="category" name="category" <?php echo $value['category'] ?> required>
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
                            <select id="unit" name="unit" <?php echo $value['unit'] ?> required>
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
                                <input type="text" id="username" name="unitPrice" <?php echo $value['unit_price'] ?> required><br><br>
                            </div>
                            <div class="labelInput">
                                <label>Retail Price</label>
                                <input type="text" id="username" name="retailPrice" <?php echo $value['retail_price'] ?> required><br><br>
                            </div>
                        </div>
                        <div class="stockInfo">
                            <label for="stockInfo">Stock Info</label><br><br>
                            <div class="labelInput">
                                <label>Stock</label>
                                <input type="text" id="username" name="stock" <?php echo $value['stock'] ?> required><br><br>
                            </div>
                        </div>
                        <div class="updateButtons">
                            <button class="addProduct" id="editProductInfoBtn" name="editProductInfoBtn"
                                type="submit">Update Product Information</button>
                            <button class="cancel" id="cancelProductInfoBtn">Cancel</button>
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
            var modal = document.getElementById("addProductModal");

            modal.style.display = "block";
        });

        var cancelBtn = document.getElementById("cancelBtn");

        cancelBtn.addEventListener("click", function () {
            var modal = document.getElementById("addProductModal");

            modal.style.display = "none";
        });
    </script>

    <script>
        var addProductBtn = document.getElementById("editProductInfoBtn");

        addProductBtn.addEventListener("click", function () {
            var modal = document.getElementById("editProductInfoModal");

            modal.style.display = "block";
        });

        var cancelBtn = document.getElementById("cancelEditProductInfoBtn");

        cancelBtn.addEventListener("click", function () {
            var modal = document.getElementById("editProductInfoModal");

            modal.style.display = "none";
        });
    </script>

</body>

</html>