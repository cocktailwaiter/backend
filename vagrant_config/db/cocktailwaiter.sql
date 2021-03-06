# ************************************************************
# Sequel Pro SQL dump
# Version 5438
#
# https://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.7.23)
# Database: cocktailwaiter
# Generation Time: 2019-05-24 04:59:26 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

create database cocktailwaiter;

use cocktailwaiter;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";



# Dump of table cocktail_tag
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cocktail_tag`;

CREATE TABLE `cocktail_tag` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `cocktail_id` int(8) unsigned NOT NULL,
  `tag_id` int(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cocktail_id` (`cocktail_id`,`tag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=737 DEFAULT CHARSET=utf8;

-- LOCK TABLES `cocktail_tag` WRITE;
-- /*!40000 ALTER TABLE `cocktail_tag` DISABLE KEYS */;

-- INSERT INTO `cocktail_tag` (`id`, `cocktail_id`, `tag_id`)
-- VALUES
-- 	(1,1,1),
-- 	(2,1,4),
-- 	(701,3,49),
-- 	(702,3,50),
-- 	(703,3,52),
-- 	(706,4,49),
-- 	(707,4,50),
-- 	(708,4,55),
-- 	(709,4,56),
-- 	(711,5,49),
-- 	(712,5,52),
-- 	(713,5,54),
-- 	(710,5,57),
-- 	(714,6,49),
-- 	(715,6,57),
-- 	(716,6,58),
-- 	(717,6,59),
-- 	(718,6,60),
-- 	(719,7,49),
-- 	(720,7,61),
-- 	(721,7,62),
-- 	(723,10,61),
-- 	(722,10,63),
-- 	(727,13,50),
-- 	(729,13,56),
-- 	(728,13,64),
-- 	(730,13,65),
-- 	(731,13,66),
-- 	(735,14,54),
-- 	(732,14,57),
-- 	(733,14,64),
-- 	(734,14,67),
-- 	(736,14,68),
-- 	(725,237,52),
-- 	(726,237,54),
-- 	(724,237,57),
-- 	(5,334,1),
-- 	(3,334,5),
-- 	(4,334,6),
-- 	(694,334,51),
-- 	(695,334,52),
-- 	(696,334,55),
-- 	(697,334,64),
-- 	(692,334,84),
-- 	(693,334,85),
-- 	(698,577,49),
-- 	(699,577,50),
-- 	(700,577,51),
-- 	(704,578,53),
-- 	(705,578,54);

-- /*!40000 ALTER TABLE `cocktail_tag` ENABLE KEYS */;
-- UNLOCK TABLES;


# Dump of table cocktails
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cocktails`;

CREATE TABLE `cocktails` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'カクテル',
  `name` varchar(64) NOT NULL DEFAULT '' COMMENT 'カクテル名',
  `search_name` varchar(64) NOT NULL COMMENT '検索用カクテル名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=579 DEFAULT CHARSET=utf8 COMMENT='カクテル';

-- LOCK TABLES `cocktails` WRITE;
-- /*!40000 ALTER TABLE `cocktails` DISABLE KEYS */;

-- INSERT INTO `cocktails` (`id`, `name`, `search_name`)
-- VALUES
-- 	(1,'シャンディー・ガフ',''),
-- 	(2,'ダイキリ',''),
-- 	(3,'マティーニ',''),
-- 	(4,'マルガリータ',''),
-- 	(5,'ギムレット',''),
-- 	(6,'マンハッタン',''),
-- 	(7,'サイドカー',''),
-- 	(8,'アレキサンダー',''),
-- 	(9,'ホワイト・レディー',''),
-- 	(10,'バレンシア',''),
-- 	(11,'バラライカ',''),
-- 	(12,'ジントニック',''),
-- 	(13,'ソルティ・ドッグ',''),
-- 	(14,'モスコー・ミュール',''),
-- 	(15,'シンガポール・スリング',''),
-- 	(16,'カンパリ・ソーダ',''),
-- 	(17,'モヒート',''),
-- 	(18,'ファジーネーブル',''),
-- 	(19,'スプモーニ',''),
-- 	(20,'スクリュー・ドライバー',''),
-- 	(21,'スノー・ボール',''),
-- 	(22,'ミモザ',''),
-- 	(23,'ベリーニ',''),
-- 	(24,'テキーラ・サンライズ',''),
-- 	(25,'レッドアイ',''),
-- 	(26,'プース・カフェ',''),
-- 	(27,'ジンバック',''),
-- 	(28,'ブルドッグ',''),
-- 	(29,'ブレイブ・ブル',''),
-- 	(30,'メキシカン',''),
-- 	(31,'カルーア・ミルク',''),
-- 	(32,'カルーア・ウーロン',''),
-- 	(33,'カシス・オレンジ',''),
-- 	(34,'カシス・ウーロン',''),
-- 	(35,'レゲエパンチ',''),
-- 	(36,'ネグローニ',''),
-- 	(37,'キール・ロワイヤル',''),
-- 	(38,'サングリア',''),
-- 	(39,'アレクサンダー',''),
-- 	(112,'B&B',''),
-- 	(113,'X-Y-Z',''),
-- 	(114,'ザザ',''),
-- 	(115,'レナ',''),
-- 	(116,'卵酒',''),
-- 	(117,'春暁',''),
-- 	(118,'雪国',''),
-- 	(119,'骨酒',''),
-- 	(120,'ひれ酒',''),
-- 	(121,'キティ',''),
-- 	(122,'キール',''),
-- 	(123,'クリス',''),
-- 	(124,'スーズ',''),
-- 	(125,'ズーム',''),
-- 	(126,'ソノラ',''),
-- 	(127,'バイア',''),
-- 	(128,'バロン',''),
-- 	(129,'本直し',''),
-- 	(130,'楊貴妃',''),
-- 	(131,'水割り',''),
-- 	(132,'舞乙女',''),
-- 	(133,'酎ハイ',''),
-- 	(134,'アカシア',''),
-- 	(135,'アドニス',''),
-- 	(136,'アラスカ',''),
-- 	(137,'アラワク',''),
-- 	(138,'カクテル',''),
-- 	(139,'カミカゼ',''),
-- 	(140,'ギブソン',''),
-- 	(141,'グロッグ',''),
-- 	(142,'コザック',''),
-- 	(143,'ザンシア',''),
-- 	(144,'シルビア',''),
-- 	(145,'ダービー',''),
-- 	(146,'ノチェロ',''),
-- 	(147,'ハンター',''),
-- 	(148,'パナシェ',''),
-- 	(149,'ビジュー',''),
-- 	(150,'フラッグ',''),
-- 	(151,'フロリダ',''),
-- 	(152,'ブラジル',''),
-- 	(153,'ポンピエ',''),
-- 	(154,'マイアミ',''),
-- 	(155,'マイタイ',''),
-- 	(156,'午後の死',''),
-- 	(157,'アカプルコ',''),
-- 	(158,'アキダクト',''),
-- 	(159,'オーガズム',''),
-- 	(160,'カルミッチ',''),
-- 	(161,'カレドニア',''),
-- 	(162,'ガリアーノ',''),
-- 	(163,'コモドール',''),
-- 	(164,'コンチータ',''),
-- 	(165,'サイドカー',''),
-- 	(166,'サングリア',''),
-- 	(167,'サンブーカ',''),
-- 	(168,'シクラメン',''),
-- 	(169,'シンデレラ',''),
-- 	(170,'ツァリーヌ',''),
-- 	(171,'ディーゼル',''),
-- 	(172,'ドランブイ',''),
-- 	(173,'ニコラシカ',''),
-- 	(174,'ネグローニ',''),
-- 	(175,'バカルディ',''),
-- 	(176,'バラライカ',''),
-- 	(177,'バーボネラ',''),
-- 	(178,'パパゲーナ',''),
-- 	(179,'ブロンクス',''),
-- 	(180,'マタドール',''),
-- 	(181,'ロブ・ロイ',''),
-- 	(182,'ヴェスパー',''),
-- 	(183,'電気ブラン',''),
-- 	(184,'青い珊瑚礁',''),
-- 	(185,'アディントン',''),
-- 	(186,'アフィニティ',''),
-- 	(187,'アブドゥーグ',''),
-- 	(188,'アメリカーノ',''),
-- 	(189,'アルゴンキン',''),
-- 	(190,'アンバサダー',''),
-- 	(191,'エクソシスト',''),
-- 	(192,'オリンピック',''),
-- 	(193,'カーディナル',''),
-- 	(194,'クレオパトラ',''),
-- 	(195,'コンカ・ドロ',''),
-- 	(196,'コンクラーベ',''),
-- 	(197,'シャムロック',''),
-- 	(198,'ジン・フィズ',''),
-- 	(199,'ジン・ライム',''),
-- 	(200,'スコーピオン',''),
-- 	(201,'スティンガー',''),
-- 	(202,'スプリッツァ',''),
-- 	(203,'スロー・ジン',''),
-- 	(204,'センチュリー',''),
-- 	(205,'ソウル・キス',''),
-- 	(206,'タワーリシチ',''),
-- 	(207,'デプス・ボム',''),
-- 	(208,'トロイの木馬',''),
-- 	(209,'ニューヨーク',''),
-- 	(210,'ノックアウト',''),
-- 	(211,'ハイ・ライフ',''),
-- 	(212,'ピンク・ジン',''),
-- 	(213,'ブルームーン',''),
-- 	(214,'ミルクセーキ',''),
-- 	(215,'ミント・ビア',''),
-- 	(216,'メロンボール',''),
-- 	(217,'モンテカルロ',''),
-- 	(218,'ミドリ・マルガリータ',''),
-- 	(219,'アップル・カー',''),
-- 	(220,'アップル・パイ',''),
-- 	(221,'アレクサンダー',''),
-- 	(222,'アースクエイク',''),
-- 	(223,'ウイズ・バング',''),
-- 	(224,'エッグ・ビール',''),
-- 	(225,'オールド・パル',''),
-- 	(226,'オーヴェルニュ',''),
-- 	(227,'カイピリーニャ',''),
-- 	(228,'カシス・ソーダ',''),
-- 	(229,'カンパリ・ビア',''),
-- 	(230,'グラスホッパー',''),
-- 	(231,'グリューワイン',''),
-- 	(232,'ケイブルグラム',''),
-- 	(233,'コスモポリタン',''),
-- 	(234,'コペンハーゲン',''),
-- 	(235,'シャンギロンゴ',''),
-- 	(236,'シー・ブリーズ',''),
-- 	(237,'ジン・トニック',''),
-- 	(238,'ジン・リッキー',''),
-- 	(239,'ソル・クバーノ',''),
-- 	(240,'ティア・マリア',''),
-- 	(241,'ディキ・ディキ',''),
-- 	(242,'トム・コリンズ',''),
-- 	(243,'ハニーサックル',''),
-- 	(244,'パンチョ・ビラ',''),
-- 	(245,'ビーズ・ニーズ',''),
-- 	(246,'フランジェリコ',''),
-- 	(247,'ブラックソーン',''),
-- 	(248,'ジャマイカ・ジョー',''),
-- 	(249,'スカイ・ダイビング',''),
-- 	(250,'ストーン・フェンス',''),
-- 	(251,'テネシー・クーラー',''),
-- 	(252,'フレンチ・カクタス',''),
-- 	(253,'ブザム・カレッサー',''),
-- 	(254,'ブラック・ルシアン',''),
-- 	(255,'ブラッディ・マリー',''),
-- 	(256,'プッシー・キャット',''),
-- 	(257,'ペイトン・プレイス',''),
-- 	(258,'ホット・イタリアン',''),
-- 	(259,'ホワイト・ルシアン',''),
-- 	(260,'ボイラー・メーカー',''),
-- 	(261,'ボストン・クーラー',''),
-- 	(262,'ボルガ・ボートマン',''),
-- 	(263,'ミント・ジュレップ',''),
-- 	(264,'ライチ・リキュール',''),
-- 	(265,'レッド・バイキング',''),
-- 	(266,'ロバート・バーンズ',''),
-- 	(267,'アイリッシュ・ミスト',''),
-- 	(268,'アップ・トゥ・デイト',''),
-- 	(269,'イエス・アンド・ノー',''),
-- 	(270,'エンジェルズ・キッス',''),
-- 	(271,'エンジェル・ウイング',''),
-- 	(272,'エンジェル・フェイス',''),
-- 	(273,'オレンジ・ブロッサム',''),
-- 	(274,'グリーン・フィールズ',''),
-- 	(275,'コープス・リバイバー',''),
-- 	(276,'ゴールデン・ドリーム',''),
-- 	(277,'ゴールデン・フレンド',''),
-- 	(278,'シトロン・ジェネヴァ',''),
-- 	(279,'シャンパン・カクテル',''),
-- 	(280,'シャーリー・テンプル',''),
-- 	(281,'スカーレット・レディ',''),
-- 	(282,'チェリー・ブロッサム',''),
-- 	(283,'ティフィン・タイガー',''),
-- 	(284,'テキーラ・サンセット',''),
-- 	(285,'ピンク・ジン・ライム',''),
-- 	(286,'ピンク・スクァーレル',''),
-- 	(287,'ピンク・パイナップル',''),
-- 	(288,'ブラック・ベルベット',''),
-- 	(289,'ブラッディ・シーザー',''),
-- 	(290,'プリンセス・メアリー',''),
-- 	(291,'プレリュード・フィズ',''),
-- 	(292,'ボヘミアン・ドリーム',''),
-- 	(293,'レール・スプリッター',''),
-- 	(294,'アイリッシュ・コーヒー',''),
-- 	(295,'アメリカン・レモネード',''),
-- 	(296,'ウイスキー・サイドカー',''),
-- 	(297,'ウォッカ・アイスバーグ',''),
-- 	(298,'キッス・オブ・ファイア',''),
-- 	(299,'キューバン・スクリュー',''),
-- 	(300,'クロンダイク・クーラー',''),
-- 	(301,'コアントロー・オレンジ',''),
-- 	(302,'コアントロー・トニック',''),
-- 	(303,'ゴールデン・クリッパー',''),
-- 	(304,'ゴールデン・スリッパー',''),
-- 	(305,'ジン・アンド・ビターズ',''),
-- 	(306,'トム・アンド・ジェリー',''),
-- 	(307,'パッセンジャー・リスト',''),
-- 	(308,'フォールン・エンジェル',''),
-- 	(309,'フランシス・アルバート',''),
-- 	(310,'ホット・バタード・ラム',''),
-- 	(311,'マグノリア・ブロッサム',''),
-- 	(312,'ムーンライト・クーラー',''),
-- 	(313,'アラウンド・ザ・ワールド',''),
-- 	(314,'インクレディブル・ハルク',''),
-- 	(315,'オールド・ファッションド',''),
-- 	(316,'キッス・イン・ザ・ダーク',''),
-- 	(317,'サンブーカ・コン・モスカ',''),
-- 	(318,'テキーラ・サンストローク',''),
-- 	(319,'ビトウィーン・ザ・シーツ',''),
-- 	(320,'ブランデー・エッグノッグ',''),
-- 	(321,'ブロードウェイ・サースト',''),
-- 	(322,'カンパリ・グレープフルーツ',''),
-- 	(323,'グラン・マルニエ・オレンジ',''),
-- 	(324,'グリーンティー・リキュール',''),
-- 	(325,'シャルトリューズ・オレンジ',''),
-- 	(326,'シャルトリューズ・トニック',''),
-- 	(327,'セックス・オン・ザ・ビーチ',''),
-- 	(328,'ハーベイ・ウォールバンガー',''),
-- 	(329,'ブラック・アンド・ホワイト',''),
-- 	(330,'ポーラー・ショート・カット',''),
-- 	(331,'グラン・マルニエ・サイドカー',''),
-- 	(332,'サザンカンフォート・スクリュー',''),
-- 	(333,'ブラッド・トランスフュージョン',''),
-- 	(334,'ロングアイランド・アイスティー',''),
-- 	(335,'イタリアン・スクリュー・ドライバー',''),
-- 	(336,'フォークランド・アイランド・ウォーマー',''),
-- 	(337,'ロングアイランド・アイスティー',''),
-- 	(578,'ベルモット','ベルモツト');

-- /*!40000 ALTER TABLE `cocktails` ENABLE KEYS */;
-- UNLOCK TABLES;


# Dump of table tag_categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tag_categories`;

CREATE TABLE `tag_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- LOCK TABLES `tag_categories` WRITE;
-- /*!40000 ALTER TABLE `tag_categories` DISABLE KEYS */;

-- INSERT INTO `tag_categories` (`id`, `name`)
-- VALUES
-- 	(1,'味'),
-- 	(2,'ベース'),
-- 	(3,'度数'),
-- 	(4,'色'),
-- 	(5,'割もの'),
-- 	(6,'テイスト'),
-- 	(7,'容器種類'),
-- 	(8,'製法');

-- /*!40000 ALTER TABLE `tag_categories` ENABLE KEYS */;
-- UNLOCK TABLES;


# Dump of table tags
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tags`;

CREATE TABLE `tags` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `tag_category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8;

-- LOCK TABLES `tags` WRITE;
-- /*!40000 ALTER TABLE `tags` DISABLE KEYS */;

-- INSERT INTO `tags` (`id`, `name`, `tag_category_id`)
-- VALUES
-- 	(1,'甘い',1),
-- 	(2,'すっきり',1),
-- 	(3,'柑橘系',1),
-- 	(4,'黄',4),
-- 	(5,'黒',4),
-- 	(6,'すごく強い',5),
-- 	(49,'強い',0),
-- 	(50,'白い',4),
-- 	(51,'ラム',0),
-- 	(52,'ジン',0),
-- 	(53,'カクテルの王様',0),
-- 	(54,'スタンダードカクテル',0),
-- 	(55,'テキーラ',0),
-- 	(56,'スノースタイル',0),
-- 	(57,'透明',4),
-- 	(58,'赤い',4),
-- 	(59,'ウィスキー',0),
-- 	(60,'カクテルの女王',0),
-- 	(61,'オレンジ',4),
-- 	(62,'ブランデー',0),
-- 	(63,'黄色',4),
-- 	(64,'ウォッカ',0),
-- 	(65,'さっぱり',0),
-- 	(66,'グレープフルーツ',0),
-- 	(67,'オールデイカクテル',0),
-- 	(68,'クーラー',0),
-- 	(71,'レディキラーカクテル',0),
-- 	(84,'レディキラー',0),
-- 	(85,'コーラ',0);

-- /*!40000 ALTER TABLE `tags` ENABLE KEYS */;
-- UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
