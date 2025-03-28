<header class="header">
    <style>
    :root {
        --primary: #158515;
        --primary-dark: #055c05;
        --primary-light: #1fc81f;
        --secondary: #64748b;
        --accent: #f97316;
        --background: #f8fafc;
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

        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: var(--white);
            box-shadow: var(--shadow);
            z-index: 1000;
            padding: 1rem 0;
        }

        header a{
            display: block;
            text-decoration: none;
            color: white;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 2rem;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
        }

        .logo-icon {
            width: 2rem;
            height: 2rem;
        }

        .nav-desktop {
            display: none;
        }

        @media (min-width: 1024px) {
            .nav-desktop {
                display: flex;
                gap: 2rem;
            }
        }

        .nav-group {
            position: relative;
        }

        .nav-link {
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: var(--radius);
            transition: var(--transition);
        }

        .nav-link:hover {
            color: var(--primary);
            background-color: rgba(37, 99, 235, 0.1);
        }

        .nav-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
            padding: 0.5rem;
            min-width: 200px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: var(--transition);
        }

        .nav-group:hover .nav-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .nav-dropdown a {
            display: block;
            padding: 0.75rem 1rem;
            color: var(--text);
            text-decoration: none;
            font-weight: 500;
            border-radius: var(--radius);
            transition: var(--transition);
        }

        .nav-dropdown a:hover {
            background-color: rgba(37, 99, 235, 0.1);
            color: var(--primary);
        }

        .auth-buttons {
            display: none;
        }

        @media (min-width: 1024px) {
            .auth-buttons {
                display: flex;
                gap: 1rem;
            }
        }

        .menu-toggle {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0.5rem;
        }

        @media (min-width: 1024px) {
            .menu-toggle {
                display: none;
            }
        }

        .menu-toggle span {
            display: block;
            width: 1.5rem;
            height: 2px;
            background-color: var(--text);
            transition: var(--transition);
        }

        .menu-toggle.active span:nth-child(1) {
            transform: translateY(8px) rotate(45deg);
        }

        .menu-toggle.active span:nth-child(2) {
            opacity: 0;
        }

        .menu-toggle.active span:nth-child(3) {
            transform: translateY(-8px) rotate(-45deg);
        }

        .nav-mobile {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: var(--white);
            padding: 1rem;
            box-shadow: var(--shadow);
            max-height: 80vh; 
            overflow-y: auto; 
            z-index: 1001; 
        }

        .nav-mobile.active {
            display: block;
        }

        .mobile-search {
            margin-bottom: 1rem;
        }

        .mobile-search input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e2e8f0;
            border-radius: var(--radius);
        }

        .mobile-section {
            margin-bottom: 1.5rem;
        }

        .mobile-section h3 {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-light);
            margin-bottom: 0.5rem;
        }

        .mobile-section a {
            display: block;
            padding: 0.75rem 0;
            color: var(--text);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .mobile-section a:hover {
            color: var(--primary);
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
    </style>
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <img src="https://raw.githubusercontent.com/lucide-icons/lucide/main/icons/graduation-cap.svg" alt="Logo" class="logo-icon">
                    <span>info for me</span>
                </div>
                <nav class="nav-desktop" aria-label="Navigation principale">
                    <div class="nav-group">
                        <a href="../accueil/accueil.php" class="nav-link" style="color: black;">Accueil</a>
                    </div>
                    <div class="nav-group">
                        <a href="../offres de stage/recherche.php" class="nav-link" style="color: black;">Offres de stage</a>
                        <div class="nav-dropdown">
                            <a href="../offres de stage/recherche.php">Rechercher un stage</a>
                            <a href="#statistiques-offres">Statistiques</a>
                        </div>
                    </div>
                    <div class="nav-group">
                        <a href="#entreprises" class="nav-link" style="color: black;">Entreprises</a>
                        <div class="nav-dropdown">
                            <a href="#liste-entreprises">Liste des entreprises</a>
                            <a href="#evaluations">Évaluations</a>
                            <a href="#statistiques-entreprises">Statistiques</a>
                        </div>
                    </div>
                    <div class="nav-group">
                        <a href="#espace-pilote" class="nav-link" style="color: black;">Espace Pilote</a>
                        <div class="nav-dropdown">
                            <a href="#suivi-candidatures">Suivi des candidatures</a>
                            <a href="#statistiques-promotion">Statistiques de promotion</a>
                        </div>
                    </div>
                    <div class="nav-group">
                        <a href="#espace-admin" class="nav-link" style="color: black;">Espace Administrateur</a>
                        <div class="nav-dropdown">
                            <a href="#gestion-utilisateurs">Gestion des utilisateurs</a>
                            <a href="#gestion-entreprises">Gestion des entreprises</a>
                            <a href="#gestion-offres">Gestion des offres de stage</a>
                            <a href="#gestion-candidatures">Gestion des candidatures</a>
                        </div>
                    </div>
                    <div class="nav-group">
                        <a href="#espace-entreprise" class="nav-link" style="color: black;">Espace Entreprise</a>
                        <div class="nav-dropdown">
                            <a href="../espace entreprise/creer-offre.php">Créer une offre</a>
                            <a href="../espace entreprise/modifier-offre.php">Modifier une offre</a>
                            <a href="../espace entreprise/supprimer-offre.php">Supprimer une offre</a>
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
                    <button class="btn-primary" id="registerBtn"><a href="enregistrement/enregistrement.php" style="color:white; text-decoration: none;">S'enregistrer</a></button>
                </div>
            </nav>
        </div>
        <script>
            const menuToggle = document.getElementById('menuToggle');
            const mobileMenu = document.getElementById('mobileMenu');
            const loginBtn = document.getElementById('loginBtn');
            const registerBtn = document.getElementById('registerBtn');
            const loginModal = document.getElementById('loginModal');
            const registerModal = document.getElementById('registerModal');
            const modalCloseButtons = document.querySelectorAll('.modal-close');
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            const installPwaButton = document.getElementById('installPwa');


            menuToggle?.addEventListener('click', () => {
                menuToggle.classList.toggle('active');
                mobileMenu?.classList.toggle('active');
                document.body.classList.toggle('menu-open', mobileMenu?.classList.contains('active'));
            });


            function openModal(modal) {
                if (modal) {
                    modal.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }
            }

            function closeModal(modal) {
                if (modal) {
                    modal.classList.remove('active');
                    document.body.style.overflow = '';
                }
            }

            loginBtn?.addEventListener('click', () => openModal(loginModal));
            registerBtn?.addEventListener('click', () => openModal(registerModal));

            modalCloseButtons.forEach(button => {
                button.addEventListener('click', () => {
                    closeModal(loginModal);
                    closeModal(registerModal);
                });
            });


            window.addEventListener('click', (e) => {
                if (e.target === loginModal) closeModal(loginModal);
                if (e.target === registerModal) closeModal(registerModal);
            });


            loginForm?.addEventListener('submit', (e) => {
                e.preventDefault();
                const email = document.getElementById('loginEmail').value;
                const password = document.getElementById('loginPassword').value;

                
                console.log('Login attempt:', { email, password });
            });

            registerForm?.addEventListener('submit', (e) => {
                e.preventDefault();
                const name = document.getElementById('registerName').value;
                const email = document.getElementById('registerEmail').value;
                const password = document.getElementById('registerPassword').value;
                const role = document.getElementById('registerRole').value;

                
                console.log('Registration attempt:', { name, email, password, role });
            });


            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                        
                        menuToggle?.classList.remove('active');
                        mobileMenu?.classList.remove('active');
                        document.body.classList.remove('menu-open');
                    }
                });
            });


            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-fade-in');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);


            document.querySelectorAll('section').forEach(section => {
                observer.observe(section);
            });


            const searchInputs = document.querySelectorAll('.search-box input');
            const searchButton = document.querySelector('.search-container .btn-primary');

            searchButton?.addEventListener('click', () => {
                const [keyword, location, skills] = Array.from(searchInputs).map(input => input.value.trim());
                if (keyword || location || skills) {
                    console.log('Searching for:', { keyword, location, skills });
                    
                }
            });


            searchInputs.forEach(input => {
                input?.addEventListener('input', () => {
                    input.classList.toggle('invalid', !input.value.trim());
                });
            });


            document.querySelectorAll('.category-card').forEach(card => {
                const image = card.querySelector('.category-image img');

                card.addEventListener('mouseenter', () => {
                    if (image) image.style.transform = 'scale(1.1)';
                });

                card.addEventListener('mouseleave', () => {
                    if (image) image.style.transform = 'scale(1)';
                });
            });

            let deferredPrompt;

            window.addEventListener('beforeinstallprompt', (e) => {
                e.preventDefault();
                deferredPrompt = e;
                installPwaButton?.classList.remove('hidden');
            });

            installPwaButton?.addEventListener('click', async () => {
                if (!deferredPrompt) return;

                deferredPrompt.prompt();
                const { outcome } = await deferredPrompt.userChoice;

                if (outcome === 'accepted') {
                    console.log('PWA installed');
                }

                deferredPrompt = null;
            });


            function initializeCharts() {
                
                const sectorData = {
                    labels: ['Informatique', 'Business', 'Ingénierie', 'Marketing', 'Autres'],
                    data: [30, 25, 20, 15, 10]
                };

                const trendsData = {
                    labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
                    data: [100, 120, 150, 140, 160, 180]
                };

                const skillsData = {
                    labels: ['JavaScript', 'Python', 'Java', 'React', 'Node.js'],
                    data: [80, 65, 60, 55, 50]
                };

                const conversionData = {
                    labels: ['Postulés', 'Entretiens', 'Acceptés'],
                    data: [100, 40, 20]
                };

                
                if (typeof Chart !== 'undefined') {
                    
                    const sectorChart = document.getElementById('sectorChart');
                    if (sectorChart) {
                        new Chart(sectorChart, {
                            type: 'doughnut',
                            data: {
                                labels: sectorData.labels,
                                datasets: [{
                                    data: sectorData.data,
                                    backgroundColor: [
                                        '#2563eb',
                                        '#3b82f6',
                                        '#60a5fa',
                                        '#93c5fd',
                                        '#bfdbfe'
                                    ]
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false
                            }
                        });
                    }

                    
                    const trendsChart = document.getElementById('trendsChart');
                    if (trendsChart) {
                        new Chart(trendsChart, {
                            type: 'line',
                            data: {
                                labels: trendsData.labels,
                                datasets: [{
                                    label: 'Nombre d\'offres',
                                    data: trendsData.data,
                                    borderColor: '#2563eb',
                                    tension: 0.4
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false
                            }
                        });
                    }

                    
                    const skillsChart = document.getElementById('skillsChart');
                    if (skillsChart) {
                        new Chart(skillsChart, {
                            type: 'bar',
                            data: {
                                labels: skillsData.labels,
                                datasets: [{
                                    label: 'Demande',
                                    data: skillsData.data,
                                    backgroundColor: '#2563eb'
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false
                            }
                        });
                    }

                    
                    const conversionChart = document.getElementById('conversionChart');
                    if (conversionChart) {
                        new Chart(conversionChart, {
                            type: 'bar',
                            data: {
                                labels: conversionData.labels,
                                datasets: [{
                                    label: 'Nombre de candidatures',
                                    data: conversionData.data,
                                    backgroundColor: '#2563eb'
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false
                            }
                        });
                    }
                }
            }


            document.addEventListener('DOMContentLoaded', initializeCharts);


            function loadLatestOffers() {
                const offersGrid = document.querySelector('.offers-grid');
                if (!offersGrid) return;

                
                const offers = [
                    {
                        title: 'Développeur Full Stack',
                        company: 'Tech Solutions',
                        location: 'Paris',
                        type: 'Stage de fin d\'études',
                        duration: '6 mois',
                        skills: ['React', 'Node.js', 'MongoDB']
                    },
                    
                ];

                
                offersGrid.innerHTML = '';

                
                offers.forEach(offer => {
                    const offerCard = document.createElement('div');
                    offerCard.className = 'offer-card';
                    offerCard.innerHTML = `
                        <h3>${offer.title}</h3>
                        <p class="company">${offer.company}</p>
                        <p class="location">${offer.location}</p>
                        <div class="offer-details">
                            <span>${offer.type}</span>
                            <span>${offer.duration}</span>
                        </div>
                        <div class="skills">
                            ${offer.skills.map(skill => `<span class="skill-tag">${skill}</span>`).join('')}
                        </div>
                        <button class="btn-primary">Postuler</button>
                    `;
                    offersGrid.appendChild(offerCard);
                });
            }


            document.addEventListener('DOMContentLoaded', loadLatestOffers);


            function loadEvaluations() {
                const evaluationsGrid = document.querySelector('.evaluations-grid');
                if (!evaluationsGrid) return;

                
                const evaluations = [
                    {
                        company: 'Tech Solutions',
                        rating: 4.5,
                        comment: 'Excellent environnement de travail et projets intéressants',
                        author: 'Jean D.',
                        date: '2025-02-15'
                    },
                    
                ];

                
                evaluationsGrid.innerHTML = '';

                
                evaluations.forEach(evaluation => {
                    const evaluationCard = document.createElement('div');
                    evaluationCard.className = 'evaluation-card';
                    evaluationCard.innerHTML = `
                        <div class="evaluation-header">
                            <h3>${evaluation.company}</h3>
                            <div class="rating">${'★'.repeat(Math.floor(evaluation.rating))}${evaluation.rating % 1 ? '½' : ''}</div>
                        </div>
                        <p class="comment">${evaluation.comment}</p>
                        <div class="evaluation-footer">
                            <span class="author">${evaluation.author}</span>
                            <span class="date">${new Date(evaluation.date).toLocaleDateString()}</span>
                        </div>
                    `;
                    evaluationsGrid.appendChild(evaluationCard);
                });
            }


            document.addEventListener('DOMContentLoaded', loadEvaluations);

        </script>
</header>