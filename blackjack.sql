-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2024 年 12 月 04 日 16:21
-- 伺服器版本： 10.4.28-MariaDB
-- PHP 版本： 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `blackjack`
--

-- --------------------------------------------------------

--
-- 資料表結構 `game_results`
--

CREATE TABLE `game_results` (
  `id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `game_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`game_data`)),
  `chips` decimal(10,2) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `game_results`
--

INSERT INTO `game_results` (`id`, `player_id`, `game_data`, `chips`, `created_at`) VALUES
(1, 1, '{\"player\":{\"cardCount\":3,\"sum\":26,\"cardValues\":[\"J-S\",\"6-C\",\"K-H\"]},\"dealer\":{\"cardCount\":2,\"sum\":9,\"cardValues\":[\"2-D\",\"7-D\"]},\"chips\":400,\"currentBet\":100,\"result\":\"You Lose!\",\"timestamp\":\"2024-12-04T15:13:24.412Z\"}', 400.00, '2024-12-04 23:13:24'),
(2, 1, '{\"player\":{\"cardCount\":2,\"sum\":17,\"cardValues\":[\"7-S\",\"J-D\"]},\"dealer\":{\"cardCount\":2,\"sum\":20,\"cardValues\":[\"K-H\",\"K-S\"]},\"chips\":350,\"currentBet\":50,\"result\":\"You Lose!\",\"timestamp\":\"2024-12-04T15:13:31.098Z\"}', 350.00, '2024-12-04 23:13:31'),
(3, 1, '{\"player\":{\"cardCount\":4,\"sum\":23,\"cardValues\":[\"2-D\",\"2-C\",\"9-C\",\"Q-S\"]},\"dealer\":{\"cardCount\":2,\"sum\":17,\"cardValues\":[\"7-H\",\"J-S\"]},\"chips\":340,\"currentBet\":10,\"result\":\"You Lose!\",\"timestamp\":\"2024-12-04T15:13:36.332Z\"}', 340.00, '2024-12-04 23:13:36'),
(4, 1, '{\"player\":{\"cardCount\":4,\"sum\":18,\"cardValues\":[\"2-C\",\"2-S\",\"A-H\",\"3-S\"]},\"dealer\":{\"cardCount\":3,\"sum\":20,\"cardValues\":[\"K-D\",\"3-C\",\"7-D\"]},\"chips\":275,\"currentBet\":65,\"result\":\"You Lose!\",\"timestamp\":\"2024-12-04T15:13:47.820Z\"}', 275.00, '2024-12-04 23:13:47'),
(5, 1, '{\"player\":{\"cardCount\":3,\"sum\":24,\"cardValues\":[\"5-C\",\"9-H\",\"K-C\"]},\"dealer\":{\"cardCount\":2,\"sum\":21,\"cardValues\":[\"J-S\",\"A-C\"]},\"chips\":245,\"currentBet\":30,\"result\":\"You Lose!\",\"timestamp\":\"2024-12-04T15:13:52.845Z\"}', 245.00, '2024-12-04 23:13:52'),
(6, 1, '{\"player\":{\"cardCount\":3,\"sum\":26,\"cardValues\":[\"6-S\",\"J-S\",\"10-S\"]},\"dealer\":{\"cardCount\":2,\"sum\":16,\"cardValues\":[\"Q-D\",\"6-H\"]},\"chips\":195,\"currentBet\":50,\"result\":\"You Lose!\",\"timestamp\":\"2024-12-04T15:14:01.394Z\"}', 195.00, '2024-12-04 23:14:01'),
(7, 1, '{\"player\":{\"cardCount\":2,\"sum\":18,\"cardValues\":[\"Q-H\",\"8-S\"]},\"dealer\":{\"cardCount\":2,\"sum\":20,\"cardValues\":[\"A-D\",\"9-S\"]},\"chips\":175,\"currentBet\":20,\"result\":\"You Lose!\",\"timestamp\":\"2024-12-04T15:14:06.847Z\"}', 175.00, '2024-12-04 23:14:06'),
(8, 1, '{\"player\":{\"cardCount\":2,\"sum\":19,\"cardValues\":[\"9-H\",\"J-S\"]},\"dealer\":{\"cardCount\":2,\"sum\":21,\"cardValues\":[\"K-C\",\"A-D\"]},\"chips\":75,\"currentBet\":100,\"result\":\"You Lose!\",\"timestamp\":\"2024-12-04T15:14:13.380Z\"}', 75.00, '2024-12-04 23:14:13'),
(9, 1, '{\"player\":{\"cardCount\":4,\"sum\":20,\"cardValues\":[\"2-H\",\"2-S\",\"A-C\",\"5-H\"]},\"dealer\":{\"cardCount\":2,\"sum\":20,\"cardValues\":[\"K-S\",\"J-D\"]},\"chips\":55,\"currentBet\":20,\"result\":\"Tie!\",\"timestamp\":\"2024-12-04T15:14:23.880Z\"}', 75.00, '2024-12-04 23:14:23'),
(10, 1, '{\"player\":{\"cardCount\":4,\"sum\":22,\"cardValues\":[\"9-H\",\"2-S\",\"A-H\",\"J-C\"]},\"dealer\":{\"cardCount\":2,\"sum\":13,\"cardValues\":[\"3-S\",\"Q-C\"]},\"chips\":25,\"currentBet\":50,\"result\":\"You Lose!\",\"timestamp\":\"2024-12-04T15:14:36.030Z\"}', 25.00, '2024-12-04 23:14:36'),
(11, 1, '{\"player\":{\"cardCount\":3,\"sum\":16,\"cardValues\":[\"5-S\",\"Q-C\",\"A-C\"]},\"dealer\":{\"cardCount\":3,\"sum\":18,\"cardValues\":[\"5-C\",\"A-H\",\"2-D\"]},\"chips\":15,\"currentBet\":10,\"result\":\"You Lose!\",\"timestamp\":\"2024-12-04T15:14:45.714Z\"}', 15.00, '2024-12-04 23:14:45'),
(12, 1, '{\"player\":{\"cardCount\":2,\"sum\":17,\"cardValues\":[\"9-D\",\"8-D\"]},\"dealer\":{\"cardCount\":3,\"sum\":23,\"cardValues\":[\"5-D\",\"8-S\",\"K-S\"]},\"chips\":5,\"currentBet\":10,\"result\":\"You Win!\",\"timestamp\":\"2024-12-04T15:14:52.981Z\"}', 25.00, '2024-12-04 23:14:52'),
(13, 1, '{\"player\":{\"cardCount\":4,\"sum\":24,\"cardValues\":[\"3-S\",\"6-H\",\"5-D\",\"10-S\"]},\"dealer\":{\"cardCount\":2,\"sum\":12,\"cardValues\":[\"Q-H\",\"2-C\"]},\"chips\":15,\"currentBet\":10,\"result\":\"You Lose!\",\"timestamp\":\"2024-12-04T15:15:00.213Z\"}', 15.00, '2024-12-04 23:15:00'),
(14, 1, '{\"player\":{\"cardCount\":3,\"sum\":26,\"cardValues\":[\"6-S\",\"Q-S\",\"K-S\"]},\"dealer\":{\"cardCount\":2,\"sum\":20,\"cardValues\":[\"9-S\",\"A-C\"]},\"chips\":5,\"currentBet\":10,\"result\":\"You Lose!\",\"timestamp\":\"2024-12-04T15:15:10.234Z\"}', 5.00, '2024-12-04 23:15:10'),
(15, 1, '{\"player\":{\"cardCount\":2,\"sum\":20,\"cardValues\":[\"J-H\",\"Q-C\"]},\"dealer\":{\"cardCount\":5,\"sum\":21,\"cardValues\":[\"8-C\",\"3-S\",\"3-D\",\"2-H\",\"5-H\"]},\"chips\":0,\"currentBet\":5,\"result\":\"You Lose!\",\"timestamp\":\"2024-12-04T15:15:19.920Z\"}', 0.00, '2024-12-04 23:15:19'),
(16, 2, '{\"player\":{\"cardCount\":3,\"sum\":22,\"cardValues\":[\"5-H\",\"7-S\",\"10-D\"]},\"dealer\":{\"cardCount\":2,\"sum\":20,\"cardValues\":[\"A-C\",\"9-C\"]},\"chips\":450,\"currentBet\":50,\"result\":\"You Lose!\",\"timestamp\":\"2024-12-04T15:15:52.882Z\"}', 450.00, '2024-12-04 23:15:52'),
(17, 2, '{\"player\":{\"cardCount\":3,\"sum\":16,\"cardValues\":[\"5-D\",\"A-S\",\"10-D\"]},\"dealer\":{\"cardCount\":4,\"sum\":22,\"cardValues\":[\"A-H\",\"2-S\",\"9-C\",\"Q-C\"]},\"chips\":350,\"currentBet\":100,\"result\":\"You Win!\",\"timestamp\":\"2024-12-04T15:16:09.419Z\"}', 550.00, '2024-12-04 23:16:09'),
(18, 2, '{\"player\":{\"cardCount\":2,\"sum\":14,\"cardValues\":[\"Q-C\",\"4-D\"]},\"dealer\":{\"cardCount\":2,\"sum\":18,\"cardValues\":[\"9-S\",\"9-H\"]},\"chips\":500,\"currentBet\":50,\"result\":\"You Lose!\",\"timestamp\":\"2024-12-04T15:16:17.329Z\"}', 500.00, '2024-12-04 23:16:17'),
(19, 2, '{\"player\":{\"cardCount\":3,\"sum\":19,\"cardValues\":[\"2-S\",\"Q-S\",\"7-C\"]},\"dealer\":{\"cardCount\":4,\"sum\":20,\"cardValues\":[\"3-C\",\"J-C\",\"3-H\",\"4-S\"]},\"chips\":450,\"currentBet\":50,\"result\":\"You Lose!\",\"timestamp\":\"2024-12-04T15:16:50.358Z\"}', 450.00, '2024-12-04 23:16:50'),
(20, 2, '{\"player\":{\"cardCount\":3,\"sum\":16,\"cardValues\":[\"9-D\",\"5-C\",\"2-C\"]},\"dealer\":{\"cardCount\":2,\"sum\":20,\"cardValues\":[\"Q-H\",\"K-C\"]},\"chips\":400,\"currentBet\":50,\"result\":\"You Lose!\",\"timestamp\":\"2024-12-04T15:16:57.029Z\"}', 400.00, '2024-12-04 23:16:57'),
(21, 2, '{\"player\":{\"cardCount\":2,\"sum\":17,\"cardValues\":[\"8-C\",\"9-H\"]},\"dealer\":{\"cardCount\":2,\"sum\":20,\"cardValues\":[\"Q-H\",\"K-S\"]},\"chips\":350,\"currentBet\":50,\"result\":\"You Lose!\",\"timestamp\":\"2024-12-04T15:17:02.180Z\"}', 350.00, '2024-12-04 23:17:02'),
(22, 2, '{\"player\":{\"cardCount\":3,\"sum\":20,\"cardValues\":[\"6-S\",\"3-D\",\"A-H\"]},\"dealer\":{\"cardCount\":3,\"sum\":22,\"cardValues\":[\"J-D\",\"2-D\",\"10-D\"]},\"chips\":300,\"currentBet\":50,\"result\":\"You Win!\",\"timestamp\":\"2024-12-04T15:17:11.766Z\"}', 400.00, '2024-12-04 23:17:11'),
(23, 3, '{\"player\":{\"cardCount\":2,\"sum\":18,\"cardValues\":[\"A-S\",\"7-D\"]},\"dealer\":{\"cardCount\":2,\"sum\":19,\"cardValues\":[\"9-D\",\"K-C\"]},\"chips\":450,\"currentBet\":50,\"result\":\"You Lose!\",\"timestamp\":\"2024-12-04T15:17:51.365Z\"}', 450.00, '2024-12-04 23:17:51'),
(24, 3, '{\"player\":{\"cardCount\":4,\"sum\":23,\"cardValues\":[\"6-C\",\"3-C\",\"4-D\",\"Q-S\"]},\"dealer\":{\"cardCount\":2,\"sum\":10,\"cardValues\":[\"5-D\",\"5-C\"]},\"chips\":350,\"currentBet\":100,\"result\":\"You Lose!\",\"timestamp\":\"2024-12-04T15:17:57.384Z\"}', 350.00, '2024-12-04 23:17:57'),
(25, 3, '{\"player\":{\"cardCount\":2,\"sum\":18,\"cardValues\":[\"8-D\",\"10-C\"]},\"dealer\":{\"cardCount\":4,\"sum\":19,\"cardValues\":[\"2-C\",\"3-D\",\"9-D\",\"5-S\"]},\"chips\":300,\"currentBet\":50,\"result\":\"You Lose!\",\"timestamp\":\"2024-12-04T15:18:05.601Z\"}', 300.00, '2024-12-04 23:18:05'),
(26, 3, '{\"player\":{\"cardCount\":2,\"sum\":17,\"cardValues\":[\"Q-H\",\"7-H\"]},\"dealer\":{\"cardCount\":3,\"sum\":21,\"cardValues\":[\"4-D\",\"6-S\",\"A-S\"]},\"chips\":100,\"currentBet\":200,\"result\":\"You Lose!\",\"timestamp\":\"2024-12-04T15:18:12.065Z\"}', 100.00, '2024-12-04 23:18:12'),
(27, 3, '{\"player\":{\"cardCount\":2,\"sum\":17,\"cardValues\":[\"10-C\",\"7-D\"]},\"dealer\":{\"cardCount\":4,\"sum\":21,\"cardValues\":[\"9-D\",\"4-H\",\"3-H\",\"5-D\"]},\"chips\":50,\"currentBet\":50,\"result\":\"You Lose!\",\"timestamp\":\"2024-12-04T15:18:21.070Z\"}', 50.00, '2024-12-04 23:18:21'),
(28, 3, '{\"player\":{\"cardCount\":2,\"sum\":17,\"cardValues\":[\"7-H\",\"Q-C\"]},\"dealer\":{\"cardCount\":2,\"sum\":17,\"cardValues\":[\"9-C\",\"8-H\"]},\"chips\":40,\"currentBet\":10,\"result\":\"Tie!\",\"timestamp\":\"2024-12-04T15:18:29.697Z\"}', 50.00, '2024-12-04 23:18:29'),
(29, 3, '{\"player\":{\"cardCount\":2,\"sum\":16,\"cardValues\":[\"A-C\",\"5-C\"]},\"dealer\":{\"cardCount\":3,\"sum\":21,\"cardValues\":[\"9-D\",\"2-C\",\"Q-S\"]},\"chips\":40,\"currentBet\":10,\"result\":\"You Lose!\",\"timestamp\":\"2024-12-04T15:18:38.548Z\"}', 40.00, '2024-12-04 23:18:38'),
(30, 3, '{\"player\":{\"cardCount\":3,\"sum\":16,\"cardValues\":[\"2-D\",\"5-C\",\"9-H\"]},\"dealer\":{\"cardCount\":2,\"sum\":18,\"cardValues\":[\"J-S\",\"8-S\"]},\"chips\":30,\"currentBet\":10,\"result\":\"You Lose!\",\"timestamp\":\"2024-12-04T15:19:05.698Z\"}', 30.00, '2024-12-04 23:19:05'),
(31, 2, '{\"player\":{\"cardCount\":2,\"sum\":20,\"cardValues\":[\"K-H\",\"K-S\"]},\"dealer\":{\"cardCount\":3,\"sum\":23,\"cardValues\":[\"J-D\",\"5-C\",\"8-H\"]},\"chips\":350,\"currentBet\":50,\"result\":\"You Win!\",\"timestamp\":\"2024-12-04T15:19:23.582Z\"}', 450.00, '2024-12-04 23:19:23'),
(32, 3, '{\"player\":{\"cardCount\":3,\"sum\":24,\"cardValues\":[\"9-D\",\"5-H\",\"J-C\"]},\"dealer\":{\"cardCount\":2,\"sum\":14,\"cardValues\":[\"4-C\",\"K-S\"]},\"chips\":0,\"currentBet\":30,\"result\":\"You Lose!\",\"timestamp\":\"2024-12-04T15:19:51.079Z\"}', 0.00, '2024-12-04 23:19:51');

-- --------------------------------------------------------

--
-- 資料表結構 `players`
--

CREATE TABLE `players` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `chips` int(11) NOT NULL DEFAULT 500,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `players`
--

INSERT INTO `players` (`id`, `username`, `password`, `chips`, `created_at`) VALUES
(1, 'test1', '$2y$10$V.6A1mPg18sL489MrZmY3eGvxkpdPSUEd4PtOfNBe4bDMo47ypVFi', 0, '2024-12-04 15:13:02'),
(2, 'test2', '$2y$10$OkAR3rQaFuQLuCH0PK6PK.ZNz2wYUykrLQ/oJIN0dDWqyou.gaRUi', 450, '2024-12-04 15:15:43'),
(3, 'test3', '$2y$10$CrImGJror2teLp2h9R24meqzMAbhzWl3fjLDYLUPWtvsiJHa2D0iy', 0, '2024-12-04 15:17:31');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `game_results`
--
ALTER TABLE `game_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `player_id` (`player_id`);

--
-- 資料表索引 `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `game_results`
--
ALTER TABLE `game_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `players`
--
ALTER TABLE `players`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `game_results`
--
ALTER TABLE `game_results`
  ADD CONSTRAINT `game_results_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
