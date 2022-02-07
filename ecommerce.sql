-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 04 fév. 2022 à 11:35
-- Version du serveur :  8.0.28-0ubuntu0.20.04.3
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecommerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `adress`
--

CREATE TABLE `adress` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `n_voie` int NOT NULL,
  `rue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `complement_adress` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_postale` int NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `credit_card`
--

CREATE TABLE `credit_card` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `card_number` bigint NOT NULL,
  `card_firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220124140541', '2022-01-24 15:06:20', 337),
('DoctrineMigrations\\Version20220201112952', '2022-02-01 12:30:26', 173),
('DoctrineMigrations\\Version20220201133526', '2022-02-01 14:36:05', 83);

-- --------------------------------------------------------

--
-- Structure de la table `opinion`
--

CREATE TABLE `opinion` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `product_id` int NOT NULL,
  `adress_id` int NOT NULL,
  `quantity` int NOT NULL,
  `order_date` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_number` int NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `name_product` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_product` longtext COLLATE utf8mb4_unicode_ci,
  `category_product` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_product` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity_product` int NOT NULL,
  `reduction_product` int DEFAULT NULL,
  `price_10ml` double DEFAULT NULL,
  `price_30ml` double DEFAULT NULL,
  `price_50ml` double DEFAULT NULL,
  `price_100ml` double DEFAULT NULL,
  `price_200ml` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `name_product`, `description_product`, `category_product`, `image_product`, `quantity_product`, `reduction_product`, `price_10ml`, `price_30ml`, `price_50ml`, `price_100ml`, `price_200ml`) VALUES
(1, 'Tea Tree', 'Cette huile essentielle possède de multiples vertus. C\'est un antibactérienne majeure, antivirale, antiparasitaire, énergisante.\r\n\r\nAcné, mycoses, infections cutanées\r\nHygiène bucco-dentaire (aphtes, gingivites)\r\nFatigue psychique\r\nInfections ORL : angines, otites, sinusites...\r\nCirculation veineuse (jambes lourdes, varices), hémorroïdes', 'Huile essentielle', 'teatree', 100, NULL, 2.9, 6.5, NULL, 19.9, NULL),
(2, 'Ravintsara', 'L\'une des huiles essentielles les plus intéressantes en aromathérapie : énergisante puissante, antivirale et stimulant immunitaire.\r\n\r\nFatigues nerveuses, psychiques, insomnies\r\nInfections virales de la peau : zona, herpès labial\r\nBaisse immunitaire, prévention de la grippe\r\nNez bouché et infections ORL : grippes, bronchites, rhinopharyngites,…', 'Huile essentielle', NULL, 100, NULL, 2.8, 5.5, NULL, 15, NULL),
(3, 'Basilic Tropical', 'Revigorante et revitalisante, l\'huile essentielle est un tonique puissant du système nerveux. Elle est aussi digestive, antispasmodique.\r\n\r\nStress, fatigue, dépression, insomnie\r\nFlatulence, indigestion, nausée, gastro\r\nSpasmes, douleurs, crampes du bas ventre\r\nAsthme, bronchite, toux', 'Huile essentielle', NULL, 100, NULL, 2.4, 4.9, NULL, NULL, NULL),
(4, 'Menthe Poivrée', 'Stimule et rafraîchit, cette huile essentielle revigore. Elle est digestive et tonique.\r\n\r\nDigestion, nausées, mal des transports, crise de foie\r\nFatigue générale\r\nSciatique, arthrite, rhumatismes, migraines, maux de tête\r\nDouleurs, démangeaisons, piqûres d\'insecte\r\nNez bouché', 'Huile essentielle', NULL, 100, NULL, 2.9, 6.9, NULL, 16.9, NULL),
(5, 'Laurier Noble', 'Cette huile est connue pour ses propriétés antiseptique, antidouleur et anti-inflammatoire remarquables.\r\n\r\nInfections cutanées : abcès, mycoses, furoncles,…\r\nBronchites, nez bouché, asthme\r\nProblèmes buccaux : aphtes, gingivites, maux de dent, caries\r\nDouleurs musculaires et articulaires, sciatiques\r\nPeaux grasses, pellicules, cheveux gras', 'Huile essentielle', NULL, 100, NULL, 5.5, 12.9, NULL, NULL, NULL),
(6, 'Camomille Romaine\r\n', 'Elle est connue pour être relaxante et faciliter le sommeil. Anti-inflammatoire.\r\n\r\nAnxiété, stress, insomnie\r\nSpasmes, coliques, mal de dent\r\nIrritations de peau : eczéma, psoriasis, acné, dermites, couperose, feu du rasoir\r\nBallonnements, nausées', 'Huile essentielle', NULL, 100, NULL, 18.5, NULL, NULL, NULL, NULL),
(7, 'Thym à Thujanol\r\n', 'Connue comme antibactérienne puissante. Réchauffe et stimule les muscles, tonique veineux.\r\n\r\nInfections gynécologiques, urinaires et cutanées\r\nInsuffisance hépatique, peau terne\r\nCirculation sanguine, crampes et contractures, préparation musculaire\r\nInfections ORL : angine, bronchite, laryngite,... et buccales : aphtes, gingivites,...', 'Huile essentielle', NULL, 100, NULL, 17.5, NULL, NULL, NULL, NULL),
(8, 'Lavande Aspic', 'Cicatrisante, calmante, purifiante, antiseptique, antitoxique puissante.\r\n\r\nCoups de soleil, brûlures, petites plaies\r\nProblèmes de peau : acné, psoriasis, mycoses, pied d\'athlète, escarres,...\r\nMigraines, maux de tête\r\nPiqûres d\'insectes et de méduses', 'Huile essentielle', NULL, 100, NULL, 3.5, 7.5, NULL, NULL, NULL),
(9, 'Citron', 'Tonique du système nerveux, antiseptique générale, régulatrice des métabolismes.\r\n\r\nFatigue générale, lassitude, fatigue immunitaire\r\nFatigues digestive, hépatique, pancréatique, nausées\r\nObésité (sous contrôle médical), cellulite, drainage lymphatique\r\nSoins de la peau (éruptions cutanées, furoncles, verrues, herpès …)', 'Huile essentielle', NULL, 100, NULL, 2.5, 5.5, NULL, 15, NULL),
(10, 'Eucalyptus citronné', 'Réputée comme anti-inflammatoire et antidouleur, bonne alliée pour les articulations.\r\n\r\nRhumatismes, inflammations, arthrose\r\nIrritations de la peau (zona, prurit, démangeaisons)\r\nMouches et moustiques', 'Huile essentielle', NULL, 100, NULL, 2.3, 4.5, 9.5, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `lastname`, `firstname`, `password`) VALUES
(1, 'maude.3@hotmail.fr', 'user', 'Taillard', 'marie', '$2y$10$KgrI9JFAE5FWAs6obnNlvu4keiE3pMyCpQqoW/J/dXCJF7yBPWUt.');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adress`
--
ALTER TABLE `adress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5CECC7BEA76ED395` (`user_id`);

--
-- Index pour la table `credit_card`
--
ALTER TABLE `credit_card`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_11D627EEA76ED395` (`user_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `opinion`
--
ALTER TABLE `opinion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_AB02B027A76ED395` (`user_id`),
  ADD KEY `IDX_AB02B0274584665A` (`product_id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E52FFDEEA76ED395` (`user_id`),
  ADD KEY `IDX_E52FFDEE4584665A` (`product_id`),
  ADD KEY `IDX_E52FFDEE8486F9AC` (`adress_id`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adress`
--
ALTER TABLE `adress`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `credit_card`
--
ALTER TABLE `credit_card`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `opinion`
--
ALTER TABLE `opinion`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adress`
--
ALTER TABLE `adress`
  ADD CONSTRAINT `FK_5CECC7BEA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `credit_card`
--
ALTER TABLE `credit_card`
  ADD CONSTRAINT `FK_11D627EEA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `opinion`
--
ALTER TABLE `opinion`
  ADD CONSTRAINT `FK_AB02B0274584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_AB02B027A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_E52FFDEE4584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_E52FFDEE8486F9AC` FOREIGN KEY (`adress_id`) REFERENCES `adress` (`id`),
  ADD CONSTRAINT `FK_E52FFDEEA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
