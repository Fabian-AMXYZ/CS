<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// Check if the request is a POST request to add a game to the cart
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $game_id = $_POST['game_id'];
    $title = $_POST['title'];
    $price = $_POST['price'];

    // Initialize the cart if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if the game is already in the cart
    $alreadyInCart = false;
    foreach ($_SESSION['cart'] as $item) {
        if ($item['game_id'] === $game_id) {
            $alreadyInCart = true;
            break;
        }
    }

    // Add the game to the cart if it's not already there
    if (!$alreadyInCart) {
        $_SESSION['cart'][] = ['game_id' => $game_id, 'title' => $title, 'price' => $price];
    }
    
    // Remove item from cart if remove button is clicked
    if (isset($_POST['remove_item'])) {
        $game_id = $_POST['game_id'];
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['game_id'] === $game_id) {
                unset($_SESSION['cart'][$key]);
                break;
            }
        }
        // Reset array keys after removing item
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }

    $cart = $_SESSION['cart'] ?? [];
    $total = array_sum(array_column($cart, 'price'));
    // Redirect to the cart page to prevent form resubmission
    header('Location: cart.php');
    exit;
}

// Get the cart from the session
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
            <?php
            if (isset($_SESSION['username'])) {
                $username = htmlspecialchars($_SESSION['username']);

                echo "<span>Welcome, $username!</span>";
                echo "<a href='index.php'>Homepage</a>";
                echo "<a href='games.php'>Browse games</a>";
                echo "<a href='library.php'>Library</a>";
                echo "<a href='logout.php'>Logout</a>";
            } else {
                echo "<a href='login.php'>Login</a>";
                echo "<a href='register.php'>Register</a>";
            }
            ?>
        </div>
    </header>
    <main>
        <h2>Cart</h2>
        <?php if ($cart) : ?>
            <table>
                <tr>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Actions</th> <!-- Added a new column for the remove button -->
                </tr>
                <?php foreach ($cart as $item) : ?>
                    <tr>
                        <td><?= htmlspecialchars($item['title']) ?></td>
                        <td>$<?= number_format($item['price'], 2) ?></td>
                        <td>
                            <!-- Form for the remove button -->
                            <form action="cart.php" method="post">
                                <input type="hidden" name="game_id" value="<?= $item['game_id'] ?>">
                                <button type="submit" name="remove_item">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td>Total</td>
                    <td>$<?= number_format($total, 2) ?></td>
                    <td></td> <!-- Empty column for alignment -->
                </tr>
            </table>
            <a href="games.php" class="button">Go back</a>
            <a href="checkout.php" class="button">Proceed to Checkout</a>
        <?php else : ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </main>
    <footer>
        <p>&copy; 2024 Digital Codex. All rights reserved.</p>
    </footer>
</body>

</html>