-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 16, 2020 at 03:19 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(2, 'PHP'),
(4, 'JavaScript'),
(5, 'ASP .Net Core'),
(6, 'Laravel'),
(7, 'Django');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_des` text COLLATE utf8_unicode_ci NOT NULL,
  `comment_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment_author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment_post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_des`, `comment_date`, `comment_author`, `comment_post_id`) VALUES
(36, 'a', 'Fri, 14 Feb 2020 03:45:11 pm', 'frank', 7),
(37, 'welcome!', 'Fri, 14 Feb 2020 04:28:17 pm', 'peter', 5),
(38, 'Traditional heading elements are designed to work best in the meat of your page content. When you need a heading to stand out, consider using a display headingâ€”a larger, slightly more opinionated ', 'Fri, 14 Feb 2020 06:00:24 pm', 'frank', 5),
(39, 's', 'Sun, 16 Feb 2020 01:55:54 pm', 'jack', 7),
(40, 'good', 'Sun, 16 Feb 2020 02:23:23 pm', 'peter', 7);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `post_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_des` text COLLATE utf8_unicode_ci NOT NULL,
  `post_img` text COLLATE utf8_unicode_ci NOT NULL,
  `post_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_cat_id` int(11) NOT NULL,
  `post_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Published',
  `post_comment` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `post_title`, `post_des`, `post_img`, `post_date`, `post_author`, `post_cat_id`, `post_status`, `post_comment`) VALUES
(3, 'PDO', ' PDO is an acronym for PHP Data Objects. PDO is a lean, consistent way to access databases. This means developers can write portable code much easier. PDO is not an abstraction layer like PearDB. PDO is more like a data access layer that uses a unified API (Application Programming Interface).', 'pdo.jpg', 'Tue, 11 Feb 2020 02:39:24 pm', 'Admin', 2, 'Published', 0),
(4, 'JavaScript', '                                                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus. Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. DCras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus. onec lacinia congue felis in faucibus. ', 'js.png', 'Sun, 16 Feb 2020 01:38:03 pm', 'Admin', 4, 'Draft', 0),
(5, 'What\'s New in PHP 8 ', 'PHP 8, the new major PHP version, is expected to be released by the end of 2020. It\'s in very active development right now, so things are likely to change a lot in the upcoming months.\r\n\r\nIn this post I\'ll keep an up-to-date list of what\'s expected to come: new features, performance improvements and breaking changes. Because PHP 8 is a new major version, there\'s a higher chance of your code breaking. If you\'ve kept up to date with the latest releases though, the upgrade shouldn\'t be too hard, since most breaking changes were deprecated before in the 7.* versions.', 'php8.png', 'January 29, 2020 ', 'Luke', 2, 'Published', 2),
(7, 'Babel', 'Babel is a JavaScript transpiler that converts edge JavaScript into plain old ES5 JavaScript that can run in any browser (even the old ones).\r\n\r\nIt makes available all the syntactical sugar that was added to JavaScript with the new ES6 specification, including classes, fat arrows, and multiline strings.', 'js-webpack-babel_peqovw.png', 'Mon, 10 Feb 2020 07:24:43 am', 'Admin', 4, 'Published', 3),
(10, 'Node.js', 'Node.js is an open-source, cross-platform, JavaScript runtime environment that executes JavaScript code outside of a browser.', 'Node.js_logo.svg.png', 'Tue, 11 Feb 2020 02:00:40 pm', 'Admin', 4, 'Published', 0),
(11, 'Vue.js', 'Vue.js is an open-source Modelâ€“viewâ€“viewmodel JavaScript framework for building user interfaces and single-page applications. It was created by Evan You, and is maintained by him and the rest of the active core team members coming from various companies such as Netlify and Netguru.', 'vue.jpg', 'Sun, 16 Feb 2020 01:45:19 pm', 'Admin', 4, 'Published', 0),
(12, 'ECMAScript', 'ECMAScript is a scripting-language specification standardized by Ecma International. It was created to standardize JavaScript to help foster multiple independent implementations.', 'vue.jpg', 'Sun, 16 Feb 2020 01:49:08 pm', 'Admin', 4, 'Published', 0),
(13, 'Symfony', 'Symfony is a PHP web application framework and a set of reusable PHP components/libraries. It was published as free software on October 18, 2005 and released under the MIT license', 'symfony.png', 'Sun, 16 Feb 2020 01:52:21 pm', 'Admin', 2, 'Published', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(1, 'Joker', 'admin@joker.com', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
