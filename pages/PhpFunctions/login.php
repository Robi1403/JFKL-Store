<?php
session_start();
include("connection.php");

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $_SESSION['loggedin'] = true;
        unset($_SESSION['login_error']);  // Clear any previous error
        header("Location: ../POS.php");
        exit();
    } else {
        $_SESSION['login_error'] = "Incorrect username or password.";
        header("Location: ../LoginPage.php");
        exit();
    }
}

if (isset($_GET['action'])) {
    if ($_GET['action'] == "logout") {
        unset($_SESSION['loggedin']);
    }
}
?>