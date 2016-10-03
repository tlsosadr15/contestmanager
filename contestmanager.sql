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
CREATE DATABASE IF NOT EXISTS `contestmanager` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `contestmanager`;


-- Export de la structure de table contestmanager. school
DROP TABLE IF EXISTS `school`;
CREATE TABLE IF NOT EXISTS `school` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table contestmanager.school : ~3 rows (environ)
/*!40000 ALTER TABLE `school` DISABLE KEYS */;
INSERT INTO `school` (`id`, `name`) VALUES
	(1, 'Balzac');
INSERT INTO `school` (`id`, `name`) VALUES
	(2, 'Robespierre');
INSERT INTO `school` (`id`, `name`) VALUES
	(3, 'Essouriau');
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
  CONSTRAINT `FK_32993751DA42C2AC` FOREIGN KEY (`versus_id`) REFERENCES `versus` (`id`),
  CONSTRAINT `FK_32993751296CD8AE` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table contestmanager.score : ~0 rows (environ)
/*!40000 ALTER TABLE `score` DISABLE KEYS */;
INSERT INTO `score` (`id`, `team_id`, `versus_id`, `score`) VALUES
	(1, 2, 3, 23);
INSERT INTO `score` (`id`, `team_id`, `versus_id`, `score`) VALUES
	(2, 3, 3, 44);
INSERT INTO `score` (`id`, `team_id`, `versus_id`, `score`) VALUES
	(3, 1, 2, 28);
INSERT INTO `score` (`id`, `team_id`, `versus_id`, `score`) VALUES
	(4, 3, 2, 32);
/*!40000 ALTER TABLE `score` ENABLE KEYS */;


-- Export de la structure de table contestmanager. team
DROP TABLE IF EXISTS `team`;
CREATE TABLE IF NOT EXISTS `team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `arbiter_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_C4E0A61F164D8144` (`arbiter_id`),
  CONSTRAINT `FK_C4E0A61F164D8144` FOREIGN KEY (`arbiter_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table contestmanager.team : ~3 rows (environ)
/*!40000 ALTER TABLE `team` DISABLE KEYS */;
INSERT INTO `team` (`id`, `arbiter_id`, `name`) VALUES
	(1, 2, 'Team_un');
INSERT INTO `team` (`id`, `arbiter_id`, `name`) VALUES
	(2, 3, 'Team_deux');
INSERT INTO `team` (`id`, `arbiter_id`, `name`) VALUES
	(3, 4, 'Team_trois');
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
  CONSTRAINT `FK_8D93D649C32A47EE` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`),
  CONSTRAINT `FK_8D93D649296CD8AE` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table contestmanager.user : ~13 rows (environ)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `team_id`, `school_id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `first_name`, `last_name`, `type`) VALUES
	(1, NULL, NULL, 'admin', 'admin', 'admin@gmail.com', 'admin@gmail.com', 1, 'm07lx12fxdcog0404oo884scw4884gs', '$2y$13$m07lx12fxdcog0404oo88ud.nKaI1P6j6BJV8k7zWsV58xHUNuE8y', '2016-04-26 19:31:21', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 0, NULL, NULL, NULL, NULL);
INSERT INTO `user` (`id`, `team_id`, `school_id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `first_name`, `last_name`, `type`) VALUES
	(2, NULL, NULL, 'Gaston_Raymond', 'gaston_raymond', 'gaston.raymond@gmail.com', 'gaston.raymond@gmail.com', 1, 'kszjlhjaibk44w80ok0k80gccg80g4g', '$2y$13$kszjlhjaibk44w80ok0k8uS7c0Ew6yD4fV05SvWl.fTfNN3dDyqNW', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'Gaston', 'Raymond', NULL);
INSERT INTO `user` (`id`, `team_id`, `school_id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `first_name`, `last_name`, `type`) VALUES
	(3, NULL, NULL, 'Jules_Beaulac', 'jules_beaulac', 'jules.beaulac@gmail.com', 'jules.beaulac@gmail.com', 1, 'rsbrd2vopzk88g8ksscw8ssk4s040', '$2y$13$rsbrd2vopzk88g8ksscw8eN8oLPq48uyFcnU9tGrrWYbny15hAZ/m', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'Jules', 'Beaulac', NULL);
INSERT INTO `user` (`id`, `team_id`, `school_id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `first_name`, `last_name`, `type`) VALUES
	(4, NULL, NULL, 'Hugh_Charlebois', 'hugh_charlebois', 'hugh.charlebois@gmail.com', 'hugh.charlebois@gmail.com', 1, 'dwzhy84epz4088os0ssg4o0gc4ckwsk', '$2y$13$dwzhy84epz4088os0ssg4e5UCvtori82bcvXLQwVw9LWQyukkJLbO', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'Hugh', 'Charlebois', NULL);
INSERT INTO `user` (`id`, `team_id`, `school_id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `first_name`, `last_name`, `type`) VALUES
	(5, 1, 1, 'Ogier_Pellerin', 'ogier_pellerin', 'ogier.pellerin@gmail.com', 'ogier.pellerin@gmail.com', 1, 'i4zdl4955pcgk848ooc8wsk0880o4w8', '$2y$13$i4zdl4955pcgk848ooc8wew6/U6IYDzf9.Mz4SBMY/KFzU6l4.PBm', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'Ogier', 'Pellerin', NULL);
INSERT INTO `user` (`id`, `team_id`, `school_id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `first_name`, `last_name`, `type`) VALUES
	(6, 1, 1, 'Pierre_Chassé', 'pierre_chassé', 'pierre.chasse@gmail.com', 'pierre.chasse@gmail.com', 1, 'bdwj2jo4qk0s8cgck4oo8484ockoww4', '$2y$13$bdwj2jo4qk0s8cgck4oo8uPXfXNRoudmh8v.Vrrubka741NOapv.e', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'Pierre', 'Chassé', NULL);
INSERT INTO `user` (`id`, `team_id`, `school_id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `first_name`, `last_name`, `type`) VALUES
	(7, 1, 1, 'Stéphane_Giroux', 'stéphane_giroux', 'stephane.giroux@gmail.com', 'stephane.giroux@gmail.com', 1, 'bump92ihn5kwc04s0kwoc4ooko4k08o', '$2y$13$bump92ihn5kwc04s0kwocudfX4CUsGWzqfHZsKXBSMXtrWvb3sQpO', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'Stéphane', 'Giroux', NULL);
INSERT INTO `user` (`id`, `team_id`, `school_id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `first_name`, `last_name`, `type`) VALUES
	(8, 2, 2, 'Xavier_Auberjonois', 'xavier_auberjonois', 'xavier.auberjonois', 'xavier.auberjonois', 1, 'e5yersfw9k8oowogc48kwg8sw8g8s0c', '$2y$13$e5yersfw9k8oowogc48kweo926OzJu5NrQIWyzfa8mbeaoo06iVDG', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'Xavier', 'Auberjonois', NULL);
INSERT INTO `user` (`id`, `team_id`, `school_id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `first_name`, `last_name`, `type`) VALUES
	(9, 2, 2, 'Tanguy_Covillon', 'tanguy_covillon', 'tanguy.covillon', 'tanguy.covillon', 1, 'gptbxnnym40ssg8cow4gwco0cwc480', '$2y$13$gptbxnnym40ssg8cow4gwO/NchR7x6JGZ9LqhGT19x0vvtQ9ShG.a', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'Tanguy', 'Covillon', NULL);
INSERT INTO `user` (`id`, `team_id`, `school_id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `first_name`, `last_name`, `type`) VALUES
	(10, 2, 2, 'Jérôme_Parenteau', 'jérôme_parenteau', 'jerome.parenteau@gmail.com', 'jerome.parenteau@gmail.com', 1, 'e5yygw8v5vwoo4g4g00084oskcw0kg0', '$2y$13$e5yygw8v5vwoo4g4g0008uW7WYiNt.KRjblnWJf3/SngB8Ks7.4Oq', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'Jérôme', 'Parenteau', NULL);
INSERT INTO `user` (`id`, `team_id`, `school_id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `first_name`, `last_name`, `type`) VALUES
	(11, 3, 2, 'Marshall_Vincent', 'marshall_vincent', 'marshall.vincent@gmail.com', 'marshall.vincent@gmail.com', 1, 'ifs49bhpxrswgcg0k0sw4kscgkwgs4k', '$2y$13$ifs49bhpxrswgcg0k0sw4em3WNpqEOcrKF861vTlNrbkKSNSuv1BC', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'Marshall', 'Vincent', NULL);
INSERT INTO `user` (`id`, `team_id`, `school_id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `first_name`, `last_name`, `type`) VALUES
	(12, 3, 2, 'Odo_Édouard', 'odo_édouard', 'odo.edouard@gmail.com', 'odo.edouard@gmail.com', 1, '3r8efke8j5ycoogck880sg40o4k48cs', '$2y$13$3r8efke8j5ycoogck880seSAX23VdrHRHBHnRJwNe2CX723a6d3pe', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'Odo', 'Édouard', NULL);
INSERT INTO `user` (`id`, `team_id`, `school_id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `first_name`, `last_name`, `type`) VALUES
	(13, 3, 2, 'Ansel_Grivois', 'ansel_grivois', 'ansel.grivois@gmail.com', 'ansel.grivois@gmail.com', 1, 'jumit6rdww0484oc0s8gss8c8ocw00k', '$2y$13$jumit6rdww0484oc0s8gseukvCFwDKrvHudg7OTFSy9RCrv3oexHK', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'Ansel', 'Grivois', NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;


-- Export de la structure de table contestmanager. versus
DROP TABLE IF EXISTS `versus`;
CREATE TABLE IF NOT EXISTS `versus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team1_id` int(11) DEFAULT NULL,
  `team2_id` int(11) DEFAULT NULL,
  `date_match` datetime NOT NULL,
  `nb_table` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `finished` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_31AEA469E72BCFA4` (`team1_id`),
  KEY `IDX_31AEA469F59E604A` (`team2_id`),
  CONSTRAINT `FK_31AEA469F59E604A` FOREIGN KEY (`team2_id`) REFERENCES `team` (`id`),
  CONSTRAINT `FK_31AEA469E72BCFA4` FOREIGN KEY (`team1_id`) REFERENCES `team` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table contestmanager.versus : ~3 rows (environ)
/*!40000 ALTER TABLE `versus` DISABLE KEYS */;
INSERT INTO `versus` (`id`, `team1_id`, `team2_id`, `date_match`, `nb_table`, `finished`) VALUES
	(1, 1, 2, '2011-01-01 00:00:00', '23', 0);
INSERT INTO `versus` (`id`, `team1_id`, `team2_id`, `date_match`, `nb_table`, `finished`) VALUES
	(2, 1, 3, '2011-01-01 00:00:00', '45', 1);
INSERT INTO `versus` (`id`, `team1_id`, `team2_id`, `date_match`, `nb_table`, `finished`) VALUES
	(3, 2, 3, '2011-01-01 00:00:00', '7', 1);
/*!40000 ALTER TABLE `versus` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
