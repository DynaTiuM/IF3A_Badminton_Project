-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 07 nov. 2021 à 15:46
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `badminton`
--

-- --------------------------------------------------------

--
-- Structure de la table `contenu-equipe`
--

CREATE TABLE `contenu-equipe` (
  `id_equipe` int(11) NOT NULL,
  `email_membre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `contenu-equipe`
--

INSERT INTO `contenu-equipe` (`id_equipe`, `email_membre`) VALUES
(3, 'themichel000@gmail.com'),
(4, 'raphael.perrin@utbm.fr'),
(5, 'email@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `contenu_reservation_users`
--

CREATE TABLE `contenu_reservation_users` (
  `ID_reservation` int(11) NOT NULL,
  `email_membre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `contenu_reservation_users`
--

INSERT INTO `contenu_reservation_users` (`ID_reservation`, `email_membre`) VALUES
(36, 'lynara@gmail.com'),
(36, 'walid.oubraim@utbm.fr'),
(37, 'albertlebg@gmail.com'),
(37, 'email@gmail.com'),
(37, 'raphael.perrin@utbm.fr'),
(37, 'walid.oubraim@utbm.fr');

-- --------------------------------------------------------

--
-- Structure de la table `equipe`
--

CREATE TABLE `equipe` (
  `id_equipe` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `equipe`
--

INSERT INTO `equipe` (`id_equipe`, `Nom`) VALUES
(3, 'Real de Madrid'),
(4, 'Marseille'),
(5, 'Mulhouse');

-- --------------------------------------------------------

--
-- Structure de la table `horaire`
--

CREATE TABLE `horaire` (
  `ID_horaire` int(11) NOT NULL,
  `jour` varchar(8) NOT NULL,
  `debut` varchar(5) NOT NULL,
  `fin` varchar(5) NOT NULL,
  `ID_terrain` int(11) NOT NULL,
  `est_bloque` int(11) NOT NULL,
  `est_disponible` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `horaire`
--

INSERT INTO `horaire` (`ID_horaire`, `jour`, `debut`, `fin`, `ID_terrain`, `est_bloque`, `est_disponible`) VALUES
(133, 'Mercredi', '08:00', '09:00', 4, 0, 1),
(134, 'Mercredi', '09:01', '10:00', 4, 0, 1),
(135, 'Mercredi', '10:01', '11:00', 4, 0, 1),
(136, 'Mercredi', '11:01', '12:00', 4, 0, 1),
(137, 'Mercredi', '12:01', '13:00', 4, 0, 1),
(138, 'Mercredi', '14:00', '15:00', 4, 0, 1),
(139, 'Mercredi', '15:01', '16:00', 4, 1, 1),
(140, 'Mercredi', '16:01', '17:00', 4, 1, 1),
(141, 'Mercredi', '17:01', '18:00', 4, 0, 1),
(142, 'Mercredi', '18:01', '19:00', 4, 0, 1),
(143, 'Mercredi', '20:00', '21:00', 4, 0, 1),
(144, 'Mercredi', '21:01', '22:00', 4, 0, 1),
(145, 'Jeudi', '08:00', '09:00', 4, 0, 1),
(146, 'Jeudi', '09:01', '10:00', 4, 1, 1),
(147, 'Jeudi', '10:01', '11:00', 4, 0, 1),
(148, 'Jeudi', '11:01', '12:00', 4, 0, 1),
(149, 'Jeudi', '12:01', '13:00', 4, 0, 1),
(150, 'Jeudi', '14:00', '15:00', 4, 0, 1),
(151, 'Jeudi', '15:01', '16:00', 4, 0, 1),
(152, 'Jeudi', '16:01', '17:00', 4, 0, 1),
(153, 'Jeudi', '17:01', '18:00', 4, 0, 1),
(154, 'Jeudi', '18:01', '19:00', 4, 0, 1),
(155, 'Jeudi', '20:00', '21:00', 4, 0, 1),
(156, 'Jeudi', '21:01', '22:00', 4, 0, 1),
(157, 'Samedi', '08:00', '09:00', 4, 0, 1),
(158, 'Samedi', '09:01', '10:00', 4, 0, 1),
(159, 'Samedi', '10:01', '11:00', 4, 0, 1),
(160, 'Samedi', '11:01', '12:00', 4, 0, 1),
(161, 'Samedi', '12:01', '13:00', 4, 0, 1),
(162, 'Samedi', '14:00', '15:00', 4, 0, 1),
(163, 'Samedi', '15:01', '16:00', 4, 0, 1),
(164, 'Samedi', '16:01', '17:00', 4, 0, 1),
(165, 'Samedi', '17:01', '18:00', 4, 0, 1),
(166, 'Samedi', '18:01', '19:00', 4, 0, 1),
(167, 'Samedi', '20:00', '21:00', 4, 0, 1),
(168, 'Samedi', '21:01', '22:00', 4, 0, 1),
(217, 'Lundi', '08:00', '09:00', 14, 1, 1),
(218, 'Lundi', '09:01', '10:00', 14, 0, 0),
(219, 'Lundi', '10:01', '11:00', 14, 0, 1),
(220, 'Lundi', '11:01', '12:00', 14, 0, 1),
(221, 'Lundi', '12:01', '13:00', 14, 0, 1),
(222, 'Lundi', '14:00', '15:00', 14, 0, 1),
(223, 'Lundi', '15:01', '16:00', 14, 0, 1),
(224, 'Lundi', '16:01', '17:00', 14, 0, 1),
(225, 'Lundi', '17:01', '18:00', 14, 0, 1),
(226, 'Lundi', '18:01', '19:00', 14, 0, 1),
(227, 'Lundi', '20:00', '21:00', 14, 0, 1),
(228, 'Lundi', '21:01', '22:00', 14, 0, 1),
(229, 'Mardi', '08:00', '09:00', 14, 0, 1),
(230, 'Mardi', '09:01', '10:00', 14, 0, 1),
(231, 'Mardi', '10:01', '11:00', 14, 0, 1),
(232, 'Mardi', '11:01', '12:00', 14, 0, 1),
(233, 'Mardi', '12:01', '13:00', 14, 0, 1),
(234, 'Mardi', '14:00', '15:00', 14, 0, 1),
(235, 'Mardi', '15:01', '16:00', 14, 0, 1),
(236, 'Mardi', '16:01', '17:00', 14, 0, 1),
(237, 'Mardi', '17:01', '18:00', 14, 0, 1),
(238, 'Mardi', '18:01', '19:00', 14, 0, 1),
(239, 'Mardi', '20:00', '21:00', 14, 0, 1),
(240, 'Mardi', '21:01', '22:00', 14, 0, 1),
(241, 'Mercredi', '08:00', '09:00', 14, 0, 1),
(242, 'Mercredi', '09:01', '10:00', 14, 0, 1),
(243, 'Mercredi', '10:01', '11:00', 14, 0, 1),
(244, 'Mercredi', '11:01', '12:00', 14, 0, 1),
(245, 'Mercredi', '12:01', '13:00', 14, 0, 1),
(246, 'Mercredi', '14:00', '15:00', 14, 0, 1),
(247, 'Mercredi', '15:01', '16:00', 14, 0, 1),
(248, 'Mercredi', '16:01', '17:00', 14, 0, 1),
(249, 'Mercredi', '17:01', '18:00', 14, 0, 1),
(250, 'Mercredi', '18:01', '19:00', 14, 0, 1),
(251, 'Mercredi', '20:00', '21:00', 14, 0, 1),
(252, 'Mercredi', '21:01', '22:00', 14, 1, 0),
(253, 'Vendredi', '08:00', '09:00', 14, 0, 1),
(254, 'Vendredi', '09:01', '10:00', 14, 0, 1),
(255, 'Vendredi', '10:01', '11:00', 14, 1, 0),
(256, 'Vendredi', '11:01', '12:00', 14, 0, 1),
(257, 'Vendredi', '12:01', '13:00', 14, 0, 1),
(258, 'Vendredi', '14:00', '15:00', 14, 0, 1),
(259, 'Vendredi', '15:01', '16:00', 14, 0, 1),
(260, 'Vendredi', '16:01', '17:00', 14, 0, 1),
(261, 'Vendredi', '17:01', '18:00', 14, 0, 1),
(262, 'Vendredi', '18:01', '19:00', 14, 0, 1),
(263, 'Vendredi', '20:00', '21:00', 14, 0, 1),
(264, 'Vendredi', '21:01', '22:00', 14, 0, 1),
(265, 'Lundi', '08:00', '09:00', 15, 1, 1),
(266, 'Lundi', '09:01', '10:00', 15, 0, 0),
(267, 'Lundi', '10:01', '11:00', 15, 0, 1),
(268, 'Lundi', '11:01', '12:00', 15, 0, 1),
(269, 'Lundi', '12:01', '13:00', 15, 0, 1),
(270, 'Lundi', '14:00', '15:00', 15, 0, 1),
(271, 'Lundi', '15:01', '16:00', 15, 0, 1),
(272, 'Lundi', '16:01', '17:00', 15, 0, 1),
(273, 'Lundi', '17:01', '18:00', 15, 0, 1),
(274, 'Lundi', '18:01', '19:00', 15, 0, 1),
(275, 'Lundi', '20:00', '21:00', 15, 0, 1),
(276, 'Lundi', '21:01', '22:00', 15, 0, 1),
(277, 'Mardi', '08:00', '09:00', 15, 0, 1),
(278, 'Mardi', '09:01', '10:00', 15, 0, 1),
(279, 'Mardi', '10:01', '11:00', 15, 0, 1),
(280, 'Mardi', '11:01', '12:00', 15, 0, 1),
(281, 'Mardi', '12:01', '13:00', 15, 0, 1),
(282, 'Mardi', '14:00', '15:00', 15, 0, 1),
(283, 'Mardi', '15:01', '16:00', 15, 0, 1),
(284, 'Mardi', '16:01', '17:00', 15, 0, 1),
(285, 'Mardi', '17:01', '18:00', 15, 0, 1),
(286, 'Mardi', '18:01', '19:00', 15, 0, 1),
(287, 'Mardi', '20:00', '21:00', 15, 0, 1),
(288, 'Mardi', '21:01', '22:00', 15, 0, 1),
(289, 'Mercredi', '08:00', '09:00', 15, 0, 1),
(290, 'Mercredi', '09:01', '10:00', 15, 0, 1),
(291, 'Mercredi', '10:01', '11:00', 15, 0, 1),
(292, 'Mercredi', '11:01', '12:00', 15, 0, 1),
(293, 'Mercredi', '12:01', '13:00', 15, 0, 1),
(294, 'Mercredi', '14:00', '15:00', 15, 0, 1),
(295, 'Mercredi', '15:01', '16:00', 15, 0, 1),
(296, 'Mercredi', '16:01', '17:00', 15, 0, 1),
(297, 'Mercredi', '17:01', '18:00', 15, 0, 1),
(298, 'Mercredi', '18:01', '19:00', 15, 0, 1),
(299, 'Mercredi', '20:00', '21:00', 15, 0, 1),
(300, 'Mercredi', '21:01', '22:00', 15, 0, 1),
(301, 'Vendredi', '08:00', '09:00', 15, 0, 1),
(302, 'Vendredi', '09:01', '10:00', 15, 0, 1),
(303, 'Vendredi', '10:01', '11:00', 15, 0, 1),
(304, 'Vendredi', '11:01', '12:00', 15, 0, 1),
(305, 'Vendredi', '12:01', '13:00', 15, 0, 1),
(306, 'Vendredi', '14:00', '15:00', 15, 0, 1),
(307, 'Vendredi', '15:01', '16:00', 15, 0, 1),
(308, 'Vendredi', '16:01', '17:00', 15, 0, 1),
(309, 'Vendredi', '17:01', '18:00', 15, 0, 1),
(310, 'Vendredi', '18:01', '19:00', 15, 0, 1),
(311, 'Vendredi', '20:00', '21:00', 15, 0, 1),
(312, 'Vendredi', '21:01', '22:00', 15, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `inventaire`
--

CREATE TABLE `inventaire` (
  `ID_terrain` int(11) NOT NULL,
  `ID_Objet` int(11) NOT NULL,
  `quantite` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `inventaire`
--

INSERT INTO `inventaire` (`ID_terrain`, `ID_Objet`, `quantite`) VALUES
(4, 1, 119),
(4, 3, 16),
(4, 6, 22),
(15, 1, 20),
(15, 2, 24),
(15, 3, 24),
(15, 4, 2),
(15, 6, 14);

-- --------------------------------------------------------

--
-- Structure de la table `match`
--

CREATE TABLE `match` (
  `id_match` int(11) NOT NULL,
  `id_equipe1` int(11) NOT NULL,
  `score1` int(11) NOT NULL,
  `id_equipe2` int(11) NOT NULL,
  `score2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `match`
--

INSERT INTO `match` (`id_match`, `id_equipe1`, `score1`, `id_equipe2`, `score2`) VALUES
(26, 4, 5, 5, 3),
(27, 3, 5, 4, 5),
(28, 4, 5, 5, 4),
(29, 5, 4, 4, 5),
(30, 5, 5, 3, 2),
(31, 3, 2, 5, 5),
(32, 3, 5, 4, 2),
(33, 4, 3, 3, 5),
(34, 3, 5, 5, 2);

-- --------------------------------------------------------

--
-- Structure de la table `objet`
--

CREATE TABLE `objet` (
  `ID_objet` int(11) NOT NULL,
  `Nom` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `objet`
--

INSERT INTO `objet` (`ID_objet`, `Nom`) VALUES
(1, 'Volant'),
(2, 'Raquette'),
(3, 'Plot'),
(4, 'Filet'),
(5, 'Maillot Rouge Enfant'),
(6, 'Maillot Bleu Enfant');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `ID_reservation` int(11) NOT NULL,
  `ID_terrain` int(11) NOT NULL,
  `ID_horaire` int(11) NOT NULL,
  `est_en_double` tinyint(1) NOT NULL,
  `email_reservant` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`ID_reservation`, `ID_terrain`, `ID_horaire`, `est_en_double`, `email_reservant`) VALUES
(36, 14, 255, 1, 'lynara@gmail.com'),
(37, 14, 252, 1, 'albertlebg@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `terrain`
--

CREATE TABLE `terrain` (
  `ID` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `est_a_l-interieur` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `terrain`
--

INSERT INTO `terrain` (`ID`, `nom`, `adresse`, `est_a_l-interieur`) VALUES
(4, 'Terrain de Badminton de Sevenans', '12 Rue De Delle, 68720 Sevenans', 1),
(14, 'Terrain Badminton', '12 Rue de Maman, Papaville', 1),
(15, 'terrain', '56 rue du baryum, Mendéléville', 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `email` varchar(255) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `date_de_naissance` date NOT NULL,
  `num_telephone` varchar(10) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `est_administrateur` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`email`, `nom`, `prenom`, `date_de_naissance`, `num_telephone`, `adresse`, `mot_de_passe`, `est_administrateur`) VALUES
('albertlebg@gmail.com', 'KIMENAU', 'HHHHHHHH', '8888-08-08', '0755555555', '11 Rue Du Chene', '5f4dcc3b5aa765d61d8327deb882cf99', 0),
('email@gmail.com', 'KIMENAU', 'Jacques', '1988-03-15', '6545146546', '11 Rue Du Chene', '5f4dcc3b5aa765d61d8327deb882cf99', 0),
('jkimenau123@gmail.com', 'KIMENAU', 'Jérémie', '2003-03-15', '0707070707', 'Rue de Leupe, 90400 Sevenans', '5f4dcc3b5aa765d61d8327deb882cf99', 1),
('lynara@gmail.com', 'KIMENAU', 'Valentine', '2007-10-28', '0798654212', '11 Rue Du Chene', '5f4dcc3b5aa765d61d8327deb882cf99', 0),
('raphael.perrin@utbm.fr', 'PERRIN', 'Raphael', '2002-06-19', '0303030303', '8 Rue De Delle, 90400 Sevenans', '5f4dcc3b5aa765d61d8327deb882cf99', 0),
('themichel000@gmail.com', 'KIMENAU', 'Nicolas', '2001-02-02', '0769396354', '11 Rue Du Chene', 'b4a7579156e664d6b335643f05fc6b94', 0),
('walid.oubraim@utbm.fr', 'OUBRAIM', 'Walid', '2002-09-22', '0606060606', '12 Rue de Leupe, 90400 Sevenans', '891d5efae0da28fb4d98185fc53481c4', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `contenu-equipe`
--
ALTER TABLE `contenu-equipe`
  ADD PRIMARY KEY (`id_equipe`,`email_membre`),
  ADD KEY `id_equipe` (`id_equipe`),
  ADD KEY `email_membre` (`email_membre`);

--
-- Index pour la table `contenu_reservation_users`
--
ALTER TABLE `contenu_reservation_users`
  ADD PRIMARY KEY (`ID_reservation`,`email_membre`),
  ADD KEY `id_terrain` (`ID_reservation`,`email_membre`),
  ADD KEY `email_membre` (`email_membre`);

--
-- Index pour la table `equipe`
--
ALTER TABLE `equipe`
  ADD PRIMARY KEY (`id_equipe`,`Nom`);

--
-- Index pour la table `horaire`
--
ALTER TABLE `horaire`
  ADD PRIMARY KEY (`ID_horaire`),
  ADD KEY `ID_terrain` (`ID_terrain`);

--
-- Index pour la table `inventaire`
--
ALTER TABLE `inventaire`
  ADD PRIMARY KEY (`ID_terrain`,`ID_Objet`),
  ADD KEY `ID_terrain` (`ID_terrain`),
  ADD KEY `ID_Objet` (`ID_Objet`);

--
-- Index pour la table `match`
--
ALTER TABLE `match`
  ADD PRIMARY KEY (`id_match`),
  ADD KEY `id_equipe1` (`id_equipe1`,`id_equipe2`);

--
-- Index pour la table `objet`
--
ALTER TABLE `objet`
  ADD PRIMARY KEY (`ID_objet`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`ID_reservation`),
  ADD KEY `email-reservant` (`email_reservant`),
  ADD KEY `ID_terrain` (`ID_terrain`),
  ADD KEY `ID_horaire` (`ID_horaire`);

--
-- Index pour la table `terrain`
--
ALTER TABLE `terrain`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `equipe`
--
ALTER TABLE `equipe`
  MODIFY `id_equipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `horaire`
--
ALTER TABLE `horaire`
  MODIFY `ID_horaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=313;

--
-- AUTO_INCREMENT pour la table `match`
--
ALTER TABLE `match`
  MODIFY `id_match` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `objet`
--
ALTER TABLE `objet`
  MODIFY `ID_objet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `ID_reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT pour la table `terrain`
--
ALTER TABLE `terrain`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `contenu-equipe`
--
ALTER TABLE `contenu-equipe`
  ADD CONSTRAINT `contenu-equipe_ibfk_1` FOREIGN KEY (`id_equipe`) REFERENCES `equipe` (`id_equipe`) ON DELETE CASCADE,
  ADD CONSTRAINT `contenu-equipe_ibfk_2` FOREIGN KEY (`email_membre`) REFERENCES `utilisateur` (`email`) ON DELETE CASCADE;

--
-- Contraintes pour la table `contenu_reservation_users`
--
ALTER TABLE `contenu_reservation_users`
  ADD CONSTRAINT `contenu_reservation_users_ibfk_1` FOREIGN KEY (`ID_reservation`) REFERENCES `reservation` (`ID_reservation`) ON DELETE CASCADE,
  ADD CONSTRAINT `contenu_reservation_users_ibfk_2` FOREIGN KEY (`email_membre`) REFERENCES `utilisateur` (`email`) ON DELETE CASCADE;

--
-- Contraintes pour la table `horaire`
--
ALTER TABLE `horaire`
  ADD CONSTRAINT `horaire_ibfk_1` FOREIGN KEY (`ID_terrain`) REFERENCES `terrain` (`ID`) ON DELETE CASCADE;

--
-- Contraintes pour la table `inventaire`
--
ALTER TABLE `inventaire`
  ADD CONSTRAINT `inventaire_ibfk_1` FOREIGN KEY (`ID_terrain`) REFERENCES `terrain` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `inventaire_ibfk_2` FOREIGN KEY (`ID_Objet`) REFERENCES `objet` (`ID_objet`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`ID_terrain`) REFERENCES `terrain` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`email_reservant`) REFERENCES `utilisateur` (`email`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_4` FOREIGN KEY (`ID_horaire`) REFERENCES `horaire` (`ID_horaire`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
