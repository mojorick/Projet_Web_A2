<?php require_once("./views/commons/header.php")?>
<h1>Gestion des offres de stage</h1>

<main class="container">
    <div class="search-bar">
        <div class="search-input">
            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.3-4.3"></path>
            </svg>
            <input type="text" id="search" placeholder="Rechercher une offre...">
        </div>
        <div class="actions">
            <button class="btn btn-primary" id="new-offer-btn">
                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 5v14M5 12h14"></path>
                </svg>
                Nouvelle offre
            </button>
        </div>
    </div>

    <div class="internships" id="internships-list">
        <?php foreach ($internships as $internship): ?>
            <div class="internship-card" data-id="<?= $internship['id'] ?>">
                <div class="internship-header">
                    <div>
                        <h2 class="internship-title"><?= htmlspecialchars($internship['title']) ?></h2>
                        <p class="internship-company">
                            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                            <?= htmlspecialchars($internship['company']) ?>
                        </p>
                    </div>
                    <div class="internship-actions">
                        <button class="action-btn edit-btn" title="Modifier">
                            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                        </button>
                        <button class="action-btn delete-btn" title="Supprimer">
                            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 6h18"></path>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <p class="internship-description"><?= htmlspecialchars($internship['short_description']) ?></p>
                <div class="skills-list">
                    <?php 
                    $competences = explode(',', $internship['competence']);
                    foreach ($competences as $competence): 
                        if (!empty(trim($competence))): ?>
                            <span class="skill-tag"><?= htmlspecialchars(trim($competence)) ?></span>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="internship-footer">
                    <div class="info-item">
                        <?= htmlspecialchars($internship['salary_base']) ?> €/mois
                    </div>
                    <div class="info-item">
                        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        <?= date('d/m/Y', strtotime($internship['start_date'])) ?> - <?= date('d/m/Y', strtotime($internship['end_date'])) ?>
                    </div>
                    <div class="info-item">
                        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <?= $internship['applicants_count'] ?> candidat(s)
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<!-- Modal pour nouvelle offre -->
<!-- Modal pour nouvelle offre -->
<div class="modal" id="offer-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Nouvelle offre</h2>
            <button class="close-btn">
                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 6L6 18M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <form id="offer-form" action="<?= ROOT ?>Gestion_des_offres_de_stage" method="POST">
            <input type="hidden" name="action" value="create">
            <input type="hidden" name="id" value="">
            <div class="form-content">
                <div class="form-group">
                    <label>Titre du poste</label>
                    <input type="text" name="title" placeholder="Ex: Développeur Full Stack" required>
                </div>
                <div class="form-group">
                    <label>Entreprise</label>
                    <input type="text" name="company" placeholder="Ex: Tech Solutions" required>
                </div>
                <div class="form-group">
                    <label>Description courte</label>
                    <textarea name="short_description" placeholder="Description résumée de l'offre..." required></textarea>
                </div>
                <div class="form-group">
                    <label>Description complète</label>
                    <textarea name="full_description" placeholder="Décrivez en détail les responsabilités et les objectifs du stage..." required></textarea>
                </div>
                <div class="form-group">
                    <label>Compétences requises (séparées par des virgules)</label>
                    <input type="text" name="competence" placeholder="Ex: PHP, MySQL, JavaScript" required>
                </div>
                <div class="form-group">
                    <label>Rémunération (€/mois)</label>
                    <input type="number" name="salary_base" placeholder="Ex: 1000" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Date de début</label>
                        <input type="date" name="start_date" required>
                    </div>
                    <div class="form-group">
                        <label>Date de fin</label>
                        <input type="date" name="end_date" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Localisation</label>
                    <input type="text" name="location" placeholder="Ex: Paris, Lyon..." required>
                </div>
                <div class="form-group">
                    <label>Type de stage</label>
                    <select name="type" required>
                        <option value="">Sélectionnez un type</option>
                        <option value="Temps plein">Temps plein</option>
                        <option value="Temps partiel">Temps partiel</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Domaine</label>
                    <select name="domaine" required>
                        <option value="">Sélectionnez un domaine</option>
                        <option value="Informatique & Digital">Informatique & Digital</option>
                        <option value="Business & Management">Business & Management</option>
                        <option value="Ingénierie & Innovation">Ingénierie & Innovation</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Télétravail</label>
                    <select name="remote" required>
                        <option value="">Sélectionnez une option</option>
                        <option value="Présentiel">Présentiel</option>
                        <option value="Hybride">Hybride</option>
                        <option value="Full remote">Full remote</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Description de l'entreprise</label>
                    <textarea name="company_description" placeholder="Présentez brièvement l'entreprise..." required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="cancel-btn">Annuler</button>
                <button type="submit" class="btn btn-primary">Créer l'offre</button>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>