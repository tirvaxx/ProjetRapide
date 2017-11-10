-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 09, 2017 at 02:50 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projet_rapide`
--
CREATE DATABASE IF NOT EXISTS `projet_rapide` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `projet_rapide`;

-- --------------------------------------------------------

--
-- Stand-in structure for view `acteurs`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `acteurs`;
CREATE TABLE IF NOT EXISTS `acteurs` (
`key` varchar(18)
,`type` varchar(7)
,`id` int(11) unsigned
,`nom` varchar(101)
);

-- --------------------------------------------------------

--
-- Table structure for table `acteur_client`
--

DROP TABLE IF EXISTS `acteur_client`;
CREATE TABLE IF NOT EXISTS `acteur_client` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `telephone` int(11) NOT NULL,
  `adresse` varchar(500) NOT NULL,
  `code_postal` varchar(6) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `creer_par_acteur_id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `acteur_client`
--

TRUNCATE TABLE `acteur_client`;
--
-- Dumping data for table `acteur_client`
--

INSERT INTO `acteur_client` (`id`, `nom`, `contact`, `telephone`, `adresse`, `code_postal`, `date_creation`, `creer_par_acteur_id`) VALUES
(1, 'Les Entreprises XYZ inc.', 'Joe Beef', 514555123, '1 rue des boeufs, montreal, quebec', 'H1H1H1', '2017-10-21 15:25:12', 2);

-- --------------------------------------------------------

--
-- Table structure for table `acteur_employe`
--

DROP TABLE IF EXISTS `acteur_employe`;
CREATE TABLE IF NOT EXISTS `acteur_employe` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `date_embauche` date NOT NULL,
  `date_cessation_emploi` date DEFAULT NULL,
  `date_insertion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actif` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `acteur_employe`
--

TRUNCATE TABLE `acteur_employe`;
--
-- Dumping data for table `acteur_employe`
--

INSERT INTO `acteur_employe` (`id`, `prenom`, `nom`, `date_embauche`, `date_cessation_emploi`, `date_insertion`, `actif`) VALUES
(2, 'Alain', 'Bessette', '2017-05-01', NULL, '2017-10-21 14:58:31', 1),
(3, 'Caroline', 'Cote', '2017-06-01', NULL, '2017-10-21 14:59:18', 1),
(4, 'Mathieu', 'Novis', '2017-06-15', NULL, '2017-10-21 15:00:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `acteur_role`
--

DROP TABLE IF EXISTS `acteur_role`;
CREATE TABLE IF NOT EXISTS `acteur_role` (
  `acteur_id` int(11) NOT NULL,
  `acteur_type` int(11) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actif` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `acteur_role`
--

TRUNCATE TABLE `acteur_role`;
--
-- Dumping data for table `acteur_role`
--

INSERT INTO `acteur_role` (`acteur_id`, `acteur_type`, `date_creation`, `actif`) VALUES
(2, 2, '2017-10-21 15:29:08', 1),
(3, 1, '2017-10-21 15:29:08', 1),
(4, 2, '2017-10-21 15:29:50', 1),
(1, 3, '2017-10-21 15:30:12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `acteur_type`
--

DROP TABLE IF EXISTS `acteur_type`;
CREATE TABLE IF NOT EXISTS `acteur_type` (
  `id` tinyint(10) UNSIGNED NOT NULL,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `acteur_type`
--

TRUNCATE TABLE `acteur_type`;
--
-- Dumping data for table `acteur_type`
--

INSERT INTO `acteur_type` (`id`, `description`) VALUES
(3, 'Client'),
(2, 'Utilisateur'),
(1, 'Gestionnaire de Projet');

-- --------------------------------------------------------

--
-- Table structure for table `demande`
--

DROP TABLE IF EXISTS `demande`;
CREATE TABLE IF NOT EXISTS `demande` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `demandeur_acteur_id` int(11) NOT NULL,
  `date_inscription` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `demande`
--

TRUNCATE TABLE `demande`;
-- --------------------------------------------------------

--
-- Table structure for table `demande_traitee`
--

DROP TABLE IF EXISTS `demande_traitee`;
CREATE TABLE IF NOT EXISTS `demande_traitee` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `demande_id` int(11) NOT NULL,
  `projet_id` int(11) NOT NULL,
  `date_traitee` date NOT NULL,
  `traitee_par_acteur_id` int(11) NOT NULL,
  `commentaire` varchar(500) NOT NULL,
  `demande_rejetee` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `demande_traitee`
--

TRUNCATE TABLE `demande_traitee`;
-- --------------------------------------------------------

--
-- Table structure for table `documentation`
--

DROP TABLE IF EXISTS `documentation`;
CREATE TABLE IF NOT EXISTS `documentation` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `projet_id` int(11) NOT NULL,
  `source_id` tinyint(4) NOT NULL,
  `objet_id` int(11) NOT NULL,
  `acteur_id` int(11) NOT NULL,
  `description` varchar(8000) NOT NULL,
  `date_insertion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `documentation`
--

TRUNCATE TABLE `documentation`;
-- --------------------------------------------------------

--
-- Table structure for table `documentation_source`
--

DROP TABLE IF EXISTS `documentation_source`;
CREATE TABLE IF NOT EXISTS `documentation_source` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `documentation_source`
--

TRUNCATE TABLE `documentation_source`;
--
-- Dumping data for table `documentation_source`
--

INSERT INTO `documentation_source` (`id`, `description`) VALUES
(1, 'Projet'),
(2, 'Sprint'),
(3, 'Liste'),
(4, 'Tache');

-- --------------------------------------------------------

--
-- Table structure for table `liste`
--

DROP TABLE IF EXISTS `liste`;
CREATE TABLE IF NOT EXISTS `liste` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `creer_par_acteur_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;



-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `migrations`
--

TRUNCATE TABLE `migrations`;
-- --------------------------------------------------------

--
-- Table structure for table `projet`
--

DROP TABLE IF EXISTS `projet`;
CREATE TABLE IF NOT EXISTS `projet` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `date_du` date NOT NULL,
  `date_complete` date DEFAULT NULL,
  `creer_par_acteur_id` int(11) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `projet`
--

TRUNCATE TABLE `projet`;
--
-- Dumping data for table `projet`
--

INSERT INTO `projet` (`id`, `nom`, `description`, `date_du`, `date_complete`, `creer_par_acteur_id`, `date_creation`) VALUES
(1, 'premier projet', 'mon premier projet', '2017-11-30', NULL, 2, '2017-10-28 12:43:07');

-- --------------------------------------------------------

--
-- Table structure for table `projet_assignation`
--

DROP TABLE IF EXISTS `projet_assignation`;
CREATE TABLE IF NOT EXISTS `projet_assignation` (
  `projet_id` int(11) NOT NULL,
  `acteur_id` int(11) NOT NULL,
  `date_assignation` int(11) NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `projet_assignation`
--

TRUNCATE TABLE `projet_assignation`;
-- --------------------------------------------------------

--
-- Table structure for table `sprint`
--

DROP TABLE IF EXISTS `sprint`;
CREATE TABLE IF NOT EXISTS `sprint` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `numero` tinyint(3) UNSIGNED NOT NULL,
  `projet_id` int(11) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `creer_par_acteur_id` int(11) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `sprint`
--

TRUNCATE TABLE `sprint`;
--
-- Dumping data for table `sprint`
--

INSERT INTO `sprint` (`id`, `numero`, `projet_id`, `date_debut`, `date_fin`, `creer_par_acteur_id`, `date_creation`) VALUES
(1, 1, 1, '2017-10-01', '2017-10-31', 2, '2017-10-28 12:44:06');

-- --------------------------------------------------------

--
-- Table structure for table `sprint_activite`
--

DROP TABLE IF EXISTS `sprint_activite`;
CREATE TABLE IF NOT EXISTS `sprint_activite` (
  `sprint_id` int(11) NOT NULL,
  `liste_id` int(11) NOT NULL,
  `tache_id` int(11) NOT NULL,
  `actif` tinyint(1) NOT NULL,
  `creer_par_acteur_id` int(11) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `unique_sprint_activite` (`sprint_id`,`liste_id`,`tache_id`,`actif`) USING BTREE,
  KEY `fk_sprint_activite_liste_id` (`liste_id`),
  KEY `fk_sprint_activite_tache_id` (`tache_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `sprint_activite`
--

TRUNCATE TABLE `sprint_activite`;
-- --------------------------------------------------------

--
-- Table structure for table `tache`
--

DROP TABLE IF EXISTS `tache`;
CREATE TABLE IF NOT EXISTS `tache` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `creer_par_acteur_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `tache`
--

TRUNCATE TABLE `tache`;
--
-- Dumping data for table `tache`
--


-- --------------------------------------------------------

--
-- Structure for view `acteurs`
--
DROP TABLE IF EXISTS `acteurs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`projetrapide`@`localhost` SQL SECURITY DEFINER VIEW `acteurs`  AS  select concat('employe','_',`acteur_employe`.`id`) AS `key`,'employe' AS `type`,`acteur_employe`.`id` AS `id`,concat(`acteur_employe`.`prenom`,' ',`acteur_employe`.`nom`) AS `nom` from `acteur_employe` union select concat('client','_',`acteur_client`.`id`) AS `key`,'client' AS `type`,`acteur_client`.`id` AS `id`,`acteur_client`.`nom` AS `nom` from `acteur_client` ;

# Privileges for `projetrapide`@`%`
GRANT ALL PRIVILEGES ON *.* TO 'projetrapide'@'%' WITH GRANT OPTION;
# Privileges for `projetrapide`@`localhost`
GRANT USAGE ON *.* TO 'projetrapide'@'localhost';
GRANT ALL PRIVILEGES ON `projet_rapide`.* TO 'projetrapide'@'localhost';

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
