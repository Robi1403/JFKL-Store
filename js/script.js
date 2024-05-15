//redirect to inventory
document.getElementById("inventoryBtn").onclick = function () {
    window.location.href = "inventory.php";
};

//redirect to POS
document.getElementById("POSBtn").onclick = function () {
    window.location.href = "POS.php";
};

//redirect to sales
document.getElementById("salesBtn").onclick = function () {
    window.location.href = "sales.php";
};

//redirect to login page
document.getElementById("logoutBtn").onclick = function () {
    window.location.href = "LoginPage.php";
};

var OverAllTotal = parseFloat(document.getElementById('OverAllTotal').innerText);
var ClientAmount = parseFloat(document.getElementById('ClientAmount').value);
var changeDiv = document.getElementById('change');

var Change = ClientAmount - OverAllTotal;

changeDiv.innerHTML = Change;

var UserInput = document.getElementById('ClientAmount');
var typingTimer; 
var doneTypingInterval = 500; 

Compute();

UserInput.addEventListener("keyup", function(event) {
    clearTimeout(typingTimer); 


    typingTimer = setTimeout(function() {
        Compute(); 
    }, doneTypingInterval);
});

var OverAllTotal = parseFloat(document.getElementById('OverAllTotal').innerText);
var ClientAmount = parseFloat(document.getElementById('ClientAmount').value);
var changeDiv = document.getElementById('change');

var Change = ClientAmount - OverAllTotal;

changeDiv.innerHTML = Change;

var UserInput = document.getElementById('ClientAmount');
var typingTimer; 
var doneTypingInterval = 500; 

Compute();

UserInput.addEventListener("keyup", function(event) {
    clearTimeout(typingTimer); 


    typingTimer = setTimeout(function() {
        Compute(); 
    }, doneTypingInterval);
});


function Compute() {
    var OverAllTotal = parseFloat(document.getElementById('OverAllTotal').innerText);
    var ClientAmount = parseFloat(UserInput.value);
    var changeDiv = document.getElementById('change');
    var showReceive = document.querySelector('.showReceive');
    var showChange = document.querySelector('.showChange');


    var Change = ClientAmount - OverAllTotal;

    if (isNaN(Change)) {
        changeDiv.innerHTML = 0;
        showChange.innerHTML = "₱ " +  0;
    } else {
        changeDiv.innerHTML = Change;
        showChange.innerHTML = "₱ " +  Change;
    }
    if (isNaN(ClientAmount)){
        showReceive.innerHTML = "₱ " + 0;
    }else{
        showReceive.innerHTML = "₱ " + ClientAmount;
    }
    
 
}


$(document).ready(function () {

    $('#search').keyup(function () {
        var input = $(this).val();
        if (input != "") {
            $.ajax({

                url: "PhpFunctions/livesearch.php",
                method:"POST",
                data:{input:input},
                success:function(data){

                    $("#SearchResult").html(data);
                    $("#SearchBg").css("display", "flex")

                }

            })

        }else{
            $("#SearchBg").css("display", "none")
        }
    })
    
})

$(document).ready(function() {
    $(document).on('click', '.toCart', function(event) { 

        event.preventDefault(); 
        var id = $(this).siblings(".ProductID").val();
        $.ajax({
            method: 'POST',
            url: 'PhpFunctions/modal.php',
            data: {id: id},
            success: function(response) {
                $(".addItem").css("display", "flex");
                $('.addItem').html(response);
            },
            error: function(xhr, status, error) {
                alert("An error occurred: " + error); 
            }
        });
    });
});

$(document).ready(function() {
    $(document).on('click', '.ConfirmBtn', function(event) { 
        event.preventDefault(); 
        $.ajax({
            method: 'POST',
            url: '', 
            data: { 
                action: 'saveData', 
                numberOfItems: '<?php echo $numberOfItems; ?>',
                SubTotal: '<?php echo $SubTotal; ?>',
                realCostofGoods: '<?php echo $realCostofGoods; ?>',
                cart: '<?php echo $cartArray ?>' 
               
            },
            success: function(response) {
                $(".OrderSummary").css("display", "none");
                $(".successPrompt").css("display", "flex");
            },
            error: function(xhr, status, error) {
                alert("An error occurred: " + error); 
            }
        });
    });
});