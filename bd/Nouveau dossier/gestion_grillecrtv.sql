-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 13 juin 2021 à 14:49
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;use gestion_grillecrtv;

--
-- Base de données :  `gestion_grillecrtv`
--

-- --------------------------------------------------------

--
-- Structure de la table `antenne`
--

DROP TABLE IF EXISTS `antenne`;
CREATE TABLE IF NOT EXISTS `antenne` (
  `IDANTENNE` int(11) NOT NULL AUTO_INCREMENT,
  `MATRICULEREGISSEUR` varchar(10) NOT NULL,
  `IDCHAINE` int(11) NOT NULL,
  `NOMANTENNE` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`IDANTENNE`),
  KEY `FK_GERER` (`MATRICULEREGISSEUR`),
  KEY `FK_POSSEDER` (`IDCHAINE`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `antenne`
--

INSERT INTO `antenne` (`IDANTENNE`, `MATRICULEREGISSEUR`, `IDCHAINE`, `NOMANTENNE`) VALUES
(1, 'REG001', 1, 'ANTENNE CAMEROUN'),
(2, 'REG002', 1, 'ANTENNE GUINÉE EQUATORIALE');

-- --------------------------------------------------------

--
-- Structure de la table `chaine`
--

DROP TABLE IF EXISTS `chaine`;
CREATE TABLE IF NOT EXISTS `chaine` (
  `IDCHAINE` int(11) NOT NULL AUTO_INCREMENT,
  `NOMCHAINE` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`IDCHAINE`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `chaine`
--

INSERT INTO `chaine` (`IDCHAINE`, `NOMCHAINE`) VALUES
(1, 'AFRIQUE MEDIA'),
(2, 'AFRIQUE MEDIA 2'),
(3, 'AFRIQUE MEDIA 3'),
(4, 'CRTV NEWS'),
(5, 'CRTV SPORTS'),
(6, 'CRTV WEB'),
(7, 'CRTV SPORTS 2');

-- --------------------------------------------------------

--
-- Structure de la table `diffusion`
--

DROP TABLE IF EXISTS `diffusion`;
CREATE TABLE IF NOT EXISTS `diffusion` (
  `IDDIFFUSION` int(11) NOT NULL AUTO_INCREMENT,
  `IDANTENNE` int(11) NOT NULL,
  `IDPROGRAMME` int(11) NOT NULL,
  `CODEJOUR` varchar(3) NOT NULL,
  `DATEDIFFUSION` date DEFAULT NULL,
  `HEUREEBUTDIFFUSION` time DEFAULT NULL,
  `HEUREFINDIFFUSION` time DEFAULT NULL,
  `LIENDIFFUSION` varchar(255) NOT NULL,
  PRIMARY KEY (`IDDIFFUSION`),
  KEY `FK_ASSOCIER` (`IDPROGRAMME`),
  KEY `FK_DEROULER` (`CODEJOUR`),
  KEY `FK_PROGRAMMER` (`IDANTENNE`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `diffusion`
--

INSERT INTO `diffusion` (`IDDIFFUSION`, `IDANTENNE`, `IDPROGRAMME`, `CODEJOUR`, `DATEDIFFUSION`, `HEUREEBUTDIFFUSION`, `HEUREFINDIFFUSION`, `LIENDIFFUSION`) VALUES
(1, 1, 1, 'VEN', '2020-05-29', '20:00:00', '22:00:00', ''),
(2, 1, 1, 'DIM', '2020-05-31', '06:00:00', '09:00:00', 'https://www.youtube.com/watch?v=W-OM33Kr24E'),
(3, 1, 1, 'LM', '2020-05-16', '10:00:00', '14:00:00', 'https://www.youtube.com/watch?v=MYcvBSaq4CQ');

-- --------------------------------------------------------

--
-- Structure de la table `equipeproduction`
--

DROP TABLE IF EXISTS `equipeproduction`;
CREATE TABLE IF NOT EXISTS `equipeproduction` (
  `IDEQUIPEPRODUCTION` int(11) NOT NULL AUTO_INCREMENT,
  `CODETYPEEQUIPEP` varchar(5) NOT NULL,
  `NOMEQUIPEPRODUCTION` varchar(100) DEFAULT NULL,
  `ADRESSEEQUIPEPRODUCTION` varchar(100) DEFAULT NULL,
  `TELEQUIPEPRODUCTION` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`IDEQUIPEPRODUCTION`),
  KEY `FK_PROVENIR` (`CODETYPEEQUIPEP`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `equipeproduction`
--

INSERT INTO `equipeproduction` (`IDEQUIPEPRODUCTION`, `CODETYPEEQUIPEP`, `NOMEQUIPEPRODUCTION`, `ADRESSEEQUIPEPRODUCTION`, `TELEQUIPEPRODUCTION`) VALUES
(1, 'EQP1', 'REDACTION CENTRALE AFRIQUE MEDIA', 'AFRIQUE MEDIA', '677 55 44 99');

-- --------------------------------------------------------

--
-- Structure de la table `genreprogramme`
--

DROP TABLE IF EXISTS `genreprogramme`;
CREATE TABLE IF NOT EXISTS `genreprogramme` (
  `CODEGENREPROGRAMME` varchar(5) NOT NULL,
  `LIBELLEGENREPROGRAMME` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`CODEGENREPROGRAMME`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `genreprogramme`
--

INSERT INTO `genreprogramme` (`CODEGENREPROGRAMME`, `LIBELLEGENREPROGRAMME`) VALUES
('EDUC', 'EDUCATION'),
('INFOS', 'INFORMATION'),
('DIV', 'DIVERTISSEMENT'),
('CUL', 'CULTURE');

-- --------------------------------------------------------

--
-- Structure de la table `grille`
--

DROP TABLE IF EXISTS `grille`;
CREATE TABLE IF NOT EXISTS `grille` (
  `IDGRILLE` int(11) NOT NULL AUTO_INCREMENT,
  `IDCHAINE` int(11) NOT NULL,
  `NOMGRILLE` varchar(100) DEFAULT NULL,
  `DATELANCEMENTGRILLE` date DEFAULT NULL,
  `DATEFINGRILLE` date DEFAULT NULL,
  PRIMARY KEY (`IDGRILLE`),
  KEY `FK_DISPOSER` (`IDCHAINE`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `grille`
--

INSERT INTO `grille` (`IDGRILLE`, `IDCHAINE`, `NOMGRILLE`, `DATELANCEMENTGRILLE`, `DATEFINGRILLE`) VALUES
(1, 1, 'GRILLE 2020 DE LA TELEVISION', '2019-09-01', '2020-12-31');

-- --------------------------------------------------------

--
-- Structure de la table `jour`
--

DROP TABLE IF EXISTS `jour`;
CREATE TABLE IF NOT EXISTS `jour` (
  `CODEJOUR` varchar(3) NOT NULL,
  `LIBELLEJOUR` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`CODEJOUR`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `jour`
--

INSERT INTO `jour` (`CODEJOUR`, `LIBELLEJOUR`) VALUES
('LUN', 'LUNDI'),
('MAR', 'MARDI'),
('MER', 'MERCREDI'),
('JEU', 'JEUDI'),
('VEN', 'VENDREDI'),
('SAM', 'SAMEDI'),
('DIM', 'DIMANCHE'),
('LV', 'LUNDI A VENDREDI'),
('LJ', 'LUNDI A JEUDI'),
('LD', 'LUNDI A DIMANCHE'),
('LS', 'LUNDI A SAMEDI'),
('LM', 'LUNDI AMARDI');

-- --------------------------------------------------------

--
-- Structure de la table `journaliste`
--

DROP TABLE IF EXISTS `journaliste`;
CREATE TABLE IF NOT EXISTS `journaliste` (
  `MATRICULEJOURNALISTE` varchar(10) NOT NULL,
  `NOMJOURNALISTE` varchar(100) DEFAULT NULL,
  `PRENOMJOURNALISTE` varchar(25) DEFAULT NULL,
  `IMAGEPHOTOJOURNALISTE` longblob,
  `TELJOURNALISTE` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`MATRICULEJOURNALISTE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `journaliste`
--

INSERT INTO `journaliste` (`MATRICULEJOURNALISTE`, `NOMJOURNALISTE`, `PRENOMJOURNALISTE`, `IMAGEPHOTOJOURNALISTE`, `TELJOURNALISTE`) VALUES
('J003', 'KUE NANA', 'STEPHANE', '', '698'),
('K095', 'NANA ', 'FRANCOIS XAVIER', '', '699542910');

-- --------------------------------------------------------

--
-- Structure de la table `languediffusionp`
--

DROP TABLE IF EXISTS `languediffusionp`;
CREATE TABLE IF NOT EXISTS `languediffusionp` (
  `CODELANGUEDIFFUSIONP` varchar(3) NOT NULL,
  `LIBELLELANGUEDIFFUSIONP` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`CODELANGUEDIFFUSIONP`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `languediffusionp`
--

INSERT INTO `languediffusionp` (`CODELANGUEDIFFUSIONP`, `LIBELLELANGUEDIFFUSIONP`) VALUES
('FR', 'FRANCAIS'),
('ENG', 'ANGLAIS'),
('BIL', 'BILINGUE');

-- --------------------------------------------------------

--
-- Structure de la table `programme`
--

DROP TABLE IF EXISTS `programme`;
CREATE TABLE IF NOT EXISTS `programme` (
  `IDPROGRAMME` int(11) NOT NULL AUTO_INCREMENT,
  `IDGRILLE` int(11) NOT NULL,
  `CODELANGUEDIFFUSIONP` varchar(3) NOT NULL,
  `CODETYPEPROGRAMME` varchar(5) NOT NULL,
  `IDEQUIPEPRODUCTION` int(11) NOT NULL,
  `CODEGENREPROGRAMME` varchar(5) NOT NULL,
  `MATRICULEJOURNALISTE` varchar(10) NOT NULL,
  `NOMPROGRAMME` varchar(100) DEFAULT NULL,
  `IMAGEPROGRAMME` longblob,
  `DUREEPROGRAMME` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDPROGRAMME`),
  KEY `FK_AVOIR` (`CODEGENREPROGRAMME`),
  KEY `FK_CLASSER` (`CODETYPEPROGRAMME`),
  KEY `FK_COMPRENDRE` (`IDGRILLE`),
  KEY `FK_CORRESPONDRE` (`CODELANGUEDIFFUSIONP`),
  KEY `FK_PRESENTER` (`MATRICULEJOURNALISTE`),
  KEY `FK_PRODUIRE` (`IDEQUIPEPRODUCTION`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `programme`
--

INSERT INTO `programme` (`IDPROGRAMME`, `IDGRILLE`, `CODELANGUEDIFFUSIONP`, `CODETYPEPROGRAMME`, `IDEQUIPEPRODUCTION`, `CODEGENREPROGRAMME`, `MATRICULEJOURNALISTE`, `NOMPROGRAMME`, `IMAGEPROGRAMME`, `DUREEPROGRAMME`) VALUES
(1, 1, 'FR', 'REP', 1, 'INFOS', '101010', 'MERITE PANAFRICAIN', 0x73697465766f7961676520332e706e67, 120),
(2, 1, 'FR', 'REP', 1, 'INFOS', 'K095', 'TOUT SUR LE COVID-19', '', 30),
(3, 1, 'FR', 'REP', 1, 'INFOS', 'J003', 'SOUTENANCES BTS', '', 30),
(4, 1, 'FR', 'DOC', 1, 'EDUC', 'J003', 'TOUT SUR LE COVID-19', '', 30);

-- --------------------------------------------------------

--
-- Structure de la table `regisseur`
--

DROP TABLE IF EXISTS `regisseur`;
CREATE TABLE IF NOT EXISTS `regisseur` (
  `MATRICULEREGISSEUR` varchar(10) NOT NULL,
  `NOMREGISSEUR` varchar(50) DEFAULT NULL,
  `PRENOMREGISSEUR` varchar(25) DEFAULT NULL,
  `TELREGISSEUR` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`MATRICULEREGISSEUR`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `regisseur`
--

INSERT INTO `regisseur` (`MATRICULEREGISSEUR`, `NOMREGISSEUR`, `PRENOMREGISSEUR`, `TELREGISSEUR`) VALUES
('REG001', 'MARACHON', 'YANEL', '675 33 89 44'),
('REG002', 'KAMGA', 'CAMILLE', '699 44 03 13');

-- --------------------------------------------------------

--
-- Structure de la table `typeequipep`
--

DROP TABLE IF EXISTS `typeequipep`;
CREATE TABLE IF NOT EXISTS `typeequipep` (
  `CODETYPEEQUIPEP` varchar(5) NOT NULL,
  `LIBELLETYPEEQUIPEP` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`CODETYPEEQUIPEP`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `typeequipep`
--

INSERT INTO `typeequipep` (`CODETYPEEQUIPEP`, `LIBELLETYPEEQUIPEP`) VALUES
('EQP1', 'EQUIPE INTERNE DE PRODUCTION'),
('EQP2', 'EQUIPE EXTERNE DE PRODUCTION');

-- --------------------------------------------------------

--
-- Structure de la table `typegrille`
--

DROP TABLE IF EXISTS `typegrille`;
CREATE TABLE IF NOT EXISTS `typegrille` (
  `CODETYPEGRILLE` varchar(5) NOT NULL,
  `LIBELLETYPEGRILLE` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`CODETYPEGRILLE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `typeprogramme`
--

DROP TABLE IF EXISTS `typeprogramme`;
CREATE TABLE IF NOT EXISTS `typeprogramme` (
  `CODETYPEPROGRAMME` varchar(5) NOT NULL,
  `LIBELLETYPEPROGRAMME` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`CODETYPEPROGRAMME`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `typeprogramme`
--

INSERT INTO `typeprogramme` (`CODETYPEPROGRAMME`, `LIBELLETYPEPROGRAMME`) VALUES
('DOC', 'DOCUMENTAIRE'),
('SER', 'SERIES / FEUILLETON'),
('FILM', 'FILMS'),
('REP', 'REPORTAGE'),
('AUT', 'AUTRES');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `ID` int(4) NOT NULL AUTO_INCREMENT,
  `LOGIN` varchar(100) NOT NULL,
  `PWD` varchar(255) NOT NULL,
  `ROLE` varchar(50) DEFAULT NULL,
  `EMAIL` varchar(255) DEFAULT NULL,
  `ETAT` int(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`ID`, `LOGIN`, `PWD`, `ROLE`, `EMAIL`, `ETAT`) VALUES
(1, 'ADMIN', '202cb962ac59075b964b07152d234b70', 'ADMIN', 'lahcenabousalih@gmail.com', 1),
(4, 'mwilfreed@yahoo.fr', 'd99f73d4f0ac0238e331e97c301d2aa3', 'VISITEUR', 'mwilfreed@yahoo.fr', 0),
(5, 'NANA5', '5f55c6418f95449439f26d13c9724de3', 'VISITEUR', 'nkstef@yahoo.com', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
