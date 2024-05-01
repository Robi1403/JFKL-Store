<?php
    include("connection.php");


    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];


        $sql = "select * from user where username = '$username' and password = '$password'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);

        if ($count == 1) {
            header("Location:../POS.html");
        }else {
            echo `<script>
            window.location.href = "../LoginPage.php";
            alert("Login Failed");
            </script>`;
            header("Location:../LoginPage.php");
        }


    }
    

    
?>