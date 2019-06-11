-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 09 juin 2019 à 15:56
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `oc_louvre`
--

-- --------------------------------------------------------

--
-- Structure de la table `billets`
--

DROP TABLE IF EXISTS `billets`;
CREATE TABLE IF NOT EXISTS `billets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tarif` int(11) NOT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_de_naissance` datetime NOT NULL,
  `pays` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reduit` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4FCF9B68B83297E7` (`reservation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `billets`
--

INSERT INTO `billets` (`id`, `tarif`, `reservation_id`, `nom`, `prenom`, `date_de_naissance`, `pays`, `reduit`) VALUES
(1, 16, 1, 'zsetr', 'rzzr', '1973-08-01 00:00:00', 'france', 0),
(2, 16, 2, 'aghaad', 'aghad', '1973-08-01 00:00:00', 'france', 0),
(3, 16, 3, 'fg', 'fgh', '1973-08-01 00:00:00', 'fr', 0),
(4, 16, 4, 'sdfgs', 'sgs', '1973-08-01 00:00:00', 'fr', 0),
(5, 16, 5, 'aaaa', 'aa', '1973-08-01 00:00:00', 'aaa', 0),
(6, 8, 6, 'aaa', 'aaa', '1973-08-01 00:00:00', 'aaa', 0),
(7, 16, 7, 'ddd', 'ddd', '1973-08-01 00:00:00', 'fsg', 0),
(8, 16, 8, 'aghaad', 'aghaad', '1973-08-01 00:00:00', 'fr', 0),
(9, 16, 9, 'agh', 'agh', '1973-08-01 00:00:00', 'fr', 0),
(10, 16, 10, 'zzz', 'zzz', '1973-08-01 00:00:00', 'fr', 0),
(11, 16, 11, 'sss', 'sss', '1973-08-01 00:00:00', 'fr', 0),
(12, 16, 12, 'add', 'add', '1973-08-01 00:00:00', 'fr', 0),
(13, 16, 13, 'zzz', 'zz', '1973-08-01 00:00:00', 'fr', 0),
(14, 16, 14, 'ass', 'ass', '1973-08-01 00:00:00', 'fr', 0),
(15, 16, 15, 'as', 'sa', '1973-08-01 00:00:00', 'fr', 0),
(16, 16, 16, 'AGHAAD', 'AD', '1972-08-01 00:00:00', 'FR', 0),
(17, 16, 17, 'AAA', 'AA', '1972-08-01 00:00:00', 'FR', 0),
(18, 16, 18, 'ddd', 'ddd', '1972-08-01 00:00:00', 'fr', 0),
(19, 16, 19, 'aq', 'aq', '1972-08-01 00:00:00', 'fr', 0),
(20, 12, 20, 'dd', 'dd', '0172-07-31 00:00:00', 'fr', 0),
(21, 16, 21, 'aa', 'aa', '1972-08-01 00:00:00', 'fr', 0),
(22, 16, 22, 'aaa', 'a', '1973-08-01 00:00:00', 'a', 0),
(23, 16, 23, 'aa', 'aa', '1972-08-01 00:00:00', 'aa', 0),
(24, 16, 24, 'aa', 'aa', '1972-08-01 00:00:00', 'fr', 0),
(25, 16, 25, 'test', '050619', '1972-08-01 00:00:00', 'france', 0),
(26, 16, 26, 'amrani', 'aghaad', '1973-08-01 00:00:00', 'fr', 0),
(27, 16, 27, 'stef', 'ster', '1990-08-02 00:00:00', 'fr', 0),
(28, 16, 28, 'aaa', 'aaa', '1972-08-01 00:00:00', 'fr', 0),
(29, 16, 29, 'aaa', 'aaa', '1972-08-01 00:00:00', 'fr', 0);

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20181110201351', NULL),
('20181112054220', NULL),
('20181124064246', NULL),
('20181125203347', NULL),
('20181227163724', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_reservation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_visite` datetime NOT NULL,
  `date_reservation` datetime NOT NULL,
  `nb_billets` int(11) NOT NULL,
  `mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `journee` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `num_reservation`, `date_visite`, `date_reservation`, `nb_billets`, `mail`, `journee`) VALUES
(1, '5cefa6ae322d51559209646', '2019-06-05 00:00:00', '2019-05-30 11:50:23', 1, 'aghaad@live.fr', 1),
(2, '5cefa7d9eb2af1559209945', '2019-06-03 00:00:00', '2019-05-30 11:54:45', 1, 'aghaad@live.fr', 1),
(3, '5cefa9c26bccb1559210434', '2019-05-31 00:00:00', '2019-05-30 12:01:47', 1, 'agghaad@yahoo.fr', 1),
(4, '5cefaaac88cb61559210668', '2019-05-31 00:00:00', '2019-05-30 12:34:32', 1, 'agghaad@yahoo.fr', 1),
(5, '5cefbdf7766c01559215607', '2019-05-31 00:00:00', '2019-05-30 13:37:41', 1, 'aghaad@live.fr', 1),
(6, '5ceff05753e471559228503', '2019-06-12 00:00:00', '2019-05-30 17:10:32', 1, 'aghaad@live.fr', 0),
(7, '5ceff3eb13d4c1559229419', '2019-06-03 00:00:00', '2019-05-30 17:17:33', 1, 'aghaad@live.fr', 1),
(8, '5cf019665641c1559239014', '2019-06-12 00:00:00', '2019-05-31 08:37:29', 1, 'aghaad@live.fr', 1),
(9, '5cf0d1c162e4b1559286209', '2019-05-31 00:00:00', '2019-05-31 09:03:53', 1, 'aghaad@live.fr', 1),
(10, '5cf0d9c9754721559288265', '2019-05-31 00:00:00', '2019-05-31 09:38:13', 1, 'aghaad@live.fr', 1),
(11, '5cf0de149235e1559289364', '2019-05-31 00:00:00', '2019-05-31 13:52:37', 1, 'aghaad@live.fr', 1),
(12, '5cf225d43be631559373268', '2019-06-03 00:00:00', '2019-06-01 09:17:13', 1, 'aghaad@live.fr', 1),
(13, '5cf226a199b5d1559373473', '2019-06-03 00:00:00', '2019-06-01 10:16:59', 1, 'aghaad@live.fr', 1),
(14, '5cf23d021f8c71559379202', '2019-06-03 00:00:00', '2019-06-01 10:53:46', 1, 'aghaad@live.fr', 1),
(15, '5cf23e23c0abd1559379491', '2019-06-03 00:00:00', '2019-06-01 10:59:20', 1, 'aghaad@live.fr', 1),
(16, '5cf3b6304fb221559475760', '2019-06-03 00:00:00', '2019-06-03 12:48:39', 1, 'AGHAAD@LIVE.FR', 1),
(17, '5cf4fb9c7afdf1559559068', '2019-06-05 00:00:00', '2019-06-03 12:51:31', 1, 'aghaad@live.fr', 1),
(18, '5cf4fcc0b52901559559360', '2019-06-12 00:00:00', '2019-06-03 12:56:20', 1, 'aghaad@live.fr', 1),
(19, '5cf5441fd29311559577631', '2019-06-17 00:00:00', '2019-06-03 18:00:56', 1, 'aghaad@live.fr', 1),
(20, '5cf544939a7e61559577747', '2019-06-17 00:00:00', '2019-06-03 18:28:56', 1, 'aghaad@live.fr', 1),
(21, '5cf54b50a06031559579472', '2019-06-17 00:00:00', '2019-06-03 18:32:05', 1, 'aghaad@live.fr', 1),
(22, '5cf550717eaef1559580785', '2019-06-17 00:00:00', '2019-06-03 18:55:13', 1, 'aghaad@live.fr', 1),
(23, '5cf5524bd7cb81559581259', '2019-06-17 00:00:00', '2019-06-03 19:02:08', 1, 'aghaad@live.fr', 1),
(24, '5cf629a9ce75d1559636393', '2019-06-17 00:00:00', '2019-06-04 11:44:42', 1, 'le.musee.du.louvre.75@gmail.com', 1),
(25, '5cf7bd0cbc6bb1559739660', '2019-06-17 00:00:00', '2019-06-05 15:05:45', 1, 'aghaad@live.fr', 1),
(26, '5cf7be49b67591559739977', '2019-06-17 00:00:00', '2019-06-06 13:15:26', 1, 'le.musee.du.louvre.75@gmail.com', 1),
(27, '5cf8f6b9586901559819961', '2019-06-17 00:00:00', '2019-06-06 13:19:50', 1, 'aghaad@live.fr', 1),
(28, '5cfcc36788a7b1560068967', '2019-06-17 00:00:00', '2019-06-09 10:30:01', 1, 'aghaad@live.fr', 1),
(29, '5cfcc36788a7b1560068967', '2019-06-17 00:00:00', '2019-06-09 10:30:01', 1, 'aghaad@live.fr', 1);

-- --------------------------------------------------------

--
-- Structure de la table `tarifs`
--

DROP TABLE IF EXISTS `tarifs`;
CREATE TABLE IF NOT EXISTS `tarifs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_tarif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tarif` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `billets`
--
ALTER TABLE `billets`
  ADD CONSTRAINT `FK_4FCF9B68B83297E7` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
