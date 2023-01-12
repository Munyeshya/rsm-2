-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2022 at 10:35 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rsm`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `ID` int(225) NOT NULL,
  `firstname` varchar(225) NOT NULL,
  `lastname` varchar(225) NOT NULL,
  `username` varchar(255) NOT NULL,
  `contact` varchar(30) NOT NULL,
  `role` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`ID`, `firstname`, `lastname`, `username`, `contact`, `role`, `password`) VALUES
(6, 'christian', 'impano', 'ADM', '0788577648', 'admin', 'gift'),
(30, 'nirere', 'angelique', 'ORDA', '0785262640', 'admin', 'KUNDWA123'),
(31, 'nisigizwe', 'francine', 'ORDB', '0782332624', 'orders', '1971abc'),
(33, 'mukayisenga', 'micheline', 'ORDC', '078821178', 'orders', 'shimwa567'),
(35, 'uwiduhaye', 'joselyne', 'joselyne_rsm', '0783994648', 'cashier', 'Apotre600'),
(40, 'niyigena', 'chantal', 'chantal_rsm', '0786574978', 'orders', 'karemera4040'),
(42, 'ishimwe', 'cesar', 'cesar_rsm', '0788818632', 'production', 'rwanda2020'),
(43, 'nirere', 'obedi', 'Chris250rw', '0785262640', 'sales', '123');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `C_id` int(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `client_contact` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`C_id`, `firstname`, `lastname`, `client_contact`) VALUES
(23, '', '', ''),
(24, 'Lon', 'Scott', '0789898989'),
(25, 'Eric', 'Impano', '0783385626'),
(26, 'obedi', 'kiriya', '0788469876');

-- --------------------------------------------------------

--
-- Table structure for table `money`
--

CREATE TABLE `money` (
  `orderid` varchar(30) NOT NULL,
  `pay1` int(30) NOT NULL,
  `method1` varchar(30) NOT NULL,
  `pay2` varchar(30) NOT NULL,
  `method2` varchar(30) NOT NULL,
  `reste` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `money`
--

INSERT INTO `money` (`orderid`, `pay1`, `method1`, `pay2`, `method2`, `reste`) VALUES
('ADM1', 200, 'MTN Mobile money', '978', 'MTN Mobile money', '0');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(255) NOT NULL,
  `orderid` varchar(255) DEFAULT NULL,
  `C_id` int(255) DEFAULT NULL,
  `operator` varchar(255) DEFAULT NULL,
  `itemtype` varchar(255) DEFAULT NULL,
  `UP` varchar(30) NOT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `piece` varchar(255) DEFAULT NULL,
  `TS` varchar(255) DEFAULT NULL,
  `TP` varchar(255) DEFAULT NULL,
  `GT` varchar(255) DEFAULT NULL,
  `end` varchar(10) DEFAULT NULL,
  `vis` varchar(30) DEFAULT 'visible',
  `sales` varchar(30) NOT NULL,
  `full` varchar(30) NOT NULL,
  `prod` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `orderid`, `C_id`, `operator`, `itemtype`, `UP`, `destination`, `date`, `size`, `piece`, `TS`, `TP`, `GT`, `end`, `vis`, `sales`, `full`, `prod`) VALUES
(19, 'ADM1', 26, 'impano', 'TOLE TOUILE BG30', '', 'Gisozi', '2022-07-25', '5', '2', '10', '', '', 'cont', 'invisible', 'view', '', 'file'),
(20, 'ADM1', 26, 'impano', 'TOLE TOUILE BG30', '45', 'Gisozi', '2022-07-25', '4', '2', '8', '810', '', 'cont', 'invisible', 'view', '', 'file'),
(21, 'ADM1', 26, 'impano', 'Imifuniko', '', 'Gisozi', '2022-07-25', '2', '2', '4', '', '', 'cont', 'invisible', 'view', '', 'file'),
(22, 'ADM1', 26, 'impano', 'Imifuniko', '23', 'Gisozi', '2022-07-25', '6', '2', '12', '368', '1178', 'end', 'invisible', 'view', '', 'file');

-- --------------------------------------------------------

--
-- Table structure for table `pending`
--

CREATE TABLE `pending` (
  `id` int(255) NOT NULL,
  `orderid` varchar(255) DEFAULT NULL,
  `C_id` int(255) DEFAULT NULL,
  `operator` varchar(255) DEFAULT NULL,
  `itemtype` varchar(255) DEFAULT NULL,
  `UP` varchar(30) NOT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `piece` varchar(255) DEFAULT NULL,
  `TS` varchar(255) DEFAULT NULL,
  `TP` varchar(255) DEFAULT NULL,
  `GT` varchar(255) DEFAULT NULL,
  `end` varchar(10) DEFAULT NULL,
  `vis` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `petty`
--

CREATE TABLE `petty` (
  `names` varchar(90) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `cash` varchar(30) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petty`
--

INSERT INTO `petty` (`names`, `purpose`, `cash`, `date`) VALUES
('bazongere', 'karani', '200', '2022-07-28'),
('chris', 'motari', '2000', '2022-07-26'),
('muteyi', 'gjkufg', '3455', '2022-07-27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`C_id`),
  ADD UNIQUE KEY `client_contact_2` (`client_contact`),
  ADD KEY `client_contact` (`client_contact`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `C_id` (`C_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `ID` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `C_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`C_id`) REFERENCES `clients` (`C_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
