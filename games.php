<?php
$games = [
    "action" => [
        ["title" => "Grand Theft Auto V", "description" => "An action-adventure game set in the open world of Los Santos.", "image" => "gta5.jpg"],
        ["title" => "Tom Clancy's Rainbow Six® Siege", "description" => "A tactical shooter game focusing on teamwork and strategy.", "image" => "rainbow6siege.jpg"],
        ["title" => "Red Dead Redemption 2", "description" => "An epic tale of life in America at the dawn of the modern age.", "image" => "rdr2.jpg"],
    ],
    "adventure" => [
        ["title" => "Terraria", "description" => "An adventure game featuring exploration, crafting, building, and combat.", "image" => "terraria.jpg"],
        ["title" => "Baldur's Gate 3", "description" => "A role-playing game set in the Dungeons & Dragons universe.", "image" => "baldursgate3.jpg"],
        ["title" => "The Forest", "description" => "A survival horror game set in an open world forest environment.", "image" => "theforest.jpg"],
    ],
    "strategy" => [
        ["title" => "Game C1", "description" => "Strategy Game 1", "image" => "strategy1.jpg"],
        ["title" => "Game C2", "description" => "Strategy Game 2", "image" => "strategy2.jpg"],
        ["title" => "Game C3", "description" => "Strategy Game 3", "image" => "strategy3.jpg"],
    ],
];

$genre = $_GET['genre'] ?? '';
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
            <a href="login.html">Login</a>
            <a href="register.html">Register</a>
        </div>
    </header>
    <main>
        <section id="genres">
            <h2><?= ucfirst(htmlspecialchars($genre)) ?> Games</h2>
            <?php if (array_key_exists($genre, $games)): ?>
                <div id="games">
                    <?php foreach ($games[$genre] as $game): ?>
                        <div class="game">
                            <img src="images/<?= htmlspecialchars($game['image']) ?>" alt="<?= htmlspecialchars($game['title']) ?>">
                            <h3><?= htmlspecialchars($game['title']) ?></h3>
                            <p><?= htmlspecialchars($game['description']) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>Genre not found.</p>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
