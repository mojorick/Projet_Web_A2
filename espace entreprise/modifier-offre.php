<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Modifier une offre de stage - CESI Stages">
    <title>Modifier une offre</title>
    <link rel="stylesheet" href="entreprise.css">
</head>
<body>
    <?php include ("../head/entete.php"); ?>
    <section class="form-section">
        <div class="container">
            <h2>Modifier une offre de stage</h2>
            <form id="editOfferForm" class="offer-form">
                <div class="form-group">
                    <label for="editOfferId">ID de l'offre</label>
                    <input type="text" id="editOfferId" required>
                </div>
                <div class="form-group">
                    <label for="editOfferTitle">Titre de l'offre</label>
                    <input type="text" id="editOfferTitle" required>
                </div>
                <div class="form-group">
                    <label for="editOfferDescription">Description</label>
                    <textarea id="editOfferDescription" required></textarea>
                </div>
                <div class="form-group">
                    <label for="editOfferSkills">Compétences requises</label>
                    <input type="text" id="editOfferSkills" required>
                </div>
                <div class="form-group">
                    <label for="editOfferSalary">Base de rémunération</label>
                    <input type="text" id="editOfferSalary" required>
                </div>
                <div class="form-group">
                    <label for="editOfferStartDate">Date de début</label>
                    <input type="date" id="editOfferStartDate" required>
                </div>
                <div class="form-group">
                    <label for="editOfferEndDate">Date de fin</label>
                    <input type="date" id="editOfferEndDate" required>
                </div>
                <button type="submit" class="btn-primary">Modifier l'offre</button>
            </form>
        </div>
    </section>

    <?php include("../footer/footer.php") ?>
</body>
</html>