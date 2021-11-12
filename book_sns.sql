-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:8889
-- 生成日時: 2021 年 6 月 15 日 21:18
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
  `outline` text COLLATE utf8_unicode_ci,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `name_before` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
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

INSERT INTO `bs_book_table` (`id`, `asin`, `isbn`, `title`, `author`, `outline`, `name`, `name_before`, `url`, `img`, `star`, `class1`, `class2`, `class3`, `yobi1`, `yobi2`, `yobi3`, `yobi4`, `yobi5`, `yobi6`, `yobi7`, `count_review`, `prop`, `indate`, `uddate`) VALUES
(30, 'B0922H5V2N', NULL, '三体Ⅲ　死神永生　上 | Kindle版', ' 劉 慈欣, 大森 望, ワン チャイ, 光吉 さくら, 泊 功 ', NULL, 'shinji', NULL, 'https://www.amazon.co.jp/dp/B0922H5V2N/ref=tmm_kin_swatch_0', 'https://m.media-amazon.com/images/I/51hhIZ+y-XS.jpg', 4.8, '中国の小説・文芸', '中国の小説・文芸', 'undefined', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-11 01:12:55', NULL),
(33, 'B07RYPKKXJ', NULL, '三国志演義 1 (角川ソフィア文庫) | Kindle版', ' 羅貫中, 立間 祥介 ', NULL, 'shinji', NULL, 'https://www.amazon.co.jp/dp/B07RYPKKXJ/ref=tmm_kin_swatch_0', 'https://m.media-amazon.com/images/I/51P3zF9s-oL.jpg', 5, '日本の小説・文芸', '日本の小説・文芸', 'undefined', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-11 01:16:12', NULL),
(34, 'B087FCB5YT', NULL, '８６―エイティシックス―Ep.8　―ガンスモーク・オン・ザ・ウォーター― (電撃文庫) | Kindle版', '安里  アサト, しらび, Ｉ-IV', NULL, 'shinji', NULL, 'https://www.amazon.co.jp/dp/B087FCB5YT/', 'https://m.media-amazon.com/images/I/51ITfpnVPaL.jpg', 4.7, '電撃文庫', 'ライトノベル (Kindleストア)', 'undefined', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-11 01:17:54', NULL),
(36, 'B07488WDVM', NULL, '８６―エイティシックス―Ep.2　―ラン・スルー・ザ・バトルフロント―〈上〉 (電撃文庫) | Kindle版', '安里  アサト, しらび, Ｉ-IV', NULL, 'shinji', NULL, 'https://www.amazon.co.jp/gp/product/B07488WDVM', 'https://m.media-amazon.com/images/I/512R5e1R3BL.jpg', 4.5, '電撃文庫', 'ライトノベル (Kindleストア)', 'undefined', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-11 01:27:15', NULL),
(38, 'B01L0YJ4XS', NULL, 'ふたたびの高校数学 | Kindle版', ' 永野 裕之 ', NULL, 'shinji', NULL, 'https://www.amazon.co.jp/gp/product/B01L0YJ4XS', 'https://m.media-amazon.com/images/I/51i21ALcuCL.jpg', 4, '数学', '高校数学教科書・参考書', '数学 (Kindleストア)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-13 01:56:38', NULL),
(39, 'B07GGPZ4S6', NULL, '数学センスが身につく本 | Kindle版', ' アルフレッド・Ｓ・ポザマンティエ, 宮本寿代 ', NULL, 'shinji', NULL, 'https://www.amazon.co.jp/dp/B07GGPZ4S6/ref=sspa_dk_detail_3', 'https://m.media-amazon.com/images/I/41Bb20pKs3L.jpg', 4.4, '数学', 'undefined', 'undefined', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-13 01:57:17', NULL),
(40, 'B01NCOO8D0', NULL, 'マスペディア1000 | Kindle版', ' リチャード・オクラ・エルウィス ', NULL, 'shinji', NULL, 'https://www.amazon.co.jp/dp/B01NCOO8D0/ref=pd_sbs_4/356-7239875-7305108', 'https://m.media-amazon.com/images/I/51NyWAdZ+xL.jpg', 4.5, '数学', 'undefined', 'undefined', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-13 01:57:24', NULL),
(41, 'B07YX2V18G', NULL, 'Newton別冊『微分と積分 新装版』 | Kindle版', ' 科学雑誌Newton ', NULL, 'shinji', NULL, 'https://www.amazon.co.jp/dp/B07YX2V18G/ref=sspa_dk_detail_9', 'https://m.media-amazon.com/images/I/5144GtoxCFL.jpg', 4.1, '数学', 'undefined', 'undefined', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-13 01:57:41', NULL),
(43, 'B06Y654XXK', NULL, 'ケロロ軍曹(28) (角川コミックス・エース) | Kindle版', ' 吉崎 観音 ', NULL, 'shinji', NULL, 'https://www.amazon.co.jp/dp/B06Y654XXK/ref=sspa_dk_detail_1', 'https://m.media-amazon.com/images/I/612KIrWC7uL.jpg', 4.5, '少年マンガ', 'undefined', 'undefined', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-13 01:58:25', NULL),
(44, 'B0799DDBFX', NULL, 'BEASTARS　７ (少年チャンピオン・コミックス) | Kindle版', ' 板垣巴留 ', NULL, 'shinji', NULL, 'https://www.amazon.co.jp/dp/B0799DDBFX/ref=reads_cwrtbar_6/356-7239875-7305108', 'https://m.media-amazon.com/images/I/51AGKj08SFL.jpg', 4.8, '少年マンガ', 'undefined', 'undefined', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-13 01:58:53', NULL),
(45, 'B094D93NK2', NULL, '史記　武帝紀（七） (時代小説文庫) | Kindle版', ' 北方謙三 ', NULL, 'shinji', NULL, 'https://www.amazon.co.jp/dp/B094D93NK2/ref=s9_acsd_hps_bw_c2_x_3_i', 'https://m.media-amazon.com/images/I/51FBWbP2ALS.jpg', 4.4, '日本の小説・文芸', '日本の小説・文芸', 'undefined', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-13 01:59:37', NULL),
(46, 'B07KS9QGCP', NULL, '文春ジブリ文庫　シネマコミック　風の谷のナウシカ (文春文庫) | Kindle版', ' 宮崎 駿 ', '産業文明が滅びてから千年。瘴気を発する腐海に人々はおびえて暮らす中、木々を愛で、蟲と心を通わせる少女ナウシカの壮大な物語が幕を開ける――。スタジオジブリの設立のきっかけとなった不朽の名作を、繊細で鮮やかな画とともに文庫版として新たに編集したシネマ・コミック。映画の全カット、全セリフを掲載した愛蔵版。', 'shinji', NULL, 'https://www.amazon.co.jp/dp/B07KS9QGCP/ref=tmm_kin_swatch_0', 'https://m.media-amazon.com/images/I/4168lxl0ZkL.jpg', 4.5, 'マンガ', 'Kindle マンガ', 'undefined', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-14 16:02:38', NULL),
(47, 'B093PWG7BG', NULL, '進撃の巨人（３４） (週刊少年マガジンコミックス) | Kindle版', ' 諫山創 ', '巨人がすべてを支配する世界。巨人の餌と化した人類は、巨大な壁を築き、壁外への自由と引き換えに侵略を防いでいた。だが、名ばかりの平和は壁を越える大巨人の出現により崩れ、絶望の闘いが始まってしまう。<br><br><br><br>パラディ島以外の土地を踏み潰し、次々と命を奪っていく「地鳴らし」。一方、エレンの攻撃目標地点を見定めたアルミンやミカサ達。敵、味方、かつての仲間、数多の命を失いながらもついにエレンに追いつくが……。', 'shinji', NULL, 'https://www.amazon.co.jp/dp/B093PWG7BG', 'https://m.media-amazon.com/images/I/51FoQxZ19HS.jpg', 4.8, '少年マンガ', 'undefined', 'undefined', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-14 16:04:15', NULL),
(48, 'B07KW5F2T9', NULL, '文春ジブリ文庫　シネマコミック　もののけ姫 (文春文庫) | Kindle版', ' 宮崎 駿 ', '中世の日本。化物を退治した際に右腕に死の呪いを受けた青年アシタカは西へと向かう。旅の道中、神々の住む森を切り開こうとするエボシという女と、その生命を狙う、山犬に育てられた少女“もののけ姫”のサンとの邂逅を果たす。日本中に衝撃を与え大ヒットした傑作アニメ映画の全セリフ・全シーンを収録した、コミック版。', 'shinji', NULL, 'https://www.amazon.co.jp/dp/B07KW5F2T9/ref=tmm_kin_swatch_0', 'https://m.media-amazon.com/images/I/41gG8ntcnEL.jpg', 4.5, 'マンガ', 'コミック', 'undefined', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-14 16:04:31', NULL),
(49, 'B0936QZ1K2', NULL, '医者が教える最強の解毒術――20万人を診てわかった医学的に正しい毒素・老廃物を溜めない生き方 | Kindle版', ' 牧田 善二 ', '【内容紹介】<br>100万部突破シリーズ姉妹編が登場！<br>これからの健康は「何を摂るか」より「いかに毒素・老廃物の排出機能を守るか」で決まる。<br><br>「高血圧」「動脈硬化」「糖尿病」「心疾患」「脳血管」「がん」「AGE」……健康を脅かすあらゆるリスクを劇的に低下させる「あるファクター」とは？<br>「健康」は仕事・人生のパフォーマンスを左右する、現代ビジネスパーソン最強の教養。<br>これからは「食の知識」プラス「解毒能力向上」で人生が大きく変わる。20万人を診て分かった「体内から健康になる極意」をベストセラー名医が解き明かす。<br><br>【目次抜粋】<br>まんが 健康の“後悔しない\"新常識<br>はじめに 働き盛り世代に迫る危機<br>序章 その不調、解毒能力低下のサインです<br>第1章 解毒能力を落とす勘違い13<br>第2章 100歳まで動く体は腎臓次第<br>第3章 なぜ「解毒できない体」になってしまうのか<br>第4章 新時代の健康長寿17カ条<br>第5章 早期発見と最適治療で必ず治す', 'shinji', NULL, 'https://www.amazon.co.jp/dp/B0936QZ1K2/ref=pd_sbs_3/356-7239875-7305108', 'https://m.media-amazon.com/images/I/51k9MPqCEpS.jpg', 3.9, '医学・薬学', '科学・テクノロジー (Kindleストア)', 'undefined', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-15 02:17:58', NULL),
(50, 'B06ZYHLPR6', NULL, 'BEASTARS　３ (少年チャンピオン・コミックス) | Kindle版', ' 板垣巴留 ', '雌ウサギのハルが気になるレゴシ。異性の前ではいつも以上にトンチンカン。どうなる、この2匹…!? 動物版青春ヒューマンドラマ!!', 'shinji', NULL, 'https://www.amazon.co.jp/gp/product/B06ZYHLPR6', 'https://m.media-amazon.com/images/I/51JO6QLkxWL.jpg', 4.8, '少年マンガ', 'undefined', 'undefined', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-15 04:49:33', NULL),
(51, '4101240582', NULL, '丕緒の鳥 (ひしょのとり)  十二国記 5 (新潮文庫) | 文庫 ', ' 小野 不由美, 山田 章博 ', '「絶望」から「希望」を信じた男がいた。慶国に新王が登極した。即位の礼で行われる「たいしや大射」とは、鳥に見立てた陶製の的を射る儀式。陶工である丕緒(ひしょ)は、国の理想を表す任の重さに苦慮する。希望を託した「鳥」は、果たして大空に羽ばたくのだろうか──表題作「丕緒の鳥」ほか、己の役割を全うすべく、走り煩悶する、名も無き男たちの清廉なる生き様を描く短編4編を収録。', 'shinji', NULL, 'https://www.amazon.co.jp/dp/4101240582/ref=sr_1_4', 'https://images-na.ssl-images-amazon.com/images/I/61wZu0pz1iL._SX356_BO1,204,203,200_.jpg', 4.4, 'SF・ホラー・ファンタジー (本)', '歴史・時代小説 (本)', '新潮文庫', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-16 06:13:50', NULL),
(52, 'B08PP8T15H', NULL, '進撃の巨人（３３） (週刊少年マガジンコミックス) | Kindle版', ' 諫山創 ', '巨人がすべてを支配する世界。巨人の餌と化した人類は、巨大な壁を築き、壁外への自由と引き換えに侵略を防いでいた。だが、名ばかりの平和は壁を越える大巨人の出現により崩れ、絶望の闘いが始まってしまう。<br><br>パラディ島以外すべての土地を踏み潰すべく「地鳴らし」による<br>進行を続けるエレン。ミカサやアルミン達は空からエレンを追いかけるため<br>飛行艇整備が可能なオディハを目指す。だがその代償としてアニ、ライナーらの<br>家族が住む「レベリオ」を諦めることになり・・・・・。', 'shinji', NULL, 'https://www.amazon.co.jp/gp/product/B08PP8T15H', 'https://m.media-amazon.com/images/I/519CEJ+-kpL.jpg', 4.7, '少年マンガ', 'undefined', 'undefined', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-16 06:15:44', NULL);

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
  `img` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_bg` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `age` int(10) DEFAULT NULL,
  `no1book` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fav_author` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `intro` text COLLATE utf8_unicode_ci,
  `indate` datetime NOT NULL,
  `uddate` datetime DEFAULT NULL,
  `urltoken` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `bs_usr_table`
--

INSERT INTO `bs_usr_table` (`id`, `name`, `email`, `lpw`, `kanri_flg`, `life_flg`, `img`, `img_bg`, `address`, `age`, `no1book`, `fav_author`, `intro`, `indate`, `uddate`, `urltoken`) VALUES
(1, 'shinji', 'shinji19851208@hotmail.co.jp', '$2y$10$Swu.uSgd28hAk5s5HeMEuOW7JM8sj9.cfACsz6mPYLSdWwCfANaLe', 1, 0, 'img/2021061506290676ce8fbeb1f6f60cde423018ea937c66.png', 'img/2021061506290676ce8fbeb1f6f60cde423018ea937c66.jpg', 'tokyo', 36, 'Ascendance of a Bookworm', '　', 'なんか、まぁ、適当に\r\nwebサイトなんか作ってます。\r\n\r\n本だけ読んでずっとダラダラする生活ができたらいいのに。', '2021-06-10 22:48:08', '2021-06-15 15:29:06', NULL),
(2, 'hamu', 'aaa@gmail.net', 'dummy_pass', 0, 0, NULL, NULL, '広島', 22, '86', '伊坂幸太郎', '伊坂幸太郎が好きでよく読んでました。\r\n最近はラノベにも手を出して、86とか好きです。', '2021-06-12 02:17:17', '2021-06-12 02:32:17', NULL),
(3, 'kojikoji', 'kojikoji@hendana.com', 'dummy_pass', 0, 0, 'https://booth.pximg.net/755b1b17-1a06-41e7-bf6d-883a0cd579b9/i/1903245/7e605599-0899-4ad3-9a5d-1d10776e6b62_base_resized.jpg', 'https://news.only-1-led.com/wp-content/uploads/2014/07/library.jpg', '京都', 35, '三国志', '吉川英治', '歴史が好きです。\r\nたまにプログラミングもします。', '2021-06-12 02:20:26', NULL, NULL),
(5, 'koji', 'koji@hendana.com', 'dummy_pass', 0, 0, NULL, NULL, '京都', 48, 'サラダ記念日', '俵万智', '随筆ばかり読んでます。', '2021-06-12 02:45:26', NULL, NULL),
(6, 'gaki', 'gaki@gmail.net', 'dummy_pass', 0, 0, NULL, NULL, '兵庫', 38, '1984', '村上春樹', '村上春樹以外読みません', '2021-06-17 02:17:17', '2021-06-17 02:32:17', NULL),
(7, 'dami', 'dami@hendana.com', 'dummy_pass', 0, 0, 'https://illust-stock.com/wp-content/uploads/icon-josei-egao.png', NULL, '滋賀', 18, '十二国記', '小野不由美', 'ライトノベルもよく読みます。\r\nおすすめ教えてもらえると嬉しいです！', '2021-05-04 02:20:26', '2021-05-26 16:03:29', NULL),
(8, 'domo', 'domo@domdomo.com', 'dummy_pass', 0, 0, 'https://4.bp.blogspot.com/-BzJhmvcRQOM/U7O8MsG1rvI/AAAAAAAAibk/P1oExMUtVik/s800/pose_doyagao_man.png', NULL, '北海道', 32, '告白', '東野圭吾', 'ミステリー好き', '2021-04-07 02:45:26', NULL, NULL),
(9, 'gohan', 'gohan@gmail.net', 'dummy_pass', 0, 0, NULL, NULL, 'dfasd', 16, '86', 'aaa', 'sdaf', '2021-06-12 02:17:17', '2021-06-12 02:32:17', NULL),
(10, 'ranti', 'ranti@hendana.com', 'dummy_pass', 0, 0, 'https://i0.wp.com/blog-imgs-101.fc2.com/t/e/s/tesuto93/7b020c578d5c7f944f7892300408c63a.jpg', NULL, 'カメハウス', 22, 'マシンガン', 'はて', 'なんだこれ', '2021-06-12 02:20:26', NULL, NULL),
(11, 'puaru', 'puaru@hendana.com', 'dummy_pass', 0, 0, NULL, NULL, 'カメハウス', 4, 'ヤムチャ様', 'ヤムチャ様', '僕も狼牙風風拳使いたい', '2021-06-12 02:45:26', NULL, NULL),
(12, 'u-ron', 'u-ron@gmail.net', 'dummy_pass', 0, 0, NULL, NULL, 'カメハウス', 4, 'ギャルのパンティ', 'ギャルのパンティ', 'ぐふふ', '2021-06-17 02:17:17', '2021-06-17 02:32:17', NULL),
(13, 'pirahu', 'pirahu@hendana.com', 'dummy_pass', 0, 0, '', NULL, '', 18, 'hon', 'sakusha', 'mendou', '2021-05-04 02:20:26', '2021-05-26 16:03:29', NULL),
(14, 'mai_pirafu_ichimi', 'mai@domdomo.com', 'dummy_pass', 0, 0, 'https://livedoor.sp.blogimg.jp/anigei-mangabox/imgs/7/4/741e68e8.jpg', NULL, 'アジト', 20, 'nanka', 'mou', 'mendou', '2021-04-07 02:45:26', NULL, NULL),
(15, 'kyou', 'kyoumomatakamidanomi@gmail.com', '$2y$10$ypSGPJ0SkBKIxVSgWRCtxegxRXofR2TcZM.hSrOlDikFYdn7UCvKi', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-15 06:01:53', NULL, NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `community_table`
--

CREATE TABLE `community_table` (
  `com_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `com_intro` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `com_id` int(12) NOT NULL,
  `com_icon` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `com_img` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `admin` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `community_table`
--

INSERT INTO `community_table` (`com_name`, `com_intro`, `com_id`, `com_icon`, `com_img`, `admin`) VALUES
('pythonやろうぜ！', 'pythonで分析とか機械学習やりたい人が集うコミュニティです。初学者歓迎！', 1, 'https://wakara.co.jp/wp-content/uploads/Python.png', 'https://assets.st-note.com/production/uploads/images/21360112/rectangle_large_type_2_bfd28773b1b078b6581c5cdf63b2aecf.png?width=800', 'kojikoji'),
('本好きの下剋上について語りたい！', '本好きの下剋上が好きな人で話したい', 2, 'https://lh3.googleusercontent.com/proxy/da_6Yys9WDhcU6Pf8mActtMHBbhuGti_-B-AIhXnsHeNz30vTLF84wU8UAw0160-qKFN4yfd9KuoHXTKGFAP6BjFhdHhCOyKuo2y', 'https://www.animatebookstore.com/get_image.php?product_id=329777', 'dami');

-- --------------------------------------------------------

--
-- テーブルの構造 `com_recom_book`
--

CREATE TABLE `com_recom_book` (
  `id` int(12) NOT NULL,
  `com_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `book_title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `name_reg` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `comment` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `indate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `com_recom_book`
--

INSERT INTO `com_recom_book` (`id`, `com_name`, `book_title`, `name_reg`, `comment`, `indate`) VALUES
(1, 'pythonやろうぜ！', 'ふたたびの高校数学 | Kindle版', 'shinji', '数学大事', '2021-06-16 03:16:11'),
(2, 'pythonやろうぜ！', 'Newton別冊『微分と積分 新装版』 | Kindle版', 'shinji', 'newton面白いですよね。', '2021-06-16 04:29:06'),
(3, 'pythonやろうぜ！', '文春ジブリ文庫　シネマコミック　もののけ姫 (文春文庫) | Kindle版', 'shinji', 'たまには息抜きをば', '2021-06-16 04:30:17');

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

--
-- テーブルのデータのダンプ `com_usr_table`
--

INSERT INTO `com_usr_table` (`id`, `com_name`, `com_usr_name`, `com_kanri_flg`, `com_life_flg`, `com_indate`) VALUES
(1, 'pythonやろうぜ！', 'dami', 0, 0, '2021-06-15 17:19:09'),
(2, 'pythonやろうぜ！', 'kojikoji', 1, 0, '2021-06-15 17:19:50'),
(3, '本好きの下剋上について語りたい！', 'dami', 1, 0, '2021-06-15 17:21:34'),
(11, 'pythonやろうぜ！', 'shinji', 0, 0, '2021-06-15 23:38:50');

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
  `rel_flg` int(1) DEFAULT NULL,
  `fin_read_flg` int(1) NOT NULL,
  `indate` datetime(1) DEFAULT NULL,
  `uddate` datetime(1) DEFAULT NULL,
  `p1` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p2` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p3` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p4` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p5` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `fav_book_table`
--

INSERT INTO `fav_book_table` (`id`, `name`, `asin`, `isbn`, `star`, `impression`, `review`, `fav_book_flg`, `rel_flg`, `fin_read_flg`, `indate`, `uddate`, `p1`, `p2`, `p3`, `p4`, `p5`) VALUES
(1, 'koji', 'B07488WDVM', NULL, 4.4, '面白かったです', '書評書くほどではないかな。\r\nとか思いながらも描いてみる。\r\n基本的にウンタラカンタラ。ああああああああああああああああああああああああああああああああああああああああああああ。\r\nでもあsふぁskjふぁ；小瀬fn；亜音f；亞sdjふぉ；あrfぃあえhふぉあ；rん臥煙f；お和えfj；オアwg。。\r\n青いrフォアrfj；おいあ。\r\n\r\n和えおいファお；jふぃああ。\r\n\r\n総じて面白いということが言える。', 1, 1, 1, '2021-06-12 02:32:09.0', '2021-06-12 02:32:09.0', '小説', '恋愛', 'バトル', NULL, NULL),
(2, 'shinji', 'B07488WDVM', NULL, 4.2, 'もっと早く読めばよかった', '結構長文ん書くよー！（以下略）', 1, 1, 1, '2021-06-12 02:32:09.0', '2021-06-12 02:32:09.0', '小説', 'バトル', NULL, NULL, NULL),
(3, 'kojikoji', 'B07488WDVM', NULL, 5, 'これまでで一番のラノベかも', 'ラノベもいいかも', 1, 0, 1, '2021-06-12 02:32:09.0', '2021-06-12 02:32:09.0', '小説', 'ストーリー重視', NULL, NULL, NULL),
(4, 'hamu', 'B087FCB5YT', NULL, 5, '面白いね', NULL, 1, 1, 1, '2020-06-12 02:01:09.0', '2021-06-12 02:32:09.0', 'バトル', 'ストーリー重視', NULL, NULL, NULL),
(6, 'shinji', 'B01L0YJ4XS', NULL, 3.5, '懐かしす', '懐かしくも楽しい', 1, 1, 1, '2021-06-13 02:32:36.0', '2021-06-13 02:43:51.0', NULL, NULL, NULL, NULL, NULL),
(7, 'shinji', 'B0922H5V2N', NULL, 5, 'これは面白い！', '最高！', 1, 1, 1, '2021-06-13 03:05:59.0', '2021-06-13 03:05:59.0', NULL, NULL, NULL, NULL, NULL),
(8, 'shinji', 'B07RYPKKXJ', NULL, 3, 'んー', '吉川英治が好きだなぁ', 0, 0, 1, '2021-06-13 03:06:38.0', '2021-06-13 03:06:38.0', NULL, NULL, NULL, NULL, NULL),
(9, 'shinji', 'B07GGPZ4S6', NULL, 2.5, '昔欲しかったかも', '今は統計学とか線形代数に興味があります。\r\n主にpython的な意味で', 1, 1, 1, '2021-06-13 03:07:25.0', '2021-06-13 03:07:25.0', NULL, NULL, NULL, NULL, NULL),
(10, 'shinji', 'B01NCOO8D0', NULL, 0, 'まだ読んでないけど・・・', 'なんかおもしろそな気がす', 0, 0, 0, '2021-06-13 03:14:20.0', '2021-06-13 03:14:20.0', NULL, NULL, NULL, NULL, NULL),
(11, 'shinji', 'B093PWG7BG', NULL, 5, '終わるのが悲しい、寂しい', 'あああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああ\r\nいいいいいいいいいいい\r\nううううううううううううううううううううううううううううううううううううう\r\nえええええええええ\r\nおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおお', 1, 1, 1, '2021-06-13 03:15:45.0', '2021-06-13 03:15:45.0', NULL, NULL, NULL, NULL, NULL),
(12, 'kojikoji', 'B01L0YJ4XS', NULL, 3.5, 'わたしも懐かしす', NULL, 1, 1, 1, '2021-06-13 15:32:36.0', '2021-06-13 16:43:51.0', NULL, NULL, NULL, NULL, NULL),
(13, 'hamu', 'B01NCOO8D0', NULL, 3.3, 'ちょっと好き', 'なんとなきだけどね', 1, 1, 1, '2021-06-13 03:14:20.0', '2021-06-13 03:14:20.0', NULL, NULL, NULL, NULL, NULL),
(14, 'mai_pirafu_ichimi', 'B093PWG7BG', NULL, 5, '捧げよ捧げよ', '心臓を捧げよ', 1, 1, 1, '2021-06-13 03:15:45.0', '2021-06-13 03:15:45.0', NULL, NULL, NULL, NULL, NULL),
(15, 'pirahu', 'B093PWG7BG', NULL, 5, '捧げよ捧げよ', '心臓を捧げよ', 1, 1, 1, '2021-06-13 03:15:45.0', '2021-06-13 03:15:45.0', NULL, NULL, NULL, NULL, NULL),
(16, 'u-ron', 'B093PWG7BG', NULL, 5, 'ぐふふ', 'ギャルのパンティおくれ', 1, 1, 1, '2021-04-07 17:47:48.0', '2021-04-07 17:47:48.0', NULL, NULL, NULL, NULL, NULL),
(17, 'kojikoji', 'B07GGPZ4S6', NULL, 3.5, '昔欲しかったかも', '今は統計学とか線形代数に興味があります。\r\n主にpython的な意味で', 1, 1, 0, '2021-06-13 03:07:25.0', '2021-06-13 03:07:25.0', NULL, NULL, NULL, NULL, NULL),
(21, 'shinji', 'B07KS9QGCP', NULL, 5, 'これはいいものである', 'もう、言葉はいらない。', 1, 1, 1, '2021-06-14 16:03:18.0', '2021-06-14 16:03:18.0', NULL, NULL, NULL, NULL, NULL),
(22, 'shinji', 'B07YX2V18G', NULL, 0, '', '', 0, 0, 0, '2021-06-16 05:58:49.0', '2021-06-16 05:58:49.0', NULL, NULL, NULL, NULL, NULL),
(23, 'shinji', 'B07KW5F2T9', NULL, 4, 'もののけ姫、好き', '生きろ', 1, 1, 1, '2021-06-16 06:01:51.0', '2021-06-16 06:01:51.0', NULL, NULL, NULL, NULL, NULL),
(24, 'shinji', '4101240582', NULL, 4, 'これが出た時は感動した', '何年ぶりかに出た新刊。今ではもう次も出ましたが、これが出た時は感動しました。', 1, 1, 1, '2021-06-16 06:15:03.0', '2021-06-16 06:15:03.0', NULL, NULL, NULL, NULL, NULL);

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
-- テーブルのデータのダンプ `friend_table`
--

INSERT INTO `friend_table` (`name_send`, `name_recieve`, `friend_flg`, `id`) VALUES
('shinji', 'kojikoji', 1, 1),
('shinji', 'koji', 1, 2),
('kojikoji', 'koji', 1, 3),
('shinji', 'hamu', 0, 4),
('dami', 'shinji', 0, 10),
('domo', 'shinji', 1, 11),
('koji', 'hamu', 0, 12),
('gaki', 'shinji', 0, 49),
('shinji', 'domo', 1, 54);

-- --------------------------------------------------------

--
-- テーブルの構造 `msg_table`
--

CREATE TABLE `msg_table` (
  `id` int(12) NOT NULL,
  `send_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `to_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `msg` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `read_flg` int(1) NOT NULL,
  `indate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `msg_table`
--

INSERT INTO `msg_table` (`id`, `send_name`, `to_name`, `msg`, `read_flg`, `indate`) VALUES
(1, 'shinji', 'kojikoji', '今度こそメッセージできますね', 0, '2021-06-14 17:44:50'),
(2, 'kojikoji', 'shinji', 'ええ、よかったです', 0, '2021-06-14 17:44:58'),
(3, 'shinji', 'kojikoji', 'では、これからもよろしくお願いします', 0, '2021-06-14 17:48:53'),
(4, 'shinji', 'kojikoji', 'ついでにもういっちょ', 0, '2021-06-14 17:59:17'),
(5, 'shinji', 'kojikoji', 'asd', 0, '2021-06-14 18:32:57'),
(6, 'shinji', 'kojikoji', '改行したり、めちゃめちゃ長い文章打ったらどうなるんだろう。\nちょっと試してみないといけませんね\n\nさて、どうなるか・・・', 0, '2021-06-14 18:35:56'),
(7, 'shinji', 'kojikoji', 'q', 0, '2021-06-14 18:55:10'),
(8, 'shinji', 'kojikoji', 'q\n今度こそうまくいきましたね', 0, '2021-06-14 18:55:19'),
(9, 'shinji', 'kojikoji', 'あsd', 0, '2021-06-14 18:55:29'),
(10, 'shinji', 'kojikoji', 'これでほぼ完成かな？', 0, '2021-06-14 18:55:55'),
(11, 'shinji', 'kojikoji', 'あ\n', 0, '2021-06-14 18:56:07'),
(12, 'shinji', 'kojikoji', 'あ', 0, '2021-06-14 18:56:09'),
(13, 'shinji', 'kojikoji', 'あsdふぁd', 0, '2021-06-14 18:56:12'),
(14, 'shinji', 'kojikoji', '\nまじか', 0, '2021-06-14 18:56:16'),
(15, 'shinji', 'kojikoji', '\nまぁいいか', 0, '2021-06-14 18:56:20'),
(62, 'kojikoji', 'shinji', 'これでうまくいきましたかね', 0, '2021-06-14 19:44:58'),
(63, 'shinji', 'kojikoji', 'これなら？', 0, '2021-06-14 19:26:34'),
(64, 'shinji', 'domo', 'あれ・・・？', 0, '2021-06-14 19:37:31'),
(65, 'domo', 'shinji', '何か・・・？', 0, '2021-06-14 19:37:31'),
(66, 'shinji', 'kojikoji', 'またまたテスト', 0, '2021-06-14 19:41:55'),
(67, 'kojikoji', 'shinji', 'これでテストも終わり！', 1, '2021-06-14 19:44:58'),
(68, 'kojikoji', 'shinji', '未読機能確認用！', 1, '2021-06-14 19:44:58');

-- --------------------------------------------------------

--
-- テーブルの構造 `res_table`
--

CREATE TABLE `res_table` (
  `id` int(11) NOT NULL,
  `com_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `thread_title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `res` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `name_write` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `indate` datetime NOT NULL,
  `yobi` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `res_table`
--

INSERT INTO `res_table` (`id`, `com_name`, `thread_title`, `res`, `name_write`, `indate`, `yobi`) VALUES
(1, 'pythonやろうぜ！', '雑談', '初めて書き込みします！よろしくお願いします！', 'dami', '2021-06-15 20:43:40', NULL),
(3, 'pythonやろうぜ！', '雑談', '私も！よろしくお願いします！', 'shinji', '2021-06-15 20:43:40', NULL),
(4, 'pythonやろうぜ！', '質問・回答スレ', 'elifって何だよ！とか、そんなんでもOK!', 'kojikoji', '2021-06-15 20:43:40', NULL),
(5, 'pythonやろうぜ！', '雑談', 'これでうまくいきました', 'shinji', '2021-06-16 02:06:35', NULL),
(6, 'pythonやろうぜ！', '雑談', 'さあ、これでどうだ！', 'shinji', '2021-06-16 02:15:27', NULL),
(7, 'pythonやろうぜ！', '質問・回答スレ', '確かに、なんでse脱いちゃったんでしょうね', 'shinji', '2021-06-16 02:15:58', NULL),
(8, 'pythonやろうぜ！', 'test', 'これでスレッドたててレスもできた', 'shinji', '2021-06-16 02:57:26', NULL),
(9, 'pythonやろうぜ！', 'おすすめの本', '今ある高校数学の本っている？', 'shinji', '2021-06-16 04:21:20', NULL),
(10, 'pythonやろうぜ！', '読書会やります！', 'python関係の本で、日時は後ほど告知します！', 'shinji', '2021-06-16 05:40:24', NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `thread_table`
--

CREATE TABLE `thread_table` (
  `id` int(12) NOT NULL,
  `com_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `thread_title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `thread_main` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `contributor` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_bg` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `indate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `thread_table`
--

INSERT INTO `thread_table` (`id`, `com_name`, `thread_title`, `thread_main`, `contributor`, `img`, `img_bg`, `indate`) VALUES
(1, 'pythonやろうぜ！', '雑談', 'なんでもいいから話しましょう', 'kojikoji', NULL, NULL, '2021-06-15 20:38:32'),
(3, 'pythonやろうぜ！', '質問・回答スレ', '質問等はここで', 'kojikoji', NULL, NULL, '2021-06-15 20:38:32'),
(4, '本好きの下剋上について語りたい！', '雑談', 'なんでもいいから話しましょう', 'dami', NULL, NULL, '2021-06-15 20:38:32'),
(5, '本好きの下剋上について語りたい！', 'ネタバレありスレ', 'なんでもいいから話しましょう', 'dami', NULL, NULL, '2021-06-15 20:38:32'),
(6, 'pythonやろうぜ！', 'test', 'test', 'shinji', NULL, NULL, '2021-06-16 02:57:11'),
(7, 'pythonやろうぜ！', 'おすすめの本', 'RECOMMEND BOOKSの中身について語ります', 'shinji', NULL, NULL, '2021-06-16 04:21:07'),
(8, 'pythonやろうぜ！', '読書会やります！', '本を持ち寄って、ボイチャで語り合いましょう！', 'shinji', NULL, NULL, '2021-06-16 05:36:58');

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
  ADD PRIMARY KEY (`com_id`),
  ADD UNIQUE KEY `com_name` (`com_name`);

--
-- テーブルのインデックス `com_recom_book`
--
ALTER TABLE `com_recom_book`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `com_usr_table`
--
ALTER TABLE `com_usr_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `fav_book_table`
--
ALTER TABLE `fav_book_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `friend_table`
--
ALTER TABLE `friend_table`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_send` (`name_send`,`name_recieve`);

--
-- テーブルのインデックス `msg_table`
--
ALTER TABLE `msg_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `res_table`
--
ALTER TABLE `res_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `thread_table`
--
ALTER TABLE `thread_table`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `com_name` (`com_name`,`thread_title`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `bs_book_table`
--
ALTER TABLE `bs_book_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- テーブルの AUTO_INCREMENT `bs_usr_table`
--
ALTER TABLE `bs_usr_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- テーブルの AUTO_INCREMENT `community_table`
--
ALTER TABLE `community_table`
  MODIFY `com_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- テーブルの AUTO_INCREMENT `com_recom_book`
--
ALTER TABLE `com_recom_book`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルの AUTO_INCREMENT `com_usr_table`
--
ALTER TABLE `com_usr_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- テーブルの AUTO_INCREMENT `fav_book_table`
--
ALTER TABLE `fav_book_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- テーブルの AUTO_INCREMENT `friend_table`
--
ALTER TABLE `friend_table`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- テーブルの AUTO_INCREMENT `msg_table`
--
ALTER TABLE `msg_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- テーブルの AUTO_INCREMENT `res_table`
--
ALTER TABLE `res_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- テーブルの AUTO_INCREMENT `thread_table`
--
ALTER TABLE `thread_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
