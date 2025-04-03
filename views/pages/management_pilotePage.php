<?php require_once("./views/commons/header.php")?>

<div class="content-wrapper">
    <h1>Gestion des Pilotes</h1>

    <!-- Messages d'alerte -->
    <?php if(isset($_GET['success'])): ?>
        <div class="alert alert-success">
            <?php 
            switch($_GET['success']) {
                case 'created': echo "Le pilote a été créé avec succès !"; break;
                case 'updated': echo "Les informations du pilote ont été mises à jour avec succès !"; break;
                case 'deleted': echo "Le pilote a été supprimé avec succès !"; break;
            }
            ?>
        </div>
    <?php endif; ?>

    <?php if(isset($_GET['error'])): ?>
        <div class="alert alert-danger">
            <?php 
            switch($_GET['error']) {
                case 'create': echo "Erreur lors de la création du pilote."; break;
                case 'update': echo "Erreur lors de la modification du pilote."; break;
                case 'delete': echo "Erreur lors de la suppression du pilote."; break;
                case 'not_found': echo "Aucun pilote trouvé avec ces critères de recherche."; break;
            }
            ?>
        </div>
    <?php endif; ?>

    <div class="toolbar">
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Rechercher un pilote..." class="search-input">
            <button class="btn btn-primary" id="searchButton">
                🔍 Rechercher
            </button>
        </div>
        <button class="btn btn-success" onclick="openModal()">
            <span class="btn-icon">➕</span> Nouveau Pilote
        </button>
    </div>

    <div class="pilots-grid">
        <?php if(empty($pilots)): ?>
            <div class="no-results">Aucun pilote trouvé</div>
        <?php else: ?>
            <?php foreach($pilots as $pilot): ?>
            <div class="pilot-card">
                <div class="pilot-info">
                    <h3><?= htmlspecialchars($pilot['prenom'] . ' ' . $pilot['nom']) ?></h3>
                    <p><?= htmlspecialchars($pilot['email']) ?></p>
                </div>
                <div class="pilot-actions">
                    <button class="btn btn-warning" 
                            onclick="openModal({
                                id: '<?= $pilot['id'] ?>', 
                                nom: '<?= htmlspecialchars($pilot['nom']) ?>', 
                                prenom: '<?= htmlspecialchars($pilot['prenom']) ?>', 
                                email: '<?= htmlspecialchars($pilot['email']) ?>'
                            })">
                        ✏️ Modifier
                    </button>
                    <button class="btn btn-danger" 
                            onclick="deletePilot('<?= $pilot['id'] ?>')">
                        🗑️ Supprimer
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<!-- Modal -->
<div class="modal" id="pilotModal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 id="modalTitle">Nouveau Pilote</h2>
            <button class="close-button" id="closeModal">&times;</button>
        </div>
        <form method="POST" action="" id="pilotForm">
            <input type="hidden" name="id" id="pilotId">
            <div class="form-content">
                <div class="form-group">
                    <label for="lastName">Nom</label>
                    <input type="text" id="lastName" name="nom" required>
                </div>
                <div class="form-group">
                    <label for="firstName">Prénom</label>
                    <input type="text" id="firstName" name="prenom" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="cancelButton">Annuler</button>
                <button type="submit" class="btn btn-success">Enregistrer</button>
            </div>
        </form>
    </div>
</div>