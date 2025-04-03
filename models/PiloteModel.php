<?php
require_once(__DIR__ . "/PdoModel.php");

class UserModel extends PdoModel {
    public function getAllPilots($search = '') {
        $this->setDB();
        if (!empty($search)) {
            $search = "%$search%";
            $stmt = self::$pdo->prepare("SELECT * FROM utilisateurs 
                                       WHERE role = 'pilote' 
                                       AND (LOWER(nom) LIKE LOWER(:search) 
                                       OR LOWER(prenom) LIKE LOWER(:search))");
            $stmt->execute(['search' => $search]);
        } else {
            $stmt = self::$pdo->query("SELECT * FROM utilisateurs WHERE role = 'pilote'");
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createPilot($data) {
        $this->setDB();
        $stmt = self::$pdo->prepare("INSERT INTO utilisateurs (nom, prenom, email, password, role, date_inscription) 
                                   VALUES (:nom, :prenom, :email, :password, :role, NOW())");
        
        return $stmt->execute($data);
    }

    public function updatePilot($id, $data) {
        $this->setDB();
        $stmt = self::$pdo->prepare("UPDATE utilisateurs 
                                   SET nom = :nom, prenom = :prenom, email = :email 
                                   WHERE id = :id AND role = 'pilote'");
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function deletePilot($id) {
        $this->setDB();
        $stmt = self::$pdo->prepare("DELETE FROM utilisateurs WHERE id = ? AND role = 'pilote'");
        return $stmt->execute([$id]);
    }

    
}
