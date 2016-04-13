-- --------------------------------------------------------
-- Hôte :                        127.0.0.1
-- Version du serveur:           5.6.17 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Export de la structure de la base pour contestmanager
DROP DATABASE IF EXISTS `contestmanager`;
CREATE DATABASE IF NOT EXISTS `contestmanager` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `contestmanager`;


-- Export de la structure de table contestmanager. school
DROP TABLE IF EXISTS `school`;
CREATE TABLE IF NOT EXISTS `school` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table contestmanager.school : ~2 rows (environ)
/*!40000 ALTER TABLE `school` DISABLE KEYS */;
INSERT INTO `school` (`id`, `name`) VALUES
	(2, 'Pâquerettes');
INSERT INTO `school` (`id`, `name`) VALUES
	(3, 'Sainte Geneviève');
INSERT INTO `school` (`id`, `name`) VALUES
	(4, 'Balzac');
/*!40000 ALTER TABLE `school` ENABLE KEYS */;


-- Export de la structure de table contestmanager. score
DROP TABLE IF EXISTS `score`;
CREATE TABLE IF NOT EXISTS `score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` int(11) DEFAULT NULL,
  `versus_id` int(11) DEFAULT NULL,
  `score` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_32993751296CD8AE` (`team_id`),
  KEY `IDX_32993751DA42C2AC` (`versus_id`),
  CONSTRAINT `FK_32993751296CD8AE` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`),
  CONSTRAINT `FK_32993751DA42C2AC` FOREIGN KEY (`versus_id`) REFERENCES `versus` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table contestmanager.score : ~0 rows (environ)
/*!40000 ALTER TABLE `score` DISABLE KEYS */;
/*!40000 ALTER TABLE `score` ENABLE KEYS */;


-- Export de la structure de table contestmanager. team
DROP TABLE IF EXISTS `team`;
CREATE TABLE IF NOT EXISTS `team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `arbiter_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_C4E0A61F164D8144` (`arbiter_id`),
  CONSTRAINT `FK_C4E0A61F164D8144` FOREIGN KEY (`arbiter_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table contestmanager.team : ~4 rows (environ)
/*!40000 ALTER TABLE `team` DISABLE KEYS */;
INSERT INTO `team` (`id`, `name`, `arbiter_id`) VALUES
	(1, 'team_de_ouf', 4);
INSERT INTO `team` (`id`, `name`, `arbiter_id`) VALUES
	(2, 'team_de_null', 2);
INSERT INTO `team` (`id`, `name`, `arbiter_id`) VALUES
	(3, 'team3', 8);
INSERT INTO `team` (`id`, `name`, `arbiter_id`) VALUES
	(4, 'team4', 1);
INSERT INTO `team` (`id`, `name`, `arbiter_id`) VALUES
	(6, 'team5', 5);
/*!40000 ALTER TABLE `team` ENABLE KEYS */;


-- Export de la structure de table contestmanager. user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` int(11) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`),
  KEY `IDX_8D93D649296CD8AE` (`team_id`),
  KEY `IDX_8D93D649C32A47EE` (`school_id`),
  CONSTRAINT `FK_8D93D649296CD8AE` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`),
  CONSTRAINT `FK_8D93D649C32A47EE` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table contestmanager.user : ~7 rows (environ)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `team_id`, `school_id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `first_name`, `last_name`, `type`) VALUES
	(1, NULL, NULL, 'admin', 'admin', 'admin@gmail.com', 'admin@gmail.com', 1, '60rtdlw7evk8w08g40kko4ows880wcs', '$2y$13$60rtdlw7evk8w08g40kkou9IM1J6q2T9vZEuC6SrW2mKAg8mFSKou', '2016-04-13 11:24:27', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 0, NULL, 'admin', 'admin', NULL);
INSERT INTO `user` (`id`, `team_id`, `school_id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `first_name`, `last_name`, `type`) VALUES
	(2, NULL, 2, 'Éric_Arnoux', 'éric_arnoux', 'Arnoux@gmail.com', 'arnoux@gmail.com', 1, 'n7kf6oj8x1c4okg08c84swgs4kwcs8k', 'test', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'Éric', 'Arnoux', NULL);
INSERT INTO `user` (`id`, `team_id`, `school_id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `first_name`, `last_name`, `type`) VALUES
	(4, NULL, 3, 'Laetitia_Brodeur', 'laetitia_brodeur', 'Brodeur@gmail.com', 'brodeur@gmail.com', 1, '77ucz4d7c3wocwc00swo008gsgs4cgw', 'test', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'Laetitia', 'Brodeur', NULL);
INSERT INTO `user` (`id`, `team_id`, `school_id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `first_name`, `last_name`, `type`) VALUES
	(5, 1, 4, 'toto_tata', 'toto_tata', 'osef@gmail.com', 'osef@gmail.com', 1, 'jutz1e12iz48kcoc8wock0sk0cscwk4', 'test', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'toto', 'tata', NULL);
INSERT INTO `user` (`id`, `team_id`, `school_id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `first_name`, `last_name`, `type`) VALUES
	(7, 1, 4, 'lili_lala', 'lili_lala', 'lili@gmail.com', 'lili@gmail.com', 1, 'asq8t0n49ag4cswo4wc4gcg4gkwko04', 'test', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'lili', 'lala', NULL);
INSERT INTO `user` (`id`, `team_id`, `school_id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `first_name`, `last_name`, `type`) VALUES
	(8, 2, 4, 'gogo_gaga', 'gogo_gaga', 'gogo@gmail.com', 'gogo@gmail.com', 1, '3ddbwfhh9neo4g84o4wkwcgkc84k404', 'test', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'gogo', 'gaga', NULL);
INSERT INTO `user` (`id`, `team_id`, `school_id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `first_name`, `last_name`, `type`) VALUES
	(9, 2, 4, 'jojo_jaja', 'jojo_jaja', 'jaja@gmail.com', 'jaja@gmail.com', 1, 't5qp0rv3baosocc8gwcgk8400kwcs08', 'test', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'jojo', 'jaja', NULL);
INSERT INTO `user` (`id`, `team_id`, `school_id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `first_name`, `last_name`, `type`) VALUES
	(10, 1, 4, 'yiyi_yaya', 'yiyi_yaya', 'yaya@gmail.com', 'yaya@gmail.com', 1, 'izne7jnk5j400o0wswssc8scc040ocg', 'test', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'yiyi', 'yaya', NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;


-- Export de la structure de table contestmanager. versus
DROP TABLE IF EXISTS `versus`;
CREATE TABLE IF NOT EXISTS `versus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_match` datetime NOT NULL,
  `nb_table` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `team1_id` int(11) DEFAULT NULL,
  `team2_id` int(11) DEFAULT NULL,
  `finished` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_31AEA469E72BCFA4` (`team1_id`),
  KEY `IDX_31AEA469F59E604A` (`team2_id`),
  CONSTRAINT `FK_31AEA469E72BCFA4` FOREIGN KEY (`team1_id`) REFERENCES `team` (`id`),
  CONSTRAINT `FK_31AEA469F59E604A` FOREIGN KEY (`team2_id`) REFERENCES `team` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table contestmanager.versus : ~4 rows (environ)
/*!40000 ALTER TABLE `versus` DISABLE KEYS */;
INSERT INTO `versus` (`id`, `date_match`, `nb_table`, `team1_id`, `team2_id`, `finished`) VALUES
	(1, '2016-02-11 14:30:00', '23', 1, 2, 0);
INSERT INTO `versus` (`id`, `date_match`, `nb_table`, `team1_id`, `team2_id`, `finished`) VALUES
	(2, '2011-01-01 00:00:00', '23', 1, 3, 0);
INSERT INTO `versus` (`id`, `date_match`, `nb_table`, `team1_id`, `team2_id`, `finished`) VALUES
	(3, '2011-01-01 00:00:00', '23', 2, 4, 0);
INSERT INTO `versus` (`id`, `date_match`, `nb_table`, `team1_id`, `team2_id`, `finished`) VALUES
	(4, '2016-05-08 03:00:00', '12', 6, 2, 1);
INSERT INTO `versus` (`id`, `date_match`, `nb_table`, `team1_id`, `team2_id`, `finished`) VALUES
	(5, '2015-05-05 02:10:00', '56', 2, 3, 1);
/*!40000 ALTER TABLE `versus` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
