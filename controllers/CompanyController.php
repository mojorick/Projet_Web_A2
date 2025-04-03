<?php
require_once("./models/CompanyModel.php");

class CompanyController {
    private $companyModel;

    public function __construct() {
        $this->companyModel = new CompanyModel();
    }

    public function management_companiesPage() {
        // Initialiser les variables

        // Récupérer les entreprise

        // Préparer les données pour la vue
        $data = [
            "description" => "Gestion des entreprises",
            "title" => "Gestion des entreprises",
            "views" => "views/pages/management_companiesPage.php",
            "layout" => "views/commons/layout.php",
            "style" => "management_companiesPage.css",
            "js" => "management_companiesPage.js",
        ];

        // Rendre la vue avec les données
        utilities::renderPage($data);
    }
}
?>
