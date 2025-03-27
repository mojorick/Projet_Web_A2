<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
    <link rel="stylesheet" href="forgot-link.css">
</head>
<body>
    <div class="container">
        <h2>Mot de passe oublié</h2>
        <p>Entrez votre adresse e-mail pour recevoir un lien de réinitialisation.</p>
        <form action="send.php" method="post">
            <input type="email" id="email" name="email" placeholder="Votre adresse e-mail" required>
            <button type="submit" name="send">Envoyer</button>
        </form>
        <p class="message" id="message">email envoyer</p>
    </div>
    
    <script src="forgot-link.js"></script>
</body>
</html>