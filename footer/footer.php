<footer class="footer">
    <style>
        /* Footer */
        .footer {
            padding: 4rem 0;
            background:rgb(1, 42, 1);
            color: var(--white);
            border-radius: 20px/15px;
            padding-bottom: 10px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 3rem;
            margin-bottom: 3rem;
        }

        .footer-brand {
            max-width: 300px;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .footer-logo img {
            width: 2rem;
            height: 2rem;
            filter: brightness(0) invert(1);
        }

        .pwa-download {
            margin-top: 2rem;
        }

        .footer-links h4 {
            font-size: 1.125rem;
            margin-bottom: 1.5rem;
        }

        .footer-links ul {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.75rem;
        }

        .footer-links a {
            color: #94a3b8;
            text-decoration: none;
            transition: var(--transition);
        }

        .footer-links a:hover {
            color: var(--white);
        }

        .footer-bottom {
            padding-top: 2rem;
            border-top: 1px solid #334155;
            text-align: center;
        }

        .footer-bottom p {
            color: #94a3b8;
            margin-bottom: 0.5rem;
        }

        /* Modals */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1100;
            padding: 1rem;
        }

        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: var(--white);
            padding: 2rem;
            border-radius: var(--radius);
            max-width: 500px;
            width: 100%;
            position: relative;
        }

        .modal-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--text-light);
        }

        .auth-form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .form-group label {
            font-weight: 500;
        }

        .form-group input,
        .form-group select {
            padding: 0.75rem;
            border: 1px solid #e2e8f0;
            border-radius: var(--radius);
            font-size: 1rem;
        }
    </style>
        <div class="container">
            <div class="footer-grid" style="text-align: center;">
                <div class="footer-brand" style="margin-left:16.5%">
                    <div class="footer-logo">
                        <img src="https://raw.githubusercontent.com/lucide-icons/lucide/main/icons/graduation-cap.svg" alt="Logo" class="logo-icon">
                        <span>CESI Stages</span>
                    </div>
                    <p>La plateforme qui connecte les étudiants aux meilleures opportunités de stage.</p>
                    <div class="pwa-download">
                        <p>Téléchargez notre application</p>
                        <button class="btn-secondary" id="installPwa" style="margin-top:2%;">Installer l'application</button>
                    </div>
                </div>
                <div class="footer-links">
                    <h4>Navigation</h4>
                    <ul>
                        <li><a href="../accueil/accueil.php">Accueil</a></li>
                        <li><a href="#">Offres de stage</a></li>
                        <li><a href="#">Entreprises</a></li>
                        <li><a href="#">Espace étudiant</a></li>
                        <li><a href="#">Espace Entreprises</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h4>Ressources</h4>
                    <ul>
                        <li><a href="#">Centre d'aide</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h4>Légal</h4>
                    <ul>
                        <li><a href="#">Mentions légales</a></li>
                        <li><a href="#">Politique de confidentialité</a></li>
                        <li><a href="#">CGU</a></li>
                        <li><a href="#">Accessibilité</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© 2025 CESI Stages. Tous droits réservés.</p>
                <p>Version 2.0.0 - Dernière mise à jour : 01/03/2025</p>
            </div>
        </div>
    </footer>