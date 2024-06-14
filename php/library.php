<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// Include database connection
require_once "database.php";

$username = $_SESSION['username'];

// Fetch the user's library from the database
$libraryQuery = "SELECT games.title, games.price, games.image, purchases.user_id
                 FROM purchases 
                 INNER JOIN games ON purchases.game_id = games.id 
                 WHERE purchases.user_id = ?";
$stmt = mysqli_prepare($conn, $libraryQuery);
mysqli_stmt_bind_param($stmt, 's', $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$library = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library - Digital Codex</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <h1>Digital Codex</h1>
        <div class="auth-links">
            <?php
            echo "<span>Welcome, $username!</span>";
            echo "<a href='index.php'>Homepage</a>";
            echo "<a href='games.php'>Browse games</a>";
            echo "<a href='cart.php'>Cart</a>";
            echo "<a href='edit_profile.php'>Edit Profile</a>";
            echo "<a href='logout.php'>Logout</a>";
            ?>
        </div>
    </header>
    <main>
        <h2>Your Library</h2>
        <?php if (!empty($library)) : ?>
            <div id="games">
                <?php foreach ($library as $game) : ?>
                    <div class="game">
                        <img src="<?= htmlspecialchars($game['image']) ?>" alt="<?= htmlspecialchars($game['title']) ?>">
                        <h3><?= htmlspecialchars($game['title']) ?></h3>
                        <p>Price: $<?= number_format($game['price'], 2) ?></p>
                        <?php if ($game['user_id'] === $username) : ?>
                            <p class="owned">You own this game</p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p>Your library is empty.</p>
        <?php endif; ?>
    </main>
    <footer>
        <p>&copy; 2024 Digital Codex. All rights reserved.</p>
    </footer>
</body>

</html>