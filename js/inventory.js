// Function to update date
function updateDate() {
    let today = new Date();

    // return number
    let dayName = today.getDay(),
        dayNum = today.getDate(),
        month = today.getMonth(),
        year = today.getFullYear();

    const months = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
    ];
    const dayWeek = [
        "Sunday",
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday",
    ];
    // value -> ID of the html element
    const IDCollection = ["day", "daynum", "month", "year"];
    // return value array with number as a index
    const val = [dayWeek[dayName], dayNum, months[month], year];
    for (let i = 0; i < IDCollection.length; i++) {
        document.getElementById(IDCollection[i]).textContent = val[i];
    }
}

// Function to update time
function updateTime() {
    const displayTime = document.querySelector(".display-time");
    let time = new Date();
    displayTime.innerText = time.toLocaleTimeString("en-US", { hour12: true });
}

// Function to update date and time periodically
function updateDateTime() {
    updateDate(); // Update date
    updateTime(); // Update time
    setTimeout(updateDateTime, 1000); // Call this function again after 1 second
}

// Call updateDateTime initially to start the updating process
updateDateTime();

document.addEventListener('DOMContentLoaded', function () {
    const categoryContainer = document.querySelector('.category');

    categoryContainer.addEventListener('wheel', function (event) {
        if (event.deltaY > 0) {
            categoryContainer.scrollLeft += 50;
        } else {
            categoryContainer.scrollLeft -= 50;
        }
        event.preventDefault();
    });
});

//redirect to POS
document.getElementById("POSBtn").onclick = function () {
    window.location.href = "POS.php";
};

//redirect to Sales
document.getElementById("salesBtn").onclick = function () {
    window.location.href = "sales.php";
};

//redirect to login page
document.getElementById("logoutBtn").onclick = function () {
    window.location.href = "LoginPage.php";
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
let productURL = document.getElementById("productURL");

inputFile.onchange = function () {
    let file = inputFile.files[0];
    if (file) {
        productImage.src = URL.createObjectURL(file);

        productURL.value = file.name;
    }
};



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
//To get uploaded img
let updateProductImage = document.getElementById("updateProductImage");
let updateInput = document.getElementById("updateInput-file");
let productURLInput = document.getElementById("productURLInput");

updateInput.onchange = function () {
    let file = updateInput.files[0];
    if (file) {
        updateProductImage.src = URL.createObjectURL(file);

        productURLInput.value = file.name;
    }
};

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
        var updateBoolean = this.parentNode.querySelector('[name="updateBoolean"]').value;

        //sets the product info in the input fields inside the UpdateProductModal
        var updateBooleanInput = document.getElementById('updateBooleanInput');
        updateBooleanInput.value = updateBoolean;

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
        var updateProductImage = document.getElementById('updateProductImage');
        updateProductImage.src = pictureUrl;

        var updateProductModal = document.getElementById("updateProductModal");
        updateProductModal.style.display = "block";

        var updateProductInfoBtn = document.getElementById("updateProductInfoBtn");

        updateProductInfoBtn.addEventListener("click", function (event) {
            updateProductModal.style.display = "none";
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
