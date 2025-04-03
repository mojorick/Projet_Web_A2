<?php
require_once __DIR__.'../phpmailer/src/Exception.php';
require_once __DIR__.'../phpmailer/src/PHPMailer.php';
require_once __DIR__.'../phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PasswordResetModel {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function processResetRequest($email) {
        // Vérifier si l'email existe
        $stmt = $this->db->prepare("SELECT id FROM utilisateurs WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->rowCount() === 0) {
            throw new Exception("Aucun compte associé à cet email");
        }
    
        // Générer et stocker seulement le token (sans expiry)
        $token = bin2hex(random_bytes(32));
        $stmt = $this->db->prepare("UPDATE utilisateurs SET reset_token = ? WHERE email = ?");
        $stmt->execute([$token, $email]);
    
        // Envoyer l'email
        $this->sendResetEmail($email, $token);
    }

    public function isTokenValid($token) {
        $stmt = $this->db->prepare("SELECT email FROM utilisateurs WHERE reset_token = ?");
        $stmt->execute([$token]);
        return $stmt->fetchColumn();
    }
    
    public function updatePassword($token, $newPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
    
        $stmt = $this->db->prepare("UPDATE utilisateurs SET password = ?, reset_token = NULL WHERE reset_token = ?");
        return $stmt->execute([$hashedPassword, $token]);
    }
    

    private function sendResetEmail($email, $token) {
        $mail = new PHPMailer(true);
        $resetLink = ROOT . "enregistrement/reset-password?token=$token";

        try {
            // Configuration SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = "mojorick.yougotube320@gmail.com";
            $mail->Password = "eans tlmd lcgj uznv";
            $mail->SMTPSecure = "ssl";
            $mail->Port = 465;

            // Destinataire
            $mail->setFrom("mojorick.yougotube320@gmail.com", "MOJORICK");
            $mail->addAddress($email);

            // Contenu
            $mail->isHTML(true);
            $mail->Subject = 'Réinitialisation de mot de passe';
            $mail->Body = "Bonjour,<br><br>Cliquez sur le lien pour réinitialiser votre mot de passe:<br>
                          <a href='$resetLink'>$resetLink</a><br>
                          Ce lien expirera dans 1 heure.";

            if (!$mail->send()) {
                throw new Exception("Erreur lors de l'envoi de l'email");
            }
        } catch (Exception $e) {
            throw new Exception("Erreur d'envoi d'email: " . $e->getMessage());
        }
    }
}