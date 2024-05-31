<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$cart = $_SESSION['cart'] ?? [];
$total = array_sum(array_column($cart, 'price'));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_SESSION['username'];
    $users = json_decode(file_get_contents('users.json'), true);

    foreach ($users as &$user) {
        if ($user['username'] === $username) {
            if (!isset($user['library'])) {
                $user['library'] = [];
            }

            foreach ($cart as $item) {
                if (!in_array($item, $user['library'])) {
                    $user['library'][] = $item;
                }
            }
            break;
        }
    }

    file_put_contents('users.json', json_encode($users));
    $_SESSION['cart'] = [];
    header('Location: library.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Digital Codex</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Digital Codex</h1>
        <div class="auth-links">
            <a href="index.php">Homepage</a>
            <a href="library.php">Library</a>
            <?php if (isset($_SESSION['username'])): ?>
                <span>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</span>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
            <?php endif; ?>
        </div>
    </header>
    <main>
    <div class="login-container">
        <h2>Checkout</h2>
        <form action="checkout.php" method="post">
        <form id="loginForm">
        <div class="input-group">
            <label for="payment-method">Payment Method</label>
            <select id="payment-method" name="payment_method" required>
            </div>
                <option value="credit_card">Credit Card</option>
                <option value="paypal">PayPal</option>
                <option value="bank_transfer">Bank Transfer</option>
            </select>
            <div class="input-group">
            <label for="credentials">Payment Credentials</label>
            <input type="text" id="credentials" name="credentials" required>
            </div>
            <button type="submit">Confirm Purchase</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 Digital Codex. All rights reserved.</p>
    </footer>
</body>
</html>