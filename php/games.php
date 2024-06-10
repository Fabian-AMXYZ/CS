<?php
session_start();

// Redirect to login page if user is not logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// Include database connection
require_once "database.php";

// Get categories from the database
$categoriesQuery = "SELECT * FROM categories";
$categoriesResult = mysqli_query($conn, $categoriesQuery);
$categories = mysqli_fetch_all($categoriesResult, MYSQLI_ASSOC);

// Get games from the database
$gamesQuery = "SELECT * FROM games";
$gamesResult = mysqli_query($conn, $gamesQuery);
$games = mysqli_fetch_all($gamesResult, MYSQLI_ASSOC);

// Get purchased games for the logged-in user
$purchasedGamesQuery = "SELECT * FROM purchases WHERE user_id = ?";
$stmt = mysqli_prepare($conn, $purchasedGamesQuery);
mysqli_stmt_bind_param($stmt, 's', $_SESSION['username']);
mysqli_stmt_execute($stmt);
$purchasedGamesResult = mysqli_stmt_get_result($stmt);
$purchased_games = mysqli_fetch_all($purchasedGamesResult, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Store</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Game Store</h1>
        <div class="auth-links">
            <span>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</span>
            <a href='index.php'>Homepage</a>
            <a href='library.php'>Library</a>
            <a href='cart.php'>Cart</a>
            <a href='logout.php'>Logout</a>
        </div>
    </header>
    <main>
        <!-- Display categories -->
        <nav>
            <section id="genres">
                <?php foreach ($categories as $category) : ?>
                    <a href="games.php?genre=<?= urlencode($category['genre']) ?>"><?= ucfirst($category['genre']) ?></a>
                <?php endforeach; ?>
            </section>
        </nav>

        <!-- Display games -->
        <section id="games">
            <?php foreach ($games as $game) : ?>
                <div class="game">
                    <img src="<?= htmlspecialchars($game['image']) ?>" alt="<?= htmlspecialchars($game['title']) ?>">
                    <h3><?= htmlspecialchars($game['title']) ?></h3>
                    <p><?= htmlspecialchars($game['description']) ?></p>
                    <p>Price: $<?= number_format($game['price'], 2) ?></p>
                    <?php if (in_array($game['id'], array_column($purchased_games, 'game_id'))) : ?>
                        <p class="owned">Already Owned</p>
                    <?php else : ?>
                        <form action="cart.php" method="post">
                            <input type="hidden" name="game_id" value="<?= $game['id'] ?>">
                            <button type="submit">Add to Cart</button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </section>
    </main>
    <footer>
        <p>© 2024 Digital Codex. All rights reserved.</p>
    </footer>
</body>
</html>
