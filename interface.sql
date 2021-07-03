-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 03 juil. 2021 à 22:07
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `interface`
--

-- --------------------------------------------------------

--
-- Structure de la table `abscence`
--

DROP TABLE IF EXISTS `abscence`;
CREATE TABLE IF NOT EXISTS `abscence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_seance_id` int(11) DEFAULT NULL,
  `id_etudiant_id` int(11) DEFAULT NULL,
  `justifee` tinyint(1) NOT NULL,
  `commentaire_abscence` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BD71CDA634CC6B3` (`id_seance_id`),
  KEY `IDX_BD71CDAC5F87C54` (`id_etudiant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_admin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_admin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_admin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

DROP TABLE IF EXISTS `avis`;
CREATE TABLE IF NOT EXISTS `avis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_admin_id` int(11) NOT NULL,
  `title_avis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_avis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_avis` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8F91ABF034F06E85` (`id_admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

DROP TABLE IF EXISTS `classe`;
CREATE TABLE IF NOT EXISTS `classe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_specialite_id` int(11) DEFAULT NULL,
  `niveau_classe` int(11) NOT NULL,
  `num_classe` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8F87BF969FBD3195` (`id_specialite_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_publication_id` int(11) DEFAULT NULL,
  `id_user_id` int(11) DEFAULT NULL,
  `description_commentaire` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_commentaire` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_67F068BC5D4AAA1` (`id_publication_id`),
  KEY `IDX_67F068BC79F37AE5` (`id_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

DROP TABLE IF EXISTS `cours`;
CREATE TABLE IF NOT EXISTS `cours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_classe_id` int(11) DEFAULT NULL,
  `support_cours` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FDCA8C9CF6B192E` (`id_classe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

DROP TABLE IF EXISTS `departement`;
CREATE TABLE IF NOT EXISTS `departement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_departement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ab_departement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210703143836', '2021-07-03 14:38:47', 1213),
('DoctrineMigrations\\Version20210703152830', '2021-07-03 15:28:36', 428),
('DoctrineMigrations\\Version20210703153011', '2021-07-03 15:30:20', 585),
('DoctrineMigrations\\Version20210703175819', '2021-07-03 17:58:25', 467),
('DoctrineMigrations\\Version20210703180157', '2021-07-03 18:02:00', 371),
('DoctrineMigrations\\Version20210703215932', '2021-07-03 21:59:43', 21133);

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

DROP TABLE IF EXISTS `enseignant`;
CREATE TABLE IF NOT EXISTS `enseignant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_enseignant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_enseignant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse_enseignant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville_enseignant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_enseignant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_enseignant` int(11) NOT NULL,
  `prix_heure` double NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationalite` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_passport` int(11) DEFAULT NULL,
  `cin` int(11) DEFAULT NULL,
  `nom_etudiant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_etudiant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naiss` date NOT NULL,
  `paye_naiss` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paye_etudiant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville_etudiant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_etudiant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_etudiant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_etudiant` int(11) NOT NULL,
  `phono_urgence` int(11) NOT NULL,
  `session` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_ajout` date NOT NULL,
  `num_image` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

DROP TABLE IF EXISTS `matiere`;
CREATE TABLE IF NOT EXISTS `matiere` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_enseignant_id` int(11) DEFAULT NULL,
  `id_specialite_id` int(11) DEFAULT NULL,
  `note_id` int(11) DEFAULT NULL,
  `nom_matiere` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `moyenne_matiere` double NOT NULL,
  `coeff_matiere` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9014574A5A7D2DA5` (`id_enseignant_id`),
  KEY `IDX_9014574A9FBD3195` (`id_specialite_id`),
  KEY `IDX_9014574A26ED0855` (`note_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

DROP TABLE IF EXISTS `note`;
CREATE TABLE IF NOT EXISTS `note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_etudiant_id` int(11) DEFAULT NULL,
  `note_examen` double NOT NULL,
  `note_test` double NOT NULL,
  `moyenne_note` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_CFBDFA14C5F87C54` (`id_etudiant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `publication`
--

DROP TABLE IF EXISTS `publication`;
CREATE TABLE IF NOT EXISTS `publication` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cours_id` int(11) DEFAULT NULL,
  `id_user_id` int(11) DEFAULT NULL,
  `description_publication` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_publication` date NOT NULL,
  `nb_comment` int(11) NOT NULL,
  `nb_vue` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_AF3C67792E149425` (`id_cours_id`),
  KEY `IDX_AF3C677979F37AE5` (`id_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reclamation`
--

DROP TABLE IF EXISTS `reclamation`;
CREATE TABLE IF NOT EXISTS `reclamation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user_id` int(11) NOT NULL,
  `title_reclamation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_reclamation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_reclamation` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_CE60640479F37AE5` (`id_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `seance`
--

DROP TABLE IF EXISTS `seance`;
CREATE TABLE IF NOT EXISTS `seance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_seance` date NOT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  `nbr_minute` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `semestre`
--

DROP TABLE IF EXISTS `semestre`;
CREATE TABLE IF NOT EXISTS `semestre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_specialite_id` int(11) NOT NULL,
  `payement_semestre` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_71688FBC9FBD3195` (`id_specialite_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `semestre_etudiant`
--

DROP TABLE IF EXISTS `semestre_etudiant`;
CREATE TABLE IF NOT EXISTS `semestre_etudiant` (
  `semestre_id` int(11) NOT NULL,
  `etudiant_id` int(11) NOT NULL,
  PRIMARY KEY (`semestre_id`,`etudiant_id`),
  KEY `IDX_3D21F9A5577AFDB` (`semestre_id`),
  KEY `IDX_3D21F9ADDEAB1A3` (`etudiant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `specialite`
--

DROP TABLE IF EXISTS `specialite`;
CREATE TABLE IF NOT EXISTS `specialite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_specialite` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duree_specialite` int(11) NOT NULL,
  `nbr_semestre` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `classe_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8D93D6498F5EA509` (`classe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `abscence`
--
ALTER TABLE `abscence`
  ADD CONSTRAINT `FK_BD71CDA634CC6B3` FOREIGN KEY (`id_seance_id`) REFERENCES `seance` (`id`),
  ADD CONSTRAINT `FK_BD71CDAC5F87C54` FOREIGN KEY (`id_etudiant_id`) REFERENCES `etudiant` (`id`);

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `FK_8F91ABF034F06E85` FOREIGN KEY (`id_admin_id`) REFERENCES `admin` (`id`);

--
-- Contraintes pour la table `classe`
--
ALTER TABLE `classe`
  ADD CONSTRAINT `FK_8F87BF969FBD3195` FOREIGN KEY (`id_specialite_id`) REFERENCES `specialite` (`id`);

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `FK_67F068BC5D4AAA1` FOREIGN KEY (`id_publication_id`) REFERENCES `publication` (`id`),
  ADD CONSTRAINT `FK_67F068BC79F37AE5` FOREIGN KEY (`id_user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `FK_FDCA8C9CF6B192E` FOREIGN KEY (`id_classe_id`) REFERENCES `classe` (`id`);

--
-- Contraintes pour la table `matiere`
--
ALTER TABLE `matiere`
  ADD CONSTRAINT `FK_9014574A26ED0855` FOREIGN KEY (`note_id`) REFERENCES `note` (`id`),
  ADD CONSTRAINT `FK_9014574A5A7D2DA5` FOREIGN KEY (`id_enseignant_id`) REFERENCES `enseignant` (`id`),
  ADD CONSTRAINT `FK_9014574A9FBD3195` FOREIGN KEY (`id_specialite_id`) REFERENCES `specialite` (`id`);

--
-- Contraintes pour la table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `FK_CFBDFA14C5F87C54` FOREIGN KEY (`id_etudiant_id`) REFERENCES `etudiant` (`id`);

--
-- Contraintes pour la table `publication`
--
ALTER TABLE `publication`
  ADD CONSTRAINT `FK_AF3C67792E149425` FOREIGN KEY (`id_cours_id`) REFERENCES `cours` (`id`),
  ADD CONSTRAINT `FK_AF3C677979F37AE5` FOREIGN KEY (`id_user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `reclamation`
--
ALTER TABLE `reclamation`
  ADD CONSTRAINT `FK_CE60640479F37AE5` FOREIGN KEY (`id_user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `semestre`
--
ALTER TABLE `semestre`
  ADD CONSTRAINT `FK_71688FBC9FBD3195` FOREIGN KEY (`id_specialite_id`) REFERENCES `specialite` (`id`);

--
-- Contraintes pour la table `semestre_etudiant`
--
ALTER TABLE `semestre_etudiant`
  ADD CONSTRAINT `FK_3D21F9A5577AFDB` FOREIGN KEY (`semestre_id`) REFERENCES `semestre` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_3D21F9ADDEAB1A3` FOREIGN KEY (`etudiant_id`) REFERENCES `etudiant` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D6498F5EA509` FOREIGN KEY (`classe_id`) REFERENCES `classe` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
