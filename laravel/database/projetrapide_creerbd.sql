-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 11, 2017 at 06:08 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;


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
  `creer_par_acteur_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acteur_client`
--

INSERT INTO `acteur_client` (`id`, `nom`, `contact`, `telephone`, `adresse`, `code_postal`, `creer_par_acteur_id`, `created_at`, `updated_at`) VALUES
(1, 'Les Entreprises XYZ inc.', 'Joe Beef', 514555123, '1 rue des boeufs, montreal, quebec', 'H1H1H1', 2, '2017-11-11 13:05:13', '2017-11-11 13:05:13');

-- --------------------------------------------------------

--
-- Table structure for table `acteur_employe`
--

DROP TABLE IF EXISTS `acteur_employe`;
CREATE TABLE IF NOT EXISTS `acteur_employe` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `actif` tinyint(1) NOT NULL,
  `courriel` varchar(100) DEFAULT NULL,
  `telephone` bigint(12) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acteur_employe`
--

INSERT INTO `acteur_employe` (`id`, `prenom`, `nom`, `actif`, `courriel`, `telephone`, `updated_at`, `created_at`) VALUES
(2, 'Alain', 'Bessette', 1, NULL, 0, '2017-11-09 22:16:16', '2017-11-09 22:16:16'),
(3, 'Caroline', 'Cote', 1, NULL, 0, '2017-11-09 22:16:16', '2017-11-09 22:16:16'),
(4, 'Mathieu', 'Novis', 1, NULL, 0, '2017-11-09 22:16:16', '2017-11-09 22:16:16'),
(5, 'alain33333', 'aaa', 1, NULL, 0, '2017-11-10 03:16:58', '2017-11-10 03:16:58');

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
-- Dumping data for table `acteur_role`
--

INSERT INTO `acteur_role` (`acteur_id`, `acteur_type`, `date_creation`, `actif`) VALUES
(2, 2, '2017-10-21 11:29:08', 1),
(3, 1, '2017-10-21 11:29:08', 1),
(4, 2, '2017-10-21 11:29:50', 1),
(1, 3, '2017-10-21 11:30:12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `acteur_type`
--

DROP TABLE IF EXISTS `acteur_type`;
CREATE TABLE IF NOT EXISTS `acteur_type` (
  `id` tinyint(10) UNSIGNED NOT NULL,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `liste`
--

INSERT INTO `liste` (`id`, `nom`, `description`, `creer_par_acteur_id`, `created_at`, `updated_at`) VALUES
(44, 'akakakk', 'dd', 2, '2017-11-10 03:21:07', '2017-11-10 03:21:07'),
(45, 'aaa', 'aaa', 2, '2017-11-10 03:34:04', '2017-11-10 03:34:04'),
(46, 'ddd', 'ddd', 2, '2017-11-10 03:39:19', '2017-11-10 03:39:19'),
(47, 'aaa', 'aaa', 2, '2017-11-11 17:07:34', '2017-11-11 17:07:34');

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
-- Dumping data for table `projet`
--

INSERT INTO `projet` (`id`, `nom`, `description`, `date_du`, `date_complete`, `creer_par_acteur_id`, `date_creation`) VALUES
(1, 'premier projet', 'mon premier projet', '2017-11-30', NULL, 2, '2017-10-28 08:43:07');

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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sprint`
--

INSERT INTO `sprint` (`id`, `numero`, `projet_id`, `date_debut`, `date_fin`, `creer_par_acteur_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2017-10-01', '2017-10-31', 2, '2017-11-11 13:04:15', '2017-11-11 13:04:15');

-- --------------------------------------------------------

--
-- Table structure for table `sprint_activite`
--

DROP TABLE IF EXISTS `sprint_activite`;
CREATE TABLE IF NOT EXISTS `sprint_activite` (
  `projet_id` int(11) NOT NULL,
  `sprint_id` int(11) NOT NULL,
  `liste_id` int(11) NOT NULL,
  `tache_id` int(11) NOT NULL,
  `actif` tinyint(1) NOT NULL,
  `creer_par_acteur_id` int(11) NOT NULL,
  `assigne_acteur_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `unique_sprint_activite` (`sprint_id`,`liste_id`,`tache_id`,`actif`) USING BTREE,
  KEY `fk_sprint_activite_liste_id` (`liste_id`),
  KEY `fk_sprint_activite_tache_id` (`tache_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tache`
--

INSERT INTO `tache` (`id`, `nom`, `description`, `creer_par_acteur_id`, `created_at`, `updated_at`) VALUES
(1, 'ddd', 'ddd', 2, '2017-11-10 03:21:16', '2017-11-10 03:21:16'),
(2, 'ddd', 'ddd', 2, '2017-11-10 03:34:12', '2017-11-10 03:34:12'),
(3, 'ddd', 'ddddd', 2, '2017-11-10 03:39:33', '2017-11-10 03:39:33'),
(4, 'aaa', 'aaa', 2, '2017-11-11 17:07:41', '2017-11-11 17:07:41');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_sprint_activite_actif`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `vw_sprint_activite_actif`;
CREATE TABLE IF NOT EXISTS `vw_sprint_activite_actif` (
`activite_cpa_id` int(10) unsigned
,`activite_cpa_nom` double
,`emp_assigne_id` int(10) unsigned
,`emp_assigne_nom` double
,`emp_assigne_courriel` varchar(100)
,`emp_assigne_telephone` bigint(12)
,`sprint_id` int(10) unsigned
,`sprint_numero` tinyint(3) unsigned
,`sprint_cpa_id` int(10) unsigned
,`sprint_cpa_nom` double
,`liste_id` int(10) unsigned
,`liste_nom` varchar(50)
,`liste_cpa_id` int(10) unsigned
,`liste_cpa_nom` double
,`nom` varchar(50)
,`description` varchar(500)
,`tache_cpa_id` int(10) unsigned
,`tache_cpa_nom` double
);

-- --------------------------------------------------------

--
-- Structure for view `acteurs`
--
DROP TABLE IF EXISTS `acteurs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`projetrapide`@`localhost` SQL SECURITY DEFINER VIEW `acteurs`  AS  select concat('employe','_',`acteur_employe`.`id`) AS `key`,'employe' AS `type`,`acteur_employe`.`id` AS `id`,concat(`acteur_employe`.`prenom`,' ',`acteur_employe`.`nom`) AS `nom` from `acteur_employe` union select concat('client','_',`acteur_client`.`id`) AS `key`,'client' AS `type`,`acteur_client`.`id` AS `id`,`acteur_client`.`nom` AS `nom` from `acteur_client` ;

-- --------------------------------------------------------

--
-- Structure for view `vw_sprint_activite_actif`
--
DROP TABLE IF EXISTS `vw_sprint_activite_actif`;

CREATE ALGORITHM=UNDEFINED DEFINER=`projetrapide`@`%` SQL SECURITY DEFINER VIEW `vw_sprint_activite_actif`  AS  select `sa_ae`.`id` AS `activite_cpa_id`,((`sa_ae`.`prenom` + ' ') + `sa_ae`.`nom`) AS `activite_cpa_nom`,`sa_assigne_ae`.`id` AS `emp_assigne_id`,((`sa_assigne_ae`.`prenom` + ' ') + `sa_assigne_ae`.`nom`) AS `emp_assigne_nom`,`sa_assigne_ae`.`courriel` AS `emp_assigne_courriel`,`sa_assigne_ae`.`telephone` AS `emp_assigne_telephone`,`sprint`.`id` AS `sprint_id`,`sprint`.`numero` AS `sprint_numero`,`sprint_ae`.`id` AS `sprint_cpa_id`,((`sprint_ae`.`prenom` + ' ') + `sprint_ae`.`nom`) AS `sprint_cpa_nom`,`liste`.`id` AS `liste_id`,`liste`.`nom` AS `liste_nom`,`liste_ae`.`id` AS `liste_cpa_id`,((`liste_ae`.`prenom` + ' ') + `liste_ae`.`nom`) AS `liste_cpa_nom`,`tache`.`nom` AS `nom`,`tache`.`description` AS `description`,`tache_ae`.`id` AS `tache_cpa_id`,((`tache_ae`.`prenom` + ' ') + `tache_ae`.`nom`) AS `tache_cpa_nom` from ((((((((`sprint_activite` `sa` join `acteur_employe` `sa_ae` on((`sa`.`creer_par_acteur_id` = `sa_ae`.`id`))) join `acteur_employe` `sa_assigne_ae` on((`sa`.`assigne_acteur_id` = `sa_assigne_ae`.`id`))) join `sprint` on(((`sprint`.`id` = `sa`.`sprint_id`) and (`sa`.`projet_id` = `sprint`.`projet_id`)))) join `acteur_employe` `sprint_ae` on(((`sprint`.`creer_par_acteur_id` = `sprint_ae`.`id`) and (`sprint`.`projet_id` = `sa`.`projet_id`)))) join `liste` on((`liste`.`id` = `sa`.`liste_id`))) join `acteur_employe` `liste_ae` on((`liste`.`creer_par_acteur_id` = `liste_ae`.`id`))) join `tache` on((`tache`.`id` = `sa`.`tache_id`))) join `acteur_employe` `tache_ae` on((`tache`.`creer_par_acteur_id` = `tache_ae`.`id`))) where (`sa`.`actif` = 1) ;

# Privileges for `projetrapide`@`%`

GRANT ALL PRIVILEGES ON *.* TO 'projetrapide'@'%' WITH GRANT OPTION;


# Privileges for `projetrapide`@`localhost`

GRANT ALL PRIVILEGES ON *.* TO 'projetrapide'@'localhost' WITH GRANT OPTION;

GRANT ALL PRIVILEGES ON `projet_rapide`.* TO 'projetrapide'@'localhost';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
