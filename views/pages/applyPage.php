<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once("./views/commons/header.php"); 
?>

<div class="apply-wrapper">
    <div class="apply-container">
        <?php if (!isset($_SESSION['id'])): ?>
            <div class="auth-required">
                <div class="auth-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#158515">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                </div>
                <h3>Connexion requise</h3>
                <p>Pour postuler à cette offre, veuillez vous connecter à votre compte.</p>
                <a href="<?= ROOT ?>enregistrement" class="auth-button">Se connecter / S'inscrire</a>
            </div>
        <?php else: ?>
            <div class="apply-header">
                <h2><span class="icon">📝</span> Postuler à cette offre</h2>
                <div class="progress-steps">
                    <div class="step active">Formulaire</div>
                </div>
            </div>
            
            <form method="POST" action="<?= ROOT ?>postuler?id=<?= $_GET['id'] ?>" enctype="multipart/form-data" class="apply-form">
                <input type="hidden" name="internship_id" value="<?= $_GET['id'] ?? '' ?>">
                
                <div class="form-group">
                    <label for="motivation">
                        <span class="label-icon">✍️</span>
                        Lettre de motivation
                    </label>
                    <textarea id="motivation" name="motivation" placeholder="Décrivez pourquoi vous êtes le candidat idéal pour ce stage..." required></textarea>
                    <div class="char-counter"><span>0</span>/1000 caractères</div>
                </div>
                
                <div class="form-group file-upload">
                    <label for="cv">
                        <span class="label-icon">📄</span>
                        Téléverser votre CV
                        <span class="file-requirements">(PDF uniquement, max 5MB)</span>
                    </label>
                    <div class="upload-area" id="uploadArea">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#158515">
                            <path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM14 13v4h-4v-4H7l5-5 5 5h-3z"/>
                        </svg>
                        <p>Glissez-déposez votre fichier ici ou <span class="browse-link">parcourir</span></p>
                        <input type="file" id="cv" name="cv" accept="application/pdf" required>
                    </div>
                    <div class="file-preview" id="filePreview"></div>
                </div>
                
                <div class="form-footer">
                    <a href="<?= ROOT ?>Recherche_de_stage" class="cancel-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                        </svg>
                        Annuler
                    </a>
                    <button type="submit" class="submit-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                        </svg>
                        Envoyer la candidature
                    </button>
                </div>
            </form>
        <?php endif; ?>
    </div>
    
    <div class="apply-sidebar">
        <h3>Conseils pour votre candidature</h3>
        <ul class="tips-list">
            <li>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#158515">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
                Personnalisez votre lettre de motivation pour chaque offre
            </li>
            <li>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#158515">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
                Vérifiez l'orthographe et la grammaire
            </li>
            <li>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#158515">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
                Mettez en avant vos compétences pertinentes
            </li>
        </ul>
        
        <div class="contact-box">
            <h4>Besoin d'aide ?</h4>
            <p>Notre équipe est là pour vous aider dans votre recherche de stage.</p>
            <a href="mailto:josuehemerick.morie@viacesi.fr" class="contact-link">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#158515">
                    <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                </svg>
                Nous contacter
            </a>
        </div>
    </div>
</div>

<script>
// Script pour le compteur de caractères
document.getElementById('motivation').addEventListener('input', function() {
    const counter = this.parentElement.querySelector('.char-counter span');
    counter.textContent = this.value.length;
});

// Script pour l'upload de fichier
const uploadArea = document.getElementById('uploadArea');
const fileInput = uploadArea.querySelector('input[type="file"]');
const filePreview = document.getElementById('filePreview');

uploadArea.addEventListener('click', () => fileInput.click());
uploadArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    uploadArea.classList.add('dragover');
});
uploadArea.addEventListener('dragleave', () => {
    uploadArea.classList.remove('dragover');
});
uploadArea.addEventListener('drop', (e) => {
    e.preventDefault();
    uploadArea.classList.remove('dragover');
    if (e.dataTransfer.files.length) {
        fileInput.files = e.dataTransfer.files;
        updateFilePreview();
    }
});
fileInput.addEventListener('change', updateFilePreview);

function updateFilePreview() {
    if (fileInput.files.length) {
        const file = fileInput.files[0];
        filePreview.innerHTML = `
            <div class="file-info">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#158515">
                    <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zM6 20V4h7v5h5v11H6z"/>
                </svg>
                <div>
                    <p class="file-name">${file.name}</p>
                    <p class="file-size">${(file.size / 1024 / 1024).toFixed(2)} MB</p>
                </div>
                <button type="button" class="remove-file" aria-label="Remove file">
                    ×
                </button>
            </div>
        `;
        
        filePreview.querySelector('.remove-file').addEventListener('click', () => {
            fileInput.value = '';
            filePreview.innerHTML = '';
        });
    }
}
</script>