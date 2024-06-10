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
                <a href="index.php">Homepage</a>
                <a href="library.php">Library</a>
                <span>Welcome, ?>!</span>
                <a href="logout.php" class="btn btn-warning">Logout</a>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
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
                    <img src="/CS/img/action/rdr22.jpg" alt="Action Image">
                    <h1>Action</h1>
                </a>
            </div>
            <div class="slide">
            <a href="games.php?genre=adventure">
                    <img src="/CS/img/adventure/teraa.jpg" alt="Adventure Image">
                    <h1>Adventure</h1>
                </a>
            </div>
            <div class="slide">
                <a href="games.php?genre=strategy">
                    <img src="/CS/img/strategy/civ.jpg" alt="Strategy Image">
                    <h1>Strategy</h1>
                </a>
            </div>
            <div class="slide">
                <a href="games.php?genre=horror">
                    <img src="/CS/img/horror/out.jpg" alt="Horror Image">
                    <h1>Horror</h1>
                </a>
            </div>
            <div class="slide">
            <a href="games.php?genre=open+world">
                    <img src="/CS/img/open world/witchh.jpg" alt="Open World Image">
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
