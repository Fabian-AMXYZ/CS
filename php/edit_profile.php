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
</head>
<body>
    <h2>Edit Profile</h2>
    <?php if (isset($_GET['success'])): ?>
        <p>Profile updated successfully!</p>
    <?php endif; ?>
    <?php if (isset($error)): ?>
        <p><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form action="edit_profile.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?= htmlspecialchars($user['username']) ?>" required>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($user['email']) ?>" required>
        <label for="password">New Password (leave blank to keep current password):</label>
        <input type="password" name="password" id="password">
        <button type="submit">Update Profile</button>
    </form>
</body>
</html>
