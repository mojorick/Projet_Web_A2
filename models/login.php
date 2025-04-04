<?php
require_once(__DIR__ . "/PdoModel.php");

session_start();

class Login extends PdoModel {

    public function connexion() {
        if (isset($_POST['ok'])) {
            if (!empty($_POST['email']) && !empty($_POST['password'])) {
                $email = trim($_POST['email']);
                $password = trim($_POST['password']);

                try {
                    $db = $this->setDB();
                    $request = $db->prepare("SELECT * FROM utilisateurs WHERE email = :email");
                    $request->execute([':email' => $email]);
                    $user = $request->fetch(PDO::FETCH_ASSOC);

                    if ($user && password_verify($password, $user['password'])) {
                        $_SESSION['id'] = $user['id'];
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['role'] = $user['role'];
                        $_SESSION['nom'] = $user['nom'];
                        $_SESSION['prenom'] = $user['prenom'];

                        // Supprimer les cookies d'inscription
                        setcookie('user_registered', '', time() - 3600, '/');
                        setcookie('registration_prompt_closed', '', time() - 3600, '/');
                        
                        header("Location: ./../");
                        exit();
                    } else {
                        $_SESSION['error'] = "Email ou mot de passe incorrect";
                        header("Location: login.php?error=1");
                        exit();
                    }
                } catch (PDOException $e) {
                    error_log("Erreur de connexion: " . $e->getMessage());
                    $_SESSION['error'] = "Une erreur est survenue";
                    header("Location: login.php?error=2");
                    exit();
                }
            } else {
                $_SESSION['error'] = "Veuillez remplir tous les champs";
                header("Location: login.php?error=3");
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
