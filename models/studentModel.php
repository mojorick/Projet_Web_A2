<?php
class StudentModel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=projetweb', 'root', '');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getAllStudents($search = '') {
        // Modifié pour ne récupérer que les étudiants
        $query = "SELECT id, nom, prenom, email, adresse, domaine, role, date_inscription 
                  FROM utilisateurs 
                  WHERE role = 'etudiant'";
        
        if ($search) {
            $query .= " AND (nom LIKE :search OR prenom LIKE :search OR email LIKE :search)";
            $stmt = $this->db->prepare($query);
            $stmt->execute([':search' => "%$search%"]);
        } else {
            $stmt = $this->db->query($query);
        }
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addStudent($data) {
        $query = "INSERT INTO utilisateurs 
                  (nom, prenom, email, password, adresse, domaine, role, date_inscription) 
                  VALUES (:nom, :prenom, :email, :password, :adresse, :domaine, 'etudiant', NOW())";
        
        $stmt = $this->db->prepare($query);
        $params = [
            ':nom' => $data['nom'],
            ':prenom' => $data['prenom'],
            ':email' => $data['email'],
            ':password' => password_hash($data['password'], PASSWORD_DEFAULT),
            ':adresse' => $data['adresse'],
            ':domaine' => $data['domaine']
        ];
        
        return $stmt->execute($params);
    }

    public function getStudentById($id) {
        $query = "SELECT * FROM utilisateurs WHERE id = :id AND role = 'etudiant'";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateStudent($id, $data) {
        $query = "UPDATE utilisateurs SET 
                  nom = :nom, 
                  prenom = :prenom, 
                  email = :email, 
                  adresse = :adresse, 
                  domaine = :domaine";
        
        $params = [
            ':id' => $id,
            ':nom' => $data['nom'],
            ':prenom' => $data['prenom'],
            ':email' => $data['email'],
            ':adresse' => $data['adresse'],
            ':domaine' => $data['domaine']
        ];

        if (!empty($data['password'])) {
            $query .= ", password = :password";
            $params[':password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        
        $query .= " WHERE id = :id AND role = 'etudiant'";
        
        $stmt = $this->db->prepare($query);
        return $stmt->execute($params);
    }

    public function deleteStudent($id) {
        $query = "DELETE FROM utilisateurs WHERE id = :id AND role = 'etudiant'";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([':id' => $id]);
    }

    public function getStudentApplications($studentId) {
        $query = "SELECT a.*, i.title, i.company 
                  FROM applications a
                  JOIN internships i ON a.internship_id = i.id
                  WHERE a.user_id = :studentId
                  ORDER BY a.application_date DESC";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute([':studentId' => $studentId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getStudentStatus($studentId) {
        // Vérifie si l'étudiant a une candidature acceptée
        $query = "SELECT COUNT(*) as accepted_count 
                  FROM applications 
                  WHERE user_id = :studentId AND status = 'accepted'";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute([':studentId' => $studentId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result['accepted_count'] > 0) {
            return "Stage trouvé";
        }
        
        // Vérifie s'il a des candidatures en cours
        $query = "SELECT COUNT(*) as pending_count 
                  FROM applications 
                  WHERE user_id = :studentId AND status IN ('pending', 'reviewed')";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute([':studentId' => $studentId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result['pending_count'] > 0) {
            return "En recherche de stage (candidatures en cours)";
        }
        
        return "En recherche de stage (aucune candidature)";
    }

}
