<div class="container">
        <div class="from-box login">
            <form action="./models/login_A.php" method="post">
                <h1>Connexion administrateur</h1>
                <div class="input-box">
                    <input type="email" name="email" placeholder="email" required>
                    <i class='bx bx-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="mot de passe" required>
                    <i class='bx bx-lock-alt'></i>
                </div>
                <button type="submit" class="btn" name="ok">Connexion</button>
                <!--<p>ou se connecter avec les plateformes sociales</p>
                <div class="social-icons">
                    <a href="#"><i class='bx bxl-google'></i></a>
                    <a href="#"><i class='bx bxl-facebook'></i></a>
                    <a href="#"><i class='bx bxl-github'></i></a>
                    <a href="#"><i class='bx bxl-linkedin'></i></a>
                </div>-->
            </form>
        </div>

        <div class="from-box register">
            <form action="./models/login_P.php" method="post">
                <h1>Connexion pilote</h1>
                <div class="input-box">
                    <input type="email" name="email" id="email" placeholder="Email" required>
                    <i class='bx bxs-envelope'></i>
                    <p id="error-message" style="color: red; display: none;">Email invalide !</p>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="mot de passe" required>
                    <i class='bx bx-lock-alt'></i>
                </div>
                <button type="submit" class="btn" name="ok">Connexion</button>
                <!--<p>ou s'inscrire avec les plateformes sociales</p>
                <div class="social-icons">
                    <a href="#"><i class='bx bxl-google'></i></a>
                    <a href="#"><i class='bx bxl-facebook'></i></a>
                    <a href="#"><i class='bx bxl-github'></i></a>
                    <a href="#"><i class='bx bxl-linkedin'></i></a>
                </div>-->
            </form>
        </div>

        <div class="toggle-box">
            <div class="toggle-panel toggle-left">
                <h1>Salut, Bienvenue !</h1>
                <p>êtes vous un pilote ?</p>
                <button class="btn register-btn">Connexion</button>
            </div>
        
            <div class="toggle-panel toggle-right">
                <h1>ibamssokissè!</h1>
                <p>Déjà inscrit ?</p>
                <button class="btn login-btn">Connexion</button>
            </div>
        </div>
        
        
    </div>