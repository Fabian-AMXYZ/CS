<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

require_once 'database.php';

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_username = $_POST['username'];
    $new_email = $_POST['email'];
    $new_password = $_POST['password'];

    if ($new_password) {
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
        $updateQuery = "UPDATE users SET username = ?, email = ?, password = ? WHERE username = ?";
        $stmt = mysqli_prepare($conn, $updateQuery);
        mysqli_stmt_bind_param($stmt, 'ssss', $new_username, $new_email, $hashed_password, $username);
    } else {
        $updateQuery = "UPDATE users SET username = ?, email = ? WHERE username = ?";
        $stmt = mysqli_prepare($conn, $updateQuery);
        mysqli_stmt_bind_param($stmt, 'sss', $new_username, $new_email, $username);
    }
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['username'] = $new_username;
        header('Location: edit_profile.php?success=true');
        exit;
    } else {
        $error = "Error updating profile.";
    }
}

// Fetch current user data
$query = "SELECT username, email FROM users WHERE username = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 's', $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body class="dark-theme">
    <header>
        <h1>Digital Codex</h1>
        <div class="auth-links">
            <?php
            if (isset($_SESSION['username'])) {
                $username = $_SESSION['username'];

                echo "<span>Welcome, $username!</span>";
                echo "<a href='index.php'>Homepage</a>";
                echo "<a href='games.php'>Browse games</a>";
                echo "<a href='library.php'>Library</a>";
                echo "<a href='cart.php'>Cart</a>";
                echo "<a href='logout.php'>Logout</a>";
            } else {
                echo "<a href='login.php'>Login</a>";
                echo "<a href='register.php'>Register</a>";
            }
            ?>
        </div>
    </header>
    <main>
        <div class="login-container dark-container">
            <h2>Edit Profile</h2>
            <?php if (isset($_GET['success'])) : ?>
                <p class="success-message">Profile updated successfully!</p>
            <?php endif; ?>
            <?php if (isset($error)) : ?>
                <p class="error-message"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
            <form action="edit_profile.php" method="post">
                <div class="input-group">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" value="<?= htmlspecialchars($user['username']) ?>" required>
                </div>
                <div class="input-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                </div>
                <div class="input-group">
                    <label for="password">New Password (leave blank to keep current password):</label>
                    <input type="password" name="password" id="password">
                </div>
                <button type="submit" class="submit-button">Update Profile</button>
            </form>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Digital Codex. All rights reserved.</p>
    </footer>
</body>

</html>