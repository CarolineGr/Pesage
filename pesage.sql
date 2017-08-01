-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 01 Août 2017 à 15:56
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `pesage`
--

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id_Client` int(11) NOT NULL AUTO_INCREMENT,
  `CodeClient` varchar(10) NOT NULL,
  `RaisonSociale` varchar(30) NOT NULL,
  `Adresse1` varchar(30) NOT NULL,
  `Adresse2` varchar(30) NOT NULL,
  `Adresse3` varchar(30) NOT NULL,
  `CodePostal` int(10) NOT NULL,
  `Ville` varchar(30) NOT NULL,
  `Pays` varchar(30) NOT NULL,
  `Telephone` varchar(15) NOT NULL,
  `Mail` varchar(20) NOT NULL,
  `Contact` varchar(20) NOT NULL,
  PRIMARY KEY (`id_Client`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `clients`
--

INSERT INTO `clients` (`id_Client`, `CodeClient`, `RaisonSociale`, `Adresse1`, `Adresse2`, `Adresse3`, `CodePostal`, `Ville`, `Pays`, `Telephone`, `Mail`, `Contact`) VALUES
(1, 'HPO', 'HOPITAL POISSY', '132 rue de la motte', 'ZI Clementine', 'Pôle Neuf', 78200, 'POISSY', 'FRANCE', '0145654323', 'poissy@hop.com', 'MAE HENRY'),
(2, 'PAR', 'DECHETERIE', 'ZI Versailles', '565, rue du Mont', '', 75000, 'PARIS', 'FRANCE', '0909090990', 'erf@fd.com', 'TRUC BIDULE'),
(3, 'VRI', 'VALOR RIOT ID', '23 av thym', '', '', 77340, 'LABAS', 'FRANCE', '0656543432', '', 'MACHINE CHOUETTE'),
(6, 'LYC', 'LYCEE D ALEMBERT', '22, sente des doreis', 'z i  abime', '', 75019, 'PARIS', 'FRANCE', '0145677890', 'ldc@ldc.com', 'LENIS ISABEAU'),
(7, 'FAK', 'FAKE', 'elev in', '', '', 34343, 'GERFIN', 'FRANCE', '0909090909', 'yg@yg.com', 'GREG'),
(8, 'FAKE', 'FAAK', 'rue de l abime', '', 'zi tot', 45454, 'JORK', 'SUEDE', '090909090909', 'gr@gr.com', 'BJON UNI'),
(9, '', '', '', '', '', 0, '', '', '', '', ''),
(10, 'MAIO', 'MAIRIE ORGEVAL', 'rue du petit pont', '', '', 78540, 'ORGEVAL', 'FRANCE', '0976543234', 'info@mairie.com', 'DUVAL JEAN'),
(11, 'HSG', 'HOPITAL ST GERMAIN', 'rue du herisson', 'zi du herisson', 'pole etoile', 78100, 'ST GERMAIN-EN-LAYE', 'FRANCE', '0265656565', 'hug@stg.com', 'ANGEL URIEL'),
(12, 'EXP', 'EXEMPLE DE CLIENT', 'impasse du pepin', '', '', 78000, 'VERSAILLES', 'FRANCE', '0146464646', 'exp@exp.com', 'DUPUIS JEAN'),
(13, 'LOGINA', 'LOGINATECH', '78 rue de la chapelle', 'etage 1', '', 78630, 'ORGEVAL', 'FRANCE', '0139752121', 'mail@loginatech.com', 'GULHATI RAJAN');

-- --------------------------------------------------------

--
-- Structure de la table `historiquepesees`
--

CREATE TABLE IF NOT EXISTS `historiquepesees` (
  `id_pesees` int(11) NOT NULL,
  `idUtilisateurEntree` int(10) NOT NULL,
  `idUtilisateurSortie` int(10) DEFAULT NULL,
  `CodeClient` varchar(10) NOT NULL,
  `DateEntree` datetime NOT NULL,
  `DateSortie` datetime DEFAULT NULL,
  `PoidsEntree` double NOT NULL,
  `PoidsSortie` double DEFAULT NULL,
  `Immatriculation` varchar(10) NOT NULL,
  `CodeMatiere` varchar(6) NOT NULL,
  `Prix` double DEFAULT NULL,
  PRIMARY KEY (`id_pesees`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `historiquepesees`
--

INSERT INTO `historiquepesees` (`id_pesees`, `idUtilisateurEntree`, `idUtilisateurSortie`, `CodeClient`, `DateEntree`, `DateSortie`, `PoidsEntree`, `PoidsSortie`, `Immatriculation`, `CodeMatiere`, `Prix`) VALUES
(1, 2, 2, 'HSG', '2017-01-27 14:11:56', '2017-01-27 14:12:55', 5600, 2000, 'HT-555-HT', 'OM', 162),
(2, 2, 16, 'VRI', '2017-01-04 16:08:00', '2017-01-12 09:39:47', 456, 367, 'ER-456-ER', 'VG', 2.23),
(3, 4, 4, 'MAIO', '2017-01-27 14:31:20', '2017-01-27 14:32:03', 3000, 1500, 'AG-432-HY', 'VG', 37.5),
(4, 2, 2, 'MAIO', '2017-01-27 14:34:05', '2017-01-27 14:34:30', 6700, 2000, 'GG-654-FR', 'OM', 211.5),
(15, 2, 2, 'FAK', '2017-01-06 10:31:05', '2017-01-09 11:23:08', 33000, 10000, 'PP-555-YY', 'OM', 1035),
(22, 2, 2, 'HPO', '2017-01-06 17:05:18', '2017-01-09 17:23:42', 5344.779, 4000, 'WZ-731-YH', 'GR', 20.17),
(23, 4, 2, 'VRI', '2017-01-06 17:05:57', '2017-01-09 17:10:20', 8765.567, 7654, 'RD-987-WS', 'GR', 16.67),
(25, 2, 2, 'FAKE', '2017-01-09 11:22:35', '2017-01-09 12:26:27', 6578.5, 5000, 'ER-911-ER', 'VG', 39.46),
(26, 2, 4, 'HPO', '2017-01-09 12:26:02', '2017-01-09 14:16:54', 5674.67, 4356, 'UU-432-GG', 'OM', 59.34),
(27, 2, 2, 'VRI', '2017-01-09 12:28:21', '2017-01-09 12:28:33', 634.8, 500, 'AB-725-FR', 'VG', 3.37),
(28, 4, 2, 'FAK', '2017-01-09 14:16:25', '2017-01-11 17:15:07', 4564, 54, 'LP-231-MP', 'GR', 67.65),
(29, 2, 25, 'HPO', '2017-01-09 16:56:14', '2017-01-12 09:39:11', 6667, 5434, 'RD-987-WS', 'OM', 55.49),
(30, 2, 1, 'LYC', '2017-01-09 16:56:28', '2017-01-10 11:06:43', 5555, 5000, 'FF-333-HH', 'GR', 8.33),
(31, 2, 13, 'PAR', '2017-01-09 16:56:43', '2017-01-10 11:13:05', 22222, 1111, 'NN-777-BB', 'OM', 950),
(32, 2, 28, 'PAR', '2017-01-09 16:57:01', '2017-01-10 15:23:29', 6665, 5000, 'UU-432-GG', 'VG', 41.63),
(33, 2, 28, 'FAK', '2017-01-10 10:43:43', '2017-01-10 15:33:09', 5434, 4000, 'HT-555-HT', 'GR', 21.51),
(34, 2, 2, 'FAK', '2017-01-10 10:45:54', '2017-01-10 16:36:10', 568, 300, 'PP-555-YY', 'OM', 12.06),
(35, 22, 2, 'HPO', '2017-01-10 10:54:04', '2017-01-16 15:48:23', 5457, 3333, 'WZ-731-YH', 'OM', 95.58),
(36, 4, 2, 'HPO', '2017-01-10 11:01:56', '2017-01-11 17:15:18', 544, 76, 'PP-555-YY', 'OM', 21.06),
(37, 1, 2, 'LYC', '2017-01-10 11:06:22', '2017-01-10 16:35:38', 456, 200, 'RD-987-WS', 'GR', 3.84),
(38, 13, 2, 'FAK', '2017-01-10 11:12:18', '2017-01-16 15:49:33', 8765, 2222, 'HT-555-HT', 'VG', 163.58),
(39, 16, 2, 'LYC', '2017-01-10 11:14:51', '2017-01-11 17:15:28', 9876, 8000, 'NN-777-BB', 'GR', 28.14),
(40, 11, 2, 'PAR', '2017-01-10 11:15:41', '2017-01-10 16:39:33', 654, 400, 'RD-987-WS', 'OM', 11.43),
(41, 6, 2, 'FAK', '2017-01-10 11:17:50', '2017-01-11 17:15:44', 7687, 456, 'AB-725-FR', 'VG', 180.78),
(42, 2, 2, 'HPO', '2017-01-10 15:45:11', '2017-01-10 16:34:22', 4444, 2000, 'HT-555-HT', 'OM', 109.98),
(43, 2, 2, 'FAK', '2017-01-10 16:28:53', '2017-01-10 16:33:48', 9876, 6767, 'HT-555-HT', 'GR', 46.64),
(44, 2, 2, 'HSG', '2017-01-10 16:32:20', '2017-01-10 16:34:08', 3333, 2000, 'HT-555-HT', 'GR', 20),
(45, 2, 2, 'HSG', '2017-01-11 15:22:18', '2017-01-16 15:48:49', 5656, 4444, 'KK-543-JJ', 'OM', 54.54),
(46, 2, 2, 'MAIO', '2017-01-11 15:22:45', '2017-01-11 15:24:05', 5656, 4000, 'HE-456-HE', 'VG', 41.4),
(47, 2, 7, 'MAIO', '2017-01-11 15:23:47', '2017-01-12 09:38:47', 6767, 5000, 'FF-333-HH', 'OM', 79.52),
(48, 2, 7, 'HSG', '2017-01-12 09:34:58', '2017-01-12 09:38:17', 5432, 4000, 'ER-911-ER', 'OM', 64.44),
(49, 2, 7, 'LYC', '2017-01-12 09:35:15', '2017-01-12 09:38:31', 5467, 3333, 'AW-565-WA', 'GR', 32.01),
(50, 1, 25, 'HSG', '2017-01-12 09:35:37', '2017-01-12 09:39:23', 7777, 5467, 'HE-456-HE', 'OM', 103.95),
(51, 1, 2, 'HSG', '2017-01-12 09:35:53', '2017-01-16 15:49:21', 5432, 2222, 'AG-432-HY', 'VG', 80.25),
(52, 1, 2, 'MAIO', '2017-01-12 09:36:12', '2017-01-16 15:49:53', 9987, 3453, 'BL-654-LG', 'GR', 98.01),
(53, 4, 2, 'HSG', '2017-01-12 09:36:35', '2017-01-16 15:49:42', 7686, 4343, 'NN-777-BB', 'OM', 150.44),
(54, 4, 2, 'MAIO', '2017-01-12 09:36:49', '2017-01-16 15:49:02', 6756, 5555, 'GG-654-FR', 'VG', 30.03),
(55, 4, 4, 'HSG', '2017-01-12 09:37:03', '2017-01-12 09:44:09', 9876, 7888, 'AB-725-FR', 'GR', 29.82),
(56, 11, 16, 'HSG', '2017-01-12 09:37:57', '2017-01-12 09:40:00', 8989, 5555, 'RR-565-TT', 'OM', 154.53),
(57, 2, 2, 'HSG', '2017-01-12 16:32:16', '2017-01-12 16:38:31', 6567, 4333, 'FF-333-HH', 'VG', 55.85),
(58, 2, 2, 'HPO', '2017-01-16 15:56:45', '2017-01-18 14:57:39', 8876, 4500, 'AB-725-FR', 'GR', 65.64),
(59, 2, 2, 'PAR', '2017-01-16 15:56:58', '2017-01-16 16:11:43', 7865, 2000, 'LL-789-MM', 'GR', 87.98),
(60, 2, 2, 'MAIO', '2017-01-16 15:57:18', '2017-01-18 15:01:24', 20566, 8000, 'AG-432-HY', 'GR', 188.49),
(61, 2, 2, 'VRI', '2017-01-16 15:57:41', '2017-01-18 14:55:00', 756, 544, 'AS-444-RD', 'VG', 5.3),
(62, 2, 2, 'EXP', '2017-01-18 12:18:57', '2017-01-18 12:23:05', 4500, 3000, 'AW-565-WA', 'VG', 37.5),
(63, 2, 2, 'HPO', '2017-01-18 12:21:10', '2017-01-18 15:00:46', 7650, 3000, 'KK-543-JJ', 'GR', 69.75),
(64, 2, 2, 'LYC', '2017-01-18 15:01:11', '2017-01-18 15:02:13', 6500, 3000, 'LL-789-MM', 'OM', 157.5),
(65, 2, 2, 'MAIO', '2017-01-18 15:01:52', '2017-01-18 15:03:18', 15000, 3000, 'AB-344-CA', 'VG', 300),
(66, 2, 2, 'MAIO', '2017-01-18 15:03:04', '2017-01-20 11:34:20', 15000, 4000, 'GG-654-FR', 'GR', 165),
(67, 2, 32, 'FAK', '2017-01-19 11:54:32', '2017-01-20 10:50:04', 30544, 5000, 'BL-654-LG', 'OM', 1149.48),
(69, 2, 32, 'LYC', '2017-01-19 12:05:51', '2017-01-20 09:56:41', 3333, 2222, 'AW-565-WA', 'VG', 27.78),
(70, 32, 32, 'LOGINA', '2017-01-20 09:55:07', '2017-01-20 09:56:00', 1234, 1112, 'AB-725-FR', 'GR', 1.83),
(71, 32, 32, 'HPO', '2017-01-20 10:30:34', '2017-01-20 10:31:05', 5600, 2000, 'AS-444-RD', 'GR', 54),
(72, 32, 32, 'FAKE', '2017-01-20 11:36:01', '2017-01-20 11:36:25', 5650, 2000, 'AB-725-FR', 'VG', 91.25),
(73, 32, 32, 'FAK', '2017-01-20 11:36:16', '2017-01-20 11:37:13', 8765, 2000, 'FG-222-FG', 'VG', 169.13);

-- --------------------------------------------------------

--
-- Structure de la table `immatriculations`
--

CREATE TABLE IF NOT EXISTS `immatriculations` (
  `id_immatriculation` int(11) NOT NULL AUTO_INCREMENT,
  `Immatriculation` varchar(20) NOT NULL,
  `id_transporteur` int(11) NOT NULL,
  PRIMARY KEY (`id_immatriculation`),
  KEY `transporteur_id` (`id_transporteur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=55 ;

--
-- Contenu de la table `immatriculations`
--

INSERT INTO `immatriculations` (`id_immatriculation`, `Immatriculation`, `id_transporteur`) VALUES
(1, 'HT-555-HT', 11),
(2, 'UH-678-UH', 11),
(3, 'HE-456-HE', 11),
(4, 'SZ-989-SA', 7),
(5, 'AB-344-CA', 3),
(6, 'AA-123-AA', 3),
(7, 'LP-231-MP', 7),
(9, 'AB-725-FR', 4),
(10, 'BL-654-LG', 11),
(13, 'GG-654-FR', 12),
(15, 'AG-432-HY', 4),
(16, 'RD-987-WS', 4),
(17, 'WZ-731-YH', 7),
(23, 'RR-565-TT', 12),
(24, 'UU-432-GG', 11),
(25, 'PO-567-YG', 4),
(29, 'AW-565-WA', 4),
(31, 'ER-911-ER', 12),
(32, 'AS-444-RD', 12),
(33, 'UU-545-CC', 12),
(34, 'PP-555-YY', 12),
(35, 'FF-333-HH', 12),
(36, 'KK-543-JJ', 12),
(37, 'LL-789-MM', 12),
(38, 'NN-777-BB', 12),
(41, '', 17),
(43, 'MP-534-PM', 16),
(44, 'TR-345-AB', 7),
(46, 'LM-232-NB', 15),
(47, 'FF-222-FF', 15),
(52, 'FG-222-FG', 11),
(53, 'FR-121-FR', 11),
(54, 'LD-999-VB', 18);

-- --------------------------------------------------------

--
-- Structure de la table `matieres`
--

CREATE TABLE IF NOT EXISTS `matieres` (
  `id_matiere` int(11) NOT NULL AUTO_INCREMENT,
  `CodeMatiere` varchar(6) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Matiere` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Prix` double NOT NULL,
  PRIMARY KEY (`id_matiere`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `matieres`
--

INSERT INTO `matieres` (`id_matiere`, `CodeMatiere`, `Matiere`, `Prix`) VALUES
(3, 'VG', 'Vegetaux', 25),
(4, 'OM', 'Ordures Menageres', 45),
(5, 'GR', 'Gravats', 15),
(6, '', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `pesees`
--

CREATE TABLE IF NOT EXISTS `pesees` (
  `id_pesees` int(11) NOT NULL AUTO_INCREMENT,
  `idUtilisateurEntree` int(10) NOT NULL,
  `idUtilisateurSortie` int(10) DEFAULT NULL,
  `CodeClient` varchar(10) NOT NULL,
  `DateEntree` datetime NOT NULL,
  `DateSortie` datetime DEFAULT NULL,
  `PoidsEntree` double NOT NULL,
  `PoidsSortie` double DEFAULT NULL,
  `Immatriculation` varchar(10) NOT NULL,
  `CodeMatiere` varchar(6) NOT NULL,
  `Prix` double DEFAULT NULL,
  PRIMARY KEY (`id_pesees`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id_session` int(11) NOT NULL AUTO_INCREMENT,
  `adresseIP` varchar(15) CHARACTER SET utf8 NOT NULL,
  `DerniereConnexion` datetime NOT NULL,
  `id_site` int(11) NOT NULL,
  PRIMARY KEY (`id_session`),
  KEY `id_site` (`id_site`),
  KEY `CodeSite` (`id_site`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=32 ;

--
-- Contenu de la table `sessions`
--

INSERT INTO `sessions` (`id_session`, `adresseIP`, `DerniereConnexion`, `id_site`) VALUES
(1, '127.0.0.1', '2017-01-27 14:34:32', 2),
(2, '::1', '2017-04-08 14:21:21', 1),
(3, '168.127.34.34', '0000-00-00 00:00:00', 2),
(10, '123.43.43.43', '0000-00-00 00:00:00', 2),
(13, '127.23.234.254', '0000-00-00 00:00:00', 1),
(15, '155.244.22.22', '0000-00-00 00:00:00', 3),
(16, '192.168.45.45', '0000-00-00 00:00:00', 3),
(17, '192.169.45.56', '0000-00-00 00:00:00', 1),
(18, '134.12.12.12', '0000-00-00 00:00:00', 3),
(19, '212.34.23.87', '0000-00-00 00:00:00', 1),
(21, '98.98.98.98', '0000-00-00 00:00:00', 7),
(23, '165.76.6.6', '0000-00-00 00:00:00', 7),
(24, '234.67.5.5', '0000-00-00 00:00:00', 3),
(25, '222.22.22.2', '0000-00-00 00:00:00', 3),
(26, '123.7.8.9', '0000-00-00 00:00:00', 9),
(27, '8.8.8.8', '0000-00-00 00:00:00', 9),
(28, '2.2.2.3', '0000-00-00 00:00:00', 1),
(29, '192.45.45.4', '0000-00-00 00:00:00', 9),
(30, '123.123.123.123', '0000-00-00 00:00:00', 12),
(31, '135.56.56.55', '0000-00-00 00:00:00', 11);

-- --------------------------------------------------------

--
-- Structure de la table `site`
--

CREATE TABLE IF NOT EXISTS `site` (
  `id_site` int(11) NOT NULL AUTO_INCREMENT,
  `CodeSite` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `RaisonSociale` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Adresse1` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Adresse2` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Adresse3` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `CodePostal` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Ville` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Pays` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Telephone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Mail` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Contact` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `id_societe` int(11) NOT NULL,
  PRIMARY KEY (`id_site`),
  UNIQUE KEY `CodeSite` (`CodeSite`),
  UNIQUE KEY `id_site` (`id_site`),
  KEY `id_societe` (`id_societe`),
  KEY `CodeSite_2` (`CodeSite`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Contenu de la table `site`
--

INSERT INTO `site` (`id_site`, `CodeSite`, `RaisonSociale`, `Adresse1`, `Adresse2`, `Adresse3`, `CodePostal`, `Ville`, `Pays`, `Telephone`, `Mail`, `Contact`, `id_societe`) VALUES
(1, 'SIV', 'SIVATRU', 'ecopole seine aval ', 'chemin des graviers', '', '78510', 'TRIEL SUR SEINE', 'FRANCE', '0134012410', 'info@sivatru.com', 'OLIVER JAMES', 1),
(2, 'VAL', 'VALOR POLE 72', '17 avenue pierre piffault', 'zi la plagne', '', '72100', 'LE MANS', 'FRANCE', '0243752000', 'contact@valorpole.com', 'MARTON JEAN', 1),
(3, 'RHO', 'RHONE ENVIRONNEMENT', '99 Route de Brignais RD 342', '', '', '69230', 'ST GENIS LAVAL', 'FRANCE', '0456545356', 'contact@re.com', 'MOULON Sandy', 1),
(7, 'TRY', 'TRY ESSAI', '12 rue machin', 'zi la grosse pierre', '', '56432', 'BREST', 'FRANCE', '0147483647', 'essai@try.com', 'HA HA', 1),
(9, 'TES', 'TEST', 'test', '', '', '111111', 'TEST', 'TEST', '3232323232', 'test@test.test', 'TEST TEST', 1),
(10, 'TEST', 'TEST N°2', 'd ab', 'rue abime', '', '34343', 'IF', 'COTE D IVOIRE', '09999999999', 'grt@cf.com', 'FERE LOUISE', 1),
(11, 'SAN', 'SANITAS', 'impasse eboueur', 'zi fai', '', '14000', 'CAEN', 'FRANCE', '0677777777', 'san@san.com', 'DUPRE MARTINE', 1),
(12, 'LOGINA', 'LOGINATECH', '78 rue de la chapelle', '', '', '78630', 'ORGEVAL', 'FRANCE', '0139752121', 'mail@loginatech.com', 'GULHATI RAJAN', 1);

-- --------------------------------------------------------

--
-- Structure de la table `societe`
--

CREATE TABLE IF NOT EXISTS `societe` (
  `id_societe` int(11) NOT NULL AUTO_INCREMENT,
  `RaisonSociale` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Adresse1` varchar(30) CHARACTER SET utf8 NOT NULL,
  `Adresse2` varchar(30) CHARACTER SET utf8 NOT NULL,
  `Adresse3` varchar(30) CHARACTER SET utf8 NOT NULL,
  `CodePostal` int(5) NOT NULL,
  `Ville` varchar(30) CHARACTER SET utf8 NOT NULL,
  `Telephone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Mail` varchar(30) CHARACTER SET utf8 NOT NULL,
  `Contact` varchar(30) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_societe`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `societe`
--

INSERT INTO `societe` (`id_societe`, `RaisonSociale`, `Adresse1`, `Adresse2`, `Adresse3`, `CodePostal`, `Ville`, `Telephone`, `Mail`, `Contact`) VALUES
(1, 'Loginatech', '78, rue de la Chapelle', '', '', 78630, 'ORGEVAL', '0139752121', 'info@loginatech.com', 'GRIMAULT Caroline');

-- --------------------------------------------------------

--
-- Structure de la table `transporteurs`
--

CREATE TABLE IF NOT EXISTS `transporteurs` (
  `id_Transporteur` int(11) NOT NULL AUTO_INCREMENT,
  `CodeTransporteur` varchar(10) CHARACTER SET utf8 NOT NULL,
  `RaisonSociale` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Adresse1` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Adresse2` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Adresse3` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `CodePostal` int(11) NOT NULL,
  `Ville` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Pays` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Telephone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Mail` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Contact` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_Transporteur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Contenu de la table `transporteurs`
--

INSERT INTO `transporteurs` (`id_Transporteur`, `CodeTransporteur`, `RaisonSociale`, `Adresse1`, `Adresse2`, `Adresse3`, `CodePostal`, `Ville`, `Pays`, `Telephone`, `Mail`, `Contact`) VALUES
(3, 'DPD', 'DPD', '12 rue truc', 'zi machin', 'tut', 74567, 'FORT', 'FRANCE', '0345654323', 'dpd@dpd.com', 'FRET Frit'),
(4, 'RTD', 'Royal Transp', 'zi chantante', 'ytf', 'ytf', 43434, 'RU', 'FRANCE', '0654323432', 'yt@lo.com', 'FY TY'),
(7, 'TNT', 'TNT', '24 rue du tunnel', '', '', 78987, 'VAUX', 'FRANCE', '0123456789', 'gon@tnt.com', 'TREVOR'),
(11, 'FEX', 'FRANCE EXPRESS', 'impasse titi', 'fe', 'fe', 45500, 'ORLEANS', 'FRANCE', '0987654321', 'vroom@fex.com', 'VROUM VROUM'),
(12, 'CDR', 'CEDIC', '3 rue bordeliere', '', '', 33500, 'TAYO', 'FRANCE', '0876545432', 'gt@hat.com', 'N G'),
(14, 'TEST', 'TEST', 'test', '', '', 33333, 'TEST', 'TEST', '3333333333', 'test@test.com', 'TEST'),
(15, 'TNTP', 'TNT PARIS', 'impasse du centre', '', '', 75009, 'PARIS', 'FRANCE', '0988523888', 'tntp@t.com', 'LITTER JOHN'),
(16, 'FEXP', 'FRANCE EXPRESS PARIS', 'rue du cote', '', '', 75019, 'PARIS', 'FRANCE', '0956565656', 'fexp@f.com', 'IVANOV IGOR'),
(17, '', '', '', '', '', 0, '', '', '', '', ''),
(18, 'TDP', 'TRANSPORT DE PARIS', '75 rue de versailles', '', '', 75013, 'PARIS', 'FRANCE', '0101010101', 'mail@mail.com', 'DUPONT JEAN');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id_utilisateurs` int(11) NOT NULL AUTO_INCREMENT,
  `codeUtilisateur` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Nom` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Prenom` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `DateDeNaissance` date NOT NULL,
  `Administrateur` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `MotDePasse` varchar(30) CHARACTER SET utf8 NOT NULL,
  `Connexion` tinyint(1) NOT NULL,
  `Clef_Activation` varchar(8) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_utilisateurs`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=34 ;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateurs`, `codeUtilisateur`, `Nom`, `Prenom`, `DateDeNaissance`, `Administrateur`, `MotDePasse`, `Connexion`, `Clef_Activation`) VALUES
(1, 'AL', 'LUPIN', 'Arsene', '1895-03-12', 'OUI', 'voleur', 1, '12ab3e22'),
(2, 'CG', 'GRIMAULT', 'Caroline', '1980-04-12', 'OUI', 'cgg', 1, '126BCE32'),
(3, 'CG1', 'GUIMONTEL', 'Charles', '1895-04-12', 'NON', '', 0, 'abc32132'),
(4, 'DD', 'DUCK', 'Donald', '1869-09-23', 'OUI', 'daisy', 1, 'A2e32aCc'),
(5, 'EL', 'LOW', 'Edward', '1950-01-01', 'NON', '', 0, 'A3e4907g'),
(6, 'GF', 'FLAUBERT', 'Gustave', '1821-12-12', 'OUI', 'livre', 0, 'Ee436bf7'),
(7, 'JB', 'BOND', 'James', '1951-01-20', 'OUI', '007', 0, 'ED428cbe'),
(8, 'JD', 'DOE', 'John', '1950-01-01', 'NON', 'tre', 0, 'ecb987ad'),
(9, 'JN', 'NEYMARD', 'Jean', '1895-03-12', 'NON', '', 0, 'Abe53e77'),
(10, 'JRRT', 'TOLKIEN', 'John-Ronald Reuel', '1892-01-03', 'NON', 'frodon', 0, 'Abe43e67'),
(12, 'TB', 'BURTON', 'Tim', '1946-01-30', 'OUI', '', 0, '23faEc46'),
(14, 'WW', 'WONDER', 'Woman', '1980-04-12', 'OUI', '', 0, 'Bcd4568g'),
(15, 'AT', 'THIERRY', 'Armand', '1987-12-01', 'NON', '', 0, 'C45E54Ce'),
(16, 'ND', 'DRAGONEAU', 'Norbert', '1985-06-12', 'OUI', 'nifleur', 0, '56DAceac'),
(17, 'SC', 'CORR', 'Sharon', '1973-03-15', 'OUI', '', 0, '324354BC'),
(18, 'PN', 'NOEL', 'Pere', '1600-01-01', 'NON', '', 0, '34Cbe67d'),
(19, 'CP', 'PEDERSEN', 'Christina', '1984-08-23', 'NON', '', 0, '12cb6EdA'),
(21, 'AM', 'MICHEL', 'Augustin', '1999-12-01', 'NON', '', 0, '12ecb65c'),
(23, 'AW', 'WILLY', 'Arnold', '1985-03-12', 'OUI', 'serie', 0, 'bce12358'),
(24, 'PG', 'GORDON', 'Peggy', '2056-09-23', 'NON', '', 0, 'befDF279'),
(25, 'EG', 'GREEN', 'Eva', '1980-12-12', 'OUI', 'peregrin', 0, 'CE012568'),
(28, 'DDLV', 'DE LA VEGA', 'Diego', '1946-07-06', 'OUI', 'zorro', 0, 'bfBC1356'),
(29, 'TE', 'EXEMPLE', 'Test', '1972-09-12', 'OUI', 'test', 0, 'bdBCEF03'),
(30, 'LS', 'SALANDER', 'Lisbeth', '1983-11-09', 'NON', '', 0, 'dfBDF348'),
(31, 'EFL', 'LEMI', 'Erika-francoise', '1977-06-12', 'NON', '', 0, 'eBDF4689'),
(33, 'FF', 'FORESTI', 'Florence', '1977-05-12', 'NON', 'humoriste', 0, 'acBCD457');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `immatriculations`
--
ALTER TABLE `immatriculations`
  ADD CONSTRAINT `fk_immat_transp` FOREIGN KEY (`id_transporteur`) REFERENCES `transporteurs` (`id_Transporteur`);

--
-- Contraintes pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `session_site_fk` FOREIGN KEY (`id_site`) REFERENCES `site` (`id_site`);

--
-- Contraintes pour la table `site`
--
ALTER TABLE `site`
  ADD CONSTRAINT `site_societe_fk` FOREIGN KEY (`id_societe`) REFERENCES `societe` (`id_societe`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
