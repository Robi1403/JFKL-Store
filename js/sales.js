<<<<<<< HEAD
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

//
    document.addEventListener("DOMContentLoaded", function () {
        var dropdownSelect = document.querySelector('.dropdown-select');
        var dropdownList = document.querySelector('.dropdown-list');
        var dropdownOptions = document.querySelectorAll('.dropdown-list li');
        var selectSpan = document.querySelector('.select');

        dropdownSelect.addEventListener('click', function () {
            dropdownList.style.display = (dropdownList.style.display === 'block') ? 'none' : 'block';
        });

        dropdownOptions.forEach(function(option) {
            option.addEventListener('click', function() {
                selectSpan.textContent = option.textContent;
                dropdownList.style.display = 'none';
            });
        });

        document.addEventListener('click', function (e) {
            if (!dropdownSelect.contains(e.target)) {
                dropdownList.style.display = 'none';
            }
        });
    });
    
//
$(function() {

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);

=======
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

//
document.addEventListener("DOMContentLoaded", function () {
    var dropdownSelect = document.querySelector('.dropdown-select');
    var dropdownList = document.querySelector('.dropdown-list');
    var dropdownOptions = document.querySelectorAll('.dropdown-list li');
    var selectSpan = document.querySelector('.select');

    dropdownSelect.addEventListener('click', function () {
        dropdownList.style.display = (dropdownList.style.display === 'block') ? 'none' : 'block';
    });

    dropdownOptions.forEach(function (option) {
        option.addEventListener('click', function () {
            selectSpan.textContent = option.textContent;
            dropdownList.style.display = 'none';
        });
    });

    document.addEventListener('click', function (e) {
        if (!dropdownSelect.contains(e.target)) {
            dropdownList.style.display = 'none';
        }
    });
>>>>>>> parent of 13065b7 (working modal)
});