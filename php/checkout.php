<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize payment credentials
    $paymentMethod = $_POST['payment_method'] ?? '';
    $credentials = $_POST['credentials'] ?? '';

    // Perform additional validation if needed for payment credentials

    // Process checkout only if cart is not empty
    if (!empty($_SESSION['cart'])) {
        // Include database connection
        require_once "database.php";

        // Get logged-in user's ID
        $userId = $_SESSION['username'];

        // Insert purchase records into the database
        $purchaseDate = date("Y-m-d H:i:s");
        foreach ($_SESSION['cart'] as $item) {
            $gameId = $item['game_id'];
            $purchaseQuery = "INSERT INTO purchases (game_id, user_id, purchase_date) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $purchaseQuery);
            mysqli_stmt_bind_param($stmt, 'sss', $gameId, $userId, $purchaseDate);
            mysqli_stmt_execute($stmt);
        }

        // Clear the cart after successful purchase
        $_SESSION['cart'] = [];

        // Redirect to the library page after purchase
        header('Location: library.php');
        exit;
    }
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
            <?php
            if (isset($_SESSION['username'])) {
                $username = $_SESSION['username'];

                echo "<span>Welcome, $username!</span>";
                echo "<a href='index.php'>Homepage</a>";
                echo "<a href='games.php'>Browse games</a>";
                echo "<a href='library.php'>Library</a>";
                echo "<a href='edit_profile.php'>Edit Profile</a>";
                echo "<a href='logout.php'>Logout</a>";
            } else {
                echo "<a href='login.php'>Login</a>";
                echo "<a href='register.php'>Register</a>";
            }
            ?>
        </div>
    </header>
    <main>
        <div class="login-container">
            <h2>Checkout</h2>
            <form action="checkout.php" method="post">
                <div class="input-group">
                    <label for="payment-method">Payment Method</label>
                    <select id="payment-method" name="payment_method" required>
                        <option value="credit_card">Credit Card</option>
                        <option value="paypal">PayPal</option>
                        <option value="bank_transfer">Bank Transfer</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="credentials">Payment Credentials</label>
                    <input type="number" id="credentials" name="credentials" required>
                </div>
                <button type="submit">Confirm Purchase</button>
            </form>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Digital Codex. All rights reserved.</p>
    </footer>
</body>
</html>
