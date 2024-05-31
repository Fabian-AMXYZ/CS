<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Digital Codex</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Digital Codex</h1>
        <div class="auth-links">
            <?php if (isset($_SESSION['username'])): ?>
                <a href="index.php">Homepage</a>
                <a href="library.php">Library</a>
                <span>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</span>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
            <?php endif; ?>
        </div>
    </header>
    <main>
        <h1>Welcome to Digital Codex</h1>
        <p>Browse through various game genres and find your next adventure!</p>
        <nav>
            <ul>
                <li><a href="games.php?genre=action">Action</a></li>
                <li><a href="games.php?genre=adventure">Adventure</a></li>
                <li><a href="games.php?genre=strategy">Strategy</a></li>
                <li><a href="games.php?genre=horror">Horror</a></li>
                <li><a href="games.php?genre=open+world">Open World</a></li>
            </ul>
        </nav>
        <h2>Featured Games:</h2>
    </main>

    <div class="slider">
        <div class="slides">
            <div class="slide first">
            <a href="games.php?genre=action">
                    <img src="rdr22.jpg" alt="Action Image">
                    <h1>Action</h1>
                </a>
            </div>
            <div class="slide">
            <a href="games.php?genre=adventure">
                    <img src="teraa.jpg" alt="Adventure Image">
                    <h1>Adventure</h1>
                </a>
            </div>
            <div class="slide">
                <a href="games.php?genre=strategy">
                    <img src="civ.jpg" alt="Strategy Image">
                    <h1>Strategy</h1>
                </a>
            </div>
            <div class="slide">
                <a href="games.php?genre=horror">
                    <img src="out.jpg" alt="Horror Image">
                    <h1>Horror</h1>
                </a>
            </div>
            <div class="slide">
            <a href="games.php?genre=open+world">
                    <img src="witchh.jpg" alt="Open World Image">
                    <h1>Action</h1>
                </a>
            </div>
        </div>

        <label class="prev">&#10094;</label>
        <label class="next">&#10095;</label>
    </div>
    <footer>
        <p>&copy; 2024 Digital Codex. All rights reserved.</p>
    </footer>
</body>
</html>
