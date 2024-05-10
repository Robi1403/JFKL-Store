//redirect to inventory
document.getElementById("inventoryBtn").onclick = function () {
    window.location.href = "inventory.php";
};

//redirect to POS
document.getElementById("POSBtn").onclick = function () {
    window.location.href = "POS.php";
};

function filterInventory(category) {
    var items = document.querySelectorAll('.ItemCardView');
    items.forEach(function (item) {
        var categoryCell = item.querySelector('input[name="category"]').value.trim();
        if (category === 'All' || categoryCell === category) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
}

// //
// document.addEventListener("DOMContentLoaded", function () {
//     var showModalButtons = document.querySelectorAll(".showthemodal");

//     var modal = document.getElementById("modalmodal");

//     showModalButtons.forEach(function (button) {
//         button.addEventListener("click", function () {
//             event.preventDefault();

//             var parentForm = button.closest("form");

//             var productIdInput = parentForm.querySelector("input[name='productId']");
//             var productNameInput = parentForm.querySelector("input[name='productName']");
//             var netWeight = parentForm.querySelector("input[name='netWeight']");
//             var productRetailPrice = parentForm.querySelector("input[name='productRetailPrice']");
//             var productUnitPrice = parentForm.querySelector("input[name='productUnitPrice']");
//             var productURL = parentForm.querySelector("input[name='productURL']");
//             var quantity = parentForm.querySelector("input[name='quantity']");

//             //getting the value from hidden input of the itemView
//             var productId = productIdInput.value;
//             var productName = productNameInput.value;
//             var netWeight = netWeight.value;
//             var productRetailPrice = productRetailPrice.value;
//             var productUnitPrice = productUnitPrice.value;
//             var productURL = productURL.value;
//             var quantity = quantity.value;

//             // alert("Product ID: " + productId +
//             //     "\nProduct Name: " + productName +
//             //     "\nNet Weight: " + netWeight +
//             //     "\nRetail Price: " + productRetailPrice +
//             //     "\nUnit Price: " + productUnitPrice +
//             //     "\nProduct URL: " + productURL +
//             //     "\nQuantity: " + quantity);

//             //populating the hidden input in the modal
//             document.getElementById("productIdHidden").value = productId;
//             document.getElementById("productNameHidden").value = productName;
//             document.getElementById("netWeightHidden").value = netWeight;
//             document.getElementById("productRetailPriceHidden").value = productRetailPrice;
//             document.getElementById("productUnitPriceHidden").value = productUnitPrice;
//             document.getElementById("quantityHidden").value = quantity;
//             document.getElementById("productURLHidden").value = productURL;

//             //populates elements in the modal
//             document.getElementById("productNameInfo").textContent = productName;
//             document.getElementById("netWeightInfo").textContent = netWeight;
//             document.getElementById("productRetailPriceInfo").textContent = "₱" + productRetailPrice;

//             //img src to show picture of product
//             var imgElement = document.getElementById("productImage");
//             imgElement.src = "../assets/InventoryItems/" + productURL;

//             modal.style.display = "flex";
//         });
//     });

//     var forms = document.querySelectorAll(".itemView form");

//     forms.forEach(function (form) {
//         form.addEventListener("submit", function (event) {
//             event.preventDefault();
//         });
//     });

// });

//minus 1 to quantity
function decreaseQuantity() {
    var inputElement = document.querySelector('.quantityInput');
    var currentValue = parseInt(inputElement.value);
    if (currentValue > 1) {
        inputElement.value = currentValue - 1;
    }
}

//add 1 to quantity
function increaseQuantity() {
    var inputElement = document.querySelector('.quantityInput');
    var currentValue = parseInt(inputElement.value);
    inputElement.value = currentValue + 1;
}

//hide modal 
function exitModal() {
    var cancel = document.querySelector('.modalmodal');
    cancel.style.display = 'none';
}

//calculate
var OverAllTotal = parseFloat(document.getElementById('OverAllTotal').innerText);
var ClientAmount = parseFloat(document.getElementById('ClientAmount').value);
var changeDiv = document.getElementById('change');

var Change = ClientAmount - OverAllTotal;

changeDiv.innerHTML = Change;

//
function Compute() {

    var OverAllTotal = parseFloat(document.getElementById('OverAllTotal').innerText);
    var ClientAmount = parseFloat(document.getElementById('ClientAmount').value);
    var changeDiv = document.getElementById('change');

    var Change = ClientAmount - OverAllTotal;

    if (isNaN(Change)) {
        changeDiv.innerHTML = 0;
    } else {
        changeDiv.innerHTML = Change;
    }
}

Compute();

setInterval(Compute, 1000);

