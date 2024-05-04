//redirect to inventory
document.getElementById("inventoryBtn").onclick = function () {
    window.location.href = "inventory.php";
};

//redirect to POS
document.getElementById("POSBtn").onclick = function () {
    window.location.href = "POS.php";
};

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

//---ADD PRODUCT---//

//To get uploaded img
let productImage = document.getElementById("productImage");
let inputFile = document.getElementById("input-file");

inputFile.onchange = function () {
    productImage.src = URL.createObjectURL(inputFile.files[0]);
}

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

//---END---//


//---UPDATE PRODUCT INFO---//

//selects all buttons with the class updateProduct
var updateProductBtns = document.querySelectorAll(".updateProduct");

//loops through each button and attach the event listener
updateProductBtns.forEach(function (btn) {
    btn.addEventListener("click", function (event) {
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

        //selects the corresponding option in the dropdown menu
        var categoryInput = document.getElementById('categoryInput');
        for (var i = 0; i < categoryInput.options.length; i++) {
            if (categoryInput.options[i].value === category) {
                categoryInput.selectedIndex = i;
                break;
            }
        }

        //selects the corresponding option in the dropdown menu
        var unitInput = document.getElementById('unitInput');
        for (var i = 0; i < unitInput.options.length; i++) {
            if (unitInput.options[i].value === unit) {
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

//---END---//


//---DELETE PRODUCT---//

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

//---END---//