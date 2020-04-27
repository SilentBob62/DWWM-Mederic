-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 20 fév. 2020 à 14:56
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `formulaire`
--
CREATE DATABASE IF NOT EXISTS `formulaire` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `formulaire`;

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

DROP TABLE IF EXISTS `personne`;
CREATE TABLE IF NOT EXISTS `personne` (
  `idPersonne` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `dateNaissance` date NOT NULL,
  `adresse` varchar(150) NOT NULL,
  `ville` varchar(150) NOT NULL,
  `code` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  PRIMARY KEY (`idPersonne`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `personne`
--

INSERT INTO `personne` (`idPersonne`, `nom`, `prenom`, `dateNaissance`, `adresse`, `ville`, `code`, `email`) VALUES
(1, 'test', 'test', '2020-01-31', 'test', 'test', 0, 'test@test.fr'),
(2, 'VERAGHE', 'ALISON', '1993-11-23', '207 Harghedorn straete', 'Caestre', 59190, 'alison231193@hotmail.fr'),
(3, 'poson', 'alan', '1993-10-15', '435 route de teteghem', 'warhem', 59380, 'alan.poson@gmail.com'),
(4, 'nom', 'prenom', '2020-02-20', 'adresse', 'ville', 0, 'email@email.fr'),
(7, 'nom2', 'prenom2', '1245-02-22', 'adresse2', 'ville2', 22222, '22@email2.fr'),
(8, 'a', 'a', '2020-02-09', 'a', 'a', 1, 'a@g.gt');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
