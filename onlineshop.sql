-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2019 at 09:11 AM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlineshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `code` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `picture` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `code`, `name`, `description`, `price`, `picture`) VALUES
(30, '65c553', 'Brown hodie', 'Check out our knit children hoodie selection for the very best in unique or custom, handmade pieces from our shops.', 300, 'pictures/Brown hodie.jpg'),
(31, 'e71a58', 'Cat hat', 'The pretty kitty cat hat knitting pattern is modeled after our former beloved pet who had the cutest little pink nose', 200, 'pictures/cat.jpg'),
(32, '88f9f8', 'Paw patrol hat', 'Check out our knit paw patrol hat selection for the very best in unique or custom, handmade pieces from our shops.', 300, 'pictures/paw patrol.jpg'),
(33, '7c964b', 'Smurfs hat', 'Check out our knit smurf hat selection for the very best in unique or custom, handmade pieces from our shops.', 250, 'pictures/smurfs.jpg'),
(34, 'c33536', 'New year hat', 'This is a cute, stylish, feminine hat perfect for the new year.', 270, 'pictures/new year.jpg'),
(35, 'a2c947', 'Dog hat', 'Playful Child\'s stranded knit hat includes a small rolled brim and two color rib, a stranded peeries design, followed by stranded dogs chasing balls.', 400, 'pictures/dog.jpg'),
(36, '318959', 'Owl hat and scarf', 'Part of the knit owl set with owl hat, owl glove, and owl scarf knitting patterns.', 500, 'pictures/Owl.jpg'),
(37, 'ab16a3', 'Reindeer hat', 'The Tiny Reindeer Hat Knitting Pattern is an absolutely adorable free knitting pattern for babies.', 350, 'pictures/raindeer.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users_table`
--

CREATE TABLE `users_table` (
  `id` int(11) NOT NULL,
  `first_name` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `signup_date` date NOT NULL,
  `profile_pic` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_table`
--

INSERT INTO `users_table` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `signup_date`, `profile_pic`) VALUES
(1, 'Ljubica', 'Zeravic', 'ljubica_zeravic', 'ljubica@gmail.com', 'a3bf9648867756398784b458496abd09', '2019-12-30', 'assets/images/profile_pics/defaults/head_nephritis.png'),
(2, 'Marko', 'Markovic', 'marko_markovic', 'marko@gmail.com', 'c28aa76990994587b0e907683792297c', '2019-12-30', 'assets/images/profile_pics/defaults/head_deep_blue.png'),
(3, 'Petar', 'Petrovic', 'petar_petrovic', 'petar@gmail.com', '597e3b12820151caa6062612caec8056', '2019-12-30', 'assets/images/profile_pics/defaults/head_deep_blue.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_table`
--
ALTER TABLE `users_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users_table`
--
ALTER TABLE `users_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
