<?php
require_once("PdoModel.php"); // Inclure la connexion à la base de données

class ProfileModel extends PdoModel {

    public function getUser($email) {
        $db = $this->setDB();
        $query = $db->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        $query->execute(['email' => $email]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUser($email, $nom, $prenom, $adresse, $domaine) {
        $db = $this->setDB();
        $query = $db->prepare("UPDATE utilisateurs SET nom = :nom, prenom = :prenom, adresse = :adresse, domaine = :domaine WHERE email = :email");
        return $query->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'adresse' => $adresse,
            'domaine' => $domaine,
            'email' => $email
        ]);
    }

    public function updatePassword($email, $newPassword) {
        $db = $this->setDB();
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $query = $db->prepare("UPDATE utilisateurs SET password = :password WHERE email = :email");
        return $query->execute([
            'password' => $hashedPassword,
            'email' => $email
        ]);
    }

    public function uploadProfilePhoto($email, $file) {
        $uploadDir = './uploads/profiles/';
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxSize = 800 * 1024;

        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if ($file['error'] === UPLOAD_ERR_OK && in_array($file['type'], $allowedTypes) && $file['size'] <= $maxSize) {
            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $filename = uniqid('profile_') . '.' . $extension;
            $destination = $uploadDir . $filename;

            if (move_uploaded_file($file['tmp_name'], $destination)) {
                $db = $this->setDB();
                $query = $db->prepare("UPDATE utilisateurs SET photo = :photo WHERE email = :email");
                $query->execute([
                    'photo' => $destination,
                    'email' => $email
                ]);
                return $destination;
            }
        }
        return false;
    }
}
?>
