<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$games = [
    "action" => [
        ["title" => "Grand Theft Auto V", "description" => "An action-adventure game set in the open world of Los Santos.", "price" => 29.99, "image" => "gtaa.jpg"],
        ["title" => "Tom Clancy's Rainbow Six® Siege", "description" => "A tactical shooter game focusing on teamwork and strategy.", "price" => 19.99, "image" => "seige.jpg"],
        ["title" => "Red Dead Redemption 2", "description" => "An epic tale of life in America at the dawn of the modern age.", "price" => 39.99, "image" => "rdr22.jpg"],
    ],
    "adventure" => [
        ["title" => "Terraria", "description" => "An adventure game featuring exploration, crafting, building, and combat.", "price" => 9.99, "image" => "teraaa.jpg"],
        ["title" => "Baldur's Gate 3", "description" => "A role-playing game set in the Dungeons & Dragons universe.", "price" => 59.99, "image" => "baldur.jpg"],
        ["title" => "The Forest", "description" => "A survival horror game set in an open world forest environment.", "price" => 14.99, "image" => "forest.jpg"],
    ],
    "strategy" => [
        ["title" => "Persona 3 Reload", "description" => "A modern remaster of the beloved RPG classic with enhanced graphics and gameplay.", "price" => 49.99, "image" => "persona3.jpg"],
        ["title" => "Civilization VI", "description" => "Sid Meier's Civilization VI is a turn-based strategy 4X video game developed by Firaxis Games and published by 2K. The mobile and Nintendo Switch port was published by Aspyr Media.", "price" => 29.99, "image" => "civi.jpg"],
        ["title" => "Hearts of Iron IV", "description" => "A grand strategy wargame that lets you control any nation in World War II.", "price" => 39.99, "image" => "hoi4.jpg"],
    ],
    "horror" => [
        ["title" => "Resident Evil Village", "description" => "A survival horror game with intense action and an intricate story.", "price" => 39.99, "image" => "residentevilvillage.jpg"],
        ["title" => "Outlast 2", "description" => "A first-person survival horror game that takes you on a terrifying journey.", "price" => 29.99, "image" => "outlast2.jpg"],
        ["title" => "Silent Hill 2", "description" => "A psychological horror game that will keep you on the edge of your seat.", "price" => 19.99, "image" => "silenthill2.png"],
    ],
    "open world" => [
        ["title" => "The Witcher 3: Wild Hunt", "description" => "An open world RPG where you play as Geralt of Rivia, a monster hunter for hire.", "price" => 39.99, "image" => "witch.jpg"],
        ["title" => "Assassin's Creed Odyssey", "description" => "An action RPG set in ancient Greece, where you become a legendary Spartan hero.", "price" => 29.99, "image" => "acodyssey.jpg"],
        ["title" => "Horizon Zero Dawn", "description" => "A post-apocalyptic open world game where you hunt robotic creatures.", "price" => 49.99, "image" => "horizonzerodawn.jpg"],
    ],
];

$genre = $_GET['genre'] ?? '';
$username = $_SESSION['username'];
$users = json_decode(file_get_contents('users.json'), true);

$purchased_games = [];
foreach ($users as $user) {
    if ($user['username'] === $username && isset($user['library'])) {
        $purchased_games = $user['library'];
        break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ucfirst(htmlspecialchars($genre)) ?> Games</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Game Store</h1>
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
        <nav>
            <ul>
                <li><a href="games.php?genre=action">Action</a></li>
                <li><a href="games.php?genre=adventure">Adventure</a></li>
                <li><a href="games.php?genre=strategy">Strategy</a></li>
                <li><a href="games.php?genre=horror">Horror</a></li>
                <li><a href="games.php?genre=open+world">Open World</a></li>
            </ul>
        </nav>
       <section id="genres">
    <h2><?= ucfirst(htmlspecialchars($genre)) ?> Games</h2>
    <?php if (array_key_exists($genre, $games)): ?>
        <div id="games">
            <?php foreach ($games[$genre] as $game): ?>
                <div class="game">
                    <img src="<?= htmlspecialchars($game['image']) ?>" alt="<?= htmlspecialchars($game['title']) ?>">
                    <h3><?= htmlspecialchars($game['title']) ?></h3>
                    <p><?= htmlspecialchars($game['description']) ?></p>
                    <p>Price: $<?= number_format($game['price'], 2) ?></p>
                    <?php if (in_array($game, $purchased_games)): ?>
                        <p class="owned">Already Owned</p>
                    <?php else: ?>
                        <form action="cart.php" method="post">
                            <input type="hidden" name="title" value="<?= htmlspecialchars($game['title']) ?>">
                            <input type="hidden" name="price" value="<?= htmlspecialchars($game['price']) ?>">
                            <button type="submit">Add to Cart</button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Genre not found.</p>
    <?php endif; ?>
</section>

    </main>
    <footer>
        <p>&copy; 2024 Digital Codex. All rights reserved.</p>
    </footer>
</body>
</html>




