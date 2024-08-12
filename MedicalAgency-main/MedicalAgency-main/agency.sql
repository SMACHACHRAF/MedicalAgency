-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 22 nov. 2023 à 14:32
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `agency`
--

-- --------------------------------------------------------

--
-- Structure de la table `alcohol_qte`
--

CREATE TABLE `alcohol_qte` (
  `id` int(11) NOT NULL,
  `qte` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `current_disease`
--

CREATE TABLE `current_disease` (
  `id` int(11) NOT NULL,
  `medical_files_id` int(11) DEFAULT NULL,
  `disease_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disease_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `current_treatments`
--

CREATE TABLE `current_treatments` (
  `id` int(11) NOT NULL,
  `medical_files_id` int(11) DEFAULT NULL,
  `treatment_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `housing`
--

CREATE TABLE `housing` (
  `id` int(11) NOT NULL,
  `place` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `housing`
--

INSERT INTO `housing` (`id`, `place`) VALUES
(1, 'Hotel'),
(2, 'Hostel');

-- --------------------------------------------------------

--
-- Structure de la table `medical_city`
--

CREATE TABLE `medical_city` (
  `id` int(11) NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `medical_city`
--

INSERT INTO `medical_city` (`id`, `city`) VALUES
(1, 'Sousse'),
(2, 'Monastir'),
(3, 'Tunis');

-- --------------------------------------------------------

--
-- Structure de la table `medical_files`
--

CREATE TABLE `medical_files` (
  `id` int(11) NOT NULL,
  `qte_smoking_id` int(11) DEFAULT NULL,
  `qtealcohol_id` int(11) DEFAULT NULL,
  `medical_file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upload_at` datetime NOT NULL,
  `weight` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `is_smoking` tinyint(1) NOT NULL,
  `is_alcohloic` tinyint(1) NOT NULL,
  `health_info` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_approved` tinyint(1) NOT NULL,
  `is_rejected` tinyint(1) NOT NULL,
  `email_confirmed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `medical_files`
--

INSERT INTO `medical_files` (`id`, `qte_smoking_id`, `qtealcohol_id`, `medical_file_name`, `upload_at`, `weight`, `size`, `is_smoking`, `is_alcohloic`, `health_info`, `is_approved`, `is_rejected`, `email_confirmed`) VALUES
(7, NULL, NULL, '647bb07eaf3f0624037887.pdf', '2023-06-03 23:28:30', 80, 180, 1, 0, 'i m currently sick', 1, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `patient_informations`
--

CREATE TABLE `patient_informations` (
  `id` int(11) NOT NULL,
  `specialisation_id` int(11) DEFAULT NULL,
  `tourisme_region_id` int(11) DEFAULT NULL,
  `housing_id` int(11) DEFAULT NULL,
  `patient_folder_id` int(11) DEFAULT NULL,
  `patient_doctor_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int(11) DEFAULT NULL,
  `sexe` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `demande` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_approved` tinyint(1) NOT NULL,
  `is_rejected` tinyint(1) NOT NULL,
  `email_comfired` tinyint(1) NOT NULL,
  `report` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `informations_confirmed` tinyint(1) NOT NULL,
  `report_done` tinyint(1) NOT NULL,
  `patient_confirmed` tinyint(1) NOT NULL,
  `patient_not_confirmed` tinyint(1) NOT NULL,
  `invoice_sent` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `patient_informations`
--

INSERT INTO `patient_informations` (`id`, `specialisation_id`, `tourisme_region_id`, `housing_id`, `patient_folder_id`, `patient_doctor_id`, `name`, `age`, `sexe`, `country`, `phone`, `email`, `demande`, `is_approved`, `is_rejected`, `email_comfired`, `report`, `informations_confirmed`, `report_done`, `patient_confirmed`, `patient_not_confirmed`, `invoice_sent`) VALUES
(16, 1, 9, 1, 7, 17, 'Phyras', 25, '', 'TN', 53468100, 'firas.zramda@episousse.com.tn', '\"Docteur, je souhaite parler de mes symptômes allergiques persistants et obtenir une consultation en allergologie.\"\r\n\"J\'ai remarqué que je présente des réactions allergiques fréquentes et je pense qu\'il serait utile de consulter un spécialiste en allergologie pour obtenir un diagnostic précis et un plan de traitement adapté.\"\r\n\"Je pense être allergique à certaines substances, car je présente régulièrement des éruptions cutanées, des démangeaisons et des éternuements. Serait-il possible de me référer à un allergologue pour évaluer mes symptômes plus en détail ?\"', 1, 0, 1, 'Patient : [Nom du patient] Date : [Date de consultation]\r\n\r\nMotif de la consultation : Le patient a consulté pour [symptômes ou motif de consultation].\r\n\r\nDiagnostic : Le diagnostic établi est [diagnostic].\r\n\r\nPlan de traitement : Le plan de traitement recommandé comprend :\r\n\r\n[Médicaments prescrits]\r\n[Recommandations spécifiques]\r\n[Suivi prévu]\r\n\r\nConclusion : Ce rapport médical résume la consultation du patient [nom du patient] et indique le diagnostic établi ainsi que le plan de traitement recommandé. Pour toute question ou information supplémentaire, veuillez me contacter.\r\n\r\n[Signature du médecin] [Nom du médecin] [Titre du médecin] [Coordonnées du médecin]', 1, 1, 1, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `previous_medical_operation`
--

CREATE TABLE `previous_medical_operation` (
  `id` int(11) NOT NULL,
  `medical_files_id` int(11) DEFAULT NULL,
  `medical_operation_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operation_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `smoking_qte`
--

CREATE TABLE `smoking_qte` (
  `id` int(11) NOT NULL,
  `qte` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `specialisation`
--

CREATE TABLE `specialisation` (
  `id` int(11) NOT NULL,
  `spec` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `specialisation`
--

INSERT INTO `specialisation` (`id`, `spec`) VALUES
(1, 'Allergologie'),
(2, 'Addictologie');

-- --------------------------------------------------------

--
-- Structure de la table `tourisme_region`
--

CREATE TABLE `tourisme_region` (
  `id` int(11) NOT NULL,
  `medical_city_id` int(11) DEFAULT NULL,
  `arrival_date` date NOT NULL,
  `estimate_period` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guide` tinyint(1) NOT NULL,
  `car` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tourisme_region`
--

INSERT INTO `tourisme_region` (`id`, `medical_city_id`, `arrival_date`, `estimate_period`, `guide`, `car`) VALUES
(1, 1, '2023-02-19', '7', 1, 0),
(2, 1, '2023-03-03', '21', 1, 1),
(3, 1, '2023-06-14', '7', 1, 1),
(4, 1, '2023-04-07', '14', 1, 1),
(5, 1, '2023-05-06', '7', 1, 1),
(6, 1, '2023-10-11', '30', 1, 1),
(7, 1, '2023-10-15', '14', 1, 1),
(8, 1, '2023-06-30', '14', 1, 0),
(9, 1, '2023-06-30', '14', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `spec_id` int(11) DEFAULT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `spec_id`, `email`, `roles`, `password`, `user_name`) VALUES
(5, 1, 'achref_smach@gmail.com', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$SHlua3JleFJpTFo0SXU4bg$+xYC9UDhqGh7f36ADLZVN1MJtAAdBD2l/xyqbLJ2T1U', 'Achref Smache'),
(17, 1, 'smachephillippo@gmail.com', '[\"ROLE_DOCTOR\"]', '$argon2id$v=19$m=65536,t=4,p=1$azl4Wk1wZnc5TkNvQWFadQ$q5opEASemgrZbI1XU94wRoKg4whHcPFoC8gIcQfg8Rs', 'Phillippo Smach');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `alcohol_qte`
--
ALTER TABLE `alcohol_qte`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `current_disease`
--
ALTER TABLE `current_disease`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A536EF44DF7CB678` (`medical_files_id`);

--
-- Index pour la table `current_treatments`
--
ALTER TABLE `current_treatments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_95F3077FDF7CB678` (`medical_files_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `housing`
--
ALTER TABLE `housing`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `medical_city`
--
ALTER TABLE `medical_city`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `medical_files`
--
ALTER TABLE `medical_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_33D31B098101B95A` (`qte_smoking_id`),
  ADD KEY `IDX_33D31B09DE04DCEA` (`qtealcohol_id`);

--
-- Index pour la table `patient_informations`
--
ALTER TABLE `patient_informations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_89C53BB7B0A76B7D` (`patient_folder_id`),
  ADD KEY `IDX_89C53BB75627D44C` (`specialisation_id`),
  ADD KEY `IDX_89C53BB79FA2126B` (`tourisme_region_id`),
  ADD KEY `IDX_89C53BB7AD5873E3` (`housing_id`),
  ADD KEY `IDX_89C53BB7217F2928` (`patient_doctor_id`);

--
-- Index pour la table `previous_medical_operation`
--
ALTER TABLE `previous_medical_operation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_ED67C1E6DF7CB678` (`medical_files_id`);

--
-- Index pour la table `smoking_qte`
--
ALTER TABLE `smoking_qte`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `specialisation`
--
ALTER TABLE `specialisation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tourisme_region`
--
ALTER TABLE `tourisme_region`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_86EDC08ACDAE8261` (`medical_city_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`),
  ADD KEY `IDX_1483A5E9AA8FA4FB` (`spec_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `alcohol_qte`
--
ALTER TABLE `alcohol_qte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `current_disease`
--
ALTER TABLE `current_disease`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `current_treatments`
--
ALTER TABLE `current_treatments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `housing`
--
ALTER TABLE `housing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `medical_city`
--
ALTER TABLE `medical_city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `medical_files`
--
ALTER TABLE `medical_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `patient_informations`
--
ALTER TABLE `patient_informations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `previous_medical_operation`
--
ALTER TABLE `previous_medical_operation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `smoking_qte`
--
ALTER TABLE `smoking_qte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `specialisation`
--
ALTER TABLE `specialisation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `tourisme_region`
--
ALTER TABLE `tourisme_region`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `current_disease`
--
ALTER TABLE `current_disease`
  ADD CONSTRAINT `FK_A536EF44DF7CB678` FOREIGN KEY (`medical_files_id`) REFERENCES `medical_files` (`id`);

--
-- Contraintes pour la table `current_treatments`
--
ALTER TABLE `current_treatments`
  ADD CONSTRAINT `FK_95F3077FDF7CB678` FOREIGN KEY (`medical_files_id`) REFERENCES `medical_files` (`id`);

--
-- Contraintes pour la table `medical_files`
--
ALTER TABLE `medical_files`
  ADD CONSTRAINT `FK_33D31B098101B95A` FOREIGN KEY (`qte_smoking_id`) REFERENCES `smoking_qte` (`id`),
  ADD CONSTRAINT `FK_33D31B09DE04DCEA` FOREIGN KEY (`qtealcohol_id`) REFERENCES `alcohol_qte` (`id`);

--
-- Contraintes pour la table `patient_informations`
--
ALTER TABLE `patient_informations`
  ADD CONSTRAINT `FK_89C53BB7217F2928` FOREIGN KEY (`patient_doctor_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_89C53BB75627D44C` FOREIGN KEY (`specialisation_id`) REFERENCES `specialisation` (`id`),
  ADD CONSTRAINT `FK_89C53BB79FA2126B` FOREIGN KEY (`tourisme_region_id`) REFERENCES `tourisme_region` (`id`),
  ADD CONSTRAINT `FK_89C53BB7AD5873E3` FOREIGN KEY (`housing_id`) REFERENCES `housing` (`id`),
  ADD CONSTRAINT `FK_89C53BB7B0A76B7D` FOREIGN KEY (`patient_folder_id`) REFERENCES `medical_files` (`id`);

--
-- Contraintes pour la table `previous_medical_operation`
--
ALTER TABLE `previous_medical_operation`
  ADD CONSTRAINT `FK_ED67C1E6DF7CB678` FOREIGN KEY (`medical_files_id`) REFERENCES `medical_files` (`id`);

--
-- Contraintes pour la table `tourisme_region`
--
ALTER TABLE `tourisme_region`
  ADD CONSTRAINT `FK_86EDC08ACDAE8261` FOREIGN KEY (`medical_city_id`) REFERENCES `medical_city` (`id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_1483A5E9AA8FA4FB` FOREIGN KEY (`spec_id`) REFERENCES `specialisation` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
