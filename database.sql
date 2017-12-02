-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 29 Mars 2015 à 03:43
-- Version du serveur :  5.6.17-log
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `projetprincipal`
--

-- --------------------------------------------------------

--
-- Structure de la table `appartenir`
--

CREATE TABLE IF NOT EXISTS `appartenir` (
  `idGroupe` int(6) NOT NULL,
  `loginPersonne` varchar(40) NOT NULL,
  PRIMARY KEY (`idGroupe`,`loginPersonne`),
  KEY `loginPersonne` (`loginPersonne`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE IF NOT EXISTS `avis` (
  `loginPersonne` varchar(40) NOT NULL,
  `idFormation` int(6) NOT NULL,
  `note` int(2) NOT NULL,
  `commentaire` varchar(200) NOT NULL,
  PRIMARY KEY (`loginPersonne`,`idFormation`),
  KEY `idFormation` (`idFormation`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `avoirnote`
--

CREATE TABLE IF NOT EXISTS `avoirnote` (
  `idNote` int(6) NOT NULL AUTO_INCREMENT,
  `note` varchar(3) NOT NULL,
  `loginPersonne` varchar(40) NOT NULL,
  `idDevoir` int(6) NOT NULL,
  PRIMARY KEY (`idNote`),
  KEY `loginPersonne` (`loginPersonne`),
  KEY `idDevoir` (`idDevoir`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `centreformation`
--

CREATE TABLE IF NOT EXISTS `centreformation` (
  `idCentre` int(6) NOT NULL AUTO_INCREMENT,
  `nomCentre` varchar(60) CHARACTER SET latin1 NOT NULL,
  `rueCentre` varchar(80) CHARACTER SET utf8 NOT NULL,
  `villeCentre` varchar(60) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `codePostal` char(5) NOT NULL,
  `loginPersonne` varchar(40) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idCentre`),
  KEY `loginPersonne` (`nomCentre`),
  KEY `loginPersonne_2` (`loginPersonne`)
) ENGINE=InnoDB  DEFAULT CHARSET=armscii8 AUTO_INCREMENT=40 ;

-- --------------------------------------------------------

--
-- Structure de la table `devoir`
--

CREATE TABLE IF NOT EXISTS `devoir` (
  `idDevoir` int(6) NOT NULL AUTO_INCREMENT,
  `titreDevoir` varchar(40) NOT NULL,
  `dateDevoir` date NOT NULL,
  `noteMax` int(3) NOT NULL,
  `coefficient` int(2) NOT NULL,
  `idFormation` int(6) NOT NULL,
  `loginPersonne` varchar(40) NOT NULL,
  PRIMARY KEY (`idDevoir`),
  KEY `idFormation` (`idFormation`),
  KEY `loginPersonne` (`loginPersonne`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

-- --------------------------------------------------------

--
-- Structure de la table `enseigner`
--

CREATE TABLE IF NOT EXISTS `enseigner` (
  `idFormation` int(6) NOT NULL,
  `loginPersonne` varchar(40) NOT NULL,
  PRIMARY KEY (`idFormation`,`loginPersonne`),
  KEY `loginPersonne` (`loginPersonne`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

CREATE TABLE IF NOT EXISTS `formation` (
  `idFormation` int(6) NOT NULL AUTO_INCREMENT,
  `nomFormation` varchar(50) NOT NULL,
  `descriptif` varchar(1000) NOT NULL,
  `nomTypeFormation` varchar(40) NOT NULL,
  PRIMARY KEY (`idFormation`),
  KEY `intitule` (`idFormation`),
  KEY `nomTypeFormation` (`nomTypeFormation`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

-- --------------------------------------------------------

--
-- Structure de la table `forum`
--

CREATE TABLE IF NOT EXISTS `forum` (
  `idForum` int(5) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(60) NOT NULL,
  PRIMARY KEY (`idForum`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE IF NOT EXISTS `groupe` (
  `idGroupe` int(6) NOT NULL AUTO_INCREMENT,
  `nomGroupe` varchar(40) NOT NULL,
  `anneeEtude` int(11) NOT NULL,
  `anneeEntree` year(4) NOT NULL,
  `anneeSortie` year(4) NOT NULL,
  `idCentre` int(6) NOT NULL,
  PRIMARY KEY (`idGroupe`),
  KEY `idCentre` (`idCentre`),
  KEY `nomGroupe` (`nomGroupe`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

-- --------------------------------------------------------

--
-- Structure de la table `intervention`
--

CREATE TABLE IF NOT EXISTS `intervention` (
  `idIntervention` int(6) NOT NULL AUTO_INCREMENT,
  `dateDebut` timestamp NOT NULL,
  `dateFin` timestamp NOT NULL,
  `salle` varchar(5) NOT NULL,
  `idFormation` int(6) NOT NULL,
  `idCentre` int(6) NOT NULL,
  `loginPersonne` varchar(40) NOT NULL,
  PRIMARY KEY (`idIntervention`),
  KEY `idFormation` (`idFormation`),
  KEY `idCentre` (`idCentre`),
  KEY `loginPersonne` (`loginPersonne`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `idMessage` int(15) NOT NULL AUTO_INCREMENT,
  `message` varchar(2000) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nbAvisFavorable` int(3) DEFAULT '0',
  `idSujet` int(10) NOT NULL,
  `loginPersonne` varchar(40) NOT NULL,
  PRIMARY KEY (`idMessage`),
  KEY `idSujet` (`idSujet`),
  KEY `loginPersonne` (`loginPersonne`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE IF NOT EXISTS `personne` (
  `login` varchar(40) NOT NULL,
  `password` varchar(60) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `numTel` varchar(20) DEFAULT NULL,
  `role` varchar(15) NOT NULL DEFAULT 'enseignant',
  PRIMARY KEY (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `personne`
--

INSERT INTO `personne` (`login`, `password`, `nom`, `prenom`, `email`, `numTel`, `role`) VALUES
('habendaoud', 'habendaoud', 'Bendaoud', 'Harketti', 'habendaoud@mail.fr', '0410203040', 'enseignant');

-- --------------------------------------------------------

--
-- Structure de la table `sujet`
--

CREATE TABLE IF NOT EXISTS `sujet` (
  `idSujet` int(10) NOT NULL AUTO_INCREMENT,
  `titreSujet` varchar(100) NOT NULL,
  `nbReponses` int(5) NOT NULL DEFAULT '0',
  `dateDernierMessage` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `loginPersonne` varchar(40) NOT NULL,
  `idForum` int(5) NOT NULL,
  PRIMARY KEY (`idSujet`),
  KEY `auteurSujet` (`loginPersonne`),
  KEY `idCategorie` (`idForum`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Structure de la table `travailler`
--

CREATE TABLE IF NOT EXISTS `travailler` (
  `idCentre` int(6) NOT NULL,
  `loginPersonne` varchar(40) NOT NULL,
  PRIMARY KEY (`idCentre`,`loginPersonne`),
  KEY `loginPersonne` (`loginPersonne`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `typeformation`
--

CREATE TABLE IF NOT EXISTS `typeformation` (
  `nomTypeFormation` varchar(40) NOT NULL,
  PRIMARY KEY (`nomTypeFormation`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `appartenir`
--
ALTER TABLE `appartenir`
  ADD CONSTRAINT `appartenir_ibfk_1` FOREIGN KEY (`idGroupe`) REFERENCES `groupe` (`idGroupe`),
  ADD CONSTRAINT `appartenir_ibfk_2` FOREIGN KEY (`loginPersonne`) REFERENCES `personne` (`login`);

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `avis_ibfk_1` FOREIGN KEY (`loginPersonne`) REFERENCES `personne` (`login`),
  ADD CONSTRAINT `avis_ibfk_2` FOREIGN KEY (`idFormation`) REFERENCES `formation` (`idFormation`);

--
-- Contraintes pour la table `avoirnote`
--
ALTER TABLE `avoirnote`
  ADD CONSTRAINT `avoirnote_ibfk_1` FOREIGN KEY (`idDevoir`) REFERENCES `devoir` (`idDevoir`),
  ADD CONSTRAINT `avoirnote_ibfk_2` FOREIGN KEY (`loginPersonne`) REFERENCES `personne` (`login`);

--
-- Contraintes pour la table `centreformation`
--
ALTER TABLE `centreformation`
  ADD CONSTRAINT `centreformation_ibfk_1` FOREIGN KEY (`loginPersonne`) REFERENCES `personne` (`login`);

--
-- Contraintes pour la table `devoir`
--
ALTER TABLE `devoir`
  ADD CONSTRAINT `devoir_ibfk_2` FOREIGN KEY (`idFormation`) REFERENCES `formation` (`idFormation`),
  ADD CONSTRAINT `devoir_ibfk_3` FOREIGN KEY (`loginPersonne`) REFERENCES `personne` (`login`);

--
-- Contraintes pour la table `enseigner`
--
ALTER TABLE `enseigner`
  ADD CONSTRAINT `enseigner_ibfk_1` FOREIGN KEY (`idFormation`) REFERENCES `formation` (`idFormation`),
  ADD CONSTRAINT `enseigner_ibfk_2` FOREIGN KEY (`loginPersonne`) REFERENCES `personne` (`login`);

--
-- Contraintes pour la table `formation`
--
ALTER TABLE `formation`
  ADD CONSTRAINT `formation_ibfk_1` FOREIGN KEY (`nomTypeFormation`) REFERENCES `typeformation` (`nomTypeFormation`);

--
-- Contraintes pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD CONSTRAINT `groupe_ibfk_1` FOREIGN KEY (`idCentre`) REFERENCES `centreformation` (`idCentre`);

--
-- Contraintes pour la table `intervention`
--
ALTER TABLE `intervention`
  ADD CONSTRAINT `intervention_ibfk_1` FOREIGN KEY (`idFormation`) REFERENCES `formation` (`idFormation`),
  ADD CONSTRAINT `intervention_ibfk_2` FOREIGN KEY (`idCentre`) REFERENCES `centreformation` (`idCentre`),
  ADD CONSTRAINT `intervention_ibfk_3` FOREIGN KEY (`loginPersonne`) REFERENCES `personne` (`login`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`loginPersonne`) REFERENCES `personne` (`login`);

--
-- Contraintes pour la table `sujet`
--
ALTER TABLE `sujet`
  ADD CONSTRAINT `sujet_ibfk_1` FOREIGN KEY (`loginPersonne`) REFERENCES `personne` (`login`),
  ADD CONSTRAINT `sujet_ibfk_2` FOREIGN KEY (`idForum`) REFERENCES `forum` (`idForum`);

--
-- Contraintes pour la table `travailler`
--
ALTER TABLE `travailler`
  ADD CONSTRAINT `travailler_ibfk_1` FOREIGN KEY (`idCentre`) REFERENCES `centreformation` (`idCentre`),
  ADD CONSTRAINT `travailler_ibfk_2` FOREIGN KEY (`loginPersonne`) REFERENCES `personne` (`login`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
