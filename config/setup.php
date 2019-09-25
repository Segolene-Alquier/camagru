<?php
	require_once 'database.php';

	try {

		$bdd = new PDO($DB_HOST, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "
		SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
		SET AUTOCOMMIT = 0;
		START TRANSACTION;
		SET time_zone = '+00:00';


		/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
		/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
		/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
		/*!40101 SET NAMES utf8mb4 */;

		--
		-- Database: `camagru`
		--

		-- --------------------------------------------------------

		--
		-- Table structure for table `comment`
		--

		CREATE TABLE `comment` (
		`id` int(255) NOT NULL,
		`content` text NOT NULL,
		`image` int(255) NOT NULL,
		`user` int(255) NOT NULL,
		`username` varchar(255) NOT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;

		--
		-- Dumping data for table `comment`
		--

		INSERT INTO `comment` (`id`, `content`, `image`, `user`, `username`) VALUES
		(1, 'jfkdsjwf', 59, 17, 'Segogo'),
		(2, 'woof woof', 58, 17, 'Segogo'),
		(3, 'qweqwe', 60, 17, 'Segogo'),
		(4, 'erererer', 60, 17, 'Segogo'),
		(5, 'htqwtewtew', 60, 17, 'Segogo'),
		(6, '34324', 60, 17, 'Segogo'),
		(7, 'qweqwe', 60, 17, 'Segogo'),
		(8, 'ewqqweeqw', 60, 17, 'Segogo'),
		(9, 'frewr', 60, 17, 'Segogo'),
		(10, 'rqwerw', 60, 17, 'Segogo'),
		(11, 'qweqwe', 60, 17, 'Segogo'),
		(13, 'kikou', 60, 17, 'Segogo'),
		(14, 'hello hello', 60, 17, 'Segogo'),
		(15, 'bonjour bonjour', 60, 17, 'Segogo'),
		(16, 'please work', 60, 17, 'Segogo'),
		(17, 'yannourt mimi', 60, 17, 'Segogo'),
		(18, 'Sebiiiii <3', 60, 17, 'Segogo'),
		(25, 'coucou ', 61, 17, 'Segogo'),
		(26, 'test', 61, 17, 'Segogo'),
		(27, 'Oh les mimous', 66, 17, 'Segogo'),
		(28, 'So much love', 66, 17, 'Segogo'),
		(29, 'Kikou belle gosse', 65, 17, 'Segogo'),
		(30, 'Almost there, hang on', 63, 17, 'Segogo'),
		(31, 'Koi 2 9 ?', 65, 17, 'Segogo'),
		(32, 'Bravo', 66, 17, 'Segogo'),
		(33, 'Trop miiiimz', 66, 17, 'Segogo'),
		(34, 'sexyyy', 65, 17, 'Segogo'),
		(35, 'wahouu', 66, 17, 'Segogo'),
		(36, 'youtube.com/c/FromKtoM', 69, 17, 'Segogo'),
		(37, '<script>alert(\"vouvou\")</script>', 82, 17, 'Segogo'),
		(38, '<script>alert(\"vouvou\")</script>', 82, 17, 'Segogo'),
		(39, '<script>alert(\"vouvou\");</script>', 82, 17, 'Segogo'),
		(40, '<script>alert(\"vouvou\");</script>', 82, 17, 'Segogo'),
		(41, '<script>alert(\"vouvou\");</script>', 82, 17, 'Segogo'),
		(42, '<script>alert(\"vouvou\");</script>', 82, 17, 'Segogo'),
		(43, 'coucou<script>prompt()</script>', 82, 17, 'Segogo'),
		(44, 'coucou<script>prompt()</script>', 82, 17, 'Segogo'),
		(45, '<script>console.log(2)</script>', 82, 17, 'Segogo'),
		(46, 'ddd', 82, 17, 'Segogo'),
		(47, 'eval(var_dump($_SESSION));)', 82, 17, 'Segogo'),
		(48, '<script>console.log(\'coucou\')</script>', 3, 17, 'Segogo'),
		(49, '<script>console.log(\'coucou\')</script>', 3, 17, 'Segogo'),
		(50, '<script>console.log(\'coucou\')</script>', 3, 17, 'Segogo'),
		(51, '<script>console.log(\'coucou\')</script>', 3, 17, 'Segogo'),
		(52, 'dd', 3, 17, 'Segogo'),
		(53, 'ddd', 3, 17, 'Segogo'),
		(54, 'ddd', 3, 17, 'Segogo'),
		(65, 'sexy', 82, 28, 'Segolene'),
		(66, 'hello there', 93, 17, 'Segogo'),
		(67, 'yooo', 93, 17, 'Segogo'),
		(68, 'tyuuty', 93, 28, 'Segolene'),
		(69, 'hkjhkl', 82, 28, 'Segolene'),
		(72, 'trop mims', 94, 17, 'Segogo'),
		(73, 'hello', 93, 17, 'Segogo'),
		(74, 'hello', 94, 29, 'Salquier'),
		(75, 'mamineeeette', 95, 29, 'Salquier'),
		(76, 'la plus woof woof', 95, 29, 'Salquier'),
		(77, 'peace gurl', 96, 30, 'Salquier');

		-- --------------------------------------------------------

		--
		-- Table structure for table `image`
		--

		CREATE TABLE `image` (
		`id` int(255) NOT NULL,
		`file` varchar(200) NOT NULL,
		`date` datetime NOT NULL,
		`likes` int(255) NOT NULL,
		`user` int(255) NOT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;

		--
		-- Dumping data for table `image`
		--

		INSERT INTO `image` (`id`, `file`, `date`, `likes`, `user`) VALUES
		(1, '../uploads/25/1565003412-5d480e94a90f4.jpg', '0000-00-00 00:00:00', 0, 25),
		(2, '../uploads/25/1565003446-5d480eb6893ad.jpg', '0000-00-00 00:00:00', 0, 25),
		(3, '../uploads/25/1565003541-5d480f150dcde.jpg', '0000-00-00 00:00:00', 0, 25),
		(4, '../uploads/25/1565003827-5d481033aac2c.jpg', '2019-08-05 00:00:00', 0, 25),
		(5, '../uploads/25/1565003848-5d48104821b8e.jpg', '2019-08-05 00:00:00', 0, 25),
		(6, '../uploads/25/1565003933-5d48109d8798a.jpg', '2019-08-05 04:18:53', 0, 25),
		(7, '../uploads/25/1565003964-5d4810bc44688.jpg', '2019-08-05 04:19:24', 0, 25),
		(8, '../uploads/25/1565003972-5d4810c45c990.jpg', '2019-08-05 04:19:32', 0, 25),
		(9, '../uploads/25/1565005554-5d4816f28a46d.jpg', '2019-08-05 04:45:54', 0, 25),
		(10, '../uploads/25/1565005576-5d481708cb186.jpg', '2019-08-05 04:46:16', 0, 25),
		(11, '../uploads/25/1565005675-5d48176bc3c9c.jpg', '2019-08-05 04:47:55', 0, 25),
		(12, '../uploads/25/1565005711-5d48178fe6dfc.jpg', '2019-08-05 04:48:31', 0, 25),
		(13, '../uploads/25/1565005801-5d4817e92b82e.jpg', '2019-08-05 04:50:01', 0, 25),
		(14, '../uploads/25/1565005808-5d4817f076a3a.jpg', '2019-08-05 04:50:08', 0, 25),
		(15, '../uploads/25/1565005846-5d4818166d499.jpg', '2019-08-05 04:50:46', 0, 25),
		(16, '../uploads/25/1565005870-5d48182e9e048.jpg', '2019-08-05 04:51:10', 0, 25),
		(17, '../uploads/25/1565005937-5d481871992fb.jpg', '2019-08-05 04:52:17', 0, 25),
		(18, '../uploads/25/1565005960-5d48188854872.jpg', '2019-08-05 04:52:40', 0, 25),
		(19, '../uploads/25/1565005985-5d4818a13e119.jpg', '2019-08-05 04:53:05', 0, 25),
		(20, '../uploads/25/1565005988-5d4818a4d5e1d.jpg', '2019-08-05 04:53:08', 0, 25),
		(21, '../uploads/25/1565006010-5d4818ba1334d.jpg', '2019-08-05 04:53:30', 0, 25),
		(22, '../uploads/25/1565006148-5d481944af5c5.jpg', '2019-08-05 04:55:48', 0, 25),
		(23, '../uploads/25/1565006174-5d48195e8547d.jpg', '2019-08-05 04:56:14', 0, 25),
		(24, '../uploads/25/1565006185-5d48196989679.jpg', '2019-08-05 04:56:25', 0, 25),
		(26, '../uploads/25/1565006261-5d4819b519509.jpg', '2019-08-05 04:57:41', 0, 25),
		(27, '../uploads/25/1565006473-5d481a89c61c0.jpg', '2019-08-05 05:01:13', 0, 25),
		(29, '../uploads/25/1565006589-5d481afdf30d4.jpg', '2019-08-05 05:03:10', 0, 25),
		(30, '../uploads/25/1565007056-5d481cd030bcd.jpg', '2019-08-05 05:10:56', 0, 25),
		(31, '../uploads/25/1565007069-5d481cdd32224.jpg', '2019-08-05 05:11:09', 0, 25),
		(32, '../uploads/25/1565007549-5d481ebde183a.jpg', '2019-08-05 05:19:09', 0, 25),
		(33, '../uploads/25/1565007594-5d481eea0f6a9.jpg', '2019-08-05 05:19:54', 0, 25),
		(34, '../uploads/25/1565007614-5d481efeaa9a0.jpg', '2019-08-05 05:20:14', 0, 25),
		(43, '../uploads/17/1565012939-5d4833cb13cff.jpg', '2019-08-05 06:48:59', 0, 17),
		(44, '../uploads/17/1565013379-5d4835835683d.jpg', '2019-08-05 06:56:19', 0, 17),
		(45, '../uploads/17/1565013534-5d48361e73927.jpg', '2019-08-05 06:58:54', 0, 17),
		(46, '../uploads/17/1565013723-5d4836dbe45e6.jpg', '2019-08-05 07:02:03', 0, 17),
		(47, '../uploads/17/1565013795-5d483723b81fa.jpg', '2019-08-05 07:03:15', 0, 17),
		(48, '../uploads/17/1565014057-5d48382997f22.jpg', '2019-08-05 07:07:37', 0, 17),
		(49, '../uploads/17/1565014136-5d483878a064d.jpg', '2019-08-05 07:08:56', 0, 17),
		(50, '../uploads/17/1565014226-5d4838d2c7383.jpg', '2019-08-05 07:10:26', 0, 17),
		(56, '../uploads/25/1565098969-5d4983d9cf588.jpg', '2019-08-06 06:42:49', 0, 25),
		(57, '../uploads/25/1565099732-5d4986d44c22b.jpg', '2019-08-06 06:55:32', 0, 25),
		(58, '../uploads/25/1565112922-5d49ba5a4a13f.jpg', '2019-08-06 10:35:22', 0, 25),
		(59, '../uploads/25/1565112934-5d49ba660b2df.jpg', '2019-08-06 10:35:34', 0, 25),
		(60, '../uploads/25/1565185991-5d4ad7c7c1687.jpg', '2019-08-07 06:53:11', 0, 25),
		(61, '../uploads/17/1566808928-5d639b60867e6.jpg', '2019-08-26 01:42:08', 0, 17),
		(62, '../uploads/17/1567601819-5d6fb49bc2658.jpg', '2019-09-04 05:56:59', 0, 17),
		(63, '../uploads/17/1567700908-5d7137ac43989.jpg', '2019-09-05 09:28:28', 0, 17),
		(64, '../uploads/17/1567704465-5d714591d72bb.jpg', '2019-09-05 10:27:45', 0, 17),
		(65, '../uploads/17/1567714694-5d716d86d24da.jpg', '2019-09-05 13:18:14', 0, 17),
		(66, '../uploads/17/1567871156-5d73d0b478789.jpg', '2019-09-07 08:45:56', 0, 17),
		(67, '../uploads/17/1568059655-5d76b1076d60e.jpg', '2019-09-09 13:07:35', 0, 17),
		(68, '../uploads/17/1568818326-5d82449661e21.jpg', '2019-09-18 07:52:06', 0, 17),
		(69, '../uploads/17/1568907951-5d83a2af28f32.jpg', '2019-09-19 08:45:51', 0, 17),
		(70, '../uploads/17/1568913231-5d83b74fd7ede.jpg', '2019-09-19 10:13:51', 0, 17),
		(71, '../uploads/17/1568913308-5d83b79cf35bb.jpg', '2019-09-19 10:15:09', 0, 17),
		(72, '../uploads/17/1568974297-5d84a5d9ca2ce.jpg', '2019-09-20 03:11:37', 0, 17),
		(73, '../uploads/17/1568975833-5d84abd924daf.jpg', '2019-09-20 03:37:13', 0, 17),
		(74, '../uploads/17/1568976212-5d84ad546d935.jpg', '2019-09-20 03:43:32', 0, 17),
		(77, '../uploads/17/1569069117-5d86183d118a8.jpg', '2019-09-21 05:31:57', 0, 17),
		(79, '../uploads/17/1569073664-5d862a00d1d8c.jpg', '2019-09-21 06:47:44', 0, 17),
		(80, '../uploads/17/1569073700-5d862a241f768.jpg', '2019-09-21 06:48:20', 0, 17),
		(81, '../uploads/17/1569073705-5d862a295e046.jpg', '2019-09-21 06:48:25', 0, 17),
		(82, '../uploads/17/1569076346-5d86347a2bee8.jpg', '2019-09-21 07:32:26', 0, 17),
		(93, '../uploads/28/1569334852-5d8a26449aaef.jpg', '2019-09-24 07:20:52', 0, 28),
		(94, '../uploads/17/1569404607-5d8b36bf53b0a.jpg', '2019-09-25 02:43:27', 0, 17),
		(95, '../uploads/29/1569405650-5d8b3ad22e44b.jpg', '2019-09-25 03:00:50', 0, 29),
		(96, '../uploads/29/1569405685-5d8b3af5f0f78.jpg', '2019-09-25 03:01:26', 0, 29),
		(98, '../uploads/30/1569415013-5d8b5f6502b33.jpg', '2019-09-25 05:36:53', 0, 30);

		-- --------------------------------------------------------

		--
		-- Table structure for table `liked_photos`
		--

		CREATE TABLE `liked_photos` (
		`id` int(11) NOT NULL,
		`user_id` int(11) NOT NULL,
		`image_id` int(11) NOT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;

		--
		-- Dumping data for table `liked_photos`
		--

		INSERT INTO `liked_photos` (`id`, `user_id`, `image_id`) VALUES
		(95, 17, 5),
		(108, 25, 62),
		(144, 25, 61),
		(147, 17, 22),
		(149, 17, 57),
		(155, 17, 6),
		(158, 17, 1),
		(168, 17, 59),
		(169, 17, 58),
		(355, 17, 61),
		(369, 25, 64),
		(370, 22, 64),
		(403, 17, 62),
		(404, 17, 63),
		(410, 17, 56),
		(416, 17, 60),
		(418, 17, 64),
		(421, 17, 67),
		(424, 17, 65),
		(425, 17, 68),
		(433, 17, 66),
		(435, 17, 80),
		(436, 28, 82),
		(437, 17, 79),
		(440, 17, 94),
		(441, 17, 93),
		(443, 29, 94),
		(444, 29, 95),
		(445, 30, 96);

		-- --------------------------------------------------------

		--
		-- Table structure for table `user`
		--

		CREATE TABLE `user` (
		`UserID` int(11) NOT NULL,
		`Username` varchar(20) NOT NULL,
		`Passwd` varchar(255) NOT NULL,
		`Email` varchar(255) NOT NULL,
		`Confirmed` tinyint(1) NOT NULL DEFAULT '0',
		`Cle` varchar(32) NOT NULL,
		`Reset` varchar(32) NOT NULL,
		`notification` tinyint(1) NOT NULL DEFAULT '1'
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;

		--
		-- Dumping data for table `user`
		--

		INSERT INTO `user` (`UserID`, `Username`, `Passwd`, `Email`, `Confirmed`, `Cle`, `Reset`, `notification`) VALUES
		(17, 'Segogo', '$2y$10$T5PlrrDbbEzbmFzaVQYvqe.rb7PMK0aA4vfLzx4Fnqx.tNauH31Vq', 'segolene.alquier@kikou.com', 1, '06ee51b03fc25d6033132191d24089e7', '318cc37adb03ff9ab9d47473734a5c43', 0),
		(22, 'Sego', '$2y$10$lmeL/chXZZ3A3QqdJe8ICumF1zH/vSfr.cC6s/0Z3rulg9DrHkpqe', 'segolene.alquier@coucou.com', 1, '6fcb24559c1c47ba94cfd5a7f4d0a3a0', '4be1df8c8aa87d0ee54d768cb16734be', 1),
		(25, 'Seg', '$2y$10$az4sSPLQa25B6x23j.LXSOis60riTF4.0g7LSjAC5liei9LVYkq8i', 'segolene_38@hotmail.fr', 1, 'd91bb379e6e0d2ffce4c18c7b9f2c5e4', '', 1),
		(28, 'Segolene', '$2y$10$Gw2OXp42eZw4Y/eUXAWTSueLvY8yTKgSF.dDgZeEAWr07l2AjoQFm', 'segolene.alquier@ya.com', 1, '674a9b45f3ef8cc34ec17726fb765557', '1fc62edeb503bba0989711d481c6d675', 0),
		(29, 'Smogo', '$2y$10$LDiQbNf.NZsZd3AL3f4aHujdpnQIC/rb7soTGRJ9rJT.hxKiFegU.', 'segolene@yopmail.com', 1, 'de9dd873f8caae3b765ddb09ae8caf51', '', 0),
		(30, 'Fiona', '$2y$10$sA1pQauN5m8FgfdKK0XAQuc/c05PTy/tuz6BVMoizw527CYLBm1x.', 'test@yopmail.com', 1, 'e72ed0b954cf023875f9c02ad626a291', '', 1);

		--
		-- Indexes for dumped tables
		--

		--
		-- Indexes for table `comment`
		--
		ALTER TABLE `comment`
		ADD PRIMARY KEY (`id`),
		ADD KEY `user` (`user`),
		ADD KEY `comment_ibfk_1` (`image`);

		--
		-- Indexes for table `image`
		--
		ALTER TABLE `image`
		ADD PRIMARY KEY (`id`),
		ADD KEY `user` (`user`);

		--
		-- Indexes for table `liked_photos`
		--
		ALTER TABLE `liked_photos`
		ADD PRIMARY KEY (`id`),
		ADD KEY `user_id` (`user_id`),
		ADD KEY `liked_photos_ibfk_2` (`image_id`);

		--
		-- Indexes for table `user`
		--
		ALTER TABLE `user`
		ADD PRIMARY KEY (`UserID`);

		--
		-- AUTO_INCREMENT for dumped tables
		--

		--
		-- AUTO_INCREMENT for table `comment`
		--
		ALTER TABLE `comment`
		MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

		--
		-- AUTO_INCREMENT for table `image`
		--
		ALTER TABLE `image`
		MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

		--
		-- AUTO_INCREMENT for table `liked_photos`
		--
		ALTER TABLE `liked_photos`
		MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=447;

		--
		-- AUTO_INCREMENT for table `user`
		--
		ALTER TABLE `user`
		MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

		--
		-- Constraints for dumped tables
		--

		--
		-- Constraints for table `comment`
		--
		ALTER TABLE `comment`
		ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`image`) REFERENCES `image` (`id`) ON DELETE CASCADE,
		ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user`) REFERENCES `user` (`UserID`);

		--
		-- Constraints for table `image`
		--
		ALTER TABLE `image`
		ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`UserID`);

		--
		-- Constraints for table `liked_photos`
		--
		ALTER TABLE `liked_photos`
		ADD CONSTRAINT `liked_photos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`UserID`),
		ADD CONSTRAINT `liked_photos_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`) ON DELETE CASCADE;
		COMMIT;

		/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
		/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
		/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
		";
		$query = $bdd->prepare($sql);
		if ($query->execute())
			echo "base de donnée créée";
	}
	catch(exception $e) {
		die('Erreur '.$e->getMessage());
	}
	// $reponse = $bdd->query('SELECT * FROM user');
	// $reponse->closeCursor();
?>
