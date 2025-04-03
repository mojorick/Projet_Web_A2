<?php
require_once(__DIR__ . "/PdoModel.php");

class StatsModel extends PdoModel {
    public function __construct() {
        $this->setDB();
    }

    public function getTopSkills($limit = 8) {
        $query = "SELECT 
                    TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(competence, ',', numbers.n), ',', -1)) as skill,
                    COUNT(*) as count
                  FROM internships
                  JOIN (
                    SELECT 1 n UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL
                    SELECT 4 UNION ALL SELECT 5
                  ) numbers ON CHAR_LENGTH(competence) - CHAR_LENGTH(REPLACE(competence, ',', '')) >= numbers.n - 1
                  WHERE competence IS NOT NULL AND competence != ''
                  GROUP BY skill
                  ORDER BY count DESC
                  LIMIT :limit";
        
        $stmt = self::$pdo->prepare($query);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDurationDistribution() {
        $query = "SELECT 
                    CASE 
                        WHEN DATEDIFF(end_date, start_date) <= 90 THEN '1-3 mois'
                        WHEN DATEDIFF(end_date, start_date) <= 180 THEN '4-6 mois'
                        WHEN DATEDIFF(end_date, start_date) <= 270 THEN '7-9 mois'
                        ELSE '10+ mois'
                    END as duration_category,
                    COUNT(*) as count
                  FROM internships
                  WHERE start_date IS NOT NULL AND end_date IS NOT NULL
                  GROUP BY duration_category
                  ORDER BY 
                    CASE duration_category
                        WHEN '1-3 mois' THEN 1
                        WHEN '4-6 mois' THEN 2
                        WHEN '7-9 mois' THEN 3
                        ELSE 4
                    END";
        
        $stmt = self::$pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTopWishlistedOffers($limit = 3) {
        $query = "SELECT 
                    id, title, company, 
                    DATE_FORMAT(start_date, '%m/%Y') as start_date,
                    salary_base as salary,
                    wishlist_count as applicantsCount,
                    competence as skills
                  FROM internships
                  ORDER BY wishlist_count DESC
                  LIMIT :limit";
        
        $stmt = self::$pdo->prepare($query);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        
        $offers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Convertir les compétences en tableau
        foreach ($offers as &$offer) {
            $offer['skills'] = !empty($offer['skills']) ? 
                array_map('trim', explode(',', $offer['skills'])) : 
                [];
        }
        
        return $offers;
    }
}