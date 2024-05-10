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