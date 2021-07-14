-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 18 Juin 2021 à 03:19
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `bd_pstore`
--
CREATE DATABASE IF NOT EXISTS `bd_pstore` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bd_pstore`;

-- --------------------------------------------------------

--
-- Structure de la table `abonner_compte`
--

CREATE TABLE IF NOT EXISTS `abonner_compte` (
  `ID_ABONNER_COMPTE` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CLIENT` int(11) NOT NULL,
  `ID_COMPTE_CLIENT` int(11) NOT NULL,
  PRIMARY KEY (`ID_ABONNER_COMPTE`)
) ENGINE=InnoDB  DEFAULT CHARSET=armscii8 AUTO_INCREMENT=29 ;

--
-- Contenu de la table `abonner_compte`
--

INSERT INTO `abonner_compte` (`ID_ABONNER_COMPTE`, `ID_CLIENT`, `ID_COMPTE_CLIENT`) VALUES
(6, 3, 1),
(23, 24, 12),
(27, 3, 14),
(28, 3, 17);

-- --------------------------------------------------------

--
-- Structure de la table `activer_telechargement`
--

CREATE TABLE IF NOT EXISTS `activer_telechargement` (
  `ID_ACTIVER_TELECHARGEMENT` int(11) NOT NULL AUTO_INCREMENT,
  `ACTIVER_TELECHARGEMENT` int(11) NOT NULL,
  `ID_MUSIQUE` int(11) NOT NULL,
  PRIMARY KEY (`ID_ACTIVER_TELECHARGEMENT`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `activer_telechargement`
--

INSERT INTO `activer_telechargement` (`ID_ACTIVER_TELECHARGEMENT`, `ACTIVER_TELECHARGEMENT`, `ID_MUSIQUE`) VALUES
(3, 1, 21),
(4, 1, 22),
(5, 1, 23),
(7, 1, 25),
(8, 1, 26),
(9, 1, 27),
(10, 1, 28),
(11, 1, 29),
(12, 1, 30),
(13, 1, 31),
(14, 1, 32),
(15, 1, 33);

-- --------------------------------------------------------

--
-- Structure de la table `aimer`
--

CREATE TABLE IF NOT EXISTS `aimer` (
  `ID_AIMER` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CLIENT` int(11) NOT NULL,
  `ID_COMMENTAIRE` int(11) NOT NULL,
  PRIMARY KEY (`ID_AIMER`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `aimer_commentaire_musique`
--

CREATE TABLE IF NOT EXISTS `aimer_commentaire_musique` (
  `ID_AIMER_COMMENTAIRE_MUSIQUE` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CLIENT` int(11) NOT NULL,
  `ID_COMMENTAIRE_MUSIQUE` int(11) NOT NULL,
  PRIMARY KEY (`ID_AIMER_COMMENTAIRE_MUSIQUE`)
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `aimer_musique`
--

CREATE TABLE IF NOT EXISTS `aimer_musique` (
  `ID_AIMER_MUSIQUE` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CLIENT` int(11) NOT NULL,
  `ID_MUSIQUE` int(11) NOT NULL,
  PRIMARY KEY (`ID_AIMER_MUSIQUE`)
) ENGINE=InnoDB  DEFAULT CHARSET=armscii8 AUTO_INCREMENT=30 ;

--
-- Contenu de la table `aimer_musique`
--

INSERT INTO `aimer_musique` (`ID_AIMER_MUSIQUE`, `ID_CLIENT`, `ID_MUSIQUE`) VALUES
(29, 3, 22);

-- --------------------------------------------------------

--
-- Structure de la table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `ID_ALBUM` int(11) NOT NULL AUTO_INCREMENT,
  `TITRE_ALBUM` varchar(255) CHARACTER SET latin1 NOT NULL,
  `COVER_ALBUM` varchar(255) CHARACTER SET latin1 NOT NULL,
  `ARTISTE_ALBUM` varchar(255) CHARACTER SET latin1 NOT NULL,
  `DATE_ALBUM` datetime NOT NULL,
  `ID_COMPTE_CLIENT` int(11) NOT NULL,
  PRIMARY KEY (`ID_ALBUM`)
) ENGINE=InnoDB  DEFAULT CHARSET=armscii8 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `album`
--

INSERT INTO `album` (`ID_ALBUM`, `TITRE_ALBUM`, `COVER_ALBUM`, `ARTISTE_ALBUM`, `DATE_ALBUM`, `ID_COMPTE_CLIENT`) VALUES
(11, 'SAINT-B album', 'Pduka_Logo_b6973c29b1f71e55206fbb921509a5fd.jpg', 'Saint-B', '2021-06-15 14:34:42', 16),
(12, 'Evolution de la notion dâ€™origine des marchandises', 'Pstore_Cover_d5bcb05b727ed2acb9f89ae64b6c4da9.jpg', 'ELN Black', '2021-06-16 20:18:23', 16);

-- --------------------------------------------------------

--
-- Structure de la table `application`
--

CREATE TABLE IF NOT EXISTS `application` (
  `ID_APPLICATION` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_APPLICATION` varchar(255) NOT NULL,
  `VERSION_APPLICATION` varchar(50) NOT NULL,
  `APROPOS_APPLICATION` text NOT NULL,
  `LOGO_APPLICATION` varchar(255) NOT NULL,
  `APPLICATION` varchar(255) NOT NULL,
  `CATEGORIE_APPLICATION` varchar(50) NOT NULL,
  `NIVEAU_APPLICATION` int(1) NOT NULL,
  `DATE_APPLICATION` datetime NOT NULL,
  `VISIBILITE_APPLICATION` int(1) NOT NULL,
  `ID_COMPTE_CLIENT` int(11) NOT NULL,
  PRIMARY KEY (`ID_APPLICATION`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `application`
--

INSERT INTO `application` (`ID_APPLICATION`, `NOM_APPLICATION`, `VERSION_APPLICATION`, `APROPOS_APPLICATION`, `LOGO_APPLICATION`, `APPLICATION`, `CATEGORIE_APPLICATION`, `NIVEAU_APPLICATION`, `DATE_APPLICATION`, `VISIBILITE_APPLICATION`, `ID_COMPTE_CLIENT`) VALUES
(1, 'Ternix', '1.0.0', 'Nous offrons la possibilitÃ© de crÃ©er des sondage en ligne enfin de facilitÃ© la rÃ©alisation de vos travaux de fin de cycle. Nous offrons la possibilitÃ© de crÃ©er des sondage en ligne enfin de facilitÃ© la rÃ©alisation de vos travaux de fin de cycle. Nous offrons la possibilitÃ© de crÃ©er des sondage en ligne enfin de facilitÃ© la rÃ©alisation de vos travaux de fin de cycle. Nous offrons la possibilitÃ© de crÃ©er des sondage en ligne enfin de facilitÃ© la rÃ©alisation de vos travaux de fin de cycle.', 'Pduka_Logo_7b7b774111ebf281cedad4a23b25f2e5.jpg', 'iuyt.zip', 'JEU', 1, '2021-06-05 11:02:57', 1, 2),
(2, 'pgames', '1.0.0', 'Nous offrons la possibilitÃ© de crÃ©er des sondage en ligne enfin de facilitÃ© la rÃ©alisation de vos travaux de fin de cycle. Nous offrons la possibilitÃ© de crÃ©er des sondage en ligne enfin de facilitÃ© la rÃ©alisation de vos travaux de fin de cycle. Nous offrons la possibilitÃ© de crÃ©er des sondage en ligne enfin de facilitÃ© la rÃ©alisation de vos travaux de fin de cycle. Nous offrons la possibilitÃ© de crÃ©er des sondage en ligne enfin de facilitÃ© la rÃ©alisation de vos travaux de fin de cycle. Nous offrons la possibilitÃ© de crÃ©er des sondage en ligne enfin de facilitÃ© la rÃ©alisation de vos travaux de fin de cycle.', 'Pduka_Logo_8f7edac907abbb9b59e0e88f4681876a.jpg', 'pgames.zip', 'APK', 1, '2021-06-05 21:49:42', 1, 2),
(3, 'appli turbo techno vitro el perro montech', '1.0.0', 'Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut venenatis tellus in metus vulputate eu scelerisque. Pellentesque diam volutpat commodo sed egestas egestas fringilla phasellus faucibus. Nibh tellus molestie nunc non blandit massa enim nec.', 'Pstore_Logo_6141dd810012b2ac2e5f776a6d35b462.jpg', 'appli_turbo_techno_vitro_el_perro_montech.zip', 'JEU', 1, '2021-06-16 19:43:39', 1, 2),
(4, 'Appli gesta', '1.0.0', 'Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut venenatis tellus in metus vulputate eu scelerisque. Pellentesque diam volutpat commodo sed egestas egestas fringilla phasellus faucibus. Nibh tellus molestie nunc non blandit massa enim nec.', 'Pstore_Logo_bd6922ddf4c388aa9f676a3d972e9620.jpg', 'Appli_gesta.EXE', 'APK', 1, '2021-06-18 03:45:28', 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `capture`
--

CREATE TABLE IF NOT EXISTS `capture` (
  `ID_CAPTURE` int(11) NOT NULL AUTO_INCREMENT,
  `CAPTURE` varchar(255) NOT NULL,
  `ID_APPLICATION` int(11) NOT NULL,
  PRIMARY KEY (`ID_CAPTURE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `capture`
--

INSERT INTO `capture` (`ID_CAPTURE`, `CAPTURE`, `ID_APPLICATION`) VALUES
(1, 'Pduka_Capture_66fa889fcc2d3158e7ae4547c0a25570.jpg', 2),
(2, 'Pduka_Capture_56642b520466c3830a7fd65cc74af358.jpg', 2),
(3, 'Pduka_Capture_ea2bf0701ac536d1edbe7b7784f097e1.jpg', 2),
(4, 'Pduka_Capture_8646bf8637824597494b6b5eca64c017.jpg', 1),
(5, 'Pduka_Capture_492e1d28336b7ab18c4186e7c5ebacda.jpg', 1),
(6, 'Pduka_Capture_e9cb2cf61bf7db7103d0354e0e7cd5d3.jpg', 1),
(7, 'Pduka_Capture_81a516ac55e4c9372fded8c52842b511.jpg', 3),
(8, 'Pduka_Capture_0bf4978c2850a42d710fc5e6f7508f01.jpg', 3),
(9, 'Pduka_Capture_602737e85dcb164e7b7d0465b25d04d8.jpg', 3),
(10, 'Pstore_Capture_aa6dda0b505c12f435b5f2ec568f5211.jpg', 5),
(11, 'Pstore_Capture_1d07ed6a45aaca9698bebeb64969ce83.jpg', 5),
(12, 'Pstore_Capture_ce4951da559ed7ff74be28f28aac3860.jpg', 5),
(13, 'Pduka_Capture_6c9d8fae47efd4f279a1543de7bfcae0.jpg', 4),
(14, 'Pduka_Capture_58248c08a81c831eee2b92a1e42c870d.jpg', 4),
(15, 'Pduka_Capture_fd394a5c322e1e3abea6c7ee7d3bd381.jpg', 4);

-- --------------------------------------------------------

--
-- Structure de la table `categorie_client`
--

CREATE TABLE IF NOT EXISTS `categorie_client` (
  `ID_CATEGORIE_CLIENT` int(11) NOT NULL AUTO_INCREMENT,
  `CATEGORIE_CLIENT` varchar(50) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`ID_CATEGORIE_CLIENT`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `categorie_client`
--

INSERT INTO `categorie_client` (`ID_CATEGORIE_CLIENT`, `CATEGORIE_CLIENT`) VALUES
(1, 'Simple'),
(2, 'Developpeur'),
(3, 'Musicien'),
(4, 'Beatmaker');

-- --------------------------------------------------------

--
-- Structure de la table `categorie_musique`
--

CREATE TABLE IF NOT EXISTS `categorie_musique` (
  `ID_CATEGORIE_MUSIQUE` int(11) NOT NULL AUTO_INCREMENT,
  `CATEGORIE_MUSIQUE` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`ID_CATEGORIE_MUSIQUE`)
) ENGINE=InnoDB  DEFAULT CHARSET=armscii8 AUTO_INCREMENT=37 ;

--
-- Contenu de la table `categorie_musique`
--

INSERT INTO `categorie_musique` (`ID_CATEGORIE_MUSIQUE`, `CATEGORIE_MUSIQUE`) VALUES
(1, 'Rnb'),
(2, 'Hip hop'),
(3, 'Roumba'),
(4, 'Generique'),
(5, 'Afrobeat'),
(6, 'Blues'),
(7, 'Country'),
(8, 'Dancehall'),
(9, 'Disco'),
(10, 'Electro'),
(11, 'Fado'),
(12, 'Flamenco'),
(13, 'Funk'),
(14, 'Gospel'),
(15, 'Hard rock'),
(16, 'Jazz'),
(17, 'K-indie'),
(18, 'K-pop'),
(19, 'K-rap'),
(20, 'K-rock'),
(21, 'Kompa'),
(22, 'Makosa'),
(23, 'Metal'),
(24, 'Musique Indi'),
(25, 'Musique latine'),
(26, 'New wave'),
(27, 'Pop'),
(28, 'Punk'),
(29, 'Rai'),
(30, 'Rap'),
(31, 'Reggae'),
(32, 'Rock''n''roll'),
(33, 'Ska'),
(34, 'Soul'),
(35, 'Zouk'),
(36, 'Autres');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `ID_CLIENT` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_CLIENT` varchar(255) NOT NULL,
  `MAIL_CLIENT` varchar(255) NOT NULL,
  `PASSE_CLIENT` varchar(255) NOT NULL,
  `PHOTO_CLIENT` varchar(255) NOT NULL,
  `NIVEAU_CLIENT` int(1) NOT NULL,
  `ID_REGION` int(11) NOT NULL,
  `ID_CATEGORIE_CLIENT` int(1) NOT NULL,
  PRIMARY KEY (`ID_CLIENT`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`ID_CLIENT`, `NOM_CLIENT`, `MAIL_CLIENT`, `PASSE_CLIENT`, `PHOTO_CLIENT`, `NIVEAU_CLIENT`, `ID_REGION`, `ID_CATEGORIE_CLIENT`) VALUES
(3, 'Kagala Cenyange', 'kagalacenyange@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Pstore_Profil_36e1c2e9d95bd54938fe3f10ca2a4c96.gif', 0, 16, 0),
(4, 'Paul CÃ©saire', 'paul@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Pduka_Profil_ec2a4f3c330c5cb80448c8434ecacd7a.jpg', 2, 16, 1);

-- --------------------------------------------------------

--
-- Structure de la table `client_connecter`
--

CREATE TABLE IF NOT EXISTS `client_connecter` (
  `TEMPS` int(20) NOT NULL,
  `ID_CLIENT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `client_connecter`
--

INSERT INTO `client_connecter` (`TEMPS`, `ID_CLIENT`) VALUES
(1623986264, 3),
(1623986142, 0);

-- --------------------------------------------------------

--
-- Structure de la table `client_non_inscrit`
--

CREATE TABLE IF NOT EXISTS `client_non_inscrit` (
  `ID_CLIENT_NON_INSCRIT` int(11) NOT NULL AUTO_INCREMENT,
  `IP` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_CLIENT_NON_INSCRIT`)
) ENGINE=InnoDB  DEFAULT CHARSET=armscii8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `client_non_inscrit`
--

INSERT INTO `client_non_inscrit` (`ID_CLIENT_NON_INSCRIT`, `IP`) VALUES
(1, '');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE IF NOT EXISTS `commentaire` (
  `ID_COMMENTAIRE` int(11) NOT NULL AUTO_INCREMENT,
  `COMMENTAIRE` text NOT NULL,
  `DATE_COMMENTAIRE` datetime NOT NULL,
  `ID_APPLICATION` int(11) NOT NULL,
  `ID_CLIENT` int(11) NOT NULL,
  PRIMARY KEY (`ID_COMMENTAIRE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `commentaire`
--

INSERT INTO `commentaire` (`ID_COMMENTAIRE`, `COMMENTAIRE`, `DATE_COMMENTAIRE`, `ID_APPLICATION`, `ID_CLIENT`) VALUES
(1, 'Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.', '2021-05-03 20:53:39', 2, 3),
(2, 'Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.', '2021-05-03 20:53:48', 2, 3),
(3, 'Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.', '2021-05-03 20:54:10', 2, 3),
(4, 'Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.', '2021-05-03 20:56:33', 1, 3),
(5, 'Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.', '2021-05-03 20:56:43', 1, 3),
(6, 'Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.', '2021-05-03 20:56:52', 1, 3),
(7, 'Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.', '2021-05-03 21:28:54', 3, 3),
(8, 'Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.', '2021-05-03 21:29:04', 3, 3),
(9, 'Pour votre validation, envoyer l''argent (2.5$) Ã  ce numÃ©ro +243 973458095.\r\nEntrer votre numÃ©ro d''Airtel money ci-dessous.\r\nNous allons rÃ©cevoir un message sur notre numÃ©ro pour valider votre sondage.', '2021-05-13 12:43:44', 5, 9),
(10, 'Pour votre validation, envoyer l''argent (2.5$) Ã  ce numÃ©ro +243 973458095.\r\nEntrer votre numÃ©ro d''Airtel money ci-dessous.\r\nNous allons rÃ©cevoir un message sur notre numÃ©ro pour valider votre sondage.', '2021-05-13 12:43:59', 5, 9),
(11, 'moi', '2021-06-17 01:15:59', 3, 3),
(12, 'toi ?', '2021-06-17 01:23:55', 3, 4),
(13, 'Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut venenatis tellus in metus vulputate eu scelerisque. Pellentesque diam volutpat commodo sed egestas egestas fringilla phasellus faucibus. Nibh tellus molestie nunc non blandit massa enim nec.', '2021-06-18 04:02:11', 4, 3),
(14, 'Mauris vitae ultricies leo integer malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut venenatis tellus in metus vulputate eu scelerisque. Pellentesque diam volutpat commodo sed egestas egestas fringilla phasellus faucibus.', '2021-06-18 04:03:41', 4, 4);

-- --------------------------------------------------------

--
-- Structure de la table `commentaire_musique`
--

CREATE TABLE IF NOT EXISTS `commentaire_musique` (
  `ID_COMMENTAIRE_MUSIQUE` int(11) NOT NULL AUTO_INCREMENT,
  `COMMENTAIRE_MUSIQUE` varchar(255) CHARACTER SET latin1 NOT NULL,
  `DATE_COMMENTAIRE_MUSIQUE` datetime NOT NULL,
  `ID_MUSIQUE` int(11) NOT NULL,
  `ID_CLIENT` int(11) NOT NULL,
  PRIMARY KEY (`ID_COMMENTAIRE_MUSIQUE`)
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `compte_client`
--

CREATE TABLE IF NOT EXISTS `compte_client` (
  `ID_COMPTE_CLIENT` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_COMPTE_CLIENT` varchar(255) CHARACTER SET latin1 NOT NULL,
  `APROPOS_COMPTE_CLIENT` text CHARACTER SET latin1 NOT NULL,
  `PHOTO_COMPTE_CLIENT` varchar(255) CHARACTER SET latin1 NOT NULL,
  `NIVEAU_COMPTE_CLIENT` int(1) NOT NULL,
  `DATE_COMPTE_CLIENT` datetime NOT NULL,
  `ID_CATEGORIE_CLIENT` int(11) NOT NULL,
  `ID_CLIENT` int(11) NOT NULL,
  PRIMARY KEY (`ID_COMPTE_CLIENT`)
) ENGINE=InnoDB  DEFAULT CHARSET=armscii8 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `compte_client`
--

INSERT INTO `compte_client` (`ID_COMPTE_CLIENT`, `NOM_COMPTE_CLIENT`, `APROPOS_COMPTE_CLIENT`, `PHOTO_COMPTE_CLIENT`, `NIVEAU_COMPTE_CLIENT`, `DATE_COMPTE_CLIENT`, `ID_CATEGORIE_CLIENT`, `ID_CLIENT`) VALUES
(2, 'PERSPECTIVE GAME', 'Lorsquâ€™une rÃ¨gle primaire est respectÃ©e (rÃ¨gle de chapitre ou rÃ¨gle de liste) : le pays dâ€™origine est celui qui est indiquÃ© par cette rÃ¨gle, ou celui oÃ¹ cette rÃ¨gle est respectÃ©e. Au point 2.4 des notes introductives au tableau des rÃ¨gles de liste (publiÃ©es sur le site Europa), il est prÃ©cisÃ© que les matiÃ¨res qui ont acquis le caractÃ¨re originaire dans un pays sont considÃ©rÃ©es comme des matiÃ¨res originaires de ce pays aux fins de la dÃ©termination de lâ€™origine dâ€™une marchandise incorporant ces matiÃ¨res, ou dâ€™une marchandise fabriquÃ©e Ã  partir de ces matiÃ¨res par ouvraison ou transformation ultÃ©rieure dans ce pays. De plus, le point 2.6 de ces notes Ã©nonce que lorsque la rÃ¨gle principale est fondÃ©e sur un changement de position tarifaire, les matiÃ¨res non originaires non conformes Ã  la rÃ¨gle principale, sauf dispositions contraires figurant dans un chapitre particulier, ne sont pas prises en considÃ©ration, pour autant que la valeur totale de ces matiÃ¨res nâ€™excÃ¨de pas 10 % du prix dÃ©part usine de la marchandise.', 'Pduka_Compte_704fd0644ab78db06654c32d2d3a1887.jpg', 1, '2021-05-03 20:45:11', 2, 3),
(16, 'SAINT-B LE MSANI', 'Lorsquâ€™une rÃ¨gle primaire est respectÃ©e (rÃ¨gle de chapitre ou rÃ¨gle de liste) : le pays dâ€™origine est celui qui est indiquÃ© par cette rÃ¨gle, ou celui oÃ¹ cette rÃ¨gle est respectÃ©e. Au point 2.4 des notes introductives au tableau des rÃ¨gles de liste (publiÃ©es sur le site Europa), il est prÃ©cisÃ© que les matiÃ¨res qui ont acquis le caractÃ¨re originaire dans un pays sont considÃ©rÃ©es comme des matiÃ¨res originaires de ce pays aux fins de la dÃ©termination de lâ€™origine dâ€™une marchandise incorporant ces matiÃ¨res, ou dâ€™une marchandise fabriquÃ©e Ã  partir de ces matiÃ¨res par ouvraison ou transformation ultÃ©rieure dans ce pays. De plus, le point 2.6 de ces notes Ã©nonce que lorsque la rÃ¨gle principale est fondÃ©e sur un changement de position tarifaire, les matiÃ¨res non originaires non conformes Ã  la rÃ¨gle principale, sauf dispositions contraires figurant dans un chapitre particulier, ne sont pas prises en considÃ©ration, pour autant que la valeur totale de ces matiÃ¨res nâ€™excÃ¨de pas 10 % du prix dÃ©part usine de la marchandise.', 'Pduka_Compte_c79ef57575af92ffffe1f01925a3b6df.jpg', 1, '2021-06-15 14:01:52', 3, 3),
(17, 'SAINT-B beatmaker bukavu city town', 'Lorsquâ€™une rÃ¨gle primaire est respectÃ©e (rÃ¨gle de chapitre ou rÃ¨gle de liste) : le pays dâ€™origine est celui qui est indiquÃ© par cette rÃ¨gle, ou celui oÃ¹ cette rÃ¨gle est respectÃ©e. Au point 2.4 des notes introductives au tableau des rÃ¨gles de liste (publiÃ©es sur le site Europa), il est prÃ©cisÃ© que les matiÃ¨res qui ont acquis le caractÃ¨re originaire dans un pays sont considÃ©rÃ©es comme des matiÃ¨res originaires de ce pays aux fins de la dÃ©termination de lâ€™origine dâ€™une marchandise incorporant ces matiÃ¨res, ou dâ€™une marchandise fabriquÃ©e Ã  partir de ces matiÃ¨res par ouvraison ou transformation ultÃ©rieure dans ce pays. De plus, le point 2.6 de ces notes Ã©nonce que lorsque la rÃ¨gle principale est fondÃ©e sur un changement de position tarifaire, les matiÃ¨res non originaires non conformes Ã  la rÃ¨gle principale, sauf dispositions contraires figurant dans un chapitre particulier, ne sont pas prises en considÃ©ration, pour autant que la valeur totale de ces matiÃ¨res nâ€™excÃ¨de pas 10 % du prix dÃ©part usine de la marchandise.', 'Pduka_Compte_10e5b1079799fd30e4bf5a0a587042e8.jpg', 1, '2021-06-15 14:02:46', 4, 3);

-- --------------------------------------------------------

--
-- Structure de la table `musique`
--

CREATE TABLE IF NOT EXISTS `musique` (
  `ID_MUSIQUE` int(11) NOT NULL AUTO_INCREMENT,
  `TITRE_MUSIQUE` varchar(255) NOT NULL,
  `LOGO_MUSIQUE` varchar(255) NOT NULL,
  `MUSIQUE` varchar(255) NOT NULL,
  `DATE_MUSIQUE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `NOM_ARTISTE` varchar(255) NOT NULL,
  `PRIX_MUSIQUE` int(11) NOT NULL,
  `ID_CATEGORIE_MUSIQUE` int(11) NOT NULL,
  `ID_ALBUM` int(11) NOT NULL,
  `ID_COMPTE_CLIENT` int(11) NOT NULL,
  PRIMARY KEY (`ID_MUSIQUE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Contenu de la table `musique`
--

INSERT INTO `musique` (`ID_MUSIQUE`, `TITRE_MUSIQUE`, `LOGO_MUSIQUE`, `MUSIQUE`, `DATE_MUSIQUE`, `NOM_ARTISTE`, `PRIX_MUSIQUE`, `ID_CATEGORIE_MUSIQUE`, `ID_ALBUM`, `ID_COMPTE_CLIENT`) VALUES
(21, 'Lova yo', 'Pstore_Cover_926958cecbe076af313c9095bf5acf5c.jpg', 'Lova_yo.m4a', '2021-06-15 14:08:35', 'ELN Black', 0, 5, 0, 16),
(22, 'Amore', 'Pstore_Cover_1c97a2e85a750a6b93706f311b7c2e59.jpg', 'Amore.mp3', '2021-06-15 14:19:04', 'saintb beat', 50000, 5, 0, 17),
(23, 'likolo', 'Pduka_Logo_b6973c29b1f71e55206fbb921509a5fd.jpg', 'likolo.mp3', '2021-06-15 15:16:55', 'SAINT-B LE MSANI', 0, 5, 11, 16),
(25, 'La CENCO accuse le CHICHI kagala', 'Pstore_Cover_d5bcb05b727ed2acb9f89ae64b6c4da9.jpg', 'La_CENCO_accuse_le_CHICHI_kagala.mp3', '2021-06-16 21:00:00', 'SAINT-B LE MSANI', 0, 1, 12, 16),
(26, 'hjtkfk', 'Pstore_Cover_2a59f290d3456ff93bf5b1d0df3bb8f3.jpg', 'hjtkfk.mp3', '2021-06-17 12:24:05', 'lolo', 0, 5, 0, 16),
(27, 'ghjhh', 'Pstore_Cover_1b2d7c2abb4c8043ccfb0394dea08f8c.jpg', 'ghjhh.mp3', '2021-06-17 12:27:17', 'iuhj', 0, 5, 0, 16),
(28, 'lke', 'Pstore_Cover_99b2a065181b3e59a95f4edc3843437d.jpg', 'lke.mp3', '2021-06-17 12:30:24', 'ELN Black', 0, 5, 0, 16),
(29, 'hgjj', 'Pstore_Cover_957efc2c9db86d3f0a04d26af65d88ca.jpg', 'hgjj.mp3', '2021-06-17 12:32:26', 'jrjr', 0, 5, 0, 16),
(30, 'lkerlke', 'Pstore_Cover_f5a179234d58ccd5fee5046f7e1f790b.jpg', 'lkerlke.mp3', '2021-06-17 12:33:46', 'kjekj', 0, 36, 0, 16),
(31, 'kfklf', 'Pstore_Cover_d24020b7d8a72142740dddc55ca75013.jpg', 'kfklf.mp3', '2021-06-17 12:37:18', 'jkfdk', 0, 5, 0, 16),
(32, 'Mon premier tutoriel', 'Pstore_Cover_afa1e27d3419425c31f488265819fde1.jpg', 'Mon_premier_tutoriel.mp3', '2021-06-17 12:49:16', 'Fally', 0, 5, 0, 16),
(33, 'fdtt', 'Pstore_Cover_3b3e90587971730eacbb87ae84b9ae48.jpg', 'fdtt.mp3', '2021-06-17 15:08:18', 'jjj', 60000, 5, 0, 17);

-- --------------------------------------------------------

--
-- Structure de la table `nombre_ecouter_musique`
--

CREATE TABLE IF NOT EXISTS `nombre_ecouter_musique` (
  `ID_NOMBRE_ECOUTER_MUSIQUE` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE_ECOUTER_MUSIQUE` int(11) NOT NULL,
  `ID_MUSIQUE` int(11) NOT NULL,
  PRIMARY KEY (`ID_NOMBRE_ECOUTER_MUSIQUE`)
) ENGINE=InnoDB  DEFAULT CHARSET=armscii8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `nombre_ecouter_musique`
--

INSERT INTO `nombre_ecouter_musique` (`ID_NOMBRE_ECOUTER_MUSIQUE`, `NOMBRE_ECOUTER_MUSIQUE`, `ID_MUSIQUE`) VALUES
(1, 3, 21),
(2, 5, 22),
(3, 4, 23),
(4, 5, 25),
(5, 1, 29),
(6, 1, 27),
(7, 2, 33),
(8, 3, 32);

-- --------------------------------------------------------

--
-- Structure de la table `nombre_partager_application`
--

CREATE TABLE IF NOT EXISTS `nombre_partager_application` (
  `ID_NOMBRE_PARTAGER_APPLICATION` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE_PARTAGER_APPLICATION` int(11) NOT NULL,
  `ID_APPLICATION` int(11) NOT NULL,
  PRIMARY KEY (`ID_NOMBRE_PARTAGER_APPLICATION`)
) ENGINE=InnoDB  DEFAULT CHARSET=armscii8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `nombre_partager_application`
--

INSERT INTO `nombre_partager_application` (`ID_NOMBRE_PARTAGER_APPLICATION`, `NOMBRE_PARTAGER_APPLICATION`, `ID_APPLICATION`) VALUES
(1, 2, 6),
(2, 2, 5),
(3, 5, 2),
(4, 3, 4),
(5, 3, 10),
(6, 1, 11),
(7, 1, 13),
(8, 1, 15),
(9, 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `nombre_partager_musique`
--

CREATE TABLE IF NOT EXISTS `nombre_partager_musique` (
  `ID_NOMBRE_PARTAGER_MUSIQUE` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE_PARTAGER_MUSIQUE` int(11) NOT NULL,
  `ID_MUSIQUE` int(11) NOT NULL,
  PRIMARY KEY (`ID_NOMBRE_PARTAGER_MUSIQUE`)
) ENGINE=InnoDB  DEFAULT CHARSET=armscii8 AUTO_INCREMENT=20 ;

--
-- Contenu de la table `nombre_partager_musique`
--

INSERT INTO `nombre_partager_musique` (`ID_NOMBRE_PARTAGER_MUSIQUE`, `NOMBRE_PARTAGER_MUSIQUE`, `ID_MUSIQUE`) VALUES
(1, 10, 22),
(2, 11, 23),
(3, 8, 16),
(4, 2, 24),
(7, 12, 31),
(8, 1, 32),
(9, 6, 34),
(10, 5, 33),
(11, 2, 3),
(12, 5, 6),
(13, 2, 15),
(14, 2, 13),
(15, 2, 12),
(16, 26, 18),
(17, 4, 17),
(18, 5, 21),
(19, 4, 25);

-- --------------------------------------------------------

--
-- Structure de la table `nombre_telechargement`
--

CREATE TABLE IF NOT EXISTS `nombre_telechargement` (
  `ID_NOMBRE_TELECHARGEMENT` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE_TELECHARGEMENT` int(11) NOT NULL,
  `ID_APPLICATION` int(11) NOT NULL,
  PRIMARY KEY (`ID_NOMBRE_TELECHARGEMENT`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `nombre_telechargement`
--

INSERT INTO `nombre_telechargement` (`ID_NOMBRE_TELECHARGEMENT`, `NOMBRE_TELECHARGEMENT`, `ID_APPLICATION`) VALUES
(1, 2, 2),
(2, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `nombre_telechargement_musique`
--

CREATE TABLE IF NOT EXISTS `nombre_telechargement_musique` (
  `ID_NOMBRE_TELECHARGEMENT_MUSIQUE` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE_TELECHARGEMENT_MUSIQUE` int(11) NOT NULL,
  `ID_MUSIQUE` int(11) NOT NULL,
  PRIMARY KEY (`ID_NOMBRE_TELECHARGEMENT_MUSIQUE`)
) ENGINE=InnoDB  DEFAULT CHARSET=armscii8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `nombre_telechargement_musique`
--

INSERT INTO `nombre_telechargement_musique` (`ID_NOMBRE_TELECHARGEMENT_MUSIQUE`, `NOMBRE_TELECHARGEMENT_MUSIQUE`, `ID_MUSIQUE`) VALUES
(1, 2, 23),
(2, 1, 32);

-- --------------------------------------------------------

--
-- Structure de la table `nombre_vues_application`
--

CREATE TABLE IF NOT EXISTS `nombre_vues_application` (
  `ID_NOMBRE_VUES_APPLICATION` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE_VUES_APPLICATION` int(11) NOT NULL,
  `ID_APPLICATION` int(11) NOT NULL,
  PRIMARY KEY (`ID_NOMBRE_VUES_APPLICATION`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `nombre_vues_application`
--

INSERT INTO `nombre_vues_application` (`ID_NOMBRE_VUES_APPLICATION`, `NOMBRE_VUES_APPLICATION`, `ID_APPLICATION`) VALUES
(1, 66, 1),
(2, 33, 2),
(3, 51, 3),
(4, 19, 4);

-- --------------------------------------------------------

--
-- Structure de la table `nombre_vues_musique`
--

CREATE TABLE IF NOT EXISTS `nombre_vues_musique` (
  `ID_NOMBRE_VUES_MUSIQUE` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE_VUES_MUSIQUE` int(11) NOT NULL,
  `ID_MUSIQUE` int(11) NOT NULL,
  PRIMARY KEY (`ID_NOMBRE_VUES_MUSIQUE`)
) ENGINE=InnoDB  DEFAULT CHARSET=armscii8 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `nombre_vues_musique`
--

INSERT INTO `nombre_vues_musique` (`ID_NOMBRE_VUES_MUSIQUE`, `NOMBRE_VUES_MUSIQUE`, `ID_MUSIQUE`) VALUES
(9, 66, 22),
(10, 12, 21),
(11, 57, 23),
(13, 33, 25),
(14, 1, 26),
(15, 2, 27),
(16, 3, 28),
(17, 2, 29),
(18, 3, 30),
(19, 1, 31),
(20, 27, 32),
(21, 36, 33);

-- --------------------------------------------------------

--
-- Structure de la table `pas_aimer_commentaire_musique`
--

CREATE TABLE IF NOT EXISTS `pas_aimer_commentaire_musique` (
  `ID_PAS_AIMER_COMMENTAIRE_MUSIQUE` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CLIENT` int(11) NOT NULL,
  `ID_COMMENTAIRE_MUSIQUE` int(11) NOT NULL,
  PRIMARY KEY (`ID_PAS_AIMER_COMMENTAIRE_MUSIQUE`)
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `region`
--

CREATE TABLE IF NOT EXISTS `region` (
  `ID_REGION` int(11) NOT NULL AUTO_INCREMENT,
  `REGION` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`ID_REGION`)
) ENGINE=InnoDB  DEFAULT CHARSET=armscii8 AUTO_INCREMENT=61 ;

--
-- Contenu de la table `region`
--

INSERT INTO `region` (`ID_REGION`, `REGION`) VALUES
(5, 'Afrique Du Sud'),
(6, 'Algerie'),
(7, 'Angola'),
(8, 'Benin'),
(9, 'Botswana'),
(10, 'Burkina'),
(11, 'Burundi'),
(12, 'Cameroun'),
(13, 'Cap-Vert'),
(14, 'Republique Centre-Africaine'),
(15, 'Comores'),
(16, 'Republique Democratique Du Congo'),
(17, 'Congo'),
(18, 'Cote d''Ivoire'),
(19, 'Djibouti'),
(20, 'Egypte'),
(21, 'Ethiopie'),
(22, 'Erythree'),
(23, 'Gabon'),
(24, 'Gambie'),
(25, 'Ghana'),
(26, 'Guinee'),
(27, 'Guinee-Bisseau'),
(28, 'Guinee Equatoriale'),
(29, 'Kenya'),
(30, 'Lesotho'),
(31, 'Liberia'),
(32, 'Libye'),
(33, 'Madagascar'),
(34, 'Malawi'),
(35, 'Mali'),
(36, 'Maroc'),
(37, 'Maurice'),
(38, 'Mauritanie'),
(39, 'Mozambique'),
(40, 'Namibie'),
(41, 'Niger'),
(42, 'Nigeria'),
(43, 'Ouganda'),
(44, 'Rwanda'),
(45, 'Sao Tome-et-Principe'),
(46, 'Senegal'),
(47, 'Seychelles'),
(48, 'Sierra Leonne'),
(49, 'Somalie'),
(50, 'Soudan Du Nord'),
(51, 'Swaziland'),
(52, 'Tanzanie'),
(53, 'Tchad'),
(54, 'Togo'),
(55, 'Tunisie'),
(56, 'Zambie'),
(57, 'Zimbabwe'),
(59, 'Soudan Du Sud'),
(60, 'Autres');

-- --------------------------------------------------------

--
-- Structure de la table `signaler`
--

CREATE TABLE IF NOT EXISTS `signaler` (
  `ID_SIGNALER` int(11) NOT NULL AUTO_INCREMENT,
  `SIGNALER` varchar(255) NOT NULL,
  `ID_CLIENT` int(11) NOT NULL,
  `ID_APPLICATION` int(11) NOT NULL,
  PRIMARY KEY (`ID_SIGNALER`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
