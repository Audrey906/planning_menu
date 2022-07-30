-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 29 juil. 2022 à 16:26
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `planning_menu`
--

-- --------------------------------------------------------

--
-- Structure de la table `dish`
--

CREATE TABLE `dish` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dish_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `dish`
--

INSERT INTO `dish` (`id`, `category_id`, `user_id`, `dish_name`) VALUES
(1, 1, 1, 'Pate Carbonara'),
(2, 1, 1, 'Pate bolognaise'),
(3, 1, 1, 'Ramen'),
(4, 1, 1, 'Pizza'),
(5, 1, 1, 'Quiche'),
(6, 1, 1, 'Soupe'),
(7, 1, 1, 'Burger'),
(8, 1, 1, 'Salade'),
(9, 1, 1, 'Tartiflette'),
(10, 1, 1, 'Raclette'),
(11, 1, 1, 'Crèpe'),
(12, 1, 1, 'Gratin de pate'),
(13, 1, 1, 'Poisson riz'),
(14, 1, 1, 'Lasagne'),
(15, 1, 1, 'Quenelle'),
(16, 1, 1, 'Croc Monsieur'),
(17, 1, 1, 'Poulet riz moutarde'),
(18, 1, 1, 'Filet mignon à l\'ananas'),
(19, 1, 1, 'Pot au feu'),
(20, 1, 1, 'Poulet riz  à la forestière'),
(21, 1, 1, 'Hachis parmentier'),
(22, 1, 1, 'Steak pate'),
(38, 1, 1, 'Wrap'),
(39, 1, 1, 'Gratin dauphinois'),
(40, 1, 1, 'Poulet Soja-Paprika');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `dish`
--
ALTER TABLE `dish`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_957D8CB812469DE2` (`category_id`),
  ADD KEY `IDX_957D8CB8A76ED395` (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `dish`
--
ALTER TABLE `dish`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `dish`
--
ALTER TABLE `dish`
  ADD CONSTRAINT `FK_957D8CB812469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `FK_957D8CB8A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
