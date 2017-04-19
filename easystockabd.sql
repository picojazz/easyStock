-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 19 Avril 2017 à 14:16
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `easystockabd`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `codecli` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tel` int(255) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`codecli`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`codecli`, `prenom`, `nom`, `tel`, `type`, `adresse`, `idUser`) VALUES
(1, 'elhadje', 'ndiaye', 775896321, 'personne', 'ouakam', 0),
(2, 'cheikh', 'diallo', 771050084, 'entreprise', 'nord foire', 0),
(3, 'ibrahima', 'faye', 776584128, 'personne', 'PA', 0),
(4, 'khady', 'diouf', 772136846, 'entreprise', 'rufisque', 0),
(5, 'aminata', 'diop', 772546813, 'personne', 'sac', 0),
(6, 'pico', 'diop', 779518958, 'entreprise', 'ouakam', 0),
(7, 'amadou', 'dieng', 772154695, 'entreprise', 'beneu tally', 0);

-- --------------------------------------------------------

--
-- Structure de la table `cmdprod`
--

CREATE TABLE IF NOT EXISTS `cmdprod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codeprod` int(11) NOT NULL,
  `codecmd` int(11) NOT NULL,
  `qtecmd` int(11) NOT NULL,
  `qtelivr` int(11) NOT NULL,
  `etat` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

--
-- Contenu de la table `cmdprod`
--

INSERT INTO `cmdprod` (`id`, `codeprod`, `codecmd`, `qtecmd`, `qtelivr`, `etat`) VALUES
(1, 24, 1, 1, 1, 1),
(2, 20, 1, 3, 3, 1),
(3, 23, 1, 2, 2, 1),
(4, 25, 2, 3, 3, 1),
(5, 21, 2, 5, 4, 0),
(6, 23, 3, 2, 2, 1),
(7, 20, 4, 17, 17, 1),
(8, 23, 4, 2, 2, 1),
(9, 25, 5, 7, 7, 1),
(10, 23, 6, 5, 0, 0),
(12, 24, 6, 3, 3, 1),
(13, 25, 7, 3, 0, 0),
(14, 21, 7, 2, 0, 0),
(15, 24, 8, 2, 2, 1),
(16, 23, 9, 3, 1, 0),
(17, 24, 9, 2, 2, 1),
(18, 20, 9, 1, 0, 0),
(19, 24, 10, 2, 2, 1),
(20, 25, 10, 3, 0, 0),
(21, 20, 10, 4, 0, 0),
(22, 23, 12, 2, 0, 0),
(23, 21, 12, 1, 0, 0),
(24, 20, 13, 4, 4, 1),
(25, 23, 13, 2, 2, 1),
(26, 25, 14, 2, 0, 0),
(27, 20, 14, 3, 0, 0),
(28, 20, 15, 1, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `codecmd` int(11) NOT NULL AUTO_INCREMENT,
  `datecmd` date NOT NULL,
  `datelivr` date NOT NULL,
  `etat` int(11) NOT NULL,
  `codecli` int(11) NOT NULL,
  PRIMARY KEY (`codecmd`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`codecmd`, `datecmd`, `datelivr`, `etat`, `codecli`) VALUES
(1, '2017-04-01', '2017-04-04', 1, 2),
(2, '2017-04-01', '2017-04-05', 0, 1),
(3, '2017-04-02', '2017-04-04', 1, 1),
(4, '2017-04-02', '2017-04-15', 1, 2),
(5, '2017-04-03', '2017-04-07', 1, 3),
(6, '2017-04-05', '2017-04-08', 0, 2),
(7, '2017-04-05', '2017-04-08', 0, 5),
(8, '2017-04-06', '2017-04-07', 1, 2),
(9, '2017-04-06', '2017-04-10', 0, 3),
(10, '2017-04-06', '2017-04-15', 0, 1),
(11, '2017-04-12', '0000-00-00', 0, 2),
(12, '2017-04-12', '2017-04-15', 0, 2),
(13, '2017-04-12', '2017-04-16', 1, 6),
(14, '2017-04-12', '2017-04-16', 0, 6),
(15, '2017-04-12', '0000-00-00', 0, 6);

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE IF NOT EXISTS `fournisseur` (
  `codefour` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tel` int(11) NOT NULL,
  `adresse` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`codefour`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Contenu de la table `fournisseur`
--

INSERT INTO `fournisseur` (`codefour`, `nom`, `prenom`, `tel`, `adresse`) VALUES
(22, 'diop', 'amadou', 776582431, 'ouakam'),
(23, 'diop', 'khalifa', 774125896, 'dakar'),
(24, 'diatta', 'alpha', 772563841, 'mermoz'),
(25, 'faye', 'amath', 774123698, 'pikine');

-- --------------------------------------------------------

--
-- Structure de la table `fourniture`
--

CREATE TABLE IF NOT EXISTS `fourniture` (
  `codefournt` int(11) NOT NULL AUTO_INCREMENT,
  `datefournt` date NOT NULL,
  PRIMARY KEY (`codefournt`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Contenu de la table `fourniture`
--

INSERT INTO `fourniture` (`codefournt`, `datefournt`) VALUES
(9, '2017-04-03'),
(10, '2017-04-03'),
(11, '2017-04-03'),
(12, '2017-04-04');

-- --------------------------------------------------------

--
-- Structure de la table `prodfournt`
--

CREATE TABLE IF NOT EXISTS `prodfournt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codeprod` int(11) NOT NULL,
  `codefournt` int(11) NOT NULL,
  `qteav` int(11) NOT NULL,
  `qtefr` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Contenu de la table `prodfournt`
--

INSERT INTO `prodfournt` (`id`, `codeprod`, `codefournt`, `qteav`, `qtefr`) VALUES
(2, 24, 9, 14, 2),
(3, 25, 10, 30, 3),
(4, 20, 11, 21, 4),
(5, 23, 12, 4, 10);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `codeprod` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `qte` int(11) NOT NULL,
  `pu` int(11) NOT NULL,
  `codefour` int(11) NOT NULL,
  PRIMARY KEY (`codeprod`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`codeprod`, `designation`, `qte`, `pu`, `codefour`) VALUES
(20, 'cable rj45', 15, 1500, 22),
(21, 'ecran', 11, 25000, 22),
(23, 'ram', 11, 7000, 23),
(24, 'uc', 7, 100000, 23),
(25, 'souris', 33, 2000, 24);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profil` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `prenom`, `nom`, `profil`, `login`, `password`, `photo`) VALUES
(1, 'amadou', 'diop', 'admin', 'picojazz', '588f4cc167672fd3363d6bbbd846f5c0', ''),
(2, 'sdcqs', 'dqc', 'user', 'pico', '588f4cc167672fd3363d6bbbd846f5c0', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
