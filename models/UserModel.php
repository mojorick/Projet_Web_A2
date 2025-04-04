<?php
require_once(__DIR__ . '/PdoModel.php');

class UserModel extends PdoModel {
    public function getUserById($user_id) {
        $pdo = $this->setDB();
        $query = "SELECT * FROM utilisateurs WHERE id = :user_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}