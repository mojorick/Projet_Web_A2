<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

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

// Vérifier si le formulaire a été soumis
if (isset($_POST['send'])) {
    $email = trim($_POST['email']);

    // Vérifier si l'email existe
    $stmt = $insc->prepare("SELECT * FROM utilisateurs WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Générer un token sécurisé
        $token = bin2hex(random_bytes(32));
        $expiration = time() + 3600; // Expire en 1 heure

        // Stocker le token dans la base de données
        $updateStmt = $insc->prepare("UPDATE utilisateurs SET reset_token = :token WHERE email = :email");
        $updateStmt->bindParam(':token', $token);
        $updateStmt->bindParam(':email', $email);
        $updateStmt->execute();

        // Construire le lien de réinitialisation
        $resetLink = "http://localhost/enregistrement/reset-password.php?token=$token";

        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true; 
            $mail->Username = "mojorick.yougotube320@gmail.com";
            $mail->Password = "eans tlmd lcgj uznv";
            $mail->SMTPSecure = "ssl";
            $mail->Port = 465;

            $mail->setFrom("mojorick.yougotube320@gmail.com", "mojorick");
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Réinitialisation de votre mot de passe';
            $mail->Body = "Bonjour,<br><br> Cliquez sur le lien ci-dessous pour réinitialiser votre mot de passe : <br><br>
                           <a href='$resetLink'>$resetLink</a><br><br>
                           Ce lien expirera dans 1 heure.";

            if ($mail->send()) {
                // Afficher un message de succès et rediriger après 5 secondes
                echo '
                <!DOCTYPE html>
                <html lang="fr">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="refresh" content="3;url=enregistrement.php">
                    <title>Email envoyé</title>
                    <style>
                        .message {
                            font-family: Arial, sans-serif;
                            text-align: center;
                            margin-top: 20%;
                            font-size: 1.5em;
                            color: green;
                        }
                    </style>
                </head>
                <body>
                    <div class="message">
                        ✅ Un email de réinitialisation a été envoyé. Redirection dans 3 secondes...
                    </div>
                </body>
                </html>
                ';
                exit(); // Arrêter l'exécution du script
            } else {
                echo "❌ Erreur lors de l'envoi de l'e-mail.";
            }
        } catch (Exception $e) {
            echo "❌ Erreur d'envoi de l'e-mail : " . $mail->ErrorInfo;
        }
    } else {
        echo "❌ Aucun compte associé à cet e-mail.";
    }
}
?>