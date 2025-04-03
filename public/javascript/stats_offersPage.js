document.addEventListener('DOMContentLoaded', () => {
    // Récupérer les données depuis le HTML
    const skillsData = JSON.parse(document.getElementById('skillsData').textContent);
    const durationData = JSON.parse(document.getElementById('durationData').textContent);
    const topOffersData = JSON.parse(document.getElementById('topOffersData').textContent);

    // Initialiser les graphiques
    createSkillsChart(skillsData);
    createDurationChart(durationData);
    renderTopOffers(topOffersData);
});

function createSkillsChart(data) {
    const ctx = document.getElementById('skills-chart').getContext('2d');
    const labels = data.map(item => item.skill);
    const counts = data.map(item => item.count);

    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                data: counts,
                backgroundColor: [
                    '#22c55e',
                    '#16a34a',
                    '#15803d',
                    '#166534',
                    '#14532d'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.raw || 0;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = Math.round((value / total) * 100);
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });
}

function createDurationChart(data) {
    const ctx = document.getElementById('duration-chart').getContext('2d');
    const labels = data.map(item => item.duration_category);
    const counts = data.map(item => item.count);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Nombre de stages',
                data: counts,
                backgroundColor: '#16a34a',
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
}

function renderTopOffers(offers) {
    const container = document.getElementById('top-offers');
    
    container.innerHTML = `
        <div class="top-offers-grid">
            ${offers.map((offer, index) => `
                <div class="offer-card">
                    <div class="offer-number">${index + 1}</div>
                    <h3 class="offer-title">${offer.title}</h3>
                    <div class="company-info">
                        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        ${offer.company}
                    </div>
                    <div class="info-list">
                        <div class="info-item">
                            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                            </svg>
                            ${offer.applicantsCount} favoris
                        </div>
                        <div class="info-item">
                            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M12 6v6l4 2"></path>
                            </svg>
                            ${offer.start_date}
                        </div>
                        <div class="info-item">
                            ${offer.salary || 'Non spécifié'}
                        </div>
                    </div>
                    ${offer.skills.length > 0 ? `
                    <div class="skills-list">
                        ${offer.skills.map(skill => `
                            <span class="skill-badge">${skill}</span>
                        `).join('')}
                    </div>
                    ` : ''}
                </div>
            `).join('')}
        </div>
    `;
}