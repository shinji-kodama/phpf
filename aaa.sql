-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:8889
-- 生成日時: 2021 年 6 月 11 日 08:04
-- サーバのバージョン： 5.7.32
-- PHP のバージョン: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- データベース: `book_sns`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `bs_book_table`
--

CREATE TABLE `bs_book_table` (
  `id` int(12) NOT NULL,
  `asin` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isbn` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `star` float DEFAULT NULL,
  `class1` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `class2` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `class3` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `yobi1` int(12) DEFAULT NULL,
  `yobi2` int(12) DEFAULT NULL,
  `yobi3` int(12) DEFAULT NULL,
  `yobi4` int(12) DEFAULT NULL,
  `yobi5` int(12) DEFAULT NULL,
  `yobi6` int(12) DEFAULT NULL,
  `yobi7` int(12) DEFAULT NULL,
  `count_review` int(12) DEFAULT NULL,
  `prop` json DEFAULT NULL,
  `indate` datetime NOT NULL,
  `uddate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `bs_book_table`
--

INSERT INTO `bs_book_table` (`id`, `asin`, `isbn`, `title`, `author`, `name`, `url`, `img`, `star`, `class1`, `class2`, `class3`, `yobi1`, `yobi2`, `yobi3`, `yobi4`, `yobi5`, `yobi6`, `yobi7`, `count_review`, `prop`, `indate`, `uddate`) VALUES
(30, 'B0922H5V2N', NULL, '三体Ⅲ　死神永生　上 | Kindle版', ' 劉 慈欣, 大森 望, ワン チャイ, 光吉 さくら, 泊 功 ', 'shinji', 'https://www.amazon.co.jp/dp/B0922H5V2N/ref=tmm_kin_swatch_0', 'https://m.media-amazon.com/images/I/51hhIZ+y-XS.jpg', 4.8, '中国の小説・文芸', '中国の小説・文芸', 'undefined', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-11 01:12:55', NULL),
(31, NULL, '4152100206', '三体III 死神永生 上 | 単行本 ', ' 劉 慈欣, 富安 健一郎, 大森 望, 光吉 さくら, ワン チャイ, 泊 功 ', 'shinji', 'https://www.amazon.co.jp/dp/4152100206/ref=tmm_hrd_swatch_0', 'https://images-na.ssl-images-amazon.com/images/I/51ecHs-jWAS._SX345_BO1,204,203,200_.jpg', 4.8, 'SF・ホラー・ファンタジー (本)', 'undefined', 'undefined', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-11 01:14:46', NULL),
(32, NULL, '4044005095', '三国志演義 1 (角川ソフィア文庫) | 文庫 ', ' 羅貫中, 立間 祥介 ', 'shinji', 'https://www.amazon.co.jp/dp/4044005095/ref=sspa_dk_detail_2', 'https://images-na.ssl-images-amazon.com/images/I/51s6iZmGMoL._SX350_BO1,204,203,200_.jpg', 5, '中国文学研究', '角川ソフィア文庫', 'SF・ホラー・ファンタジー (本)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-11 01:16:07', NULL),
(33, 'B07RYPKKXJ', NULL, '三国志演義 1 (角川ソフィア文庫) | Kindle版', ' 羅貫中, 立間 祥介 ', 'shinji', 'https://www.amazon.co.jp/dp/B07RYPKKXJ/ref=tmm_kin_swatch_0', 'https://m.media-amazon.com/images/I/51P3zF9s-oL.jpg', 5, '日本の小説・文芸', '日本の小説・文芸', 'undefined', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-11 01:16:12', NULL),
(34, 'B087FCB5YT', NULL, '８６―エイティシックス―Ep.8　―ガンスモーク・オン・ザ・ウォーター― (電撃文庫) | Kindle版', '安里  アサト, しらび, Ｉ-IV', 'shinji', 'https://www.amazon.co.jp/dp/B087FCB5YT/', 'https://m.media-amazon.com/images/I/51ITfpnVPaL.jpg', 4.7, '電撃文庫', 'ライトノベル (Kindleストア)', 'undefined', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-11 01:17:54', NULL),
(35, NULL, '4049131854', '86―エイティシックス―Ep.8 ―ガンスモーク・オン・ザ・ウォーター― (電撃文庫) | 文庫 ', ' 安里 アサト, しらび, I-IV ', 'shinji', 'https://www.amazon.co.jp/dp/4049131854/ref=tmm_pap_swatch_0', 'https://images-na.ssl-images-amazon.com/images/I/51hnMYqequL._SX350_BO1,204,203,200_.jpg', 4.7, '電撃文庫', '文庫', 'undefined', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-11 01:18:10', NULL),
(36, 'B07488WDVM', NULL, '８６―エイティシックス―Ep.2　―ラン・スルー・ザ・バトルフロント―〈上〉 (電撃文庫) | Kindle版', '安里  アサト, しらび, Ｉ-IV', 'shinji', 'https://www.amazon.co.jp/gp/product/B07488WDVM', 'https://m.media-amazon.com/images/I/512R5e1R3BL.jpg', 4.5, '電撃文庫', 'ライトノベル (Kindleストア)', 'undefined', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-11 01:27:15', NULL),
(37, NULL, '4048932322', '86―エイティシックス―Ep.2 ―ラン・スルー・ザ・バトルフロント―〈上〉 (電撃文庫) | 文庫 ', ' しらび, 安里 アサト, I-IV ', 'shinji', 'https://www.amazon.co.jp/dp/4048932322/ref=tmm_pap_swatch_0', 'https://images-na.ssl-images-amazon.com/images/I/51MVsFQdfrL._SX351_BO1,204,203,200_.jpg', 4.5, '電撃文庫', '文庫', 'undefined', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-11 01:27:32', NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `bs_usr_table`
--

CREATE TABLE `bs_usr_table` (
  `id` int(12) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `lpw` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `kanri_flg` int(1) NOT NULL,
  `life_flg` int(1) NOT NULL,
  `address` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `age` int(10) DEFAULT NULL,
  `no1book` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `fav_author` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `intro` text COLLATE utf8_unicode_ci NOT NULL,
  `indate` datetime NOT NULL,
  `uddate` datetime DEFAULT NULL,
  `urltoken` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `bs_usr_table`
--

INSERT INTO `bs_usr_table` (`id`, `name`, `email`, `lpw`, `kanri_flg`, `life_flg`, `address`, `age`, `no1book`, `fav_author`, `intro`, `indate`, `uddate`, `urltoken`) VALUES
(1, 'shinji', 'shinji19851208@hotmail.co.jp', '$2y$10$Swu.uSgd28hAk5s5HeMEuOW7JM8sj9.cfACsz6mPYLSdWwCfANaLe', 1, 0, NULL, NULL, '', '', '', '2021-06-10 22:48:08', NULL, NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `community_table`
--

CREATE TABLE `community_table` (
  `com_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `com_intro` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `com_id` int(12) NOT NULL,
  `com_img` varchar(256) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `com_usr_table`
--

CREATE TABLE `com_usr_table` (
  `id` int(12) NOT NULL,
  `com_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `com_usr_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `com_kanri_flg` int(1) NOT NULL,
  `com_life_flg` int(1) NOT NULL,
  `com_indate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `fav_book_table`
--

CREATE TABLE `fav_book_table` (
  `id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `asin` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isbn` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `star` float DEFAULT NULL,
  `impression` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `review` text COLLATE utf8_unicode_ci,
  `fav_book_flg` int(1) DEFAULT NULL,
  `fin_read_flg` int(1) NOT NULL,
  `indate` int(1) DEFAULT NULL,
  `uddate` int(1) NOT NULL,
  `p1` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `p2` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `p3` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `p4` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `p5` varchar(36) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `friend_table`
--

CREATE TABLE `friend_table` (
  `name_send` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `name_recieve` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `friend_flg` int(1) NOT NULL,
  `id` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `bs_book_table`
--
ALTER TABLE `bs_book_table`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `asin` (`asin`),
  ADD UNIQUE KEY `isbn` (`isbn`);

--
-- テーブルのインデックス `bs_usr_table`
--
ALTER TABLE `bs_usr_table`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`,`email`);

--
-- テーブルのインデックス `community_table`
--
ALTER TABLE `community_table`
  ADD PRIMARY KEY (`com_id`);

--
-- テーブルのインデックス `fav_book_table`
--
ALTER TABLE `fav_book_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `friend_table`
--
ALTER TABLE `friend_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `bs_book_table`
--
ALTER TABLE `bs_book_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- テーブルの AUTO_INCREMENT `bs_usr_table`
--
ALTER TABLE `bs_usr_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルの AUTO_INCREMENT `community_table`
--
ALTER TABLE `community_table`
  MODIFY `com_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `fav_book_table`
--
ALTER TABLE `fav_book_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `friend_table`
--
ALTER TABLE `friend_table`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT;
