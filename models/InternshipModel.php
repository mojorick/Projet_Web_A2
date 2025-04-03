<?php
require_once(__DIR__ . "/PdoModel.php");

class InternshipModel extends PdoModel {
    public function __construct() {
        $this->setDB();
    }

    public function searchInternships($filters = []) {
        $where = [];
        $params = [];
        
        $query = "SELECT * FROM internships WHERE 1=1";
    
        // Recherche par mot-clé
        if (!empty($filters['keyword'])) {
            $where[] = "(title LIKE :keyword OR short_description LIKE :keyword OR full_description LIKE :keyword OR company LIKE :keyword)";
            $params[':keyword'] = '%' . $filters['keyword'] . '%';
        }
    
        // Recherche par localisation
        if (!empty($filters['location'])) {
            $where[] = "location LIKE :location";
            $params[':location'] = '%' . $filters['location'] . '%';
        }
    
        // Recherche par compétences
        if (!empty($filters['skills'])) {
            $where[] = "competence LIKE :skills";
            $params[':skills'] = '%' . $filters['skills'] . '%';
        }
    
        // Filtre par salaire (adapté au format "1200€" dans votre base)
        if (!empty($filters['salary'])) {
            switch ($filters['salary']) {
                case '0-500':
                    $where[] = "(salary_base REGEXP '^[0-4]?[0-9]?[0-9]€' OR salary_base LIKE '%0 € - 500 €%')";
                    break;
                case '500-1000':
                    $where[] = "(salary_base REGEXP '^[5-9][0-9][0-9]€|^1000€' OR salary_base LIKE '%500 € - 1000 €%')";
                    break;
                case '1000-1750':
                    $where[] = "(salary_base REGEXP '^1[0-6][0-9][0-9]€|^1700€' OR salary_base LIKE '%1000 € - 1750 €%')";
                    break;
                case '1750-2500':
                    $where[] = "(salary_base REGEXP '^1[7-9][0-9][0-9]€|^2[0-4][0-9][0-9]€|^2500€' OR salary_base LIKE '%1750 € - 2500 €%')";
                    break;
                case '2500+':
                    $where[] = "(salary_base REGEXP '^2[5-9][0-9][0-9]€|^[3-9][0-9][0-9][0-9]€' OR salary_base LIKE '%2500 €%')";
                    break;
            }
        }
    
        // Filtre par durée (calculée à partir des dates)
        if (!empty($filters['duration'])) {
            switch ($filters['duration']) {
                case '1-2':
                    $where[] = "DATEDIFF(end_date, start_date) BETWEEN 30 AND 60";
                    break;
                case '3-4':
                    $where[] = "DATEDIFF(end_date, start_date) BETWEEN 90 AND 120";
                    break;
                case '5-6':
                    $where[] = "DATEDIFF(end_date, start_date) BETWEEN 150 AND 180";
                    break;
                case '6+':
                    $where[] = "DATEDIFF(end_date, start_date) > 180";
                    break;
            }
        }


        // Filtre par domaine
        if (!empty($filters['domaine'])) {
            $where[] = "domaine = :domaine";
            $params[':domaine'] = $filters['domaine'];
        }
    
        // Filtre par date de début
        if (!empty($filters['start_date'])) {
            $where[] = "start_date >= :start_date";
            $params[':start_date'] = $filters['start_date'];
        }
    
        if (!empty($where)) {
            $query .= " AND " . implode(" AND ", $where);
        }
    
        $query .= " ORDER BY posted_at DESC";
    
        try {
            $stmt = self::$pdo->prepare($query);
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur de recherche : " . $e->getMessage());
            return [];
        }
    }

    // Garder les autres méthodes existantes...
    public function getAllInternships() {
        $query = "SELECT * FROM internships ORDER BY posted_at DESC";
        $stmt = self::$pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getInternshipById($id) {
        $query = "SELECT * FROM internships WHERE id = :id";
        $stmt = self::$pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addInternship($title, $company, $location, $type, $remote, $short_description, $full_description) {
        $query = "INSERT INTO internships (title, company, location, type, remote, short_description, full_description) 
                  VALUES (:title, :company, :location, :type, :remote, :short_description, :full_description)";
        $stmt = self::$pdo->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':company', $company);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':remote', $remote);
        $stmt->bindParam(':short_description', $short_description);
        $stmt->bindParam(':full_description', $full_description);
        return $stmt->execute();
    }

    public function getDomainStats() {
        $query = "SELECT 
                    domaine, 
                    COUNT(*) as offres, 
                    COUNT(DISTINCT company) as entreprises 
                  FROM internships 
                  WHERE type = 'Stage'
                  GROUP BY domaine";
        
        $stmt = self::$pdo->prepare($query);
        $stmt->execute();
        
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $stats = [];
        foreach ($results as $row) {
            $stats[$row['domaine']] = [
                'offres' => $row['offres'],
                'entreprises' => $row['entreprises']
            ];
        }
        
        // Assurez-vous que toutes les catégories existent
        $categories = [
            'Informatique & Digital',
            'Business & Management', 
            'Ingénierie & Innovation'
        ];
        
        foreach ($categories as $cat) {
            if (!isset($stats[$cat])) {
                $stats[$cat] = ['offres' => 0, 'entreprises' => 0];
            }
        }
        
        return $stats;
    }

    public function createInternship($data) {
        try {
            $sql = "INSERT INTO internships (
                title, company, location, type, domaine, remote, 
                salary_base, start_date, end_date, short_description, 
                full_description, competence, company_description, 
                applicants_count, posted_at
            ) VALUES (
                :title, :company, :location, :type, :domaine, :remote,
                :salary_base, :start_date, :end_date, :short_description,
                :full_description, :competence, :company_description,
                :applicants_count, NOW()
            )";
            
            $stmt = self::$pdo->prepare($sql);
            return $stmt->execute($data);
        } catch (PDOException $e) {
            error_log("Erreur création stage : " . $e->getMessage());
            return false;
        }
    }
    
    public function updateInternship($id, $data) {
        try {
            $sql = "UPDATE internships SET 
                title = :title,
                company = :company,
                location = :location,
                type = :type,
                domaine = :domaine,
                remote = :remote,
                salary_base = :salary_base,
                start_date = :start_date,
                end_date = :end_date,
                short_description = :short_description,
                full_description = :full_description,
                competence = :competence,
                company_description = :company_description
                WHERE id = :id";
            
            $data['id'] = $id;
            $stmt = self::$pdo->prepare($sql);
            return $stmt->execute($data);
        } catch (PDOException $e) {
            error_log("Erreur mise à jour stage : " . $e->getMessage());
            return false;
        }
    }
    
    public function deleteInternship($id) {
        try {
            $sql = "DELETE FROM internships WHERE id = :id";
            $stmt = self::$pdo->prepare($sql);
            return $stmt->execute(['id' => $id]);
        } catch (PDOException $e) {
            error_log("Erreur suppression stage : " . $e->getMessage());
            return false;
        }
    }
}


?>
