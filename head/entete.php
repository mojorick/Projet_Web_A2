<link rel="stylesheet" href="entete.css">


<header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <img src="https://raw.githubusercontent.com/lucide-icons/lucide/main/icons/graduation-cap.svg" alt="Logo" class="logo-icon">
                    <span>CESI Stages</span>
                </div>
                <nav class="nav-desktop" aria-label="Navigation principale">
                    <div class="nav-group">
                        <a href="../accueil/accueil.php" class="nav-link">Accueil</a>
                    </div>
                    <div class="nav-group">
                        <a href="#offres" class="nav-link">Offres de stage</a>
                        <div class="nav-dropdown">
                            <a href="recherche.php">Rechercher un stage</a>
                            <a href="#statistiques-offres">Statistiques</a>
                        </div>
                    </div>
                    <div class="nav-group">
                        <a href="#entreprises" class="nav-link">Entreprises</a>
                        <div class="nav-dropdown">
                            <a href="#liste-entreprises">Liste des entreprises</a>
                            <a href="#evaluations">Évaluations</a>
                            <a href="#statistiques-entreprises">Statistiques</a>
                        </div>
                    </div>
                    <div class="nav-group">
                        <a href="#espace-pilote" class="nav-link">Espace Pilote</a>
                        <div class="nav-dropdown">
                            <a href="#suivi-candidatures">Suivi des candidatures</a>
                            <a href="#validation-entreprises">Validation des entreprises</a>
                            <a href="#statistiques-promotion">Statistiques de promotion</a>
                        </div>
                    </div>
                    <div class="nav-group">
                        <a href="#espace-admin" class="nav-link">Espace Administrateur</a>
                        <div class="nav-dropdown">
                            <a href="#gestion-utilisateurs">Gestion des utilisateurs</a>
                            <a href="#gestion-entreprises">Gestion des entreprises</a>
                            <a href="#gestion-offres">Gestion des offres de stage</a>
                            <a href="#gestion-candidatures">Gestion des candidatures</a>
                        </div>
                    </div>
                    <div class="nav-group">
                        <a href="#espace-entreprise" class="nav-link">Espace Entreprise</a>
                        <div class="nav-dropdown">
                            <a href="#creer-offre">Créer une offre</a>
                            <a href="#modifier-offre">Modifier une offre</a>
                            <a href="#supprimer-offre">Supprimer une offre</a>
                        </div>
                    </div>
                </nav>
                <div class="auth-buttons">
                <button class="btn-primary" id="registerBtn"><a href="../enregistrement/enregistrement.php">S'enregistrer</a></button></a>
                </div>
                <button class="menu-toggle" id="menuToggle" aria-label="Menu mobile">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>

            
            <nav class="nav-mobile" id="mobileMenu" aria-label="Navigation mobile">
                <div class="mobile-search">
                    <input type="search" placeholder="Rechercher..." aria-label="Recherche">
                </div>
                <div class="mobile-section">
                    <h3>Navigation</h3>
                    <a href="accueil.php">Accueil</a>
                </div>
                <div class="mobile-section">
                    <h3>Offres de stage</h3>
                    <a href="#recherche-avancee">Recherche avancée</a>
                    <a href="#par-competences">Par compétences</a>
                    <a href="#statistiques-offres">Statistiques</a>
                </div>
                <div class="mobile-section">
                    <h3>Entreprises</h3>
                    <a href="#liste-entreprises">Liste des entreprises</a>
                    <a href="#evaluations">Évaluations</a>
                    <a href="#statistiques-entreprises">Statistiques</a>
                </div>
                <div class="mobile-section">
                    <h3>Espace Pilote</h3>
                    <a href="#suivi-candidatures">Suivi des candidatures</a>
                    <a href="#validation-entreprises">Validation des entreprises</a>
                    <a href="#statistiques-promotion">Statistiques de promotion</a>
                </div>
                <div class="mobile-section">
                    <h3>Espace Administrateur</h3>
                    <a href="#gestion-utilisateurs">Gestion des utilisateurs</a>
                    <a href="#gestion-entreprises">Gestion des entreprises</a>
                    <a href="#gestion-offres">Gestion des offres de stage</a>
                    <a href="#gestion-candidatures">Gestion des candidatures</a>
                </div>
                <div class="mobile-section">
                    <h3>Espace Entreprise</h3>
                    <a href="#creer-offre">Créer une offre</a>
                    <a href="#modifier-offre">Modifier une offre</a>
                    <a href="#supprimer-offre">Supprimer une offre</a>
                </div>
                <div class="mobile-auth">
                    <button class="btn-primary" id="registerBtn"><a href="enregistrement/enregistrement.php">S'enregistrer</a></button>
                </div>
            </nav>
        </div>
    </header>
<script src="entete.js"></script>