-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1:3306
-- 產生時間： 2023-03-16 07:00:28
-- 伺服器版本： 5.7.36
-- PHP 版本： 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `oneatwob`
--

-- --------------------------------------------------------

--
-- 資料表結構 `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `nickname` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `best` int(3) NOT NULL,
  `average` double NOT NULL,
  `rate` double NOT NULL,
  `detail` json NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `accounts`
--

INSERT INTO `accounts` (`nickname`, `account`, `password`, `message`, `best`, `average`, `rate`, `detail`) VALUES
('30911【開發者】', '10930150@m2.csghs.tp.edu.tw', 'au4a83', '我沒開外掛www', 4, 6.22, 1, '{\"0\": 4, \"1\": 5, \"2\": 6, \"3\": 6, \"4\": 6, \"5\": 6, \"6\": 10, \"7\": 6, \"8\": 7}'),
('NPC_01412', '0903annkuo@gmail.com', '0000000', '', 9, 17, 0.86, '{\"0\": 0, \"1\": 10, \"2\": 9, \"3\": 19, \"4\": 15, \"5\": 28, \"6\": 21}'),
('www', 'a@gmail.com', 'wwwwwww', '', 6, 11.33, 1, '{\"0\": 7, \"1\": 11, \"2\": 6, \"3\": 14, \"4\": 10, \"5\": 12, \"6\": 15, \"7\": 11, \"8\": 16}'),
('溫蒂', '10930068@m2.csghs.tp.edu.tw', 'K223242366', '', 6, 10.88, 1, '{\"0\": 14, \"1\": 16, \"2\": 17, \"3\": 10, \"4\": 7, \"5\": 7, \"6\": 10, \"7\": 6}'),
('ee', 'annieliao931021@gmail.com', 'eeeeee', '西郎豪可愛西郎我的', 5, 9.6, 0.83, '{\"0\": 13, \"1\": 5, \"2\": 8, \"3\": 11, \"4\": 11, \"5\": 0}'),
('好想吃壽司', '10930275@m2.csghs.tp.edu.tw', '000000', '', 7, 9, 1, '{\"0\": 7, \"1\": 15, \"2\": 7, \"3\": 8, \"4\": 8}'),
('羽化', '10930515@m2.csghs.tp.edu.tw', '10930515', '', 11, 11.5, 1, '{\"0\": 11, \"1\": 12}'),
('一隻海星', 'alice2005ouo@gmail.com', 'loveu2', 'ㄏㄧˋㄚ ! ', 6, 13.33, 0.75, '{\"0\": 0, \"1\": 12, \"2\": 0, \"3\": 13, \"4\": 6, \"5\": 11, \"6\": 27, \"7\": 11}'),
('你媽', '10930524@gmail.com', '123456789', '我媽', 8, 9.75, 0.8, '{\"0\": 11, \"1\": 8, \"2\": 0, \"3\": 10, \"4\": 10}'),
('jchou', 'jc@', 'abcd1234', '', 0, 0, 0, '{}'),
('haha', 'liuhannah0428@gmail.com', 'haha12345', '', 8, 15.6, 1, '{\"0\": 29, \"1\": 12, \"2\": 10, \"3\": 8, \"4\": 19}'),
('阿姆斯特朗旋風噴射阿姆斯特朗砲', 'ababab@gmail.com', '10930531', '', 6, 10.67, 0.86, '{\"0\": 11, \"1\": 0, \"2\": 14, \"3\": 16, \"4\": 10, \"5\": 7, \"6\": 6}'),
('嘎油', '123@', '123456', '超餓...', 8, 8, 1, '{\"0\": 8}'),
('gw', '222222@gmail.com', '123123', '', 5, 5, 1, '{\"0\": 5}'),
('YUE', '0000@gmail.com', '00000000', '', 0, 0, 0, '{}'),
('竺竺', '20020205@gmail.com', '0123456789', '', 5, 6.57, 0.88, '{\"0\": 0, \"1\": 7, \"2\": 5, \"3\": 5, \"4\": 9, \"5\": 8, \"6\": 6, \"7\": 6}'),
('06090620050514', '06090620050514@', '06090620050514', '', 5, 8.5, 1, '{\"0\": 12, \"1\": 7, \"2\": 10, \"3\": 5}');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
