-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2018 at 12:25 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodie`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `commentID` int(11) NOT NULL,
  `foodID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `text` varchar(500) CHARACTER SET latin1 NOT NULL,
  `noti` tinyint(1) NOT NULL,
  `food_user_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentID`, `foodID`, `userID`, `text`, `noti`, `food_user_ID`) VALUES
(108, 99, 4, 'it looks yummy!', 0, 7),
(111, 100, 7, 'aaaa', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `comment_reply`
--

CREATE TABLE `comment_reply` (
  `replyID` int(11) NOT NULL,
  `commentID` int(11) NOT NULL,
  `re_userID` int(11) NOT NULL,
  `text` varchar(500) NOT NULL,
  `noti` tinyint(1) NOT NULL,
  `comment_user_ID` int(11) NOT NULL,
  `foodID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment_reply`
--

INSERT INTO `comment_reply` (`replyID`, `commentID`, `re_userID`, `text`, `noti`, `comment_user_ID`, `foodID`) VALUES
(27, 111, 4, 'lol', 0, 7, 100);

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `foodID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `foodimage` varchar(255) CHARACTER SET utf32 COLLATE utf32_bin NOT NULL,
  `foodname` varchar(255) CHARACTER SET utf32 COLLATE utf32_bin NOT NULL,
  `foodnamerom` varchar(255) CHARACTER SET utf32 COLLATE utf32_bin NOT NULL,
  `foodnameeng` varchar(255) CHARACTER SET utf32 COLLATE utf32_bin NOT NULL,
  `des` varchar(255) CHARACTER SET utf32 COLLATE utf32_bin NOT NULL,
  `cooking` varchar(255) CHARACTER SET utf32 COLLATE utf32_bin NOT NULL,
  `ingreID_json` varchar(255) CHARACTER SET utf32 COLLATE utf32_bin NOT NULL,
  `ingre_string` varchar(255) CHARACTER SET utf32 COLLATE utf32_bin NOT NULL,
  `filepath` varchar(255) CHARACTER SET utf32 COLLATE utf32_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`foodID`, `userID`, `foodimage`, `foodname`, `foodnamerom`, `foodnameeng`, `des`, `cooking`, `ingreID_json`, `ingre_string`, `filepath`) VALUES
(99, 7, '../user_mono/denglihanlolicon@gmail.com/1/5a0903f11e3b29.26154079.jpg', 'Barbeque Pork', '', 'barbeque pork', '../user_mono/denglihanlolicon@gmail.com/1/7_1_des.txt', '../user_mono/denglihanlolicon@gmail.com/1/7_1_method.json', '../user_mono/denglihanlolicon@gmail.com/1/7_1_ingre.json', '[\"3\"]', '../user_mono/denglihanlolicon@gmail.com/1/'),
(100, 4, '../user_mono/pheasinchhean@gmail.com/1/5a0904e3eb3d90.63815785.jpg', 'Fried Chicken', '', 'fried chicken', '../user_mono/pheasinchhean@gmail.com/1/4_1_des.txt', '../user_mono/pheasinchhean@gmail.com/1/4_1_method.json', '../user_mono/pheasinchhean@gmail.com/1/4_1_ingre.json', '[\"10\",\"39\",\"52\",\"55\"]', '../user_mono/pheasinchhean@gmail.com/1/'),
(129, 7, '../user_mono/denglihanlolicon@gmail.com/2/5a55c2a24a32f4.22654099.jpg', 'Baked Teriyaki Chicken', '', 'baked teriyaki chicken', '../user_mono/denglihanlolicon@gmail.com/2/7_2_des.txt', '../user_mono/denglihanlolicon@gmail.com/2/7_2_method.json', '../user_mono/denglihanlolicon@gmail.com/2/7_2_ingre.json', '[\"10\",\"43\"]', '../user_mono/denglihanlolicon@gmail.com/2/');

-- --------------------------------------------------------

--
-- Table structure for table `ingredient`
--

CREATE TABLE `ingredient` (
  `ingreID` int(11) NOT NULL,
  `ingreimage` varchar(255) COLLATE utf8_bin NOT NULL,
  `ingrename` varchar(255) COLLATE utf8_bin NOT NULL,
  `ingrenamefuri` varchar(255) COLLATE utf8_bin NOT NULL,
  `ingrenamerom` varchar(255) COLLATE utf8_bin NOT NULL,
  `ingrenameeng` varchar(255) COLLATE utf8_bin NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `ingredient`
--

INSERT INTO `ingredient` (`ingreID`, `ingreimage`, `ingrename`, `ingrenamefuri`, `ingrenamerom`, `ingrenameeng`, `type`) VALUES
(1, 'eggplant.jpg', '茄子', 'なすび', 'nasubi', 'eggplant', 1),
(2, 'touhu.jpg', '豆腐', 'とうふ', 'toufu', 'tofu', 6),
(3, 'butabara.jpg', '豚バラ', 'ぶたばらにく', 'butabara', 'pork belly', 2),
(4, 'go-ya.jpg', '苦瓜', 'ゴーヤ', 'go-ya', 'bitter gourd', 1),
(5, 'daikon.jpg', '大根', 'だいこん', 'daikon', 'japanese radish', 1),
(6, 'cucumber.jpg', '胡瓜', 'きゅうり', 'kyuuri', 'cucumber', 1),
(7, 'piman.jpg', 'ピーマン', 'ぴーまん', 'pi-man', 'green pepper', 1),
(8, 'sake.jpg', '酒', 'さけ', 'sake', 'sake', 5),
(9, 'tomato.jpg', 'トマト', 'とまと', 'tomato', 'tomato', 1),
(10, 'tori.jpg', 'とりもも肉', 'とりももにく', 'torimomoniku', 'chicken thigh', 2),
(11, 'rice.jpg', '米', 'こめ', 'kome', 'rice', 6),
(12, 'ru.jpg', 'カレールー', 'かれーるー', 'kare-ru-', 'curry roux', 6),
(13, 'onion.jpg', '玉ねぎ', 'たまねぎ', 'tamanegi', 'onion', 1),
(14, 'mincedmeat.jpg', '挽き肉', 'ひきにく', 'hikiniku', 'minced meat', 2),
(15, 'milk.jpg', '牛乳', 'ぎゅうにゅう', 'gyuunyuu', 'milk', 6),
(16, 'egg.jpg', '卵', 'たまご', 'tamago', 'egg', 6),
(17, 'beef.jpg', '牛肉', 'ぎゅうにく', 'gyuuniku', 'beef', 2),
(18, 'carrot.jpg', '人参', 'にんじん', 'ninjin', 'carrot', 1),
(19, 'itokonn.jpg', '糸こんにゃく', 'いとこんにゃく', 'itokonnyaku', 'konnyaku', 6),
(20, 'potato.jpg', 'じゃがいも', 'ジャガイモ', 'jagaimo', 'potato', 1),
(21, 'azi.jpg', 'アジ', 'あじ', 'azi', 'horse mackerel', 3),
(22, 'apple.jpg', 'りんご', 'リンゴ', 'ringo', 'apple', 4),
(23, 'cowlever.jpg', 'レバー', 'ればー', 'reba-', 'lever', 2),
(24, 'grape.jpg', '葡萄', 'ぶどう', 'budou', 'grape', 4),
(25, 'peach.jpg', '桃', 'もも', 'momo', 'peach', 4),
(26, 'banana.jpg', 'バナナ', 'ばなな', 'banana', 'banana', 4),
(27, 'melon.jpg', 'メロン', 'めろん', 'meronn', 'melon', 4),
(28, 'sanma.jpg', 'サンマ', 'さんま', 'sannma', 'pike', 3),
(29, 'salmon.jpg', '鮭', 'さけ', 'sake', 'salmon', 3),
(30, 'saba.jpg', 'サバ', 'さば', 'saba', 'mackerel', 3),
(31, 'ebi.jpg', '海老', 'えび', 'ebi', 'shrimp', 3),
(32, 'ika.jpg', '烏賊', 'いか', 'ika', 'squid', 3),
(33, 'kani.jpg', '蟹', 'かに', 'kani', 'crab', 3),
(34, 'karei.jpg', '鰈', 'かれい', 'karei', 'flounder', 3),
(35, 'katuo.jpg', '鰹', 'かつお', 'katuo', 'bonito', 3),
(36, 'maguro.jpg', '鮪', 'まぐろ', 'maguro', 'tuna', 3),
(37, 'be-kon.jpg', 'ベーコン', 'べーこん', 'be-kon', 'bacon', 2),
(38, 'hamu.jpg', 'ハム', 'はむ', 'hamu', 'ham', 2),
(39, 'komugiko.jpg', '小麦粉', 'こむぎこ', 'komugiko', 'flour', 5),
(40, 'uxinna-.jpg', 'ウィンナー', 'ソーセージ', 'uxinna-', 'wiener', 2),
(41, 'eringi.jpg', 'エリンギ', 'えりんぎ', 'eringi', 'ellinghi', 1),
(42, 'moyasi.jpg', 'もやし', 'もやし', 'moyasi', 'bean sprouts', 1),
(43, 'negi.jpg', '長ネギ', 'ながねぎ', 'naganegi', 'japanese leek', 1),
(44, 'nira.jpg', 'ニラ', 'にら', 'nira', 'leek', 1),
(45, 'siitake.jpg', '椎茸', 'しいたけ', 'iitake', 'shiitake', 1),
(46, 'teba.jpg', '手羽肉', 'てばにく', 'tebaniku', 'wing chicken', 2),
(47, 'retasu.jpg', 'レタス', 'れたす', 'retasu', 'lettuce', 1),
(48, 'kyabetu.jpg', 'キャベツ', 'きゃべつ', 'kyabetu', 'cabbage', 1),
(49, 'hakusai.jpg', '白菜', 'はくさい', 'hakusai', 'chinese cabbage', 1),
(50, 'su.jpg', '酢', 'す', 'su', 'vinegar', 5),
(51, 'syouyu.jpg', '醤油', 'しょうゆ', 'syouyu', 'soysauce', 5),
(52, 'satou.jpg', '砂糖', 'さとう', 'satou', 'sugar', 5),
(53, 'mirin.jpg', 'みりん', '味醂', 'mirin', 'sweet sake', 5),
(54, 'miso.jpg', '味噌', 'みそ', 'miso', 'miso', 5),
(55, 'sio.jpg', '塩', 'しお', 'sio', 'salt', 5),
(56, 'goma.jpg', '胡麻', 'ごま', 'goma', 'sesame', 5),
(57, 'asuparagasu.jpg', 'アスパラガス', 'あすぱらがす', 'asuparagasu', 'asparagus', 1),
(58, 'edamame.jpg', '枝豆', 'えだまめ', 'edamame', 'edamame', 1),
(59, 'enoki.jpg', 'えのき茸', 'えのき', 'enoki', 'enoki mushroom', 1),
(60, 'gobou.jpg', 'ごぼう', '牛蒡', 'gobou', 'burdock', 1),
(61, 'hourensou.jpg', 'ほうれん草', 'ホウレンソウ', 'hourensou', 'spinach', 1),
(62, 'kabotya.jpg', '南瓜', 'かぼちゃ', 'kabotya', 'pumpkin', 1),
(63, 'kabu.jpg', 'カブ', 'かぶ', 'kabu', 'turnip', 1),
(64, 'kaiware.jpg', 'かいわれ大根', 'かいわれだいこん', 'kaiwaredaikon', 'daikon radish', 1),
(65, 'karihurawa-.jpg', 'カリフラワー', 'かりふらわー', 'karihurawa-', 'cauliflower', 1),
(66, 'komatuna.jpg', '小松菜', 'こまつな', 'komatuna', 'komatuna', 1),
(67, 'massyuru-mu.jpg', 'マッシュルーム', 'まっしゅるーむ', 'massyuru-mu', 'mushroom', 1),
(68, 'myouga.jpg', 'ミョウガ', 'みょうが', 'myouga', 'ginger', 1),
(69, 'okura.jpg', 'オクラ', 'おくら', 'okura', 'okra', 1),
(70, 'renkon.jpg', '蓮根', 'レンコン', 'renkon', 'lotus root', 1),
(71, 'sisitou.jpg', '獅子唐', 'ししとう', 'sisitou', 'green pepper', 1),
(72, 'takenoko.jpg', '筍', 'たけのこ', 'takenoko', 'bamboo shoots', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `active` int(10) NOT NULL,
  `food_id_json` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `email`, `password`, `hash`, `active`, `food_id_json`) VALUES
(4, 'gamer1', 'pheasinchhean@gmail.com', '$2y$10$fRKSOGFvk.NS8Kek0AX/lOAxi7/ZvDafOinTCbfpJpTMJF.MS/0Ge', 'c3e878e27f52e2a57ace4d9a76fd9acf', 1, ''),
(6, 'cutegirl', '\0sambath.rachana88@gmail.com', '$2y$10$bH5z9yUcsF4UdKaIpKPqgeQmCsa5QzYoNUEMmIB3s07F7qEEqmiXK', 'f7e9050c92a851b0016442ab604b0488', 1, ''),
(7, 'gamer2', 'denglihanlolicon@gmail.com', '$2y$10$/ykufZB5/kbFxsyl8jOG3uoHqvlO25l6sruBG2AwL8td1XZ/Eoka6', '5705e1164a8394aace6018e27d20d237', 1, ''),
(8, 'mitsui', 'mitsui1508@gmail.com', '$2y$10$mF3XeuDJm0SSrTVykOr.Aeg5eYCYYncpZskeaOzLxOlRbSQF8P/oC', '70c639df5e30bdee440e4cdf599fec2b', 1, ' 101 111'),
(10, '\0aaaaa', '\0m5047279691@dqnwara.com', '$2y$10$z3NfI9.NCW4wkOu8bIBOT.lwSAba.lIa7ZSdRcC.a2xhul1lcM88C', '63923f49e5241343aa7acb6a06a751e7', 1, '\0 96'),
(15, '\0yuto826', 'yuto826826@gmail.com', '$2y$10$aHeB6K7RaR0O1LhtypfMxeXWAkYQJygwwkg6Rj5n8.ASMgUXO40vy', 'fec8d47d412bcbeece3d9128ae855a7a', 1, ''),
(19, 'gamer3', 'chheansin1@gmail.com', '$2y$10$InuiCMyX8o5bPYoI94nzsO/DTtVk.kexO50aCiQ0iaysuoXYAePpK', '168908dd3227b8358eababa07fcaf091', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`commentID`,`foodID`,`userID`),
  ADD KEY `foodID` (`foodID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `comment_reply`
--
ALTER TABLE `comment_reply`
  ADD PRIMARY KEY (`replyID`,`commentID`,`re_userID`),
  ADD KEY `commentID` (`commentID`),
  ADD KEY `re_userID` (`re_userID`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`foodID`,`userID`) USING BTREE,
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`ingreID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `comment_reply`
--
ALTER TABLE `comment_reply`
  MODIFY `replyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `foodID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `ingreID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`foodID`) REFERENCES `food` (`foodID`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `comment_reply`
--
ALTER TABLE `comment_reply`
  ADD CONSTRAINT `comment_reply_ibfk_1` FOREIGN KEY (`commentID`) REFERENCES `comment` (`commentID`),
  ADD CONSTRAINT `comment_reply_ibfk_2` FOREIGN KEY (`re_userID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `food_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
