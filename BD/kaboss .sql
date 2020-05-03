-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 25 fév. 2020 à 15:39
-- Version du serveur :  5.7.28
-- Version de PHP :  7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `kaboss`
--
CREATE DATABASE IF NOT EXISTS `kaboss` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `kaboss`;

-- --------------------------------------------------------

--
-- Structure de la table `depenses`
--

DROP TABLE IF EXISTS `depenses`;
CREATE TABLE IF NOT EXISTS `depenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(255) NOT NULL,
  `libelle` varchar(200) NOT NULL,
  `montant` varchar(220) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `devis`
--

DROP TABLE IF EXISTS `devis`;
CREATE TABLE IF NOT EXISTS `devis` (
  `devis_id` int(11) NOT NULL AUTO_INCREMENT,
  `devis_date` date NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_contact` varchar(255) NOT NULL,
  `sub_total` varchar(255) NOT NULL,
  `vat` varchar(255) NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  `devis_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`devis_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `devis_item`
--

DROP TABLE IF EXISTS `devis_item`;
CREATE TABLE IF NOT EXISTS `devis_item` (
  `devis_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `devis_id` int(11) NOT NULL DEFAULT '0',
  `product_id` int(11) NOT NULL DEFAULT '0',
  `quantity` varchar(255) NOT NULL,
  `ratea` varchar(255) NOT NULL,
  `ratev` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `devis_item_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`devis_item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `fournisseurs`
--

DROP TABLE IF EXISTS `fournisseurs`;
CREATE TABLE IF NOT EXISTS `fournisseurs` (
  `four_id` int(11) NOT NULL AUTO_INCREMENT,
  `four_name` varchar(255) NOT NULL,
  `four_contact` varchar(25) NOT NULL,
  `RCCM` varchar(50) NOT NULL,
  `CC` varchar(50) NOT NULL,
  `Siege_social` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Nom_Livreur` varchar(50) NOT NULL,
  `Numero_Livreur` varchar(50) NOT NULL,
  `Adresse_Postale` varchar(50) NOT NULL,
  `four_active` int(11) NOT NULL DEFAULT '0',
  `four_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`four_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `four_pay`
--

DROP TABLE IF EXISTS `four_pay`;
CREATE TABLE IF NOT EXISTS `four_pay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `four_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `qte` varchar(220) NOT NULL,
  `montant_total` varchar(220) NOT NULL,
  `total_paiement` varchar(220) NOT NULL,
  `reste_paiement` varchar(220) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fkpayfour` (`four_id`),
  KEY `pdr` (`prod_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `g_clients`
--

DROP TABLE IF EXISTS `g_clients`;
CREATE TABLE IF NOT EXISTS `g_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_prenom` varchar(225) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `g_fichiers`
--

DROP TABLE IF EXISTS `g_fichiers`;
CREATE TABLE IF NOT EXISTS `g_fichiers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_clt` int(11) NOT NULL,
  `nom_fichier` varchar(225) NOT NULL,
  `photo` varchar(220) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `azerty` (`id_clt`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_date` date NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_contact` varchar(255) NOT NULL,
  `sub_total` varchar(255) NOT NULL,
  `vat` varchar(255) NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `grand_total` varchar(255) NOT NULL,
  `paid` varchar(255) NOT NULL,
  `due` varchar(255) NOT NULL,
  `payment_type` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `order_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `order_item`
--

DROP TABLE IF EXISTS `order_item`;
CREATE TABLE IF NOT EXISTS `order_item` (
  `order_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL DEFAULT '0',
  `product_id` int(11) NOT NULL DEFAULT '0',
  `quantity` varchar(255) NOT NULL,
  `ratea` varchar(255) NOT NULL,
  `ratev` varchar(220) NOT NULL,
  `total` varchar(255) NOT NULL,
  `order_item_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`order_item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `personnels`
--

DROP TABLE IF EXISTS `personnels`;
CREATE TABLE IF NOT EXISTS `personnels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_prenom` varchar(225) NOT NULL,
  `fonction` varchar(225) NOT NULL,
  `date_fonction` date DEFAULT NULL,
  `contact` varchar(220) NOT NULL,
  `status` int(1) NOT NULL,
  `cni` varchar(220) NOT NULL,
  `salaire` varchar(220) NOT NULL,
  `photo` varchar(220) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `produit_id` int(255) NOT NULL,
  `ratea` varchar(255) NOT NULL,
  `four_id` int(11) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `payment_mode` varchar(220) NOT NULL,
  `date_livraison` date DEFAULT NULL,
  `bon_livraison` varchar(255) NOT NULL,
  `qte_initial` varchar(255) NOT NULL,
  `active` int(1) NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `fk_produit_id` (`produit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(220) NOT NULL,
  `marque` varchar(220) NOT NULL,
  `type` varchar(220) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `rdv`
--

DROP TABLE IF EXISTS `rdv`;
CREATE TABLE IF NOT EXISTS `rdv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client` varchar(220) NOT NULL,
  `contact` varchar(220) NOT NULL,
  `description` text NOT NULL,
  `lieu` varchar(220) NOT NULL,
  `date` date DEFAULT NULL,
  `heure` varchar(20) DEFAULT NULL,
  `etat` varchar(220) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(220) NOT NULL,
  `nom_prenom` varchar(225) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `role`, `nom_prenom`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'daikinilebeau@gmail.com', 'admin', 'Henri Baudouin Lebeau'),
(2, 'Lebeau', 'fcea920f7412b5da7be0cf42b8c93759', 'hkomena@gmail.com', 'user', 'Henri Baudouin Lebeau');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `four_pay`
--
ALTER TABLE `four_pay`
  ADD CONSTRAINT `fkfouree` FOREIGN KEY (`four_id`) REFERENCES `fournisseurs` (`four_id`),
  ADD CONSTRAINT `pdr` FOREIGN KEY (`prod_id`) REFERENCES `product` (`product_id`);

--
-- Contraintes pour la table `g_fichiers`
--
ALTER TABLE `g_fichiers`
  ADD CONSTRAINT `azerty` FOREIGN KEY (`id_clt`) REFERENCES `g_clients` (`id`);

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_produit_id` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
