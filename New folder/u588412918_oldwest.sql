-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 27, 2025 at 06:40 PM
-- Server version: 11.8.3-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u588412918_oldwest`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `AccountNo` varchar(12) NOT NULL,
  `Balance` varchar(100) NOT NULL,
  `SavingBalance` varchar(100) NOT NULL,
  `SavingTarget` varchar(100) NOT NULL,
  `AccountType` text NOT NULL,
  `State` int(11) NOT NULL,
  `total_balance` int(11) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `AccountNo`, `Balance`, `SavingBalance`, `SavingTarget`, `AccountType`, `State`, `total_balance`, `datetime`) VALUES
(1, '428251738020', '1289810', '2000000', '', 'Saving', 0, 0, '2025-04-28 17:38:02'),
(2, '430250606380', '1500000', '0.0', '', 'Saving', 0, 0, '2025-04-30 06:06:38'),
(3, '430250627120', '600', '0.0', '', 'Saving', 0, 0, '2025-04-30 06:27:12'),
(4, '501251828280', '7500', '0.0', '', 'Saving', 0, 0, '2025-05-01 18:28:28'),
(5, '503251102070', '0.0', '0.0', '', 'Saving', 0, 0, '2025-05-03 11:02:07'),
(6, '526251105450', '1413900', '2050000', '', 'Saving', 0, 0, '2025-05-26 11:05:45'),
(7, '526251148230', '2269000', '435000', '', 'Saving', 0, 0, '2025-05-26 11:48:23'),
(8, '714250347510', '925000', '300270', '', 'Saving', 0, 0, '2025-07-14 03:47:51'),
(9, '718251704150', '1000000', '0.0', '', 'Saving', 0, 0, '2025-07-18 17:04:15'),
(10, '901251420500', '921580', '1185600', '', 'Saving', 0, 0, '2025-09-01 14:20:50'),
(11, '918252151530', '1743241', '1000000', '', 'Saving', 0, 0, '2025-09-18 21:51:53');

-- --------------------------------------------------------

--
-- Table structure for table `bankcodes`
--

CREATE TABLE `bankcodes` (
  `id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `used` int(11) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `user` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bankcodes`
--

INSERT INTO `bankcodes` (`id`, `code`, `used`, `datetime`, `user`) VALUES
(53, '2998', 0, '2025-05-02 23:37:43', '430250627120'),
(54, '2523', 0, '2025-05-03 08:51:25', '428251738020'),
(56, '1749', 0, '2025-05-05 16:01:02', '430250606380'),
(74, '1057', 0, '2025-05-28 02:18:44', '526251148230'),
(75, '9344', 1, '2025-06-18 15:22:50', '526251105450'),
(80, '7339', 1, '2025-09-08 00:09:19', '901251420500'),
(87, '6991', 1, '2025-09-18 22:45:08', '918252151530');

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `srNo` int(11) NOT NULL,
  `AccountNo` varchar(12) NOT NULL,
  `Name` varchar(80) NOT NULL,
  `CardNo` varchar(16) NOT NULL,
  `cvv` int(3) NOT NULL,
  `IssuedDate` varchar(20) NOT NULL,
  `ExpiryDate` varchar(20) NOT NULL,
  `Status` varchar(12) NOT NULL,
  `Verified` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`srNo`, `AccountNo`, `Name`, `CardNo`, `cvv`, `IssuedDate`, `ExpiryDate`, `Status`, `Verified`) VALUES
(4, '428251738020', 'ARTHUR ALBERT', '8242925002605042', 310, '2025-04-29', '2029-04-29', 'Active', 'Yes'),
(5, '526251105450', 'JOHN B KLIVAR ', '6271825173538052', 858, '2025-07-18', '2029-07-18', 'Active', 'Yes'),
(6, '918252151530', 'JOHN B KLIVAR', '8291825215900091', 367, '2025-09-19', '2029-09-19', 'Active', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `customer_detail`
--

CREATE TABLE `customer_detail` (
  `C_No` int(11) NOT NULL,
  `Account_No` varchar(12) NOT NULL,
  `C_First_Name` text NOT NULL,
  `C_Last_Name` text NOT NULL,
  `Gender` text NOT NULL,
  `C_Father_Name` text NOT NULL,
  `C_Mother_Name` text NOT NULL,
  `C_Birth_Date` date NOT NULL,
  `C_Adhar_No` varchar(12) NOT NULL,
  `C_Pan_No` varchar(10) NOT NULL,
  `C_Mobile_No` varchar(10) NOT NULL,
  `C_Email` varchar(200) NOT NULL,
  `C_Pincode` varchar(6) NOT NULL,
  `C_Adhar_Doc` varchar(500) NOT NULL,
  `C_Pan_Doc` varchar(500) NOT NULL,
  `Create_Date` date NOT NULL DEFAULT current_timestamp(),
  `ProfileColor` varchar(100) NOT NULL,
  `ProfileImage` varchar(400) NOT NULL,
  `Bio` varchar(100) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_detail`
--

INSERT INTO `customer_detail` (`C_No`, `Account_No`, `C_First_Name`, `C_Last_Name`, `Gender`, `C_Father_Name`, `C_Mother_Name`, `C_Birth_Date`, `C_Adhar_No`, `C_Pan_No`, `C_Mobile_No`, `C_Email`, `C_Pincode`, `C_Adhar_Doc`, `C_Pan_Doc`, `Create_Date`, `ProfileColor`, `ProfileImage`, `Bio`, `datetime`) VALUES
(1, '903241721531', 'Admin', 'Admin', 'Not Available', '', '', '1980-04-04', '99988555559', '', '0816876543', 'chidubem@gmail.com', '', '', 'customer_data/Pan_doc/lcogo0932024172153.png', '2024-09-03', '#785955', '', '', '2025-04-22 21:16:07'),
(2, '428251738020', 'Arthur', 'Albert', 'Male', '', '', '1947-04-20', '0', '', '0120349858', 'Arthuralbert1aa@gmail.com', '', '', '', '2025-04-28', '', '', 'The purpose of our lives is to be happy', '2025-04-28 17:38:02'),
(3, '430250606380', 'Linda Lucille', 'Thomas', 'Female', '', '', '1946-05-03', '0', '', '0152097544', 'Spunky10411@gmail.com', '', '', '', '2025-04-30', '', '', 'The purpose of our lives is to be happy', '2025-04-30 06:06:38'),
(4, '430250627120', 'Charlse', 'Dan', 'Female', '', '', '1993-09-13', '0', '', '0897741778', 'dancharlse@gmail.com', '', '', 'customer_data/Pan_doc/Capture04302025062712.PNG', '2025-04-30', '#f6c8a8', '../customer_data/Pan_doc/images_(16)dubem1.jpeg', 'The purpose of our lives is to be happy', '2025-04-30 06:27:12'),
(5, '501251828280', 'Rachel', 'Dongham', 'Not Available', '', '', '1970-11-10', '0', '', '0816041716', 'racheldungham@gmail.com', '', '', '', '2025-05-01', '', '', '', '2025-05-01 18:28:28'),
(6, '503251102070', 'bvnvn', 'vbnvbn', 'Not Available', '', '', '1997-11-11', '0', '', '9987654317', 'sebovysy@polkaroad.net', '', '', 'customer_data/Pan_doc/Screenshot_2025-05-02_1011350532025110207.png', '2025-05-03', '#d396a7', '', '', '2025-05-03 11:02:07'),
(7, '526251105450', 'John B', 'Klivar ', 'Male', '', '', '1948-11-10', '0', '', '2417901496', 'johnbillklivar@gmail.com', '', '', '', '2025-05-26', '', '../customer_data/Pan_doc/cat_pixBillklivar.jpg', 'The purpose of our lives is to be happy', '2025-05-26 11:05:45'),
(8, '526251148230', 'Michael', 'Alex Esser', 'Male', '', '', '1955-08-20', '0', '', '6082852611', 'michaelesser600@gmail.com', '', '', '', '2025-05-26', '', '../customer_data/Profile_Img/logoomitch.jpeg', 'The purpose of our lives is to be happy', '2025-05-26 11:48:23'),
(9, '714250347510', 'kiara', 'Marie', 'Female', '', '', '1987-04-21', '0', '', '3022876718', 'princesskiaramaire@outlook.com', '', '', '', '2025-07-14', '', '', 'The purpose of our lives is to be happy', '2025-07-14 03:47:51'),
(10, '718251704150', 'Shelly F', 'Robertson', 'Not Available', '', '', '1950-10-16', '0', '', '7578688690', 'Wishr3@msn.com', '', '', '', '2025-07-18', '', '', '', '2025-07-18 17:04:15'),
(11, '901251420500', 'CARL', 'RASMUSSEN', 'Male', '', '', '1962-03-15', '0', '', '5614658227', 'ceo@crownpiperesolution.com', '', '', '', '2025-09-01', '', '../customer_data/Pan_doc/c901251414480.PNG', 'The purpose of our lives is to be happy', '2025-09-01 14:20:50'),
(12, '918252151530', 'John B', 'Klivar', 'Not Available', '', '', '1948-01-01', '0', '', '2317151496', 'happymankk112@outlook.com', '', '', '', '2025-09-18', '', '', '', '2025-09-18 21:51:53');

-- --------------------------------------------------------

--
-- Table structure for table `inter_transaction`
--

CREATE TABLE `inter_transaction` (
  `id` int(11) NOT NULL,
  `SenderAccountNo` varchar(12) NOT NULL,
  `ReceiverAccountNo` varchar(12) NOT NULL,
  `bankname` text NOT NULL,
  `Amount` varchar(100) NOT NULL,
  `sortcode` varchar(100) NOT NULL,
  `bankcode` varchar(100) NOT NULL,
  `Date` datetime NOT NULL DEFAULT current_timestamp(),
  `Status` text NOT NULL,
  `description` text NOT NULL,
  `account_name` text NOT NULL,
  `routingno` varchar(100) NOT NULL,
  `deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `ID` int(11) NOT NULL,
  `AccountNo` varchar(12) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Password` varchar(40) NOT NULL,
  `Status` varchar(20) NOT NULL,
  `State` int(11) NOT NULL,
  `AuthKey` varchar(50) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`ID`, `AccountNo`, `Username`, `Password`, `Status`, `State`, `AuthKey`, `datetime`) VALUES
(3, '428251738020', 'Arthur101', 'Godson101', 'Deactivated', 0, '0', '2025-04-28 17:38:02'),
(4, '430250606380', 'Coldfrosty', 'Sweetangel!36', 'Deactivated', 0, '0', '2025-04-30 06:06:38'),
(5, '430250627120', 'dubem1', '123456', 'Deactivated', 0, '0', '2025-04-30 06:27:12'),
(6, '501251828280', 'rachel', '123', 'Active', 0, '0', '2025-05-01 18:28:28'),
(7, '503251102070', 'qwas333', 'Admin@123', 'Active', 0, '0', '2025-05-03 11:02:07'),
(8, '526251105450', 'Billklivar', 'Sunshine101', 'Deactivated', 0, '0', '2025-05-26 11:05:45'),
(9, '526251148230', 'mitch', '123456', 'Active', 0, '0', '2025-05-26 11:48:23'),
(10, '714250347510', 'Princesskiara', 'kiaramarie', 'Active', 0, '0', '2025-07-14 03:47:51'),
(11, '718251704150', 'Wishr', 'Schreuder1950', 'Deactivated', 0, '0', '2025-07-18 17:04:15'),
(12, '901251420500', '901251414480', 'Carlrass11006', 'Active', 0, '0', '2025-09-01 14:20:50'),
(2, '903241721531', 'admin', '123', 'Super', 1, '0', '2025-04-24 12:59:12'),
(13, '918252151530', 'Klivarjb ', 'Sunshine101', 'Active', 0, '0', '2025-09-18 21:51:53');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `AccountNo` varchar(12) NOT NULL,
  `FAccountNo` varchar(12) NOT NULL,
  `Name` text NOT NULL,
  `Amount` varchar(100) NOT NULL,
  `Debit` varchar(100) NOT NULL,
  `Credit` varchar(100) NOT NULL,
  `Date` datetime NOT NULL DEFAULT current_timestamp(),
  `Status` text NOT NULL,
  `ProfileColor` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `ReceiverBankName` varchar(200) NOT NULL,
  `SortCode` varchar(100) NOT NULL,
  `tran_status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `AccountNo`, `FAccountNo`, `Name`, `Amount`, `Debit`, `Credit`, `Date`, `Status`, `ProfileColor`, `description`, `ReceiverBankName`, `SortCode`, `tran_status`) VALUES
(1, '428251738020', '344017902015', 'BP P.L.C', '1720000', '0.0', '1720000', '2025-02-19 15:54:00', 'Credited', 'blue', 'Balance Payment For Complete Contract', 'Bank of America', '', 'Successful'),
(6, '428251738020', '312252000370', 'Linda Lucille Thomas', '1500000', '1500000', '0.0', '2025-04-30 21:13:00', 'Debited', '', 'Family', 'Old west bank', 'WSSTS44', 'Rejected'),
(9, '430250606380', '428251738020', 'Arthur Albert', '1500000', '0.0', '1500000', '2025-05-02 22:19:00', 'Credited', 'blue', 'Family', 'Old West Bank', '323274607', 'Successful'),
(23, '428251738020', '430250606380', 'Old West Bank', '1500000', '1500000', '0.0', '2025-04-30 21:30:00', 'Debited', '', 'Family', ' Linda Lucille Thomas', 'WSSTUS44', 'Successful'),
(34, '526251148230', '5048544778', 'Taste of Hope', '26000', '26000', '0.0', '2025-05-26 18:51:00', 'Debited', '', 'Payment for materials', 'Wells Fargo Bank', '121042882', 'Successful'),
(35, '526251148230', '1524711814', 'Silvia Lourdes Saldana Loaiza', '32000', '32000', '0.0', '2025-05-27 14:31:00', 'Debited', '', 'Payments', 'Bancomer', '012835015247118149', 'Successful'),
(38, '901251420500', '82055275140', 'CMC GLOBAL', '200000', '0.0', '200000', '2025-07-10 14:27:00', 'Credited', 'blue', 'SERVICE', 'CHASE BANK', '', 'Successful'),
(39, '901251420500', '011268476534', 'CRYSTAL BRIDGE', '425000', '0.0', '425000', '2025-06-26 14:37:00', 'Credited', 'blue', 'SERVICES', 'BOA BANK', '', 'Successful'),
(40, '901251420500', '00188765439', 'EXXON', '860000', '0.0', '860000', '2025-08-29 14:42:00', 'Credited', 'blue', 'SERVICES', 'US BANK', '', 'Successful'),
(41, '901251420500', '1006136511', '', '850000', '0.0', '850000', '2025-08-13 14:46:00', 'Credited', 'blue', 'SERVICES', 'ONE UNITED BANK', '', 'Successful'),
(42, '901251420500', '1006136691', 'MCU EXPORT AND SUPPLY INC.', '66000', '66000', '0.0', '2025-08-29 10:52:00', 'Debited', '', 'services', 'ONE UNITED BANK', 'UNDEUS42XXX', 'Successful'),
(43, '901251420500', '886601178651', 'CG GLOBAL SERVICES', '213000', '213000', '0.0', '2025-09-01 12:07:00', 'Debited', '', 'SERVICES', 'BOA', 'BOFAUS3NXXX', 'Successful'),
(44, '901251420500', '009598811345', 'PEMEX', '115000', '0.0', '115000', '2025-07-02 12:16:00', 'Credited', 'blue', 'REPAIRS', 'CHASE BANK', '', 'Successful'),
(45, '901251420500', '1006136691', 'mcu export and supplies', '72800', '72800', '0.0', '2025-09-07 23:22:00', 'Debited', '', 'SERVICES', 'one united bank', 'UNDEUS42XXX', 'Rejected'),
(46, '901251420500', '5022044274', 'cg global services', '63820', '63820', '0.0', '2025-09-07 20:09:00', 'Debited', '', 'SERVICES', 'bank of america', 'BOFAUS3N', 'Successful'),
(47, '918252151530', '10922781091', 'Blue Peton LLC', '39700', '39,700', '0.0', '2025-09-07 10:27:00', 'Debited', '', 'For Services', 'Wells Fargo Bank ', 'WFBIUS6S', 'Successful'),
(48, '918252151530', '1895444118', 'Kentel Ventures LLC', '489500', '489500', '0.0', '2025-09-02 09:26:00', 'Debited', '', 'Payment for Supplies', 'Comerica Bank ', 'MNBDUS33', 'Successful'),
(49, '918252151530', '952705569', 'Myrna Jackson ', '62820', '62820', '0.0', '2025-09-01 15:06:00', 'Debited', '', 'For Services', 'Chase Bank', 'CHASUS33XXX', 'Successful'),
(50, '918252151530', '518011922025', 'Virgilynne J Crook', '79100', '79100', '0.0', '2025-09-05 16:49:00', 'Debited', '', 'For Services', 'Bank of America', 'BOFAUS3N', 'Successful'),
(51, '918252151530', '28397392', 'Gaint Clark LLC', '750300', '750300', '0.0', '2025-09-06 11:45:00', 'Debited', '', 'For Purchase', 'Union Bank', 'UBPHPHMMXXX', 'Successful');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `AccountNo` (`AccountNo`);

--
-- Indexes for table `bankcodes`
--
ALTER TABLE `bankcodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`srNo`),
  ADD UNIQUE KEY `AccountNo` (`AccountNo`),
  ADD UNIQUE KEY `CardNo` (`CardNo`);

--
-- Indexes for table `customer_detail`
--
ALTER TABLE `customer_detail`
  ADD PRIMARY KEY (`C_No`),
  ADD UNIQUE KEY `Account_No` (`Account_No`),
  ADD UNIQUE KEY `C_Email` (`C_Email`);

--
-- Indexes for table `inter_transaction`
--
ALTER TABLE `inter_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`AccountNo`),
  ADD UNIQUE KEY `Unique` (`ID`),
  ADD UNIQUE KEY `AccountNo` (`AccountNo`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `bankcodes`
--
ALTER TABLE `bankcodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `srNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer_detail`
--
ALTER TABLE `customer_detail`
  MODIFY `C_No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `inter_transaction`
--
ALTER TABLE `inter_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
