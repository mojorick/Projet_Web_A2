<?php
require_once(__DIR__ . "/PdoModel.php");

class ApplyModel extends PdoModel {
    public function __construct() {
        $this->setDB();
    }

    public function createApplication($data) {
        try {
            $query = "INSERT INTO applications 
                     (user_id, internship_id, motivation_letter, cv_path, application_date, status) 
                     VALUES (:user_id, :internship_id, :motivation_letter, :cv_path, :application_date, :status)";
            
            $stmt = self::$pdo->prepare($query);
            return $stmt->execute($data);
            
        } catch (PDOException $e) {
            error_log("Erreur création candidature: " . $e->getMessage());
            return false;
        }
    }
}
