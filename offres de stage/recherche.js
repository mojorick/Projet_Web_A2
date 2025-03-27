document.addEventListener('DOMContentLoaded', function() {
    const resultCards = document.querySelectorAll('.result-card');
    const offerDetails = document.querySelector('.offer-details');
    const offerContent = document.querySelector('.offer-content');
    const closeBtn = document.querySelector('.close-btn');
    const header = document.querySelector('header');
    
    // Détection du scroll pour desktop
    function handleScroll() {
        if (window.innerWidth > 768 && offerDetails.classList.contains('active')) {
            const headerHeight = header.offsetHeight;
            const detailRect = offerDetails.getBoundingClientRect();
            
            if (detailRect.top <= headerHeight) {
                offerDetails.classList.add('scrolled');
            } else {
                offerDetails.classList.remove('scrolled');
            }
        }
    }

    window.addEventListener('scroll', handleScroll);

    function showOfferDetails(card) {
        // Récupération du contenu
        const title = card.querySelector('h3').innerText;
        const details = card.querySelector('.details').innerHTML;
        const fullDescription = card.querySelector('.description').getAttribute('data-fulltext') || 
                              card.querySelector('.description').innerText;
        
        // Injection du contenu
        offerContent.innerHTML = `
            <h3>${title}</h3>
            <div class="details">${details}</div>
            <p class="description">${fullDescription}</p>
            <button class="btn-primary"><a href="../postuler/postuler.php" style="text-decoration:none; color:white">Postuler</a></button>
        `;
        
        // Affichage du panneau
        offerDetails.style.display = 'block'; // Force l'affichage
        offerDetails.classList.add('active');
        offerDetails.classList.remove('scrolled');
        
        // Gestion mobile
        if (window.innerWidth <= 768) {
            const overlay = document.createElement('div');
            overlay.className = 'overlay';
            overlay.addEventListener('click', hideOfferDetails);
            document.body.appendChild(overlay);
            document.body.style.overflow = 'hidden';
        } else {
            // Sur desktop, on recalcule la position
            setTimeout(() => {
                const headerHeight = header.offsetHeight;
                const detailTop = offerDetails.getBoundingClientRect().top;
                
                if (detailTop < headerHeight) {
                    window.scrollBy({
                        top: detailTop - headerHeight - 10,
                        behavior: 'smooth'
                    });
                }
            }, 50);
        }
    }
    
    function hideOfferDetails() {
        offerDetails.classList.remove('active', 'scrolled');
        offerDetails.style.display = 'none'; // Cache complètement
        
        if (window.innerWidth <= 768) {
            const overlay = document.querySelector('.overlay');
            if (overlay) overlay.remove();
            document.body.style.overflow = '';
        }
    }
    
    // Écouteurs d'événements
    resultCards.forEach(card => {
        const btn = card.querySelector('.btn-secondary');
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            showOfferDetails(card);
        });
    });
    
    closeBtn.addEventListener('click', hideOfferDetails);
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && offerDetails.classList.contains('active')) {
            hideOfferDetails();
        }
    });
    
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            const overlay = document.querySelector('.overlay');
            if (overlay) overlay.remove();
            document.body.style.overflow = '';
        }
    });
});