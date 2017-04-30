-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2017 at 11:07 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `warehouse`
--

-- --------------------------------------------------------

--
-- Table structure for table `action_type`
--

CREATE TABLE `action_type` (
  `ID` int(11) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `action_type`
--

INSERT INTO `action_type` (`ID`, `type`) VALUES
(1, 'Log in'),
(2, 'Add product'),
(3, 'Update product'),
(4, 'Delete product'),
(6, 'Add new user'),
(7, 'Dispatch');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `ID` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL,
  `country_name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`ID`, `country_code`, `country_name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'DS', 'American Samoa'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarctica'),
(9, 'AG', 'Antigua and Barbuda'),
(10, 'AR', 'Argentina'),
(11, 'AM', 'Armenia'),
(12, 'AW', 'Aruba'),
(13, 'AU', 'Australia'),
(14, 'AT', 'Austria'),
(15, 'AZ', 'Azerbaijan'),
(16, 'BS', 'Bahamas'),
(17, 'BH', 'Bahrain'),
(18, 'BD', 'Bangladesh'),
(19, 'BB', 'Barbados'),
(20, 'BY', 'Belarus'),
(21, 'BE', 'Belgium'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermuda'),
(25, 'BT', 'Bhutan'),
(26, 'BO', 'Bolivia'),
(27, 'BA', 'Bosnia and Herzegovina'),
(28, 'BW', 'Botswana'),
(29, 'BV', 'Bouvet Island'),
(30, 'BR', 'Brazil'),
(31, 'IO', 'British Indian Ocean Territory'),
(32, 'BN', 'Brunei Darussalam'),
(33, 'BG', 'Bulgaria'),
(34, 'BF', 'Burkina Faso'),
(35, 'BI', 'Burundi'),
(36, 'KH', 'Cambodia'),
(37, 'CM', 'Cameroon'),
(38, 'CA', 'Canada'),
(39, 'CV', 'Cape Verde'),
(40, 'KY', 'Cayman Islands'),
(41, 'CF', 'Central African Republic'),
(42, 'TD', 'Chad'),
(43, 'CL', 'Chile'),
(44, 'CN', 'China'),
(45, 'CX', 'Christmas Island'),
(46, 'CC', 'Cocos (Keeling) Islands'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CG', 'Congo'),
(50, 'CK', 'Cook Islands'),
(51, 'CR', 'Costa Rica'),
(52, 'HR', 'Croatia (Hrvatska)'),
(53, 'CU', 'Cuba'),
(54, 'CY', 'Cyprus'),
(55, 'CZ', 'Czech Republic'),
(56, 'DK', 'Denmark'),
(57, 'DJ', 'Djibouti'),
(58, 'DM', 'Dominica'),
(59, 'DO', 'Dominican Republic'),
(60, 'TP', 'East Timor'),
(61, 'EC', 'Ecuador'),
(62, 'EG', 'Egypt'),
(63, 'SV', 'El Salvador'),
(64, 'GQ', 'Equatorial Guinea'),
(65, 'ER', 'Eritrea'),
(66, 'EE', 'Estonia'),
(67, 'ET', 'Ethiopia'),
(68, 'FK', 'Falkland Islands (Malvinas)'),
(69, 'FO', 'Faroe Islands'),
(70, 'FJ', 'Fiji'),
(71, 'FI', 'Finland'),
(72, 'FR', 'France'),
(73, 'FX', 'France, Metropolitan'),
(74, 'GF', 'French Guiana'),
(75, 'PF', 'French Polynesia'),
(76, 'TF', 'French Southern Territories'),
(77, 'GA', 'Gabon'),
(78, 'GM', 'Gambia'),
(79, 'GE', 'Georgia'),
(80, 'DE', 'Germany'),
(81, 'GH', 'Ghana'),
(82, 'GI', 'Gibraltar'),
(83, 'GK', 'Guernsey'),
(84, 'GR', 'Greece'),
(85, 'GL', 'Greenland'),
(86, 'GD', 'Grenada'),
(87, 'GP', 'Guadeloupe'),
(88, 'GU', 'Guam'),
(89, 'GT', 'Guatemala'),
(90, 'GN', 'Guinea'),
(91, 'GW', 'Guinea-Bissau'),
(92, 'GY', 'Guyana'),
(93, 'HT', 'Haiti'),
(94, 'HM', 'Heard and Mc Donald Islands'),
(95, 'HN', 'Honduras'),
(96, 'HK', 'Hong Kong'),
(97, 'HU', 'Hungary'),
(98, 'IS', 'Iceland'),
(99, 'IN', 'India'),
(100, 'IM', 'Isle of Man'),
(101, 'ID', 'Indonesia'),
(102, 'IR', 'Iran (Islamic Republic of)'),
(103, 'IQ', 'Iraq'),
(104, 'IE', 'Ireland'),
(105, 'IL', 'Israel'),
(106, 'IT', 'Italy'),
(107, 'CI', 'Ivory Coast'),
(108, 'JE', 'Jersey'),
(109, 'JM', 'Jamaica'),
(110, 'JP', 'Japan'),
(111, 'JO', 'Jordan'),
(112, 'KZ', 'Kazakhstan'),
(113, 'KE', 'Kenya'),
(114, 'KI', 'Kiribati'),
(115, 'KP', 'Korea, Democratic People\'s Republic of'),
(116, 'KR', 'Korea, Republic of'),
(117, 'XK', 'Kosovo'),
(118, 'KW', 'Kuwait'),
(119, 'KG', 'Kyrgyzstan'),
(120, 'LA', 'Lao People\'s Democratic Republic'),
(121, 'LV', 'Latvia'),
(122, 'LB', 'Lebanon'),
(123, 'LS', 'Lesotho'),
(124, 'LR', 'Liberia'),
(125, 'LY', 'Libyan Arab Jamahiriya'),
(126, 'LI', 'Liechtenstein'),
(127, 'LT', 'Lithuania'),
(128, 'LU', 'Luxembourg'),
(129, 'MO', 'Macau'),
(130, 'MK', 'Macedonia'),
(131, 'MG', 'Madagascar'),
(132, 'MW', 'Malawi'),
(133, 'MY', 'Malaysia'),
(134, 'MV', 'Maldives'),
(135, 'ML', 'Mali'),
(136, 'MT', 'Malta'),
(137, 'MH', 'Marshall Islands'),
(138, 'MQ', 'Martinique'),
(139, 'MR', 'Mauritania'),
(140, 'MU', 'Mauritius'),
(141, 'TY', 'Mayotte'),
(142, 'MX', 'Mexico'),
(143, 'FM', 'Micronesia, Federated States of'),
(144, 'MD', 'Moldova, Republic of'),
(145, 'MC', 'Monaco'),
(146, 'MN', 'Mongolia'),
(147, 'ME', 'Montenegro'),
(148, 'MS', 'Montserrat'),
(149, 'MA', 'Morocco'),
(150, 'MZ', 'Mozambique'),
(151, 'MM', 'Myanmar'),
(152, 'NA', 'Namibia'),
(153, 'NR', 'Nauru'),
(154, 'NP', 'Nepal'),
(155, 'NL', 'Netherlands'),
(156, 'AN', 'Netherlands Antilles'),
(157, 'NC', 'New Caledonia'),
(158, 'NZ', 'New Zealand'),
(159, 'NI', 'Nicaragua'),
(160, 'NE', 'Niger'),
(161, 'NG', 'Nigeria'),
(162, 'NU', 'Niue'),
(163, 'NF', 'Norfolk Island'),
(164, 'MP', 'Northern Mariana Islands'),
(165, 'NO', 'Norway'),
(166, 'OM', 'Oman'),
(167, 'PK', 'Pakistan'),
(168, 'PW', 'Palau'),
(169, 'PS', 'Palestine'),
(170, 'PA', 'Panama'),
(171, 'PG', 'Papua New Guinea'),
(172, 'PY', 'Paraguay'),
(173, 'PE', 'Peru'),
(174, 'PH', 'Philippines'),
(175, 'PN', 'Pitcairn'),
(176, 'PL', 'Poland'),
(177, 'PT', 'Portugal'),
(178, 'PR', 'Puerto Rico'),
(179, 'QA', 'Qatar'),
(180, 'RE', 'Reunion'),
(181, 'RO', 'Romania'),
(182, 'RU', 'Russian Federation'),
(183, 'RW', 'Rwanda'),
(184, 'KN', 'Saint Kitts and Nevis'),
(185, 'LC', 'Saint Lucia'),
(186, 'VC', 'Saint Vincent and the Grenadines'),
(187, 'WS', 'Samoa'),
(188, 'SM', 'San Marino'),
(189, 'ST', 'Sao Tome and Principe'),
(190, 'SA', 'Saudi Arabia'),
(191, 'SN', 'Senegal'),
(192, 'RS', 'Serbia'),
(193, 'SC', 'Seychelles'),
(194, 'SL', 'Sierra Leone'),
(195, 'SG', 'Singapore'),
(196, 'SK', 'Slovakia'),
(197, 'SI', 'Slovenia'),
(198, 'SB', 'Solomon Islands'),
(199, 'SO', 'Somalia'),
(200, 'ZA', 'South Africa'),
(201, 'GS', 'South Georgia South Sandwich Islands'),
(202, 'ES', 'Spain'),
(203, 'LK', 'Sri Lanka'),
(204, 'SH', 'St. Helena'),
(205, 'PM', 'St. Pierre and Miquelon'),
(206, 'SD', 'Sudan'),
(207, 'SR', 'Suriname'),
(208, 'SJ', 'Svalbard and Jan Mayen Islands'),
(209, 'SZ', 'Swaziland'),
(210, 'SE', 'Sweden'),
(211, 'CH', 'Switzerland'),
(212, 'SY', 'Syrian Arab Republic'),
(213, 'TW', 'Taiwan'),
(214, 'TJ', 'Tajikistan'),
(215, 'TZ', 'Tanzania, United Republic of'),
(216, 'TH', 'Thailand'),
(217, 'TG', 'Togo'),
(218, 'TK', 'Tokelau'),
(219, 'TO', 'Tonga'),
(220, 'TT', 'Trinidad and Tobago'),
(221, 'TN', 'Tunisia'),
(222, 'TR', 'Turkey'),
(223, 'TM', 'Turkmenistan'),
(224, 'TC', 'Turks and Caicos Islands'),
(225, 'TV', 'Tuvalu'),
(226, 'UG', 'Uganda'),
(227, 'UA', 'Ukraine'),
(228, 'AE', 'United Arab Emirates'),
(229, 'GB', 'United Kingdom'),
(230, 'US', 'United States'),
(231, 'UM', 'United States minor outlying islands'),
(232, 'UY', 'Uruguay'),
(233, 'UZ', 'Uzbekistan'),
(234, 'VU', 'Vanuatu'),
(235, 'VA', 'Vatican City State'),
(236, 'VE', 'Venezuela'),
(237, 'VN', 'Vietnam'),
(238, 'VG', 'Virgin Islands (British)'),
(239, 'VI', 'Virgin Islands (U.S.)'),
(240, 'WF', 'Wallis and Futuna Islands'),
(241, 'EH', 'Western Sahara'),
(242, 'YE', 'Yemen'),
(243, 'ZR', 'Zaire'),
(244, 'ZM', 'Zambia'),
(245, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `ID` int(100) NOT NULL,
  `Full_name` varchar(120) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `account_type` varchar(20) NOT NULL DEFAULT 'user',
  `enabled` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`ID`, `Full_name`, `username`, `password`, `account_type`, `enabled`) VALUES
(1, 'John Doe', 'johndoe', 'johndoepass', 'user', 1),
(2, 'Jane Roe', 'janeroe', 'janeroepass', 'user', 1),
(3, 'Warehouse Keeper', 'admin', 'adminpass', 'admin', 1),
(4, 'Test User', 'test', 'testpass', 'user', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee_log`
--

CREATE TABLE `employee_log` (
  `ID` int(11) NOT NULL,
  `employee_ID` int(11) NOT NULL,
  `action_type_ID` int(11) NOT NULL,
  `product_modified_ID` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `ip_address` varchar(16) NOT NULL,
  `log_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_log`
--

INSERT INTO `employee_log` (`ID`, `employee_ID`, `action_type_ID`, `product_modified_ID`, `description`, `ip_address`, `log_time`) VALUES
(3, 1, 2, 18, 'Product added', '127.0.0.1', '2017-04-26 14:48:31'),
(2, 1, 1, NULL, 'John Doe[johndoe] has logged in', '127.0.0.1', '2017-04-26 14:31:13'),
(4, 1, 1, NULL, 'John Doe[johndoe] has logged in', '127.0.0.1', '2017-04-26 16:16:15'),
(5, 1, 1, NULL, 'John Doe[johndoe] has logged in', '127.0.0.1', '2017-04-26 16:16:43'),
(6, 1, 1, NULL, 'John Doe[johndoe] has logged in', '127.0.0.1', '2017-04-26 16:16:52'),
(7, 1, 3, 18, 'Product {Apa minerala, Romania, 240, pieces} modified to {Apa minerala, Romania, 210, pieces}', '127.0.0.1', '2017-04-26 16:18:23'),
(8, 1, 1, NULL, 'John Doe[johndoe] has logged in', '127.0.0.1', '2017-04-26 16:20:57'),
(9, 1, 3, 10, 'Product {Rosii, Turkey, 200, kilograms} modified to {Rosii, Turkey, 100, pieces}', '127.0.0.1', '2017-04-26 16:23:50'),
(10, 1, 3, 12, 'Product {Pix, Moldova, Republic of, 20, pieces} modified to {Pix, Moldova, Republic of, 0.760, kilograms}', '127.0.0.1', '2017-04-26 16:29:36'),
(11, 2, 1, NULL, 'Jane Roe[janeroe] has logged in', '127.0.0.1', '2017-04-26 17:05:20'),
(12, 2, 3, 14, 'Product {Coli A4, China, 1500, pieces} modified to {Coli A4, China, 1000, pieces}', '127.0.0.1', '2017-04-26 17:06:02'),
(13, 2, 2, 19, 'Product added', '127.0.0.1', '2017-04-26 17:07:50'),
(14, 2, 2, 20, 'Product added', '127.0.0.1', '2017-04-26 17:26:01'),
(15, 2, 4, 20, 'Product {test, Algeria, 2, kilograms} deleted', '127.0.0.1', '2017-04-26 17:52:37'),
(16, 2, 2, 21, 'Product added', '127.0.0.1', '2017-04-26 17:53:39'),
(19, 3, 1, NULL, 'Warehouse Keeper[admin] has logged in', '127.0.0.1', '2017-04-27 16:33:42'),
(18, 2, 4, 21, 'Product {test2, Korea, Democratic People\'s Republic of, 5, pieces} deleted', '127.0.0.1', '2017-04-26 18:02:13'),
(20, 1, 1, NULL, 'John Doe[johndoe] has logged in', '127.0.0.1', '2017-04-27 16:41:14'),
(21, 3, 1, NULL, 'Warehouse Keeper[admin] has logged in', '127.0.0.1', '2017-04-27 16:41:28'),
(22, 3, 1, NULL, 'Warehouse Keeper[admin] has logged in', '127.0.0.1', '2017-04-27 16:42:03'),
(23, 2, 1, NULL, 'Jane Roe[janeroe] has logged in', '127.0.0.1', '2017-04-27 16:42:14'),
(24, 1, 1, NULL, 'John Doe[johndoe] has logged in', '127.0.0.1', '2017-04-27 16:50:27'),
(25, 3, 1, NULL, 'Warehouse Keeper[admin] has logged in', '127.0.0.1', '2017-04-27 16:50:48'),
(26, 3, 6, NULL, 'New user added {full_name:Test User , username:test}', '127.0.0.1', '2017-04-27 17:15:57'),
(27, 4, 1, NULL, 'Test User[test] has logged in', '127.0.0.1', '2017-04-27 17:17:42'),
(28, 4, 3, 19, 'Product {Mouse, China, 25, pieces} modified to {Mouse, China, 20, pieces}', '127.0.0.1', '2017-04-27 17:31:15'),
(29, 4, 2, 22, 'Product added', '127.0.0.1', '2017-04-27 17:31:37'),
(30, 4, 4, 22, 'Product {test, American Samoa, 1, pieces} deleted', '127.0.0.1', '2017-04-27 17:31:46'),
(31, 3, 1, NULL, 'Warehouse Keeper[admin] has logged in', '127.0.0.1', '2017-04-27 17:32:12'),
(32, 2, 1, NULL, 'Jane Roe[janeroe] has logged in', '127.0.0.1', '2017-04-29 12:20:50'),
(40, 1, 2, 23, 'Product added', '127.0.0.1', '2017-04-30 08:40:44'),
(41, 1, 3, 1, 'Product {Portocale, Romania, 148, kilograms} modified to {Portocale, Romania, 150, kilograms}', '127.0.0.1', '2017-04-30 08:55:11'),
(37, 1, 1, NULL, 'John Doe[johndoe] has logged in', '127.0.0.1', '2017-04-30 07:25:28'),
(38, 3, 1, NULL, 'Warehouse Keeper[admin] has logged in', '127.0.0.1', '2017-04-30 07:28:28'),
(39, 1, 1, NULL, 'John Doe[johndoe] has logged in', '127.0.0.1', '2017-04-30 07:28:50'),
(35, 2, 7, 15, 'Product quantity modified from 600 to 550', '127.0.0.1', '2017-04-30 07:12:52'),
(36, 2, 7, 12, 'Product quantity modified from 0.76 to 0.75', '127.0.0.1', '2017-04-30 07:14:31'),
(42, 2, 1, NULL, 'Jane Roe[janeroe] has logged in', '127.0.0.1', '2017-04-30 09:31:39'),
(43, 2, 3, 1, 'Product {Portocale, Romania, 151, kilograms} modified to {Portocale, Romania, 150, kilograms}', '127.0.0.1', '2017-04-30 09:32:38'),
(44, 2, 3, 1, 'Product {Portocale, Romania, 150, kilograms} modified to {Portocale, Romania, 160, kilograms}', '127.0.0.1', '2017-04-30 09:36:17'),
(45, 2, 2, 1, 'Quantity added: 3', '127.0.0.1', '2017-04-30 09:57:02'),
(46, 2, 2, 1, 'Quantity added: 5', '127.0.0.1', '2017-04-30 09:58:19'),
(47, 2, 2, 12, 'Quantity added: 0.01', '127.0.0.1', '2017-04-30 09:59:58'),
(48, 2, 2, 24, 'Product added', '127.0.0.1', '2017-04-30 10:00:54'),
(49, 2, 2, 23, 'Quantity added: 344', '127.0.0.1', '2017-04-30 10:01:33'),
(50, 2, 2, 25, 'Product added', '127.0.0.1', '2017-04-30 10:01:51'),
(51, 2, 4, 25, 'Product {asd, Afghanistan, 1, pieces} deleted', '127.0.0.1', '2017-04-30 10:02:06'),
(52, 2, 4, 24, 'Product {asdf, Afghanistan, 3, pieces} deleted', '127.0.0.1', '2017-04-30 10:02:09'),
(53, 2, 4, 23, 'Product {asd, Afghanistan, 677, kilograms} deleted', '127.0.0.1', '2017-04-30 10:02:15'),
(54, 2, 2, 1, 'Quantity added: 5', '127.0.0.1', '2017-04-30 10:03:46');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Country_ID` int(11) NOT NULL COMMENT 'Country of origin (COO) ID',
  `Quantity` double NOT NULL,
  `Unit_of_measure_ID` int(11) NOT NULL,
  `Last_modified_by_employee_ID` int(11) NOT NULL,
  `Last_time_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID`, `Name`, `Country_ID`, `Quantity`, `Unit_of_measure_ID`, `Last_modified_by_employee_ID`, `Last_time_modified`) VALUES
(1, 'Portocale', 181, 160, 1, 2, '2017-04-30 10:03:46'),
(2, 'Banane', 106, 120, 1, 2, '2017-04-23 16:16:49'),
(10, 'Rosii', 222, 100, 1, 1, '2017-04-26 16:28:59'),
(9, 'Mere', 181, 85, 1, 1, '2017-04-23 20:37:17'),
(11, 'Caiet', 33, 40, 2, 1, '2017-04-23 21:07:23'),
(12, 'Pix', 144, 0.76, 1, 2, '2017-04-30 09:59:58'),
(13, 'Guma mestecat', 181, 300, 2, 2, '2017-04-23 21:49:28'),
(14, 'Coli A4', 44, 1000, 2, 2, '2017-04-26 17:06:02'),
(15, 'Coli A3', 44, 550, 2, 2, '2017-04-30 07:12:52'),
(19, 'Mouse', 44, 20, 2, 4, '2017-04-27 17:31:15'),
(18, 'Apa minerala', 181, 210, 2, 1, '2017-04-30 06:44:27');

-- --------------------------------------------------------

--
-- Table structure for table `units_of_measure`
--

CREATE TABLE `units_of_measure` (
  `ID` int(11) NOT NULL,
  `unit_name` varchar(120) NOT NULL,
  `Abbreviation` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `units_of_measure`
--

INSERT INTO `units_of_measure` (`ID`, `unit_name`, `Abbreviation`) VALUES
(1, 'kilograms', 'kg'),
(2, 'pieces', 'pcs');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action_type`
--
ALTER TABLE `action_type`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `country_name` (`country_name`),
  ADD UNIQUE KEY `country_code` (`country_code`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `employee_log`
--
ALTER TABLE `employee_log`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `units_of_measure`
--
ALTER TABLE `units_of_measure`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Abbreviation` (`Abbreviation`),
  ADD UNIQUE KEY `Name` (`unit_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action_type`
--
ALTER TABLE `action_type`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `employee_log`
--
ALTER TABLE `employee_log`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `units_of_measure`
--
ALTER TABLE `units_of_measure`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
