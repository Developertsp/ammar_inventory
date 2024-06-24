-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2023 at 05:07 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `created_at`) VALUES
(25, 'Perfumes ', 'Active', '2023-08-21 04:27:52'),
(26, 'Oil', 'Active', '2023-08-21 04:48:35'),
(27, 'Bottle', 'Active', '2023-08-21 12:06:17'),
(28, 'Bag', 'Active', '2023-08-21 12:18:54'),
(29, 'Extras', 'Active', '2023-08-21 12:32:28');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `category_id`, `order_date`, `status`) VALUES
(42, 41, 26, '2023-08-21 11:40:23', 'Canceled'),
(43, 41, 26, '2023-08-21 12:27:31', 'Canceled'),
(44, 41, 26, '2023-08-21 12:40:37', 'Canceled'),
(45, 41, 27, '2023-08-24 14:52:30', 'New'),
(46, 41, 28, '2023-08-24 14:53:10', 'New'),
(47, 41, 27, '2023-08-24 15:05:44', 'Canceled'),
(48, 41, 27, '2023-08-24 15:06:16', 'Canceled'),
(49, 41, 27, '2023-08-24 15:07:01', 'Canceled'),
(50, 41, 27, '2023-08-24 15:09:05', 'Canceled'),
(51, 41, 26, '2023-08-24 16:50:46', 'Canceled'),
(52, 41, 26, '2023-08-24 17:35:57', 'Canceled'),
(53, 43, 25, '2023-08-26 12:37:55', 'Completed'),
(54, 43, 26, '2023-08-26 13:02:06', 'Completed'),
(55, 44, 25, '2023-08-26 13:02:32', 'New'),
(56, 43, 27, '2023-08-26 13:04:36', 'Completed'),
(57, 43, 28, '2023-08-26 13:05:17', 'Completed'),
(58, 44, 29, '2023-08-26 13:10:38', 'Canceled'),
(59, 44, 28, '2023-08-26 13:13:45', 'New'),
(60, 44, 28, '2023-08-26 13:17:21', 'Completed'),
(61, 43, 29, '2023-08-26 13:17:45', 'Completed'),
(62, 44, 25, '2023-08-26 13:42:02', 'Completed'),
(63, 44, 29, '2023-08-26 13:47:03', 'Completed'),
(64, 44, 27, '2023-08-26 14:01:52', 'Completed'),
(65, 44, 26, '2023-08-26 14:22:57', 'New'),
(66, 41, 25, '2023-08-26 14:50:53', 'Canceled'),
(67, 44, 26, '2023-08-27 14:17:56', 'New'),
(68, 50, 27, '2023-09-01 19:13:11', 'New'),
(69, 50, 27, '2023-09-02 09:11:30', 'New'),
(70, 50, 29, '2023-09-02 09:15:36', 'Pending'),
(71, 50, 29, '2023-09-02 09:16:02', 'Completed'),
(72, 50, 29, '2023-09-02 10:07:30', 'Pending'),
(73, 50, 28, '2023-09-02 14:34:22', 'New'),
(74, 50, 29, '2023-09-02 14:34:55', 'New'),
(75, 50, 29, '2023-09-02 14:36:06', 'New'),
(76, 50, 28, '2023-09-02 14:46:21', 'New'),
(77, 50, 27, '2023-09-02 14:48:53', 'New'),
(78, 50, 28, '2023-09-02 14:52:45', 'New'),
(79, 50, 29, '2023-09-02 14:55:20', 'New'),
(80, 50, 29, '2023-09-02 14:56:41', 'New'),
(81, 50, 28, '2023-09-02 14:57:48', 'New'),
(82, 50, 28, '2023-09-02 14:57:50', 'New'),
(83, 50, 29, '2023-09-02 14:59:35', 'New'),
(84, 50, 29, '2023-09-02 15:00:02', 'New'),
(85, 50, 29, '2023-09-02 15:00:47', 'New'),
(86, 50, 29, '2023-09-02 15:01:10', 'New');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `avialable` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `avialable`) VALUES
(90, 42, 93, 500, 500),
(91, 42, 92, 122, 122),
(92, 42, 91, 15, 15),
(93, 42, 90, 15, 15),
(94, 42, 89, 100, 100),
(95, 42, 88, 150, 150),
(96, 42, 87, 100, 100),
(97, 42, 74, 150, 150),
(98, 42, 68, 100, 100),
(99, 42, 51, 200, 200),
(100, 43, 93, 100, 100),
(101, 43, 50, 1, 1),
(102, 44, 66, 1, 1),
(103, 44, 65, 1, 1),
(104, 44, 64, 1, 1),
(105, 44, 63, 1, 1),
(106, 44, 62, 1, 1),
(107, 44, 61, 1, 1),
(108, 44, 60, 1, 1),
(109, 44, 59, 1, 1),
(110, 44, 58, 1, 1),
(111, 44, 57, 1, 1),
(112, 44, 56, 1, 1),
(113, 44, 55, 1, 1),
(114, 44, 54, 1, 1),
(115, 44, 53, 1, 1),
(116, 44, 52, 1, 1),
(117, 44, 51, 1, 1),
(118, 44, 50, 1, 1),
(119, 44, 49, 1, 1),
(120, 45, 117, 0, 0),
(121, 45, 116, 10, 10),
(122, 45, 115, 7, 7),
(123, 45, 113, 0, 0),
(124, 46, 125, 0, 0),
(125, 46, 124, 0, 0),
(126, 46, 119, 0, 0),
(127, 47, 113, 0, 0),
(128, 48, 113, 1, 1),
(129, 49, 113, 50, 50),
(130, 50, 113, 50, 50),
(131, 51, 92, 10, 10),
(132, 51, 91, 11, 11),
(133, 51, 90, 12, 12),
(134, 52, 92, 5, 10),
(135, 52, 91, 6, 90),
(136, 53, 152, 8, 0),
(137, 53, 151, 6, 0),
(138, 53, 150, 2, 6),
(139, 53, 149, 0, 10),
(140, 53, 112, 0, 8),
(141, 53, 111, 6, 0),
(142, 53, 110, 11, 0),
(143, 53, 109, 8, 0),
(144, 53, 108, 8, 0),
(145, 53, 107, 10, 0),
(146, 53, 106, 2, 4),
(147, 53, 105, 8, 0),
(148, 53, 104, 6, 0),
(149, 53, 103, 5, 1),
(150, 53, 102, 8, 0),
(151, 53, 101, 4, 4),
(152, 53, 100, 8, 0),
(153, 53, 99, 6, 0),
(154, 53, 98, 6, 0),
(155, 53, 97, 8, 0),
(156, 53, 96, 10, 0),
(157, 53, 95, 6, 0),
(158, 53, 94, 10, 0),
(159, 53, 47, 6, 0),
(160, 53, 46, 11, 0),
(161, 53, 45, 9, 0),
(162, 53, 44, 8, 0),
(163, 53, 43, 0, 8),
(164, 53, 42, 0, 6),
(165, 53, 41, 6, 0),
(166, 53, 40, 7, 0),
(167, 53, 39, 6, 0),
(168, 53, 38, 6, 0),
(169, 53, 37, 3, 5),
(170, 53, 36, 0, 8),
(171, 53, 35, 10, 0),
(172, 53, 34, 9, 0),
(173, 53, 33, 7, 0),
(174, 53, 32, 0, 8),
(175, 53, 31, 9, 0),
(176, 53, 30, 9, 0),
(177, 53, 29, 12, 0),
(178, 53, 28, 0, 20),
(179, 54, 92, 0, 500),
(180, 54, 91, 0, 500),
(181, 54, 90, 200, 300),
(182, 54, 89, 400, 100),
(183, 54, 88, 340, 160),
(184, 54, 87, 500, 0),
(185, 54, 86, 1000, 0),
(186, 54, 85, 440, 0),
(187, 54, 84, 200, 300),
(188, 54, 83, 0, 500),
(189, 54, 82, 100, 400),
(190, 54, 81, 500, 0),
(191, 54, 80, 0, 500),
(192, 54, 79, 0, 500),
(193, 54, 78, 500, 0),
(194, 54, 77, 500, 0),
(195, 54, 76, 0, 500),
(196, 54, 75, 300, 200),
(197, 54, 74, 500, 0),
(198, 54, 73, 300, 0),
(199, 54, 72, 0, 700),
(200, 54, 71, 0, 500),
(201, 54, 70, 330, 170),
(202, 54, 69, 390, 110),
(203, 54, 68, 0, 500),
(204, 54, 67, 500, 0),
(205, 54, 66, 500, 0),
(206, 54, 65, 290, 210),
(207, 54, 64, 0, 500),
(208, 54, 63, 0, 500),
(209, 54, 62, 500, 0),
(210, 54, 61, 260, 240),
(211, 54, 60, 370, 130),
(212, 54, 59, 400, 100),
(213, 54, 58, 0, 500),
(214, 54, 57, 0, 500),
(215, 54, 56, 500, 0),
(216, 54, 55, 0, 500),
(217, 54, 54, 0, 500),
(218, 54, 53, 290, 210),
(219, 54, 52, 350, 150),
(220, 54, 51, 0, 500),
(221, 54, 50, 350, 150),
(222, 54, 49, 0, 30),
(223, 55, 152, 5, 0),
(224, 55, 151, 0, 5),
(225, 55, 150, 10, 0),
(226, 55, 149, 1, 1),
(227, 55, 112, 10, 0),
(228, 55, 111, 10, 0),
(229, 55, 110, 0, 10),
(230, 55, 109, 0, 7),
(231, 55, 108, 5, 0),
(232, 55, 107, 0, 13),
(233, 55, 106, 5, 0),
(234, 55, 105, 0, 10),
(235, 55, 104, 0, 5),
(236, 55, 103, 0, 10),
(237, 55, 102, 5, 0),
(238, 55, 101, 5, 0),
(239, 55, 100, 0, 8),
(240, 55, 99, 0, 7),
(241, 55, 98, 0, 8),
(242, 55, 97, 0, 6),
(243, 55, 96, 0, 7),
(244, 55, 95, 0, 5),
(245, 55, 94, 0, 5),
(246, 55, 47, 10, 0),
(247, 55, 46, 0, 10),
(248, 55, 45, 0, 10),
(249, 55, 44, 10, 0),
(250, 55, 43, 10, 0),
(251, 55, 42, 10, 0),
(252, 55, 41, 0, 0),
(253, 55, 40, 5, 5),
(254, 55, 39, 10, 0),
(255, 55, 38, 0, 10),
(256, 55, 37, 10, 0),
(257, 55, 36, 10, 0),
(258, 55, 35, 0, 10),
(259, 55, 34, 0, 10),
(260, 55, 33, 0, 10),
(261, 55, 32, 10, 0),
(262, 55, 31, 0, 10),
(263, 55, 30, 0, 10),
(264, 55, 29, 10, 0),
(265, 55, 28, 1, 1),
(266, 56, 118, 50, 0),
(267, 56, 117, 0, 30),
(268, 56, 116, 20, 30),
(269, 56, 115, 50, 0),
(270, 56, 114, 30, 0),
(271, 56, 113, 150, 0),
(272, 57, 125, 0, 50),
(273, 57, 124, 0, 50),
(274, 57, 121, 20, 0),
(275, 57, 120, 20, 0),
(276, 57, 119, 0, 15),
(277, 58, 148, 0, 21),
(278, 58, 147, 0, 16),
(279, 58, 146, 0, 12),
(280, 58, 145, 0, 20),
(281, 58, 144, 0, 12),
(282, 58, 143, 5, 5),
(283, 58, 142, 10, 0),
(284, 58, 141, 10, 0),
(285, 58, 140, 10, 0),
(286, 58, 139, 10, 0),
(287, 58, 138, 10, 0),
(288, 58, 137, 10, 0),
(289, 58, 136, 10, 0),
(290, 58, 135, 0, 100),
(291, 58, 134, 0, 90),
(292, 58, 133, 10, 0),
(293, 58, 132, 10, 0),
(294, 58, 131, 10, 0),
(295, 58, 130, 10, 0),
(296, 58, 129, 10, 0),
(297, 58, 128, 0, 0),
(298, 58, 127, 20, 0),
(299, 58, 126, 20, 0),
(300, 59, 125, 60, 0),
(301, 59, 124, 100, 0),
(302, 59, 121, 0, 15),
(303, 59, 120, 0, 15),
(304, 59, 119, 15, 0),
(305, 60, 125, 0, 60),
(306, 60, 124, 0, 100),
(307, 60, 121, 15, 0),
(308, 60, 120, 15, 0),
(309, 60, 119, 0, 15),
(310, 61, 148, 2, 10),
(311, 61, 147, 6, 6),
(312, 61, 146, 12, 0),
(313, 61, 145, 9, 3),
(314, 61, 144, 14, 0),
(315, 61, 143, 0, 5),
(316, 61, 142, 0, 5),
(317, 61, 141, 0, 5),
(318, 61, 140, 0, 5),
(319, 61, 139, 0, 5),
(320, 61, 138, 1, 4),
(321, 61, 137, 4, 2),
(322, 61, 136, 0, 5),
(323, 61, 135, 0, 1),
(324, 61, 134, 0, 1),
(325, 61, 133, 0, 5),
(326, 61, 132, 2, 4),
(327, 61, 131, 0, 5),
(328, 61, 130, 0, 5),
(329, 61, 129, 0, 5),
(330, 61, 128, 0, 0),
(331, 61, 127, 6, 10),
(332, 61, 126, 0, 5),
(333, 62, 152, 0, 5),
(334, 62, 151, 0, 5),
(335, 62, 150, 0, 10),
(336, 62, 149, 1, 1),
(337, 62, 112, 0, 10),
(338, 62, 111, 0, 10),
(339, 62, 110, 10, 0),
(340, 62, 109, 10, 0),
(341, 62, 108, 0, 5),
(342, 62, 107, 10, 0),
(343, 62, 106, 0, 5),
(344, 62, 105, 10, 0),
(345, 62, 104, 5, 0),
(346, 62, 103, 10, 0),
(347, 62, 102, 0, 5),
(348, 62, 101, 0, 5),
(349, 62, 100, 8, 0),
(350, 62, 99, 10, 0),
(351, 62, 98, 8, 0),
(352, 62, 97, 6, 0),
(353, 62, 96, 7, 0),
(354, 62, 95, 5, 0),
(355, 62, 94, 0, 5),
(356, 62, 47, 0, 10),
(357, 62, 46, 10, 0),
(358, 62, 45, 10, 0),
(359, 62, 44, 0, 10),
(360, 62, 43, 0, 10),
(361, 62, 42, 0, 10),
(362, 62, 40, 8, 0),
(363, 62, 39, 0, 10),
(364, 62, 38, 10, 0),
(365, 62, 37, 0, 10),
(366, 62, 36, 0, 10),
(367, 62, 35, 10, 0),
(368, 62, 34, 10, 0),
(369, 62, 33, 10, 0),
(370, 62, 32, 0, 10),
(371, 62, 31, 11, 0),
(372, 62, 30, 10, 0),
(373, 62, 29, 0, 10),
(374, 62, 28, 1, 1),
(375, 63, 148, 15, 0),
(376, 63, 147, 15, 0),
(377, 63, 146, 15, 0),
(378, 63, 145, 15, 0),
(379, 63, 144, 15, 0),
(380, 63, 143, 0, 5),
(381, 63, 142, 0, 10),
(382, 63, 141, 0, 10),
(383, 63, 140, 0, 10),
(384, 63, 139, 0, 10),
(385, 63, 138, 0, 10),
(386, 63, 137, 0, 10),
(387, 63, 136, 0, 10),
(388, 63, 135, 100, 0),
(389, 63, 134, 100, 0),
(390, 63, 133, 0, 10),
(391, 63, 132, 0, 10),
(392, 63, 131, 0, 10),
(393, 63, 130, 0, 10),
(394, 63, 129, 0, 10),
(395, 63, 128, 0, 0),
(396, 63, 127, 0, 20),
(397, 63, 126, 0, 20),
(398, 64, 118, 0, 2),
(399, 64, 117, 0, 1),
(400, 64, 116, 30, 20),
(401, 64, 115, 10, 40),
(402, 64, 114, 20, 30),
(403, 64, 113, 0, 100),
(404, 65, 92, 0, 1),
(405, 65, 91, 0, 1),
(406, 65, 90, 1, 0),
(407, 65, 89, 300, 200),
(408, 65, 88, 1, 0),
(409, 65, 87, 200, 300),
(410, 65, 86, 1, 0),
(411, 65, 85, 0, 1),
(412, 65, 84, 0, 1),
(413, 65, 83, 0, 1),
(414, 65, 82, 0, 2),
(415, 65, 81, 0, 1),
(416, 65, 80, 0, 1),
(417, 65, 79, 0, 0),
(418, 65, 78, 1, 0),
(419, 65, 77, 1, 0),
(420, 65, 76, 0, 0),
(421, 65, 75, 0, 1),
(422, 65, 74, 0, 0),
(423, 65, 73, 300, 200),
(424, 65, 72, 0, 2),
(425, 65, 71, 0, 1),
(426, 65, 70, 0, 1),
(427, 65, 69, 1, 0),
(428, 65, 68, 0, 1),
(429, 65, 67, 1, 0),
(430, 65, 66, 1, 0),
(431, 65, 65, 0, 1),
(432, 65, 64, 0, 1),
(433, 65, 63, 0, 1),
(434, 65, 62, 0, 1),
(435, 65, 61, 1, 0),
(436, 65, 60, 1, 0),
(437, 65, 59, 1, 0),
(438, 65, 58, 0, 1),
(439, 65, 57, 0, 1),
(440, 65, 56, 1, 0),
(441, 65, 55, 1, 0),
(442, 65, 54, 0, 2),
(443, 65, 53, 0, 1),
(444, 65, 52, 1, 0),
(445, 65, 51, 0, 1),
(446, 65, 50, 1, 0),
(447, 65, 49, 1, 1),
(448, 66, 152, 10, 5),
(449, 66, 151, 5, 2),
(450, 67, 92, 0, 0),
(451, 67, 91, 0, 0),
(452, 67, 90, 0, 0),
(453, 67, 89, 0, 0),
(454, 67, 88, 0, 0),
(455, 67, 87, 0, 0),
(456, 67, 86, 0, 0),
(457, 67, 85, 0, 0),
(458, 67, 84, 0, 0),
(459, 67, 83, 0, 0),
(460, 67, 82, 0, 0),
(461, 67, 81, 0, 0),
(462, 67, 80, 0, 0),
(463, 67, 79, 0, 0),
(464, 67, 78, 0, 0),
(465, 67, 77, 0, 0),
(466, 67, 76, 0, 0),
(467, 67, 75, 0, 0),
(468, 67, 74, 0, 0),
(469, 67, 73, 0, 0),
(470, 67, 72, 0, 0),
(471, 67, 71, 0, 0),
(472, 67, 70, 0, 0),
(473, 67, 69, 0, 0),
(474, 67, 68, 0, 0),
(475, 67, 67, 0, 0),
(476, 67, 66, 0, 0),
(477, 67, 65, 0, 0),
(478, 67, 64, 0, 0),
(479, 67, 63, 0, 0),
(480, 67, 62, 0, 0),
(481, 67, 61, 0, 0),
(482, 67, 60, 0, 0),
(483, 67, 59, 0, 0),
(484, 67, 58, 0, 0),
(485, 67, 57, 0, 0),
(486, 67, 56, 0, 0),
(487, 67, 55, 0, 0),
(488, 67, 54, 0, 0),
(489, 67, 53, 0, 0),
(490, 67, 52, 0, 0),
(491, 67, 51, 205, 0),
(492, 67, 50, 0, 0),
(493, 68, 118, 0, 0),
(494, 69, 118, 4, 15),
(495, 69, 117, 4, 12),
(496, 69, 116, 5, 11),
(497, 70, 148, 1, 1),
(498, 70, 147, 1, 1),
(499, 71, 148, 1, 1),
(500, 71, 147, 1, 1),
(501, 71, 146, 1, 1),
(502, 72, 148, 145, 1545),
(503, 72, 147, 1454, 14545),
(504, 73, 125, 1, 1),
(505, 73, 124, 1, 1),
(506, 73, 121, 1, 1),
(507, 73, 120, 1, 1),
(508, 74, 148, 1, 1),
(509, 74, 147, 1, 1),
(510, 74, 146, 1, 1),
(511, 75, 148, 1, 1),
(512, 75, 147, 1, 1),
(513, 75, 146, 1, 1),
(514, 76, 125, 1, 1),
(515, 76, 124, 1, 1),
(516, 77, 118, 1, 1),
(517, 77, 117, 1, 1),
(518, 78, 125, 1, 1),
(519, 78, 124, 1, 1),
(520, 79, 148, 1, 1),
(521, 79, 147, 1, 1),
(522, 80, 148, 1, 1),
(523, 80, 147, 1, 1),
(524, 81, 125, 1, 1),
(525, 81, 124, 1, 1),
(526, 81, 121, 1, 1),
(527, 82, 125, 1, 1),
(528, 82, 124, 1, 1),
(529, 82, 121, 1, 1),
(530, 83, 148, 1, 1),
(531, 83, 147, 1, 1),
(532, 83, 146, 1, 1),
(533, 83, 145, 1, 1),
(534, 84, 148, 1, 1),
(535, 84, 147, 1, 1),
(536, 84, 146, 1, 1),
(537, 85, 148, 1, 1),
(538, 85, 147, 1, 1),
(539, 85, 146, 1, 1),
(540, 85, 145, 1, 1),
(541, 86, 148, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `productImage` text DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `productImage`, `category_id`, `status`) VALUES
(28, ' Samples', 'uploads/Spray-bottles-1-1024x1024.jpg', 25, 1),
(29, 'Empire Parfum 15ML', 'uploads/Empire-Ammars-Fragnances-2-1024x1024.jpg', 25, 1),
(30, 'Extraordinary 15ML', 'uploads/Extraordinary-Ammars-Fragnances-2-1-1024x1024.jpg', 25, 1),
(31, 'Glorious Oud 15ML', 'uploads/Glorious-Oud-Ammars-Fragnances-2-1024x1024.jpg', 25, 1),
(32, 'Integrity Parfum 15ML', 'uploads/Integrity-Ammars-Fragnances-2-1024x1024.jpg', 25, 1),
(33, 'Just Oud 15ML', 'uploads/Just-Oud-Ammars-Fragnances-2-1024x1024.jpg', 25, 1),
(34, 'Leather Blend 15ML', 'uploads/Leather-Blend-Ammars-Fragnances-2-1024x1024.jpg', 25, 1),
(35, 'Loyalty Parfum 15ML', 'uploads/Loyalty-Ammars-Fragnances-2-1024x1024.jpg', 25, 1),
(36, 'Musk Amar 15ML', 'uploads/Musk-Amar-Ammars-Fragnances-2-1024x1024.jpg', 25, 1),
(37, 'Pleasant Parfum 15ML', 'uploads/Pleasant-Ammars-Fragnances-2-1024x1024.jpg', 25, 1),
(38, 'Prestige 15ML', 'uploads/Prestige-Ammars-Fragnances-2-1024x1024.jpg', 25, 1),
(39, 'Queen 15ML', 'uploads/Queen-Ammars-Fragnances-2-1024x1024.jpg', 25, 1),
(40, 'Royal Paradise 15ML', 'uploads/Royal-Paradise-Ammars-Fragnances-2-1024x1024.jpg', 25, 1),
(41, 'Smokeless', 'uploads/Smokeless-with-box-1-1024x1024.jpg', 25, 1),
(42, 'Soft Oud 15ML', 'uploads/Soft-Oud-Ammars-Fragnances-2-1024x1024.jpg', 25, 1),
(43, 'Sweet Dazz 15ML', 'uploads/Sweet-Dazz-Ammars-Fragnances-2-1024x1024.jpg', 25, 1),
(44, 'Throne Parfum 15ML', 'uploads/Throne-Ammars-Fragnances-2-1024x1024.jpg', 25, 1),
(45, 'Velvet Oud 15ML', 'uploads/Velvet-Oud-Ammars-Fragnances-2-1024x1024.jpg', 25, 1),
(46, 'Vibrant Oud Parfum 15ML', 'uploads/Vibrant-Oud-Ammars-Fragnances-2-1024x1024.jpg', 25, 1),
(47, 'VIP Musk 15ML', 'uploads/VIP-Musk-Ammars-Fragnances-2-1024x1024.jpg', 25, 1),
(48, 'White Crystal Parfum 15ML', 'uploads/White-Crystal-Ammars-Fragnances-2-1024x1024.jpg', 25, 2),
(49, '5 Perfume Oil Samples â€“ Pick and Mix', 'uploads/Oil-samples-5-pack-1024x1024.jpg', 26, 1),
(50, 'Amber Nuit Perfume Oil', 'uploads/Ammars-Fragrances-Oil-bottle-Black-8ML-1024x1024.jpg', 26, 1),
(51, 'Billionaire Perfume Oil', 'uploads/Ammars-products-6-PALE-1024x1024.jpg', 26, 1),
(52, 'Black Musk Perfume Oil', 'uploads/Ammars-Fragrances-Oil-bottle-Black-8ML-1024x1024 (1).jpg', 26, 1),
(53, 'Cherish Perfume Oil', 'uploads/Ammars-products-8-YELLOW-1024x1024.jpg', 26, 1),
(54, 'Classy Perfume Oil', 'uploads/Ammars-Fragrances-Oil-clear-1-1024x1024.jpg', 26, 1),
(55, 'Divine Perfume Oil', 'uploads/Ammars-products-8-YELLOW-1024x1024.jpg', 26, 1),
(56, 'Egyptian Musk Perfume Oil', 'uploads/Ammars-products-6-PALE-1024x1024.jpg', 26, 1),
(57, 'Empire Perfume Oil', 'uploads/Ammars-products-6-PALE-1024x1024.jpg', 26, 1),
(58, 'Extraordinary Perfume Oil', 'uploads/Ammars-Fragrances-Oil-clear-1-1024x1024.jpg', 26, 1),
(59, 'Gardenia Perfume Oil', 'uploads/Ammars-products-6-PALE-1024x1024 (1).jpg', 26, 1),
(60, 'Glorious Oud Perfume Oil', 'uploads/Ammars-products-8-YELLOW-1024x1024.jpg', 26, 1),
(61, 'Gold Aoud Perfume Oil', 'uploads/Ammars-products-6-PALE-1024x1024.jpg', 26, 1),
(62, 'Heavenly Fine Oil', 'uploads/Ammars-products-8-YELLOW-1024x1024.jpg', 26, 1),
(63, 'Integrity Perfume Oil', 'uploads/Ammars-products-8-YELLOW-1024x1024 (1).jpg', 26, 1),
(64, 'Invention Perfume Oil', 'uploads/Ammars-products-6-PALE-1024x1024 (1).jpg', 26, 1),
(65, 'Just Oud Fine Oil', 'uploads/Ammars-Fragrances-Oil-gold-1024x1024.jpg', 26, 1),
(66, 'Leather Blend Perfume Oil', 'uploads/Ammars-products-6-PALE-1024x1024 (2).jpg', 26, 1),
(67, 'Loyalty Perfume Oil', 'uploads/Ammars-Fragrances-Oil-clear-1-1024x1024.jpg', 26, 1),
(68, 'Musk Amar Fine Oil', 'uploads/Ammars-Fragrances-Oil-clear-1-1024x1024 (1).jpg', 26, 1),
(69, 'Night Oud Perfume Oil', 'uploads/Ammars-Fragrances-Oil-clear-1-1024x1024.jpg', 26, 1),
(70, 'Ocean Blue Perfume Oil', 'uploads/Ammars-products-6-PALE-1024x1024.jpg', 26, 1),
(71, 'Pink Amber', 'uploads/Ammars-Fragrances-Oil-yellow-1024x1024.jpg', 26, 1),
(72, 'Pleasant Perfume Oil', 'uploads/Ammars-products-6-PALE-1024x1024 (1).jpg', 26, 1),
(73, 'Prestige Perfume Oil', 'uploads/Ammars-products-8-YELLOW-1024x1024.jpg', 26, 1),
(74, 'Queen Perfume Oil', 'uploads/Ammars-Fragrances-Oil-clear-1-1024x1024.jpg', 26, 1),
(75, 'Radiance Perfume Oil', 'uploads/Ammars-Fragrances-Oil-clear-1-1024x1024 (1).jpg', 26, 1),
(76, 'Red Blossom', 'uploads/Ammars-products-8-YELLOW-1024x1024 (1).jpg', 26, 1),
(77, 'Rose Aoud Perfume Oil', 'uploads/Ammars-Fragrances-Oil-clear-1-1024x1024.jpg', 26, 1),
(78, 'Royal Paradise Perfume Oil', 'uploads/Ammars-Fragrances-Oil-gold-1024x1024.jpg', 26, 1),
(79, 'Smokeless Perfume Oil', 'uploads/Ammars-Fragrances-Oil-gold-1024x1024 (1).jpg', 26, 1),
(80, 'Soft Oud Perfume Oil', 'uploads/Ammars-products-8-YELLOW-1024x1024.jpg', 26, 1),
(81, 'Spice Nuit Perfume Oil', 'uploads/Ammars-products-6-PALE-1024x1024.jpg', 26, 1),
(82, 'Sweet Dazz Perfume Oil', 'uploads/Ammars-products-8-YELLOW-1024x1024.jpg', 26, 1),
(83, 'Sweet Fleur Perfume Oil', 'uploads/Ammars-Fragrances-Oil-clear-1-1024x1024.jpg', 26, 1),
(84, 'Temptation Perfume Oil', 'uploads/Ammars-products-8-YELLOW-1024x1024 (1).jpg', 26, 1),
(85, 'Throne Perfume Oil', 'uploads/Ammars-products-6-PALE-1024x1024.jpg', 26, 1),
(86, 'Tobacco Oud Perfume Oil', 'uploads/Ammars-Fragrances-Oil-bottle-Black-8ML-1024x1024.jpg', 26, 1),
(87, 'Treasure', 'uploads/Ammars-products-3-PALE-1024x1024.jpg', 26, 1),
(88, 'Velvet Oud Perfume Oil', 'uploads/Ammars-Fragrances-Oil-gold-1024x1024.jpg', 26, 1),
(89, 'Vibrant Oud Perfume Oil', 'uploads/Ammars-Fragrances-Oil-gold-1024x1024 (1).jpg', 26, 1),
(90, 'VIP Musk Perfume Oil', 'uploads/Ammars-Fragrances-Oil-clear-1-1024x1024.jpg', 26, 1),
(91, 'White Crystal Perfume Oil', 'uploads/Ammars-products-6-PALE-1024x1024.jpg', 26, 1),
(92, 'White Musk Perfume Oil', 'uploads/Ammars-Fragrances-Oil-white-1024x1024.jpg', 26, 1),
(93, 'White Musk Perfume Oil', 'uploads/Ammars-Fragrances-Oil-white-1024x1024.jpg', 26, 2),
(94, 'Empire Parfum 50ML', 'uploads/Empire-Ammars-Fragnances-2-1024x1024.jpg', 25, 1),
(95, 'Extraordinary 50ML', 'uploads/Extraordinary-Ammars-Fragnances-2-1-1024x1024.jpg', 25, 1),
(96, 'Glorious Oud 50ML', 'uploads/Glorious-Oud-Ammars-Fragnances-2-1024x1024.jpg', 25, 1),
(97, 'Integrity Parfum 50ML', 'uploads/Integrity-Ammars-Fragnances-2-1024x1024.jpg', 25, 1),
(98, 'Just Oud 50ML', 'uploads/Just-Oud-Ammars-Fragnances-2-1024x1024.jpg', 25, 1),
(99, 'Leather Blend 50ML', 'uploads/Leather-Blend-Ammars-Fragnances-2-1024x1024.jpg', 25, 1),
(100, 'Loyalty Parfum 50ML', 'uploads/Loyalty-Ammars-Fragnances-2-1024x1024.jpg', 25, 1),
(101, 'Musk Amar 50ML', 'uploads/Musk-Amar-Ammars-Fragnances-2-1024x1024.jpg', 25, 1),
(102, 'Pleasant Parfum 50ML', 'uploads/Pleasant-Ammars-Fragnances-2-1024x1024.jpg', 25, 1),
(103, 'Prestige 50ML', 'uploads/Prestige-Ammars-Fragnances-2-1024x1024.jpg', 25, 1),
(104, 'Queen 50ML', 'uploads/Queen-Ammars-Fragnances-2-1024x1024.jpg', 25, 1),
(105, 'Royal Paradise 50ML', 'uploads/Royal-Paradise-Ammars-Fragnances-2-1024x1024.jpg', 25, 1),
(106, 'Soft Oud 50ML', 'uploads/Soft-Oud-Ammars-Fragnances-2-1024x1024.jpg', 25, 1),
(107, 'Sweet Dazz 50ML', 'uploads/Sweet-Dazz-Ammars-Fragnances-2-1024x1024.jpg', 25, 1),
(108, 'Throne Parfum 50ML', 'uploads/Throne-Ammars-Fragnances-2-1024x1024.jpg', 25, 1),
(109, 'Velvet Oud 50ML', 'uploads/Velvet-Oud-Ammars-Fragnances-2-1024x1024.jpg', 25, 1),
(110, 'Vibrant Oud Parfum 15ML', 'uploads/Vibrant-Oud-Ammars-Fragnances-2-1024x1024.jpg', 25, 1),
(111, 'VIP Musk 15ML', 'uploads/VIP-Musk-Ammars-Fragnances-2-1024x1024.jpg', 25, 1),
(112, 'White Crystal Parfum 15ML', 'uploads/64e75de65a8ef_White Crystal - Ammars Fragnances-2.jpg', 25, 1),
(113, '8ML PERFUME OIL BOTTLE', 'uploads/64eb8a5ebe743_Screenshot 2023-08-27 183917.png', 27, 1),
(114, '20ML PERFUME OIL BOTTLE', 'uploads/64e74e13edbc4_WhatsApp Image 2023-08-24 at 1.31.42 PM (2).jpeg', 27, 1),
(115, '30ML PERFUME OIL BOTTLE', 'uploads/64e74e247d616_WhatsApp Image 2023-08-24 at 1.31.43 PM.jpeg', 27, 1),
(116, '50ML PERFUME OIL BOTTLE', 'uploads/64e74e319dc53_WhatsApp Image 2023-08-24 at 1.31.43 PM (1).jpeg', 27, 1),
(117, 'SAMPLE OIL BOTTLES ', 'uploads/64eb89dfd510f_Screenshot 2023-08-27 183540.png', 27, 1),
(118, 'SAMPLE SPRAY BOTTLES ', 'uploads/64eb8a1441c95_Screenshot 2023-08-27 183801.png', 27, 1),
(119, 'SMALL GIFT BAGS ', 'uploads/64e74cc158afa_WhatsApp Image 2023-08-24 at 1.26.16 PM.jpeg', 28, 1),
(120, 'MEDIUM GIFT BAGS ', 'uploads/64e74cab560d0_WhatsApp Image 2023-08-24 at 1.26.15 PM.jpeg', 28, 1),
(121, 'LARGE GIFT BAGS', 'uploads/64e74c993d353_WhatsApp Image 2023-08-24 at 1.26.16 PM (1).jpeg', 28, 1),
(122, 'WHITE PLASTIC BAGS (SMALL)', 'uploads/12004960_10156065247155710_6806211511889082921_n-2.jpg', 28, 2),
(123, 'WHITE PLASTIC BAGS (BIG)', 'uploads/12004960_10156065247155710_6806211511889082921_n-2.jpg', 28, 2),
(124, 'SMALL POUCHES ', 'uploads/64e74b8da4297_WhatsApp Image 2023-08-24 at 1.21.09 PM (1).jpeg', 28, 1),
(125, 'LARGE POUCHES ', 'uploads/64e74b8356d0b_WhatsApp Image 2023-08-24 at 1.21.09 PM.jpeg', 28, 1),
(126, 'TILL ROLL ', 'uploads/paperroll.webp', 29, 1),
(127, 'PRINTER ROLL', 'uploads/377388749-600x450.jpeg', 29, 1),
(128, 'EXTRA BOTTLE LIDS ', 'uploads/64e74b59828e7_WhatsApp Image 2023-08-24 at 1.21.10 PM.jpeg', 29, 1),
(129, 'EXTRAORDINARY STRIPS', 'uploads/64e74aebb7cc7_WhatsApp Image 2023-08-24 at 1.15.27 PM.jpeg', 29, 1),
(130, 'SWEET DAZZ STRIPS ', 'uploads/64e74aa45d210_WhatsApp Image 2023-08-24 at 12.55.25 PM (2).jpeg', 29, 1),
(131, 'PLEASANT STRIPS ', 'uploads/64e74ab291e28_WhatsApp Image 2023-08-24 at 12.55.26 PM (2).jpeg', 29, 1),
(132, 'UNPRINTED STRIPS ', 'uploads/64e74b032abef_WhatsApp Image 2023-08-24 at 1.15.27 PM.jpeg', 29, 1),
(133, 'CHARCOAL ', 'uploads/activatedcharcoalmain-1000-1518566610.jpg', 29, 1),
(134, '8ml ROLLERS', 'uploads/64e74a742e8f8_WhatsApp Image 2023-08-24 at 1.17.14 PM.jpeg', 29, 1),
(135, '8ml Caps', 'uploads/64e74a681c1e8_WhatsApp Image 2023-08-24 at 1.17.15 PM.jpeg', 29, 1),
(136, 'EMPIRE STRIPS ', 'uploads/64e749ef24c16_WhatsApp Image 2023-08-24 at 1.15.27 PM.jpeg', 29, 1),
(137, 'WHITE CRISTAL STRIPS', 'uploads/64e74928453f9_WhatsApp Image 2023-08-24 at 12.55.27 PM.jpeg', 29, 1),
(138, 'MUSK AMAR STRIPS', 'uploads/64e749856d585_WhatsApp Image 2023-08-24 at 1.13.30 PM.jpeg', 29, 1),
(139, 'OCEAN BLUE STRIPS', 'uploads/64e748f132f6d_WhatsApp Image 2023-08-24 at 12.55.25 PM.jpeg', 29, 1),
(140, 'CLASSY STRIPS', 'uploads/64e74683aba22_WhatsApp Image 2023-08-24 at 12.55.24 PM.jpeg', 29, 1),
(141, 'INTEGRITY STRIPS', 'uploads/64e7466a46e72_WhatsApp Image 2023-08-24 at 12.55.26 PM.jpeg', 29, 1),
(142, 'SWEET FLEUR STRIPS', 'uploads/64e749fd0b3fb_WhatsApp Image 2023-08-24 at 1.15.27 PM.jpeg', 29, 1),
(143, 'GIFT PAPER', 'uploads/64e74615b0c50_WhatsApp Image 2023-08-24 at 12.52.59 PM (1).jpeg', 29, 1),
(144, 'SWEET DAZZ FRAGRANCE MIST', 'uploads/64e74609812fe_WhatsApp Image 2023-08-24 at 12.52.57 PM (1).jpeg', 29, 1),
(145, 'PLEASANT FRAGRANCE MIST', 'uploads/64e745fbda553_WhatsApp Image 2023-08-24 at 12.52.59 PM.jpeg', 29, 1),
(146, 'THRONE FRAGRANCE MIST', 'uploads/64e745ee3bf37_WhatsApp Image 2023-08-24 at 12.52.58 PM (1).jpeg', 29, 1),
(147, 'WHITE CRYSTAL FRAGRANCE MIST', 'uploads/64e745d040e26_WhatsApp Image 2023-08-24 at 12.52.57 PM.jpeg', 29, 1),
(148, 'CLASSY FRAGRANCE MIST', 'uploads/64e745c05ffdf_WhatsApp Image 2023-08-24 at 12.52.58 PM.jpeg', 29, 1),
(149, '5 Parfum Samples â€“ Pick and Mix', 'uploads/64e5a1208fa59_Spray-bottles-1-1024x1024.jpg', 25, 1),
(150, 'SWEET FLEUR 15ML', 'uploads/64e761a377afd_white.jpg', 25, 1),
(151, 'SWEET FLEUR 50ML', 'uploads/64e7617d8d767_white.jpg', 25, 1),
(152, 'WHITE CRYSTAL 50ML', 'uploads/64e75d31c1d74_White Crystal - Ammars Fragnances-1.jpg', 25, 1),
(153, 'CANDY CRUSH 15ML', 'uploads/64e5a52a4333d_White-Crystal-Ammars-Fragnances-2-1024x1024.jpg', 25, 2),
(154, 'CANDY CRUSH 50ML', 'uploads/64e5a5dc44734_White-Crystal-Ammars-Fragnances-2-1024x1024.jpg', 25, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `shop_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'user',
  `creadted_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `password` text NOT NULL,
  `userImage` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `shop_name`, `email`, `role`, `creadted_by`, `created_at`, `password`, `userImage`, `status`) VALUES
(34, 'Admin Ammar', 'Admin Shop', 'admin@techsolutionspro.co.uk', 'admin', 1, '2023-08-16 18:22:14', '$2y$10$.HvEJsnt0YZE4IgGF7oD5es2eHp2xT156iE2EbK3MOZKp59ZKw0Bu', 'uploads/defualt_products.png', 1),
(41, 'Yasir Nadeem', 'Upper Parlament ', 'yasir@ammarsfragrances.com', 'user', 0, '2023-08-21 08:43:44', '$2y$10$W7GUG5pdHPG5UYNobfkCruKtQ2XSePmW9C0cXmUoMTVmiT5qfokRW', 'uploads/Glorius Oud.jpg', 1),
(42, 'Test ', 'Upper Parlament ', 'Yasir@sdas.com', 'user', 0, '2023-08-21 08:48:26', '$2y$10$Fs0s.zetwpG9mi7XjHElnOY4BXUFF7vlMJ8L6o2EdH4d4DAQycdHq', 'uploads/WhatsApp Image 2023-08-09 at 10.54.21.jpeg', 2),
(43, 'Doncaster Ammar\'s', 'Doncaster Shop', 'Doncaster@ammarsfragrances.com', 'user', 0, '2023-08-21 16:26:37', '$2y$10$YADV7d1NuI2mwlXdahEyKOoF739EmV1gkNX7IdHUYI91eSX7ALqjO', 'uploads/favicon.png', 1),
(44, 'Peterborough Ammar\'s', 'Peterbrough Shop', 'Peterbrough@ammarsfragrances.com', 'user', 0, '2023-08-21 16:27:27', '$2y$10$9fVwS75fmyafLeeObCQhHuqPCMeQa11BlRw2RtvSitQwQG8Vj/XBq', 'uploads/favicon.png', 1),
(45, 'York Ammar\'s', 'York Shop', 'York@ammarsfragrances.com', 'user', 0, '2023-08-21 16:28:56', '$2y$10$vg9U9PEu2QH93252T5w6KOwNQlHj.5HsuWtvp0HThfhLOSMKSyPBy', 'uploads/favicon.png', 1),
(46, 'Hull Ammar\'s', 'Hull Shop', 'Hull@ammarsfragrances.com', 'user', 0, '2023-08-21 16:30:09', '$2y$10$pst2GzlLHeED6VRcP.1TDethqXOlpFYBfn2snm1mzvyP3NggrZy4y', 'uploads/favicon.png', 1),
(47, 'Livingston Ammar\'s', 'Livingston Shop', 'Livingston@ammarsfragrances.com', 'user', 0, '2023-08-21 16:31:59', '$2y$10$SlNgiazGVwwX5TG1sNAujOInxYLTqG/Q0R0Q9aoW3f2bA5ADLRl62', 'uploads/favicon.png', 1),
(48, 'Braehead Ammar\'s', 'Braehead Shop', 'Braehead@ammarsfragrances.com', 'user', 0, '2023-08-21 16:34:11', '$2y$10$f3hRYOxFjbPpCN4uak2JtuRKF6CKYaqHTe0..SvhzhBkdc06sGDN2', 'uploads/favicon.png', 1),
(49, 'Blackpool Ammar\'s', 'Blackpool Shop', 'Blackpool@ammarsfragrances.com', 'user', 0, '2023-08-21 16:35:27', '$2y$10$EBxZAdTPgrwCXhuMBX.4u.Dbqx8H.St0Oc9A6xSJsJNrDtSdZQd9m', 'uploads/favicon.png', 1),
(50, 'Developer Account', 'developer Shop', 'user@gmail.com', 'user', 0, '2023-08-31 14:31:08', '$2y$10$DA6Ktkb83d4Ii3ewb6FmDOa5uPs.8MBixtQ7lrwuBDTw.R3x9HZF.', 'uploads/9-512.webp', 1),
(51, 'Developer Admin', 'developer Shop', 'admin@gmail.com', 'admin', 0, '2023-08-31 14:31:08', '$2y$10$DA6Ktkb83d4Ii3ewb6FmDOa5uPs.8MBixtQ7lrwuBDTw.R3x9HZF.', 'uploads/9-512.webp', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=542;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
