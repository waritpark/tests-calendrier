-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 23 nov. 2021 à 15:30
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
-- Base de données : `bdd_calendrier`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_calendrier_events`
--

DROP TABLE IF EXISTS `t_calendrier_events`;
CREATE TABLE IF NOT EXISTS `t_calendrier_events` (
  `id_event` int(11) NOT NULL AUTO_INCREMENT,
  `nom_event` varchar(255) NOT NULL,
  `desc_event` text,
  `start_event` datetime NOT NULL,
  `end_event` datetime NOT NULL,
  `id_utilisateur` int(11) DEFAULT NULL COMMENT 'key foreign',
  PRIMARY KEY (`id_event`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_calendrier_events`
--

INSERT INTO `t_calendrier_events` (`id_event`, `nom_event`, `desc_event`, `start_event`, `end_event`, `id_utilisateur`) VALUES
(14, 'test f', NULL, '2021-10-20 15:07:39', '2021-10-20 18:07:39', 26),
(16, 'test aaa', 'zzz', '2021-10-20 10:07:00', '2021-10-20 11:07:00', 26),
(17, 'EventNom A', 'description random', '2021-11-09 10:00:00', '2021-11-09 15:00:00', 27),
(20, 'testnom', 'zzzz', '2021-11-11 14:00:00', '2021-11-11 14:30:00', 26),
(21, 'testvalue', 'azeaze', '2021-11-10 15:00:00', '2021-11-10 16:00:00', 26),
(22, 'testvalueaze', 'azeazeazess', '2021-11-10 15:30:00', '2021-11-10 16:20:00', 26),
(24, 'testvalueaze', 'azeazeaze', '2021-11-09 15:30:00', '2021-11-09 16:20:00', 26),
(25, 'aazzzzzz', 'ezeze', '2021-11-08 10:00:00', '2021-11-08 11:00:00', 26),
(26, 'EventNom', 'zzzzzzzzzzzzzzzzzz', '2021-11-06 08:00:00', '2021-11-06 08:30:00', 26),
(27, 'testvalue', 'azeazeaze', '2021-11-19 12:00:00', '2021-11-19 13:00:00', 26),
(28, 'testvalue', 'azeazeaze', '2021-11-19 12:00:00', '2021-11-19 13:00:00', 26),
(30, 'testvalueaze', 'qsdqsdqsd', '2021-11-18 13:00:00', '2021-11-18 14:00:00', 26),
(31, 'testvalue', 'azeazeaze', '2021-11-14 15:00:00', '2021-11-14 16:00:00', 26),
(32, 'testvalue', 'azeazeaze', '2021-11-14 15:00:00', '2021-11-14 16:00:00', 26),
(33, 'testvalue', 'azeazeaze', '2021-11-14 15:00:00', '2021-11-14 16:00:00', 26),
(34, 'testvalue', 'azezaeaze', '2021-11-29 15:00:00', '2021-11-29 16:00:00', 26),
(35, 'testvalue', 'zqqqqqqz', '2021-11-09 08:00:00', '2021-11-09 09:30:00', 26),
(36, 'testnomaez', 'htrth', '2021-11-19 05:50:00', '2021-11-19 07:50:00', 26);

-- --------------------------------------------------------

--
-- Structure de la table `t_recuperation`
--

DROP TABLE IF EXISTS `t_recuperation`;
CREATE TABLE IF NOT EXISTS `t_recuperation` (
  `ID_recup` int(11) NOT NULL AUTO_INCREMENT,
  `mail_recup` varchar(255) NOT NULL,
  `token_recup` varchar(255) NOT NULL,
  PRIMARY KEY (`ID_recup`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_utilisateur`
--

DROP TABLE IF EXISTS `t_utilisateur`;
CREATE TABLE IF NOT EXISTS `t_utilisateur` (
  `ID_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(255) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `mdp` varchar(255) NOT NULL,
  `role_user` int(1) NOT NULL,
  PRIMARY KEY (`ID_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_utilisateur`
--

INSERT INTO `t_utilisateur` (`ID_utilisateur`, `mail`, `nom`, `prenom`, `mdp`, `role_user`) VALUES
(28, 'arthur@arthur.fr', 'testvalue', 'zzz', '$2y$10$U8ZWqnefhYHdgkNbPU4bpeMfIkCsOpRR.82UkYLg7Bf58z3IzzqCO', 1),
(30, 'test@test.fr', NULL, NULL, '$2y$10$2vS0a/slHXOo.K3hTQYl9uB0oeJ8O85cm7zHMigqwv.Ke4HYPuXpa', 2),
(31, 'gg@gg.fr', NULL, NULL, '$2y$10$/xXpPMdg4o4YDq396.QEq.USU.WOANxBu.IrRatGr90D/rYNIe9gq', 2),
(32, 'azeazeazgh@fgf.dg', NULL, NULL, '$2y$10$wd3LYYv0PGYJ1NHmfwIQhOgL0Uxbq8WfHtVtCegbWS9d5QhjuQw86', 2),
(33, 'rrrr@fgf.dg', NULL, NULL, '$2y$10$foC0n966Du6CRpJEZp4rxOYrozO6xoIh4c3VC0vgB8rKtKeE4nqB.', 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
