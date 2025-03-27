<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Supprimer une offre de stage - CESI Stages">
    <title>Supprimer une offre</title>
    <link rel="stylesheet" href="entreprise.css">
</head>
<body>
<?php include ("../head/entete.php"); ?>

    <section class="form-section">
        <div class="container">
            <h2>Supprimer une offre de stage</h2>
            <form id="deleteOfferForm" class="offer-form">
                <div class="form-group">
                    <label for="deleteOfferId">ID de l'offre</label>
                    <input type="text" id="deleteOfferId" required>
                </div>
                <button type="submit" class="btn-danger">Supprimer l'offre</button>
            </form>
        </div>
    </section>
    <?php include("../footer/footer.php") ?>
</body>
</html>