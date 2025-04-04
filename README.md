<center>
  <h1>
    Site de recherche de stages
  </h1>
</center>

Site web de recherche de stages permettant de poster, gérer et postuler à des offres pour des étudiants, tuteurs et entreprises.

---

# Sommaire

- [Contexte](#contexte)
- [Conception](#conception)
  - [Base de données](#base-de-données)
    - [Dictionnaire de données](#dictionnaire-de-données)
    - [MCD](#mcd)
    - [MLD](#mld)
  - [Mock-up](#mock-up)
    - [Page d'accueil](#page-daccueil)
      - [Invité](#invité)
      - [Administrateur](#administrateur)
      - [Pilote](#pilote)
      - [Étudiant](#étudiant)
    - [Page de connexion](#page-de-connexion)
    - [Page d'enregistrement](#page-denregistrement)
    - [Page de recherche](#page-de-recherche)
      - [Invité](#invité-1)
      - [Pilote](#pilote-1)
      - [Étudiant](#étudiant-1)
    - [Page d'une entreprise](#page-dune-entreprise)
      - [Invité](#invité-2)
      - [Pilote](#pilote-2)
      - [Étudiant](#étudiant-2)
    - [Page d'une offre](#page-dune-offre)
      - [Invité](#invité-3)
      - [Administrateur](#administrateur-1)
      - [Pilote](#pilote-3)
      - [Étudiant](#étudiant-3)
    - [Page d'utilisateur](#page-dutilisateur)
      - [Page d'élève](#page-délève)
      - [Page de pilote](#page-de-pilote)
    - [Page d'administration](#page-dadministration)
      - [Utilisateurs](#utilisateurs)
      - [Entreprises](#entreprises)
- [Résultats](#résultats)

---

# Contexte

Aujourd’hui les étudiants effectuent leur recherche de stage sur des sites comme LinkedIn ou Indeed. Afin de rendre cette dernière étape de recherche de stage plus facile et pratique, Nous sommes chargés de concevoir un site et une application qui permettra de stockée les données d’une entreprise qui a déjà pris un stagiaire et de faciliter les recherches avec différentes fonctionnalités.

# Conception

## Base de données

### Dictionnaire de données

Ce dictionnaire de données sert de guide pour comprendre la structure et les relations entre les différents éléments de la base de données du site web.
Il décrit chaque information(champ), son format (type de données), sa taille, ses contraintes, sa signification et la table auxquelles elle appartient.

===Base de données projetweb

== Structure de la table applications

|------
|Colonne|Type|Null|Valeur par défaut
|------
|//**id**//|int(11)|Non|
|user_id|int(11)|Oui|NULL
|internship_id|int(11)|Non|
|motivation_letter|text|Non|
|cv_path|varchar(255)|Non|
|application_date|timestamp|Non|current_timestamp()
|status|enum('pending', 'reviewed', 'accepted', 'rejected')|Oui|pending
== Déchargement des données de la table applications

|1|NULL|23|rgregergregezrg|uploads/cv/67ee54cc59a86_Dossier_Synthese_Josue-Hemerick_MORIE_CPI A2 Informatique 24-25 Saint-Nazaire_Semestre_3 (45).PDF|2025-04-03 11:28:44|pending
|2|NULL|23|gdfgdfgfsdgfdgsdgqrgregergregqr|uploads/cv/67ee5554bd78b_CV Hémérick.pdf|2025-04-03 11:31:00|pending
|3|NULL|23|qergergqergqregqe|uploads/cv/67ee56fb9cc06_CV Hémérick.pdf|2025-04-03 11:38:03|pending
|5|2|23|vvzvzvezvezvze|uploads/cv/67ee5903cc604_CV Hémérick.pdf|2025-04-03 11:46:43|pending
|6|24|23|reqregqregergqregqreg|uploads/cv/67ee59eb3ae3e_CV Hémérick.pdf|2025-04-03 11:50:35|pending
|7|24|23|rzefzefezfeza|uploads/cv/67ee5b05e550f_CV Hémérick.pdf|2025-04-03 11:55:17|pending
|8|24|23|'fEFZfefzf|uploads/cv/67ee5cf141708_HEMERICK PFI.pdf|2025-04-03 12:03:29|pending
|9|24|23|dSDSfsdf|uploads/cv/67ee5d08ab4fb_HEMERICK PFI.pdf|2025-04-03 12:03:52|pending
|10|24|23|fdjsfgdsqfhdsgjfkdsffdqs|uploads/cv/67ee5d77dc5c6_CV Hémérick.pdf|2025-04-03 12:05:43|pending
|11|24|23|fqqeezfzefzfezfezf|uploads/cv/67ee5ff7da10a_CV Hémérick.pdf|2025-04-03 12:16:23|pending
|12|2|6|=àçàyèdtxcty|uploads/cv/67eee34b4800a_CV Hémérick.pdf|2025-04-03 21:36:43|pending
|13|2|36|efzfezf|uploads/cv/67ef01e39d632_CV Hémérick.pdf|2025-04-03 23:47:15|pending
|14|2|37|hemericksdfsdf|uploads/cv/67ef1671138b4_HEMERICK PFI.pdf|2025-04-04 01:14:57|pending
|15|2|37|azfazfza|uploads/cv/67efa2408c253_anglais.pdf|2025-04-04 11:11:28|pending
|17|2|37|rgrcfdefgtfredwzsdxecfrvgcrwzsszdfrgtvredwaq|uploads/cv/67efbd1870639_CER 3.pdf|2025-04-04 13:06:00|pending
|18|41|23|ldshgfeuhlqdfs|uploads/cv/67efdcd12e1fd_rattrapage livrable 1 systeme embarque.pdf|2025-04-04 15:21:21|pending
== Structure de la table companies

|------
|Colonne|Type|Null|Valeur par défaut
|------
|//**id**//|int(11)|Non|
|name|varchar(255)|Non|
|description|text|Oui|NULL
|email|varchar(255)|Oui|NULL
|phone|varchar(20)|Oui|NULL
|address|varchar(255)|Oui|NULL
|sector|enum('Informatique &amp; Digital', 'Business &amp; Management', 'Ingénierie &amp; Innovation')|Non|
|created_at|timestamp|Non|current_timestamp()
|updated_at|timestamp|Non|current_timestamp()
== Déchargement des données de la table companies

|3|HEMERICK MORIE|je suis la|josuehemerick.morie@viacesi.fr|0621649310|44600 60 RUE michel ange|Ingénierie &amp; Innovation|2025-04-03 19:22:50|2025-04-03 19:41:21
|5|le patriote hemerick|hemerick|mjh15179389g@gmail.com|0649190924|44600 60 RUE michel ange|Informatique &amp; Digital|2025-04-03 19:31:35|2025-04-03 19:31:35
|10|BusinessSoft|Intégrateur de solutions ERP.| |NULL|Angers|Ingénierie &amp; Innovation|2025-04-03 19:55:12|2025-04-03 19:55:12
|11|BuzzMedia|Agence de marketing digital performante.| |NULL|Lille|Business &amp; Management|2025-04-03 19:55:12|2025-04-03 19:55:12
|13|CloudExperts|Prestataire de services cloud.| |NULL|Nancy|Ingénierie &amp; Innovation|2025-04-03 19:55:12|2025-04-03 19:55:12
|14|CloudNative|Expert en solutions cloud natives.| |NULL|Rennes|Informatique &amp; Digital|2025-04-03 19:55:12|2025-04-03 19:55:12
|15|CloudTech|CloudTech est un leader des solutions cloud natives.| |NULL|Toulouse|Ingénierie &amp; Innovation|2025-04-03 19:55:12|2025-04-03 19:55:12
|16|CodeMasters|Editeur de solutions logicielles.| |NULL|Toulon|Informatique &amp; Digital|2025-04-03 19:55:12|2025-04-03 19:55:12
|17|ConnectedDevices|Pionnier des solutions IoT.| |NULL|Strasbourg|Ingénierie &amp; Innovation|2025-04-03 19:55:12|2025-04-03 19:55:12
|18|CreativeMinds|Agence de design spécialisée dans l'expérience utilisateur.| |NULL|Bordeaux|Informatique &amp; Digital|2025-04-03 19:55:12|2025-04-03 19:55:12
|19|FinancePlus|Cabinet d'analyse financière réputé.| |NULL|Montpellier|Business &amp; Management|2025-04-03 19:55:12|2025-04-03 19:55:12
|20|NetAdmin|Société spécialisée en infrastructure IT.| |NULL|Nice|Ingénierie &amp; Innovation|2025-04-03 19:55:12|2025-04-03 19:55:12
|21|NetSolutions|Société de services réseaux.| |NULL|Montpellier|Ingénierie &amp; Innovation|2025-04-03 19:55:12|2025-04-03 19:55:12
|22|ProjetPlus|Cabinet conseil en management de projet IT.| |NULL|Strasbourg|Business &amp; Management|2025-04-03 19:55:12|2025-04-03 19:55:12
|23|ProjetVision|Société de conseil en management.| |NULL|Bordeaux|Business &amp; Management|2025-04-03 19:55:12|2025-04-03 19:55:12
|24|QualityCheck|Société de qualité logicielle.| |NULL|Nice|Informatique &amp; Digital|2025-04-03 19:55:12|2025-04-03 19:55:12
|25|QualitySoft|Spécialiste en assurance qualité logicielle.| |NULL|Limoges|Informatique &amp; Digital|2025-04-03 19:55:12|2025-04-03 19:55:12
|26|SalesForce|Entreprise spécialisée en solutions CRM.| |NULL|Toulon|Business &amp; Management|2025-04-03 19:55:12|2025-04-03 19:55:12
|27|SecureNet|Expert en solutions de cybersécurité.| |NULL|Marseille|Ingénierie &amp; Innovation|2025-04-03 19:55:12|2025-04-03 19:55:12
|28|SkyCompute|Prestataire de services cloud.| |NULL|Dijon|Ingénierie &amp; Innovation|2025-04-03 19:55:12|2025-04-03 19:55:12
|29|SocialBuzz|Agence spécialisée en social media.| |NULL|Grenoble|Business &amp; Management|2025-04-03 19:55:12|2025-04-03 19:55:12
|30|SoftDesign|Entreprise d'ingénierie logicielle.| |NULL|Amiens|Ingénierie &amp; Innovation|2025-04-03 19:55:12|2025-04-03 19:55:12
|31|TalentPlus|Cabinet de conseil en RH innovant.| |NULL|Tours|Business &amp; Management|2025-04-03 19:55:12|2025-04-03 19:55:12
|32|TechInfra|Société d'infrastructure cloud.| |NULL|Marseille|Ingénierie &amp; Innovation|2025-04-03 19:55:12|2025-04-03 19:55:12
|33|WebCraft|Agence de développement web créative.| |NULL|Le Havre|Informatique &amp; Digital|2025-04-03 19:55:12|2025-04-03 19:55:12
|40|AppFactories|Startup spécialisée dans les applications mobiles innovantes.|mjh15179389g@gmail.com|0621649310|Nantes|Informatique &amp; Digital|2025-04-03 21:58:55|2025-04-04 12:57:23
|42|BrandBoost|Agence de marketing performante.|NULL|NULL|Paris|Business &amp; Management|2025-04-03 21:58:55|2025-04-03 21:58:55
|43|ChainTech|Pionnier des solutions blockchain.|NULL|NULL|Clermont-Ferrand|Informatique &amp; Digital|2025-04-03 21:58:55|2025-04-03 21:58:55
|45|ez|zvzezeve|NULL|NULL|Paris|Business &amp; Management|2025-04-04 00:42:55|2025-04-04 11:03:37
|46|cacz|acazazc|mjh15179389g@gmail.com|0649190924|acazcazc|Informatique &amp; Digital|2025-04-04 11:02:49|2025-04-04 11:02:49
|48|HEMERICK MORIE|faefaefaef|mjh15179389g@gmail.com|0621649310|60 RUE MICHEL-ANGE|Informatique &amp; Digital|2025-04-04 11:16:14|2025-04-04 11:16:14
|49|fzeFEZF|ZADAZDADZDAZ|NULL|NULL|ZZADZAD|Business &amp; Management|2025-04-04 11:18:03|2025-04-04 11:18:03
|50|HEMERICK MORIEartzt|zratzrtz|mjh15179389g@gmail.com|0621649310|60 RUE MICHEL-ANGE|Business &amp; Management|2025-04-04 12:57:39|2025-04-04 12:57:39
|51|jodvhov|doocbdob|armelyofihv@gmail.com|0621649310|60, Rue Michel-Ange|Informatique &amp; Digital|2025-04-04 15:02:09|2025-04-04 15:02:44
|52|bbbbb|zefcecd|NULL|NULL|Paris|Informatique &amp; Digital|2025-04-04 15:06:16|2025-04-04 15:06:16
== Structure de la table company_ratings

|------
|Colonne|Type|Null|Valeur par défaut
|------
|//**id**//|int(11)|Non|
|company_id|int(11)|Non|
|rating|decimal(3,1)|Non|
|created_at|timestamp|Non|current_timestamp()
== Déchargement des données de la table company_ratings

|4|40|1.0|2025-04-04 01:12:36
|6|40|5.0|2025-04-04 11:06:44
|7|40|5.0|2025-04-04 11:07:32
|8|40|5.0|2025-04-04 11:08:04
|9|40|5.0|2025-04-04 11:08:25
|18|51|4.0|2025-04-04 15:03:04
|19|40|3.0|2025-04-04 15:17:16
== Structure de la table internships

|------
|Colonne|Type|Null|Valeur par défaut
|------
|//**id**//|int(11)|Non|
|company_id|int(11)|Oui|NULL
|title|varchar(255)|Non|
|company|varchar(255)|Non|
|location|varchar(255)|Non|
|type|varchar(50)|Non|
|domaine|enum('Informatique &amp; Digital', 'Business &amp; Management', 'Ingénierie &amp; Innovation')|Oui|NULL
|remote|varchar(50)|Non|
|salary_base|varchar(50)|Oui|NULL
|start_date|date|Oui|NULL
|end_date|date|Oui|NULL
|short_description|text|Non|
|full_description|text|Non|
|competence|varchar(255)|Oui|NULL
|company_description|text|Oui|NULL
|posted_at|timestamp|Non|current_timestamp()
|wishlist_count|int(11)|Oui|0
|applicants_count|int(11)|Oui|0
== Déchargement des données de la table internships

|2|NULL|Designer UX/UI|CreativeMinds|Bordeaux|Stage|Informatique &amp; Digital|Hybride|1000€|2023-10-01|2024-03-01|Stage en design d'interface|Création de maquettes et prototypes pour applications mobiles.|Figma, Adobe XD, UI/UX|Agence de design spécialisée dans l'expérience utilisateur.|2025-04-01 12:54:48|0|0
|3|NULL|Développeur Mobile|AppFactory|Nantes|Stage|Informatique &amp; Digital|Oui|1100€|2023-11-01|2024-05-01|Stage en développement mobile|Développement d'applications iOS et Android.|Swift, Kotlin, Flutter|Startup spécialisée dans les applications mobiles innovantes.|2025-04-01 12:54:48|0|0
|4|NULL|Data Scientist|AIForward|Rennes|Stage|Informatique &amp; Digital|Oui|1400€|2024-01-01|2024-06-30|Stage en intelligence artificielle|Développement de modèles de machine learning.|Python, TensorFlow, Data Science|Startup pionnière en intelligence artificielle.|2025-04-01 12:54:48|0|0
|5|NULL|Développeur Backend|CodeMasters|Toulon|Stage|Informatique &amp; Digital|Hybride|1150€|2023-07-01|2023-12-31|Stage en développement backend|Développement d'APIs et services backend.|Java, Spring, SQL|Editeur de solutions logicielles.|2025-04-01 12:54:48|0|0
|6|NULL|Développeur Frontend|WebCraft|Le Havre|Stage|Informatique &amp; Digital|Oui|1050€|2024-01-15|2024-07-15|Stage en développement frontend|Création d'interfaces utilisateur modernes.|HTML/CSS, JavaScript, Vue.js|Agence de développement web créative.|2025-04-01 12:54:48|0|0
|7|NULL|Expert Blockchain|ChainTech|Clermont-Ferrand|Stage|Informatique &amp; Digital|Hybride|2100€|2023-11-01|2024-05-01|Stage en développement blockchain|Développement de solutions blockchain innovantes.|Solidity, Smart Contracts|Pionnier des solutions blockchain.|2025-04-01 12:54:48|0|0
|8|NULL|Ingénieur QA|QualitySoft|Limoges|Stage|Informatique &amp; Digital|Hybride|1250€|2023-09-01|2024-02-28|Stage en assurance qualité|Mise en place de tests automatisés et manuels.|Selenium, Tests logiciels|Spécialiste en assurance qualité logicielle.|2025-04-01 12:54:48|0|0
|9|NULL|Marketing Digital|BuzzMedia|Lille|Stage|Business &amp; Management|Non|1300€|2023-09-01|2024-08-31|Stage en marketing digital|Gestion des réseaux sociaux et campagnes publicitaires.|SEO, Google Ads, Social Media|Agence de marketing digital performante.|2025-04-01 12:54:48|0|0
|10|NULL|Community Manager|SocialBuzz|Grenoble|Stage|Business &amp; Management|Oui|950€|2023-10-15|2024-04-15|Stage en gestion de communauté|Animation des réseaux sociaux et création de contenu.|Réseaux sociaux, Création de contenu|Agence spécialisée en social media.|2025-04-01 12:54:48|0|0
|11|NULL|Responsable RH|TalentPlus|Tours|Stage|Business &amp; Management|Non|1350€|2023-10-01|2024-09-30|Stage en ressources humaines|Gestion du recrutement et développement des talents.|Recrutement, GPEC|Cabinet de conseil en RH innovant.|2025-04-01 12:54:48|0|0
|12|NULL|Analyste Financier|FinancePlus|Montpellier|Stage|Business &amp; Management|Non|1450€|2023-09-01|2024-08-31|Stage en analyse financière|Analyse des données financières et reporting.|Excel, Analyse financière|Cabinet d'analyse financière réputé.|2025-04-01 12:54:48|0|0
|13|NULL|Chef de Projet IT|ProjetPlus|Strasbourg|Stage|Business &amp; Management|Non|1600€|2023-10-01|2024-09-30|Stage en gestion de projet|Gestion de projets informatiques pour divers clients.|Agile, Jira, Gestion de projet|Cabinet conseil en management de projet IT.|2025-04-01 12:54:48|0|0
|14|NULL|Ingénieur DevOps|CloudTech|Toulouse|Stage|Ingénierie &amp; Innovation|Oui|2000€|2023-07-15|2024-01-15|Stage en DevOps|Mise en place de pipelines CI/CD et gestion infrastructure cloud.|Docker, Kubernetes, AWS|CloudTech est un leader des solutions cloud natives.|2025-04-01 12:54:48|0|0
|15|NULL|Cybersécurité|SecureNet|Marseille|Stage|Ingénierie &amp; Innovation|Hybride|1800€|2023-08-01|2024-02-01|Stage en sécurité informatique|Tests d'intrusion et sécurisation des systèmes.|Pentesting, SIEM, Cryptographie|Expert en solutions de cybersécurité.|2025-04-01 12:54:48|0|0
|16|NULL|Ingénieur Cloud|SkyCompute|Dijon|Stage|Ingénierie &amp; Innovation|Oui|1900€|2023-08-15|2024-02-15|Stage en cloud computing|Déploiement et gestion d'infrastructures cloud.|AWS, Azure, Terraform|Prestataire de services cloud.|2025-04-01 12:54:48|0|0
|17|NULL|Consultant ERP|BusinessSoft|Angers|Stage|Ingénierie &amp; Innovation|Hybride|1550€|2023-09-01|2024-08-31|Stage en implémentation ERP|Déploiement de solutions ERP pour les clients.|SAP, Dynamics 365|Intégrateur de solutions ERP.|2025-04-01 12:54:48|0|0
|18|NULL|Architecte Logiciel|SoftDesign|Amiens|Stage|Ingénierie &amp; Innovation|Oui|2200€|2023-12-01|2024-06-30|Stage en architecture logicielle|Conception d'architectures logicielles robustes.|Design Patterns, Microservices|Entreprise d'ingénierie logicielle.|2025-04-01 12:54:48|0|0
|19|NULL|Administrateur Système|NetAdmin|Nice|Stage|Ingénierie &amp; Innovation|Non|1700€|2023-09-15|2024-03-15|Stage en administration système|Gestion et maintenance des serveurs et réseaux.|Linux, Windows Server, Réseaux|Société spécialisée en infrastructure IT.|2025-04-01 12:54:48|0|0
|23|NULL|Assistant Marketing Digital et conception a bon d'accord|BrandBoost|Paris|Temps plein|Business &amp; Management|Hybride|1200|2024-04-01|2024-10-01|Stage en marketing digital et marketing|Gestion des réseaux sociaux et campagnes publicitaires.|SEO, Google Ads, Social Media|Agence de marketing performante.|2025-04-01 12:57:42|0|0
|25|NULL|Assistant Chef de Projet|ProjetVision|Bordeaux|Stage|Business &amp; Management|Hybride|1300€|2024-03-15|2024-09-15|Stage en gestion de projet|Support à la gestion de projets digitaux.|Agile, Trello, Gestion de projet|Société de conseil en management.|2025-04-01 12:57:42|0|0
|26|NULL|Ingénieur Systèmes|TechInfra|Marseille|Stage|Ingénierie &amp; Innovation|Non|1500€|2024-01-15|2024-07-15|Stage en infrastructure IT|Déploiement et maintenance de serveurs.|Linux, Virtualisation, Réseaux|Société d'infrastructure cloud.|2025-04-01 12:57:42|0|0
|27|NULL|Ingénieur IA|AIInnovation|Grenoble|Stage|Ingénierie &amp; Innovation|Oui|1600€|2024-02-01|2024-08-31|Stage en intelligence artificielle|Développement d'algorithmes de machine learning.|Python, TensorFlow, NLP|Startup spécialisée en IA.|2025-04-01 12:57:42|0|0
|28|NULL|Technicien IoT|ConnectedDevices|Strasbourg|Stage|Ingénierie &amp; Innovation|Hybride|1400€|2024-03-01|2024-09-30|Stage en objets connectés|Développement de solutions IoT industrielles.|Arduino, Raspberry Pi, LoRaWAN|Pionnier des solutions IoT.|2025-04-01 12:57:42|0|0
|29|NULL|DevOps Junior|CloudNative|Rennes|Stage|Informatique &amp; Digital|Oui|1450€|2024-01-20|2024-07-20|Stage en DevOps|Automatisation des déploiements et monitoring.|Docker, Kubernetes, CI/CD|Expert en solutions cloud natives.|2025-04-01 12:57:42|0|0
|30|NULL|Testeur Logiciel|QualityCheck|Nice|Stage|Informatique &amp; Digital|Hybride|1200€|2024-02-10|2024-08-10|Stage en assurance qualité|Rédaction et exécution de plans de test.|Selenium, JIRA, Tests automatisés|Société de qualité logicielle.|2025-04-01 12:57:42|0|0
|31|NULL|Assistant Commercial|SalesForce|Toulon|Stage|Business &amp; Management|Non|1250€|2024-03-01|2024-09-30|Stage en force de vente|Prospection et support commercial.|CRM, Techniques de vente|Entreprise spécialisée en solutions CRM.|2025-04-01 12:57:42|0|0
|32|NULL|Ingénieur Réseaux|NetSolutions|Montpellier|Stage|Ingénierie &amp; Innovation|Non|1550€|2024-01-25|2024-07-25|Stage en réseaux informatiques|Configuration et sécurisation des réseaux.|Cisco, VPN, Sécurité réseau|Société de services réseaux.|2025-04-01 12:57:42|0|0
|33|NULL|Technicien Cloud|CloudExperts|Nancy|Stage|Ingénierie &amp; Innovation|Hybride|1500€|2024-02-15|2024-08-15|Stage en solutions cloud|Déploiement d'infrastructures cloud.|AWS, Azure, Terraform|Prestataire de services cloud.|2025-04-01 12:57:42|0|0
|36|NULL|mojorickffffff|azaa|abidjan|Temps plein|Business &amp; Management|Hybride|1002|2025-04-24|2025-06-21|sqdfsdougvdsbjifpuodsghfjoidspufh|oudvghhpqdhigkhbjdoshigfjsdfdsf|SEO, Google Ads, Social Media|hemerick|2025-04-03 20:04:47|0|0
|37|NULL|efezfezf ezf zef |ez|Paris|Temps plein|Business &amp; Management|Hybride|100|2025-04-26|2025-06-20|zfeezfezffffbfbffefefefefefefef|zefezfezfdsdvsvds|ez|efezfzef|2025-04-04 00:42:55|0|0
|40|NULL|aaaaaa|bbbbb|Paris|Temps plein|Informatique &amp; Digital|Hybride|500|2025-04-12|2025-07-21|qdfvf vfvf|dveqrv|php|zefcecd|2025-04-04 15:06:16|0|0
== Déclencheurs internships

|------
|Nom|Temps|Évènement|Définition
|------
|sync_company_after_internship_insert|AFTER|INSERT|BEGIN
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
== Structure de la table user_wishlist

|------
|Colonne|Type|Null|Valeur par défaut
|------
|//**user_id**//|int(11)|Non|
|//**internship_id**//|int(11)|Non|
|added_at|timestamp|Non|current_timestamp()
== Déchargement des données de la table user_wishlist

== Structure de la table utilisateurs

|------
|Colonne|Type|Null|Valeur par défaut
|------
|//**id**//|int(11)|Non|
|nom|varchar(100)|Non|
|**email**|varchar(255)|Non|
|password|varchar(255)|Non|
|reset_token|varchar(255)|Non|
|date_inscription|timestamp|Non|current_timestamp()
|role|enum('admin', 'pilote', 'etudiant')|Non|etudiant
|profile_photo|varchar(255)|Oui|NULL
|adresse|varchar(255)|Oui|NULL
|domaine|varchar(255)|Oui|NULL
|photo|varchar(255)|Oui|https://bootdey.com/img/Content/avatar/avatar1.png
|cv_path|varchar(255)|Oui|NULL
|prenom|varchar(100)|Non|
|wishlist_count|int(11)|Oui|0
== Déchargement des données de la table utilisateurs

|2|morie_admin|josuehemerick.morie@viacesi.fr|$2y$10$W3uS80lglfKxdp5/0RbdKu0kd9fDsrsOnTG4oodUOKaD0vx0Q2Ldm| |2025-03-30 23:10:28|admin|NULL|44600 60 RUE michel ange|business|./uploads/profiles/profile_67ed1a970d438.png|NULL|le patriote|0
|24|Jéremy|jgallet@viacesi.fr|$2y$10$j65oY/hBym3G665O25lTGeCNAZBIE/TW1Ay1vX4NX/XDvihYr38Ja| |2025-04-02 12:26:02|pilote|NULL|NULL|NULL|https://bootdey.com/img/Content/avatar/avatar1.png|NULL|Gallet|0
|36|Morie|mojorick.facebook@outlook.fr|$2y$10$i9.QWL03c/vOXoFwPUCm5OVC/XzaL9CUqWsIdx30c/w0C1lebDXuG| |2025-04-04 13:01:30|etudiant|NULL|Ggg|informatique|https://bootdey.com/img/Content/avatar/avatar1.png|NULL|hemerick|0
|37|MORIE|mojorick.podcast@hotmail.com|$2y$10$Z8IEmpjxsf5KoEidZRyx3e1br81sGt7CtcFA2yCCDdoduXAoRJMOS| |2025-04-04 14:58:24|admin|NULL|NULL|NULL|https://bootdey.com/img/Content/avatar/avatar1.png|NULL| |0
|39|SAINT-NAZAIRE|mojorick.boucingball@gmail.com|$2y$10$HuU.r7wcsQaUX/bJ.aUgs.VUS81OuPCioaccnND0oHDXGx4dNpa4e| |2025-04-04 15:08:28|pilote|NULL|NULL|NULL|https://bootdey.com/img/Content/avatar/avatar1.png|NULL|CESI|0
|40|armel|mojorick.podcast@hotmail.comk|$2y$10$BAyxGpdME2yuQ1Tt0OoRAOTWjKGs73lYAZ6bzRDLzY1ndkUDl8mmq| |2025-04-04 15:09:47|etudiant|NULL|60 RUE MICHEL-ANGE|informatique|https://bootdey.com/img/Content/avatar/avatar1.png|NULL|zaefae|0
|41|MORIE|mjh15179389g@gmail.com|$2y$10$TJeRON.k1bc23t9kNLjUf.Kbdw5ApLZCBiMNg6soE7.GORW/NAEFa| |2025-04-04 15:15:53|etudiant|NULL|60 RUE MICHEL-ANGE|informatique|./uploads/profiles/profile_67efdc989866f.jpg|NULL|HEMERICK|0

L’objectif de ce dictionnaire est de faciliter la compréhension et la manipulation de la base de données à
toutes les personnes impliquées dans le projet.

### MCD

Ce schéma représente un modèle conceptuel de données (MCD) optimisé qui respecte les règles de la troisième forme normale (3NF) pour notre site web.
Il sert à modéliser les relations entre les offres et les utilisateurs, les candidatures et les entreprises. Par exemple :
- Les Applications sont directement liées aux Users, indiquant que chaque candidature est soumise par 
un étudiant.
- Les Offers proviennent des Companies, montrant que les entreprises publient des offres d'emploi 
auxquelles les utilisateurs peuvent postuler.




### MLD

Notre Modèle Logique de Données (MLD) est représenté la façon dont les données sont structurées dans la base de données, en mettant l'accent sur les tables, les clés primaires (PK), les clés étrangères (FK), et les relations entre elles.
Les relations entre les tables indiquent les liens entre les différents éléments de données.



## Mock-up
### Page d'accueil
#### Invité



#### Administrateur


#### Pilote



#### Étudiant



### Page de connexion



Pour la page de connexion, nous aurons un champs texte pour l’adresse mail de l’utilisateur et pour le mot de passe, le bouton “valider” pour se connecter et deux liens vers la page d’inscription ou vers une page de récupération de mot de passe.
Pour la récupération de mot de passe, nous enverrons un code à l’adresse mail de l’utilisateur et de taper après le nouveau mot de passe.

### Page d'enregistrement



### Page de recherche

#### Invité



Pour la page de recherche de stage, alternance…. Nous aurons un champs texte pour saisir les mots clés liés à la recherche, le lieu de travail ,un bouton chercher qui lance la recherche et des dropdowns des listes avec différents filtres comme domaine, durée contrat ,type et plus de filtres.



Et nous pouvons trier la liste des résultats par les plus récent, les plus ancien, ordre alphabétique, etc.



#### Pilote



#### Étudiant



### Page d'une entreprise

#### Invité



#### Pilote



#### Étudiant



### Page d'une offre
#### Invité



#### Administrateur



#### Pilote



#### Étudiant



### Page d'utilisateur
#### Page d'élève



Dans cette page nous allons afficher le profil d’un étudiant.
Sur cette page nous allons afficher les informations de celui-ci (nom, prénom, centre, promotion) ainsi que son avatar dans une bannière prévu pour ceux-ci.
Les compétences sont affichées en dessous des informations l’utilisateurs pourra rajouter ses compétences dans le pop-up « modifier ».
Pour accéder aux compétences en détails de l’utilisateur un bouton voir plus est à disposition pour afficher toutes les compétences de l’étudiant.
Dans la bannière en haut de la page nous retrouvons un bouton modifier afin que l’utilisateur puisse modifier toutes informations. Un pop-up apparaitra quand nous cliquerons sur le bouton comme ci-dessous : 



L’utilisateur pourra rajouter des compétences via le menu déroulant.



Dans le pop-up, l’utilisateur pourra aussi supprimer son compte avec un bouton rouge en bas à gauche.
Ensuite dans les corps de la page nous allons afficher sa wish-list et les offres auxquelles il a candidaté. Il y aura un système de pagination pour la wish-list et les offres candidatées.

#### Page de pilote



Cette page est le profil d’un pilote visible par le pilote lui-même (il y a un bouton pour modifier le profil en plus par rapport à la vue des autres utilisateurs).
Nous pouvons y retrouver une bannière avec différentes informations sur le pilote comme son nom, prénom ou son lieu de travail. 
Nous y voyons aussi la liste des promotions suivis par ce pilote.
La page de profil du pilote est similaire à la page étudiant étant donné que les pop-ups seront les mêmes. La différence se fait au niveau du corp de la page. Nous affichons les promotions auxquelles le pilote est assigné. Un système de pagination est également mis en place pour les promotions assignées.
Dans la bannière en haut de la page nous retrouverons les informations du pilote (nom, prénom, centre).

### Page d'administration
#### Utilisateurs



Cette page et ses nombreuses fenêtres permet à un pilote de gérer les étudiants et à un administrateur de gérer les pilotes et les étudiants.
Le pilote/administrateur peut :
-	Modifier un utilisateur
-	Supprimer un utilisateur 
-	Modifier ses candidatures
-	Ajouter un utilisateur

#### Entreprises



Cette page et ses nombreuses fenêtres permet à un pilote et un administrateur de gérer les entreprises.
Le pilote/administrateur peut :
-	Modifier une entreprise
-	Supprimer une entreprise
-	Modifier ses offres de stages
-	Ajouter une entreprise

# Résultats

Page d'accueil : 


Page de recherche : 


Page de connexion : 


Page d'enregistrement :


Page d'une offre : 

