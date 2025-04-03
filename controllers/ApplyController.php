<?php
require_once __DIR__.'/MainController.php';
require_once('./models/ApplyModel.php');
require_once('./models/InternshipModel.php');

class ApplyController extends MainController {
    private $applyModel;

    public function __construct() {
        $this->applyModel = new ApplyModel();
    }

    public function applyPage() {
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['id'])) {
            $_SESSION['redirect_after_login'] = ROOT . 'postuler?id=' . ($_GET['id'] ?? '');
            $_SESSION['error'] = "Vous devez être connecté pour postuler à une offre de stage";
            header('Location: ' . ROOT . 'enregistrement');
            exit();
        }

        // Vérifier l'ID de l'offre
        if (empty($_GET['id'])) {
            $this->errorPage("Aucune offre spécifiée");
            return;
        }

        // Traitement du formulaire
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processApplication();
            return;
        }

        // Afficher le formulaire
        $internshipModel = new InternshipModel();
        $internship = $internshipModel->getInternshipById($_GET['id']);

        $datas_pages = [
            "description" => "Postuler à une offre",
            "title" => "Postuler",
            "views" => "views/pages/applyPage.php",
            "layout" => "views/commons/layout.php",
            "style" => "applyPage.css",
            "internship" => $internship
        ];

        utilities::renderPage($datas_pages);
    }

    private function processApplication() {
        try {
            // Vérifier à nouveau si l'utilisateur est connecté
            if (!isset($_SESSION['id'])) {
                throw new Exception("Vous devez être connecté pour postuler");
            }

            // Validation basique
            if (empty($_POST['motivation']) || empty($_FILES['cv'])) {
                throw new Exception("Tous les champs sont obligatoires");
            }

            // Vérification du fichier
            $cv = $_FILES['cv'];
            if ($cv['error'] !== UPLOAD_ERR_OK) {
                throw new Exception("Erreur lors du téléchargement du fichier");
            }

            // Vérification du type de fichier
            $allowedTypes = ['application/pdf'];
            if (!in_array($cv['type'], $allowedTypes)) {
                throw new Exception("Seuls les fichiers PDF sont acceptés");
            }

            // Vérification de la taille
            $maxSize = 5 * 1024 * 1024; // 5MB
            if ($cv['size'] > $maxSize) {
                throw new Exception("Le fichier ne doit pas dépasser 5MB");
            }

            // Enregistrement du fichier
            $uploadDir = 'uploads/cv/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $filename = uniqid() . '_' . basename($cv['name']);
            $destination = $uploadDir . $filename;

            if (!move_uploaded_file($cv['tmp_name'], $destination)) {
                throw new Exception("Erreur lors de l'enregistrement du CV");
            }

            // Enregistrement en base
            $data = [
                'user_id' => $_SESSION['id'], // Utilisation de l'ID de session
                'internship_id' => $_POST['internship_id'],
                'motivation_letter' => $_POST['motivation'],
                'cv_path' => $destination,
                'application_date' => date('Y-m-d H:i:s'),
                'status' => 'pending'
            ];

            if ($this->applyModel->createApplication($data)) {
                $_SESSION['success'] = "Votre candidature a été envoyée avec succès";
                header('Location: ' . ROOT . 'Recherche_de_stage');
                exit();
            } else {
                throw new Exception("Erreur lors de l'enregistrement de la candidature");
            }

        } catch (Exception $e) {
            $this->errorPage($e->getMessage());
        }
    }
}