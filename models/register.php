<?php

require_once(__DIR__ . "/PdoModel.php"); // Utilisez __DIR__ pour le chemin absolu

class register extends PdoModel {

    public function inscription() {
        session_start();

        if (isset($_POST['ok'])) {
            if (!empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['password'])) {
                
                $nom = htmlspecialchars(trim($_POST['nom']));
                $email = htmlspecialchars(trim($_POST['email']));
                $pass = trim($_POST['password']);

                // Validation de l'email
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    die("Adresse e-mail invalide !");
                }

                // Vérification si l'email existe déjà
                $db = $this->setDB();
                $checkEmail = $db->prepare("SELECT id FROM utilisateurs WHERE email = :email");
                $checkEmail->bindParam(':email', $email);
                $checkEmail->execute();
                
                if ($checkEmail->rowCount() > 0) {
                    die("Cet e-mail est déjà utilisé !");
                }

                // Hashage du mot de passe
                $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

                // Insertion dans la base de données
                $requete = $db->prepare("INSERT INTO utilisateurs (nom, email, password) VALUES (:nom, :email, :pass)");
                $requete->bindParam(':nom', $nom);
                $requete->bindParam(':email', $email);
                $requete->bindParam(':pass', $hashedPass);
                
                if ($requete->execute()) {
                    $_SESSION['email'] = $email;
                    header("Location: ./../enregistrement");
                    exit();
                } else {
                    echo "Erreur lors de l'inscription.";
                }
            } else {
                echo "Veuillez remplir tous les champs.";
            }
        }
    }
}

// Utilisation de la classe
$login = new register();
$login->inscription();