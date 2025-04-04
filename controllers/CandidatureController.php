<?php
require_once __DIR__.'/MainController.php';
require_once(__DIR__.'/../models/InternshipModel.php');
require_once(__DIR__.'/../models/CandidatureModel.php');
require_once(__DIR__.'/../models/UserModel.php');

class CandidatureController {
    
    public function management_candidaturePage() {

        $datas_pages = [
            "description" => "Gestion de vos candidatures",
            "title" => "Gestion des candidatures",
            "views" => "views/pages/management_candidaturePage.php",
            "layout" => "views/commons/layout.php",
            "style" => "management_candidaturePage.css",
            "js" => "management_candidaturePage.js",

        ];
        
        utilities::renderPage($datas_pages);
    }
    

}