-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2026 at 02:38 AM
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
-- Database: `project2db`
--
CREATE DATABASE IF NOT EXISTS `project2db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `project2db`;

-- --------------------------------------------------------

--
-- Table structure for table `about_group`
--

DROP TABLE IF EXISTS `about_group`;
CREATE TABLE `about_group` (
  `id` int(11) NOT NULL,
  `group_name` varchar(100) NOT NULL,
  `class_day` varchar(30) NOT NULL,
  `class_time` varchar(30) NOT NULL,
  `photo_path` varchar(255) NOT NULL,
  `photo_alt` varchar(255) NOT NULL,
  `photo_caption` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about_group`
--

INSERT INTO `about_group` (`id`, `group_name`, `class_day`, `class_time`, `photo_path`, `photo_alt`, `photo_caption`) VALUES
(1, 'WebDevs', 'Wednesday', '2:30pm-4:30pm', 'images/group_photo.jpg', 'WebDevs team group photo, photo collage of five members', 'WebDevs Group');

-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--

DROP TABLE IF EXISTS `eoi`;
CREATE TABLE `eoi` (
  `EOInumber` int(11) NOT NULL,
  `jobRef` varchar(6) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(20) NOT NULL,
  `streetAddress` varchar(40) NOT NULL,
  `suburb` varchar(40) NOT NULL,
  `state` char(3) NOT NULL,
  `postcode` char(4) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phoneNum` varchar(12) NOT NULL,
  `skills` text DEFAULT NULL,
  `otherSkills` text DEFAULT NULL,
  `status` enum('New','Current','Final') NOT NULL DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `jobRef` varchar(6) NOT NULL,
  `title` varchar(100) NOT NULL,
  `salary` varchar(100) NOT NULL,
  `reportsTo` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `responsibilities` text NOT NULL,
  `essentialRequirements` text NOT NULL,
  `preferableRequirements` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`jobRef`, `title`, `salary`, `reportsTo`, `description`, `responsibilities`, `essentialRequirements`, `preferableRequirements`) VALUES
('TRV101', 'Front-End Web Developer', '$70,000 - $80,000 per year', 'Web Development Manager', 'We are looking for a Front-End Web Developer to help create user-friendly and responsive websites for our tourism and travel platform.', 'Develop and maintain website pages.\r\nImprove website usability and design.\r\nWork with other members of the development team.', 'Basic knowledge of HTML and CSS.\r\nGood communication skills.\r\nAbility to work effectively in a team.', 'Knowledge of responsive web design.\r\nInterest in tourism and travel technology.'),
('TRV202', 'Travel Systems Support Analyst', '$65,000 - $75,000 per year', 'IT Support Manager', 'We are looking for a Travel Systems Support Analyst to provide technical support for our online travel booking systems and services.', 'Provide technical support to users and staff.\r\nIdentify and resolve issues with travel booking systems.\r\nMaintain records of technical problems and solutions.', 'Good problem-solving skills.\r\nBasic knowledge of computer systems and networks.\r\nGood written and verbal communication skills.', 'Experience in customer or technical support.\r\nInterest in travel technology systems.'),
('TRV303', 'Digital Travel Content Coordinator', '$60,000 - $70,000 per year', 'Marketing Manager', 'We are looking for a Digital Travel Content Coordinator to create and maintain engaging content for our tourism and travel platform.', 'Create and update travel-related website content.\r\nMaintain accurate destination and service information.\r\nWork with the marketing team to support online campaigns.', 'Good written communication skills.\r\nStrong attention to detail.\r\nAbility to work effectively in a team.', 'Experience creating digital content.\r\nInterest in tourism, travel and online media.');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE `members` (
  `member_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `part1_work` text NOT NULL,
  `part2_work` text NOT NULL,
  `quote` text DEFAULT NULL,
  `quote_translation` text DEFAULT NULL,
  `fun_fact` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `full_name`, `part1_work`, `part2_work`, `quote`, `quote_translation`, `fun_fact`) VALUES
(1, 'Priyankha Sakthivel', 'Apply page (job reference, names, date of birth, gender, street address) and corresponding CSS.', 'Shared PHP includes (header.inc, nav.inc, footer.inc), settings.php, database setup, page conversion to PHP, the dynamic About page, and review fixes to the files listed in README.', 'Work hard, play hard.', NULL, 'Always has a book on the go.'),
(2, 'Dimitri Meric', 'Home page and corresponding CSS.', 'manage.php HR functions: list, filter, sort, change status, delete EOIs by job reference, tips.php and its tables.', 'Arriver en avance est inacceptable, arriver à l\'heure revient à être en retard, et arriver à la dernière minute, c\'est être à l\'heure.', 'To be early is unacceptable to be on time is to be late and to be last minute is to be on time.', 'I\'m french, you can make fun of me now'),
(3, 'Thomas Mathew', 'Jobs page and corresponding CSS.', 'eoi and jobs tables, process_eoi.php with server-side validation, jobs search functionality, and the dynamic jobs page.', 'If it works, don\'t ask too many questions.', NULL, 'Professional last-minute problem solver.'),
(4, 'Kevin Tan', 'Apply page (suburb, state, postcode, email, phone, skills) and corresponding CSS.', 'Converted apply.html to PHP, server side validation on all form fields, and form POSTs to process_eoi.php', '大家好', 'Hello Everyone.', 'My left hand fingers are longer than my right.'),
(5, 'Mark Leirum', 'About page and corresponding CSS.', 'users table, login page with authentication, the first version of manage.php, and logout.php.', '石の上にも三年 (Ishi no ue ni mo san nen).', 'Perseverance changes things.', 'Can either be found sleeping or running around, no inbetween.');

-- --------------------------------------------------------

--
-- Table structure for table `tips_page`
--

DROP TABLE IF EXISTS `tips_page`;
CREATE TABLE `tips_page` (
  `section_key` varchar(30) NOT NULL,
  `heading` varchar(100) NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tips_page`
--

INSERT INTO `tips_page` (`section_key`, `heading`, `body`) VALUES
('destinations', 'Destination quick guide', 'When to go and what to know for some of the most popular destinations with Australian travellers.'),
('intro', 'Travel Tips', 'Whether you are travelling for a holiday or heading off to start a job in tourism, a little preparation goes a long way. Our team of travel and technology specialists has put together the advice we wish we had on our first trips.'),
('search', 'Find a tip', 'Search by keyword, choose a category, or both.'),
('tips', 'Our top tips', 'Practical advice for planning, packing, spending, staying safe and building a career in travel.');

-- --------------------------------------------------------

--
-- Table structure for table `travel_destinations`
--

DROP TABLE IF EXISTS `travel_destinations`;
CREATE TABLE `travel_destinations` (
  `destination_id` int(11) NOT NULL,
  `destination` varchar(60) NOT NULL,
  `best_time` varchar(80) NOT NULL,
  `weather` varchar(120) NOT NULL,
  `currency` varchar(60) NOT NULL,
  `quick_tip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `travel_destinations`
--

INSERT INTO `travel_destinations` (`destination_id`, `destination`, `best_time`, `weather`, `currency`, `quick_tip`) VALUES
(1, 'Japan', 'March to May, September to November', 'Mild in spring and autumn, hot and humid in summer', 'Japanese yen (JPY)', 'Carry some cash, as smaller shops and restaurants may not take cards.'),
(2, 'Bali, Indonesia', 'April to October', 'Dry season, warm all year round', 'Indonesian rupiah (IDR)', 'Cover your shoulders and knees when visiting temples.'),
(3, 'New Zealand', 'December to February', 'Warm summers, but weather can change quickly', 'New Zealand dollar (NZD)', 'Pack layers and a rain jacket, even in summer.'),
(4, 'Italy', 'April to June, September to October', 'Warm and dry, very hot in mid-summer', 'Euro (EUR)', 'Book popular museums and galleries ahead in peak season.'),
(5, 'Thailand', 'November to February', 'Cooler and drier than the rest of the year', 'Thai baht (THB)', 'Take your shoes off before entering homes and temples.');

-- --------------------------------------------------------

--
-- Table structure for table `travel_tips`
--

DROP TABLE IF EXISTS `travel_tips`;
CREATE TABLE `travel_tips` (
  `tip_id` int(11) NOT NULL,
  `category` varchar(30) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `image_alt` varchar(255) NOT NULL,
  `link_text` varchar(100) DEFAULT NULL,
  `link_url` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `travel_tips`
--

INSERT INTO `travel_tips` (`tip_id`, `category`, `title`, `content`, `image_path`, `image_alt`, `link_text`, `link_url`, `sort_order`) VALUES
(1, 'Planning', 'Check entry requirements early', 'Many countries require your passport to be valid for at least six months after you arrive, and some need a visa arranged before you leave. If you plan to work overseas, check whether you need a work visa rather than a tourist visa.', 'images/tip_passport.png', 'Illustration of a passport with a globe on the cover', 'Check advice on Smartraveller', 'https://www.smartraveller.gov.au/', 1),
(2, 'Packing', 'Pack light and pack smart', 'Roll your clothes to save space and use packing cubes to stay organised. Keep medication, chargers, travel documents and a change of clothes in your carry-on in case your checked bag is delayed.', 'images/tip_suitcase.png', 'Illustration of a packed suitcase with luggage straps', NULL, NULL, 2),
(3, 'Money', 'Sort out your money before you go', 'Let your bank know your travel dates and consider a card with no foreign transaction fees. When a card machine asks, choose to pay in the local currency rather than Australian dollars to avoid a poor exchange rate.', 'images/tip_money.png', 'Illustration of a banknote and coins', NULL, NULL, 3),
(4, 'Health & Safety', 'Get travel insurance and see a doctor', 'Buy travel insurance as soon as you book, so you are covered if plans change. Visit your doctor or a travel clinic six to eight weeks before you leave to ask about vaccinations.', 'images/tip_health.png', 'Illustration of a first aid kit', 'Read Smartraveller vaccination advice', 'https://www.smartraveller.gov.au/before-you-go/health/vaccinations', 4),
(5, 'Culture', 'Learn the basics of local customs', 'A few words of the local language, such as hello, please and thank you, are always appreciated. Knowing local customs is also a big plus if you work with international guests in tourism.', 'images/tip_culture.png', 'Illustration of speech bubbles saying hello in several languages', NULL, NULL, 5),
(6, 'Careers', 'Turn your love of travel into a career', 'The travel industry needs developers, support analysts and content creators as much as it needs tour guides. If you enjoy technology and travel, a role with HireHub could be a great fit.', 'images/tip_career.png', 'Illustration of a map pin above a laptop', 'Browse our current jobs', 'jobs.php', 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `password_hash`) VALUES
(1, 'admin', '$2y$10$3DqUsl.V7XY2SIEUaKDL5uZMZzGb7tEE1wPNMiupF0r0UWc.U43G6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_group`
--
ALTER TABLE `about_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`EOInumber`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`jobRef`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `tips_page`
--
ALTER TABLE `tips_page`
  ADD PRIMARY KEY (`section_key`);

--
-- Indexes for table `travel_destinations`
--
ALTER TABLE `travel_destinations`
  ADD PRIMARY KEY (`destination_id`);

--
-- Indexes for table `travel_tips`
--
ALTER TABLE `travel_tips`
  ADD PRIMARY KEY (`tip_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_group`
--
ALTER TABLE `about_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `EOInumber` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `travel_destinations`
--
ALTER TABLE `travel_destinations`
  MODIFY `destination_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `travel_tips`
--
ALTER TABLE `travel_tips`
  MODIFY `tip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;