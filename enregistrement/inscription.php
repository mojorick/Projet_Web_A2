<?php
session_start(); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projetweb"; 

try {
    $insc = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $insc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}


if (isset($_POST['ok'])) {
    if (!empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        
        $nom = htmlspecialchars(trim($_POST['nom']));
        $email = htmlspecialchars(trim($_POST['email']));
        $pass = trim($_POST['password']);

        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die("Adresse e-mail invalide !");
        }

        
        $checkEmail = $insc->prepare("SELECT id FROM utilisateurs WHERE email = :email");
        $checkEmail->bindParam(':email', $email);
        $checkEmail->execute();
        
        if ($checkEmail->rowCount() > 0) {
            die("Cet e-mail est déjà utilisé !");
        }

        
        $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

        
        $requete = $insc->prepare("INSERT INTO utilisateurs (nom, email, password) VALUES (:nom, :email, :pass)");
        $requete->bindParam(':nom', $nom);
        $requete->bindParam(':email', $email);
        $requete->bindParam(':pass', $hashedPass);
        
        if ($requete->execute()) {
            $_SESSION['email'] = $email;
            header("Location: enregistrement.php");
            exit();
        } else {
            echo "Erreur lors de l'inscription.";
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}
?>
