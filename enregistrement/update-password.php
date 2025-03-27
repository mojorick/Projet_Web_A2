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

if (isset($_POST['token']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
    $token = $_POST['token'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Vérifier que les mots de passe correspondent
    if ($new_password !== $confirm_password) {
        echo "❌ Les mots de passe ne correspondent pas.";
        exit;
    }

    // Vérifier si le token existe dans la base de données
    $stmt = $insc->prepare("SELECT * FROM utilisateurs WHERE reset_token = :token");
    $stmt->bindParam(':token', $token);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        // Hash du nouveau mot de passe
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Mettre à jour le mot de passe et effacer le token
        $updateStmt = $insc->prepare("UPDATE utilisateurs SET password = :password, reset_token = NULL WHERE reset_token = :token");
        $updateStmt->bindParam(':password', $hashed_password);
        $updateStmt->bindParam(':token', $token);
        $updateStmt->execute();

        header('location:password_edit_success.php');
    } else {
        echo "❌ Lien invalide.";
    }
} else {
    echo "❌ Accès interdit.";
}
?>