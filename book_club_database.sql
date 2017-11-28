-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2017 at 05:28 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_club_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `bookid` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `reserved` tinyint(1) DEFAULT NULL,
  `duedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`bookid`, `title`, `author`, `reserved`, `duedate`) VALUES
(1, '1984', 'George Orwell', 0, NULL),
(2, 'Twenty Thousand Leagues Under the Sea', 'Jules Verne', 1, NULL),
(3, 'The Animal Farm', 'George Orwell', 0, NULL),
(4, 'The Lord of the Rings: The Fellowship of the Ring', 'J.R.R Tolkien', 1, NULL),
(5, 'The Lord of the Rings: The Two Towers', 'J.R.R Tolkien', 0, NULL),
(6, 'The Lord of the Rings: The Return of the King', 'J.R.R Tolkien', 0, NULL),
(7, 'Narnia: The Last Battle', 'C.S Lewis', 0, NULL),
(8, 'Narnia: The Silver Chair', 'C.S Lewis', 0, NULL),
(9, 'Narnia: The Voyage of the Dawn Treader', 'C.S Lewis', 0, NULL),
(10, 'Narnia: Prince Caspian: The Return to Narnia', 'C.S Lewis', 0, NULL),
(11, 'Narnia: The Horse and His Boy', 'C.S Lewis', 0, NULL),
(12, 'Narnia: The Lion, the Witch and the Wardrobe', 'C.S Lewis', 0, NULL),
(13, 'Narnia: The Magician\'s Nephew', 'C.S Lewis', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentid` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentid`, `comment`) VALUES
(1, '&lt;b&gt; hej &lt;/b&gt;\r\n'),
(2, '&lt;strong&gt; Wassap &lt;/strong&gt;\r\n'),
(3, '&lt;strong&gt; Wassap &lt;/strong&gt;\r\n'),
(4, '&lt;strong&gt; Wassap &lt;/strong&gt;\r\n'),
(5, '&lt;strong&gt; hall&aring; &lt;/strong&gt;\r\n'),
(6, '<strong> hej </strong>\r\n'),
(7, '&lt;strong&gt; hej &lt;/strong&gt;\r\n'),
(8, '&lt;strong&gt;wassap&lt;/\r\nstrong&gt;'),
(9, '&lt;strong&gt; tjenixen &lt;/strong&gt;'),
(10, ''),
(11, '&lt;strong&gt; hej &lt;/strong&gt;'),
(12, 'blabla'),
(13, '&lt;strong&gt; hejsvejs &lt;/strong&gt;'),
(14, '1337'),
(15, '&lt;strong&gt; hej &lt;/strong&gt;'),
(16, 'P&auml;r'),
(17, '&lt;iframe style=&quot;position:fixed; top:10px; left:10px; width:100%; height:100%; z-index:99;&quot; border=&quot;0&quot; src=&quot;http://ju.se/&quot;  /&gt;'),
(18, ''),
(19, ''),
(20, '&lt;iframe style=&quot;position:fixed; top:10px; left:10px; width:100%; height:100%; z-index:99;&quot; border=&quot;0&quot; src=&quot;http://ju.se/&quot;  /&gt;'),
(21, 'martin'),
(22, 'hej'),
(23, 'martin'),
(24, 'martin'),
(25, 'P&aring;l '),
(26, 'hej'),
(27, 'P&aring;l'),
(28, 'hej'),
(29, 'P&aring;l'),
(30, 'hej'),
(31, 'P&aring;l'),
(32, 'HEJ'),
(33, 'P&aring;l'),
(34, 'Hej'),
(35, 'martin'),
(36, 'hej\''),
(37, 'h'),
(38, 'h'),
(39, 'h'),
(40, 'h'),
(41, 'h'),
(42, 'h'),
(43, 'h'),
(44, 'h'),
(45, 'h'),
(46, 'h'),
(47, 'h'),
(48, 'h'),
(49, 'h'),
(50, 'h'),
(51, 'h'),
(52, 'h'),
(53, 'h'),
(54, 'h'),
(55, 'h'),
(56, 'h'),
(57, 'h'),
(58, 'h'),
(59, 'h'),
(60, 'h'),
(61, 'h'),
(62, 'h'),
(63, 'h'),
(64, 'h'),
(65, 'h'),
(66, 'h'),
(67, 'h'),
(68, 'h'),
(69, 'h'),
(70, 'h'),
(71, 'h'),
(72, 'h'),
(73, 'h'),
(74, 'h'),
(75, 'h'),
(76, 'h'),
(77, 'h'),
(78, 'h'),
(79, 'h'),
(80, 'h');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`) VALUES
('martin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
('kurt', 'c412b37f8c0484e6db8bce177ae88c5443b26e92'),
('jan', '77ba9cd915c8e359d9733edcfe9c61e5aca92afb'),
('bengan', '7a95563490d87e3621966d553f06078acb822585'),
('hej', 'hej'),
('Pål', 'c412b37f8c0484e6db8bce177ae88c5443b26e92'),
('h', '27d5482eebd075de44389774fce28c69f45c8a75');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`bookid`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `bookid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
