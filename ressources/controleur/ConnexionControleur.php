<?php
require_once PATH_MODELE.'/UserDAO.php';

class ConnexionControleur{


    public static function displayConnexionPage() {
        ConnexionVue::getHtml();
    }

    public static function connexionAttempt(){
        $result = UserDAO::getUser($_GET["username"],$_GET["password"]);
        if($result != NULL){
            $result->setCurrentUser();
            Routeur::redirectTo("MainPageControleur", "showPage");
        } else {
            //do something
        }
    }
}
