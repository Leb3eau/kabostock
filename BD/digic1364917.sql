-- phpMyAdmin SQL Dump
-- version 5.0.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  ven. 05 juin 2020 à 19:51
-- Version du serveur :  10.3.22-MariaDB-0+deb10u1
-- Version de PHP :  7.3.14-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `digic1364917`
--
CREATE DATABASE IF NOT EXISTS `kaboss` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `kaboss`;

-- --------------------------------------------------------

--
-- Structure de la table `depenses`
--

CREATE TABLE `depenses` (
  `id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `libelle` varchar(200) NOT NULL,
  `montant` varchar(220) NOT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `devis`
--

CREATE TABLE `devis` (
  `devis_id` int(11) NOT NULL,
  `devis_date` date NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_contact` varchar(255) NOT NULL,
  `sub_total` varchar(255) NOT NULL,
  `vat` varchar(255) NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  `devis_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `devis`
--

INSERT INTO `devis` (`devis_id`, `devis_date`, `client_name`, `client_contact`, `sub_total`, `vat`, `total_amount`, `devis_status`) VALUES
(2, '2020-06-05', 'AGEROUTE PLATEAU ', '20 25 20 00', '2974576.27', '535423.73', '3510000.00', 2);

-- --------------------------------------------------------

--
-- Structure de la table `devis_item`
--

CREATE TABLE `devis_item` (
  `devis_item_id` int(11) NOT NULL,
  `devis_id` int(11) NOT NULL DEFAULT 0,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `quantity` varchar(255) NOT NULL,
  `ratea` varchar(255) NOT NULL,
  `ratev` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `devis_item_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `devis_item`
--

INSERT INTO `devis_item` (`devis_item_id`, `devis_id`, `product_id`, `quantity`, `ratea`, `ratev`, `total`, `devis_item_status`) VALUES
(18, 2, 13, '5', '185000', '117000', '585000.00', 1),
(19, 2, 14, '3', '417000', '420000', '1317000.00', 1),
(20, 2, 16, '1', '245000', '157000', '255000.00', 1),
(21, 2, 17, '1', '147000', '157000', '157000.00', 1),
(22, 2, 18, '1', '76000', '85000', '85000.00', 1),
(23, 2, 15, '1', '1000', '687000', '1.00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `fournisseurs`
--

CREATE TABLE `fournisseurs` (
  `four_id` int(11) NOT NULL,
  `four_name` varchar(255) NOT NULL,
  `four_contact` varchar(25) NOT NULL,
  `RCCM` varchar(50) NOT NULL,
  `CC` varchar(50) NOT NULL,
  `Siege_social` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Nom_Livreur` varchar(50) NOT NULL,
  `Numero_Livreur` varchar(50) NOT NULL,
  `Adresse_Postale` varchar(50) NOT NULL,
  `four_active` int(11) NOT NULL DEFAULT 0,
  `four_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `fournisseurs`
--

INSERT INTO `fournisseurs` (`four_id`, `four_name`, `four_contact`, `RCCM`, `CC`, `Siege_social`, `Email`, `Nom_Livreur`, `Numero_Livreur`, `Adresse_Postale`, `four_active`, `four_status`) VALUES
(2, 'GGGGGG', 'GGFGFJHGHJGHJH', 'JHGYUFYUGFUI', 'HHHHHHH', 'GGGGGG', 'HUHUGUGUG@HBJKJL.COM', 'KJBJBKJJKKK', 'BBGFFTYHH', 'HBVHBVHJBJKBJ', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `four_pay`
--

CREATE TABLE `four_pay` (
  `id` int(11) NOT NULL,
  `four_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `qte` varchar(220) NOT NULL,
  `montant_total` varchar(220) NOT NULL,
  `total_paiement` varchar(220) NOT NULL,
  `reste_paiement` varchar(220) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `four_pay`
--

INSERT INTO `four_pay` (`id`, `four_id`, `prod_id`, `date`, `qte`, `montant_total`, `total_paiement`, `reste_paiement`) VALUES
(13, 2, 13, '2020-06-05', '5', '925000', '0', '925000'),
(14, 2, 14, '2020-06-05', '3', '1251000', '0', '1251000'),
(15, 2, 15, '2020-06-05', '10', '100000', '0', '1000000'),
(16, 2, 16, '2020-06-05', '1', '245000', '0', '715000'),
(17, 2, 17, '2020-06-05', '1', '147000', '0', '147000'),
(18, 2, 18, '2020-06-05', '1', '76000', '0', '76000');

-- --------------------------------------------------------

--
-- Structure de la table `g_clients`
--

CREATE TABLE `g_clients` (
  `id` int(11) NOT NULL,
  `nom_prenom` varchar(225) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `g_clients`
--

INSERT INTO `g_clients` (`id`, `nom_prenom`, `status`) VALUES
(7, 'GGGGGG', 1);

-- --------------------------------------------------------

--
-- Structure de la table `g_fichiers`
--

CREATE TABLE `g_fichiers` (
  `id` int(11) NOT NULL,
  `id_clt` int(11) NOT NULL,
  `nom_fichier` varchar(225) NOT NULL,
  `photo` varchar(220) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `g_fichiers`
--

INSERT INTO `g_fichiers` (`id`, `id_clt`, `nom_fichier`, `photo`, `status`) VALUES
(17, 7, 'BonLivraison_05-06-2020_184725.jpg', '../assests/pj/61VWlxN0eFL._AC_SY355_.jpg', 1),
(18, 7, 'BonLivraison_05-06-2020_184826.jpg', '../assests/pj/61VWlxN0eFL._AC_SY355_.jpg', 1),
(19, 7, 'BonLivraison_05-06-2020_185803.jpg', '../assests/pj/61VWlxN0eFL._AC_SY355_.jpg', 1),
(20, 7, 'BonLivraison_05-06-2020_190341.jpg', '../assests/pj/61VWlxN0eFL._AC_SY355_.jpg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
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
  `order_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `client_name`, `client_contact`, `sub_total`, `vat`, `total_amount`, `discount`, `grand_total`, `paid`, `due`, `payment_type`, `payment_status`, `order_status`) VALUES
(7, '2020-06-05', 'AGEROUTE PLATEAU ', '20 25 20 00', '2974576.27', '535423.73', '3510000.00', '0', '3510000.00', '3510000', '0.00', 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `order_item`
--

CREATE TABLE `order_item` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL DEFAULT 0,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `quantity` varchar(255) NOT NULL,
  `ratea` varchar(255) NOT NULL,
  `ratev` varchar(220) NOT NULL,
  `total` varchar(255) NOT NULL,
  `order_item_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `order_item`
--

INSERT INTO `order_item` (`order_item_id`, `order_id`, `product_id`, `quantity`, `ratea`, `ratev`, `total`, `order_item_status`) VALUES
(9, 7, 13, '5', '185000', '117000', '585000.00', 1),
(10, 7, 14, '3', '417000', '420000', '1317000.00', 1),
(11, 7, 16, '1', '245000', '157000', '255000.00', 1),
(12, 7, 17, '1', '147000', '157000', '157000.00', 1),
(13, 7, 18, '1', '76000', '85000', '85000.00', 1),
(14, 7, 15, '1', '1000', '687000', '1.00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `order_payment`
--

CREATE TABLE `order_payment` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `montant` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `personnels`
--

CREATE TABLE `personnels` (
  `id` int(11) NOT NULL,
  `nom_prenom` varchar(225) NOT NULL,
  `fonction` varchar(225) NOT NULL,
  `date_fonction` date DEFAULT NULL,
  `contact` varchar(220) NOT NULL,
  `status` int(1) NOT NULL,
  `cni` varchar(220) NOT NULL,
  `salaire` varchar(220) NOT NULL,
  `photo` varchar(220) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
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
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`product_id`, `produit_id`, `ratea`, `four_id`, `quantity`, `status`, `payment_type`, `payment_mode`, `date_livraison`, `bon_livraison`, `qte_initial`, `active`) VALUES
(13, 4, '185000', 2, '0', 1, '2', '1', '2020-06-05', '../assests/pj/61VWlxN0eFL._AC_SY355_.jpg', '5', 2),
(14, 5, '417000', 2, '0', 1, '2', '1', '2020-06-05', '../assests/pj/61VWlxN0eFL._AC_SY355_.jpg', '3', 2),
(15, 7, '10000', 2, '9', 1, '2', '1', '2020-06-05', '../assests/pj/61VWlxN0eFL._AC_SY355_.jpg', '10', 1),
(16, 6, '245000', 2, '0', 1, '2', '1', '2020-06-05', '../assests/pj/61VWlxN0eFL._AC_SY355_.jpg', '1', 2),
(17, 8, '147000', 2, '0', 1, '2', '1', '2020-06-05', '../assests/pj/61VWlxN0eFL._AC_SY355_.jpg', '1', 2),
(18, 9, '76000', 2, '0', 1, '2', '1', '2020-06-05', '../assests/pj/61VWlxN0eFL._AC_SY355_.jpg', '1', 2);

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `designation` varchar(220) NOT NULL,
  `marque` varchar(220) NOT NULL,
  `type` varchar(220) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `designation`, `marque`, `type`, `description`) VALUES
(3, 'Y0', 'ITEL', 'TEL', ''),
(4, 'CAMERA IP DAHUA 8MPX 4K INTERIEUR', 'DAHUA', 'CAMERA', ''),
(5, 'CAMERA IP POE DAHUA DÃ”ME 360 8MPX 4K', 'DAHUA', 'CAMERA', ''),
(6, 'NVR POE 8 CHANELS DAHUA H265+', 'DAHUA', 'ENREGISTREUR ', ''),
(7, 'INSTALLATION ET CONFIGURATION ACCÃˆS DISTANT', 'DIGICORP', 'WORK', ''),
(8, 'Disque DURE 6 To', 'SEGATE', 'Stockage ', ''),
(9, 'CÃ‚BLE FTP CAT6+ BLINDÃ‰ ', 'HIGTECH', 'CABLE', '');

-- --------------------------------------------------------

--
-- Structure de la table `rdv`
--

CREATE TABLE `rdv` (
  `id` int(11) NOT NULL,
  `client` varchar(220) NOT NULL,
  `contact` varchar(220) NOT NULL,
  `description` text NOT NULL,
  `lieu` varchar(220) NOT NULL,
  `date` date DEFAULT NULL,
  `heure` varchar(20) DEFAULT NULL,
  `etat` varchar(220) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(220) NOT NULL,
  `nom_prenom` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `role`, `nom_prenom`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'daikinilebeau@gmail.com', 'admin', 'Henri Baudouin Lebeau');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `depenses`
--
ALTER TABLE `depenses`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `devis`
--
ALTER TABLE `devis`
  ADD PRIMARY KEY (`devis_id`);

--
-- Index pour la table `devis_item`
--
ALTER TABLE `devis_item`
  ADD PRIMARY KEY (`devis_item_id`);

--
-- Index pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  ADD PRIMARY KEY (`four_id`);

--
-- Index pour la table `four_pay`
--
ALTER TABLE `four_pay`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkpayfour` (`four_id`),
  ADD KEY `pdr` (`prod_id`);

--
-- Index pour la table `g_clients`
--
ALTER TABLE `g_clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `g_fichiers`
--
ALTER TABLE `g_fichiers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `azerty` (`id_clt`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Index pour la table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Index pour la table `order_payment`
--
ALTER TABLE `order_payment`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `personnels`
--
ALTER TABLE `personnels`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_produit_id` (`produit_id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `rdv`
--
ALTER TABLE `rdv`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `depenses`
--
ALTER TABLE `depenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `devis`
--
ALTER TABLE `devis`
  MODIFY `devis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `devis_item`
--
ALTER TABLE `devis_item`
  MODIFY `devis_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  MODIFY `four_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `four_pay`
--
ALTER TABLE `four_pay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `g_clients`
--
ALTER TABLE `g_clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `g_fichiers`
--
ALTER TABLE `g_fichiers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `order_payment`
--
ALTER TABLE `order_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `personnels`
--
ALTER TABLE `personnels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `rdv`
--
ALTER TABLE `rdv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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

