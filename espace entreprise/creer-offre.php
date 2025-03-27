<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Créer une offre de stage - CESI Stages">
    <title>Créer une offre</title>
    <link rel="stylesheet" href="entreprise.css">
</head>
<body>
    <?php include("../head/entete.php"); ?>
    
    <section class="form-section">
        <div class="container">
            <h2>Créer une offre de stage</h2>
            
            <?php
            // Afficher les messages de succès ou d'erreur
            if (isset($successMessage)) {
                echo '<div class="alert alert-success">' . $successMessage . '</div>';
            }
            if (isset($errorMessage)) {
                echo '<div class="alert alert-danger">' . $errorMessage . '</div>';
            }
            ?>
            
            <form id="createOfferForm" class="offer-form" method="POST" action="entreprise_offre.php">
                <div class="form-group">
                    <label for="offerId">ID de l'offre</label>
                    <input type="text" id="offerId" name="offerId" required>
                </div>
                <div class="form-group">
                    <label for="offerTitle">Titre de l'offre</label>
                    <input type="text" id="offerTitle" name="offerTitle" required>
                </div>
                <div class="form-group">
                    <label for="offerDescription">Description</label>
                    <textarea id="offerDescription" name="offerDescription" required></textarea>
                </div>
                <div class="form-group">
                    <label for="offerSkills">Compétences requises</label>
                    <input type="text" id="offerSkills" name="offerSkills" required>
                </div>
                <div class="form-group">
                    <label for="offerSalary">Base de rémunération</label>
                    <input type="text" id="offerSalary" name="offerSalary" required>
                </div>
                <div class="form-group">
                    <label for="offerStartDate">Date de début</label>
                    <input type="date" id="offerStartDate" name="offerStartDate" required>
                </div>
                <div class="form-group">
                    <label for="offerEndDate">Date de fin</label>
                    <input type="date" id="offerEndDate" name="offerEndDate" required>
                </div>
                <button type="submit" class="btn-primary">Créer l'offre</button>
            </form>
        </div>
    </section>

    <?php include("../footer/footer.php"); ?>
</body>
</html>