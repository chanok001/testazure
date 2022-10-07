-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 11 mai 2022 à 14:58
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
-- Base de données : `auto_heh_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_bin NOT NULL,
  `prenom` varchar(255) COLLATE utf8_bin NOT NULL,
  `mail` varchar(255) COLLATE utf8_bin NOT NULL,
  `mdp` varchar(255) COLLATE utf8_bin NOT NULL,
  `perm` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`user_id`, `nom`, `prenom`, `mail`, `mdp`, `perm`) VALUES
(1, 'Aiesi', 'Mirko', 'aiesimirko2@gmail.com', '$2y$10$hLR.Mlxazh12G2PMYZtAq.fuwcxZMEK6BEDeFo.G956vnaNs4eXGa', 1),
(10, 'tata', 'tata', 'tata@hotmail.com', '$2y$10$nu/.9.kur.7hUDgLAW.2deUiRwiSrmO7afvAJV8HbXyxXkwrekz0y', 0),
(9, 'toto', 'toto', 'toto@toto.com', '$2y$10$a7iPhsQNJj8ggVhcClDC4uZ9Hz0QCqrcOeYtyPAPIJ77c98IpQYSa', 0);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `produit_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`produit_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `occasion`
--

DROP TABLE IF EXISTS `occasion`;
CREATE TABLE IF NOT EXISTS `occasion` (
  `user_id` int(11) DEFAULT NULL,
  `occasion_id` int(11) NOT NULL AUTO_INCREMENT,
  `marque` varchar(255) COLLATE utf8_bin NOT NULL,
  `km` int(11) NOT NULL,
  `annee` varchar(255) COLLATE utf8_bin NOT NULL,
  `chevaux` int(11) NOT NULL,
  `carburant` varchar(255) COLLATE utf8_bin NOT NULL,
  `localite` varchar(255) COLLATE utf8_bin NOT NULL,
  `prix` int(11) NOT NULL,
  `etat` varchar(255) COLLATE utf8_bin NOT NULL,
  `img` varchar(255) COLLATE utf8_bin DEFAULT './ressources/logo2.png',
  PRIMARY KEY (`occasion_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `occasion`
--

INSERT INTO `occasion` (`user_id`, `occasion_id`, `marque`, `km`, `annee`, `chevaux`, `carburant`, `localite`, `prix`, `etat`, `img`) VALUES
(1, 24, 'bmw', 75000, '2019', 150, 'diesel', 'Mons', 40500, 'neuf', './ressources/bmw_m4.png'),
(1, 25, 'bmw', 15, '2021', 206, 'diesel', 'Mons', 60000, 'neuf', './ressources/bmw_X5.png'),
(1, 26, 'mercedes', 290, '2020', 510, 'diesel', 'Mons', 65000, 'neuf', './ressources/mercedes.png'),
(1, 27, 'volkswagen', 12000, '2021', 105, 'diesel', 'Mons', 22500, 'neuf', './ressources/vw.png'),
(9, 28, 'audi', 200000, '2012', 160, 'diesel', 'Leugnies', 25000, 'occasion', './ressources/logo2.png'),
(10, 29, 'bmw', 200000, '2020', 233, 'diesel', 'Mons', 23500, 'occasion', './ressources/logo2.png'),
(1, 30, 'bmw', 200000, '2020', 102, 'diesel', 'BMT zone', 277, 'neuf', './ressources/mercedes.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
