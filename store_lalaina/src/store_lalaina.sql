-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 01 août 2023 à 01:10
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `store_lalaina`
--

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `path` varchar(100) NOT NULL,
  `id_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id`, `path`, `id_product`) VALUES
(1, 'Lalaina_Creation_4.jpg', 1),
(2, 'Lalaina_Creation_5.jpg', 1),
(3, 'Lalaina_Creation_6.jpg', 1),
(4, 'Lalaina_Creation_9.jpg', 2),
(5, 'Lalaina_Creation_10.jpg', 2),
(6, 'Lalaina_Creation_35.jpg', 3),
(7, 'Lalaina_Creation_36.jpg', 3),
(8, 'Lalaina_Creation_37.jpg', 3),
(9, 'Lalaina_Creation_38.jpg', 3),
(10, 'Lalaina_Creation_83.jpg', 4),
(11, 'Lalaina_Creation_84.jpg', 4),
(12, 'Lalaina_Creation_73.jpg', 5),
(13, 'Lalaina_Creation_74.jpg', 5),
(14, 'Lalaina_Creation_65.jpg', 6),
(15, 'Lalaina_Creation_66.jpg', 6),
(16, 'Lalaina_Creation_67.jpg', 6),
(17, 'Lalaina_Creation_68.jpg', 6),
(18, 'Lalaina_Creation_11.jpg', 7),
(19, 'Lalaina_Creation_12.jpg', 7),
(20, 'Lalaina_Creation_13.jpg', 7),
(21, 'Lalaina_Creation_23.jpg', 8),
(22, 'Lalaina_Creation_24.jpg', 8),
(23, 'Lalaina_Creation_44.jpg', 9),
(24, 'Lalaina_Creation_45.jpg', 9);

-- --------------------------------------------------------

--
-- Structure de la table `nouveautes`
--

CREATE TABLE `nouveautes` (
  `id_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `nouveautes`
--

INSERT INTO `nouveautes` (`id_product`) VALUES
(8),
(9);

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id_product` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `type` varchar(50) NOT NULL,
  `sex` varchar(20) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id_product`, `title`, `type`, `sex`, `price`) VALUES
(1, 'Poncho rouge', 'Vetement', 'Femme', 90),
(2, 'Poncho jaune', 'Vetement', 'Femme', 90),
(3, 'Robe beige', 'Vetement', 'Femme', 150),
(4, 'Ensemble rouge', 'Vetement', 'Femme', 105),
(5, 'Poncho bleu clair', 'Vetement', 'Femme', 90),
(6, 'Poncho bleu foncé', 'Vetement', 'Femme', 90),
(7, 'Pull gris', 'Vetement', 'Homme', 125),
(8, 'Poncho orange', 'Vetement', 'Femme', 90),
(9, 'Blouson bleu', 'Vetement', 'Homme', 179);

-- --------------------------------------------------------

--
-- Structure de la table `size`
--

CREATE TABLE `size` (
  `id` int(11) NOT NULL,
  `size` varchar(10) NOT NULL,
  `id_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `size`
--

INSERT INTO `size` (`id`, `size`, `id_product`) VALUES
(1, 'S', 1),
(2, 'M', 1),
(3, 'L', 1),
(4, 'S', 2),
(5, 'M', 2),
(6, 'L', 2),
(7, 'S', 3),
(8, 'M', 3),
(9, 'L', 3),
(10, 'S', 4),
(11, 'M', 4),
(12, 'L', 4),
(16, 'S', 5),
(17, 'M', 5),
(18, 'L', 5),
(19, 'S', 6),
(20, 'M', 6),
(21, 'L', 6),
(22, 'S', 7),
(23, 'M', 7),
(24, 'L', 7),
(25, 'S', 8),
(26, 'M', 8),
(27, 'L', 8),
(28, 'S', 9),
(29, 'M', 9),
(30, 'L', 9);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`);

--
-- Index pour la table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `size`
--
ALTER TABLE `size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
