-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 04 avr. 2025 à 01:34
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projetweb`
--

-- --------------------------------------------------------

--
-- Structure de la table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `internship_id` int(11) NOT NULL,
  `motivation_letter` text NOT NULL,
  `cv_path` varchar(255) NOT NULL,
  `application_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','reviewed','accepted','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `applications`
--

INSERT INTO `applications` (`id`, `user_id`, `internship_id`, `motivation_letter`, `cv_path`, `application_date`, `status`) VALUES
(1, NULL, 23, 'rgregergregezrg', 'uploads/cv/67ee54cc59a86_Dossier_Synthese_Josue-Hemerick_MORIE_CPI A2 Informatique 24-25 Saint-Nazaire_Semestre_3 (45).PDF', '2025-04-03 09:28:44', 'pending'),
(2, NULL, 23, 'gdfgdfgfsdgfdgsdgqrgregergregqr', 'uploads/cv/67ee5554bd78b_CV Hémérick.pdf', '2025-04-03 09:31:00', 'pending'),
(3, NULL, 23, 'qergergqergqregqe', 'uploads/cv/67ee56fb9cc06_CV Hémérick.pdf', '2025-04-03 09:38:03', 'pending'),
(4, 1, 25, 'iouregfjjdqshfkhqshdlfsqdfqdsfdqqfqsdfdsf', 'uploads/cv/67ee5796cc501_CV Hémérick.pdf', '2025-04-03 09:40:38', 'pending'),
(5, 2, 23, 'vvzvzvezvezvze', 'uploads/cv/67ee5903cc604_CV Hémérick.pdf', '2025-04-03 09:46:43', 'pending'),
(6, 24, 23, 'reqregqregergqregqreg', 'uploads/cv/67ee59eb3ae3e_CV Hémérick.pdf', '2025-04-03 09:50:35', 'pending'),
(7, 24, 23, 'rzefzefezfeza', 'uploads/cv/67ee5b05e550f_CV Hémérick.pdf', '2025-04-03 09:55:17', 'pending'),
(8, 24, 23, '\'fEFZfefzf', 'uploads/cv/67ee5cf141708_HEMERICK PFI.pdf', '2025-04-03 10:03:29', 'pending'),
(9, 24, 23, 'dSDSfsdf', 'uploads/cv/67ee5d08ab4fb_HEMERICK PFI.pdf', '2025-04-03 10:03:52', 'pending'),
(10, 24, 23, 'fdjsfgdsqfhdsgjfkdsffdqs', 'uploads/cv/67ee5d77dc5c6_CV Hémérick.pdf', '2025-04-03 10:05:43', 'pending'),
(11, 24, 23, 'fqqeezfzefzfezfezf', 'uploads/cv/67ee5ff7da10a_CV Hémérick.pdf', '2025-04-03 10:16:23', 'pending'),
(12, 2, 6, '=àçàyèdtxcty', 'uploads/cv/67eee34b4800a_CV Hémérick.pdf', '2025-04-03 19:36:43', 'pending'),
(13, 2, 36, 'efzfezf', 'uploads/cv/67ef01e39d632_CV Hémérick.pdf', '2025-04-03 21:47:15', 'pending'),
(14, 2, 37, 'hemericksdfsdf', 'uploads/cv/67ef1671138b4_HEMERICK PFI.pdf', '2025-04-03 23:14:57', 'pending');

-- --------------------------------------------------------

--
-- Structure de la table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `sector` enum('Informatique & Digital','Business & Management','Ingénierie & Innovation') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `companies`
--

INSERT INTO `companies` (`id`, `name`, `description`, `email`, `phone`, `address`, `sector`, `created_at`, `updated_at`) VALUES
(3, 'HEMERICK MORIE', 'je suis la', 'josuehemerick.morie@viacesi.fr', '0621649310', '44600 60 RUE michel ange', 'Ingénierie & Innovation', '2025-04-03 17:22:50', '2025-04-03 17:41:21'),
(5, 'le patriote hemerick', 'hemerick', 'mjh15179389g@gmail.com', '0649190924', '44600 60 RUE michel ange', 'Informatique & Digital', '2025-04-03 17:31:35', '2025-04-03 17:31:35'),
(10, 'BusinessSoft', 'Intégrateur de solutions ERP.', '', NULL, 'Angers', 'Ingénierie & Innovation', '2025-04-03 17:55:12', '2025-04-03 17:55:12'),
(11, 'BuzzMedia', 'Agence de marketing digital performante.', '', NULL, 'Lille', 'Business & Management', '2025-04-03 17:55:12', '2025-04-03 17:55:12'),
(13, 'CloudExperts', 'Prestataire de services cloud.', '', NULL, 'Nancy', 'Ingénierie & Innovation', '2025-04-03 17:55:12', '2025-04-03 17:55:12'),
(14, 'CloudNative', 'Expert en solutions cloud natives.', '', NULL, 'Rennes', 'Informatique & Digital', '2025-04-03 17:55:12', '2025-04-03 17:55:12'),
(15, 'CloudTech', 'CloudTech est un leader des solutions cloud natives.', '', NULL, 'Toulouse', 'Ingénierie & Innovation', '2025-04-03 17:55:12', '2025-04-03 17:55:12'),
(16, 'CodeMasters', 'Editeur de solutions logicielles.', '', NULL, 'Toulon', 'Informatique & Digital', '2025-04-03 17:55:12', '2025-04-03 17:55:12'),
(17, 'ConnectedDevices', 'Pionnier des solutions IoT.', '', NULL, 'Strasbourg', 'Ingénierie & Innovation', '2025-04-03 17:55:12', '2025-04-03 17:55:12'),
(18, 'CreativeMinds', 'Agence de design spécialisée dans l\'expérience utilisateur.', '', NULL, 'Bordeaux', 'Informatique & Digital', '2025-04-03 17:55:12', '2025-04-03 17:55:12'),
(19, 'FinancePlus', 'Cabinet d\'analyse financière réputé.', '', NULL, 'Montpellier', 'Business & Management', '2025-04-03 17:55:12', '2025-04-03 17:55:12'),
(20, 'NetAdmin', 'Société spécialisée en infrastructure IT.', '', NULL, 'Nice', 'Ingénierie & Innovation', '2025-04-03 17:55:12', '2025-04-03 17:55:12'),
(21, 'NetSolutions', 'Société de services réseaux.', '', NULL, 'Montpellier', 'Ingénierie & Innovation', '2025-04-03 17:55:12', '2025-04-03 17:55:12'),
(22, 'ProjetPlus', 'Cabinet conseil en management de projet IT.', '', NULL, 'Strasbourg', 'Business & Management', '2025-04-03 17:55:12', '2025-04-03 17:55:12'),
(23, 'ProjetVision', 'Société de conseil en management.', '', NULL, 'Bordeaux', 'Business & Management', '2025-04-03 17:55:12', '2025-04-03 17:55:12'),
(24, 'QualityCheck', 'Société de qualité logicielle.', '', NULL, 'Nice', 'Informatique & Digital', '2025-04-03 17:55:12', '2025-04-03 17:55:12'),
(25, 'QualitySoft', 'Spécialiste en assurance qualité logicielle.', '', NULL, 'Limoges', 'Informatique & Digital', '2025-04-03 17:55:12', '2025-04-03 17:55:12'),
(26, 'SalesForce', 'Entreprise spécialisée en solutions CRM.', '', NULL, 'Toulon', 'Business & Management', '2025-04-03 17:55:12', '2025-04-03 17:55:12'),
(27, 'SecureNet', 'Expert en solutions de cybersécurité.', '', NULL, 'Marseille', 'Ingénierie & Innovation', '2025-04-03 17:55:12', '2025-04-03 17:55:12'),
(28, 'SkyCompute', 'Prestataire de services cloud.', '', NULL, 'Dijon', 'Ingénierie & Innovation', '2025-04-03 17:55:12', '2025-04-03 17:55:12'),
(29, 'SocialBuzz', 'Agence spécialisée en social media.', '', NULL, 'Grenoble', 'Business & Management', '2025-04-03 17:55:12', '2025-04-03 17:55:12'),
(30, 'SoftDesign', 'Entreprise d\'ingénierie logicielle.', '', NULL, 'Amiens', 'Ingénierie & Innovation', '2025-04-03 17:55:12', '2025-04-03 17:55:12'),
(31, 'TalentPlus', 'Cabinet de conseil en RH innovant.', '', NULL, 'Tours', 'Business & Management', '2025-04-03 17:55:12', '2025-04-03 17:55:12'),
(32, 'TechInfra', 'Société d\'infrastructure cloud.', '', NULL, 'Marseille', 'Ingénierie & Innovation', '2025-04-03 17:55:12', '2025-04-03 17:55:12'),
(33, 'WebCraft', 'Agence de développement web créative.', '', NULL, 'Le Havre', 'Informatique & Digital', '2025-04-03 17:55:12', '2025-04-03 17:55:12'),
(38, 'AIForward', 'Startup pionnière en intelligence artificielle.', NULL, NULL, 'Rennes', 'Informatique & Digital', '2025-04-03 19:58:55', '2025-04-03 19:58:55'),
(39, 'AIInnovation', 'Startup spécialisée en IA.', NULL, NULL, 'Grenoble', 'Ingénierie & Innovation', '2025-04-03 19:58:55', '2025-04-03 19:58:55'),
(40, 'AppFactory', 'Startup spécialisée dans les applications mobiles innovantes.', NULL, NULL, 'Nantes', 'Informatique & Digital', '2025-04-03 19:58:55', '2025-04-03 19:58:55'),
(41, 'azaa', 'hemerick', NULL, NULL, 'abidjan', 'Business & Management', '2025-04-03 19:58:55', '2025-04-03 19:58:55'),
(42, 'BrandBoost', 'Agence de marketing performante.', NULL, NULL, 'Paris', 'Business & Management', '2025-04-03 19:58:55', '2025-04-03 19:58:55'),
(43, 'ChainTech', 'Pionnier des solutions blockchain.', NULL, NULL, 'Clermont-Ferrand', 'Informatique & Digital', '2025-04-03 19:58:55', '2025-04-03 19:58:55'),
(45, 'ez', 'efezfzef', NULL, NULL, 'Paris', 'Business & Management', '2025-04-03 22:42:55', '2025-04-03 22:42:55');

-- --------------------------------------------------------

--
-- Structure de la table `company_ratings`
--

CREATE TABLE `company_ratings` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `rating` decimal(3,1) NOT NULL CHECK (`rating` between 1 and 5),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `company_ratings`
--

INSERT INTO `company_ratings` (`id`, `company_id`, `rating`, `created_at`) VALUES
(3, 38, 5.0, '2025-04-03 23:09:37'),
(4, 40, 1.0, '2025-04-03 23:12:36');

-- --------------------------------------------------------

--
-- Structure de la table `internships`
--

CREATE TABLE `internships` (
  `id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `domaine` enum('Informatique & Digital','Business & Management','Ingénierie & Innovation') DEFAULT NULL,
  `remote` varchar(50) NOT NULL,
  `salary_base` varchar(50) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `short_description` text NOT NULL,
  `full_description` text NOT NULL,
  `competence` varchar(255) DEFAULT NULL,
  `company_description` text DEFAULT NULL,
  `posted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `wishlist_count` int(11) DEFAULT 0,
  `applicants_count` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `internships`
--

INSERT INTO `internships` (`id`, `company_id`, `title`, `company`, `location`, `type`, `domaine`, `remote`, `salary_base`, `start_date`, `end_date`, `short_description`, `full_description`, `competence`, `company_description`, `posted_at`, `wishlist_count`, `applicants_count`) VALUES
(2, NULL, 'Designer UX/UI', 'CreativeMinds', 'Bordeaux', 'Stage', 'Informatique & Digital', 'Hybride', '1000€', '2023-10-01', '2024-03-01', 'Stage en design d\'interface', 'Création de maquettes et prototypes pour applications mobiles.', 'Figma, Adobe XD, UI/UX', 'Agence de design spécialisée dans l\'expérience utilisateur.', '2025-04-01 10:54:48', 0, 0),
(3, NULL, 'Développeur Mobile', 'AppFactory', 'Nantes', 'Stage', 'Informatique & Digital', 'Oui', '1100€', '2023-11-01', '2024-05-01', 'Stage en développement mobile', 'Développement d\'applications iOS et Android.', 'Swift, Kotlin, Flutter', 'Startup spécialisée dans les applications mobiles innovantes.', '2025-04-01 10:54:48', 0, 0),
(4, NULL, 'Data Scientist', 'AIForward', 'Rennes', 'Stage', 'Informatique & Digital', 'Oui', '1400€', '2024-01-01', '2024-06-30', 'Stage en intelligence artificielle', 'Développement de modèles de machine learning.', 'Python, TensorFlow, Data Science', 'Startup pionnière en intelligence artificielle.', '2025-04-01 10:54:48', 0, 0),
(5, NULL, 'Développeur Backend', 'CodeMasters', 'Toulon', 'Stage', 'Informatique & Digital', 'Hybride', '1150€', '2023-07-01', '2023-12-31', 'Stage en développement backend', 'Développement d\'APIs et services backend.', 'Java, Spring, SQL', 'Editeur de solutions logicielles.', '2025-04-01 10:54:48', 0, 0),
(6, NULL, 'Développeur Frontend', 'WebCraft', 'Le Havre', 'Stage', 'Informatique & Digital', 'Oui', '1050€', '2024-01-15', '2024-07-15', 'Stage en développement frontend', 'Création d\'interfaces utilisateur modernes.', 'HTML/CSS, JavaScript, Vue.js', 'Agence de développement web créative.', '2025-04-01 10:54:48', 0, 0),
(7, NULL, 'Expert Blockchain', 'ChainTech', 'Clermont-Ferrand', 'Stage', 'Informatique & Digital', 'Hybride', '2100€', '2023-11-01', '2024-05-01', 'Stage en développement blockchain', 'Développement de solutions blockchain innovantes.', 'Solidity, Smart Contracts', 'Pionnier des solutions blockchain.', '2025-04-01 10:54:48', 0, 0),
(8, NULL, 'Ingénieur QA', 'QualitySoft', 'Limoges', 'Stage', 'Informatique & Digital', 'Hybride', '1250€', '2023-09-01', '2024-02-28', 'Stage en assurance qualité', 'Mise en place de tests automatisés et manuels.', 'Selenium, Tests logiciels', 'Spécialiste en assurance qualité logicielle.', '2025-04-01 10:54:48', 0, 0),
(9, NULL, 'Marketing Digital', 'BuzzMedia', 'Lille', 'Stage', 'Business & Management', 'Non', '1300€', '2023-09-01', '2024-08-31', 'Stage en marketing digital', 'Gestion des réseaux sociaux et campagnes publicitaires.', 'SEO, Google Ads, Social Media', 'Agence de marketing digital performante.', '2025-04-01 10:54:48', 0, 0),
(10, NULL, 'Community Manager', 'SocialBuzz', 'Grenoble', 'Stage', 'Business & Management', 'Oui', '950€', '2023-10-15', '2024-04-15', 'Stage en gestion de communauté', 'Animation des réseaux sociaux et création de contenu.', 'Réseaux sociaux, Création de contenu', 'Agence spécialisée en social media.', '2025-04-01 10:54:48', 0, 0),
(11, NULL, 'Responsable RH', 'TalentPlus', 'Tours', 'Stage', 'Business & Management', 'Non', '1350€', '2023-10-01', '2024-09-30', 'Stage en ressources humaines', 'Gestion du recrutement et développement des talents.', 'Recrutement, GPEC', 'Cabinet de conseil en RH innovant.', '2025-04-01 10:54:48', 0, 0),
(12, NULL, 'Analyste Financier', 'FinancePlus', 'Montpellier', 'Stage', 'Business & Management', 'Non', '1450€', '2023-09-01', '2024-08-31', 'Stage en analyse financière', 'Analyse des données financières et reporting.', 'Excel, Analyse financière', 'Cabinet d\'analyse financière réputé.', '2025-04-01 10:54:48', 0, 0),
(13, NULL, 'Chef de Projet IT', 'ProjetPlus', 'Strasbourg', 'Stage', 'Business & Management', 'Non', '1600€', '2023-10-01', '2024-09-30', 'Stage en gestion de projet', 'Gestion de projets informatiques pour divers clients.', 'Agile, Jira, Gestion de projet', 'Cabinet conseil en management de projet IT.', '2025-04-01 10:54:48', 0, 0),
(14, NULL, 'Ingénieur DevOps', 'CloudTech', 'Toulouse', 'Stage', 'Ingénierie & Innovation', 'Oui', '2000€', '2023-07-15', '2024-01-15', 'Stage en DevOps', 'Mise en place de pipelines CI/CD et gestion infrastructure cloud.', 'Docker, Kubernetes, AWS', 'CloudTech est un leader des solutions cloud natives.', '2025-04-01 10:54:48', 0, 0),
(15, NULL, 'Cybersécurité', 'SecureNet', 'Marseille', 'Stage', 'Ingénierie & Innovation', 'Hybride', '1800€', '2023-08-01', '2024-02-01', 'Stage en sécurité informatique', 'Tests d\'intrusion et sécurisation des systèmes.', 'Pentesting, SIEM, Cryptographie', 'Expert en solutions de cybersécurité.', '2025-04-01 10:54:48', 0, 0),
(16, NULL, 'Ingénieur Cloud', 'SkyCompute', 'Dijon', 'Stage', 'Ingénierie & Innovation', 'Oui', '1900€', '2023-08-15', '2024-02-15', 'Stage en cloud computing', 'Déploiement et gestion d\'infrastructures cloud.', 'AWS, Azure, Terraform', 'Prestataire de services cloud.', '2025-04-01 10:54:48', 0, 0),
(17, NULL, 'Consultant ERP', 'BusinessSoft', 'Angers', 'Stage', 'Ingénierie & Innovation', 'Hybride', '1550€', '2023-09-01', '2024-08-31', 'Stage en implémentation ERP', 'Déploiement de solutions ERP pour les clients.', 'SAP, Dynamics 365', 'Intégrateur de solutions ERP.', '2025-04-01 10:54:48', 0, 0),
(18, NULL, 'Architecte Logiciel', 'SoftDesign', 'Amiens', 'Stage', 'Ingénierie & Innovation', 'Oui', '2200€', '2023-12-01', '2024-06-30', 'Stage en architecture logicielle', 'Conception d\'architectures logicielles robustes.', 'Design Patterns, Microservices', 'Entreprise d\'ingénierie logicielle.', '2025-04-01 10:54:48', 0, 0),
(19, NULL, 'Administrateur Système', 'NetAdmin', 'Nice', 'Stage', 'Ingénierie & Innovation', 'Non', '1700€', '2023-09-15', '2024-03-15', 'Stage en administration système', 'Gestion et maintenance des serveurs et réseaux.', 'Linux, Windows Server, Réseaux', 'Société spécialisée en infrastructure IT.', '2025-04-01 10:54:48', 0, 0),
(23, NULL, 'Assistant Marketing Digital et conception a bon d\'accord', 'BrandBoost', 'Paris', 'Temps plein', 'Business & Management', 'Hybride', '1200', '2024-04-01', '2024-10-01', 'Stage en marketing digital et marketing', 'Gestion des réseaux sociaux et campagnes publicitaires.', 'SEO, Google Ads, Social Media', 'Agence de marketing performante.', '2025-04-01 10:57:42', 0, 0),
(25, NULL, 'Assistant Chef de Projet', 'ProjetVision', 'Bordeaux', 'Stage', 'Business & Management', 'Hybride', '1300€', '2024-03-15', '2024-09-15', 'Stage en gestion de projet', 'Support à la gestion de projets digitaux.', 'Agile, Trello, Gestion de projet', 'Société de conseil en management.', '2025-04-01 10:57:42', 0, 0),
(26, NULL, 'Ingénieur Systèmes', 'TechInfra', 'Marseille', 'Stage', 'Ingénierie & Innovation', 'Non', '1500€', '2024-01-15', '2024-07-15', 'Stage en infrastructure IT', 'Déploiement et maintenance de serveurs.', 'Linux, Virtualisation, Réseaux', 'Société d\'infrastructure cloud.', '2025-04-01 10:57:42', 0, 0),
(27, NULL, 'Ingénieur IA', 'AIInnovation', 'Grenoble', 'Stage', 'Ingénierie & Innovation', 'Oui', '1600€', '2024-02-01', '2024-08-31', 'Stage en intelligence artificielle', 'Développement d\'algorithmes de machine learning.', 'Python, TensorFlow, NLP', 'Startup spécialisée en IA.', '2025-04-01 10:57:42', 0, 0),
(28, NULL, 'Technicien IoT', 'ConnectedDevices', 'Strasbourg', 'Stage', 'Ingénierie & Innovation', 'Hybride', '1400€', '2024-03-01', '2024-09-30', 'Stage en objets connectés', 'Développement de solutions IoT industrielles.', 'Arduino, Raspberry Pi, LoRaWAN', 'Pionnier des solutions IoT.', '2025-04-01 10:57:42', 0, 0),
(29, NULL, 'DevOps Junior', 'CloudNative', 'Rennes', 'Stage', 'Informatique & Digital', 'Oui', '1450€', '2024-01-20', '2024-07-20', 'Stage en DevOps', 'Automatisation des déploiements et monitoring.', 'Docker, Kubernetes, CI/CD', 'Expert en solutions cloud natives.', '2025-04-01 10:57:42', 0, 0),
(30, NULL, 'Testeur Logiciel', 'QualityCheck', 'Nice', 'Stage', 'Informatique & Digital', 'Hybride', '1200€', '2024-02-10', '2024-08-10', 'Stage en assurance qualité', 'Rédaction et exécution de plans de test.', 'Selenium, JIRA, Tests automatisés', 'Société de qualité logicielle.', '2025-04-01 10:57:42', 0, 0),
(31, NULL, 'Assistant Commercial', 'SalesForce', 'Toulon', 'Stage', 'Business & Management', 'Non', '1250€', '2024-03-01', '2024-09-30', 'Stage en force de vente', 'Prospection et support commercial.', 'CRM, Techniques de vente', 'Entreprise spécialisée en solutions CRM.', '2025-04-01 10:57:42', 0, 0),
(32, NULL, 'Ingénieur Réseaux', 'NetSolutions', 'Montpellier', 'Stage', 'Ingénierie & Innovation', 'Non', '1550€', '2024-01-25', '2024-07-25', 'Stage en réseaux informatiques', 'Configuration et sécurisation des réseaux.', 'Cisco, VPN, Sécurité réseau', 'Société de services réseaux.', '2025-04-01 10:57:42', 0, 0),
(33, NULL, 'Technicien Cloud', 'CloudExperts', 'Nancy', 'Stage', 'Ingénierie & Innovation', 'Hybride', '1500€', '2024-02-15', '2024-08-15', 'Stage en solutions cloud', 'Déploiement d\'infrastructures cloud.', 'AWS, Azure, Terraform', 'Prestataire de services cloud.', '2025-04-01 10:57:42', 0, 0),
(36, NULL, 'mojorick', 'azaa', 'abidjan', 'Temps plein', 'Business & Management', 'Hybride', '1002', '2025-04-24', '2025-06-21', 'sqdfsdougvdsbjifpuodsghfjoidspufh', 'oudvghhpqdhigkhbjdoshigfjsdfdsf', 'SEO, Google Ads, Social Media', 'hemerick', '2025-04-03 18:04:47', 0, 0),
(37, NULL, 'efezf', 'ez', 'Paris', 'Temps plein', 'Business & Management', 'Hybride', '100', '2025-04-26', '2025-06-20', 'zfeezfezffffbfbf', 'zefezfezf', 'ez', 'efezfzef', '2025-04-03 22:42:55', 0, 0);

--
-- Déclencheurs `internships`
--
DELIMITER $$
CREATE TRIGGER `sync_company_after_internship_insert` AFTER INSERT ON `internships` FOR EACH ROW BEGIN
    IF NOT EXISTS (SELECT 1 FROM companies WHERE name = NEW.company) THEN
        INSERT INTO companies (name, description, address, sector)
        VALUES (NEW.company, NEW.company_description, NEW.location, NEW.domaine);
    ELSE
        UPDATE companies 
        SET 
            description = NEW.company_description,
            address = NEW.location,
            sector = NEW.domaine,
            updated_at = CURRENT_TIMESTAMP
        WHERE name = NEW.company;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `user_wishlist`
--

CREATE TABLE `user_wishlist` (
  `user_id` int(11) NOT NULL,
  `internship_id` int(11) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reset_token` varchar(255) NOT NULL,
  `date_inscription` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('admin','pilote','etudiant') NOT NULL DEFAULT 'etudiant',
  `profile_photo` varchar(255) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `domaine` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT 'https://bootdey.com/img/Content/avatar/avatar1.png',
  `cv_path` varchar(255) DEFAULT NULL,
  `prenom` varchar(100) NOT NULL,
  `wishlist_count` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `email`, `password`, `reset_token`, `date_inscription`, `role`, `profile_photo`, `adresse`, `domaine`, `photo`, `cv_path`, `prenom`, `wishlist_count`) VALUES
(1, 'hemerick', 'mjh15179389g@gmail.com', '$2y$10$tqdQPu4uBJuDYUEd/FDTD.G2L4kFwzCdLGIi/NWK3daRaRJY6NRGi', '', '2025-03-30 15:00:05', 'etudiant', NULL, 'France, Saint-Nazaire, 44600, 60 RUE michel ange', 'informatique', './uploads/profiles/profile_67ea9e41492c0.png', NULL, 'le patriote', 0),
(2, 'morie_admin', 'josuehemerick.morie@viacesi.fr', '$2y$10$W3uS80lglfKxdp5/0RbdKu0kd9fDsrsOnTG4oodUOKaD0vx0Q2Ldm', '', '2025-03-30 21:10:28', 'admin', NULL, '44600 60 RUE michel ange', 'business', './uploads/profiles/profile_67ed1a970d438.png', NULL, 'le patriote', 0),
(24, 'j', 'jgallet@viacesi.fr', '$2y$10$j65oY/hBym3G665O25lTGeCNAZBIE/TW1Ay1vX4NX/XDvihYr38Ja', '', '2025-04-02 10:26:02', 'pilote', NULL, NULL, NULL, 'https://bootdey.com/img/Content/avatar/avatar1.png', NULL, 'gallet', 0),
(30, 'SAINT-NAZAIRE', 'mojorick.anime@outlook.fr', '$2y$10$fIRcEZVLOxQ8BCevWFmHpe2/81HAP0B/7IQ.m.NRROA79OtwI4Mje', '', '2025-04-03 19:00:44', 'pilote', NULL, NULL, NULL, 'https://bootdey.com/img/Content/avatar/avatar1.png', NULL, 'CESI', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `internship_id` (`internship_id`);

--
-- Index pour la table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `company_ratings`
--
ALTER TABLE `company_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Index pour la table `internships`
--
ALTER TABLE `internships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_company` (`company_id`);

--
-- Index pour la table `user_wishlist`
--
ALTER TABLE `user_wishlist`
  ADD PRIMARY KEY (`user_id`,`internship_id`),
  ADD KEY `internship_id` (`internship_id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pour la table `company_ratings`
--
ALTER TABLE `company_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `internships`
--
ALTER TABLE `internships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `utilisateurs` (`id`),
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`internship_id`) REFERENCES `internships` (`id`);

--
-- Contraintes pour la table `company_ratings`
--
ALTER TABLE `company_ratings`
  ADD CONSTRAINT `company_ratings_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `internships`
--
ALTER TABLE `internships`
  ADD CONSTRAINT `fk_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user_wishlist`
--
ALTER TABLE `user_wishlist`
  ADD CONSTRAINT `user_wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_wishlist_ibfk_2` FOREIGN KEY (`internship_id`) REFERENCES `internships` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
