<?php
require_once(__DIR__ . "/PdoModel.php");

class login_P extends PdoModel {

    public function connexion() {
        session_start();

        if (isset($_POST['ok'])) {
            if (!empty($_POST['email']) && !empty($_POST['password'])) {
                $email = trim($_POST['email']);
                $password = trim($_POST['password']);

                try {
                    $db = $this->setDB();

                    $request = $db->prepare("SELECT * FROM utilisateurs WHERE email = :email AND role = 'pilote'");
                    $request->execute([':email' => $email]);

                    $user = $request->fetch(PDO::FETCH_ASSOC);

                    if ($user && password_verify($password, $user['password'])) {
                        $_SESSION['id'] = $user['id']; // Ajout de l'ID utilisateur
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['role'] = 'pilote';
                        $_SESSION['nom'] = $user['nom'];
                        $_SESSION['prenom'] = $user['prenom'];

                        header("Location: ./../"); // Redirige après connexion
                        exit();
                    } else {
                        header("Location: errorPage.php"); 
                        exit();
                    }
                } catch (PDOException $e) {
                    die("Erreur de base de données : " . $e->getMessage());
                }
            } else {
                echo "Veuillez remplir tous les champs.";
            }
        }
    }
}

// Utilisation
$login = new login_P();
$login->connexion();
