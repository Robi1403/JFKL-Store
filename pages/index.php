<?php
    include("PhpFunctions/connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <form name="form" action="PhpFunctions/login.php" method="POST">
            <h3>Login</h3>
            
            <input type="text" id="username" name="username" placeholder="Username" required><br><br>
            
            <input type="password" id="password" name="password" placeholder="Password" required><br><br>

            <button type="submit" id="submit" name="submit" value="login">Sign In</button>
            
            <div id="logo">
                <img src="../assets/storeLogo.svg" alt="">
                <p>JFKL Store</p>
            </div>
        </form>
    </div>
    
</body>
</html>