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

// Get the selected genre from URL, default to empty string if not provided
$selectedGenre = isset($_GET['genre']) ? $_GET['genre'] : '';

// Define the query to get games based on the selected genre
if ($selectedGenre) {
    $gamesQuery = "SELECT * FROM games WHERE category_id = (SELECT id FROM categories WHERE genre = ?)";
    $stmt = mysqli_prepare($conn, $gamesQuery);
    mysqli_stmt_bind_param($stmt, 's', $selectedGenre);
    mysqli_stmt_execute($stmt);
    $gamesResult = mysqli_stmt_get_result($stmt);
    $games = mysqli_fetch_all($gamesResult, MYSQLI_ASSOC);
} else {
    // If no genre is specified, fetch all games
    $gamesQuery = "SELECT * FROM games";
    $gamesResult = mysqli_query($conn, $gamesQuery);
    $games = mysqli_fetch_all($gamesResult, MYSQLI_ASSOC);
}

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
            <a href='edit_profile.php'>Edit Profile</a>
            <a href='logout.php'>Logout</a>
        </div>
    </header>
    <main>
        <!-- Display categories -->
        <nav>
            <section id="genres">
                <a href="games.php" class="genre-link">All Games</a>
                <?php foreach ($categories as $category) : ?>
                    <a href="games.php?genre=<?= urlencode($category['genre']) ?>" class="genre-link"><?= ucfirst($category['genre']) ?></a>
                <?php endforeach; ?>
            </section>
        </nav>

        <!-- Display games -->
        <section id="games">
            <?php if ($games) : ?>
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
                                <input type="hidden" name="title" value="<?= htmlspecialchars($game['title']) ?>">
                                <input type="hidden" name="price" value="<?= htmlspecialchars($game['price']) ?>">
                                <button type="submit">Add to Cart</button>
                            </form>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No games available.</p>
            <?php endif; ?>
        </section>
    </main>
    <footer>
        <p>© 2024 Digital Codex. All rights reserved.</p>
    </footer>
</body>

</html>