<?php

// Vérifier si l'utilisateur est connecté
$userLoggedIn = isset($_SESSION['id']);

// Gestion des cookies
$cookiesAccepted = isset($_COOKIE['cookies_prefs']) ? $_COOKIE['cookies_prefs'] : false;

// Afficher le bandeau cookies seulement si aucun choix n'a été fait
$showCookieBanner = !isset($_COOKIE['cookies_prefs']);

// Afficher le rappel de connexion seulement si:
// - L'utilisateur n'est pas connecté
// - Les cookies ont été acceptés
// - Le rappel n'a pas été explicitement fermé
$showLoginReminder = !$userLoggedIn && $cookiesAccepted === 'accepted' && !isset($_COOKIE['login_reminder_closed']);

// Traitement de l'action sur les cookies
if (isset($_GET['cookie_action'])) {
    if ($_GET['cookie_action'] === 'accept') {
        setcookie('cookies_prefs', 'accepted', time() + (86400 * 365), "/");
    } elseif ($_GET['cookie_action'] === 'reject') {
        setcookie('cookies_prefs', 'rejected', time() + (86400 * 365), "/");
    }
    header('Location: ' . strtok($_SERVER["REQUEST_URI"], '?'));
    exit;
}

// Traitement de la fermeture du rappel de connexion
if (isset($_GET['close_login_reminder'])) {
    setcookie('login_reminder_closed', 'true', time() + (86400 * 30), "/");
    header('Location: ' . strtok($_SERVER["REQUEST_URI"], '?'));
    exit;
}
?>


<?php if ($userLoggedIn): ?>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const reminder = document.getElementById('loginReminder');
    if (reminder) reminder.style.display = 'none';
});
</script>
<?php endif; ?>

<?php require_once("./views/commons/header.php")?>
   <!-- Hero Section -->
     <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Trouvez le stage qui lancera <span>votre carrière</span></h1>
                <br />
                <p>Des milliers d'opportunités de stage vous attendent. Commencez votre aventure professionnelle dès maintenant.</p>
                <div class="hero-content">
                    <form id="searchForm" method="GET" action="Recherche_de_stage">
                        <div class="filters-container">
                            <div class="advanced-filters">
                                <div class="filter-group">
                                    <label for="salary">Salaire</label>
                                    <select id="salary" name="salary">
                                        <option value="">Toutes les salaires disponibles</option>
                                        <option value="0-500" <?= isset($_GET['salary']) && $_GET['salary'] === '0-500' ? 'selected' : '' ?>>0 € - 500 €</option>
                                        <option value="500-1000" <?= isset($_GET['salary']) && $_GET['salary'] === '500-1000' ? 'selected' : '' ?>>500 € - 1000€</option>
                                        <option value="1000-1750" <?= isset($_GET['salary']) && $_GET['salary'] === '1000-1750' ? 'selected' : '' ?>>1000 € - 1750 €</option>
                                        <option value="1750-2500" <?= isset($_GET['salary']) && $_GET['salary'] === '1750-2500' ? 'selected' : '' ?>>1750 € - 2500 €</option>
                                        <option value="2500+" <?= isset($_GET['salary']) && $_GET['salary'] === '2500+' ? 'selected' : '' ?>>2500 € et +</option>
                                    </select>
                                </div>
                                <div class="filter-group">
                                    <label for="duration">Durée</label>
                                    <select id="duration" name="duration">
                                        <option value="">Toutes les durées</option>
                                        <option value="1-2" <?= isset($_GET['duration']) && $_GET['duration'] === '1-2' ? 'selected' : '' ?>>1-2 mois</option>
                                        <option value="3-4" <?= isset($_GET['duration']) && $_GET['duration'] === '3-4' ? 'selected' : '' ?>>3-4 mois</option>
                                        <option value="5-6" <?= isset($_GET['duration']) && $_GET['duration'] === '5-6' ? 'selected' : '' ?>>5-6 mois</option>
                                        <option value="6+" <?= isset($_GET['duration']) && $_GET['duration'] === '6+' ? 'selected' : '' ?>>6+ mois</option>
                                    </select>
                                </div>
                                <div class="filter-group">
                                    <label for="start_date">Date de début</label>
                                    <input type="date" id="start_date" name="start_date" value="<?= isset($_GET['start_date']) ? htmlspecialchars($_GET['start_date']) : '' ?>">
                                </div>
                            </div>
                            
                            <div class="search-container" style="margin-top: -4%;">
                            <div class="search-box">
                                    <img src="https://raw.githubusercontent.com/lucide-icons/lucide/main/icons/briefcase.svg" alt="Domain" class="search-icon">
                                    <select name="domaine" aria-label="Domaine" style="width: 100%;padding: 0.75rem 1rem 0.75rem 3rem; border: 1px solid #e2e8f0;border-radius: var(--radius);font-size: 0.95rem; appearance: none;background-color: white;cursor: pointer;">
                                        <option value="">Tous les domaines</option>
                                        <option value="Informatique & Digital" <?= isset($_GET['domaine']) && $_GET['domaine'] === 'Informatique & Digital' ? 'selected' : '' ?>>Informatique & Digital</option>
                                        <option value="Business & Management" <?= isset($_GET['domaine']) && $_GET['domaine'] === 'Business & Management' ? 'selected' : '' ?>>Business & Management</option>
                                        <option value="Ingénierie & Innovation" <?= isset($_GET['domaine']) && $_GET['domaine'] === 'Ingénierie & Innovation' ? 'selected' : '' ?>>Ingénierie & Innovation</option>
                                    </select>
                                </div>
                                <div class="search-box">
                                    <img src="https://raw.githubusercontent.com/lucide-icons/lucide/main/icons/building-2.svg" alt="Location" class="search-icon">
                                    <input type="text" name="location" placeholder="Ville ou région" 
                                        value="<?= isset($_GET['location']) ? htmlspecialchars($_GET['location']) : '' ?>"
                                        aria-label="Rechercher par localisation">
                                </div>
                                <div class="search-box">
                                    <img src="https://raw.githubusercontent.com/lucide-icons/lucide/main/icons/code.svg" alt="Skills" class="search-icon">
                                    <input type="text" name="skills" placeholder="Compétences" 
                                        value="<?= isset($_GET['skills']) ? htmlspecialchars($_GET['skills']) : '' ?>"
                                        aria-label="Rechercher par compétences">
                                </div>
                                <button type="submit" class="btn-primary" style=" color: white; background-color: #158515; display: inline-flex;align-items: center;justify-content: center; padding: 0.75rem 1.5rem;border-radius: var(--header-radius);font-weight: 600;text-decoration: none;transition: var(--header-transition);cursor: pointer;border: none;font-size: 0.875rem;">Rechercher</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    
    
    <section class="features">
    <div class="container">
        <h2>Tout ce dont vous avez besoin pour trouver le stage parfait</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <img src="https://raw.githubusercontent.com/lucide-icons/lucide/main/icons/search.svg" alt="Search">
                </div>
                <h3>Recherche avancée</h3>
                <p>Trouvez le stage parfait avec notre moteur de recherche intelligent</p>
                <ul class="feature-list">
                    <li>Filtrage par compétences</li>
                    <li>Recherche géographique</li>
                    <li>Suggestions personnalisées</li>
                </ul>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <img src="https://raw.githubusercontent.com/lucide-icons/lucide/main/icons/star.svg" alt="Star">
                </div>
                <h3>Liste de souhaits</h3>
                <p>Sauvegardez vos offres préférées pour les retrouver facilement</p>
                <ul class="feature-list">
                    <li>Organisation par catégories</li>
                    <li>Notifications personnalisées</li>
                    <li>Comparaison d'offres</li>
                </ul>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <img src="https://raw.githubusercontent.com/lucide-icons/lucide/main/icons/briefcase.svg" alt="Briefcase">
                </div>
                <h3>Candidature simplifiée</h3>
                <p>Postulez en quelques clics et suivez vos candidatures</p>
                <ul class="feature-list">
                    <li>CV et LM personnalisés</li>
                    <li>Suivi en temps réel</li>
                    <li>Historique des candidatures</li>
                </ul>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <img src="https://cdn.jsdelivr.net/npm/lucide-static@latest/icons/bar-chart.svg" alt="Chart">
                </div>
                <h3>Statistiques et analyses</h3>
                <p>Suivez les tendances et prenez des décisions éclairées</p>
                <ul class="feature-list">
                    <li>Analyses du marché</li>
                    <li>Taux de réussite</li>
                    <li>Rapports détaillés</li>
                </ul>
            </div>
        </div>
    </div>
</section>

    
    <section class="categories" style="background:linear-gradient(90deg,#ffffff ,#93f593);">
        <div class="container">
            <div class="section-header">
                <h2>Explorez par catégorie</h2>
                <p>Découvrez les opportunités dans votre domaine d'expertise</p>
            </div>
            <div class="categories-grid">
                <div class="category-card">
                    <div class="category-image">
                        <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Informatique & Digital">
                    </div>
                    <div class="category-content">
                        <h3>Informatique & Digital</h3>
                        <p>Développement, cybersécurité, data science et plus encore</p>
                        <div class="category-stats">
                            <span><?= $stats['Informatique & Digital']['offres'] ?> offres</span>
                            <span><?= $stats['Informatique & Digital']['entreprises'] ?> entreprises</span>
                        </div>
                        <a href="Recherche_de_stage?domaine=Informatique+%26+Digital" class="category-link">
                            Découvrir
                            <img src="https://raw.githubusercontent.com/lucide-icons/lucide/main/icons/arrow-right.svg" alt="Arrow">
                        </a>
                    </div>
                </div>
                <div class="category-card">
                    <div class="category-image">
                        <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Business & Management">
                    </div>
                    <div class="category-content">
                        <h3>Business & Management</h3>
                        <p>Marketing, finance, ressources humaines et gestion de projet</p>
                        <div class="category-stats">
                            <span><?= $stats['Business & Management']['offres'] ?> offres</span>
                            <span><?= $stats['Business & Management']['entreprises'] ?> entreprises</span>
                        </div>
                        <a href="Recherche_de_stage?domaine=Business+%26+Management" class="category-link">
                            Découvrir
                            <img src="https://raw.githubusercontent.com/lucide-icons/lucide/main/icons/arrow-right.svg" alt="Arrow">
                        </a>
                    </div>
                </div>
                <div class="category-card">
                    <div class="category-image">
                        <img src="https://images.unsplash.com/photo-1581094794329-c8112a89af12?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Ingénierie & Innovation">
                    </div>
                    <div class="category-content">
                        <h3>Ingénierie & Innovation</h3>
                        <p>Mécanique, électronique, robotique et énergies</p>
                        <div class="category-stats">
                            <span><?= $stats['Ingénierie & Innovation']['offres'] ?> offres</span>
                            <span><?= $stats['Ingénierie & Innovation']['entreprises'] ?> entreprises</span>
                        </div>
                        <a href="Recherche_de_stage?domaine=Ingénierie+%26+Innovation" class="category-link">
                            Découvrir
                            <img src="https://raw.githubusercontent.com/lucide-icons/lucide/main/icons/arrow-right.svg" alt="Arrow">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="evaluations">
        <div class="container">
            <div class="section-header">
                <h2>Évaluations des entreprises</h2>
                <p>Découvrez les retours d'expérience des anciens stagiaires</p>
            </div>
            <div class="evaluations-grid">
                
            </div>
            <div class="evaluation-stats">
                <div class="stat">
                    <h4>Note moyenne</h4>
                    <p>4.5/5</p>
                </div>
                <div class="stat">
                    <h4>Évaluations</h4>
                    <p>1,234</p>
                </div>
                <div class="stat">
                    <h4>Entreprises évaluées</h4>
                    <p>289</p>
                </div>
            </div>
        </div>
    </section>
    <?php if ($showCookieBanner): ?>
<div class="cookie-banner" id="cookieBanner">
    <div class="cookie-content">
        <p>🍪 Nous utilisons des cookies pour améliorer votre expérience.</p>
        <div class="cookie-buttons">
            <a href="?cookie_action=accept" class="cookie-button">Accepter</a>
            <a href="?cookie_action=reject" class="cookie-button secondary">Refuser</a>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if ($showLoginReminder): ?>
<div class="login-reminder-banner" id="loginReminder">
    <div class="reminder-content">
        <h3>Boostez votre recherche de stage !</h3>
        <p>Connectez-vous pour profiter de toutes les fonctionnalités :</p>
        <ul>
            <li>✔ Sauvegarder vos offres favorites</li>
            <li>✔ Postuler en 1 clic</li>
            <li>✔ Recevoir des recommandations personnalisées</li>
        </ul>
        <div class="reminder-buttons">
            <a href="enregistrement" class="btn-login">Se connecter</a>
        </div>
    </div>
    <button class="close-btn" onclick="closeReminder()">×</button>
</div>
<?php endif; ?>

    <?php require_once("./views/commons/footer.php")?>
