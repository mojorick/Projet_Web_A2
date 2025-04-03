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


menuToggle?.addEventListener('click', () => {
    menuToggle.classList.toggle('active');
    mobileMenu?.classList.toggle('active');
    document.body.classList.toggle('menu-open', mobileMenu?.classList.contains('active'));
});


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


window.addEventListener('click', (e) => {
    if (e.target === loginModal) closeModal(loginModal);
    if (e.target === registerModal) closeModal(registerModal);
});


loginForm?.addEventListener('submit', (e) => {
    e.preventDefault();
    const email = document.getElementById('loginEmail').value;
    const password = document.getElementById('loginPassword').value;

    
    console.log('Login attempt:', { email, password });
});

registerForm?.addEventListener('submit', (e) => {
    e.preventDefault();
    const name = document.getElementById('registerName').value;
    const email = document.getElementById('registerEmail').value;
    const password = document.getElementById('registerPassword').value;
    const role = document.getElementById('registerRole').value;

    
    console.log('Registration attempt:', { name, email, password, role });
});


document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
            
            menuToggle?.classList.remove('active');
            mobileMenu?.classList.remove('active');
            document.body.classList.remove('menu-open');
        }
    });
});


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


document.querySelectorAll('section').forEach(section => {
    observer.observe(section);
});


const searchInputs = document.querySelectorAll('.search-box input');
const searchButton = document.querySelector('.search-container .btn-primary');

searchButton?.addEventListener('click', () => {
    const [keyword, location, skills] = Array.from(searchInputs).map(input => input.value.trim());
    if (keyword || location || skills) {
        console.log('Searching for:', { keyword, location, skills });
        
    }
});


searchInputs.forEach(input => {
    input?.addEventListener('input', () => {
        input.classList.toggle('invalid', !input.value.trim());
    });
});


document.querySelectorAll('.category-card').forEach(card => {
    const image = card.querySelector('.category-image img');

    card.addEventListener('mouseenter', () => {
        if (image) image.style.transform = 'scale(1.1)';
    });

    card.addEventListener('mouseleave', () => {
        if (image) image.style.transform = 'scale(1)';
    });
});

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


function initializeCharts() {
    
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

    
    if (typeof Chart !== 'undefined') {
        
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


document.addEventListener('DOMContentLoaded', initializeCharts);


function loadLatestOffers() {
    const offersGrid = document.querySelector('.offers-grid');
    if (!offersGrid) return;

    
    const offers = [
        {
            title: 'Développeur Full Stack',
            company: 'Tech Solutions',
            location: 'Paris',
            type: 'Stage de fin d\'études',
            duration: '6 mois',
            skills: ['React', 'Node.js', 'MongoDB']
        },
        
    ];

    
    offersGrid.innerHTML = '';

    
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


document.addEventListener('DOMContentLoaded', loadLatestOffers);


function loadEvaluations() {
    const evaluationsGrid = document.querySelector('.evaluations-grid');
    if (!evaluationsGrid) return;

    
    const evaluations = [
        {
            company: 'Tech Solutions',
            rating: 4.5,
            comment: 'Excellent environnement de travail et projets intéressants',
            author: 'Jean D.',
            date: '2025-02-15'
        },
        
    ];

    
    evaluationsGrid.innerHTML = '';

    
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


document.addEventListener('DOMContentLoaded', loadEvaluations);


document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.feature-card');
    
    // Calcul des hauteurs individuelles
    cards.forEach(card => {
        const contentHeight = card.scrollHeight;
        card.style.setProperty('--full-height', `${contentHeight}px`);
        
        // Animation d'apparition initiale
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px) rotateX(10deg)';
        
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0) rotateX(0)';
        }, 100);
    });
});