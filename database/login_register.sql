-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2024 at 08:23 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_register`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `genre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `genre`) VALUES
(1, 'action'),
(2, 'adventure'),
(3, 'strategy'),
(4, 'horror'),
(5, 'open world');

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `category_id`, `title`, `description`, `price`, `image`) VALUES
(1, 1, 'Grand Theft Auto V', 'An action-adventure game set in the open world of Los Santos.', 29.99, '/CS/img/action/gtaa.jpg'),
(2, 1, 'Tom Clancy\'s Rainbow Six® Siege', 'A tactical shooter game focusing on teamwork and strategy.', 19.99, '/CS/img/action/rainbow.jpg'),
(3, 1, 'Red Dead Redemption 2', 'An epic tale of life in America at the dawn of the modern age.', 39.99, '/CS/img/action/rdr2.jpg'),
(4, 2, 'Terraria', 'An adventure game featuring exploration, crafting, building, and combat.', 9.99, '/CS/img/adventure/teraaa.jpg'),
(5, 2, 'Baldur\'s Gate 3', 'A next-generation RPG, set in the world of Dungeons and Dragons.', 29.99, '/CS/img/adventure/baldur.jpg'),
(6, 2, 'The Forest', 'A survival horror game set in an open world forest environment.', 14.99, '/CS/img/adventure/forest.jpg'),
(7, 3, 'Persona 3 Reload', 'A modern remaster of the beloved RPG classic with enhanced graphics and gameplay.', 49.99, '/CS/img/strategy/persona3.jpg'),
(8, 3, 'Civilization VI', 'Sid Meier\'s Civilization VI is a turn-based strategy 4X video game developed by Firaxis Games and published by 2K. The mobile and Nintendo Switch port was published by Aspyr Media.', 29.99, '/CS/img/strategy/civi.jpg'),
(9, 3, 'Hearts of Iron IV', 'A grand strategy wargame that lets you control any nation in World War II.', 39.99, '/CS/img/strategy/hoi4.jpg'),
(10, 4, 'Resident Evil Village', 'A survival horror game with intense action and an intricate story.', 39.99, '/CS/img/horror/residentevilvillage.jpg'),
(11, 4, 'Outlast 2', 'A first-person survival horror game that takes you on a terrifying journey.', 29.99, '/CS/img/horror/outlast2.jpg'),
(12, 4, 'Silent Hill 2', 'A psychological horror game that will keep you on the edge of your seat.', 19.99, '/CS/img/horror/silenthill2.png'),
(13, 5, 'The Witcher 3: Wild Hunt', 'An open world RPG where you play as Geralt of Rivia, a monster hunter for hire.', 39.99, '/CS/img/open world/witch.jpg'),
(14, 5, 'Assassin\'s Creed Odyssey', 'An action RPG set in ancient Greece, where you become a legendary Spartan hero.', 29.99, '/CS/img/open world/acodyssey.jpg'),
(15, 5, 'Horizon Zero Dawn', 'A post-apocalyptic open world game where you hunt robotic creatures.', 49.99, '/CS/img/open world/horizonzerodawn.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `game_id` int(11) DEFAULT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `user_id`, `game_id`, `purchase_date`) VALUES
(153, 'Jello', 1, '2024-06-12 12:59:52'),
(154, 'Jello', 10, '2024-06-13 01:14:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(128) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `username`, `email`, `password`, `is_admin`) VALUES
(1, 'Angelo Fabian', 'Jello', 'angelofabian@gmail.com', '$2y$10$.XUolQ5zZijjikf5bSH3ZefYVA0CrjmjiwqW.u0tnTcJJcsFxbieG', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_id` (`game_id`),
  ADD KEY `purchases_ibfk_1` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `games_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
