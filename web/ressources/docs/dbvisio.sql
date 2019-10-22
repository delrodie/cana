-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  sam. 19 jan. 2019 à 13:11
-- Version du serveur :  10.1.35-MariaDB
-- Version de PHP :  7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dbvisio`
--

-- --------------------------------------------------------

--
-- Structure de la table `assurance`
--

CREATE TABLE `assurance` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `statut` tinyint(1) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `publie_par` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modifie_par` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `publie_le` datetime DEFAULT NULL,
  `modifie_le` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `base`
--

CREATE TABLE `base` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `statut` tinyint(1) DEFAULT NULL,
  `image_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_size` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `slug` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `publie_par` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modifie_par` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `publie_le` datetime DEFAULT NULL,
  `modifie_le` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `assurance_id` int(11) DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenoms` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sexe` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cel` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `statut` tinyint(1) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `publie_par` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modifie_par` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `publie_le` datetime DEFAULT NULL,
  `modifie_le` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ext_log_entries`
--

CREATE TABLE `ext_log_entries` (
  `id` int(11) NOT NULL,
  `action` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `logged_at` datetime NOT NULL,
  `object_id` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `object_class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `version` int(11) NOT NULL,
  `data` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ext_translations`
--

CREATE TABLE `ext_translations` (
  `id` int(11) NOT NULL,
  `locale` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `object_class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `field` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `foreign_key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE `facture` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `monture_id` int(11) DEFAULT NULL,
  `traitement_id` int(11) DEFAULT NULL,
  `typeverre_id` int(11) DEFAULT NULL,
  `numero` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `montantHT` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remise` int(11) DEFAULT NULL,
  `tva` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `montantTTC` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `acompte` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rap` int(11) DEFAULT NULL,
  `partAssurance` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `odSph` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `odCyl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `odAxe` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `odAdd` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `odQte` int(11) DEFAULT NULL,
  `odMontant` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ogSph` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ogCyl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ogAxe` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ogAdd` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ogQte` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ogMontant` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `monturePrix` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `statut` tinyint(1) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `publie_par` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modifie_par` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `publie_le` datetime DEFAULT NULL,
  `modifie_le` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fos_user`
--

CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `login_count` int(11) NOT NULL DEFAULT '0',
  `first_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `login_count`, `first_login`) VALUES
(1, 'delrodie', 'delrodie', 'delrodieamoikon@gmail.com', 'delrodieamoikon@gmail.com', 1, NULL, '$2y$13$9i3o542XXgroceReAGWIiepSofLAfOwqHKRwU8wRBXkeEksjEEG0W', '2019-01-19 12:18:21', NULL, NULL, 'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}', 3, '2019-01-19 11:43:36');

-- --------------------------------------------------------

--
-- Structure de la table `marque`
--

CREATE TABLE `marque` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `statut` tinyint(1) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `publie_par` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modifie_par` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `publie_le` datetime DEFAULT NULL,
  `modifie_le` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `monture`
--

CREATE TABLE `monture` (
  `id` int(11) NOT NULL,
  `marque_id` int(11) DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `montant` int(11) DEFAULT NULL,
  `genre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `statut` tinyint(1) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `publie_par` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modifie_par` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `publie_le` datetime DEFAULT NULL,
  `modifie_le` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `traitement`
--

CREATE TABLE `traitement` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `statut` tinyint(1) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `publie_par` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modifie_par` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `publie_le` datetime DEFAULT NULL,
  `modifie_le` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `traitement`
--

INSERT INTO `traitement` (`id`, `libelle`, `statut`, `slug`, `publie_par`, `modifie_par`, `publie_le`, `modifie_le`) VALUES
(1, 'BLANC', 1, 'blanc', 'delrodie', 'delrodie', '2019-01-19 12:59:49', '2019-01-19 12:59:49'),
(2, 'TEINTE', 1, 'teinte', 'delrodie', 'delrodie', '2019-01-19 13:01:05', '2019-01-19 13:01:05'),
(3, 'TRANSITION', 1, 'transition', 'delrodie', 'delrodie', '2019-01-19 13:01:14', '2019-01-19 13:01:14'),
(4, 'ANTI-REFLET', 1, 'anti-reflet', 'delrodie', 'delrodie', '2019-01-19 13:01:39', '2019-01-19 13:01:39'),
(5, 'TRANSITION ANTI-REFLET', 1, 'transition-anti-reflet', 'delrodie', 'delrodie', '2019-01-19 13:02:06', '2019-01-19 13:02:06'),
(6, 'AMINCI 1er DEGRE', 1, 'aminci-1er-degre', 'delrodie', 'delrodie', '2019-01-19 13:02:35', '2019-01-19 13:02:35'),
(7, 'AMINCI 2e DEGRE', 1, 'aminci-2e-degre', 'delrodie', 'delrodie', '2019-01-19 13:02:51', '2019-01-19 13:02:51'),
(8, 'AMINCI 3e DEGRE', 1, 'aminci-3e-degre', 'delrodie', 'delrodie', '2019-01-19 13:03:02', '2019-01-19 13:03:02');

-- --------------------------------------------------------

--
-- Structure de la table `typeverre`
--

CREATE TABLE `typeverre` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `statut` tinyint(1) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `publie_par` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modifie_par` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `publie_le` datetime DEFAULT NULL,
  `modifie_le` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `typeverre`
--

INSERT INTO `typeverre` (`id`, `libelle`, `statut`, `slug`, `publie_par`, `modifie_par`, `publie_le`, `modifie_le`) VALUES
(1, 'ORGANIQUE PROGRESSIF', 1, 'organique-progressif', 'delrodie', 'delrodie', '2019-01-19 13:03:42', '2019-01-19 13:07:32'),
(2, 'ORGANIQUE DOUBLE FOYER', 1, 'organique-double-foyer', 'delrodie', 'delrodie', '2019-01-19 13:03:50', '2019-01-19 13:08:01'),
(3, 'ORGANIQUE UNIFOCAL', 1, 'organique-unifocal', 'delrodie', 'delrodie', '2019-01-19 13:04:00', '2019-01-19 13:08:21'),
(4, 'MINERAL PROGRESSIF', 1, 'mineral-progressif', 'delrodie', 'delrodie', '2019-01-19 13:04:08', '2019-01-19 13:08:51'),
(5, 'MINERAL DOUBLE FOYER', 1, 'mineral-double-foyer', 'delrodie', 'delrodie', '2019-01-19 13:09:07', '2019-01-19 13:09:07'),
(6, 'MINERAL UNIFOCAL', 1, 'mineral-unifocal', 'delrodie', 'delrodie', '2019-01-19 13:09:22', '2019-01-19 13:09:22'),
(7, 'POLYCARBONATE PROGRESSIF', 1, 'polycarbonate-progressif', 'delrodie', 'delrodie', '2019-01-19 13:09:38', '2019-01-19 13:09:38'),
(8, 'POLYCARBONATE DOUBLE FOYER', 1, 'polycarbonate-double-foyer', 'delrodie', 'delrodie', '2019-01-19 13:09:52', '2019-01-19 13:09:52'),
(9, 'POLYCARBONATE UNIFOCAL', 1, 'polycarbonate-unifocal', 'delrodie', 'delrodie', '2019-01-19 13:10:18', '2019-01-19 13:10:18'),
(10, 'MR8 PROGRESSIF', 1, 'mr8-progressif', 'delrodie', 'delrodie', '2019-01-19 13:10:34', '2019-01-19 13:10:34'),
(11, 'MR8 DOUBLE FOYER', 1, 'mr8-double-foyer', 'delrodie', 'delrodie', '2019-01-19 13:10:44', '2019-01-19 13:10:44'),
(12, 'MR8 UNIFOCAL', 1, 'mr8-unifocal', 'delrodie', 'delrodie', '2019-01-19 13:11:02', '2019-01-19 13:11:02');

-- --------------------------------------------------------

--
-- Structure de la table `versement`
--

CREATE TABLE `versement` (
  `id` int(11) NOT NULL,
  `facture_id` int(11) DEFAULT NULL,
  `montant` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `acompte` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reste` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `statut` tinyint(1) DEFAULT NULL,
  `publie_par` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modifie_par` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `publie_le` datetime DEFAULT NULL,
  `modifie_le` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `assurance`
--
ALTER TABLE `assurance`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `base`
--
ALTER TABLE `base`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C7440455B288C3E3` (`assurance_id`);

--
-- Index pour la table `ext_log_entries`
--
ALTER TABLE `ext_log_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `log_class_lookup_idx` (`object_class`),
  ADD KEY `log_date_lookup_idx` (`logged_at`),
  ADD KEY `log_user_lookup_idx` (`username`),
  ADD KEY `log_version_lookup_idx` (`object_id`,`object_class`,`version`);

--
-- Index pour la table `ext_translations`
--
ALTER TABLE `ext_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lookup_unique_idx` (`locale`,`object_class`,`field`,`foreign_key`),
  ADD KEY `translations_lookup_idx` (`locale`,`object_class`,`foreign_key`);

--
-- Index pour la table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_FE86641019EB6921` (`client_id`),
  ADD KEY `IDX_FE866410D40ADBBC` (`monture_id`),
  ADD KEY `IDX_FE866410DDA344B6` (`traitement_id`),
  ADD KEY `IDX_FE866410DAFAAEC2` (`typeverre_id`);

--
-- Index pour la table `fos_user`
--
ALTER TABLE `fos_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`);

--
-- Index pour la table `marque`
--
ALTER TABLE `marque`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `monture`
--
ALTER TABLE `monture`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3E1B952B4827B9B2` (`marque_id`);

--
-- Index pour la table `traitement`
--
ALTER TABLE `traitement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typeverre`
--
ALTER TABLE `typeverre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `versement`
--
ALTER TABLE `versement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_716E93677F2DEE08` (`facture_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `assurance`
--
ALTER TABLE `assurance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `base`
--
ALTER TABLE `base`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ext_log_entries`
--
ALTER TABLE `ext_log_entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ext_translations`
--
ALTER TABLE `ext_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `facture`
--
ALTER TABLE `facture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fos_user`
--
ALTER TABLE `fos_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `marque`
--
ALTER TABLE `marque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `monture`
--
ALTER TABLE `monture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `traitement`
--
ALTER TABLE `traitement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `typeverre`
--
ALTER TABLE `typeverre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `versement`
--
ALTER TABLE `versement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `FK_C7440455B288C3E3` FOREIGN KEY (`assurance_id`) REFERENCES `assurance` (`id`);

--
-- Contraintes pour la table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `FK_FE86641019EB6921` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `FK_FE866410D40ADBBC` FOREIGN KEY (`monture_id`) REFERENCES `monture` (`id`),
  ADD CONSTRAINT `FK_FE866410DAFAAEC2` FOREIGN KEY (`typeverre_id`) REFERENCES `typeverre` (`id`),
  ADD CONSTRAINT `FK_FE866410DDA344B6` FOREIGN KEY (`traitement_id`) REFERENCES `traitement` (`id`);

--
-- Contraintes pour la table `monture`
--
ALTER TABLE `monture`
  ADD CONSTRAINT `FK_3E1B952B4827B9B2` FOREIGN KEY (`marque_id`) REFERENCES `marque` (`id`);

--
-- Contraintes pour la table `versement`
--
ALTER TABLE `versement`
  ADD CONSTRAINT `FK_716E93677F2DEE08` FOREIGN KEY (`facture_id`) REFERENCES `facture` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
