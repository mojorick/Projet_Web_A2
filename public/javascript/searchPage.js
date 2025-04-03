document.addEventListener('DOMContentLoaded', function() {
    const resultCards = document.querySelectorAll('.result-card');
    const offerDetails = document.querySelector('.offer-details');
    const offerContent = document.querySelector('.offer-content');
    const closeBtn = document.querySelector('.close-btn');

    function showOfferDetails(card) {
        const title = card.querySelector('h3').innerText;
        const details = card.querySelector('.details').innerHTML;
        const fullDescription = card.querySelector('.description').getAttribute('data-fulltext') || 
                              card.querySelector('.description').innerText;
        const internshipId = card.dataset.id || ''; // Récupérer l'ID de l'offre
        
        offerContent.innerHTML = `
            <h3>${title}</h3>
            <div class="details">${details}</div>
            <p class="description">${fullDescription}</p>
            <button class="btn-primary">
                <a href="./postuler?id=${internshipId}" 
                   style="text-decoration:none; color:white">Postuler</a>
            </button>
        `;
        
        offerDetails.style.display = 'block';
        setTimeout(() => {
            offerDetails.classList.add('active');
        }, 10);
    }
    
    function hideOfferDetails() {
        offerDetails.classList.remove('active');
        
        offerDetails.addEventListener('transitionend', () => {
            if (!offerDetails.classList.contains('active')) {
                offerDetails.style.display = 'none';
            }
        }, { once: true });
    }
    
    resultCards.forEach(card => {
        card.querySelector('.btn-secondary').addEventListener('click', (e) => {
            e.stopPropagation();
            showOfferDetails(card);
        });
    });
    
    closeBtn.addEventListener('click', hideOfferDetails);
    
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && offerDetails.classList.contains('active')) {
            hideOfferDetails();
        }
    });
});