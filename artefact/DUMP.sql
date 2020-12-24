-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  ven. 27 nov. 2020 à 14:40
-- Version du serveur :  8.0.18
-- Version de PHP :  7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gestioncentre`
--

-- --------------------------------------------------------

--
-- Structure de la table `groupes`
--

DROP TABLE IF EXISTS `groupes`;
CREATE TABLE IF NOT EXISTS `groupes` (
  `GRO_id` int(11) NOT NULL AUTO_INCREMENT,
  `GRO_Type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `GRO_Nom` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `GRO_DateCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `GRO_CreePar` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`GRO_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `nuitees`
--

DROP TABLE IF EXISTS `nuitees`;
CREATE TABLE IF NOT EXISTS `nuitees` (
  `NUI_Id` int(11) NOT NULL AUTO_INCREMENT,
  `NUI_Personnes_PER_Id` int(11) NOT NULL,
  `NUI_Sites_SIT_Id` int(11) NOT NULL,
  `NUI_DateEntree` date NOT NULL,
  `NUI_MotifEntree` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `NUI_DateSortie` date NOT NULL,
  `NUI_MotifSortie` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `NUI_NombreNuitees` int(11) NOT NULL,
  `NUI_Commentaire` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `NUI_DateCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `NUI_CreePar` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`NUI_Id`),
  KEY `NUI_Personnes_PER_Id` (`NUI_Personnes_PER_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `nuitees`
--

INSERT INTO `nuitees` (`NUI_Id`, `NUI_Personnes_PER_Id`, `NUI_Sites_SIT_Id`, `NUI_DateEntree`, `NUI_MotifEntree`, `NUI_DateSortie`, `NUI_MotifSortie`, `NUI_NombreNuitees`, `NUI_Commentaire`, `NUI_DateCreation`, `NUI_CreePar`) VALUES
(4, 170, 0, '2020-11-21', 'je ss pas', '2020-11-28', 'je ss pas encore 1', 0, 'blabla', '2020-11-25 19:02:17', ''),
(14, 175, 0, '2020-11-18', 'je suis sans domicile fixe', '2020-11-18', 'je suis sans domicile fixe', 0, 'blabla', '2020-11-27 08:06:00', ''),
(15, 175, 0, '2020-11-27', 'je suis sans domicile fixe', '2020-11-28', 'je suis sans domicile fixe', 0, 'bla bla', '2020-11-27 08:14:40', ''),
(16, 176, 0, '2020-11-11', 'je suis sans domicile fixe', '2020-11-12', '', 0, 'blablabla', '2020-11-27 08:23:38', ''),
(17, 176, 0, '2020-11-14', 'je suis sans domicile fixe', '2020-11-15', 'je suis sans domicile fixe', 0, 'blablab je test maintenant', '2020-11-27 08:23:38', ''),
(20, 177, 0, '2020-11-27', 'je suis sans domicile fixe', '2020-11-28', 'je suis sans domicile fixe', 0, 'blablabla', '2020-11-27 14:22:17', '');

-- --------------------------------------------------------

--
-- Structure de la table `personnes`
--

DROP TABLE IF EXISTS `personnes`;
CREATE TABLE IF NOT EXISTS `personnes` (
  `PER_id` int(11) NOT NULL AUTO_INCREMENT,
  `PER_sites_SIT_id` int(11) NOT NULL,
  `PER_Groupes_GRO_id` int(11) NOT NULL,
  `PER_Nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `PER_Prenom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `PER_DateNaissance` date NOT NULL,
  `PER_Age` int(20) NOT NULL,
  `PER_Genre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `PER_Nationalite` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `PER_SituationFamiliale` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `PER_EnfantScolarisé` tinyint(1) NOT NULL,
  `PER_EcoleNom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `PER_DateCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `PER_CreePar` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`PER_id`),
  KEY `PER_Groupes_GRO_id` (`PER_Groupes_GRO_id`),
  KEY `PER_sites_SIT_id` (`PER_sites_SIT_id`)
) ENGINE=InnoDB AUTO_INCREMENT=178 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `personnes`
--

INSERT INTO `personnes` (`PER_id`, `PER_sites_SIT_id`, `PER_Groupes_GRO_id`, `PER_Nom`, `PER_Prenom`, `PER_DateNaissance`, `PER_Age`, `PER_Genre`, `PER_Nationalite`, `PER_SituationFamiliale`, `PER_EnfantScolarisé`, `PER_EcoleNom`, `PER_DateCreation`, `PER_CreePar`) VALUES
(170, 0, 0, 'dupont', 'martin', '1994-06-26', 26, 'Homme', 'français', 'Célibataire', 0, '', '2020-11-25 19:01:08', ''),
(173, 0, 0, '', '', '1970-01-01', 50, 'Veuillez sélectionner le genre', '', 'Veuillez sélectionner la situation familiale', 0, '', '2020-11-26 15:35:29', ''),
(175, 0, 0, 'AQQA', 'YOUSSEF', '1991-04-16', 29, 'Homme', 'française', 'Célibataire', 0, '', '2020-11-27 08:02:35', ''),
(176, 0, 0, 'Girardot', 'céline', '1961-03-23', 59, 'Femme', 'française', 'Divorcé(e)', 0, '', '2020-11-27 08:20:58', ''),
(177, 0, 0, 'Demathey', 'Nicolas', '1983-07-14', 37, 'Homme', 'française', 'Célibataire', 0, '', '2020-11-27 14:18:37', '');

-- --------------------------------------------------------

--
-- Structure de la table `piecesidentite`
--

DROP TABLE IF EXISTS `piecesidentite`;
CREATE TABLE IF NOT EXISTS `piecesidentite` (
  `PID_id` int(11) NOT NULL AUTO_INCREMENT,
  `PID_Type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `PID_Pays` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PID_DateDelivrance` date NOT NULL,
  `PID_DateExpiration` date NOT NULL,
  `PID_Personnes_PER_id` int(11) NOT NULL,
  `PID_Imgnom` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PID_Imgdir` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PID_DateCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `PID_CreePar` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`PID_id`),
  KEY `PID_Per_id` (`PID_Personnes_PER_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `piecesidentite`
--

INSERT INTO `piecesidentite` (`PID_id`, `PID_Type`, `PID_Pays`, `PID_DateDelivrance`, `PID_DateExpiration`, `PID_Personnes_PER_id`, `PID_Imgnom`, `PID_Imgdir`, `PID_DateCreation`, `PID_CreePar`) VALUES
(39, 'carte identité', 'France', '2020-11-16', '2020-11-21', 170, '0', 'img/pid/0.jpg', '2020-11-25 19:01:39', ''),
(43, 'Femme', 'France', '2012-06-23', '2034-07-27', 175, '0', 'img/pid/0.jpg', '2020-11-27 08:03:27', ''),
(44, 'carte identité', 'France', '2013-11-27', '2033-08-25', 176, '0', 'img/pid/0.jpg', '2020-11-27 08:21:33', ''),
(45, 'Femme', 'France', '2008-08-21', '2034-07-21', 177, '0', 'img/pid/0.jpg', '2020-11-27 14:19:24', '');

-- --------------------------------------------------------

--
-- Structure de la table `ressources`
--

DROP TABLE IF EXISTS `ressources`;
CREATE TABLE IF NOT EXISTS `ressources` (
  `RES_id` int(250) NOT NULL AUTO_INCREMENT,
  `RES_Type` enum('RSA','Chômage','Salaire','Caf','AAH','autres') COLLATE utf8_unicode_ci NOT NULL,
  `RES_DateDebut` date NOT NULL,
  `RES_DateFin` date NOT NULL,
  `RES_Montant` float NOT NULL,
  `RES_Personnes_PER_id` int(11) NOT NULL,
  `RES_DateCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `RES_CreePar` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`RES_id`),
  KEY `RES_Personnes_PER_id` (`RES_Personnes_PER_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `ressources`
--

INSERT INTO `ressources` (`RES_id`, `RES_Type`, `RES_DateDebut`, `RES_DateFin`, `RES_Montant`, `RES_Personnes_PER_id`, `RES_DateCreation`, `RES_CreePar`) VALUES
(7, 'RSA', '2020-11-10', '2020-11-22', 1200, 170, '2020-11-25 19:01:49', ''),
(10, '', '2020-11-14', '2020-11-09', 0, 173, '2020-11-26 15:35:49', ''),
(12, 'Salaire', '2015-09-27', '2032-11-24', 2500, 175, '2020-11-27 08:05:44', ''),
(13, 'RSA', '2015-07-01', '2025-07-27', 456, 176, '2020-11-27 08:22:44', ''),
(14, 'Salaire', '2013-08-21', '2025-03-27', 1200, 177, '2020-11-27 14:21:09', '');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `nuitees`
--
ALTER TABLE `nuitees`
  ADD CONSTRAINT `nuitees_ibfk_1` FOREIGN KEY (`NUI_Personnes_PER_Id`) REFERENCES `personnes` (`PER_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `piecesidentite`
--
ALTER TABLE `piecesidentite`
  ADD CONSTRAINT `piecesidentite_ibfk_1` FOREIGN KEY (`PID_Personnes_PER_id`) REFERENCES `personnes` (`PER_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ressources`
--
ALTER TABLE `ressources`
  ADD CONSTRAINT `ressources_ibfk_1` FOREIGN KEY (`RES_Personnes_PER_id`) REFERENCES `personnes` (`PER_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
