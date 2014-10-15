-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 15, 2014 at 01:39 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `symfony`
--

-- --------------------------------------------------------

--
-- Table structure for table `UserManagement`
--

CREATE TABLE IF NOT EXISTS `UserManagement` (
`id` int(11) NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `firstname` longtext COLLATE utf8_unicode_ci NOT NULL,
  `lastname` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `conpass` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `status` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `UserManagement`
--

INSERT INTO `UserManagement` (`id`, `email`, `firstname`, `lastname`, `password`, `conpass`, `date`, `status`) VALUES
(1, 'richtermark.baay@chromedia.com', 'Richtermark', 'Baay', 'f1b5a91d4d6ad523f2610114591c007e75d15084', 'f1b5a91d4d6ad523f2610114591c007e75d15084', '2014-10-15', 'active'),
(2, 'merks_tm@yahoo.com', 'Richtermark', 'Baay', 'f1b5a91d4d6ad523f2610114591c007e75d15084', 'f1b5a91d4d6ad523f2610114591c007e75d15084', '2014-10-14', 'inactive'),
(3, 'elmer.malinao@chromedia.com', 'Elmer', 'Malinao', 'cb9f5f82521006a64fd6569b376cc95e69c4475b', 'cb9f5f82521006a64fd6569b376cc95e69c4475b', '2014-10-15', 'active'),
(4, 'kimberlydarl.barbadillo@chromedia.com', 'Kimberly Darl', 'Barbadillo', '8a6a1d9e9c9e1b8f49596e093f3e8a65fbea3052', '8a6a1d9e9c9e1b8f49596e093f3e8a65fbea3052', '2014-10-15', 'inactive');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `UserManagement`
--
ALTER TABLE `UserManagement`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `UserManagement`
--
ALTER TABLE `UserManagement`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
