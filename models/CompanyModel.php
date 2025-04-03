<?php
class CompanyModel {
    private $db;
    
    public function __construct() {
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=projetweb", "root", "");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    public function getAllCompanies($search = "", $sector = "") {
        $query = "SELECT DISTINCT c.*, 
                  (SELECT COUNT(*) FROM internships WHERE company_id = c.id) as internship_count,
                  (SELECT AVG(rating) FROM company_ratings WHERE company_id = c.id) as average_rating
                  FROM companies c 
                  WHERE 1=1";
        $params = [];
        
        if(!empty($search)) {
            $query .= " AND c.name LIKE :search";
            $params[':search'] = "%$search%";
        }
        
        if(!empty($sector)) {
            $query .= " AND c.sector = :sector";
            $params[':sector'] = $sector;
        }
        
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCompany($data) {
        $query = "INSERT INTO companies (name, description, email, phone, sector) 
                 VALUES (:name, :description, :email, :phone, :sector)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':name' => $data['name'],
            ':description' => $data['description'],
            ':email' => $data['email'],
            ':phone' => $data['phone'],
            ':sector' => $data['sector']
        ]);
    }

    public function updateCompany($data) {
        $query = "UPDATE companies SET 
                 name = :name,
                 description = :description,
                 email = :email,
                 phone = :phone,
                 sector = :sector
                 WHERE id = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':id' => $data['id'],
            ':name' => $data['name'],
            ':description' => $data['description'],
            ':email' => $data['email'],
            ':phone' => $data['phone'],
            ':sector' => $data['sector']
        ]);
    }

    public function deleteCompany($id) {
        // Vérifier si l'entreprise a des stages
        $query = "SELECT COUNT(*) FROM internships WHERE company_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':id' => $id]);
        if($stmt->fetchColumn() > 0) {
            return false; // L'entreprise a des stages, on ne peut pas la supprimer
        }

        // Supprimer les évaluations
        $query = "DELETE FROM company_ratings WHERE company_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':id' => $id]);

        // Supprimer l'entreprise
        $query = "DELETE FROM companies WHERE id = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([':id' => $id]);
    }

    public function rateCompany($companyId, $rating) {
        $query = "INSERT INTO company_ratings (company_id, rating) VALUES (:company_id, :rating)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':company_id' => $companyId,
            ':rating' => $rating
        ]);
    }
}
?>
