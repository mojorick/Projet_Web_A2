(function() {
    // Vérifie si le header est présent
    const header = document.querySelector('.header-container');
    if (!header) return;

    // Éléments du DOM
    const menuToggle = header.querySelector('#headerMenuToggle');
    const mobileMenu = header.querySelector('#headerMobileMenu');
    const userIcon = header.querySelector('#headerUserIcon');
    const userIconMobile = header.querySelector('#headerUserIconMobile');

    // Gestion du menu mobile
    if (menuToggle && mobileMenu) {
        menuToggle.addEventListener('click', function() {
            this.classList.toggle('active');
            mobileMenu.classList.toggle('active');
            document.body.classList.toggle('header-mobile-open');
        });
    }

    // Redirection profil
    const redirectToProfile = () => window.location.href = 'Profil';
    
    if (userIcon) userIcon.addEventListener('click', redirectToProfile);
    if (userIconMobile) userIconMobile.addEventListener('click', redirectToProfile);

    // Fermer le menu au clic sur un lien mobile
    const mobileLinks = header.querySelectorAll('.header__mobile-link');
    mobileLinks.forEach(link => {
        link.addEventListener('click', () => {
            menuToggle?.classList.remove('active');
            mobileMenu?.classList.remove('active');
            document.body.classList.remove('header-mobile-open');
        });
    });

    // Fermer le menu en cliquant à l'extérieur
    document.addEventListener('click', (e) => {
        if (!header.contains(e.target) && mobileMenu.classList.contains('active')) {
            menuToggle.classList.remove('active');
            mobileMenu.classList.remove('active');
            document.body.classList.remove('header-mobile-open');
        }
    });
})();