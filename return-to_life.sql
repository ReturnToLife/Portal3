-- phpMyAdmin SQL Dump
-- version 3.3.8
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Mar 25 Septembre 2012 à 18:07
-- Version du serveur: 5.1.41
-- Version de PHP: 5.3.2-1ubuntu4.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `return-to_life`
--

CREATE DATABASE IF NOT EXISTS `return-to_life` ;

USE `return-to_life` ;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(200) NOT NULL,
  `categ` tinyint(1) NOT NULL,
  `parution` datetime NOT NULL,
  `contenu` text NOT NULL,
  `type` tinyint(1) NOT NULL,
  `statut` tinyint(1) NOT NULL,
  `ecole` varchar(200) NOT NULL,
  `promo` varchar(10) NOT NULL,
  `ville` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=76 ;

-- --------------------------------------------------------

--
-- Structure de la table `article_assoc`
--

CREATE TABLE IF NOT EXISTS `article_assoc` (
  `id_student` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `approbation` tinyint(1) NOT NULL,
  `vu` int(11) NOT NULL,
  PRIMARY KEY (`id_student`,`id_article`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `contrib_article`
--

CREATE TABLE IF NOT EXISTS `contrib_article` (
  `id_contrib_type` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  PRIMARY KEY (`id_contrib_type`,`id_article`,`id_student`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `contrib_flash`
--

CREATE TABLE IF NOT EXISTS `contrib_flash` (
  `id_contrib_type` int(11) NOT NULL,
  `id_flash` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  PRIMARY KEY (`id_contrib_type`,`id_flash`,`id_student`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `contrib_type`
--

CREATE TABLE IF NOT EXISTS `contrib_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Structure de la table `droit`
--

CREATE TABLE IF NOT EXISTS `droit` (
  `id_outil_gestion` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `id_group_effect` int(11) NOT NULL,
  PRIMARY KEY (`id_outil_gestion`,`id_group`,`id_group_effect`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `flash`
--

CREATE TABLE IF NOT EXISTS `flash` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contenu` varchar(500) NOT NULL,
  `parution` datetime NOT NULL,
  `statut` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `flash_assoc`
--

CREATE TABLE IF NOT EXISTS `flash_assoc` (
  `id_student` int(11) NOT NULL,
  `id_flash` int(11) NOT NULL,
  `approbation` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_student`,`id_flash`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `group_assoc`
--

CREATE TABLE IF NOT EXISTS `group_assoc` (
  `id_parent` int(11) NOT NULL,
  `id_child` int(11) NOT NULL,
  KEY `id_parent` (`id_parent`),
  KEY `id_child` (`id_child`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `group_member`
--

CREATE TABLE IF NOT EXISTS `group_member` (
  `id_group` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  PRIMARY KEY (`id_group`,`login`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `group_name`
--

CREATE TABLE IF NOT EXISTS `group_name` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=142 ;

-- --------------------------------------------------------

--
-- Structure de la table `outil_gestion`
--

CREATE TABLE IF NOT EXISTS `outil_gestion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Structure de la table `preference`
--

CREATE TABLE IF NOT EXISTS `preference` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=141 ;

-- --------------------------------------------------------

--
-- Structure de la table `tag_assoc`
--

CREATE TABLE IF NOT EXISTS `tag_assoc` (
  `id_tag` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  PRIMARY KEY (`id_tag`,`id_article`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
