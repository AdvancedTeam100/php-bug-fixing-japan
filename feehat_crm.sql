-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2023-04-21 06:18:16
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
(2, '３-５回', '付き合い程度', '３-５回', '一人,友達,家族', '２軒', '2023-02-13 11:04:41'),
(51, '２回目', '付き合い程度', '週 ３-５回', '先輩後輩', '４軒以上', '2023-03-05 21:45:38');

-- --------------------------------------------------------

--
-- テーブルの構造 `columns`
--

CREATE TABLE `columns` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `columns`
--

INSERT INTO `columns` (`id`, `title`, `body`, `author`, `created_at`, `updated_at`, `image_path`) VALUES
(3, '今日はピスタチオのケーキを焼きました。', '皆さんこんにちは、スタッフの〇〇です。今日はピスタチオのケーキを焼きましたので、その様子をお伝えします。\n\nまず、材料として薄力粉、アーモンドプードル、ベーキングパウダー、バター、砂糖、卵、バニラエッセンス、ピスタチオペーストを用意しました。このうち、ピスタチオペーストは手作りし、ピスタチオを細かく砕いてオリーブオイルと混ぜ合わせました。\n\n次に、バターと砂糖をフワッフワのクリーム状になるまで混ぜ合わせ、卵を加え、更によく混ぜます。その後、ピスタチオペーストとバニラエッセンスを加え、よく混ぜます。\n\n薄力粉、アーモンドプードル、ベーキングパウダーをふるい入れ、ゴムベラで生地を混ぜます。型に入れ、180度のオーブンで45分焼きました。焼きあがったら、粉糖を振りかけて完成です。\n\n見た目も美しい、ピスタチオの香り豊かなケーキに仕上がりました。ぜひ、皆さんもお試しください。', '', '2023-04-01 22:04:43', '2023-04-01 22:58:42', 'uploads/img-JlysxefBvJPjtHKhoc712zOs.png');

-- --------------------------------------------------------

--
-- テーブルの構造 `coupons`
--

CREATE TABLE `coupons` (
  `coupon_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `point_cost` int(11) NOT NULL,
  `expiration_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `coupons`
--

INSERT INTO `coupons` (`coupon_id`, `name`, `description`, `point_cost`, `expiration_date`) VALUES
(1, '1杯無料', '2杯目以降に限り、ウイスキー以外のドリンク1杯が無料です。', 0, '2023-12-31'),
(2, 'パスタ1皿無料', '1人につきワンオーダー必須。パスタの中からお好きな1皿が無料です。', 20, '2023-12-31'),
(3, 'お好きな料理1品無料', '1人につきワンオーダー必須。料理の中からお好きな1品が無料です。', 30, '2023-12-31'),
(4, '5％OFFクーポン', 'ご注文金額から5％OFFになります。', 10, '2023-12-31'),
(5, '10％OFFクーポン', 'ご注文金額から10％OFFになります。', 20, '2023-12-31'),
(6, '15％OFFクーポン', 'ご注文金額から15％OFFになります。', 30, '2023-12-31'),
(7, '20％OFFクーポン', 'ご注文金額から20％OFFになります。', 40, '2023-12-31'),
(8, '30％OFFクーポン', 'ご注文金額から30％OFFになります。', 50, '2023-12-31'),
(9, '50％OFFクーポン', 'ご注文金額から50％OFFになります。', 100, '2023-12-31'),
(10, 'デザート1品無料', '1人につきワンオーダー必須。デザートの中からお好きな1品が無料です。', 10, '2023-12-31'),
(11, 'コース半額クーポン', 'コース料理が半額になります。', 50, '2023-12-31'),
(12, '10名以上で1名無料クーポン', '10名以上でご利用いただいた場合、料金がかかる方の中で1名分が無料になります。', 0, '2023-12-31');

-- --------------------------------------------------------

--
-- テーブルの構造 `coupon_used`
--

CREATE TABLE `coupon_used` (
  `coupon_used_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `used_datetime` datetime NOT NULL,
  `used_place` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `coupon_used`
--

INSERT INTO `coupon_used` (`coupon_used_id`, `user_id`, `coupon_id`, `used_datetime`, `used_place`) VALUES
(1, 1, 2, '2023-03-15 05:02:38', ''),
(2, 1, 5, '2023-03-15 05:02:47', ''),
(3, 1, 5, '2023-03-16 22:28:47', 'Web'),
(4, 1, 1, '2023-03-16 14:30:48', ''),
(5, 1, 1, '2023-03-16 22:30:52', 'Web'),
(6, 1, 1, '2023-03-16 14:31:23', ''),
(7, 1, 2, '2023-03-16 22:31:30', 'Web'),
(8, 1, 5, '2023-03-17 01:08:46', '');

-- --------------------------------------------------------

--
-- テーブルの構造 `coupon_user`
--

CREATE TABLE `coupon_user` (
  `coupon_user_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `coupon_user`
--

INSERT INTO `coupon_user` (`coupon_user_id`, `user_id`, `coupon_id`) VALUES
(4, 1, 1),
(5, 1, 5);

-- --------------------------------------------------------

--
-- テーブルの構造 `points`
--

CREATE TABLE `points` (
  `point_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `point` int(11) NOT NULL,
  `update_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `points`
--

INSERT INTO `points` (`point_id`, `user_id`, `point`, `update_datetime`) VALUES
(1, 1, 140, '2023-03-10 14:48:48');

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
  `tag` varchar(300) DEFAULT NULL,
  `memo` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`user_id`, `name`, `status`, `email`, `tel`, `prefecture`, `city`, `birthday`, `sex`, `job`, `tag`, `memo`, `created_at`, `updated_at`) VALUES
(1, '奥野隆太', 'ゴールド会員', 'rostyle95@gmail.com', '08071340555', '神奈川県', '茅ヶ崎市', '1989-09-05', '男性', '自営業', 'カウンター,幹事', 'aa', '2023-02-11 22:57:39', '2023-04-19 23:52:13'),
(2, '三木友希', 'ブロンズ会員', 'yr.ryumiki@gmail.com', '', '山口県', '山口市', '1990-03-11', '男性', '自営業', '合コン,デート', 'うに頭　うにちゃびん', '2023-02-13 17:32:35', '2023-04-19 00:00:00');

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
(1, 1, 'イケメンだった。', '2023-02-13 22:37:00'),
(2, 1, '美女4人と来店', '2023-02-14 08:37:00'),
(3, 2, '今日はさみしそうだった。', '2023-02-14 09:23:25'),
(4, 1, '', '2023-02-16 14:49:49'),
(5, 1, '', '2023-02-16 14:49:55'),
(6, 1, 'また彼女が増えたらしい。', '2023-02-16 14:50:36'),
(7, 1, '', '2023-02-16 14:50:40'),
(15, 1, '', '2023-02-16 16:02:20');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `answers`
--
ALTER TABLE `answers`
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- テーブルのインデックス `columns`
--
ALTER TABLE `columns`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`coupon_id`);

--
-- テーブルのインデックス `coupon_used`
--
ALTER TABLE `coupon_used`
  ADD PRIMARY KEY (`coupon_used_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `coupon_id` (`coupon_id`);

--
-- テーブルのインデックス `coupon_user`
--
ALTER TABLE `coupon_user`
  ADD PRIMARY KEY (`coupon_user_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `coupon_id` (`coupon_id`);

--
-- テーブルのインデックス `points`
--
ALTER TABLE `points`
  ADD PRIMARY KEY (`point_id`),
  ADD KEY `user_id` (`user_id`);

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
-- テーブルの AUTO_INCREMENT `columns`
--
ALTER TABLE `columns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルの AUTO_INCREMENT `coupons`
--
ALTER TABLE `coupons`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- テーブルの AUTO_INCREMENT `coupon_used`
--
ALTER TABLE `coupon_used`
  MODIFY `coupon_used_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- テーブルの AUTO_INCREMENT `coupon_user`
--
ALTER TABLE `coupon_user`
  MODIFY `coupon_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- テーブルの AUTO_INCREMENT `points`
--
ALTER TABLE `points`
  MODIFY `point_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルの AUTO_INCREMENT `question_items`
--
ALTER TABLE `question_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- テーブルの AUTO_INCREMENT `visits`
--
ALTER TABLE `visits`
  MODIFY `visit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `coupon_used`
--
ALTER TABLE `coupon_used`
  ADD CONSTRAINT `coupon_used_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `coupon_used_ibfk_2` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`coupon_id`);

--
-- テーブルの制約 `coupon_user`
--
ALTER TABLE `coupon_user`
  ADD CONSTRAINT `coupon_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `coupon_user_ibfk_2` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`coupon_id`);

--
-- テーブルの制約 `points`
--
ALTER TABLE `points`
  ADD CONSTRAINT `points_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
