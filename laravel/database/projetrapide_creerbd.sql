-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 09, 2017 at 03:50 AM
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
-- Table structure for table `acteurs`
--

DROP TABLE IF EXISTS `acteurs`;
CREATE TABLE IF NOT EXISTS `acteurs` (
  `key` varchar(18) DEFAULT NULL,
  `type` varchar(7) DEFAULT NULL,
  `id` int(11) UNSIGNED DEFAULT NULL,
  `nom` varchar(101) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
  `photo` varchar(50) NOT NULL DEFAULT '45x45.jpg',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acteur_employe`
--

INSERT INTO `acteur_employe` (`id`, `prenom`, `nom`, `actif`, `courriel`, `telephone`, `updated_at`, `created_at`, `photo`) VALUES
(2, 'Alain', 'Bessette', 1, NULL, 0, '2017-11-09 22:16:16', '2017-11-09 22:16:16', 'alain.jpg'),
(3, 'Caroline', 'Cote', 1, NULL, 0, '2017-11-09 22:16:16', '2017-11-09 22:16:16', 'caroline.jpg'),
(4, 'Mathieu', 'Novis', 1, NULL, 0, '2017-11-09 22:16:16', '2017-11-09 22:16:16', 'mathieur.jpg'),
(5, 'alain33333', 'aaa', 1, NULL, 0, '2017-11-10 03:16:58', '2017-11-10 03:16:58', '45x45.jpg');

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
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `projet_id` int(11) NOT NULL,
  `tache_id` int(11) NOT NULL,
  `creer_par_acteur_id` int(11) NOT NULL,
  `commentaire` varchar(8000) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `commentaire`
--

INSERT INTO `commentaire` (`id`, `projet_id`, `tache_id`, `creer_par_acteur_id`, `commentaire`, `created_at`, `updated_at`) VALUES
(22, 14, 406, 2, 'hhhh', '2017-12-08 22:17:15', '2017-12-08 22:17:15');

-- --------------------------------------------------------

--
-- Table structure for table `commentaire_projet`
--

DROP TABLE IF EXISTS `commentaire_projet`;
CREATE TABLE IF NOT EXISTS `commentaire_projet` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `projet_id` int(11) NOT NULL,
  `commentaire` varchar(8000) NOT NULL,
  `creer_par_acteur_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `commentaire_projet`
--

INSERT INTO `commentaire_projet` (`id`, `projet_id`, `commentaire`, `creer_par_acteur_id`, `updated_at`, `created_at`) VALUES
(1, 14, 'dddd', 1, '2017-12-09 03:18:01', '2017-12-09 03:18:01'),
(2, 14, 'dd', 1, '2017-12-09 03:19:41', '2017-12-09 03:19:41'),
(3, 14, 'ddddd', 1, '2017-12-09 03:21:17', '2017-12-09 03:21:17'),
(4, 14, 'ddddd', 1, '2017-12-09 03:21:21', '2017-12-09 03:21:21'),
(5, 14, 'ddddd', 1, '2017-12-09 03:21:35', '2017-12-09 03:21:35'),
(6, 14, 'ddddd d sf dfsfd  dfasf asdf d mkdfaksdfa;sl jfajfasjf;jasodifjoa sidfoijasodfjaosidjfoa jisdfioas dofjoajisiofjaosdfjioaifojasofj aosjfoiajsd ofijasodfjjjjjsdfoajf ojiasoifjosjdfoi', 1, '2017-12-09 03:22:07', '2017-12-09 03:22:07'),
(7, 14, 'd', 1, '2017-12-09 03:22:16', '2017-12-09 03:22:16'),
(8, 14, 't', 1, '2017-12-09 03:22:46', '2017-12-09 03:22:46'),
(9, 14, 'ddddd', 1, '2017-12-09 03:28:20', '2017-12-09 03:28:20');

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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
  `texte` varchar(8000) DEFAULT NULL,
  `creer_par_acteur_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
) ENGINE=MyISAM AUTO_INCREMENT=374 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(16, '2014_10_12_000000_create_users_table', 1),
(17, '2014_10_12_100000_create_password_resets_table', 1),
(18, '2017_12_02_192317_create_admins_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `projet`
--

INSERT INTO `projet` (`id`, `nom`, `description`, `date_du`, `date_complete`, `creer_par_acteur_id`, `created_at`, `updated_at`) VALUES
(14, 'Premier projet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla non tellus sapien. Curabitur rhoncus justo vel arcu consectetur vestibulum. Donec imperdiet lectus in erat semper, ac pharetra odio blandit. Mauris nec neque nunc. Pellentesque pulvinar vehicula gravida. Nullam eu neque lorem. In eget sem commodo, ornare massa a, rhoncus risus. Quisque vel tincidunt mi. Morbi ultrices justo at nunc fermentum fringilla. Nulla at ipsum ornare, placerat ex vel, feugiat odio. ', '2017-12-01', NULL, 2, '2017-12-08 16:42:04', '2017-12-08 16:42:04'),
(15, 'Deuxieme projet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla non tellus sapien. Curabitur rhoncus justo vel arcu consectetur vestibulum. Donec imperdiet lectus in erat semper, ac pharetra odio blandit. Mauris nec neque nunc. Pellentesque pulvinar vehicula gravida. Nullam eu neque lorem. In eget sem commodo, ornare massa a, rhoncus risus. Quisque vel tincidunt mi. Morbi ultrices justo at nunc fermentum fringilla. Nulla at ipsum ornare, placerat ex vel, feugiat odio. ', '2017-12-01', NULL, 2, '2017-12-08 16:42:04', '2017-12-08 16:42:04'),
(16, 'Troisieme projet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla non tellus sapien. Curabitur rhoncus justo vel arcu consectetur vestibulum. Donec imperdiet lectus in erat semper, ac pharetra odio blandit. Mauris nec neque nunc. Pellentesque pulvinar vehicula gravida. Nullam eu neque lorem. In eget sem commodo, ornare massa a, rhoncus risus. Quisque vel tincidunt mi. Morbi ultrices justo at nunc fermentum fringilla. Nulla at ipsum ornare, placerat ex vel, feugiat odio. ', '2017-12-01', NULL, 2, '2017-12-08 16:42:04', '2017-12-08 16:42:04'),
(17, 'Quatrieme projet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla non tellus sapien. Curabitur rhoncus justo vel arcu consectetur vestibulum. Donec imperdiet lectus in erat semper, ac pharetra odio blandit. Mauris nec neque nunc. Pellentesque pulvinar vehicula gravida. Nullam eu neque lorem. In eget sem commodo, ornare massa a, rhoncus risus. Quisque vel tincidunt mi. Morbi ultrices justo at nunc fermentum fringilla. Nulla at ipsum ornare, placerat ex vel, feugiat odio. ', '2017-12-01', NULL, 2, '2017-12-08 16:42:04', '2017-12-08 16:42:04'),
(18, 'Cinquieme projet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla non tellus sapien. Curabitur rhoncus justo vel arcu consectetur vestibulum. Donec imperdiet lectus in erat semper, ac pharetra odio blandit. Mauris nec neque nunc. Pellentesque pulvinar vehicula gravida. Nullam eu neque lorem. In eget sem commodo, ornare massa a, rhoncus risus. Quisque vel tincidunt mi. Morbi ultrices justo at nunc fermentum fringilla. Nulla at ipsum ornare, placerat ex vel, feugiat odio. ', '2017-12-01', NULL, 2, '2017-12-08 16:42:04', '2017-12-08 16:42:04');

-- --------------------------------------------------------

--
-- Table structure for table `projet_assignation`
--

DROP TABLE IF EXISTS `projet_assignation`;
CREATE TABLE IF NOT EXISTS `projet_assignation` (
  `projet_id` int(11) NOT NULL,
  `acteur_id` int(11) NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '1',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
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
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sprint_activite`
--

DROP TABLE IF EXISTS `sprint_activite`;
CREATE TABLE IF NOT EXISTS `sprint_activite` (
  `projet_id` int(11) NOT NULL,
  `sprint_id` int(11) NOT NULL,
  `liste_id` int(11) DEFAULT NULL,
  `tache_id` int(11) DEFAULT NULL,
  `ordre` tinyint(4) DEFAULT NULL,
  `actif` tinyint(1) NOT NULL,
  `creer_par_acteur_id` int(11) NOT NULL,
  `assigne_acteur_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
) ENGINE=MyISAM AUTO_INCREMENT=424 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '45x45.png',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_name_unique` (`name`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `telephone`, `photo`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'alain', 'alain@a.com', NULL, '45x45.png', '$2y$10$GZCm/hCj1JsUlCNoX.rdSuulskL5kN96vtd6mGl1KzX6pHVEyjv4G', NULL, '2017-12-09 02:53:27', '2017-12-09 02:53:27');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_commentaires`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `vw_commentaires`;
CREATE TABLE IF NOT EXISTS `vw_commentaires` (
`id` int(10) unsigned
,`projet_id` int(11)
,`tache_id` int(11)
,`commentaire` varchar(8000)
,`date_creation` timestamp
,`nom_employe` varchar(191)
,`photo` varchar(30)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_commentaires_projet`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `vw_commentaires_projet`;
CREATE TABLE IF NOT EXISTS `vw_commentaires_projet` (
`id` int(10) unsigned
,`projet_id` int(11)
,`commentaire` varchar(8000)
,`date_creation` timestamp
,`nom_employe` varchar(191)
,`photo` varchar(30)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_sprint_activite_actif`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `vw_sprint_activite_actif`;
CREATE TABLE IF NOT EXISTS `vw_sprint_activite_actif` (
`projet_id` int(10) unsigned
,`projet_nom` varchar(50)
,`projet_description` varchar(500)
,`projet_date_du` date
,`projet_date_complete` date
,`sprint_id` int(10) unsigned
,`sprint_numero` tinyint(3) unsigned
,`sprint_date_debut` date
,`sprint_date_fin` date
,`liste_id` int(10) unsigned
,`liste_nom` varchar(50)
,`liste_description` varchar(200)
,`tache_id` int(10) unsigned
,`tache_nom` varchar(50)
,`tache_description` varchar(500)
,`tache_ordre` tinyint(4)
);

-- --------------------------------------------------------

--
-- Structure for view `vw_commentaires`
--
DROP TABLE IF EXISTS `vw_commentaires`;

CREATE ALGORITHM=UNDEFINED DEFINER=`projetrapide`@`%` SQL SECURITY DEFINER VIEW `vw_commentaires`  AS  select `c`.`id` AS `id`,`c`.`projet_id` AS `projet_id`,`c`.`tache_id` AS `tache_id`,`c`.`commentaire` AS `commentaire`,`c`.`created_at` AS `date_creation`,`ae`.`name` AS `nom_employe`,`ae`.`photo` AS `photo` from (`commentaire` `c` join `users` `ae` on((`ae`.`id` = `c`.`creer_par_acteur_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_commentaires_projet`
--
DROP TABLE IF EXISTS `vw_commentaires_projet`;

CREATE ALGORITHM=UNDEFINED DEFINER=`projetrapide`@`%` SQL SECURITY DEFINER VIEW `vw_commentaires_projet`  AS  select `c`.`id` AS `id`,`c`.`projet_id` AS `projet_id`,`c`.`commentaire` AS `commentaire`,`c`.`created_at` AS `date_creation`,`ae`.`name` AS `nom_employe`,`ae`.`photo` AS `photo` from (`commentaire_projet` `c` join `users` `ae` on((`ae`.`id` = `c`.`creer_par_acteur_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_sprint_activite_actif`
--
DROP TABLE IF EXISTS `vw_sprint_activite_actif`;

CREATE ALGORITHM=UNDEFINED DEFINER=`projetrapide`@`%` SQL SECURITY DEFINER VIEW `vw_sprint_activite_actif`  AS  select `projet`.`id` AS `projet_id`,`projet`.`nom` AS `projet_nom`,`projet`.`description` AS `projet_description`,`projet`.`date_du` AS `projet_date_du`,`projet`.`date_complete` AS `projet_date_complete`,`sprint`.`id` AS `sprint_id`,`sprint`.`numero` AS `sprint_numero`,`sprint`.`date_debut` AS `sprint_date_debut`,`sprint`.`date_fin` AS `sprint_date_fin`,`liste`.`id` AS `liste_id`,`liste`.`nom` AS `liste_nom`,`liste`.`description` AS `liste_description`,`tache`.`id` AS `tache_id`,`tache`.`nom` AS `tache_nom`,`tache`.`description` AS `tache_description`,`sa`.`ordre` AS `tache_ordre` from ((((`sprint_activite` `sa` join `projet` on((`sa`.`projet_id` = `projet`.`id`))) join `sprint` on(((`sprint`.`id` = `sa`.`sprint_id`) and (`sa`.`projet_id` = `sprint`.`projet_id`)))) left join `liste` on((`liste`.`id` = `sa`.`liste_id`))) left join `tache` on((`tache`.`id` = `sa`.`tache_id`))) where (`sa`.`actif` = 1) ;



# Privileges for `projetrapide`@`%`

GRANT ALL PRIVILEGES ON *.* TO 'projetrapide'@'%' WITH GRANT OPTION;


# Privileges for `projetrapide`@`localhost`

GRANT ALL PRIVILEGES ON *.* TO 'projetrapide'@'localhost' WITH GRANT OPTION;

GRANT ALL PRIVILEGES ON `projet_rapide`.* TO 'projetrapide'@'localhost';


# Privileges for `root`@`localhost`

GRANT ALL PRIVILEGES ON *.* TO 'root'@'localhost' WITH GRANT OPTION;

GRANT PROXY ON ''@'' TO 'root'@'localhost' WITH GRANT OPTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
