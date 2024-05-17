<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="icon" href="../assets/storeLogo.svg">
    <title>JFKL Login</title>
</head>
<body>
    <div class="container">
        <form name="form" action="PhpFunctions/login.php" method="POST">
            <h3>Login</h3>

            <div class="errorUser" id="errorUser" style="display: <?php echo isset($_SESSION['login_error']) ? 'flex' : 'none'; ?>;">
                <p><?php echo isset($_SESSION['login_error']) ? $_SESSION['login_error'] : ''; ?></p>
            </div>

            <input type="text" id="username" name="username" placeholder="Username" required><br><br>
            
            <input type="password" id="password" name="password" placeholder="Password" required><br><br>

            <button type="submit" id="submit" name="submit" value="login">Sign In</button>
            
            <div id="logo">
                <img src="../assets/storeLogo.svg" alt="">
                <p>JFKL Store</p>
            </div>
        </form>
    </div>

    <script>
        // JavaScript to hide the error message when the user starts typing
        document.getElementById('username').addEventListener('input', function() {
            document.getElementById('errorUser').style.display = 'none';
        });

        document.getElementById('password').addEventListener('input', function() {
            document.getElementById('errorUser').style.display = 'none';
        });
    </script>

    <?php
    // Unset the login error after displaying it
    unset($_SESSION['login_error']);
    ?>
</body>
</html>
