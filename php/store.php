<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../welcome.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store - Digital Codex</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <header>
        <h1>Digital Codex</h1>
        <div class="auth-links">
            <a href="store.php">Homepage</a>
            <a href="library.php">Library</a>
            <span>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</span>
            <a href="logout.php">Logout</a>
        </div>
    </header>
    <main>
        <h2>Welcome to the Store</h2>
        <p>Browse through various game genres and find your next adventure!</p>
        <nav>
            <a href="games.php?genre=action">Action</a>
            <a href="games.php?genre=adventure">Adventure</a>
            <a href="games.php?genre=strategy">Strategy</a>
            <a href="games.php?genre=horror">Horror</a>
            <a href="games.php?genre=open+world">Open World</a>
        </nav>
    </main>
    <footer>
        <p>&copy; 2024 Digital Codex. All rights reserved.</p>
    </footer>
</body>

</html>