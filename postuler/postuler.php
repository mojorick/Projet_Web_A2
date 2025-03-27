<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postuler à l'Offre</title>
    <link rel="stylesheet" href="postuler.css">
</head>
<body>
<?php include ("../head/entete.php"); ?>
    <main>
        <section class="postuler-container" style="margin-top: 7%;">
            <h2>Formulaire de Postulation</h2>
            <form id="formulaire-postuler">
                <div class="form-group">
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" required>
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom :</label>
                    <input type="text" id="prenom" name="prenom" required>
                </div>
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="telephone">Téléphone :</label>
                    <input type="tel" id="telephone" name="telephone" required>
                </div>
                <div class="form-group">
                    <label for="cv">CV :</label>
                    <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx" required>
                </div>
                <div class="form-group">
                    <label for="lettre-motivation">Lettre de Motivation :</label>
                    <textarea id="lettre-motivation" name="lettre-motivation" rows="5" required></textarea>
                </div>
                <button type="submit" class="postuler-btn">Postuler</button>
            </form>
        </section>
    </main>
    <?php include("../footer/footer.php") ?>
</body>
</html>