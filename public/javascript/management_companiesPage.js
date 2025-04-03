
// Gestion de la modale
document.querySelectorAll('.btn-edit').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        window.location.href = this.href + '&modal=true';
    });
});

// Si paramètre modal dans l'URL
if (window.location.search.includes('modal=true')) {
    document.getElementById('companyModal').style.display = 'flex';
    // Nettoyer l'URL
    history.replaceState({}, document.title, window.location.pathname + window.location.search.replace('&modal=true', ''));
}

// Fermer la modale en cliquant à l'extérieur
window.addEventListener('click', function(event) {
    if (event.target === document.getElementById('companyModal')) {
        document.getElementById('companyModal').style.display = 'none';
        // Retirer le paramètre edit de l'URL
        if (window.location.search.includes('edit=')) {
            history.replaceState({}, document.title, window.location.pathname);
        }
    }
});
