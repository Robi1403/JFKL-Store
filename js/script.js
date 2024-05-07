//redirect to inventory
document.getElementById("inventoryBtn").onclick = function () {
    window.location.href = "inventory.php";
};

//redirect to POS
document.getElementById("POSBtn").onclick = function () {
    window.location.href = "POS.php";
};

document.getElementById("inventoryBtn").onclick = function() {
    window.location.href = "inventory.php";
};

document.getElementById("POSBtn").onclick = function() {
    window.location.href = "POS.php";
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


function Compute() {
    var OverAllTotal = parseFloat(document.getElementById('OverAllTotal').innerText);
    var ClientAmount = parseFloat(UserInput.value);
    var changeDiv = document.getElementById('change');

    var Change = ClientAmount - OverAllTotal;

    if (isNaN(Change)) {
        changeDiv.innerHTML = 0;
    } else {
        changeDiv.innerHTML = Change;
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

