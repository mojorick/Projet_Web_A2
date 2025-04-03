
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/header.css">
</head>
<body>
    <header class="header">
    <?php
    if (session_status() === PHP_SESSION_NONE) session_start();
    $isLoggedIn = isset($_SESSION['email']);
    $role = $_SESSION['role'] ?? null;
    ?>

    <header class="header-container">
        <div class="header__content">
            <div class="header__logo">
                <img src="https://raw.githubusercontent.com/lucide-icons/lucide/main/icons/graduation-cap.svg" 
                    alt="Logo" class="header__logo-icon">
                <span class="header__logo-text">CESI stage</span>
            </div>

            <nav class="header__nav-desktop" aria-label="Navigation principale">
                <div class="header__nav-group">
                    <a href="<?=ROOT?>" class="header__nav-link">Accueil</a>
                </div>
                
                <div class="header__nav-group">
                    <a href="Recherche_de_stage" class="header__nav-link">Offres de stage</a>
                    <div class="header__nav-dropdown">
                        <a href="Recherche_de_stage">Rechercher une offre</a>
                        <a href="statistique_des_offres_de_stage">Statistiques</a>
                    </div>
                </div>
                <div class="header__nav-group">
                    <a href="Recherche_de_stage" class="header__nav-link">Liste des entreprises</a>
                </div>

                <?php if ($isLoggedIn && $role === 'pilote'): ?>
                <div class="header__nav-group">
                    <a href="#espace-pilote" class="header__nav-link">Espace Pilote</a>
                    <div class="header__nav-dropdown">
                        <a href="Gestion_des_entreprises">Gestion entreprises</a>
                        <a href="Gestion_des_offres_de_stage">Gestion offres</a>
                        <a href="Gestion_des_etudiants">Gestion étudiants</a>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($isLoggedIn && $role === 'admin'): ?>
                <div class="header__nav-group">
                    <a href="#espace-admin" class="header__nav-link">Espace Administrateur</a>
                    <div class="header__nav-dropdown">
                        <a href="Gestion_des_entreprises">Gestion entreprises</a>
                        <a href="Gestion_des_offres_de_stage">Gestion offres</a>
                        <a href="Gestion_des_pilotes">Gestion pilotes</a>
                        <a href="Gestion_des_etudiants">Gestion étudiants</a>
                        <a href="Gestion_des_candidatures">Gestion des candidatures</a>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($isLoggedIn && $role === 'etudiant'): ?>
                <div class="header__nav-group">
                    <a href="#espace-etudiant" class="header__nav-link">Espace Étudiant</a>
                    <div class="header__nav-dropdown">
                        <a href="Gestion_des_entreprises">Gestion entreprises</a>
                        <a href="Gestion_des_candidatures">Gestion des candidatures</a>
                    </div>
                </div>
                <?php endif; ?>
            </nav>

            <div class="header__auth-buttons">
                <?php if ($isLoggedIn): ?>
                    <i class='bx bx-user-circle header__user-icon' id="headerUserIcon"></i>
                    <a href="<?=ROOT?>models/logout.php" class="header__btn header__btn--primary">Déconnexion</a>
                <?php else: ?>
                    <a href="enregistrement" class="header__btn header__btn--primary">S'enregistrer</a>
                <?php endif; ?>
            </div>

            <button class="header__menu-toggle" id="headerMenuToggle" aria-label="Menu mobile">
                <span class="header__menu-bar"></span>
                <span class="header__menu-bar"></span>
                <span class="header__menu-bar"></span>
            </button>
        </div>

        <nav class="header__nav-mobile" id="headerMobileMenu" aria-label="Navigation mobile">
            <div class="header__mobile-section">
                <h3 class="header__mobile-title">Navigation</h3>
                <a href="<?=ROOT?>" class="header__mobile-link">Accueil</a>
                <a href="#entreprises" class="header__mobile-link">Entreprises</a>
            </div>
            
            <div class="header__mobile-section">
                <h3 class="header__mobile-title">Offres de stage</h3>
                <a href="Recherche_de_stage" class="header__mobile-link">Rechercher</a>
                <a href="statistique_des_offres_de_stage" class="header__mobile-link">Statistiques</a>
            </div>

            <?php if ($isLoggedIn && $role === 'pilote'): ?>
            <div class="header__mobile-section">
                <h3 class="header__mobile-title">Espace Pilote</h3>
                <a href="Gestion_des_entreprises" class="header__mobile-link">Gestion entreprises</a>
                <a href="Gestion_des_offres_de_stage" class="header__mobile-link">Gestion offres</a>
                <a href="Gestion_des_etudiants" class="header__mobile-link">Gestion étudiants</a>
            </div>
            <?php endif; ?>

            <?php if ($isLoggedIn && $role === 'admin'): ?>
            <div class="header__mobile-section">
                <h3 class="header__mobile-title" >Espace Admininistrateur</h3>
                    <a href="Gestion_des_entreprises" class="header__mobile-link">Gestion entreprises</a>
                    <a href="Gestion_des_offres_de_stage" class="header__mobile-link">Gestion offres</a>
                    <a href="Gestion_des_pilotes" class="header__mobile-link">Gestion pilotes</a>
                    <a href="Gestion_des_etudiants" class="header__mobile-link">Gestion étudiants</a>
                    <a href="Gestion_des_candidatures" class="header__mobile-link">Gestion des candidatures</a>
            </div>
            <?php endif; ?>

            <?php if ($isLoggedIn && $role === 'etudiant'): ?>
            <div class="header__mobile-section">
                <h3 class="header__mobile-title" class="header__mobile-link">Espace Étudiant</h3>
                <a href="Gestion_des_entreprises" class="header__mobile-link">Gestion des entreprises</a>
                <a href="Gestion_des_candidatures" class="header__mobile-link">Gestion des candidatures</a>
            </div>
            <?php endif; ?>

            <div class="header__mobile-auth">
                <?php if ($isLoggedIn): ?>
                    <i class='bx bx-user-circle header__user-icon--mobile' id="headerUserIconMobile"></i>
                    <a href="<?=ROOT?>models/logout.php" class="header__btn header__btn--primary">Déconnexion</a>
                <?php else: ?>
                    <a href="enregistrement" class="header__btn header__btn--primary">S'enregistrer</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>
    </header>
    </body>
    <script src="./public/javascript/header.js"></script>
</html>