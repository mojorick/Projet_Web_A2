<?php
require_once __DIR__.'/../config/database.php';

class StageController {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAvailableStages() {
        if (!isset($_SESSION['user']['id'])) {
            return [];
        }

        $query = "SELECT i.* 
                FROM internships i
                WHERE i.id NOT IN (
                    SELECT internship_id 
                    FROM applications 
                    WHERE user_id = :user_id
                )
                ORDER BY i.posted_at DESC";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute([':user_id' => $_SESSION['user']['id']]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getWishlist() {
        if (!isset($_SESSION['user']['id'])) {
            return [];
        }

        $query = "SELECT i.* 
                FROM user_wishlist w
                JOIN internships i ON w.internship_id = i.id
                WHERE w.user_id = :user_id
                ORDER BY w.added_at DESC";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute([':user_id' => $_SESSION['user']['id']]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getApplications() {
        if (!isset($_SESSION['user']['id'])) {
            return [];
        }

        $query = "SELECT a.*, i.title as internship_title, i.company
                FROM applications a
                JOIN internships i ON a.internship_id = i.id
                WHERE a.user_id = :user_id
                ORDER BY a.application_date DESC";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute([':user_id' => $_SESSION['user']['id']]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getStageById($id) {
        $query = "SELECT * FROM internships WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addApplication($userId, $stageId, $motivationLetter, $cvPath) {
        $query = "INSERT INTO applications 
                 (user_id, internship_id, motivation_letter, cv_path, status)
                 VALUES (:user_id, :internship_id, :motivation_letter, :cv_path, 'pending')";
        
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':user_id' => $userId,
            ':internship_id' => $stageId,
            ':motivation_letter' => $motivationLetter,
            ':cv_path' => $cvPath
        ]);
    }

    public function addToWishlist($userId, $stageId) {
        // Vérifie d'abord si l'élément existe déjà
        $checkQuery = "SELECT 1 FROM user_wishlist 
                      WHERE user_id = :user_id AND internship_id = :internship_id";
        $checkStmt = $this->db->prepare($checkQuery);
        $checkStmt->execute([
            ':user_id' => $userId,
            ':internship_id' => $stageId
        ]);
        
        if ($checkStmt->fetch()) {
            return false; // Déjà dans la wishlist
        }

        $query = "INSERT INTO user_wishlist (user_id, internship_id) 
                 VALUES (:user_id, :internship_id)";
        
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':user_id' => $userId,
            ':internship_id' => $stageId
        ]);
    }

    public function removeFromWishlist($userId, $stageId) {
        $query = "DELETE FROM user_wishlist 
                 WHERE user_id = :user_id AND internship_id = :internship_id";
        
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':user_id' => $userId,
            ':internship_id' => $stageId
        ]);
    }

    public function getApplicationById($id) {
        $query = "SELECT a.*, i.title as internship_title, i.company
                FROM applications a
                JOIN internships i ON a.internship_id = i.id
                WHERE a.id = :id";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}