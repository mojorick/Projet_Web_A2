<?php
require_once(__DIR__ . "/PdoModel.php");

class Login extends PdoModel {

    public function connexion() {
        session_start();

        if (isset($_POST['ok'])) {
            if (!empty($_POST['email']) && !empty($_POST['password'])) {
                $email = trim($_POST['email']);
                $password = trim($_POST['password']);

                try {
                    $db = $this->setDB();

                    $request = $db->prepare("SELECT * FROM utilisateurs WHERE email = :email AND role = 'etudiant'");
                    $request->execute([':email' => $email]);

                    $user = $request->fetch(PDO::FETCH_ASSOC);

                    if ($user && password_verify($password, $user['password'])) {
                        // Stockage de toutes les informations nécessaires dans la session
                        $_SESSION['id'] = $user['id']; // Ajout de l'ID utilisateur
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['role'] = $user['role'];
                        $_SESSION['nom'] = $user['nom'];
                        $_SESSION['prenom'] = $user['prenom'];

                        // Log pour déboguer
                        error_log("Connexion réussie - ID utilisateur: " . $user['id']);
                        
                        header("Location: ./../"); // Redirige après connexion
                        exit();
                    } else {
                        $_SESSION['error'] = "Email ou mot de passe incorrect";
                        header("Location: errorPage.php"); 
                        exit();
                    }
                } catch (PDOException $e) {
                    error_log("Erreur de connexion : " . $e->getMessage());
                    $_SESSION['error'] = "Une erreur est survenue lors de la connexion";
                    header("Location: errorPage.php");
                    exit();
                }
            } else {
                $_SESSION['error'] = "Veuillez remplir tous les champs";
                header("Location: errorPage.php");
                exit();
            }
        }
    }

    public function isConnected() {
        return isset($_SESSION['id']) && !empty($_SESSION['id']);
    }

    public function getUserId() {
        return $_SESSION['id'] ?? null;
    }
}

// Utilisation
$login = new Login();
$login->connexion();
