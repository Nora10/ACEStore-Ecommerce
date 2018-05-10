-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2018 at 12:39 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `acestore`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`) VALUES
(1, 'Household'),
(2, 'Veggies and Fruits'),
(3, 'Food Stuff'),
(5, 'Frozen Food'),
(6, 'Bread and Bakery');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `info` text NOT NULL,
  `qty` int(20) NOT NULL,
  `ref` varchar(255) NOT NULL,
  `pix` text NOT NULL,
  `cat_id` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `title`, `price`, `info`, `qty`, `ref`, `pix`, `cat_id`) VALUES
(1, 'Dano Milk', '800', 'Nourishing milk for all ages', 50, 'ACE2023', '15241433945007630.jpg', 4),
(3, 'Nescafe coffee', '500', 'Hot coffee , with a rich blend.', 10, 'ACE2505', '15241436084153443.jpg', 4),
(4, 'Milo', '700', 'The beverage for champions.', 20, 'ACE1845', '15241436473181153.jpg', 4),
(5, 'Coca cola zero', '300', 'Diet coke.', 15, 'ACE1489', '15241437419528199.png', 4),
(6, 'Sprite', '400', 'Soda ....Mineral.', 20, 'ACE935', '15241437741905518.png', 4),
(7, 'Scwheppes', '150', 'Cool drinks', 30, 'ACE6795', '15241438314961548.png', 4),
(8, 'red bull', '800', 'Powerhorse drink. ', 60, 'ACE624', '15241439156782227.png', 4),
(9, 'okra', '200', 'Very nutritious.', 50, 'ACE5740', '15241439736390992.jpg', 3),
(10, 'Brown Beans', '800', 'Proteinous brown beans.', 50, 'ACE5554', '15241440431248780.jpg', 3),
(11, 'Caprice Brand rice', '21000', 'Whole caprice bag. 50kg', 15, 'ACE490', '15241440824754029.jpg', 3),
(12, 'Irish Potatoes', '850', 'Irish potatoes for healthy living.', 50, 'ACE5514', '15241441203742676.jpg', 3),
(13, 'Kings Groundnut Oil', '2100', 'Good Oil for the heart.', 50, 'ACE8058', '15241441615988160.jpg', 3),
(14, 'Mamador oil', '3000', 'Great oil for cooking.', 30, 'ACE5145', '15241441957701417.jpeg', 3),
(15, 'Mama gold rice', '22000', 'Great brand of rice.', 40, 'ACE913', '15241442281030884.jpg', 3),
(16, 'Onions ', '50', 'Fresh red onions in a 2kg bag.', 70, 'ACE4139', '15241442671562501.jpg', 3),
(17, 'Atarodo red peppers', '200', 'Hot habanero pepper', 200, 'ACE5968', '15241443065819703.jpg', 3),
(18, 'Semovita', '600', 'Semovita by golden penny.', 60, 'ACE7134', '15241443388763428.jpg', 3),
(19, 'Cinnamon peppersoup spices', '500', 'Good spices for peppersoup and weightloss.', 500, 'ACE5589', '15241443871292115.jpg', 3),
(20, 'Tomatoes', '500', 'Red fresh tomatoes ', 70, 'ACE3923', '15241444147741700.jpg', 3),
(21, 'Yam', '500', 'New paper yam from onitsha.', 50, 'ACE6893', '15241444493385621.jpg', 3),
(22, 'Cut frozen potatoes(peeled)', '3500', 'Ready to be fried. Thaw for 30minutes before frying.', 30, 'ACE9046', '15241445171934815.jpg', 5),
(23, 'Croaker Fish', '5000', 'Half Carton Croaker fish (Already scaled).', 50, 'ACE2145', '15241445583037720.jpg', 5),
(24, 'Satis Hot Dog', '800', 'Ready for frying . Thaw for 30minutes before cooking.', 50, 'ACE2394', '15241446049780274.jpg', 5),
(25, 'Chicken Gizzard', '750', 'Chicken Gizzard', 20, 'ACE8360', '15241446376185914.jpg', 5),
(26, 'Whole chicken ', '4000', 'Whole chicken , cleaned and de-feathered.', 4, 'ACE8406', '15241447364715577.jpg', 5),
(27, 'Carrots', '350', 'Fresh carrots from Jos.', 35, 'ACE7905', '15241447903767701.jpg', 2),
(28, 'Cabbage', '450', 'Cabbage white brand.', 45, 'ACE6974', '15241448185178223.jpg', 2),
(29, 'Apples red', '360', 'Red Gala apples(2pieces)', 36, 'ACE7894', '15241448491720582.jpg', 2),
(30, 'Colorful bell peppers', '1500', 'Assoretd exotic bell peppers', 5, 'ACE2738', '15241449054605713.jpeg', 2),
(31, 'Oranges', '1400', 'Oranges(1 rubber basket)', 14, 'ACE593', '1524144993982056.jpg', 2),
(32, 'Watermelon', '4500', 'Fresh Watermelon . Organic (No seeds)', 50, 'ACE5289', '15241450521435547.jpg', 2),
(33, 'Bananas', '800', 'Bunch of Bananas', 40, 'ACE3019', '15241451007489625.png', 2),
(34, 'Strawberries', '5600', 'Red strawberry, foriegn brand.', 50, 'ACE9368', '15241451789105225.png', 2),
(35, 'Local Watermelon', '400', 'Local breed Watermelon', 40, 'ACE7436', '15241452302180787.jpg', 2),
(36, 'Brocolli', '850', 'Rich Cruciferous vegetables', 80, 'ACE4765', '15241452906052247.png', 2),
(37, 'Blend of hampered veggies', '5000', 'Blend of hampered veggies', 50, 'ACE1160', '1524145330993042.jpg', 2),
(38, 'Bread', '500', 'Sliced fresh hot bread from the bakery.', 78, 'ACE6020', '15241454255714112.jpg', 6),
(39, 'Cake', '850', 'Pound cake.', 80, 'ACE6157', '15241454684863892.jpg', 6),
(40, 'Doughnut', '400', 'Doughnut', 40, 'ACE2925', '15241455116528321.jpg', 6),
(41, 'Egg roll', '80', 'Egg roll ', 80, 'ACE9743', '15241455449730835.jpg', 6),
(42, 'Meat Pie', '400', 'Meatpie filled with carrot and minced meat.', 50, 'ACE120', '15241455791932374.jpg', 6);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reg_date` datetime NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `pass1` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='member table containing their registration info' AUTO_INCREMENT=6 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `reg_date`, `fullname`, `email`, `phone`, `pass1`) VALUES
(1, '2018-04-19 05:25:01', 'chidinma', 'charles@chuks.com', '81dc9bdb52d04dc20036', '1234'),
(2, '2018-04-19 05:26:04', 'chidinma', 'charles@chuks.com', '81dc9bdb52d04dc20036', '1234'),
(3, '2018-04-19 05:34:46', 'tusky', 'c@gmail.com', '12345', '81dc9bdb52d04dc20036'),
(4, '2018-04-21 17:05:04', 'chidi', 'c1@otutu.com', '00000', '81dc9bdb52d04dc20036dbd8313ed055'),
(5, '2018-05-09 10:11:13', 'nora', 'nora@food.com', '2703205986', '25f9e794323b453885f5181f1b624d0b');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
