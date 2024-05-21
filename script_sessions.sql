-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour sfsessions
CREATE DATABASE IF NOT EXISTS `sfsessions` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sfsessions`;

-- Listage de la structure de la table sfsessions. apprenant
CREATE TABLE IF NOT EXISTS `apprenant` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `telephone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sfsessions.apprenant : ~3 rows (environ)
INSERT INTO `apprenant` (`id`, `nom`, `prenom`, `email`, `date_naissance`, `telephone`, `ville`) VALUES
	(1, 'VINCENT', 'Lucie', 'lucie.vincent@gmail.com', '1994-11-22', '0601020304', 'STRASBOURG'),
	(2, 'JARDIN', 'Pauline', 'pauline.jardin@gmail.com', '1991-05-21', '0701020304', 'STRASBOURG'),
	(3, 'PETIT', 'Robert', 'robert.petit@gmail.com', '1981-03-10', '0602030405', 'SCHILTIGHEIM');

-- Listage de la structure de la table sfsessions. apprenant_session
CREATE TABLE IF NOT EXISTS `apprenant_session` (
  `apprenant_id` int NOT NULL,
  `session_id` int NOT NULL,
  PRIMARY KEY (`apprenant_id`,`session_id`),
  KEY `IDX_F3DA1D4C5697D6D` (`apprenant_id`),
  KEY `IDX_F3DA1D4613FECDF` (`session_id`),
  CONSTRAINT `FK_F3DA1D4613FECDF` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_F3DA1D4C5697D6D` FOREIGN KEY (`apprenant_id`) REFERENCES `apprenant` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sfsessions.apprenant_session : ~0 rows (environ)

-- Listage de la structure de la table sfsessions. categorie
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `intitule` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sfsessions.categorie : ~3 rows (environ)
INSERT INTO `categorie` (`id`, `intitule`) VALUES
	(1, 'Bureautique'),
	(2, 'Développement web'),
	(3, 'Infographie');

-- Listage de la structure de la table sfsessions. messenger_messages
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sfsessions.messenger_messages : ~0 rows (environ)

-- Listage de la structure de la table sfsessions. programme
CREATE TABLE IF NOT EXISTS `programme` (
  `id` int NOT NULL AUTO_INCREMENT,
  `duree` int NOT NULL,
  `session_id` int NOT NULL,
  `unite_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3DDCB9FF613FECDF` (`session_id`),
  KEY `IDX_3DDCB9FFEC4A74AB` (`unite_id`),
  CONSTRAINT `FK_3DDCB9FF613FECDF` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`),
  CONSTRAINT `FK_3DDCB9FFEC4A74AB` FOREIGN KEY (`unite_id`) REFERENCES `unite` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sfsessions.programme : ~13 rows (environ)
INSERT INTO `programme` (`id`, `duree`, `session_id`, `unite_id`) VALUES
	(1, 2, 1, 1),
	(2, 2, 1, 2),
	(3, 4, 1, 5),
	(4, 4, 1, 6),
	(5, 3, 1, 7),
	(6, 3, 2, 8),
	(7, 3, 2, 9),
	(8, 3, 2, 10),
	(9, 4, 3, 11),
	(10, 4, 3, 12),
	(11, 2, 3, 10),
	(12, 2, 3, 9),
	(13, 2, 3, 8);

-- Listage de la structure de la table sfsessions. session
CREATE TABLE IF NOT EXISTS `session` (
  `id` int NOT NULL AUTO_INCREMENT,
  `intitule` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_places` int NOT NULL,
  `est_cloturee` tinyint(1) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sfsessions.session : ~4 rows (environ)
INSERT INTO `session` (`id`, `intitule`, `nb_places`, `est_cloturee`, `date_debut`, `date_fin`) VALUES
	(1, 'Initiation Bureautique et Infographie', 15, 0, '2024-06-21', '2024-06-07'),
	(2, 'Initiation Développement Web', 15, 0, '2024-06-21', '2024-06-07'),
	(3, 'Perfectionnement Développement Web', 15, 0, '2024-06-21', '2024-06-07'),
	(4, 'Initiation à Word et Excel', 15, 0, '2024-06-21', '2024-06-07');

-- Listage de la structure de la table sfsessions. unite
CREATE TABLE IF NOT EXISTS `unite` (
  `id` int NOT NULL AUTO_INCREMENT,
  `intitule` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorie_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1D64C118BCF5E72D` (`categorie_id`),
  CONSTRAINT `FK_1D64C118BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table sfsessions.unite : ~11 rows (environ)
INSERT INTO `unite` (`id`, `intitule`, `categorie_id`) VALUES
	(1, 'Word', 1),
	(2, 'Excel', 1),
	(3, 'Powerpoint', 1),
	(5, 'Photoshop', 3),
	(6, 'Illustrator', 3),
	(7, 'InDesign', 3),
	(8, 'HTML', 2),
	(9, 'CSS', 2),
	(10, 'JavaScript', 2),
	(11, 'PHP', 2),
	(12, 'SQL', 2);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
