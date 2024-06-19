-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2024 at 05:02 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gymkhana_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(5) NOT NULL,
  `admin_name` varchar(150) NOT NULL,
  `admin_username` varchar(150) NOT NULL,
  `admin_password` varchar(32) NOT NULL,
  `admin_email` varchar(150) NOT NULL,
  `admin_position` varchar(255) NOT NULL,
  `admin_contact` varchar(15) NOT NULL,
  `admin_create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `admin_edit_date` datetime NOT NULL,
  `admin_delete_date` datetime NOT NULL,
  `admin_status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_username`, `admin_password`, `admin_email`, `admin_position`, `admin_contact`, `admin_create_date`, `admin_edit_date`, `admin_delete_date`, `admin_status`) VALUES
(1, 'GYMKHAZANA', 'gym', 'c93ccd78b2076528346216b3b2f701e6', 'ashrfwjdii@gmail.com', 'admin', 'null', '2023-12-10 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(2, 'asdasd', 'TCH123', 'e99a18c428cb38d5f260853678922e03', 'asdasd', 'admin', 'asdads', '2024-02-03 16:51:16', '2024-02-03 17:05:36', '0000-00-00 00:00:00', 'inactive'),
(3, 'asdasd', 'sdasd', 'f5660122479db60ecdf6e23e1cfce421', 'asdasd', 'admin', 'asdads', '2024-02-03 16:29:56', '0000-00-00 00:00:00', '2024-02-03 16:36:12', 'active'),
(4, 'asdasd', 'finance', 'd6b0ab7f1c8ab8f514db9a6d85de160a', 'asdasd', 'finance', 'asdads', '2024-02-03 16:52:00', '2024-02-03 17:15:17', '0000-00-00 00:00:00', 'active'),
(5, 'asdasdasd', 'asdasd', '881c8c2dd6ac40bd35b3d5c46b0b7ef8', 'sadsda', 'admin', 'asdasda', '2024-02-03 17:06:51', '0000-00-00 00:00:00', '2024-02-04 15:18:43', 'active'),
(6, 'traineradmin123', 'traineradmin', '0202e4dae376cd703435626a51eb9181', 'asdasd@gmail.com', 'admin', 'acap', '2024-02-04 15:13:34', '2024-02-04 15:14:06', '0000-00-00 00:00:00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `applynow`
--

CREATE TABLE `applynow` (
  `apply_id` int(11) NOT NULL,
  `apply_name` varchar(255) NOT NULL,
  `apply_class_name` varchar(255) NOT NULL,
  `apply_class_type` varchar(255) NOT NULL,
  `apply_class_desc` text NOT NULL,
  `apply_email` varchar(255) NOT NULL,
  `apply_contact` varchar(11) NOT NULL,
  `apply_address` varchar(255) NOT NULL,
  `apply_image` varchar(255) NOT NULL,
  `apply_code` varchar(6) NOT NULL,
  `apply_create_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applynow`
--

INSERT INTO `applynow` (`apply_id`, `apply_name`, `apply_class_name`, `apply_class_type`, `apply_class_desc`, `apply_email`, `apply_contact`, `apply_address`, `apply_image`, `apply_code`, `apply_create_date`) VALUES
(1, 'Rachel Raze', 'Indoor Cycling', 'Cardio', 'A high-energy cardiovascular workout using stationary bikes. Led by an instructor, participants simulate outdoor cycling and vary intensity throughout the session.', 'rachelraze@gmail.com', '0112223333', 'MMU CYBER', '../img/trainer/team-1.jpg', '324162', '2023-12-27 08:06:58'),
(2, 'Kodak Black', 'HIIT (High-Intensity Interval Training) ', 'Strength', 'Embark on a transformative fitness journey with our high-energy cardiovascular workout, the exhilarating world of indoor cycling. Led by the dynamic and motivating instructor, experience the thrill of pedaling to the rhythm of invigorating music while engaging in a full-body, calorie-burning adventure.', 'kodakblack@gmail.com', '0122223333', 'MMU MELAKA', '../img/trainer/team-2.jpg', '428797', '2023-12-27 10:10:50');

-- --------------------------------------------------------

--
-- Table structure for table `cardd`
--

CREATE TABLE `cardd` (
  `card_id` int(11) NOT NULL,
  `card_number` varchar(16) NOT NULL,
  `card_holder` varchar(100) NOT NULL,
  `card_cvc` varchar(3) NOT NULL,
  `card_mm` varchar(2) NOT NULL,
  `card_yy` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cardd`
--

INSERT INTO `cardd` (`card_id`, `card_number`, `card_holder`, `card_cvc`, `card_mm`, `card_yy`) VALUES
(1, '1001200230034004', 'Ashraf Wajdi', '525', '12', '30');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `class_id` int(10) NOT NULL,
  `trainer_id` int(10) NOT NULL,
  `plan_id` int(10) NOT NULL,
  `class_name` varchar(255) NOT NULL,
  `class_type` varchar(255) NOT NULL,
  `class_desc` varchar(255) NOT NULL,
  `class_day` varchar(255) NOT NULL,
  `class_time` varchar(255) NOT NULL,
  `class_create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `class_delete_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `trainer_id`, `plan_id`, `class_name`, `class_type`, `class_desc`, `class_day`, `class_time`, `class_create_date`, `class_delete_date`) VALUES
(1, 1, 0, 'Indoor Cycling', 'Cardio', 'Embark on a transformative fitness journey with our high-energy cardiovascular workout, the exhilarating world of indoor cycling. Led by the dynamic and motivating instructor, experience the thrill of pedaling to the rhythm of invigorating music while eng', 'Friday', '18:00-19:00', '2023-12-27 08:07:45', '0000-00-00 00:00:00'),
(2, 1, 0, 'Jogging', 'Cardio', 'This class will make you jog 10km nonstop', 'Monday', '19:00-20:00', '2024-02-05 20:11:00', '2024-02-05 13:10:06');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `comment_type` varchar(255) NOT NULL,
  `comment_desc` text NOT NULL,
  `comment_create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `comment_status` enum('Unread','Read') NOT NULL DEFAULT 'Unread'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `customer_id`, `customer_email`, `comment_type`, `comment_desc`, `comment_create_date`, `comment_status`) VALUES
(1, 1, 'ashraf@gmail.com', 'Complaint', 'test', '2024-01-03 13:04:23', ''),
(2, 2, 'cheehan@gmail.com', 'Ideas', 'ssss', '2024-02-05 16:18:21', ''),
(3, 2, 'cheehan@gmail.com', 'Profile Issues', 'ssss', '2024-02-05 16:20:58', 'Unread');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(10) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_username` varchar(100) NOT NULL,
  `customer_password` varchar(50) NOT NULL,
  `customer_email` varchar(50) NOT NULL,
  `customer_contact` varchar(15) NOT NULL,
  `customer_address` text NOT NULL,
  `customer_plan` varchar(255) DEFAULT 'No Active Plan',
  `customer_create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `customer_edit_date` datetime NOT NULL,
  `customer_delete_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_username`, `customer_password`, `customer_email`, `customer_contact`, `customer_address`, `customer_plan`, `customer_create_date`, `customer_edit_date`, `customer_delete_date`) VALUES
(1, 'ASHRAF WAJDI', 'acap', 'c6aeb14d060a089bf5c3af2daed558b1', 'ashraf@gmail.com', '0123456789', 'PUTRAJAYA', '1 Month Unlimited', '2023-12-27 07:58:40', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'CHEE HAN', 'cheehan123', 'c6aeb14d060a089bf5c3af2daed558b1', 'cheehan@gmail.com', '123123123123', 'MMU', '1 Month Unlimited', '2024-02-04 16:56:57', '2024-02-04 17:01:02', '0000-00-00 00:00:00'),
(3, 'ZULHAFIZ', 'zulhafiz123', 'd10dc20d4109393474bc006ca4255f67', 'zulhafiz@gmail.com', '123123123123', 'MMU CYBER', '1 Month Unlimited', '2024-02-04 17:00:43', '2024-02-04 17:01:13', '0000-00-00 00:00:00'),
(4, 'AFIQ', 'afiq123123', '0e12fa19a873712f0da9a5012461afe5', 'afiq@gmail.com', '123123123123', 'MMU CYBER', '1 Month Unlimited', '2024-02-04 17:01:40', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Brad Pitt', 'bradpitt', 'd6b0ab7f1c8ab8f514db9a6d85de160a', '', '', '', '1 Month Unlimited', '2024-02-04 21:26:46', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `invoice_number` varchar(50) NOT NULL,
  `invoice_amount` decimal(12,2) NOT NULL,
  `invoice_create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `invoice_delete_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `customer_id`, `invoice_number`, `invoice_amount`, `invoice_create_date`, `invoice_delete_time`) VALUES
(2, 1, '227029', 30.00, '2023-12-28 15:27:35', '0000-00-00 00:00:00'),
(3, 5, '319282', 30.00, '2024-02-04 21:29:46', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `member_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `plan_id` int(10) NOT NULL,
  `membership_start_date` datetime NOT NULL DEFAULT current_timestamp(),
  `membership_end_date` datetime NOT NULL,
  `membership_status` enum('active','inactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`member_id`, `customer_id`, `plan_id`, `membership_start_date`, `membership_end_date`, `membership_status`) VALUES
(1, 1, 1, '2023-12-28 15:27:35', '2024-01-27 15:27:35', 'active'),
(2, 5, 1, '2024-02-04 21:29:46', '2024-03-05 21:29:46', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymet_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `invoice_id` int(10) NOT NULL,
  `payment_amount` decimal(15,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL DEFAULT 'Debit Card',
  `payment_status` enum('Pending','Paid','Failed','Refunded','Cancelled') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymet_id`, `customer_id`, `invoice_id`, `payment_amount`, `payment_method`, `payment_status`) VALUES
(1, 1, 2, 30.00, 'Debit Card', 'Pending'),
(2, 5, 3, 30.00, 'Debit Card', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE `plan` (
  `plan_id` int(10) NOT NULL,
  `plan_name` varchar(255) DEFAULT NULL,
  `plan_price` decimal(12,2) NOT NULL,
  `plan_description` text NOT NULL,
  `plan_duration` int(3) NOT NULL,
  `plan_edit_date` datetime NOT NULL,
  `plan_delete_date` datetime NOT NULL,
  `plan_created_by` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`plan_id`, `plan_name`, `plan_price`, `plan_description`, `plan_duration`, `plan_edit_date`, `plan_delete_date`, `plan_created_by`) VALUES
(1, '1 Month Unlimited', 30.00, 'This plan caters to individuals seeking comprehensive and flexible gym access, including personalized training, unlimited equipment usage, and diverse fitness classes. The pricing is transparent, and the enrollment process encourages users to sign in for a seamless experience.', 30, '2023-12-28 00:16:16', '0000-00-00 00:00:00', 0),
(2, '6 Month Unlimited', 90.00, 'This plan is tailored for individuals seeking a longer-term commitment to their fitness journey, offering extended access to gym facilities, personalized training, and diverse fitness classes. The transparent pricing and convenient enrollment options aim to provide a positive and accessible experience for users.', 180, '2023-12-28 00:16:16', '0000-00-00 00:00:00', 0),
(3, '12 Month Unlimited', 120.00, 'This plan is designed for individuals committed to a year-long fitness journey, providing extended and unrestricted access to gym amenities, personalized training, and diverse fitness classes. The transparent pricing and user-friendly enrollment options aim to enhance the overall experience for users seeking a long-term membership.', 365, '2023-12-28 00:21:19', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `table_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `class_id` int(10) NOT NULL,
  `trainer_id` int(10) NOT NULL,
  `timetable_create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `timetable_edit_date` datetime NOT NULL,
  `timetable_status` varchar(255) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`table_id`, `customer_id`, `class_id`, `trainer_id`, `timetable_create_date`, `timetable_edit_date`, `timetable_status`) VALUES
(1, 1, 1, 1, '2024-01-03 00:57:55', '0000-00-00 00:00:00', 'active'),
(2, 2, 1, 1, '2024-02-05 15:19:37', '0000-00-00 00:00:00', 'active'),
(3, 1, 2, 1, '2024-02-05 20:17:10', '0000-00-00 00:00:00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `trainer`
--

CREATE TABLE `trainer` (
  `trainer_id` int(10) NOT NULL,
  `trainer_name` varchar(100) NOT NULL,
  `trainer_username` varchar(100) NOT NULL,
  `trainer_password` varchar(50) NOT NULL,
  `trainer_email` varchar(50) NOT NULL,
  `trainer_contact` varchar(15) NOT NULL,
  `trainer_address` text NOT NULL,
  `trainer_image` varchar(255) NOT NULL,
  `trainer_age` varchar(3) NOT NULL,
  `trainer_height` varchar(3) NOT NULL,
  `trainer_weight` varchar(3) NOT NULL,
  `trainer_info` text NOT NULL,
  `trainer_create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `trainer_edit_date` datetime NOT NULL,
  `trainer_delete_date` datetime NOT NULL,
  `trainer_created_by` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainer`
--

INSERT INTO `trainer` (`trainer_id`, `trainer_name`, `trainer_username`, `trainer_password`, `trainer_email`, `trainer_contact`, `trainer_address`, `trainer_image`, `trainer_age`, `trainer_height`, `trainer_weight`, `trainer_info`, `trainer_create_date`, `trainer_edit_date`, `trainer_delete_date`, `trainer_created_by`) VALUES
(1, 'Rachel Raze', 'raze123', 'eda1054806627cf41e39996a586a5b37', 'rachelraze@gmail.com', '0112223333', 'MMU CYBER', '../img/trainer/team-1.jpg', '24', '160', '55', 'Meet Raze, an enthusiastic and passionate instructor who brings a vibrant energy to the world of indoor cycling. With a keen love for fitness and wellness, Raze is dedicated to guiding others on their journey to a healthier lifestyle through the exhilarating practice of indoor cycling.', '2023-12-27 08:07:45', '2024-02-04 17:02:41', '0000-00-00 00:00:00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `applynow`
--
ALTER TABLE `applynow`
  ADD PRIMARY KEY (`apply_id`);

--
-- Indexes for table `cardd`
--
ALTER TABLE `cardd`
  ADD PRIMARY KEY (`card_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymet_id`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`plan_id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`table_id`);

--
-- Indexes for table `trainer`
--
ALTER TABLE `trainer`
  ADD PRIMARY KEY (`trainer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `applynow`
--
ALTER TABLE `applynow`
  MODIFY `apply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cardd`
--
ALTER TABLE `cardd`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `membership`
--
ALTER TABLE `membership`
  MODIFY `member_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymet_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `plan_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `table_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `trainer`
--
ALTER TABLE `trainer`
  MODIFY `trainer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
