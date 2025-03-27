// DOM Elements
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

// Mobile menu toggle
menuToggle?.addEventListener('click', () => {
    menuToggle.classList.toggle('active');
    mobileMenu?.classList.toggle('active');
});

// Modal handling
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

// Close modals when clicking outside
window.addEventListener('click', (e) => {
    if (e.target === loginModal) closeModal(loginModal);
    if (e.target === registerModal) closeModal(registerModal);
});

// Form handling
loginForm?.addEventListener('submit', (e) => {
    e.preventDefault();
    const email = document.getElementById('loginEmail').value;
    const password = document.getElementById('loginPassword').value;
    
    // Add your authentication logic here
    console.log('Login attempt:', { email, password });
});

registerForm?.addEventListener('submit', (e) => {
    e.preventDefault();
    const name = document.getElementById('registerName').value;
    const email = document.getElementById('registerEmail').value;
    const password = document.getElementById('registerPassword').value;
    const role = document.getElementById('registerRole').value;
    
    // Add your registration logic here
    console.log('Registration attempt:', { name, email, password, role });
});

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
            // Close mobile menu if open
            menuToggle?.classList.remove('active');
            mobileMenu?.classList.remove('active');
        }
    });
});

// Intersection Observer for animations
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

// Observe all sections
document.querySelectorAll('section').forEach(section => {
    observer.observe(section);
});

// Search functionality
const searchInputs = document.querySelectorAll('.search-box input');
const searchButton = document.querySelector('.search-container .btn-primary');

searchButton?.addEventListener('click', () => {
    const [keyword, location, skills] = Array.from(searchInputs).map(input => input.value.trim());
    if (keyword || location || skills) {
        console.log('Searching for:', { keyword, location, skills });
        // Add your search logic here
    }
});

// Form validation
searchInputs.forEach(input => {
    input?.addEventListener('input', () => {
        input.classList.toggle('invalid', !input.value.trim());
    });
});

// Category card hover effects
document.querySelectorAll('.category-card').forEach(card => {
    const image = card.querySelector('.category-image img');
    
    card.addEventListener('mouseenter', () => {
        if (image) image.style.transform = 'scale(1.1)';
    });
    
    card.addEventListener('mouseleave', () => {
        if (image) image.style.transform = 'scale(1)';
    });
});

// PWA Installation
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

// Charts initialization (using Chart.js)
function initializeCharts() {
    // Sample data for charts
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

    // Initialize charts if Chart.js is loaded
    if (typeof Chart !== 'undefined') {
        // Sector Chart
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

        // Trends Chart
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

        // Skills Chart
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

        // Conversion Chart
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

// Initialize charts when the page loads
document.addEventListener('DOMContentLoaded', initializeCharts);

// Dynamic content loading
function loadLatestOffers() {
    const offersGrid = document.querySelector('.offers-grid');
    if (!offersGrid) return;

    // Sample offer data
    const offers = [
        {
            title: 'Développeur Full Stack',
            company: 'Tech Solutions',
            location: 'Paris',
            type: 'Stage de fin d\'études',
            duration: '6 mois',
            skills: ['React', 'Node.js', 'MongoDB']
        },
        // Add more offers here
    ];

    // Clear existing content
    offersGrid.innerHTML = '';

    // Add offers to the grid
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

// Load latest offers when the page loads
document.addEventListener('DOMContentLoaded', loadLatestOffers);

// Load evaluations
function loadEvaluations() {
    const evaluationsGrid = document.querySelector('.evaluations-grid');
    if (!evaluationsGrid) return;

    // Sample evaluation data
    const evaluations = [
        {
            company: 'Tech Solutions',
            rating: 4.5,
            comment: 'Excellent environnement de travail et projets intéressants',
            author: 'Jean D.',
            date: '2025-02-15'
        },
        // Add more evaluations here
    ];

    // Clear existing content
    evaluationsGrid.innerHTML = '';

    // Add evaluations to the grid
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

// Load evaluations when the page loads
document.addEventListener('DOMContentLoaded', loadEvaluations);