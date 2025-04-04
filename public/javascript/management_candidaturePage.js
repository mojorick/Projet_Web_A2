document.querySelectorAll('.remove-from-wishlist').forEach(button => {
    button.addEventListener('click', function(e) {
        if (!confirm('Êtes-vous sûr de vouloir retirer cette offre de votre liste de souhaits ?')) {
            e.preventDefault();
        }
    });
});