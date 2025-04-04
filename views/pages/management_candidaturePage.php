<?php require_once("./views/commons/header.php") ?>

<div class="container">
    <h1>📋 Gestion des candidatures</h1>

    <!-- Section Offres disponibles -->
    <section class="available-offers-section">
        <div class="section-header">
            <h2>🔍 Offres disponibles</h2>
        </div>
        <div class="cards-grid">
            <?php foreach ($datas_pages['offresDisponibles'] as $offer): ?>
            <div class="offer-card" data-internship-id="<?= $offer['id'] ?>">
                <div class="offer-card-header">
                    <h3 class="offer-card-title"><?= htmlspecialchars($offer['title']) ?></h3>
                    <p class="offer-card-company">
                        <span>🏢</span> <?= htmlspecialchars($offer['company_name'] ?? $offer['company']) ?>
                    </p>
                </div>
                <div class="offer-card-content">
                    <div class="info-grid">
                        <p>📍 <?= htmlspecialchars($offer['location']) ?></p>
                        <p>💰 <?= htmlspecialchars($offer['salary_base']) ?></p>
                        <p>📅 <?= date('d/m/Y', strtotime($offer['start_date'])) ?></p>
                        <p>🔄 <?= htmlspecialchars($offer['type']) ?></p>
                    </div>
                    <p class="offer-card-description"><?= htmlspecialchars($offer['short_description']) ?></p>
                    <div class="skills-list">
                        <?php 
                        $skills = explode(',', $offer['competence']);
                        foreach ($skills as $skill): 
                        ?>
                            <span class="skill-tag"><?= trim(htmlspecialchars($skill)) ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="offer-card-footer">
                    <a href="<?= ROOT ?>postuler?id=<?= $offer['id'] ?>" class="btn btn-primary">
                        📝 Postuler
                    </a>
                    <button class="btn btn-secondary add-to-wishlist">
                        ❤️ Favoris
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Section Liste de souhaits -->
    <section class="wishlist-section">
        <div class="section-header">
            <h2>❤️ Ma liste de souhaits</h2>
        </div>
        <div class="cards-grid">
            <?php foreach ($datas_pages['wishlist'] as $wish): ?>
            <div class="wish-card" data-internship-id="<?= $wish['id'] ?>">
                <div class="wish-card-header">
                    <h3 class="wish-card-title"><?= htmlspecialchars($wish['title']) ?></h3>
                    <p class="wish-card-company">
                        <span>🏢</span> <?= htmlspecialchars($wish['company_name'] ?? $wish['company']) ?>
                    </p>
                </div>
                <div class="wish-card-content">
                    <div class="info-grid">
                        <p>📍 <?= htmlspecialchars($wish['location']) ?></p>
                        <p>💰 <?= htmlspecialchars($wish['salary_base']) ?></p>
                        <p>📅 <?= date('d/m/Y', strtotime($wish['start_date'])) ?></p>
                        <p>🔄 <?= htmlspecialchars($wish['type']) ?></p>
                    </div>
                    <p class="wish-card-description"><?= htmlspecialchars($wish['short_description']) ?></p>
                    <div class="skills-list">
                        <?php 
                        $skills = explode(',', $wish['competence']);
                        foreach ($skills as $skill): 
                        ?>
                            <span class="skill-tag"><?= trim(htmlspecialchars($skill)) ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="wish-card-footer">
                    <a href="<?= ROOT ?>postuler?id=<?= $wish['id'] ?>" class="btn btn-primary">
                        📝 Postuler
                    </a>
                    <button class="btn btn-danger remove-from-wishlist">
                        ❌ Retirer
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Section Candidatures -->
    <section class="applications-section">
        <div class="section-header">
            <h2>📬 Mes candidatures</h2>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Entreprise</th>
                        <th>Poste</th>
                        <th>Date</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datas_pages['candidatures'] as $application): ?>
                    <tr>
                        <td><?= htmlspecialchars($application['company']) ?></td>
                        <td><?= htmlspecialchars($application['title']) ?></td>
                        <td><?= htmlspecialchars($application['application_date_formatted']) ?></td>
                        <td>
                            <span class="status-badge status-<?= strtolower($application['status_text']) ?>">
                                <?= htmlspecialchars($application['status_text']) ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>

<script>
$(document).ready(function() {
    // Ajouter à la liste de souhaits
    $('.add-to-wishlist').click(function() {
        const card = $(this).closest('.offer-card');
        const internshipId = card.data('internship-id');
        
        $.post('<?= ROOT ?>Gestion_des_candidatures/ajouter-favori', {
            internship_id: internshipId
        }, function(response) {
            if (response.success) {
                // Rafraîchir la page pour voir les changements
                location.reload();
            } else {
                alert(response.error || 'Erreur inconnue');
            }
        }, 'json');
    });
    
    // Retirer de la liste de souhaits
    $('.remove-from-wishlist').click(function() {
        const card = $(this).closest('.wish-card');
        const internshipId = card.data('internship-id');
        
        $.post('<?= ROOT ?>Gestion_des_candidatures/supprimer-favori', {
            internship_id: internshipId
        }, function(response) {
            if (response.success) {
                // Rafraîchir la page pour voir les changements
                location.reload();
            } else {
                alert(response.error || 'Erreur inconnue');
            }
        }, 'json');
    });
});
</script>