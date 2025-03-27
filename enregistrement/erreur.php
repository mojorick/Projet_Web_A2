<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erreur de Connexion</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #d4f2fa;
            font-family: Arial, sans-serif;
        }
        .message-box {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            color: #070ff7;
            font-size: 18px;
        }
    </style>
    <script>
        setTimeout(function() {
            window.location.href = "enregistrement.php";
        }, 2000);
    </script>
</head>
<body>
    <div class="message-box">
        <p>Identifiant ou mot de passe invalide.</p>
        <p>Redirection vers la page d'enregistrement dans 2 secondes...</p>
    </div>
</body>
</html>
