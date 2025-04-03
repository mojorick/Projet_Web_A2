// État global
let availableOffers = [];
let wishlist = [];
let applications = [];
let selectedOffer = null;

// Sélecteurs DOM
const availableOffersContainer = document.getElementById('availableOffersContainer');
const availableOffersCounter = document.getElementById('availableOffersCounter');
const wishlistContainer = document.getElementById('wishlistContainer');
const wishlistCounter = document.getElementById('wishlistCounter');
const applicationsContainer = document.getElementById('applicationsContainer');
const applicationsCounter = document.getElementById('applicationsCounter');
const applicationModal = document.getElementById('applicationModal');
const coverLetterModal = document.getElementById('coverLetterModal');
const contactModal = document.getElementById('contactModal');
const applicationForm = document.getElementById('applicationForm');
const contactForm = document.getElementById('contactForm');

// Fonctions de rendu
function renderAvailableOffers() {
    availableOffersCounter.textContent = `${availableOffers.length} offre${availableOffers.length > 1 ? 's' : ''}`;
    
    availableOffersContainer.innerHTML = availableOffers.map(offer => `
        <div class="offer-card">
            <div class="offer-card-header">
                <h3 class="offer-card-title">${offer.title}</h3>
                <p class="offer-card-company">
                    <span>🏢</span> ${offer.company}
                </p>
            </div>
            <div class="offer-card-content">
                <div class="info-grid">
                    <p>📍 ${offer.location}</p>
                    <p>💰 ${offer.salary_base}</p>
                    <p>📅 ${formatDate(offer.start_date)}</p>
                    <p>🔄 ${offer.type}</p>
                </div>
                <p class="offer-card-description">${offer.short_description}</p>
                <div class="skills-list">
                    ${offer.competence.split(',').map(skill => 
                        `<span class="skill-tag">${skill.trim()}</span>`
                    ).join('')}
                </div>
            </div>
            <div class="offer-card-footer">
                <button class="btn btn-primary" onclick="openApplicationModal(${offer.id}, 'available')">
                    📝 Postuler
                </button>
                <button class="btn btn-secondary" onclick="addToWishlist(${offer.id})">
                    ❤️ Favoris
                </button>
            </div>
        </div>
    `).join('');
}

function renderWishlist() {
    wishlistCounter.textContent = `${wishlist.length} offre${wishlist.length > 1 ? 's' : ''}`;
    
    wishlistContainer.innerHTML = wishlist.map(offer => `
        <div class="wish-card">
            <div class="wish-card-header">
                <h3 class="wish-card-title">${offer.title}</h3>
                <p class="wish-card-company">
                    <span>🏢</span> ${offer.company}
                </p>
            </div>
            <div class="wish-card-content">
                <div class="info-grid">
                    <p>📍 ${offer.location}</p>
                    <p>💰 ${offer.salary_base}</p>
                    <p>📅 ${formatDate(offer.start_date)}</p>
                    <p>🔄 ${offer.type}</p>
                </div>
                <p class="wish-card-description">${offer.short_description}</p>
                <div class="skills-list">
                    ${offer.competence.split(',').map(skill => 
                        `<span class="skill-tag">${skill.trim()}</span>`
                    ).join('')}
                </div>
            </div>
            <div class="wish-card-footer">
                <button class="btn btn-primary" onclick="openApplicationModal(${offer.id}, 'wishlist')">
                    📝 Postuler
                </button>
                <button class="btn btn-danger" onclick="removeFromWishlist(${offer.id})">
                    ❌ Retirer
                </button>
            </div>
        </div>
    `).join('');
}

function renderApplications() {
    applicationsCounter.textContent = `${applications.length} candidature${applications.length > 1 ? 's' : ''}`;
    
    applicationsContainer.innerHTML = applications.map(app => `
        <tr>
            <td>
                <div class="company-info">
                    <strong>${app.company}</strong>
                </div>
            </td>
            <td>${app.position}</td>
            <td>${formatDate(app.created_at)}</td>
            <td>
                <div class="flex space-x-2">
                    <button class="btn btn-secondary btn-sm" onclick="viewCoverLetter(${app.id})">
                        📄 LM
                    </button>
                    <a href="${ROOT}uploads/cv/${app.cv_file}" 
                       class="btn btn-secondary btn-sm" 
                       target="_blank">
                        📥 CV
                    </a>
                </div>
            </td>
            <td>
                <span class="status-badge status-${app.status}">
                    ${getStatusText(app.status)}
                </span>
            </td>
            <td>
                <button class="btn btn-secondary btn-sm" onclick="openContactModal(${app.id})">
                    ✉️ Contact
                </button>
            </td>
        </tr>
    `).join('');
}

// Fonctions utilitaires
function formatDate(dateString) {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(dateString).toLocaleDateString('fr-FR', options);
}

function getStatusText(status) {
    const statusMap = {
        pending: 'En attente',
        accepted: 'Acceptée',
        rejected: 'Refusée'
    };
    return statusMap[status] || status;
}

// Fonctions API
async function fetchAvailableOffers() {
    try {
        const response = await fetch(`${ROOT}api/internships`);
        if (!response.ok) throw new Error('Erreur lors de la récupération des offres');
        availableOffers = await response.json();
        renderAvailableOffers();
    } catch (error) {
        console.error('Erreur:', error);
        showError('Impossible de charger les offres disponibles');
    }
}

async function fetchWishlist() {
    try {
        const response = await fetch(`${ROOT}api/wishlist`);
        if (!response.ok) throw new Error('Erreur lors de la récupération de la liste de souhaits');
        wishlist = await response.json();
        renderWishlist();
    } catch (error) {
        console.error('Erreur:', error);
        showError('Impossible de charger la liste de souhaits');
    }
}

async function fetchApplications() {
    try {
        const response = await fetch(`${ROOT}api/applications`);
        if (!response.ok) throw new Error('Erreur lors de la récupération des candidatures');
        applications = await response.json();
        renderApplications();
    } catch (error) {
        console.error('Erreur:', error);
        showError('Impossible de charger les candidatures');
    }
}

// Gestionnaires d'événements
async function addToWishlist(id) {
    try {
        const response = await fetch(`${ROOT}api/wishlist`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ internship_id: id })
        });

        if (!response.ok) throw new Error('Erreur lors de l\'ajout aux favoris');
        
        await fetchWishlist();
        showSuccess('Offre ajoutée aux favoris');
    } catch (error) {
        console.error('Erreur:', error);
        showError('Impossible d\'ajouter l\'offre aux favoris');
    }
}

async function removeFromWishlist(id) {
    if (!confirm('Voulez-vous vraiment retirer cette offre de votre liste ?')) return;

    try {
        const response = await fetch(`${ROOT}api/wishlist`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ internship_id: id })
        });

        if (!response.ok) throw new Error('Erreur lors de la suppression des favoris');
        
        await fetchWishlist();
        showSuccess('Offre retirée des favoris');
    } catch (error) {
        console.error('Erreur:', error);
        showError('Impossible de retirer l\'offre des favoris');
    }
}

function openApplicationModal(offerId, source) {
    selectedOffer = source === 'wishlist' 
        ? wishlist.find(offer => offer.id === offerId)
        : availableOffers.find(offer => offer.id === offerId);
        
    if (selectedOffer) {
        document.querySelector('#applicationModal .modal-header h3').textContent = 
            `Postuler chez ${selectedOffer.company}`;
        document.getElementById('internshipId').value = selectedOffer.id;
        applicationModal.classList.add('active');
    }
}

function closeModal() {
    applicationModal.classList.remove('active');
    applicationForm.reset();
    selectedOffer = null;
}

async function viewCoverLetter(applicationId) {
    try {
        const response = await fetch(`${ROOT}api/applications/${applicationId}/cover-letter`);
        if (!response.ok) throw new Error('Erreur lors de la récupération de la lettre de motivation');
        
        const data = await response.json();
        document.getElementById('coverLetterContent').textContent = data.cover_letter;
        coverLetterModal.classList.add('active');
    } catch (error) {
        console.error('Erreur:', error);
        showError('Impossible de charger la lettre de motivation');
    }
}

function closeCoverLetterModal() {
    coverLetterModal.classList.remove('active');
}

async function openContactModal(applicationId) {
    try {
        const application = applications.find(app => app.id === applicationId);
        if (!application) throw new Error('Application non trouvée');

        const response = await fetch(`${ROOT}api/internships/${application.internship_id}`);
        if (!response.ok) throw new Error('Erreur lors de la récupération des informations de contact');
        
        const internship = await response.json();
        
        document.getElementById('contactCompanyName').textContent = internship.company;
        document.getElementById('contactName').textContent = `${internship.contact_name || 'Non spécifié'}`;
        document.getElementById('contactRole').textContent = internship.contact_role || 'Non spécifié';
        document.getElementById('contactEmail').textContent = internship.contact_email || 'Non spécifié';
        document.getElementById('contactPhone').textContent = internship.contact_phone || 'Non spécifié';
        
        document.getElementById('messageSubject').value = 
            `RE: Candidature - ${application.position}`;
        
        contactModal.classList.add('active');
    } catch (error) {
        console.error('Erreur:', error);
        showError('Impossible de charger les informations de contact');
    }
}

function closeContactModal() {
    contactModal.classList.remove('active');
    contactForm.reset();
}

// Gestionnaires de formulaires
applicationForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    
    try {
        const formData = new FormData(e.target);
        
        const response = await fetch(`${ROOT}api/applications`, {
            method: 'POST',
            body: formData
        });

        if (!response.ok) throw new Error('Erreur lors de l\'envoi de la candidature');
        
        closeModal();
        await fetchApplications();
        showSuccess('Candidature envoyée avec succès');
    } catch (error) {
        console.error('Erreur:', error);
        showError('Impossible d\'envoyer la candidature');
    }
});

contactForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    
    try {
        const formData = new FormData(e.target);
        
        const response = await fetch(`${ROOT}api/contact`, {
            method: 'POST',
            body: formData
        });

        if (!response.ok) throw new Error('Erreur lors de l\'envoi du message');
        
        closeContactModal();
        showSuccess('Message envoyé avec succès');
    } catch (error) {
        console.error('Erreur:', error);
        showError('Impossible d\'envoyer le message');
    }
});

// Gestionnaire pour la zone de téléchargement de fichier
document.getElementById('fileUploadZone').addEventListener('click', () => {
    document.getElementById('cvFile').click();
});

document.getElementById('cvFile').addEventListener('change', (e) => {
    const fileName = e.target.files[0]?.name;
    document.getElementById('fileNameDisplay').textContent = 
        fileName ? `📎 ${fileName}` : '📎 Choisir un fichier';
});

// Notifications
function showSuccess(message) {
    // Implement your notification system here
    alert(message); // Temporary implementation
}

function showError(message) {
    // Implement your notification system here
    alert('Erreur: ' + message); // Temporary implementation
}

// Initialisation
document.addEventListener('DOMContentLoaded', () => {
    fetchAvailableOffers();
    fetchWishlist();
    fetchApplications();
});