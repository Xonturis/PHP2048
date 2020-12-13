<?php
require_once PATH_MODELE.'/UserDAO.php';
require_once PATH_VUE.'/utilisateurs/ConnexionVue.php';

class ConnexionControleur{


    public static function displayConnexionPage() {
        ConnexionVue::getHtml();
    }

    public static function connexionAttempt(){
        $result = UserDAO::getUser($_GET["username"],$_GET["password"]);
        if($result != NULL){
            if(session_status() == PHP_SESSION_ACTIVE) {
                $_SESSION["user"] = $result;
            }
            Routeur::redirectTo("MainPageControleur", "showPage");
        } else {
            Routeur::redirectTo("MainPageControleur", "showPage");
        }
    }
}
