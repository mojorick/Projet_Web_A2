document.addEventListener('DOMContentLoaded', function() {
    const ROOT = window.ROOT || '';
    const pilotModal = document.getElementById('pilotModal');
    const pilotForm = document.getElementById('pilotForm');
    const closeModalBtn = document.getElementById('closeModal');
    const cancelBtn = document.getElementById('cancelButton');
    const searchInput = document.getElementById('searchInput');
    const searchButton = document.getElementById('searchButton');

    // Fonction de recherche
    function searchPilots() {
        const searchTerm = searchInput.value.trim();
        window.location.href = `${ROOT}Gestion_des_pilotes?search=${encodeURIComponent(searchTerm)}`;
    }

    // Événement de recherche
    searchButton.addEventListener('click', searchPilots);
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            searchPilots();
        }
    });

    // Fonction pour supprimer un pilote
    window.deletePilot = function(id) {
        if (confirm('Êtes-vous sûr de vouloir supprimer ce pilote ?')) {
            window.location.href = `${ROOT}Gestion_des_pilotes/supprimer/${id}`;
        }
    }

    // Fonction pour ouvrir la modal
    window.openModal = function(pilot = null) {
        if (pilot) {
            document.getElementById('modalTitle').textContent = 'Modifier Pilote';
            document.getElementById('pilotId').value = pilot.id;
            document.getElementById('lastName').value = pilot.nom;
            document.getElementById('firstName').value = pilot.prenom;
            document.getElementById('email').value = pilot.email;
            pilotForm.action = `${ROOT}Gestion_des_pilotes/modifier/${pilot.id}`;
        } else {
            document.getElementById('modalTitle').textContent = 'Nouveau Pilote';
            pilotForm.reset();
            document.getElementById('pilotId').value = '';
            pilotForm.action = `${ROOT}Gestion_des_pilotes/ajouter`;
        }
        
        pilotModal.classList.add('active');
    }

    // Fonction pour fermer la modal
    function closeModal() {
        pilotModal.classList.remove('active');
        pilotForm.reset();
    }

    if (closeModalBtn) closeModalBtn.addEventListener('click', closeModal);
    if (cancelBtn) cancelBtn.addEventListener('click', closeModal);

    // Fermer la modal en cliquant à l'extérieur
    pilotModal.addEventListener('click', function(e) {
        if (e.target === pilotModal) {
            closeModal();
        }
    });

    // Gestion de la soumission du formulaire
    pilotForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        
        fetch(this.action, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) {
                window.location.reload();
            } else {
                alert('Une erreur est survenue');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Une erreur est survenue');
        });
    });
});
