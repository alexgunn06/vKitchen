-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2025 at 06:37 PM
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
-- Database: `vkitchen`
--

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `rid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(300) DEFAULT NULL,
  `type` enum('French','Italian','Chinese','Indian','Mexican','Others') NOT NULL,
  `Cookingtime` int(4) DEFAULT NULL,
  `ingredients` varchar(1000) DEFAULT NULL,
  `instructions` varchar(1000) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `uid` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`rid`, `name`, `description`, `type`, `Cookingtime`, `ingredients`, `instructions`, `image`, `uid`) VALUES
(1, 'Classic French Omelette', 'Soft and silky French-style omelette.', 'French', 10, '3 eggs, butter, salt', 'Whisk eggs. Melt butter in pan. Pour eggs and stir gently until just set.', 'omelette.jpg', 1),
(2, 'Spaghetti Carbonara', 'Traditional Italian pasta with egg and pancetta.', 'Italian', 20, 'Spaghetti, eggs, pancetta, parmesan, black pepper', 'Boil pasta. Fry pancetta. Mix eggs with cheese. Combine all.', 'carbonara.jpg', 2),
(3, 'Chicken Tikka Masala', 'Creamy tomato-based Indian curry.', 'Indian', 40, 'Chicken, yogurt, tomatoes, cream, spices', 'Marinate chicken. Grill. Cook sauce and combine.', 'tikka.jpg', 3),
(4, 'Tacos al Pastor', 'Spicy pork tacos with pineapple.', 'Mexican', 30, 'Pork, pineapple, onion, spices, tortillas', 'Marinate pork. Grill. Serve in tortillas with toppings.', 'tacos.jpg', 2),
(5, 'Sweet and Sour Chicken', 'Chinese takeout classic.', 'Chinese', 25, 'Chicken, bell peppers, vinegar, sugar, ketchup', 'Fry chicken. Make sauce. Combine and cook.', 'sweet_sour.jpg', 1),
(6, 'Burger', 'big juicy burger', 'Others', 20, 'beef, bread, tomatoes, lettuce', 'cook da burgers', 'uploads/burger.jpg', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `password`, `email`) VALUES
(1, 'chef_julia', '$2y$10$z2YvHJbi8x5QleLO2g5VOepz/CVFe6q2xYwTGG.zQxDgOgCk1A23e', 'julia@example.com'),
(2, 'italian_mario', '$2y$10$L4UVO3MZxS6Y7kB9OSovpeZ0XaiIfq8ZecHExiMwJeHVxlnSnSPla', 'mario@example.com'),
(3, 'spice_queen', '$2y$10$d1vI9SGTnPrjWyC7xLQcZ.iG/qKZrc6pjFtTyPqFCxqKDZPSMvKi6', 'spice@example.com'),
(4, 'alexG', '$2y$10$ZCDQwAUREKjjVS6IWdLLs.XXRYZD/JxpaX67vPmdDWlzFBS1sMTK.', 'alexgunn06@gmail.com'),
(5, 'alex', '$2y$10$Ux2vfndhlYNEGCXrffj/wuhfah0UB26xVAfkxjQMIzOSpHr2r9F4O', 'alex.bunn06@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`rid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `recipes_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
