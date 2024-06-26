<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Digital Codex</title>
    <link rel="stylesheet" href="styles.css">
</head>
<header>
    <h1>Digital Codex</h1>
    <div class="auth-links">
        <a href="index.php">Homepage</a>
    </div>
</header>

<body>
    <main>
        <div class="login-container">
            <h2>Register</h2>
            <?php
            if (isset($_POST["submit"])) {
                $fullname = $_POST["fullname"];
                $username = $_POST["username"];
                $email = $_POST["email"];
                $password = $_POST["password"];
                $passwordr = $_POST["rpassword"];

                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $errors = array();

                if (empty($fullname) or empty($username) or empty($email) or empty($password) or empty($passwordr)) {
                    array_push($errors, "All fields are required to be filled");
                }
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    array_push($errors, "Email is not valid");
                }
                if (strlen($password) < 8) {
                    array_push($errors, "Password must be atleast 8 characters");
                }
                if ($password !== $passwordr) {
                    array_push($errors, "Password does not match!");
                }

                require_once "database.php";
                $sql = "SELECT * FROM users WHERE email = '$email'" or "SELECT * FROM users WHERE username = '$username'";
                $result = mysqli_query($conn, $sql);
                $rowCount = mysqli_num_rows($result);
                if ($rowCount > 0) {
                    array_push($errors, "Email or username already exist!");
                }

                if (count($errors) > 0) {
                    foreach ($errors as $error) {
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                } else {
                    $sql = "INSERT INTO users(full_name, username, email, password) VALUES ( ?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                    if ($prepareStmt) {
                        mysqli_stmt_bind_param($stmt, "ssss", $fullname, $username, $email, $passwordHash);
                        mysqli_stmt_execute($stmt);
                        echo "<div class='alert alert-success'>You are registered successfully</div>";
                    } else {
                        die("Something went wrong");
                    }
                }
            }
            ?>

            <form action="register.php" method="post">
                <form id="loginForm">
                    <div class="input-group">
                        <label for="fullname">Full Name</label>
                        <input type="text" id="fullname" placeholder="Enter Full Name" name="fullname">
                    </div>
                    <div class="input-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" placeholder="Enter Username" name="username">
                    </div>
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="text" id="email" placeholder="Enter Email" name="email">
                    </div>
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" placeholder="Enter Password" name="password">
                    </div>
                    <div class="input-group">
                        <label for="rpassword">Repeat Password</label>
                        <input type="password" id="rpassword" placeholder="Enter Password Again" name="rpassword">
                    </div>
                    <input type="submit" class="input-btn" value="Register" id="register" name="submit">
                </form>
                <div>
                    <p>Already registered? <a href="login.php" style="color: white;">Login here</a></p>
                </div>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Digital Codex. All rights reserved.</p>
    </footer>
</body>

</html>