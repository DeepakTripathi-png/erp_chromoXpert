-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2025 at 01:56 PM
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
-- Database: `chromo_xpert`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_code` varchar(255) DEFAULT NULL,
  `branch_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `country_id` bigint(20) DEFAULT NULL,
  `state_id` bigint(20) DEFAULT NULL,
  `city_id` bigint(20) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `branch_logo_name` varchar(255) DEFAULT NULL,
  `branch_logo_path` varchar(255) DEFAULT NULL,
  `lab_incharge` bigint(20) DEFAULT NULL,
  `created_ip_address` varchar(255) DEFAULT NULL,
  `modified_ip_address` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `status` enum('active','delete','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `branch_code`, `branch_name`, `email`, `mobile`, `address`, `country_id`, `state_id`, `city_id`, `pincode`, `branch_logo_name`, `branch_logo_path`, `lab_incharge`, `created_ip_address`, `modified_ip_address`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'BR001', 'PandrPur Lab Deepak', 'pndl1@gmail.com', '+919173185601', 'Bair Amad Karari1', 1, 20, 523, '212216', 'download (1).jpeg', 'images/branches/zq6yXfxtfV3yuZ0TUKf1qYFhpFPDTKrdLi71bG2h.jpg', 2, '127.0.0.1', '127.0.0.1', 1, 1, 'active', '2025-09-02 06:28:13', '2025-09-02 23:59:30');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `city_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `state_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`city_id`, `name`, `state_id`) VALUES
(1, 'Port Blair', 1),
(2, 'Adoni', 2),
(3, 'Amaravati', 2),
(4, 'Anantapur', 2),
(5, 'Chandragiri', 2),
(6, 'Chittoor', 2),
(7, 'Dowlaiswaram', 2),
(8, 'Eluru', 2),
(9, 'Guntur', 2),
(10, 'Kadapa', 2),
(11, 'Kakinada', 2),
(12, 'Kurnool', 2),
(13, 'Machilipatnam', 2),
(14, 'Nagarjunakoṇḍa', 2),
(15, 'Rajahmundry', 2),
(16, 'Srikakulam', 2),
(17, 'Tirupati', 2),
(18, 'Vijayawada', 2),
(19, 'Visakhapatnam', 2),
(20, 'Vizianagaram', 2),
(21, 'Yemmiganur', 2),
(22, 'Itanagar', 3),
(23, 'Dhuburi', 4),
(24, 'Dibrugarh', 4),
(25, 'Dispur', 4),
(26, 'Guwahati', 4),
(27, 'Jorhat', 4),
(28, 'Nagaon', 4),
(29, 'Sivasagar', 4),
(30, 'Silchar', 4),
(31, 'Tezpur', 4),
(32, 'Tinsukia', 4),
(33, 'Ara', 5),
(34, 'Barauni', 5),
(35, 'Begusarai', 5),
(36, 'Bettiah', 5),
(37, 'Bhagalpur', 5),
(38, 'Bihar Sharif', 5),
(39, 'Bodh Gaya', 5),
(40, 'Buxar', 5),
(41, 'Chapra', 5),
(42, 'Darbhanga', 5),
(43, 'Dehri', 5),
(44, 'Dinapur Nizamat', 5),
(45, 'Gaya', 5),
(46, 'Hajipur', 5),
(47, 'Jamalpur', 5),
(48, 'Katihar', 5),
(49, 'Madhubani', 5),
(50, 'Motihari', 5),
(51, 'Munger', 5),
(52, 'Muzaffarpur', 5),
(53, 'Patna', 5),
(54, 'Purnia', 5),
(55, 'Pusa', 5),
(56, 'Saharsa', 5),
(57, 'Samastipur', 5),
(58, 'Sasaram', 5),
(59, 'Sitamarhi', 5),
(60, 'Siwan', 5),
(61, 'Chandigarh', 6),
(62, 'Ambikapur', 7),
(63, 'Bhilai', 7),
(64, 'Bilaspur', 7),
(65, 'Dhamtari', 7),
(66, 'Durg', 7),
(67, 'Jagdalpur', 7),
(68, 'Raipur', 7),
(69, 'Rajnandgaon', 7),
(70, 'Daman', 8),
(71, 'Diu', 8),
(72, 'Silvassa', 8),
(73, 'Delhi', 9),
(74, 'New Delhi', 9),
(75, 'Madgaon', 10),
(76, 'Panaji', 10),
(77, 'Ahmadabad', 11),
(78, 'Amreli', 11),
(79, 'Bharuch', 11),
(80, 'Bhavnagar', 11),
(81, 'Bhuj', 11),
(82, 'Dwarka', 11),
(83, 'Gandhinagar', 11),
(84, 'Godhra', 11),
(85, 'Jamnagar', 11),
(86, 'Junagadh', 11),
(87, 'Kandla', 11),
(88, 'Khambhat', 11),
(89, 'Kheda', 11),
(90, 'Mahesana', 11),
(91, 'Morbi', 11),
(92, 'Nadiad', 11),
(93, 'Navsari', 11),
(94, 'Okha', 11),
(95, 'Palanpur', 11),
(96, 'Patan', 11),
(97, 'Porbandar', 11),
(98, 'Rajkot', 11),
(99, 'Surat', 11),
(100, 'Surendranagar', 11),
(101, 'Valsad', 11),
(102, 'Veraval', 11),
(103, 'Ambala', 12),
(104, 'Bhiwani', 12),
(105, 'Chandigarh', 12),
(106, 'Faridabad', 12),
(107, 'Firozpur Jhirka', 12),
(108, 'Gurugram', 12),
(109, 'Hansi', 12),
(110, 'Hisar', 12),
(111, 'Jind', 12),
(112, 'Kaithal', 12),
(113, 'Karnal', 12),
(114, 'Kurukshetra', 12),
(115, 'Panipat', 12),
(116, 'Pehowa', 12),
(117, 'Rewari', 12),
(118, 'Rohtak', 12),
(119, 'Sirsa', 12),
(120, 'Sonipat', 12),
(121, 'Bilaspur', 13),
(122, 'Chamba', 13),
(123, 'Dalhousie', 13),
(124, 'Dharmshala', 13),
(125, 'Hamirpur', 13),
(126, 'Kangra', 13),
(127, 'Kullu', 13),
(128, 'Mandi', 13),
(129, 'Nahan', 13),
(130, 'Shimla', 13),
(131, 'Una', 13),
(132, 'Anantnag', 14),
(133, 'Baramula', 14),
(134, 'Doda', 14),
(135, 'Gulmarg', 14),
(136, 'Jammu', 14),
(137, 'Kathua', 14),
(138, 'Punch', 14),
(139, 'Rajouri', 14),
(140, 'Srinagar', 14),
(141, 'Udhampur', 14),
(142, 'Bokaro', 15),
(143, 'Chaibasa', 15),
(144, 'Deoghar', 15),
(145, 'Dhanbad', 15),
(146, 'Dumka', 15),
(147, 'Giridih', 15),
(148, 'Hazaribag', 15),
(149, 'Jamshedpur', 15),
(150, 'Jharia', 15),
(151, 'Rajmahal', 15),
(152, 'Ranchi', 15),
(153, 'Saraikela', 15),
(154, 'Badami', 16),
(155, 'Ballari', 16),
(156, 'Bengaluru', 16),
(157, 'Belagavi', 16),
(158, 'Bhadravati', 16),
(159, 'Bidar', 16),
(160, 'Chikkamagaluru', 16),
(161, 'Chitradurga', 16),
(162, 'Davangere', 16),
(163, 'Halebid', 16),
(164, 'Hassan', 16),
(165, 'Hubballi-Dharwad', 16),
(166, 'Kalaburagi', 16),
(167, 'Kolar', 16),
(168, 'Madikeri', 16),
(169, 'Mandya', 16),
(170, 'Mangaluru', 16),
(171, 'Mysuru', 16),
(172, 'Raichur', 16),
(173, 'Shivamogga', 16),
(174, 'Shravanabelagola', 16),
(175, 'Shrirangapattana', 16),
(176, 'Tumakuru', 16),
(177, 'Vijayapura', 16),
(178, 'Alappuzha', 17),
(179, 'Vatakara', 17),
(180, 'Idukki', 17),
(181, 'Kannur', 17),
(182, 'Kochi', 17),
(183, 'Kollam', 17),
(184, 'Kottayam', 17),
(185, 'Kozhikode', 17),
(186, 'Mattancheri', 17),
(187, 'Palakkad', 17),
(188, 'Thalassery', 17),
(189, 'Thiruvananthapuram', 17),
(190, 'Thrissur', 17),
(191, 'Kargil', 18),
(192, 'Leh', 18),
(193, 'Balaghat', 19),
(194, 'Barwani', 19),
(195, 'Betul', 19),
(196, 'Bharhut', 19),
(197, 'Bhind', 19),
(198, 'Bhojpur', 19),
(199, 'Bhopal', 19),
(200, 'Burhanpur', 19),
(201, 'Chhatarpur', 19),
(202, 'Chhindwara', 19),
(203, 'Damoh', 19),
(204, 'Datia', 19),
(205, 'Dewas', 19),
(206, 'Dhar', 19),
(207, 'Dr. Ambedkar Nagar (Mhow)', 19),
(208, 'Guna', 19),
(209, 'Gwalior', 19),
(210, 'Hoshangabad', 19),
(211, 'Indore', 19),
(212, 'Itarsi', 19),
(213, 'Jabalpur', 19),
(214, 'Jhabua', 19),
(215, 'Khajuraho', 19),
(216, 'Khandwa', 19),
(217, 'Khargone', 19),
(218, 'Maheshwar', 19),
(219, 'Mandla', 19),
(220, 'Mandsaur', 19),
(221, 'Morena', 19),
(222, 'Murwara', 19),
(223, 'Narsimhapur', 19),
(224, 'Narsinghgarh', 19),
(225, 'Narwar', 19),
(226, 'Neemuch', 19),
(227, 'Nowgong', 19),
(228, 'Orchha', 19),
(229, 'Panna', 19),
(230, 'Raisen', 19),
(231, 'Rajgarh', 19),
(232, 'Ratlam', 19),
(233, 'Rewa', 19),
(234, 'Sagar', 19),
(235, 'Sarangpur', 19),
(236, 'Satna', 19),
(237, 'Sehore', 19),
(238, 'Seoni', 19),
(239, 'Shahdol', 19),
(240, 'Shajapur', 19),
(241, 'Sheopur', 19),
(242, 'Shivpuri', 19),
(243, 'Ujjain', 19),
(244, 'Vidisha', 19),
(281, 'Imphal', 21),
(282, 'Cherrapunji', 22),
(283, 'Shillong', 22),
(284, 'Aizawl', 23),
(285, 'Lunglei', 23),
(286, 'Kohima', 24),
(287, 'Mon', 24),
(288, 'Phek', 24),
(289, 'Wokha', 24),
(290, 'Zunheboto', 24),
(291, 'Balangir', 25),
(292, 'Baleshwar', 25),
(293, 'Baripada', 25),
(294, 'Bhubaneshwar', 25),
(295, 'Brahmapur', 25),
(296, 'Cuttack', 25),
(297, 'Dhenkanal', 25),
(298, 'Kendujhar', 25),
(299, 'Konark', 25),
(300, 'Koraput', 25),
(301, 'Paradip', 25),
(302, 'Phulabani', 25),
(303, 'Puri', 25),
(304, 'Sambalpur', 25),
(305, 'Udayagiri', 25),
(306, 'Karaikal', 26),
(307, 'Mahe', 26),
(308, 'Puducherry', 26),
(309, 'Yanam', 26),
(310, 'Amritsar', 27),
(311, 'Batala', 27),
(312, 'Chandigarh', 27),
(313, 'Faridkot', 27),
(314, 'Firozpur', 27),
(315, 'Gurdaspur', 27),
(316, 'Hoshiarpur', 27),
(317, 'Jalandhar', 27),
(318, 'Kapurthala', 27),
(319, 'Ludhiana', 27),
(320, 'Nabha', 27),
(321, 'Patiala', 27),
(322, 'Rupnagar', 27),
(323, 'Sangrur', 27),
(324, 'Abu', 28),
(325, 'Ajmer', 28),
(326, 'Alwar', 28),
(327, 'Amer', 28),
(328, 'Barmer', 28),
(329, 'Beawar', 28),
(330, 'Bharatpur', 28),
(331, 'Bhilwara', 28),
(332, 'Bikaner', 28),
(333, 'Bundi', 28),
(334, 'Chittaurgarh', 28),
(335, 'Churu', 28),
(336, 'Dhaulpur', 28),
(337, 'Dungarpur', 28),
(338, 'Ganganagar', 28),
(339, 'Hanumangarh', 28),
(340, 'Jaipur', 28),
(341, 'Jaisalmer', 28),
(342, 'Jalor', 28),
(343, 'Jhalawar', 28),
(344, 'Jhunjhunu', 28),
(345, 'Jodhpur', 28),
(346, 'Kishangarh', 28),
(347, 'Kota', 28),
(348, 'Merta', 28),
(349, 'Nagaur', 28),
(350, 'Nathdwara', 28),
(351, 'Pali', 28),
(352, 'Phalodi', 28),
(353, 'Pushkar', 28),
(354, 'Sawai Madhopur', 28),
(355, 'Shahpura', 28),
(356, 'Sikar', 28),
(357, 'Sirohi', 28),
(358, 'Tonk', 28),
(359, 'Udaipur', 28),
(360, 'Gangtok', 29),
(361, 'Gyalshing', 29),
(362, 'Lachung', 29),
(363, 'Mangan', 29),
(364, 'Arcot', 30),
(365, 'Chengalpattu', 30),
(366, 'Chennai', 30),
(367, 'Chidambaram', 30),
(368, 'Coimbatore', 30),
(369, 'Cuddalore', 30),
(370, 'Dharmapuri', 30),
(371, 'Dindigul', 30),
(372, 'Erode', 30),
(373, 'Kanchipuram', 30),
(374, 'Kanniyakumari', 30),
(375, 'Kodaikanal', 30),
(376, 'Kumbakonam', 30),
(377, 'Madurai', 30),
(378, 'Mamallapuram', 30),
(379, 'Nagappattinam', 30),
(380, 'Nagercoil', 30),
(381, 'Palayamkottai', 30),
(382, 'Pudukkottai', 30),
(383, 'Rajapalayam', 30),
(384, 'Ramanathapuram', 30),
(385, 'Salem', 30),
(386, 'Thanjavur', 30),
(387, 'Tiruchchirappalli', 30),
(388, 'Tirunelveli', 30),
(389, 'Tiruppur', 30),
(390, 'Thoothukudi', 30),
(391, 'Udhagamandalam', 30),
(392, 'Vellore', 30),
(393, 'Hyderabad', 31),
(394, 'Karimnagar', 31),
(395, 'Khammam', 31),
(396, 'Mahbubnagar', 31),
(397, 'Nizamabad', 31),
(398, 'Sangareddi', 31),
(399, 'Warangal', 31),
(400, 'Agartala', 32),
(401, 'Agra', 33),
(402, 'Aligarh', 33),
(403, 'Amroha', 33),
(404, 'Ayodhya', 33),
(405, 'Azamgarh', 33),
(406, 'Bahraich', 33),
(407, 'Ballia', 33),
(408, 'Banda', 33),
(409, 'Bara Banki', 33),
(410, 'Bareilly', 33),
(411, 'Basti', 33),
(412, 'Bijnor', 33),
(413, 'Bithur', 33),
(414, 'Budaun', 33),
(415, 'Bulandshahr', 33),
(416, 'Deoria', 33),
(417, 'Etah', 33),
(418, 'Etawah', 33),
(419, 'Faizabad', 33),
(420, 'Farrukhabad-cum-Fatehgarh', 33),
(421, 'Fatehpur', 33),
(422, 'Fatehpur Sikri', 33),
(423, 'Ghaziabad', 33),
(424, 'Ghazipur', 33),
(425, 'Gonda', 33),
(426, 'Gorakhpur', 33),
(427, 'Hamirpur', 33),
(428, 'Hardoi', 33),
(429, 'Hathras', 33),
(430, 'Jalaun', 33),
(431, 'Jaunpur', 33),
(432, 'Jhansi', 33),
(433, 'Kannauj', 33),
(434, 'Kanpur', 33),
(435, 'Lakhimpur', 33),
(436, 'Lalitpur', 33),
(437, 'Lucknow', 33),
(438, 'Mainpuri', 33),
(439, 'Mathura', 33),
(440, 'Meerut', 33),
(441, 'Mirzapur-Vindhyachal', 33),
(442, 'Moradabad', 33),
(443, 'Muzaffarnagar', 33),
(444, 'Partapgarh', 33),
(445, 'Pilibhit', 33),
(446, 'Prayagraj', 33),
(447, 'Rae Bareli', 33),
(448, 'Rampur', 33),
(449, 'Saharanpur', 33),
(450, 'Sambhal', 33),
(451, 'Shahjahanpur', 33),
(452, 'Sitapur', 33),
(453, 'Sultanpur', 33),
(454, 'Tehri', 33),
(455, 'Varanasi', 33),
(456, 'Almora', 34),
(457, 'Dehra Dun', 34),
(458, 'Haridwar', 34),
(459, 'Mussoorie', 34),
(460, 'Nainital', 34),
(461, 'Pithoragarh', 34),
(462, 'Alipore', 35),
(463, 'Alipur Duar', 35),
(464, 'Asansol', 35),
(465, 'Baharampur', 35),
(466, 'Bally', 35),
(467, 'Balurghat', 35),
(468, 'Bankura', 35),
(469, 'Baranagar', 35),
(470, 'Barasat', 35),
(471, 'Barrackpore', 35),
(472, 'Basirhat', 35),
(473, 'Bhatpara', 35),
(474, 'Bishnupur', 35),
(475, 'Budge Budge', 35),
(476, 'Burdwan', 35),
(477, 'Chandernagore', 35),
(478, 'Darjeeling', 35),
(479, 'Diamond Harbour', 35),
(480, 'Dum Dum', 35),
(481, 'Durgapur', 35),
(482, 'Halisahar', 35),
(483, 'Haora', 35),
(484, 'Hugli', 35),
(485, 'Ingraj Bazar', 35),
(486, 'Jalpaiguri', 35),
(487, 'Kalimpong', 35),
(488, 'Kamarhati', 35),
(489, 'Kanchrapara', 35),
(490, 'Kharagpur', 35),
(491, 'Cooch Behar', 35),
(492, 'Kolkata', 35),
(493, 'Krishnanagar', 35),
(494, 'Malda', 35),
(495, 'Midnapore', 35),
(496, 'Murshidabad', 35),
(497, 'Nabadwip', 35),
(498, 'Palashi', 35),
(499, 'Panihati', 35),
(500, 'Purulia', 35),
(501, 'Raiganj', 35),
(502, 'Santipur', 35),
(503, 'Shantiniketan', 35),
(504, 'Shrirampur', 35),
(505, 'Siliguri', 35),
(506, 'Siuri', 35),
(507, 'Tamluk', 35),
(508, 'Titagarh', 35),
(509, 'Ahmednagar', 20),
(510, 'Akola', 20),
(511, 'Amravati', 20),
(512, 'Aurangabad', 20),
(513, 'Beed', 20),
(514, 'Bhandara', 20),
(515, 'Buldhana', 20),
(516, 'Chandrapur', 20),
(517, 'Dhule', 20),
(518, 'Gadchiroli', 20),
(519, 'Gondia', 20),
(520, 'Hingoli', 20),
(521, 'Jalgaon', 20),
(522, 'Jalna', 20),
(523, 'Kolhapur', 20),
(524, 'Latur', 20),
(525, 'Mumbai City', 20),
(526, 'Mumbai Suburban', 20),
(527, 'Nagpur', 20),
(528, 'Nanded', 20),
(529, 'Nandurbar', 20),
(530, 'Nashik', 20),
(531, 'Osmanabad', 20),
(532, 'Palghar', 20),
(533, 'Parbhani', 20),
(534, 'Pune', 20),
(535, 'Raigad', 20),
(536, 'Ratnagiri', 20),
(537, 'Sangli', 20),
(538, 'Satara', 20),
(539, 'Sindhudurg', 20),
(540, 'Solapur', 20),
(541, 'Thane', 20),
(542, 'Wardha', 20),
(543, 'Washim', 20),
(544, 'Yavatmal', 20);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `country_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_id`, `name`) VALUES
(1, 'India');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `department_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `department_head` bigint(20) DEFAULT NULL,
  `created_ip_address` varchar(255) DEFAULT NULL,
  `modified_ip_address` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `status` enum('active','delete','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `code`, `department_name`, `description`, `email`, `mobile`, `department_head`, `created_ip_address`, `modified_ip_address`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'DEPT001', 'Radiology', NULL, 'deepakmegreat@gmail.com', '+917318560108', 14, '127.0.0.1', '127.0.0.1', 1, 1, 'active', '2025-09-03 04:05:29', '2025-09-03 04:05:29'),
(2, 'DEPT002', 'Pathology1', 'asdsad1', 'deepak1@gmail.com', '+917318560108', 14, '127.0.0.1', '127.0.0.1', 1, 1, 'active', '2025-09-03 04:06:22', '2025-09-03 04:28:36');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `map_link` longtext DEFAULT NULL,
  `facebook_url` varchar(255) DEFAULT NULL,
  `linkedin_url` varchar(255) DEFAULT NULL,
  `instagram_url` varchar(255) DEFAULT NULL,
  `twitter_url` varchar(255) DEFAULT NULL,
  `skype_url` varchar(255) DEFAULT NULL,
  `created_ip_address` varchar(255) DEFAULT NULL,
  `modified_ip_address` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `status` enum('active','delete','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `email`, `mobile`, `address`, `map_link`, `facebook_url`, `linkedin_url`, `instagram_url`, `twitter_url`, `skype_url`, `created_ip_address`, `modified_ip_address`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin@gmail.com', '07318560108', 'Bair Amad Karari', NULL, NULL, NULL, NULL, NULL, NULL, '127.0.0.1', NULL, 1, NULL, 'active', '2025-08-11 06:33:23', '2025-08-11 06:33:23');

-- --------------------------------------------------------

--
-- Table structure for table `internal_doctors`
--

CREATE TABLE `internal_doctors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `doctor_name` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `doctor_image_name` varchar(255) DEFAULT NULL,
  `doctor_image_path` varchar(255) DEFAULT NULL,
  `doctor_sign_name` varchar(255) DEFAULT NULL,
  `doctor_sign_path` varchar(255) DEFAULT NULL,
  `created_ip_address` varchar(255) DEFAULT NULL,
  `modified_ip_address` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `status` enum('active','delete','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `internal_doctors`
--

INSERT INTO `internal_doctors` (`id`, `code`, `doctor_name`, `gender`, `email`, `mobile`, `address`, `doctor_image_name`, `doctor_image_path`, `doctor_sign_name`, `doctor_sign_path`, `created_ip_address`, `modified_ip_address`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ID0001', 'Dr Deepak Internal Doctor1', 'Male', 'drdeepakinternaldoctor1@gmail.com', '+917318560108', 'Bair Amad Karari1', 'SmartSelect_20240905_214054_WhatsApp-sunil-jatania.jpg', 'images/internal_doctors/up3g9sanUufnVqUB4gXDL1Ca0yng801PLstwDHgG.jpg', 'fake-signature-10161016-facsimile-11562888097yoll1qgp4t.png', 'images/internal_doctors/signatures/c6rxVeP6mCZr9J7RDQ8HHcKqTxVJMynICOQ5es3p.png', '127.0.0.1', '127.0.0.1', 1, 1, 'active', '2025-09-02 00:12:14', '2025-09-02 00:44:55'),
(2, 'ID0002', 'xyz', 'Male', 'xyz@gmail.com', '+917318560108', 'Bair Amad Karari', 'SmartSelect_20240905_214054_WhatsApp-sunil-jatania.jpg', 'images/internal_doctors/AURP5Wbf2WfknZgmdjqwzvPeIRYfbuLOnPokaLQ5.jpg', 'fake-signature-10161016-facsimile-11562888097yoll1qgp4t.png', 'images/internal_doctors/signatures/uRirhRpozDOvJYZ0CNzZsgQMuEXem4fmi2uLaX6n.png', '127.0.0.1', '127.0.0.1', 1, 1, 'active', '2025-09-02 00:57:23', '2025-09-02 00:57:23'),
(3, 'ID0003', 'Internal Doctor', 'Male', 'internaldoctor@gmail.com', '+917318560108', 'Bair Amad Karari', 'SmartSelect_20240905_214054_WhatsApp-sunil-jatania.jpg', 'images/internal_doctors/dfIzVFLaV0QnzrxWS9zDmXuSeZKoGeNoPvwOPBfd.jpg', 'fake-signature-10161016-facsimile-11562888097yoll1qgp4t.png', 'images/internal_doctors/signatures/6AYReXsXfEBOQ3maXyOfccP0wFhzaWLywCugyUxM.png', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-04 06:09:33', '2025-09-04 06:09:33');

-- --------------------------------------------------------

--
-- Table structure for table `master_admins`
--

CREATE TABLE `master_admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `role_id` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `user_profile_image_path` varchar(255) DEFAULT NULL,
  `user_profile_image_name` varchar(255) DEFAULT NULL,
  `fcm_token` varchar(255) DEFAULT NULL,
  `access_token` varchar(255) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `otp` bigint(20) DEFAULT NULL,
  `status` enum('active','delete','inactive') NOT NULL DEFAULT 'active',
  `created_ip_address` varchar(255) DEFAULT NULL,
  `modified_ip_address` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_admins`
--

INSERT INTO `master_admins` (`id`, `user_type`, `user_id`, `user_name`, `email`, `password`, `mobile_no`, `role_id`, `address`, `user_profile_image_path`, `user_profile_image_name`, `fcm_token`, `access_token`, `last_login`, `remember_token`, `otp`, `status`, `created_ip_address`, `modified_ip_address`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 'system', NULL, 'ChromoXpert', 'admin@gmail.com', '$2y$10$InJ0GHoOaHXJHMuEYqTMye.t5E4QfWDrzNLW/pltguVNM/OZCpFUm', NULL, '1', NULL, NULL, NULL, NULL, NULL, '2025-09-05 11:35:29', NULL, NULL, 'active', NULL, NULL, NULL, NULL, NULL, '2025-09-05 06:05:29'),
(2, 'system', NULL, 'Deepak Tripathi', 'deepakmegreat@gmail.com', '$2y$10$xNQAIXTjEX.0BWxRGhCRQOij7hFkletib0oR9o33ExwSrzTp3EzSi', '07318560108', '2', 'Bair Amad Karari', NULL, NULL, NULL, NULL, '2025-09-02 09:26:03', NULL, NULL, 'active', '127.0.0.1', NULL, 1, NULL, '2025-07-24 03:52:01', '2025-09-02 03:56:03'),
(3, 'system', NULL, 'Deepak Tripathi', 'rec@gmail.com', '$2y$10$NJsMZ1s/k0ahYflkrDmJcu9BjBRS9URYgC0V8vb3jX.bltSLnMPZ2', '7318560108', '3', 'Bair Amad Karari', NULL, NULL, NULL, NULL, '2025-08-14 08:22:15', NULL, NULL, 'delete', '127.0.0.1', '127.0.0.1', 1, 1, '2025-08-14 02:51:24', '2025-08-14 02:52:15'),
(4, 'customer', NULL, 'Deepak Tripathi', 'deep@gmail.com', '$2y$10$QpGDu/lTa1t9C5zFgWtOu.eLUj1Qdem5XgTYLBz7oGrC.BRWITHQe', '7318560108', NULL, 'Hello this is Deepak Address', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '127.0.0.1', '127.0.0.1', 1, 1, '2025-09-01 01:16:48', '2025-09-01 03:44:11'),
(5, 'customer', NULL, 'Harsh', 'harsh@gmail.com', '$2y$10$eM1ObjunjEvGTyWTqjE0M..QL0SSmvrdoWhwhD.vBLLNqAzgbUaz.', '7318560108', NULL, 'Bair Amad Karari', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '127.0.0.1', NULL, 1, NULL, '2025-09-01 03:47:33', '2025-09-01 03:47:33'),
(6, 'customer', NULL, 'Deepak Tripathi', 'deepak@gmail.com', '$2y$10$QfB24mVynUib/DiOpzkk8ufRqscw4YemEJOVFJmgKmnn5SE9YR6YW', '07318560108', NULL, 'Bair Amad Karari', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '127.0.0.1', NULL, 1, NULL, '2025-09-01 04:15:37', '2025-09-01 04:15:37'),
(7, 'customer', NULL, 'asdsa', 'member@gmail.com', '$2y$10$eazqE/pgz1CTAtoao90yOedGzR5WtVdC87PcURaLNaZTfh194cDn.', '07318560108', NULL, 'Bair Amad Karari', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '127.0.0.1', NULL, 1, NULL, '2025-09-01 04:23:21', '2025-09-01 04:23:21'),
(8, 'customer', NULL, 'Deepak Tripathi', 'sadsa@gmial.com', '$2y$10$knEU.qA.IwzQnLZLADxpWu7y3.I58z3fADCA8DP/usaedzDm/M/Va', '07318560108', NULL, 'Bair Amad Karari', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '127.0.0.1', NULL, 1, NULL, '2025-09-01 04:24:03', '2025-09-01 04:24:03'),
(9, 'customer', NULL, 'deepseek', 'deepakseek@gmail.com', '$2y$10$Vzf2RB0QhyVr3tsoeqgFeead3KvZFz/4SDvKaQzWKvgdGi5gnQCBG', '7318560108', NULL, 'Bair Amad Karari', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '127.0.0.1', NULL, 1, NULL, '2025-09-01 04:24:59', '2025-09-01 04:24:59'),
(10, 'customer', NULL, 'aDasDasdDeepak', 'sadasdfd@gmail.com', '$2y$10$jMwetIH1T8Bh24t8x8.jtOkez9fu3rHEgc51Pk2D8.HIZOX5ZmTJi', '07318560108', NULL, 'Bair Amad Karari', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '127.0.0.1', '127.0.0.1', 1, 1, '2025-09-01 04:31:32', '2025-09-01 04:31:56'),
(11, 'customer', NULL, 'Deepak Pet Parent', 'deepalpetparent@gmail.com', '$2y$10$1T4VLF319ej97EXANG3RmuzA/mV5ZNrlB9FiK9oe1xpo/HZRg5Pmq', '7318560108', NULL, 'Bair Amad Karari', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '127.0.0.1', NULL, 1, NULL, '2025-09-01 04:33:00', '2025-09-01 04:33:00'),
(12, 'internal_doctor', NULL, 'Dr Deepak Internal Doctor1', 'drdeepakinternaldoctor1@gmail.com', '$2y$10$r0GzCP.fOPmFfb9UYp8TeuVm0FAN7rOFP18NqTHl8p5Nyk3b1.Pe.', '+917318560108', '4', 'Bair Amad Karari1', 'images/internal_doctors/up3g9sanUufnVqUB4gXDL1Ca0yng801PLstwDHgG.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'active', '127.0.0.1', '127.0.0.1', 1, 1, '2025-09-02 00:12:14', '2025-09-02 00:44:55'),
(13, 'internal_doctor', NULL, 'xyz', 'xyz@gmail.com', '$2y$10$dbCzWmCbq5ksFnke5X1aI.qrumCLiLKAopZP4xavtfqMvBm.lqvIu', '+917318560108', '4', 'Bair Amad Karari', 'images/internal_doctors/AURP5Wbf2WfknZgmdjqwzvPeIRYfbuLOnPokaLQ5.jpg', NULL, NULL, NULL, '2025-09-05 05:01:07', NULL, NULL, 'active', '127.0.0.1', NULL, 1, NULL, '2025-09-02 00:57:23', '2025-09-04 23:31:07'),
(14, 'system', NULL, 'Deepak Department Head', 'ddh@gmail.com', '$2y$10$sNTRXU1UFsEke6sKjyMvn.ohff45.GvbSejfDmPw6VEv.qi/aeUC2', '7318560108', '3', 'Bair Amad Karari', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '127.0.0.1', NULL, 1, NULL, '2025-09-03 03:16:33', '2025-09-03 03:16:33'),
(15, 'internal_doctor', NULL, 'Internal Doctor', 'internaldoctor@gmail.com', '$2y$10$S7pa8ksDr1twKO3YXa7Md.m4aTd6Pp1lyrQTdZ33AcrRSsxYyoc0a', '+917318560108', '4', 'Bair Amad Karari', 'images/internal_doctors/dfIzVFLaV0QnzrxWS9zDmXuSeZKoGeNoPvwOPBfd.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'active', '127.0.0.1', NULL, 1, NULL, '2025-09-04 06:09:33', '2025-09-04 06:09:33');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_07_05_075239_create_master_admins_table', 1),
(6, '2023_07_13_034312_create_general_settings_table', 1),
(7, '2023_08_22_102532_create_role_privileges_table', 1),
(8, '2023_08_28_112847_create_visual_settings_table', 1),
(10, '2025_09_01_045614_create_petparents_table', 2),
(11, '2025_09_01_112932_create_referee_doctors_table', 3),
(12, '2025_09_02_050059_create_internal_doctors_table', 4),
(13, '2025_09_02_093535_create_branches_table', 5),
(15, '2025_09_03_072046_create_departments_table', 6),
(16, '2025_09_04_061330_create_pets_table', 7),
(17, '2025_09_05_080504_create_tests_table', 8),
(19, '2025_09_05_080749_create_parameter_options_table', 8),
(20, '2025_09_05_080633_create_test_parameters_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `parameter_options`
--

CREATE TABLE `parameter_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parameter_id` bigint(20) DEFAULT NULL,
  `option_value` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_ip_address` varchar(255) DEFAULT NULL,
  `modified_ip_address` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `status` enum('active','delete','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `petparents`
--

CREATE TABLE `petparents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_ip_address` varchar(255) DEFAULT NULL,
  `modified_ip_address` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `status` enum('active','delete','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `petparents`
--

INSERT INTO `petparents` (`id`, `code`, `name`, `gender`, `email`, `mobile`, `address`, `created_ip_address`, `modified_ip_address`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PP0001', 'Deepak Pet Parent', 'Male', 'deepalpetparent@gmail.com', '7318560108', 'Bair Amad Karari', '127.0.0.1', '127.0.0.1', 1, 1, 'active', '2025-09-01 04:33:00', '2025-09-01 04:33:00');

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pet_code` varchar(255) DEFAULT NULL,
  `pet_parent_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `species` varchar(255) DEFAULT NULL,
  `breed` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_ip_address` varchar(255) DEFAULT NULL,
  `modified_ip_address` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `status` enum('active','delete','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`id`, `pet_code`, `pet_parent_id`, `name`, `species`, `breed`, `type`, `gender`, `dob`, `age`, `weight`, `image_name`, `image_path`, `created_ip_address`, `modified_ip_address`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PET001', 1, 'Jacy1', 'Feline', 'Birman', 'Dog', 'Female', '2025-06-30', '2 months 5 days', '2.5', 'download (2).jpeg', 'images/pets/uHW3C7TWlvfpos75o2KhJLswvpVxp9BQO4Dmh5xu.jpg', '127.0.0.1', '127.0.0.1', 1, 1, 'active', '2025-09-04 02:33:53', '2025-09-04 05:03:11'),
(2, 'PET002', 1, 'Deepak', 'Feline', 'Persian', 'Dog', 'Male', '2025-08-20', '15 days', '2', 'download (2).jpeg', 'images/pets/2XKvifin4MfnPUQj7jx4nbl5U60BH95RvHsDQEFf.jpg', '127.0.0.1', '127.0.0.1', 1, 1, 'delete', '2025-09-04 02:50:56', '2025-09-04 02:50:56'),
(3, 'PET003', 1, 'Tommy', 'Canine', 'Labrador Retriever', 'Dog', 'Male', '2025-07-20', '1 month 15 days', '10', 'download (2).jpeg', 'images/pets/64Vv5mxTAcZ8qcuNito2FTNObXtvORJxsjpSrSs4.jpg', '127.0.0.1', NULL, 1, NULL, 'active', '2025-09-04 04:54:23', '2025-09-04 04:54:23');

-- --------------------------------------------------------

--
-- Table structure for table `referee_doctors`
--

CREATE TABLE `referee_doctors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `doctor_name` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `commission_percent` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_ip_address` varchar(255) DEFAULT NULL,
  `modified_ip_address` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `status` enum('active','delete','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `referee_doctors`
--

INSERT INTO `referee_doctors` (`id`, `code`, `doctor_name`, `gender`, `email`, `mobile`, `commission_percent`, `address`, `created_ip_address`, `modified_ip_address`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'RD0001', 'Dr Deepak More', 'Male', 'drmore@gmail.com', '+917318560108', '5', 'Bair Amad Karari', '127.0.0.1', '127.0.0.1', 1, 1, 'active', '2025-09-01 06:24:18', '2025-09-01 06:35:46');

-- --------------------------------------------------------

--
-- Table structure for table `role_privileges`
--

CREATE TABLE `role_privileges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(255) DEFAULT NULL,
  `privileges` text DEFAULT NULL,
  `created_ip_address` varchar(255) DEFAULT NULL,
  `modified_ip_address` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `status` enum('active','delete','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_privileges`
--

INSERT INTO `role_privileges` (`id`, `role_name`, `privileges`, `created_ip_address`, `modified_ip_address`, `created_by`, `modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'dashboard_view,appointments_view,appointments_add,appointments_edit,appointments_delete,appointments_status_change,reports_view,branch_view,branch_add,branch_edit,branch_delete,branch_status_change,departments_view,departments_add,departments_edit,departments_delete,departments_status_change,doctors_view,doctors_add,doctors_edit,doctors_delete,doctors_status_change,internal_doctors_view,internal_doctors_add,internal_doctors_edit,internal_doctors_delete,internal_doctors_status_change,referee_doctors_view,referee_doctors_add,referee_doctors_edit,referee_doctors_delete,referee_doctors_status_change,pet_owners_view,pet_owners_add,pet_owners_edit,pet_owners_delete,pet_owners_status_change,pet_view,pet_add,pet_edit,pet_delete,pet_status_change,test_management_view,test_management_add,test_management_edit,test_management_delete,test_management_status_change,revenue_view,system_users_view,user_view,user_add,user_edit,user_delete,user_status_change,role_privileges_view,role_privileges_add,role_privileges_edit,role_privileges_delete,role_privileges_status_change,settings_view,general_setting_view,general_setting_add,general_setting_edit,visual_setting_view,visual_setting_add,visual_setting_edit,change_password_view,change_password_edit,notifications_view,logout_view', NULL, '127.0.0.1', NULL, 1, 'active', NULL, '2025-09-04 02:32:55'),
(2, 'Lab  Incharge', 'appointments_view,appointments_add,appointments_edit,appointments_delete,appointments_status_change,reports_view,notifications_view,logout_view', '127.0.0.1', '127.0.0.1', 1, 1, 'active', '2025-07-24 03:51:39', '2025-09-03 03:14:50'),
(3, 'Department Head', 'appointments_view,appointments_add,appointments_edit,reports_view', '127.0.0.1', '127.0.0.1', 1, 1, 'active', '2025-08-14 02:42:34', '2025-09-03 03:15:37'),
(4, 'Internal Doctor', 'dashboard_view,reports_view,notifications_view,logout_view', '127.0.0.1', '127.0.0.1', 1, 1, 'active', '2025-09-04 06:24:11', '2025-09-04 07:02:36');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `state_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `country_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`state_id`, `name`, `country_id`) VALUES
(1, 'Andaman and Nicobar Islands (union territory)', 1),
(2, 'Andhra Pradesh', 1),
(3, 'Arunachal Pradesh', 1),
(4, 'Assam', 1),
(5, 'Bihar', 1),
(6, 'Chandigarh (union territory)', 1),
(7, 'Chhattisgarh', 1),
(8, 'Dadra and Nagar Haveli and Daman and Diu (union territory)', 1),
(9, 'Delhi (national capital territory)', 1),
(10, 'Goa', 1),
(11, 'Gujarat', 1),
(12, 'Haryana', 1),
(13, 'Himachal Pradesh', 1),
(14, 'Jammu and Kashmir (union territory)', 1),
(15, 'Jharkhand', 1),
(16, 'Karnataka', 1),
(17, 'Kerala', 1),
(18, 'Ladakh (union territory)', 1),
(19, 'Madhya Pradesh', 1),
(20, 'Maharashtra', 1),
(21, 'Manipur', 1),
(22, 'Meghalaya', 1),
(23, 'Mizoram', 1),
(24, 'Nagaland', 1),
(25, 'Odisha', 1),
(26, 'Puducherry (union territory)', 1),
(27, 'Punjab', 1),
(28, 'Rajasthan', 1),
(29, 'Sikkim', 1),
(30, 'Tamil Nadu', 1),
(31, 'Telangana', 1),
(32, 'Tripura', 1),
(33, 'Uttar Pradesh', 1),
(34, 'Uttarakhand', 1),
(35, 'West Bengal', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_name` varchar(255) DEFAULT NULL,
  `sample_type` varchar(255) DEFAULT NULL,
  `base_price` decimal(10,2) NOT NULL,
  `precautions` text DEFAULT NULL,
  `created_ip_address` varchar(255) DEFAULT NULL,
  `modified_ip_address` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `status` enum('active','delete','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `test_parameters`
--

CREATE TABLE `test_parameters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `test_id` bigint(20) UNSIGNED NOT NULL,
  `row_type` enum('component','title') NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `result_type` enum('text','select') NOT NULL DEFAULT 'text',
  `reference_range` text DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visual_settings`
--

CREATE TABLE `visual_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo_image_path` varchar(255) DEFAULT NULL,
  `logo_image_name` varchar(255) DEFAULT NULL,
  `mini_logo_image_path` varchar(255) DEFAULT NULL,
  `mini_logo_image_name` varchar(255) DEFAULT NULL,
  `logo_email_image_path` varchar(255) DEFAULT NULL,
  `logo_email_image_name` varchar(255) DEFAULT NULL,
  `favicon_image_path` varchar(255) DEFAULT NULL,
  `favicon_image_name` varchar(255) DEFAULT NULL,
  `created_ip_address` varchar(255) DEFAULT NULL,
  `modified_ip_address` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `status` enum('active','delete','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`city_id`),
  ADD KEY `state_id` (`state_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_code_unique` (`code`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `internal_doctors`
--
ALTER TABLE `internal_doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_admins`
--
ALTER TABLE `master_admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parameter_options`
--
ALTER TABLE `parameter_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `petparents`
--
ALTER TABLE `petparents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pets_pet_code_unique` (`pet_code`);

--
-- Indexes for table `referee_doctors`
--
ALTER TABLE `referee_doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_privileges`
--
ALTER TABLE `role_privileges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`state_id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_parameters`
--
ALTER TABLE `test_parameters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test_parameters_test_id_foreign` (`test_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `visual_settings`
--
ALTER TABLE `visual_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=545;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `internal_doctors`
--
ALTER TABLE `internal_doctors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `master_admins`
--
ALTER TABLE `master_admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `parameter_options`
--
ALTER TABLE `parameter_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `petparents`
--
ALTER TABLE `petparents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `referee_doctors`
--
ALTER TABLE `referee_doctors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role_privileges`
--
ALTER TABLE `role_privileges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `test_parameters`
--
ALTER TABLE `test_parameters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visual_settings`
--
ALTER TABLE `visual_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `states` (`state_id`);

--
-- Constraints for table `states`
--
ALTER TABLE `states`
  ADD CONSTRAINT `states_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`country_id`);

--
-- Constraints for table `test_parameters`
--
ALTER TABLE `test_parameters`
  ADD CONSTRAINT `test_parameters_test_id_foreign` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
