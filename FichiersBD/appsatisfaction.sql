-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 18 Septembre 2023 à 17:34
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `appsatisfaction`
--

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

CREATE TABLE `departement` (
  `id` int(11) NOT NULL,
  `code` varchar(11) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `nom` varchar(75) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `departement`
--

INSERT INTO `departement` (`id`, `code`, `nom`) VALUES
(1, '101', 'Biologie'),
(2, '109', 'Éducation Phyisique'),
(3, '201', 'Mathématiques'),
(4, '202', 'Chimie'),
(5, '203', 'Physique'),
(6, '320', 'Géo. Histoire et Sciences politiques'),
(7, '340', 'Philosophie'),
(8, '350', 'Psychologie'),
(9, '380', ' Sciences Sociales'),
(10, '510', 'Arts Visuels'),
(11, '551', 'Musique'),
(12, '601', 'Littérature et communication'),
(13, '604', 'Langue'),
(14, '111.A0', 'Techniques d\'hygiène dentaire'),
(15, '120.A0', 'Techniques de diététique'),
(16, '180.A0', 'Techniques  de soins infirmiers'),
(17, '221.A0', 'Technologie de l\'architecture'),
(18, '221.B0', 'Technologie du génie civil'),
(19, '221.C0', 'Technologie de la mécanique du bâtiment'),
(20, '241.A0', 'Techniques de génie mécanique'),
(21, '241.D0', 'Technologie de la mécanique industrielle'),
(22, '243.00', 'Technologie du génie électrique'),
(23, '270.00', 'Technologie du génie méttalurgique'),
(24, '310.A0', 'Techniques  Policières'),
(25, '322.A1', 'Techniques  d\'éducation à l\'enfance'),
(26, '388.A0', 'Techniques de travail social'),
(27, '393.A0', 'Techniques de la documentation'),
(28, '410.00', 'Techniques administratives'),
(29, '420.B0', 'Techniques de l\'informatique'),
(30, '570.E0', 'Techniques de design d\'intérieur'),
(31, '081.06', 'Tremplin - DEC'),
(32, '200.B0', 'Sciences de la nature'),
(33, '200.C0', 'Sciences informatiques et mathématiques'),
(34, '235.B0', 'Technologie du génie industriel'),
(35, '300.00', 'Sciences humaines'),
(36, '500.AH', 'ALC - Littérature, arts et cinéma'),
(37, '500.AK', 'ALC - Théâtre'),
(38, '500.AL', 'ALC - Langues'),
(39, '700.A0', 'Sciences, lettres et arts'),
(40, '700.B0', 'Histoire et civilisation');

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE `evenement` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf16_bin NOT NULL,
  `description` varchar(255) COLLATE utf16_bin NOT NULL,
  `date` date NOT NULL,
  `lieu` varchar(50) COLLATE utf16_bin NOT NULL,
  `etat` varchar(50) COLLATE utf16_bin NOT NULL,
  `Good` int(11) NOT NULL,
  `Ok` int(11) NOT NULL,
  `Bad` int(11) NOT NULL,
  `GoodAdmin` int(11) NOT NULL,
  `OkAdmin` int(11) NOT NULL,
  `BadAdmin` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Contenu de la table `evenement`
--

INSERT INTO `evenement` (`id`, `nom`, `description`, `date`, `lieu`, `etat`, `Good`, `Ok`, `Bad`, `GoodAdmin`, `OkAdmin`, `BadAdmin`, `id_user`) VALUES
(1, 'Party d\'intégration 2023', 'Le party de la technique informatique 420.B0 et de science informatique', '2023-10-04', 'Randolph', 'A venir', 0, 0, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `evenement_dept`
--

CREATE TABLE `evenement_dept` (
  `id_Evenement` int(11) NOT NULL,
  `id_Departement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Contenu de la table `evenement_dept`
--

INSERT INTO `evenement_dept` (`id_Evenement`, `id_Departement`) VALUES
(1, 29),
(1, 33);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(2000) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `email` varchar(75) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`) VALUES
(1, 'root', 'dc76e9f0c0006e8f919e0c515c66dbba3982f785', 'root@gmail.com'),
(2, 'shany', '536b7eca17b99da93485ae5046bfc9ef2e470f14', 'shany.carle@cegeptr.qc.ca');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`);

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_user_2` (`id_user`);

--
-- Index pour la table `evenement_dept`
--
ALTER TABLE `evenement_dept`
  ADD PRIMARY KEY (`id_Evenement`,`id_Departement`),
  ADD KEY `fk_id_departement` (`id_Departement`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `departement`
--
ALTER TABLE `departement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `fk_id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `evenement_dept`
--
ALTER TABLE `evenement_dept`
  ADD CONSTRAINT `fk_id_departement` FOREIGN KEY (`id_Departement`) REFERENCES `departement` (`id`),
  ADD CONSTRAINT `fk_id_evenement` FOREIGN KEY (`id_Evenement`) REFERENCES `evenement` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
