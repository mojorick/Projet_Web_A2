<?php
require_once(__DIR__ . '/PdoModel.php');

class CandidatureModel extends PdoModel {
    public function getUserApplications($user_id) {
        $pdo = $this->setDB();
        $query = "SELECT a.*, i.title, i.company, 
                 CASE 
                    WHEN a.status = 'pending' THEN 'En attente'
                    WHEN a.status = 'accepted' THEN 'Acceptée'
                    WHEN a.status = 'rejected' THEN 'Rejetée'
                    WHEN a.status = 'reviewed' THEN 'En revue'
                    ELSE a.status
                 END AS status_text,
                 DATE_FORMAT(a.application_date, '%d/%m/%Y') AS application_date_formatted
                 FROM applications a
                 JOIN internships i ON a.internship_id = i.id
                 WHERE a.user_id = :user_id
                 ORDER BY a.application_date DESC";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}