-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  sam. 22 juin 2019 à 11:03
-- Version du serveur :  5.6.43
-- Version de PHP :  5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `camagru`
--

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Passwd` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `Cle` varchar(32) NOT NULL,
  `Reset` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`UserID`, `Username`, `Passwd`, `Email`, `Confirmed`, `Cle`, `Reset`) VALUES
(11, 'yannourt', '$2y$10$tYkc3hRHVuBCGqIHdh8d0u9IIRJ9YhrB4FUnSIAkq5E0EWCd1B7cm', 'yannourt@yopmail.com', 0, '', 'eb3b7dfe1e8c8ea81b21a03e67a10d9a'),
(12, 'Sego', '$2y$10$Ewn2.9jpSt5hxa.1BY8pDOy3fQEZ/IOv3R1EmUz8YAF.k4qeu4Hju', 'segolene.alquier@yahoo.com', 0, '', '85ad867a04e0ad46403cc71f2e8a0a06'),
(13, 'Test', '$2y$10$R6BW2PNdCk4N7Cf6L4Yp0eVE6yncQil7L4VLPFacA6EZ5F.oIju4.', 'test@yopmail.com', 0, '19caf9bdb02799c6f1426864691c27b7', '8364c4621fc2dcc10aa90a71fda7cc36'),
(14, 'Mail', '$2y$10$WrZfYFu5DHeXvHsmC9ue6.MwCpFJKw7JX68dD9XC7UH6oRkUM9oFi', 'segolene.alquier@yahoo.com', 0, 'efa95b0fbd8df9b1c9be994a0edf5343', '85ad867a04e0ad46403cc71f2e8a0a06'),
(15, 'test2', '$2y$10$iBd2CK0CnE1AHp7G/BKg1e.nGSkK4pf/OL9p7T/ofCZVLDQZlf05y', 'segolene.alquier@yahoo.com', 0, 'be262758820a3b302dd2cbea45bf8a3a', '85ad867a04e0ad46403cc71f2e8a0a06'),
(16, 'Test3', '$2y$10$L6URcHL0NBvStmn9sjMLG.aXg6il/yzVLq5siQgKgDGjUgd6s7Tay', 'segolene.alquier@yahoo.com', 1, 'bbe4743677aa0dc7472a125e58522566', '85ad867a04e0ad46403cc71f2e8a0a06'),
(17, 'Segogo', '$2y$10$wqkhEcIRukQl9iKhH2cFBObeLttGS0HLCrWGFR2h139/7wHDjbcTi', 'segolene.alquier@gmail.com', 1, '06ee51b03fc25d6033132191d24089e7', '0e00144dc1cb1581c1b491abe9b6156b'),
(18, 'test4', '$2y$10$0UKRCeoYGvm3ceE3HvSpEu1xTEbyxGP1WmrYGaysiBLnFHS8HPwSe', 'segolene.alquier@yahoo.com', 0, '7d1de062ae7b1432d337f61ae963b22e', ''),
(19, 'test5', '$2y$10$DuinP7A11heoIQfU3TyCeOE3gmGVsi81yzTkO.IO9zusUOe1aW8VG', 'segolene.alquier@yahoo.con', 0, 'ea604cf06372e7dcd0393d5bee55749d', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
