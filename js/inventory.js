//redirect to inventory
document.getElementById("inventoryBtn").onclick = function () {
    window.location.href = "inventory.php";
};

//redirect to POS
document.getElementById("POSBtn").onclick = function () {
    window.location.href = "POS.php";
};

//redirect to Sales
document.getElementById("salesBtn").onclick = function () {
    window.location.href = "sales.php";
};


//redirect to Inventory Log
document.getElementById("inventory_LogBtn").onclick = function () {
    window.location.href = "inventory_log.php";
};

//---SEARCH PRODUCT---//
document.getElementById("search").addEventListener("input", function () {
    var searchText = this.value.toLowerCase();

    //selects all rows in the table body
    var rows = document.querySelectorAll('.inventoryTable tbody tr');

    //loops through each row and check if it contains the search text
    rows.forEach(function (row) {
        //gets the product name 
        var productName = row.cells[2].textContent.toLowerCase();
        if (productName.includes(searchText)) {
            //shows the row if it contains the search text
            row.style.display = '';
        } else {
            //hides the row if it doesn't 
            row.style.display = 'none';
        }
    });
});
//---END---//

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

    //new ok na but automatically closes
        var addNewProductBtn = document.getElementById("addNewProductBtn");

        addNewProductBtn.addEventListener("click", function (event) {
            addProductModal.style.display = "none";
            
            var add_successPrompt = document.getElementById("add_successPrompt");
            add_successPrompt.style.display = "flex";

            var add_okBtn = document.getElementById("add_okBtn");

            add_okBtn.addEventListener("click", function () {
                add_successPrompt.style.display = "none";
            });
        });
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

        var productURLInput = document.getElementById('productURLInput');
        productURLInput.value = url;

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

        //new ok na but automatically closes
        var updateProductInfoBtn = document.getElementById("updateProductInfoBtn");

        updateProductInfoBtn.addEventListener("click", function (event) {
            updateProductModal.style.display = "none";

            var update_successPrompt = document.getElementById("update_successPrompt");
            update_successPrompt.style.display = "flex";

            var update_okBtn = document.getElementById("update_okBtn");

            update_okBtn.addEventListener("click", function () {
                update_successPrompt.style.display = "none";
            });
        });
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

    var modalConfirm = document.getElementById("modalConfirmBackground");
    modalConfirm.style.display = "flex";


    var confirmCancelBtn = document.getElementById("confirmCancelBtn");

    confirmCancelBtn.addEventListener("click", function () {
        var modalConfirm = document.getElementById("modalConfirmBackground");

        modalConfirm.style.display = "none";
    });


    var confirmation = document.getElementById("confirmBtn");

    confirmation.addEventListener("click", function () {
        //update the hidden input field with selected products 
        document.getElementById("selectedProducts").value = selectedProducts.join(',');

        document.getElementById("removeProductForm").submit();

        var remove_successPrompt = document.getElementById("remove_successPrompt");

        remove_successPrompt.style.display = "flex";

        var remove_okBtn = document.getElementById("remove_okBtn");

        remove_okBtn.addEventListener("click", function () {
            remove_successPrompt.style.display = "none";
        });
    });


}

document.getElementById("removeProductBtn").onclick = function () {
    removeSelectedProducts();
};

//---END---//

//redirect Inventory Log back to inventory
document.getElementById("backBtn").onclick = function () {
    window.location.href = "inventory.php";
};
