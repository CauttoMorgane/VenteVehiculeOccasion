-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mer 03 Mai 2017 à 13:06
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `automobile`
--

-- --------------------------------------------------------

--
-- Structure de la table `archive_user`
--

CREATE TABLE `archive_user` (
  `user_id` int(11) NOT NULL,
  `user_login` varchar(30) NOT NULL,
  `user_mdp` varchar(255) NOT NULL,
  `user_mail` varchar(50) NOT NULL,
  `user_lvl` int(11) NOT NULL,
  `user_nom` varchar(25) NOT NULL,
  `user_prenom` varchar(25) NOT NULL,
  `user_tel` varchar(10) NOT NULL,
  `user_fixe` varchar(10) NOT NULL,
  `user_cp` varchar(5) NOT NULL,
  `user_ville` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `archive_user`
--

INSERT INTO `archive_user` (`user_id`, `user_login`, `user_mdp`, `user_mail`, `user_lvl`, `user_nom`, `user_prenom`, `user_tel`, `user_fixe`, `user_cp`, `user_ville`) VALUES
(5, 'mama', 'd41d8cd98f00b204e9800998ecf8427e', 'mama@gmail.com', 1, 'MAMA', 'Mama', '0616710000', '0116710000', '75001', 'Paris'),
(3, 'meiko', '81dc9bdb52d04dc20036dbd8313ed055', 'meiko@gmail.com', 1, 'Ni', 'Meiko', '0616710000', '0116710000', '75001', 'Paris');

-- --------------------------------------------------------

--
-- Structure de la table `archive_vehicule`
--

CREATE TABLE `archive_vehicule` (
  `vehicule_id` int(11) NOT NULL,
  `vehicule_marque` varchar(25) NOT NULL,
  `vehicule_modele` varchar(25) NOT NULL,
  `vehicule_km` int(11) NOT NULL,
  `vehicule_boite` varchar(20) NOT NULL,
  `vehicule_carburant` varchar(20) NOT NULL,
  `vehicule_annee` int(11) NOT NULL,
  `vehicule_pxVente` decimal(10,0) NOT NULL,
  `vehicule_description` text NOT NULL,
  `vehicule_photo` varchar(100) NOT NULL,
  `vehicule_vendeur` int(11) NOT NULL,
  `vehicule_dateCrea` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `archive_vehicule`
--

INSERT INTO `archive_vehicule` (`vehicule_id`, `vehicule_marque`, `vehicule_modele`, `vehicule_km`, `vehicule_boite`, `vehicule_carburant`, `vehicule_annee`, `vehicule_pxVente`, `vehicule_description`, `vehicule_photo`, `vehicule_vendeur`, `vehicule_dateCrea`) VALUES
(13, 'azertyui', 'azertyu', 12345, 'Manuelle', 'Hybride', 1996, '123456', 'ZERSFTYUIJOKL', '1493125481.jpg', 1, '2017-04-25 15:04:41'),
(12, 'AlfaRomeo', '159', 999000, 'Automatique', 'Electrique', 2007, '4500', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '1490951869.jpg', 1, '2017-05-03 14:09:08');

-- --------------------------------------------------------

--
-- Structure de la table `auto_user`
--

CREATE TABLE `auto_user` (
  `user_id` int(11) NOT NULL,
  `user_login` varchar(30) NOT NULL,
  `user_mdp` varchar(255) NOT NULL,
  `user_mail` varchar(50) NOT NULL,
  `user_lvl` int(11) NOT NULL,
  `user_nom` varchar(25) NOT NULL,
  `user_prenom` varchar(25) NOT NULL,
  `user_tel` varchar(10) NOT NULL,
  `user_fixe` varchar(10) NOT NULL,
  `user_cp` varchar(5) NOT NULL,
  `user_ville` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `auto_user`
--

INSERT INTO `auto_user` (`user_id`, `user_login`, `user_mdp`, `user_mail`, `user_lvl`, `user_nom`, `user_prenom`, `user_tel`, `user_fixe`, `user_cp`, `user_ville`) VALUES
(1, 'toto', '81dc9bdb52d04dc20036dbd8313ed055', 'toto@gmail.fr', 2, 'Toto', 'Toto', '0616713800', '0116713800', '77240', 'Cesson'),
(2, 'nina', '81dc9bdb52d04dc20036dbd8313ed055', 'nina@gmail.com', 1, 'Nina', 'Nina', '0616710000', '0116710000', '77350', 'Le Mee');

--
-- Déclencheurs `auto_user`
--
DELIMITER $$
CREATE TRIGGER `archiveUser` BEFORE DELETE ON `auto_user` FOR EACH ROW INSERT INTO `archive_user` (`user_id`, `user_login`, `user_mdp`, `user_mail`, `user_lvl`, `user_nom`, `user_prenom`, `user_tel`, `user_fixe`, `user_cp`, `user_ville`) 
VALUES(OLD.`user_id`, OLD.`user_login`, OLD.`user_mdp`, OLD.`user_mail`, OLD.`user_lvl`, OLD.`user_nom`, OLD.`user_prenom`, OLD.`user_tel`, OLD.`user_fixe`, OLD.`user_cp`, OLD.`user_ville`)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `auto_vehicule`
--

CREATE TABLE `auto_vehicule` (
  `vehicule_id` int(11) NOT NULL,
  `vehicule_marque` varchar(25) NOT NULL,
  `vehicule_modele` varchar(25) NOT NULL,
  `vehicule_km` int(11) NOT NULL,
  `vehicule_boite` varchar(20) NOT NULL,
  `vehicule_carburant` varchar(20) NOT NULL,
  `vehicule_annee` int(11) NOT NULL,
  `vehicule_pxVente` decimal(10,0) NOT NULL,
  `vehicule_description` text NOT NULL,
  `vehicule_photo` varchar(100) NOT NULL,
  `vehicule_vendeur` int(11) NOT NULL,
  `vehicule_dateCrea` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `auto_vehicule`
--

INSERT INTO `auto_vehicule` (`vehicule_id`, `vehicule_marque`, `vehicule_modele`, `vehicule_km`, `vehicule_boite`, `vehicule_carburant`, `vehicule_annee`, `vehicule_pxVente`, `vehicule_description`, `vehicule_photo`, `vehicule_vendeur`, `vehicule_dateCrea`) VALUES
(10, 'Peugeot', '207', 120007, 'Manuelle', 'Essence', 1991, '1200', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '1493125328.jpg', 1, '2017-02-20 10:02:59'),
(11, 'Audi', 'A3', 499000, 'Automatique', 'Hybride', 2005, '5000', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '1493813538.jpg', 2, '2017-02-20 10:56:30'),
(15, 'Renault', 'Kangoo', 220000, 'Manuelle', 'Diesel', 2006, '1650', 'Veterum varietate quaedam conmerciorum castrisque sollicitudo castellis et ad ex validis ad marte et oppida nostris hanc provinciae est habet quaedam rectoreque conserta oportunos ad ad atque validis et murorum.', '1493813855.jpg', 1, '2017-05-03 14:17:35'),
(16, 'Mercedes', 'Citant 109', 67500, 'Manuelle', 'Diesel', 2014, '11500', 'Veterum varietate quaedam conmerciorum castrisque sollicitudo castellis et ad ex validis ad marte et oppida nostris hanc provinciae est habet quaedam rectoreque conserta oportunos ad ad atque validis et murorum.', '1493814155.jpg', 1, '2017-05-03 14:22:35'),
(17, 'Peugeot', '308', 160000, 'Manuelle', 'Essence', 2008, '4990', 'Veterum varietate quaedam conmerciorum castrisque sollicitudo castellis et ad ex validis ad marte et oppida nostris hanc provinciae est habet quaedam rectoreque conserta oportunos ad ad atque validis et murorum.', '1493814356.jpg', 1, '2017-05-03 14:25:56'),
(18, 'Renault', 'Espace', 197000, 'Manuelle', 'Essence', 2003, '2290', 'Veterum varietate quaedam conmerciorum castrisque sollicitudo castellis et ad ex validis ad marte et oppida nostris hanc provinciae est habet quaedam rectoreque conserta oportunos ad ad atque validis et murorum.', '1493814502.jpg', 1, '2017-05-03 14:28:22'),
(19, 'Fiat', 'Ducato', 75000, 'Automatique', 'Diesel', 2001, '4250', 'Veterum varietate quaedam conmerciorum castrisque sollicitudo castellis et ad ex validis ad marte et oppida nostris hanc provinciae est habet quaedam rectoreque conserta oportunos ad ad atque validis et murorum.', '1493814712.jpg', 2, '2017-05-03 14:31:52'),
(20, 'Renault', 'Secnic', 61000, 'Automatique', 'Essence', 2008, '4290', 'Veterum varietate quaedam conmerciorum castrisque sollicitudo castellis et ad ex validis ad marte et oppida nostris hanc provinciae est habet quaedam rectoreque conserta oportunos ad ad atque validis et murorum.', '1493814908.jpg', 2, '2017-05-03 14:35:08'),
(21, 'Fiat', '500', 49000, 'Manuelle', 'Essence', 2012, '8900', 'Veterum varietate quaedam conmerciorum castrisque sollicitudo castellis et ad ex validis ad marte et oppida nostris hanc provinciae est habet quaedam rectoreque conserta oportunos ad ad atque validis et murorum.', '1493815456.jpg', 2, '2017-05-03 14:44:16');

--
-- Déclencheurs `auto_vehicule`
--
DELIMITER $$
CREATE TRIGGER `archiveVehicule` BEFORE DELETE ON `auto_vehicule` FOR EACH ROW INSERT INTO `archive_vehicule` (`vehicule_id`, `vehicule_marque`, `vehicule_modele`, `vehicule_km`, `vehicule_boite`, `vehicule_carburant`, `vehicule_annee`, `vehicule_pxVente`, `vehicule_description`, `vehicule_photo`, `vehicule_vendeur`,`vehicule_dateCrea`) 
VALUES (OLD.`vehicule_id`, OLD.`vehicule_marque`, OLD.`vehicule_modele`, OLD.`vehicule_km`, OLD.`vehicule_boite`, OLD.`vehicule_carburant`, OLD.`vehicule_annee`, OLD.`vehicule_pxVente`, OLD.`vehicule_description`, OLD.`vehicule_photo`, OLD.`vehicule_vendeur`,NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

CREATE TABLE `favoris` (
  `fav_id` int(11) NOT NULL,
  `fav_membre` int(11) NOT NULL,
  `fav_vehicule` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `favoris`
--

INSERT INTO `favoris` (`fav_id`, `fav_membre`, `fav_vehicule`) VALUES
(1, 1, 10),
(2, 1, 11);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `auto_user`
--
ALTER TABLE `auto_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Index pour la table `auto_vehicule`
--
ALTER TABLE `auto_vehicule`
  ADD PRIMARY KEY (`vehicule_id`);

--
-- Index pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD PRIMARY KEY (`fav_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `auto_user`
--
ALTER TABLE `auto_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `auto_vehicule`
--
ALTER TABLE `auto_vehicule`
  MODIFY `vehicule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT pour la table `favoris`
--
ALTER TABLE `favoris`
  MODIFY `fav_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
