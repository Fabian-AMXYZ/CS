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
        ["title" => "Persona 3 Reload", "description" => "A modern remaster of the beloved RPG classic with enhanced graphics and gameplay.", "image" => "persona3reload.jpg"],
        ["title" => "Civilization VI", "description" => "Sid Meier's Civilization VI is a turn-based strategy 4X video game developed by Firaxis Games and published by 2K. The mobile and Nintendo Switch port was published by Aspyr Media.", "image" => "civilization6.jpg"],
        ["title" => "Hearts of Iron IV", "description" => "A grand strategy war game developed by Paradox Development Studio and published by Paradox Interactive.", "image" => "heartsofiron4.jpg"],
    ],
    "horror" => [
        ["title" => "Resident Evil Village", "description" => "Experience survival horror like never before in the eighth major installment in the Resident Evil franchise.", "image" => "residentevilvillage.jpg"],
        ["title" => "Outlast", "description" => "A first-person survival horror series in which investigative journalist Miles Upshur explores Mount Massive Asylum.", "image" => "outlast.jpg"],
        ["title" => "Silent Hill 2", "description" => "James Sunderland searches for his deceased wife in the eerie town of Silent Hill.", "image" => "silenthill2.jpg"],
    ],
    "open world" => [
        ["title" => "The Witcher 3: Wild Hunt", "description" => "An open world RPG where you play as Geralt of Rivia, a monster hunter for hire.", "image" => "witcher3.jpg"],
        ["title" => "Assassin's Creed Odyssey", "description" => "An action RPG set in ancient Greece, where you become a legendary Spartan hero.", "image" => "acodyssey.jpg"],
        ["title" => "Horizon Zero Dawn", "description" => "A post-apocalyptic open world game where you hunt robotic creatures.", "image" => "horizonzerodawn.jpg"],
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
            <a href="index.html">Homepage</a>
            <a href="login.html">Login</a>
            <a href="register.html">Register</a>
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
    <footer>
        <p>&copy; 2024 Steam Type Store. All rights reserved.</p>
    </footer>
</body>
</html>
