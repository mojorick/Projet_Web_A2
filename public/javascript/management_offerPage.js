// management_offerPage.js
document.addEventListener('DOMContentLoaded', function() {
    // Gestion de la recherche
    const searchInput = document.getElementById('search');
    searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const cards = document.querySelectorAll('.internship-card');
        
        cards.forEach(card => {
            const title = card.querySelector('.internship-title').textContent.toLowerCase();
            const company = card.querySelector('.internship-company').textContent.toLowerCase();
            const description = card.querySelector('.internship-description').textContent.toLowerCase();
            
            const isVisible = title.includes(searchTerm) || 
                            company.includes(searchTerm) || 
                            description.includes(searchTerm);
            
            card.style.display = isVisible ? 'block' : 'none';
        });
    });

    // Gestion du modal
    const modal = document.getElementById('offer-modal');
    const newOfferBtn = document.getElementById('new-offer-btn');
    const closeBtns = document.querySelectorAll('.close-btn');
    const cancelBtn = document.getElementById('cancel-btn');
    const offerForm = document.getElementById('offer-form');

    function openModal() {
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        modal.classList.remove('active');
        document.body.style.overflow = '';
        offerForm.reset();
    }

    // Nouvelle offre
    newOfferBtn.addEventListener('click', () => {
        offerForm.reset();
        offerForm.querySelector('input[name="action"]').value = 'create';
        modal.querySelector('h2').textContent = 'Nouvelle offre';
        offerForm.querySelector('button[type="submit"]').textContent = 'Créer l\'offre';
        openModal();
    });

    // Fermeture du modal
    closeBtns.forEach(btn => btn.addEventListener('click', closeModal));
    cancelBtn.addEventListener('click', closeModal);

    // Gestion du formulaire
    offerForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(offerForm);
        const action = formData.get('action');
        
        try {
            const response = await fetch('Gestion_des_offres_de_stage', {
                method: 'POST',
                body: formData
            });

            if (!response.ok) throw new Error('Erreur lors de la soumission');
            
            const result = await response.json();
            if (result.success) {
                alert(action === 'create' ? 'Offre créée avec succès' : 'Offre mise à jour avec succès');
                window.location.reload();
            } else {
                throw new Error(result.message || 'Une erreur est survenue');
            }
        } catch (error) {
            alert(error.message);
        }
    });

    // Modification d'une offre
    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', async function() {
            const card = this.closest('.internship-card');
            const id = card.dataset.id;
            
            try {
                const response = await fetch(`Gestion_des_offres_de_stage?action=get&id=${id}`);
                if (!response.ok) throw new Error('Erreur de récupération');
                
                const data = await response.json();
                if (!data) throw new Error('Données non trouvées');

                // Remplissage du formulaire
                offerForm.querySelector('input[name="id"]').value = id;
                offerForm.querySelector('input[name="action"]').value = 'update';
                offerForm.querySelector('input[name="title"]').value = data.title;
                offerForm.querySelector('input[name="company"]').value = data.company;
                offerForm.querySelector('textarea[name="short_description"]').value = data.short_description;
                offerForm.querySelector('textarea[name="full_description"]').value = data.full_description;
                offerForm.querySelector('input[name="competence"]').value = data.competence;
                offerForm.querySelector('input[name="salary_base"]').value = data.salary_base;
                offerForm.querySelector('input[name="start_date"]').value = data.start_date.split(' ')[0];
                offerForm.querySelector('input[name="end_date"]').value = data.end_date.split(' ')[0];
                offerForm.querySelector('input[name="location"]').value = data.location;
                offerForm.querySelector('select[name="type"]').value = data.type;
                offerForm.querySelector('select[name="domaine"]').value = data.domaine;
                offerForm.querySelector('select[name="remote"]').value = data.remote;
                offerForm.querySelector('textarea[name="company_description"]').value = data.company_description;

                modal.querySelector('h2').textContent = 'Modifier l\'offre';
                offerForm.querySelector('button[type="submit"]').textContent = 'Mettre à jour';
                openModal();
            } catch (error) {
                alert('Erreur lors de la récupération des données : ' + error.message);
            }
        });
    });

    // Suppression d'une offre
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', async function() {
            if (!confirm('Êtes-vous sûr de vouloir supprimer cette offre ?')) return;
            
            const card = this.closest('.internship-card');
            const id = card.dataset.id;
            
            try {
                const response = await fetch(`Gestion_des_offres_de_stage?action=delete&id=${id}`);
                if (!response.ok) throw new Error('Erreur de suppression');
                
                const result = await response.json();
                if (result.success) {
                    card.remove();
                    alert('Offre supprimée avec succès');
                } else {
                    throw new Error(result.message || 'Erreur lors de la suppression');
                }
            } catch (error) {
                alert(error.message);
            }
        });
    });
});
