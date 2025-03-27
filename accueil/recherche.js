
const entreprises = [
    { id: 1, nom: "TechInnovate", description: "Spécialisée dans les solutions technologiques innovantes.", domaine: "Informatique & Digital" },
    { id: 2, nom: "CyberShield Solutions", description: "Leader en cybersécurité et protection des données.", domaine: "Informatique & Digital" },
    { id: 3, nom: "DataPioneers", description: "Experts en analyse de données et intelligence artificielle.", domaine: "Informatique & Digital" },
    { id: 4, nom: "CloudMasters", description: "Fournisseur de services cloud sécurisés et évolutifs.", domaine: "Informatique & Digital" },
    { id: 5, nom: "CodeCrafters", description: "Développement de logiciels sur mesure pour les entreprises.", domaine: "Informatique & Digital" },
    { id: 6, nom: "DevGenius", description: "Création d'applications web et mobiles hautement performantes.", domaine: "Informatique & Digital" },
    { id: 7, nom: "AI Nexus", description: "Spécialiste en intelligence artificielle et machine learning.", domaine: "Informatique & Digital" },
    { id: 8, nom: "BlockChain Experts", description: "Solutions blockchain pour la sécurité et la transparence.", domaine: "Informatique & Digital" },
    { id: 9, nom: "WebWizards", description: "Conception de sites web modernes et réactifs.", domaine: "Informatique & Digital" },
    { id: 10, nom: "DataFlow", description: "Gestion et analyse de flux de données en temps réel.", domaine: "Informatique & Digital" },
    { id: 11, nom: "SoftTech Solutions", description: "Développement de logiciels d'entreprise sur mesure.", domaine: "Informatique & Digital" },
    { id: 12, nom: "NetSecure", description: "Solutions de sécurité réseau pour les entreprises.", domaine: "Informatique & Digital" },
    { id: 13, nom: "PixelCraft", description: "Design et développement d'interfaces utilisateur.", domaine: "Informatique & Digital" },
    { id: 14, nom: "CodeNinjas", description: "Experts en développement agile et méthodologies DevOps.", domaine: "Informatique & Digital" },
    { id: 15, nom: "DataMinds", description: "Analyse de données et business intelligence.", domaine: "Informatique & Digital" },
    { id: 16, nom: "CloudNova", description: "Migration et gestion de solutions cloud.", domaine: "Informatique & Digital" },
    { id: 17, nom: "TechForge", description: "Innovation technologique pour les startups.", domaine: "Informatique & Digital" },
    { id: 18, nom: "SecureNet", description: "Protection des réseaux et des systèmes d'information.", domaine: "Informatique & Digital" },
    { id: 19, nom: "FutureCode", description: "Développement de logiciels pour l'industrie 4.0.", domaine: "Informatique & Digital" },
    { id: 20, nom: "DataDriven", description: "Solutions basées sur les données pour la prise de décision.", domaine: "Informatique & Digital" },
    { id: 21, nom: "CodeHive", description: "Développement collaboratif de logiciels open source.", domaine: "Informatique & Digital" },
    { id: 22, nom: "TechPulse", description: "Veille technologique et innovation continue.", domaine: "Informatique & Digital" },
    { id: 23, nom: "CloudForge", description: "Développement de solutions cloud personnalisées.", domaine: "Informatique & Digital" },
    { id: 24, nom: "DataCraft", description: "Transformation des données en insights actionnables.", domaine: "Informatique & Digital" },
    { id: 25, nom: "CodeWave", description: "Développement de logiciels en mode agile.", domaine: "Informatique & Digital" },
    { id: 26, nom: "TechNest", description: "Incubateur de startups technologiques.", domaine: "Informatique & Digital" },
    { id: 27, nom: "DataSphere", description: "Gestion de big data et analytique avancée.", domaine: "Informatique & Digital" },
    { id: 28, nom: "CloudPioneers", description: "Pionniers des solutions cloud hybrides.", domaine: "Informatique & Digital" },
    { id: 29, nom: "CodeVortex", description: "Développement de logiciels hautement performants.", domaine: "Informatique & Digital" },
    { id: 30, nom: "TechHive", description: "Innovation et développement technologique.", domaine: "Informatique & Digital" },
    { id: 31, nom: "DataNest", description: "Solutions de stockage et gestion de données.", domaine: "Informatique & Digital" },
    { id: 32, nom: "CloudHaven", description: "Hébergement cloud sécurisé et scalable.", domaine: "Informatique & Digital" },
    { id: 33, nom: "CodeForge", description: "Développement de logiciels sur mesure.", domaine: "Informatique & Digital" },
    { id: 34, nom: "TechPulse", description: "Veille technologique et innovation continue.", domaine: "Informatique & Digital" },
    { id: 35, nom: "DataForge", description: "Transformation des données en insights actionnables.", domaine: "Informatique & Digital" },
    { id: 36, nom: "CloudNest", description: "Solutions cloud pour les entreprises.", domaine: "Informatique & Digital" },
    { id: 37, nom: "CodeSphere", description: "Développement de logiciels en mode agile.", domaine: "Informatique & Digital" },
    { id: 38, nom: "TechForge", description: "Innovation technologique pour les startups.", domaine: "Informatique & Digital" },
    { id: 39, nom: "DataWave", description: "Gestion de big data et analytique avancée.", domaine: "Informatique & Digital" },
    { id: 40, nom: "CloudPulse", description: "Pionniers des solutions cloud hybrides.", domaine: "Informatique & Digital" },
    { id: 41, nom: "CodeNest", description: "Développement de logiciels hautement performants.", domaine: "Informatique & Digital" },
    { id: 42, nom: "TechSphere", description: "Innovation et développement technologique.", domaine: "Informatique & Digital" },
    { id: 43, nom: "DataHive", description: "Solutions de stockage et gestion de données.", domaine: "Informatique & Digital" },
    { id: 44, nom: "CloudForge", description: "Hébergement cloud sécurisé et scalable.", domaine: "Informatique & Digital" },
    { id: 45, nom: "CodePulse", description: "Développement de logiciels sur mesure.", domaine: "Informatique & Digital" },
    { id: 46, nom: "TechWave", description: "Veille technologique et innovation continue.", domaine: "Informatique & Digital" },
    { id: 47, nom: "DataForge", description: "Transformation des données en insights actionnables.", domaine: "Informatique & Digital" },
    { id: 48, nom: "CloudNest", description: "Solutions cloud pour les entreprises.", domaine: "Informatique & Digital" },
    { id: 49, nom: "CodeSphere", description: "Développement de logiciels en mode agile.", domaine: "Informatique & Digital" },
    { id: 50, nom: "TechForge", description: "Innovation technologique pour les startups.", domaine: "Informatique & Digital" },
    { id: 51, nom: "DataWave", description: "Gestion de big data et analytique avancée.", domaine: "Informatique & Digital" },
    { id: 52, nom: "CloudPulse", description: "Pionniers des solutions cloud hybrides.", domaine: "Informatique & Digital" },
    { id: 53, nom: "CodeNest", description: "Développement de logiciels hautement performants.", domaine: "Informatique & Digital" },
    { id: 54, nom: "TechSphere", description: "Innovation et développement technologique.", domaine: "Informatique & Digital" },
    { id: 55, nom: "DataHive", description: "Solutions de stockage et gestion de données.", domaine: "Informatique & Digital" },
    { id: 56, nom: "CloudForge", description: "Hébergement cloud sécurisé et scalable.", domaine: "Informatique & Digital" },
    { id: 57, nom: "CodePulse", description: "Développement de logiciels sur mesure.", domaine: "Informatique & Digital" },
    { id: 58, nom: "TechWave", description: "Veille technologique et innovation continue.", domaine: "Informatique & Digital" },
    { id: 59, nom: "DataForge", description: "Transformation des données en insights actionnables.", domaine: "Informatique & Digital" },
    { id: 60, nom: "CloudNest", description: "Solutions cloud pour les entreprises.", domaine: "Informatique & Digital" }
];


const offresDeStage = [
    {
        id: 1,
        titre: "Développeur/euse Web Full Stack - H/F",
        entrepriseId: 1, 
        localisation: "Paris (75)",
        type: "Stage de Fin d'Études",
        description: "Développer, tester et valider les sites web en utilisant les dernières technologies de la MERN stack.",
        avantages: ["Travail à domicile occasionnel", "Tickets restaurant"],
        horaires: ["Du lundi au vendredi", "Repos le week-end"],
        experience: "Informatique : 1 an (Optionnel)"
    },
    {
        id: 2,
        titre: "Data Analyst - H/F",
        entrepriseId: 3, 
        localisation: "Lyon (69)",
        type: "Stage Court",
        description: "Analyser des données pour fournir des insights stratégiques aux équipes de direction.",
        avantages: ["Télétravail possible", "Mutuelle d'entreprise"],
        horaires: ["Du lundi au vendredi", "Travail en journée"],
        experience: "Aucune expérience requise"
    },
    {
        id: 3,
        titre: "Ingénieur/e Cybersécurité - H/F",
        entrepriseId: 2, 
        localisation: "Marseille (13)",
        type: "Stage de Fin d'Études",
        description: "Participer à la sécurisation des systèmes d'information et à la protection des données.",
        avantages: ["Formation continue", "Télétravail possible"],
        horaires: ["Du lundi au vendredi", "Travail en journée"],
        experience: "Cybersécurité : 1 an (Optionnel)"
    },
    {
        id: 4,
        titre: "Développeur/euse Mobile - H/F",
        entrepriseId: 6, 
        localisation: "Bordeaux (33)",
        type: "Stage Court",
        description: "Développer des applications mobiles pour iOS et Android en utilisant les dernières technologies.",
        avantages: ["Télétravail possible", "Tickets restaurant"],
        horaires: ["Du lundi au vendredi", "Repos le week-end"],
        experience: "Développement mobile : 1 an (Optionnel)"
    },
    {
        id: 5,
        titre: "Consultant/e en Cloud Computing - H/F",
        entrepriseId: 4, 
        localisation: "Lille (59)",
        type: "Stage de Fin d'Études",
        description: "Participer à la migration et à la gestion de solutions cloud pour les clients.",
        avantages: ["Formation continue", "Télétravail possible"],
        horaires: ["Du lundi au vendredi", "Travail en journée"],
        experience: "Cloud Computing : 1 an (Optionnel)"
    },
    {
        id: 6,
        titre: "Designer UI/UX - H/F",
        entrepriseId: 13, 
        localisation: "Toulouse (31)",
        type: "Stage Court",
        description: "Concevoir des interfaces utilisateur modernes et intuitives pour les applications web et mobiles.",
        avantages: ["Télétravail possible", "Tickets restaurant"],
        horaires: ["Du lundi au vendredi", "Repos le week-end"],
        experience: "Design : 1 an (Optionnel)"
    },
    {
        id: 7,
        titre: "Ingénieur/e DevOps - H/F",
        entrepriseId: 14, 
        localisation: "Nantes (44)",
        type: "Stage de Fin d'Études",
        description: "Participer à la mise en place de pipelines CI/CD et à l'automatisation des déploiements.",
        avantages: ["Formation continue", "Télétravail possible"],
        horaires: ["Du lundi au vendredi", "Travail en journée"],
        experience: "DevOps : 1 an (Optionnel)"
    },
    {
        id: 8,
        titre: "Consultant/e en Big Data - H/F",
        entrepriseId: 27, 
        localisation: "Strasbourg (67)",
        type: "Stage Court",
        description: "Participer à l'analyse de grandes quantités de données pour en extraire des insights stratégiques.",
        avantages: ["Télétravail possible", "Mutuelle d'entreprise"],
        horaires: ["Du lundi au vendredi", "Travail en journée"],
        experience: "Big Data : 1 an (Optionnel)"
    },
    {
        id: 9,
        titre: "Ingénieur/e IA - H/F",
        entrepriseId: 7, 
        localisation: "Nice (06)",
        type: "Stage de Fin d'Études",
        description: "Participer au développement de modèles d'intelligence artificielle et de machine learning.",
        avantages: ["Formation continue", "Télétravail possible"],
        horaires: ["Du lundi au vendredi", "Travail en journée"],
        experience: "IA : 1 an (Optionnel)"
    },
    {
        id: 10,
        titre: "Développeur/euse Blockchain - H/F",
        entrepriseId: 8, 
        localisation: "Rennes (35)",
        type: "Stage Court",
        description: "Participer au développement de solutions blockchain pour la sécurité et la transparence.",
        avantages: ["Télétravail possible", "Tickets restaurant"],
        horaires: ["Du lundi au vendredi", "Repos le week-end"],
        experience: "Blockchain : 1 an (Optionnel)"
    },
    
];


const listeOffres = document.getElementById('liste-offres');
const detailsOffre = document.getElementById('details-offre');


function afficherListeOffres() {
    listeOffres.innerHTML = offresDeStage
        .map(offre => `
            <div class="offre-card" data-id="${offre.id}">
                <h3>${offre.titre}</h3>
                <p><strong>Entreprise :</strong> ${entreprises.find(e => e.id === offre.entrepriseId).nom}</p>
                <p><strong>Localisation :</strong> ${offre.localisation}</p>
                <p><strong>Type :</strong> ${offre.type}</p>
            </div>
        `)
        .join('');
}


function afficherDetailsOffre(offreId) {
    const offre = offresDeStage.find(o => o.id === offreId);
    const entreprise = entreprises.find(e => e.id === offre.entrepriseId);

    detailsOffre.innerHTML = `
        <h3>${offre.titre}</h3>
        <p><strong>Entreprise :</strong> ${entreprise.nom}</p>
        <p><strong>Localisation :</strong> ${offre.localisation}</p>
        <p><strong>Type :</strong> ${offre.type}</p>
        <p><strong>Description :</strong> ${offre.description}</p>
        <div class="avantages">
            <h4>Avantages</h4>
            <ul>
                ${offre.avantages.map(avantage => `<li>${avantage}</li>`).join('')}
            </ul>
        </div>
        <div class="horaires">
            <h4>Horaires</h4>
            <ul>
                ${offre.horaires.map(horaire => `<li>${horaire}</li>`).join('')}
            </ul>
        </div>
        <div class="experience">
            <h4>Expérience Requise</h4>
            <p>${offre.experience}</p>
        </div>
        <button class="postuler-btn">Postuler</button>
    `;
}


listeOffres.addEventListener('click', (e) => {
    const offreCard = e.target.closest('.offre-card');
    if (offreCard) {
        const offreId = parseInt(offreCard.getAttribute('data-id'));
        afficherDetailsOffre(offreId);
    }
});


document.addEventListener('DOMContentLoaded', () => {
    afficherListeOffres();
    if (offresDeStage.length > 0) {
        afficherDetailsOffre(offresDeStage[0].id);
    }
});