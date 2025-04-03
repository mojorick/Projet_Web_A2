<?php
require_once __DIR__.'/MainController.php';
require_once __DIR__.'/../models/PasswordResetModel.php';

class ForgotController extends MainController {
    private $resetModel;

    public function __construct() {
        try {
            $db = new PDO(
                "mysql:host=localhost;dbname=projetweb;charset=utf8",
                "root",
                "",
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
            $this->resetModel = new PasswordResetModel($db);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    public function forgotlinkPage() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleResetRequest();
            return;
        }

        $this->renderForgotPasswordView();
    }

    private function handleResetRequest() {
        try {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            if (empty($email)) {
                throw new Exception("Veuillez entrer un email valide");
            }

            $this->resetModel->processResetRequest($email);
            $this->renderSuccessView();
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            $this->renderForgotPasswordView();
        }
    }

    private function handlePasswordReset() {
        try {
            $token = $_POST['token'] ?? null;
            $newPassword = $_POST['password'] ?? null;
            $confirmPassword = $_POST['confirm_password'] ?? null;
    
            if (!$token || !$this->resetModel->isTokenValid($token)) {
                throw new Exception("Lien invalide ou expiré.");
            }
    
            if (empty($newPassword) || strlen($newPassword) < 6) {
                throw new Exception("Le mot de passe doit contenir au moins 6 caractères.");
            }
    
            if ($newPassword !== $confirmPassword) {
                throw new Exception("Les mots de passe ne correspondent pas.");
            }
    
            if (!$this->resetModel->updatePassword($token, $newPassword)) {
                throw new Exception("Erreur lors de la mise à jour du mot de passe.");
            }
    
            $datas_pages = [
                "description" => "Mot de passe mis à jour",
                "title" => "Mot de passe mis à jour",
                "views" => "views/pages/password_updated.php",
                "layout" => "views/commons/layout.php",
                "style" => "password_updated.css",
            ];
            utilities::renderPage($datas_pages);
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            $this->resetPasswordPage();
        }
    }
    

    private function renderForgotPasswordView() {
        $datas_pages = [
            "description" => "Réinitialisation de mot de passe",
            "title" => "Mot de passe oublié",
            "views" => "views/pages/forgotlinkpage.php",
            "layout" => "views/commons/layout.php",
            "style" => "forgotlinkpage.css",
            "js" => "forgotlinkpage.js",
        ];
        utilities::renderPage($datas_pages);
    }

    private function renderSuccessView() {
        $datas_pages = [
            "description" => "Email envoyé",
            "title" => "Email envoyé",
            "views" => "views/pages/email_sent.php",
            "layout" => "views/commons/layout.php",
            "style"=> "email_sent.css",
            "js"=> "email_sent.js",
        ];
        utilities::renderPage($datas_pages);
    }

    public function resetPasswordPage() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handlePasswordReset();
            return;
        }
    
        $token = $_GET['token'] ?? null;
        if (!$token || !$this->resetModel->isTokenValid($token)) {
            $_SESSION['error'] = "Lien invalide ou expiré.";
            $this->errorPage("Le lien de réinitialisation est invalide ou a expiré.");
            return;
        }
    
        $datas_pages = [
            "description" => "Réinitialisation de mot de passe",
            "title" => "Réinitialisation",
            "views" => "views/pages/reset_password.php",
            "layout" => "views/commons/layout.php",
            "style" => "reset_password.css",
        ];
        utilities::renderPage($datas_pages);
    }
    
}