<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'];
$users = json_decode(file_get_contents('users.json'), true);

$library = [];
foreach ($users as $user) {
    if ($user['username'] === $username && isset($user['library'])) {
        $library = $user['library'];
        break;
    }
}
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
            <?php require_once "database.php";
            if (isset($_SESSION['username'])) {
                $username = $_SESSION['username'];

                echo "<span>Welcome, $username!</span>";
                echo "<a href='index.php'>Homepage</a>";
                echo "<a href='cart.php'>Cart</a>";
                echo "<a href='logout.php'>Logout</a>";
            } else {
                echo "<a href='login.php'>Login</a>";
                echo "<a href='register.php'>Register</a>";
            }
            ?>
        </div>
    </header>
    <main>
        <h2>Your Library</h2>
        <?php if ($library) : ?>
            <div id="games">
                <?php foreach ($library as $game) : ?>
                    <div class="game">
                        <h3><?= htmlspecialchars($game['title']) ?></h3>
                        <p>Price: $<?= number_format($game['price'], 2) ?></p>
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