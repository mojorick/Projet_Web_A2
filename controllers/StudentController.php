<?php
require_once('./models/StudentModel.php');

class StudentController {

    public function management_studentsPage() {
    
        $datas_pages = [
            "description" => "Gestion des étudiants",
            "title" => "Gestion des étudiants",
            "views" => "views/pages/management_studentsPage.php",
            "layout" => "views/commons/layout.php",
            "style" => "management_studentsPage.css",
            "js" => "management_studentsPage.js",
        ];
    
        utilities::renderPage($datas_pages);
    }

}