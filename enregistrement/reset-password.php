<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projetweb";

try {
    $insc = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $insc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérifier si le token est présent dans l'URL
if (isset($_GET['token'])) {
    $token = $_GET['token'];
    
    // Vérifier si le token existe dans la base de données
    $stmt = $insc->prepare("SELECT * FROM utilisateurs WHERE reset_token = :token");
    $stmt->bindParam(':token', $token);
    $stmt->execute();
    
    if ($stmt->rowCount() == 1) {
        // Token valide, afficher le formulaire de réinitialisation
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Réinitialisation du mot de passe</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
            <style>
                @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
                *{
                    font-family: 'Poppins', sans-serif;
                }
                body {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    background-color: #f8f9fa;
                }
                .reset-container {
                    background: white;
                    padding: 2rem;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    width: 100%;
                    max-width: 400px;
                }
                .form-control {
                    padding: 10px;
                }
                .btn-primary {
                    width: 100%;
                    padding: 10px;
                }
                .text-center a {
                    text-decoration: none;
                    color: #007bff;
                }
            </style>
        </head>
        <body>
            <div class="reset-container">
                <h2 class="text-center">Réinitialisation du mot de passe</h2>
                <form action="update-password.php" method="post">
                    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                    <div class="mb-3">
                        <label class="form-label">Nouveau mot de passe</label>
                        <input type="password" name="new_password" class="form-control" placeholder="Nouveau mot de passe" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirmez le mot de passe</label>
                        <input type="password" name="confirm_password" class="form-control" placeholder="Confirmez le mot de passe" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </form>
                <p class="text-center mt-3"><a href="../enregistrement.php">Retour à la connexion</a></p>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "❌ Lien invalide.";
    }
} else {
    echo "❌ Accès interdit.";
}
?>