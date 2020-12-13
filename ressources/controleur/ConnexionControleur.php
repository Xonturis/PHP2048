<?php
require_once PATH_MODELE.'/UserDAO.php';
require_once PATH_VUE.'/utilisateurs/ConnexionVue.php';

class ConnexionControleur{

    /**
     * Affiche la vue de connexion
     */
    public static function displayConnexionPage() {
        ConnexionVue::getHtml();
    }

    /**
     * Vérifie si l'utilisateur existe est que le mot de passe est bon.
     */
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
