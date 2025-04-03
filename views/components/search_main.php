    <!-- Hero Section -->
     <style>
        :root {
            --primary: #158515;
            --primary-dark: #055c05;
            --primary-light: #1fc81f;
            --secondary: #64748b;
            --accent: #f97316;
            --background:linear-gradient(90deg,#ffffff ,#1fc81f);
            --text: #1e293b;
            --text-light: #64748b;
            --white: #ffffff;
            --error: #ef4444;
            --success: #22c55e;
            --warning: #f59e0b;
            --info: #3b82f6;
            --shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --radius: 0.5rem;
            --radius-lg: 1rem;
            --transition: all 0.2s ease-in-out;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            font-size: 16px;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.5;
            color: var(--text);
            background-color: var(--background);
        }

        .container {
            width: 100%;
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        h1, h2, h3, h4, h5, h6 {
            line-height: 1.2;
            font-weight: 700;
        }

        h1 {
            font-size: clamp(2rem, 5vw, 3.5rem);
        }

        h2 {
            font-size: clamp(1.5rem, 4vw, 2.25rem);
            margin-bottom: 2rem;
        }

        h3 {
            font-size: clamp(1.25rem, 3vw, 1.5rem);
            margin-bottom: 1rem;
        }

        .hero {
            padding: 8rem 0 4rem;
            background: linear-gradient(to bottom, #f0f9ff, var(--background));
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }

        .hero h1 span {
            color: var(--primary);
            position: relative;
        }

        .hero p {
            font-size: 1.25rem;
            color: var(--text-light);
            margin-bottom: 2.5rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .search-container {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        @media (min-width: 768px) {
            .search-container {
                flex-direction: row;
                align-items: center;
            }
        }

        .search-box {
            position: relative;
            flex: 1;
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            width: 1.25rem;
            height: 1.25rem;
            color: var(--text-light);
        }

        .search-box input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 3rem;
            border: 1px solid #e2e8f0;
            border-radius: var(--radius);
            font-size: 1rem;
            transition: var(--transition);
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .advanced-filters {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 3rem;
            padding: 1.5rem;
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .filter-group label {
            font-weight: 500;
            color: var(--text-light);
        }

        .filter-group select,
        .filter-group input {
            padding: 0.5rem;
            border: 1px solid #e2e8f0;
            border-radius: var(--radius);
            font-size: 0.875rem;
        }
        .btn-primary,
        .btn-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            border-radius: var(--radius);
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background-color: var(--primary);
            color: var(--white);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background-color: var(--white);
            color: var(--primary);
            border: 1px solid var(--primary);
        }

        .btn-secondary:hover {
            background-color: rgba(37, 99, 235, 0.1);
            transform: translateY(-1px);
        }
        
        .search-box select {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 3rem;
            border: 1px solid #e2e8f0;
            border-radius: var(--radius);
            font-size: 0.87rem;
            appearance: none;
            background-color: white;
            cursor: pointer;
        }


        .search-box select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }
     </style>
<section class="hero" style="background:linear-gradient(90deg,#ffffff ,#93f593);">
    <div class="container">
        <div class="hero-content">
            <form id="searchForm" method="GET" action="">
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
                            <select name="domaine" aria-label="Domaine">
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
                        <button type="submit" class="btn-primary">Rechercher</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gérer la soumission du formulaire
    const form = document.getElementById('searchForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            // Vous pouvez ajouter ici une validation avant soumission
        });
    }

    // Conserver les valeurs des filtres après soumission
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.forEach((value, key) => {
        const input = document.querySelector(`[name="${key}"]`);
        if (input) {
            input.value = value;
        }
    });
});
</script>

