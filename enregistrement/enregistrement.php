<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'enregistrement</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="enregistrement.css">
</head>
<body>
    <div class="container">
        <div class="from-box login">
            <form action="connexion.php" method="post">
                <h1>Connexion</h1>
                <div class="input-box">
                    <input type="email" name="email" placeholder="email" required>
                    <i class='bx bx-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="mot de passe" required>
                    <i class='bx bx-lock-alt'></i>
                    <?php
                    
                    ?>
                </div>
                <div class="forgot-link">
                    <a href="forgot-link.php">Mot de passe oublié ?</a>
                </div>
                <button type="submit" class="btn" name="ok">Connexion</button>
                <p>ou se connecter avec les plateformes sociales</p>
                <div class="social-icons">
                    <a href="#"><i class='bx bxl-google'></i></a>
                    <a href="#"><i class='bx bxl-facebook'></i></a>
                    <a href="#"><i class='bx bxl-github'></i></a>
                    <a href="#"><i class='bx bxl-linkedin'></i></a>
                </div>
            </form>
        </div>

        <div class="from-box register">
            <form action="inscription.php" method="post">
                <h1>Inscription</h1>
                <div class="input-box">
                    <input type="text" name="nom" placeholder="Nom" required>
                    <i class='bx bx-user'></i>
                </div>
                <div class="input-box">
                    <input type="email" name="email" id="email" placeholder="Email" required>
                    <i class='bx bxs-envelope'></i>
                    <p id="error-message" style="color: red; display: none;">Email invalide !</p>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="mot de passe" required>
                    <i class='bx bx-lock-alt'></i>
                </div>
                <button type="submit" class="btn" name="ok">Inscription</button>
                <p>ou s'inscrire avec les plateformes sociales</p>
                <div class="social-icons">
                    <a href="#"><i class='bx bxl-google'></i></a>
                    <a href="#"><i class='bx bxl-facebook'></i></a>
                    <a href="#"><i class='bx bxl-github'></i></a>
                    <a href="#"><i class='bx bxl-linkedin'></i></a>
                </div>
            </form>
        </div>

        <div class="toggle-box">
            <div class="toggle-panel toggle-left">
                <h1>Salut, Bienvenue !</h1>
                <p>Pas encore inscrit ?</p>
                <button class="btn register-btn">Inscription</button>
            </div>
        
            <div class="toggle-panel toggle-right">
                <h1>Encore toi !</h1>
                <p>Déjà inscrit ?</p>
                <button class="btn login-btn">Connexion</button>
            </div>
        </div>
        
        
    </div>

    <script src="enregistrement.js"></script>
    
</body>
</html>