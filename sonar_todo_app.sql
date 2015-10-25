-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- ホスト: 127.0.0.1
-- 生成日時: 2015 年 10 月 25 日 15:34
-- サーバのバージョン: 5.5.32
-- PHP のバージョン: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- データベース: `sonar_todo_app`
--
CREATE DATABASE IF NOT EXISTS `sonar_todo_app` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `sonar_todo_app`;

-- --------------------------------------------------------

--
-- テーブルの構造 `m_user`
--

CREATE TABLE IF NOT EXISTS `m_user` (
  `user_id` varchar(32) NOT NULL,
  `user_pw` varchar(64) NOT NULL,
  `user_mei` varchar(32) NOT NULL,
  `tel` varchar(16) DEFAULT NULL,
  `email` varchar(32) DEFAULT NULL,
  `biko` text,
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `m_user`
--

INSERT INTO `m_user` (`user_id`, `user_pw`, `user_mei`, `tel`, `email`, `biko`, `create_date`, `update_date`) VALUES
('ichikawa', 'ichikawa', 'ichikawa', NULL, NULL, NULL, '2015-06-15 00:00:00', '2015-06-15 00:00:00');

-- --------------------------------------------------------

--
-- テーブルの構造 `t_project`
--

CREATE TABLE IF NOT EXISTS `t_project` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_mei` varchar(32) NOT NULL,
  `seq` int(11) NOT NULL,
  `status` enum('notyet','done') NOT NULL DEFAULT 'notyet',
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=79 ;

-- --------------------------------------------------------

--
-- テーブルの構造 `t_task`
--

CREATE TABLE IF NOT EXISTS `t_task` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `gaiyo` varchar(32) NOT NULL,
  `naiyo` text,
  `biko` text,
  `seq` int(11) NOT NULL,
  `status` enum('before_work','working','after_work') NOT NULL DEFAULT 'before_work',
  `yusen_do` int(11) NOT NULL,
  `sagyo_sha` varchar(32) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `complete_date` date DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  PRIMARY KEY (`task_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
