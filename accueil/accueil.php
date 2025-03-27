<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="CESI Stages - Plateforme de recherche de stages pour les étudiants">
    <title>CESI Stages</title>
    <link rel="stylesheet" href="accueil.css">
    <!-- PWA Support -->
    <link rel="manifest" href="manifest.json">
    <meta name="theme-color" content="#2563eb">
</head>
<body>
    <?php include ("../head/entete.php"); ?>
    <!-- Hero Section -->
     <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Trouvez le stage qui lancera <span>votre carrière</span></h1>
                <br />
                <p>Des milliers d'opportunités de stage vous attendent. Commencez votre aventure professionnelle dès maintenant.</p>

                <div class="filters-container">
                <div class="advanced-filters">
                    <div class="filter-group">
                        <label for="type-stage">Type de stage</label>
                        <select id="type-stage">
                            <option value="all">Tous les types</option>
                            <option value="fin-etudes">Stage de fin d'études</option>
                            <option value="alterne">Stage alterné</option>
                            <option value="court">Stage court</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="duree">Durée</label>
                        <select id="duree">
                            <option value="all">Toutes les durées</option>
                            <option value="1-2">1-2 mois</option>
                            <option value="3-4">3-4 mois</option>
                            <option value="5-6">5-6 mois</option>
                            <option value="6+">6+ mois</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="date-debut">Date de début</label>
                        <input type="date" id="date-debut">
                    </div>
                </div>
                
                <div class="search-container" style="margin-top: -4%;">
                    <div class="search-box">
                        <img src="https://raw.githubusercontent.com/lucide-icons/lucide/main/icons/search.svg" alt="Search" class="search-icon">
                        <input type="text" placeholder="Métier, mot-clé..." aria-label="Rechercher par mot-clé">
                    </div>
                    <div class="search-box">
                        <img src="https://raw.githubusercontent.com/lucide-icons/lucide/main/icons/building-2.svg" alt="Location" class="search-icon">
                        <input type="text" placeholder="Ville ou région" aria-label="Rechercher par localisation">
                    </div>
                    <div class="search-box">
                        <img src="https://raw.githubusercontent.com/lucide-icons/lucide/main/icons/code.svg" alt="Skills" class="search-icon">
                        <input type="text" placeholder="Compétences" aria-label="Rechercher par compétences">
                    </div>
                    <button class="btn-primary">Rechercher</button>
                </div>
            </div>
            </div>
        </div>
    </section>

    
    <section class="latest-offers">
        <div class="container">
            <div class="section-header">
                <h2>Dernières offres de stage</h2>
                <div class="section-actions">
                    <div class="sort-filter">
                        <label for="sortOffers">Trier par:</label>
                        <select id="sortOffers">
                            <option value="company">Entreprise</option>
                            <option value="location">Localisation</option>
                        </select>
                    </div>
                    <a href="#all-offers" class="btn-secondary">Voir toutes les offres</a>
                </div>
            </div>

            <div class="offers-grid">
                
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

    
    <section class="categories">
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
                            <span>127 offres</span>
                            <span>45 entreprises</span>
                        </div>
                        <a href="#informatique" class="category-link">
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
                            <span>98 offres</span>
                            <span>37 entreprises</span>
                        </div>
                        <a href="#business" class="category-link">
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
                            <span>156 offres</span>
                            <span>52 entreprises</span>
                        </div>
                        <a href="#ingenierie" class="category-link">
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

    <?php include("../footer/footer.php") ?>
    <script src="accueil.js"></script>
</body>
</html>
