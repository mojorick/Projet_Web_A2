<?php require_once("./views/commons/header.php") ?>

<div class="container">
    <h1>📋 Gestion des candidatures</h1>

    <!-- Section Offres disponibles -->
    <section class="available-offers-section">
        <div class="section-header">
            <h2>🔍 Offres disponibles</h2>
            <span class="counter" id="availableOffersCounter">0 offres</span>
        </div>
        <div class="cards-grid" id="availableOffersContainer"></div>
    </section>

    <!-- Section Liste de souhaits -->
    <section class="wishlist-section">
        <div class="section-header">
            <h2>❤️ Ma liste de souhaits</h2>
            <span class="counter" id="wishlistCounter">0 offres</span>
        </div>
        <div class="cards-grid" id="wishlistContainer"></div>
    </section>

    <!-- Section Candidatures -->
    <section class="applications-section">
        <div class="section-header">
            <h2>📬 Mes candidatures</h2>
            <span class="counter" id="applicationsCounter">0 candidatures</span>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Entreprise</th>
                        <th>Poste</th>
                        <th>Date</th>
                        <th>Documents</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="applicationsContainer"></tbody>
            </table>
        </div>
    </section>
</div>

<!-- Modal de candidature -->
<div class="modal" id="applicationModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Postuler à l'offre</h3>
            <button class="close-button" onclick="closeModal()">&times;</button>
        </div>
        <form id="applicationForm" enctype="multipart/form-data">
            <input type="hidden" name="internship_id" id="internshipId">
            <div class="form-group">
                <label for="coverLetter">Lettre de motivation</label>
                <textarea id="coverLetter" name="cover_letter" required 
                    placeholder="Écrivez votre lettre de motivation..."></textarea>
            </div>
            <div class="form-group">
                <label>CV (PDF uniquement)</label>
                <div class="file-upload" id="fileUploadZone">
                    <input type="file" id="cvFile" name="cv_file" accept=".pdf" required>
                    <div class="file-upload-text">
                        <span id="fileNameDisplay">📎 Choisir un fichier</span>
                        <small>PDF uniquement, 5Mo maximum</small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Annuler</button>
                <button type="submit" class="btn btn-primary">Envoyer ma candidature</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal de visualisation de la lettre de motivation -->
<div class="modal" id="coverLetterModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Lettre de motivation</h3>
            <button class="close-button" onclick="closeCoverLetterModal()">&times;</button>
        </div>
        <div class="modal-body">
            <div id="coverLetterContent" class="cover-letter-content"></div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeCoverLetterModal()">Fermer</button>
        </div>
    </div>
</div>

<!-- Modal de contact -->
<div class="modal" id="contactModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Contacter l'entreprise</h3>
            <button class="close-button" onclick="closeContactModal()">&times;</button>
        </div>
        <div class="modal-body">
            <div class="contact-details">
                <h4>Informations de contact</h4>
                <div class="contact-info-grid">
                    <div class="contact-info-item">
                        <span class="label">Entreprise:</span>
                        <span id="contactCompanyName" class="value"></span>
                    </div>
                    <div class="contact-info-item">
                        <span class="label">Contact:</span>
                        <span id="contactName" class="value"></span>
                    </div>
                    <div class="contact-info-item">
                        <span class="label">Fonction:</span>
                        <span id="contactRole" class="value"></span>
                    </div>
                    <div class="contact-info-item">
                        <span class="label">Email:</span>
                        <span id="contactEmail" class="value"></span>
                    </div>
                    <div class="contact-info-item">
                        <span class="label">Téléphone:</span>
                        <span id="contactPhone" class="value"></span>
                    </div>
                </div>
            </div>
            <form id="contactForm" class="contact-form">
                <div class="form-group">
                    <label for="messageSubject">Objet</label>
                    <input type="text" id="messageSubject" name="subject" required>
                </div>
                <div class="form-group">
                    <label for="messageContent">Message</label>
                    <textarea id="messageContent" name="message" required 
                        placeholder="Écrivez votre message..."></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeContactModal()">Annuler</button>
                    <button type="submit" class="btn btn-primary">Envoyer le message</button>
                </div>
            </form>
        </div>
    </div>
</div>