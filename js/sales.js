//redirect to inventory
document.getElementById("inventoryBtn").onclick = function () {
    window.location.href = "inventory.php";
};

//redirect to POS
document.getElementById("POSBtn").onclick = function () {
    window.location.href = "POS.php";
};

//redirect to login page
document.getElementById("logoutBtn").onclick = function () {
    window.location.href = "LoginPage.php";
};

//date time 
function updateDate() {
    let today = new Date();

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
    const IDCollection = ["day", "daynum", "month", "year"];
    const val = [dayWeek[dayName], dayNum, months[month], year];
    for (let i = 0; i < IDCollection.length; i++) {
        document.getElementById(IDCollection[i]).textContent = val[i];
    }
}

function updateTime() {
    const displayTime = document.querySelector(".display-time");
    let time = new Date();
    displayTime.innerText = time.toLocaleTimeString("en-US", { hour12: true });
}

function updateDateTime() {
    updateDate();
    updateTime();
    setTimeout(updateDateTime, 1000);
}

updateDateTime();

//dropdown
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
});

//get date
$(function () {
    var start = moment();
    var end = moment();

    var savedStartDate = localStorage.getItem('startDate');
    var savedEndDate = localStorage.getItem('endDate');

    if (savedStartDate && savedEndDate) {
        start = moment(savedStartDate);
        end = moment(savedEndDate);
    } else {
        start = moment();
        end = moment();
    }

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

        $('#startDate').val(start.format('YYYY-MM-DD'));
        $('#endDate').val(end.format('YYYY-MM-DD'));

        localStorage.setItem('startDate', start.format('YYYY-MM-DD'));
        localStorage.setItem('endDate', end.format('YYYY-MM-DD'));
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

    $('#reportrange').on('apply.daterangepicker', function (ev, picker) {

    localStorage.setItem('startDate', picker.startDate.format('YYYY-MM-DD'));
    localStorage.setItem('endDate', picker.endDate.format('YYYY-MM-DD'));
    $('#dateform').submit();
});
});

//reset date
function resetDateRangePicker() {
    var start = moment();
    var end = moment();

    $('#reportrange').data('daterangepicker').setStartDate(start);
    $('#reportrange').data('daterangepicker').setEndDate(end);

    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    $('#startDate').val(start.format('YYYY-MM-DD'));
    $('#endDate').val(end.format('YYYY-MM-DD'));

    localStorage.setItem('startDate', start.format('YYYY-MM-DD'));
    localStorage.setItem('endDate', end.format('YYYY-MM-DD'));
}