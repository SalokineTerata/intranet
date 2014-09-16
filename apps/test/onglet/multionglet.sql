-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Ven 29 Août 2008 à 18:18
-- Version du serveur: 5.0.51
-- Version de PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `onglet`
--

-- --------------------------------------------------------

--
-- Structure de la table `multionglet`
--

CREATE TABLE `multionglet` (
  `onglet` varchar(255) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `contenu` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `multionglet`
--

INSERT INTO `multionglet` (`onglet`, `titre`, `contenu`) VALUES
('page1', 'premier onglet', 'ceci est le contenu du premier onglet'),
('page2', 'onglet 2', 'ceci est le contenu du deuxième onglet'),
('page3', 'onglet 3', '<b>en gras</b>\r\n<p align=center>centrée</p>\r\nceci est le contenu du dèrnière onglet pour la démo');
