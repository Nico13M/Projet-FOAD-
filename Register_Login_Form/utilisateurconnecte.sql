-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 25 août 2023 à 09:21
-- Version du serveur : 8.0.30
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `foad`
--

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurconnecte`
--

CREATE TABLE `utilisateurconnecte` (
  `id` int NOT NULL,
  `Username` varchar(25) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirmation_token` varchar(60) DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `utilisateurconnecte`
--

INSERT INTO `utilisateurconnecte` (`id`, `Username`, `email`, `password`, `confirmation_token`, `confirmed_at`) VALUES
(1, 'totalidaza', 'julien.thoumy@gmail.com', '$2y$10$f7kKPDYMEbAhogZZ26OWA.NCKT5grXnbphcg.Xh13x6UjQR3rcUuC', 'btFWkWD8XwM1klcQ11j0HiY4jFuHHHTWwP9rR0MsUOPDxzFsZyfPDCANnAUm', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `utilisateurconnecte`
--
ALTER TABLE `utilisateurconnecte`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `utilisateurconnecte`
--
ALTER TABLE `utilisateurconnecte`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
