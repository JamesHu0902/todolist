-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2019 年 03 月 14 日 12:35
-- 伺服器版本： 10.1.38-MariaDB
-- PHP 版本： 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `todolist`
--

-- --------------------------------------------------------

--
-- 資料表結構 `代辦事項`
--

CREATE TABLE `代辦事項` (
  `代辦事項` text COLLATE utf8_unicode_ci NOT NULL,
  `進度` tinyint(1) NOT NULL DEFAULT '0',
  `開始時間` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `代辦事項`
--

INSERT INTO `代辦事項` (`代辦事項`, `進度`, `開始時間`) VALUES
(' test2', 0, '2019-03-14 07:29:17'),
('test1', 0, '2019-03-14 07:29:19'),
(' test3', 0, '2019-03-14 07:29:21'),
(' test4', 0, '2019-03-14 07:29:23');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
