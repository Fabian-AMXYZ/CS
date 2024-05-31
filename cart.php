<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $price = $_POST['price'];
    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $alreadyInCart = false;
    foreach ($_SESSION['cart'] as $item) {
        if ($item['title'] === $title) {
            $alreadyInCart = true;
            break;
        }
    }

    if (!$alreadyInCart) {
        $_SESSION['cart'][] = ['title' => $title, 'price' => $price];
    }

    header('Location: cart.php');
    exit;
}

$cart = $_SESSION['cart'] ?? [];
$total = array_sum(array_column($cart, 'price'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Digital Codex</title>
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
        <h2>Cart</h2>
        <?php if ($cart): ?>
            <table>
                <tr>
                    <th>Title</th>
                    <th>Price</th>
                </tr>
                <?php foreach ($cart as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['title']) ?></td>
                        <td>$<?= number_format($item['price'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td>Total</td>
                    <td>$<?= number_format($total, 2) ?></td>
                </tr>
            </table>
            <a href="checkout.php" class="button">Proceed to Checkout</a>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </main>
    <footer>
        <p>&copy; 2024 Digital Codex. All rights reserved.</p>
    </footer>
</body>
</html>