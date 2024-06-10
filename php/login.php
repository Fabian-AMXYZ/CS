<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Digital Codex</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Digital Codex</h1>
        <div class="auth-links">   
            <a href="index.php">Homepage</a>
        </div>
    </header>
    <main>
        <div class="login-container">
        <h1>Login</h1>
        <?php 
        if (isset($_POST["login"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];

            require_once "database.php";
            $sql = "SELECT * FROM users WHERE username = '$username'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if (password_verify($password, $user["password"])) {
                    session_start();
                    $_SESSION["user"] = "yes";
                    header("Location: index.php");
                    die();
                } else {
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                }
                    } else {
                        echo "<div class='alert alert-danger'>Username does not match</div>";
                    }
        } 
        ?>
        <form action="login.php" method="post">
            <form id="loginForm">
        <div class="input-group">
            <label for="username">Username</label>
            <input type="text" placeholder="Enter Username" id="username" name="username">
        </div>
        <div class="input-group">
            <label for="password">Password</label>
            <input type="password" placeholder="Enter Password" id="password" name="password">
        </div>
            <input type="submit" class="input-btn" value="Login" name="login">
    </form>
    <div><p>Not yet registered? <a href="register.php">Register here</a></p></div>
</div>    
</main>
     <footer>
        <p>&copy; 2024 Digital Codex. All rights reserved.</p>
    </footer>
</body>
</html>



