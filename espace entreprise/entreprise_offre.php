<?php
// Démarrage de session
session_start();

// Inclusion de la connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projetweb"; 

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérification que le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Récupération et sécurisation des données du formulaire
        $offer_id = htmlspecialchars($_POST['offerId']);
        $offer_title = htmlspecialchars($_POST['offerTitle']);
        $offer_description = htmlspecialchars($_POST['offerDescription']);
        $offer_skills = htmlspecialchars($_POST['offerSkills']);
        $offer_salary = htmlspecialchars($_POST['offerSalary']);
        $offer_start_date = $_POST['offerStartDate'];
        $offer_end_date = $_POST['offerEndDate'];
        
        // Récupération de l'ID de l'entreprise (à adapter selon votre système d'authentification)
        $company_id = $_SESSION['company_id'] ?? 1; // Valeur par défaut pour test

        // Validation des dates
        if (strtotime($offer_end_date) <= strtotime($offer_start_date)) {
            throw new Exception("La date de fin doit être postérieure à la date de début");
        }

        // Vérification que l'entreprise existe
        $check_company = $conn->prepare("SELECT id FROM companies WHERE id = ?");
        $check_company->execute([$company_id]);
        
        if ($check_company->rowCount() == 0) {
            throw new Exception("Entreprise non trouvée");
        }

        // Insertion dans la base de données
        $stmt = $conn->prepare("INSERT INTO internship_offers (
            offer_id, company_id, titre, description, 
            competences_requises, remuneration, 
            date_debut, date_fin, statut
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'active')");
        
        $stmt->execute([
            $offer_id,
            $company_id,
            $offer_title,
            $offer_description,
            $offer_skills,
            $offer_salary,
            $offer_start_date,
            $offer_end_date
        ]);

        // Message de succès
        $_SESSION['success_message'] = "L'offre de stage a été créée avec succès !";
        
    } catch(PDOException $e) {
        // Erreur SQL
        $_SESSION['error_message'] = "Erreur technique : " . $e->getMessage();
    } catch(Exception $e) {
        // Erreur de validation
        $_SESSION['error_message'] = $e->getMessage();
    }
    
    // Redirection vers la page du formulaire
    header("Location: ../accueil/accueil.php"); // Remplacez par le nom de votre page de formulaire
    exit();
} else {
    // Si quelqu'un essaie d'accéder directement à ce fichier sans soumettre le formulaire
    header("Location: ../accueil/accueil.php"); // Remplacez par la page d'accueil appropriée
    exit();
}