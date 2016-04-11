-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Lun 11 Avril 2016 à 11:45
-- Version du serveur: 5.5.8
-- Version de PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `qvgdm`
--

-- --------------------------------------------------------

--
-- Structure de la table `qvgdm_question`
--

CREATE TABLE IF NOT EXISTS `qvgdm_question` (
  `id_question` int(11) NOT NULL AUTO_INCREMENT,
  `text_question` text NOT NULL,
  `second_question` int(11) NOT NULL DEFAULT '30',
  `answer_1` varchar(255) NOT NULL,
  `answer_2` varchar(255) NOT NULL,
  `answer_3` varchar(255) NOT NULL,
  `answer_4` varchar(255) NOT NULL,
  `good_answer` int(11) NOT NULL,
  `check_activate` tinyint(1) NOT NULL DEFAULT '0',
  `check_response` tinyint(1) NOT NULL DEFAULT '0',
  `check_freeze` tinyint(1) NOT NULL DEFAULT '0',
  `point` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_question`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Structure de la table `qvgdm_user`
--

CREATE TABLE IF NOT EXISTS `qvgdm_user` (
  `login_user` varchar(255) NOT NULL,
  `activate_user` tinyint(1) NOT NULL DEFAULT '0',
  `point_user` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`login_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `qvgdm_user_answer`
--

CREATE TABLE IF NOT EXISTS `qvgdm_user_answer` (
  `login_user` varchar(255) NOT NULL,
  `id_question` int(11) NOT NULL,
  `selected_answer` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`login_user`,`id_question`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
