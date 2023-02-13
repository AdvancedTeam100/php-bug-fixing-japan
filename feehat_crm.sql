-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2023-02-13 15:42:59
-- サーバのバージョン： 10.4.24-MariaDB
-- PHP のバージョン: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `feehat_crm`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `answers`
--

CREATE TABLE `answers` (
  `user_id` int(11) NOT NULL,
  `q1` varchar(30) DEFAULT NULL,
  `q2` varchar(30) DEFAULT NULL,
  `q3` varchar(30) DEFAULT NULL,
  `q4` varchar(30) DEFAULT NULL,
  `q5` varchar(30) DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `answers`
--

INSERT INTO `answers` (`user_id`, `q1`, `q2`, `q3`, `q4`, `q5`, `updated_at`) VALUES
(1, 'それ以上', '付き合い程度', '３-５回', '一人,友達,家族', '２軒', '2023-02-13 11:04:41'),
(2, 'それ以上', '付き合い程度', '３-５回', '一人,友達,家族', '２軒', '2023-02-13 11:04:41');

-- --------------------------------------------------------

--
-- テーブルの構造 `question_items`
--

CREATE TABLE `question_items` (
  `id` int(11) NOT NULL,
  `question` varchar(100) NOT NULL,
  `choices` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `question_items`
--

INSERT INTO `question_items` (`id`, `question`, `choices`) VALUES
(1, '来店回数', 'はじめて,２回目,３-５回,それ以上,一度もない'),
(2, 'お酒はよく飲みますか？', '好き,付き合い程度,飲めない,飲まない'),
(3, '外食回数', '週１，２ 回,週 ３-５回,それ以上,あまりしない'),
(4, '飲みに行くメンバーは？', '職場,先輩後輩,友達,家族,恋人,一人,その他'),
(5, '飲みに行く時は何件くらいハシゴしますか？', '１軒,２軒,３軒,４軒以上');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` varchar(8) NOT NULL DEFAULT '一般会員',
  `email` varchar(100) NOT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `prefecture` varchar(4) DEFAULT NULL,
  `city` varchar(10) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `sex` varchar(3) DEFAULT NULL,
  `job` varchar(30) DEFAULT NULL,
  `memo` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`user_id`, `name`, `status`, `email`, `tel`, `prefecture`, `city`, `birthday`, `sex`, `job`, `memo`, `created_at`) VALUES
(1, '奥野隆太', '一般会員', 'rostyle95@gmail.com', '08071340555', '神奈川県', '茅ヶ崎市', '1989-09-05', '男性', '自営業', NULL, '2023-02-11 13:57:39'),
(2, '三木友希', '一般会員', 'yr.ryumiki@gmail.com', NULL, '山口県', '山口市', '1990-03-11', '男性', '自営業', 'うに頭', '2023-02-13 08:32:35');

-- --------------------------------------------------------

--
-- テーブルの構造 `visits`
--

CREATE TABLE `visits` (
  `visit_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `memo` text DEFAULT NULL,
  `visit_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `visits`
--

INSERT INTO `visits` (`visit_id`, `user_id`, `memo`, `visit_date`) VALUES
(1, 1, 'ハンサムだった。\r\n美女4名と来店。', '2023-02-13 22:37:00');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `answers`
--
ALTER TABLE `answers`
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- テーブルのインデックス `question_items`
--
ALTER TABLE `question_items`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- テーブルのインデックス `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`visit_id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `question_items`
--
ALTER TABLE `question_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- テーブルの AUTO_INCREMENT `visits`
--
ALTER TABLE `visits`
  MODIFY `visit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
