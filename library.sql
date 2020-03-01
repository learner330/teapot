-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2020-02-20 22:31:34
-- 服务器版本： 8.0.18
-- PHP 版本： 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `library`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(225) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(225) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, '654321', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- 表的结构 `books`
--

CREATE TABLE `books` (
  `id` int(6) NOT NULL,
  `name` varchar(20) CHARACTER SET gbk COLLATE gbk_chinese_ci NOT NULL,
  `major` varchar(10) CHARACTER SET gbk COLLATE gbk_chinese_ci NOT NULL,
  `number` int(11) DEFAULT NULL,
  `lable` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `books`
--

INSERT INTO `books` (`id`, `name`, `major`, `number`, `lable`) VALUES
(1, '789', 'asdf', 4, 'asdf'),
(2, '123', 'asdf', 3, 'asdf'),
(3, 'dfg', 'asdf', 4, 'asdf'),
(44, '大学英语1', '英语', 5, '英语，教材，公共课'),
(45, '大学英语2', '英语', 10, '英语，教材，公共课'),
(46, '英语习题手册', '英语', 10, '英语，习题'),
(47, '高等数学', '数学', 4, '数学，教材'),
(48, '高数辅导', '数学', 6, '数学，高数，教辅');

-- --------------------------------------------------------

--
-- 表的结构 `lend`
--

CREATE TABLE `lend` (
  `id` int(6) NOT NULL,
  `book_id` int(6) NOT NULL,
  `user_id` int(3) NOT NULL,
  `lend_time` date NOT NULL,
  `isreturn` int(11) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `return_time` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `lend`
--

INSERT INTO `lend` (`id`, `book_id`, `user_id`, `lend_time`, `isreturn`, `deadline`, `return_time`) VALUES
(47, 37, 1, '2013-10-23', 0, NULL, NULL),
(48, 37, 2, '2013-10-23', 0, NULL, NULL),
(49, 37, 3, '2013-10-23', 0, NULL, NULL),
(50, 26, 3, '2013-10-23', 0, NULL, NULL),
(51, 2, 3, '2013-10-23', 0, NULL, NULL),
(58, 39, 4, '2013-12-05', 0, NULL, NULL),
(59, 41, 4, '2013-12-05', 0, NULL, NULL),
(60, 37, 4, '2013-12-05', 0, NULL, NULL),
(66, 41, 2, '2014-01-03', 0, NULL, NULL),
(67, 1, 10, '2020-02-19', 1, NULL, '2020-03-20'),
(72, 45, 10, '2020-02-20', NULL, '2020-03-21', NULL),
(73, 46, 10, '2020-02-20', NULL, '2020-03-21', NULL),
(74, 47, 10, '2020-02-20', 1, '2020-03-21', NULL),
(75, 48, 10, '2020-02-20', 1, '2020-03-21', NULL),
(76, 45, 10, '2020-02-20', NULL, '2020-03-21', NULL),
(77, 46, 10, '2020-02-20', NULL, '2020-03-21', NULL),
(78, 45, 10, '2020-02-20', NULL, '2020-03-21', NULL),
(79, 46, 10, '2020-02-20', NULL, '2020-03-21', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(225) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(225) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `identification` bigint(18) NOT NULL,
  `StudentID` bigint(10) NOT NULL,
  `email` varchar(225) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `tel` varchar(225) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `identification`, `StudentID`, `email`, `tel`) VALUES
(10, '123456', 'e10adc3949ba59abbe56e057f20f883e', 210112200104070211, 3019244315, NULL, NULL);

--
-- 转储表的索引
--

--
-- 表的索引 `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `lend`
--
ALTER TABLE `lend`
  ADD PRIMARY KEY (`id`,`user_id`);

--
-- 表的索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `books`
--
ALTER TABLE `books`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- 使用表AUTO_INCREMENT `lend`
--
ALTER TABLE `lend`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
