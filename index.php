<?php


// Rapporter toutes les erreurs
error_reporting(E_ALL);

// Afficher les erreurs à l'écran
ini_set('display_errors', 1);

// Activer la journalisation des erreurs
ini_set('log_errors', 1);

// Spécifier le fichier de log (à adapter selon ton système)
ini_set('error_log', __DIR__ . '/php_error.log');

// Exemple d'erreur pour test
// echo $undefined_variable;



session_start();
define("ROOT", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? 'https' : 'http') . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']));

require_once("./controllers/MainController.php");
require_once("./controllers/ForgotController.php"); 
require_once("./controllers/CompanyController.php");
require_once("./controllers/ApplyController.php"); 
require_once("./controllers/StudentController.php");

$mainController = new MainController();
$forgotController = new ForgotController();
$companyController = new CompanyController();
$applyController = new ApplyController(); 
$StudentController = new StudentController();

try {
    if(empty($_GET['page'])){
        $url[0] = 'accueil';
    } else {
        $url = explode('/', filter_var($_GET['page'], FILTER_SANITIZE_URL));
    }
    
    switch ($url[0]) {
        case 'accueil': 
            $mainController->homePage(); 
            break;
        
        case 'enregistrement':
            if (isset($url[1]) && $url[1] === 'mot-de-passe-oublie') {
                $forgotController->forgotlinkPage();
            } elseif (isset($url[1]) && $url[1] === 'reset-password') {
                $forgotController->resetPasswordPage();
            } else {
                $mainController->loginPage();
            }
            break;
        
        case 'enregistrement_AP':
            $mainController->loginPage_AP();
            break;

        case 'Profil':
            $mainController->profilPage();
            break;

        case 'Recherche_de_stage':
            $mainController->searchPage();
            break;

        case 'postuler':
            // Délégation au ApplyController
            if (isset($_GET['id'])) {
                $applyController->applyPage();
            } else {
                throw new Exception("Aucune offre spécifiée");
            }
            break;

        case 'statistique_des_offres_de_stage':
            $mainController->stats_offersPage();
            break;

        case 'Gestion_des_offres_de_stage':
            $mainController->management_offerPage();
            break;
        
        case 'Gestion_des_pilotes':
            if(isset($url[1])) {
                switch($url[1]) {
                    case 'ajouter':
                        if($_SERVER['REQUEST_METHOD'] === 'POST') {
                            $mainController->addPilot();
                        }
                        break;
                    case 'modifier':
                        if(isset($url[2]) && $_SERVER['REQUEST_METHOD'] === 'POST') {
                            $mainController->updatePilot($url[2]);
                        }
                        break;
                    case 'supprimer':
                        if(isset($url[2])) {
                            $mainController->deletePilot($url[2]);
                        }
                        break;
                    default:
                        $mainController->management_pilotePage();
                }
            } else {
                $mainController->management_pilotePage();
            }
            break;

        case 'Gestion_des_entreprises':
            $mainController->management_companiesPage();
            break;

        case 'Gestion_des_etudiants':
            $StudentController->management_studentsPage();
        break;
            
        default:
            throw new Exception("La page demandée n'existe pas");
    }
} catch(Exception $e) {
    $mainController->errorPage($e->getMessage()); 
}

