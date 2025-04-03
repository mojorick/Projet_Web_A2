<?php

require_once('./controllers/utilities.php');
require_once('./models/InternshipModel.php');
require_once('./models/stats_offersModel.php');



class MainController{
    /*public function homePage(){
        require_once("./views/pages/homePage.php");
    }

    public function homePage(){

        ob_start();
        require_once("./views/pages/homePage.php");
        $title = "page d'accueil";
        $description = "Bienvenu sur notre site de recherche de stage";
        $content = ob_get_clean();
        require_once("./views/commons/layout.php");
    }*/

    public function homePage() {
        $internshipModel = new InternshipModel();
        $stats = $internshipModel->getDomainStats();
    
        $datas_pages = [
            "description" => "Bienvenu sur notre site de recherche de stage",
            "title" => "page d'accueil",
            "views" => "views/pages/homePage.php",
            "layout" => "views/commons/layout.php",
            "style" => "homePage.css",
            "js" => "homePage.js",
            "stats" => $stats
        ];
    
        utilities::renderPage($datas_pages);
    }

    public function errorPage($message){

        $datas_pages=[
            "description"=>"on est perdu ?",
            "title"=> "Erreur",
            "views"=> "views/pages/errorPage.php",
            "layout"=> "views/commons/layout.php",
            "style"=> "errorPage.css",
            "message"=> $message ,
        ] ;

        utilities::renderPage($datas_pages) ;
    }

    public function loginPage(){
        
        $datas_pages=[
            "description"=> "on s'enregistre !",
            "title"=>"Page d'enregistrement",
            "views"=> "views/pages/loginPage.php",
            "layout"=> "views/commons/layout.php",
            "style"=> "loginPage.css",
            "js"=> "loginPage.js",
        ];

        utilities::renderPage($datas_pages) ;
    }

    public function loginPage_AP(){
        
        $datas_pages=[
            "description"=> "on s'enregistre !",
            "title"=>"Page d'enregistrement",
            "views"=> "views/pages/loginPageAdmin_Pilote.php",
            "layout"=> "views/commons/layout.php",
            "style"=> "loginPage.css",
            "js"=> "loginPage.js",
        ];

        utilities::renderPage($datas_pages) ;
    }

    public function profilPage(){
        
        $datas_pages=[
            "description"=> "alors : on est nul!",
            "title"=>"profil",
            "views"=> "views/pages/profilPage.php",
            "layout"=> "views/commons/layout.php",
            "style"=> "profilPage.css",
            "js"=> "profilPage.js",
        ];

        utilities::renderPage($datas_pages) ;
    }

    public function searchPage() {
        $internshipModel = new InternshipModel();
        
        // Récupérer les filtres de recherche
        $filters = [
            'domaine' => $_GET['domaine'] ?? '',
            'keyword' => $_GET['keyword'] ?? '',
            'location' => $_GET['location'] ?? '',
            'skills' => $_GET['skills'] ?? '',
            'salary' => $_GET['salary'] ?? '',
            'duration' => $_GET['duration'] ?? '',
            'start_date' => $_GET['start_date'] ?? '',
        ];
    
        // Effectuer la recherche
        $internships = $internshipModel->searchInternships($filters);
    
        $datas_pages = [
            "description" => "Liste des offres de stage",
            "title" => "Offres de stage",
            "views" => "views/pages/searchPage.php",
            "layout" => "views/commons/layout.php",
            "style" => "searchPage.css",
            "js" => "searchPage.js",
            "internships" => $internships,
        ];
    
        utilities::renderPage($datas_pages);
    }
    public function applyPage() {
        $datas_pages=[
            "description"=> "alors : on est nul!",
            "title"=>"profil",
            "views"=> "views/pages/applyPage.php",
            "layout"=> "views/commons/layout.php",
            "style"=> "applyPage.css",
        ];

        utilities::renderPage($datas_pages) ;
    }

    public function stats_offersPage() {
        
        $statsModel = new StatsModel();
        
        $skillsData = $statsModel->getTopSkills();
        $durationData = $statsModel->getDurationDistribution();
        $topOffersData = $statsModel->getTopWishlistedOffers();
        
        $datas_pages = [
            "description" => "Statistiques des offres de stage",
            "title" => "Statistiques",
            "views" => "views/pages/stats_offersPage.php",
            "layout" => "views/commons/layout.php",
            "style" => "stats_offersPage.css",
            "js" => "stats_offersPage.js",
            "skillsData" => $skillsData,
            "durationData" => $durationData,
            "topOffersData" => $topOffersData
        ];
        
        utilities::renderPage($datas_pages);
    }

    public function management_offerPage() {
        $internshipModel = new InternshipModel();
        
        // Gestion des actions CRUD
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';
            
            switch ($action) {
                case 'create':
                    $data = [
                        'title' => $_POST['title'],
                        'company' => $_POST['company'],
                        'location' => $_POST['location'],
                        'type' => $_POST['type'],
                        'domaine' => $_POST['domaine'],
                        'remote' => $_POST['remote'],
                        'salary_base' => $_POST['salary_base'],
                        'start_date' => $_POST['start_date'],
                        'end_date' => $_POST['end_date'],
                        'short_description' => $_POST['short_description'],
                        'full_description' => $_POST['full_description'],
                        'competence' => $_POST['competence'],
                        'company_description' => $_POST['company_description'],
                        'applicants_count' => 0
                    ];
                    
                    if ($internshipModel->createInternship($data)) {
                        echo json_encode(['success' => true]);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Erreur lors de la création']);
                    }
                    exit();
                    
                case 'update':
                    $id = $_POST['id'] ?? 0;
                    $data = [
                        'title' => $_POST['title'],
                        'company' => $_POST['company'],
                        'location' => $_POST['location'],
                        'type' => $_POST['type'],
                        'domaine' => $_POST['domaine'],
                        'remote' => $_POST['remote'],
                        'salary_base' => $_POST['salary_base'],
                        'start_date' => $_POST['start_date'],
                        'end_date' => $_POST['end_date'],
                        'short_description' => $_POST['short_description'],
                        'full_description' => $_POST['full_description'],
                        'competence' => $_POST['competence'],
                        'company_description' => $_POST['company_description']
                    ];
                    
                    if ($internshipModel->updateInternship($id, $data)) {
                        echo json_encode(['success' => true]);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Erreur lors de la mise à jour']);
                    }
                    exit();
            }
        }
        
        // Gestion des requêtes GET
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'delete':
                    $id = $_GET['id'] ?? 0;
                    if ($internshipModel->deleteInternship($id)) {
                        header('Content-Type: application/json');
                        echo json_encode(['success' => true]);
                        exit;
                    }
                    break;
                    
                case 'get':
                    $id = $_GET['id'] ?? 0;
                    $internship = $internshipModel->getInternshipById($id);
                    header('Content-Type: application/json');
                    echo json_encode($internship);
                    exit;
                    break;
            }
        }
        
        // Récupération de toutes les offres
        $internships = $internshipModel->getAllInternships();
        
        $datas_pages = [
            "description" => "Gestion des offres de stage",
            "title" => "Gestion des offres de stage",
            "views" => "views/pages/management_offerPage.php",
            "layout" => "views/commons/layout.php",
            "style" => "management_offerPage.css",
            "js" => "management_offerPage.js",
            "internships" => $internships
        ];
    
        utilities::renderPage($datas_pages);
    }

    public function management_pilotePage() {
        require_once('./models/PdoModel.php');
        require_once('./models/piloteModel.php');
        
        $userModel = new UserModel();
        $pilots = $userModel->getAllPilots();
    
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $pilots = $userModel->getAllPilots($search);
        
        if (!empty($search) && empty($pilots)) {
            header('Location: ' . ROOT . 'Gestion_des_pilotes?error=not_found');
            exit();
        }
        
        $datas_pages = [
            "description" => "Gestion des pilotes",
            "title" => "Gestion des pilotes",
            "views" => "views/pages/management_pilotePage.php",
            "layout" => "views/commons/layout.php",
            "style" => "management_pilotePage.css",
            "js" => "management_pilotePage.js",
            "pilots" => $pilots
        ];

        utilities::renderPage($datas_pages);
    }

    public function addPilot() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once('./models/piloteModel.php');
            
            $userModel = new UserModel();
            $data = [
                'nom' => htmlspecialchars($_POST['nom']),
                'prenom' => htmlspecialchars($_POST['prenom']),
                'email' => htmlspecialchars($_POST['email']),
                'password' => password_hash('temp123', PASSWORD_DEFAULT),
                'role' => 'pilote'
            ];
            
            if($userModel->createPilot($data)) {
                header('Location: ' . ROOT . 'Gestion_des_pilotes?success=created');
            } else {
                header('Location: ' . ROOT . 'Gestion_des_pilotes?error=create');
            }
            exit();
        }
    }

    public function updatePilot($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once('./models/piloteModel.php');
            
            $userModel = new UserModel();
            $data = [
                'nom' => htmlspecialchars($_POST['nom']),
                'prenom' => htmlspecialchars($_POST['prenom']),
                'email' => htmlspecialchars($_POST['email'])
            ];
            
            if($userModel->updatePilot($id, $data)) {
                header('Location: ' . ROOT . 'Gestion_des_pilotes?success=updated');
            } else {
                header('Location: ' . ROOT . 'Gestion_des_pilotes?error=update');
            }
            exit();
        }
    }

    public function deletePilot($id) {
        require_once('./models/PdoModel.php');
        require_once('./models/piloteModel.php');
        
        $userModel = new UserModel();
        if($userModel->deletePilot($id)) {
            header('Location: ' . ROOT . 'Gestion_des_pilotes?success=deleted');
        } else {
            header('Location: ' . ROOT . 'Gestion_des_pilotes?error=delete');
        }
    }


    public function management_companiesPage(){
        
        $datas_pages=[
            "description"=> "Gestion des entreprises",
            "title"=>"Gestion des entreprises",
            "views"=> "views/pages/management_companiesPage.php",
            "layout"=> "views/commons/layout.php",
            "style"=> "management_companiesPage.css",
            "js"=> "management_companiesPage.js",
        ];

        utilities::renderPage($datas_pages) ;
    }

    


}