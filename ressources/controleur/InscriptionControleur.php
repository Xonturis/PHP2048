<?php
require_once PATH_MODELE.'/UserDAO.php';
require_once PATH_VUE.'/utilisateurs/InscriptionVue.php';
require_once PATH_VUE.'/ErreurVue.php';

class InscriptionControleur
{
    /**
     * Affiche la vue d'inscription
     */
    public static function showSignUpPage(){
        InscriptionVue::getHtml();
    }

    /**
     * Ajoute l'utilisateur à la base de données.
     */
    public static function registerUser(){
        $res = UserDAO::addUser($_GET["username"],$_GET["password"]);
        if($res){
            Routeur::redirectTo("MainPageControleur", "showPage");
        }
        else{
            Routeur::redirectTo("ErreurControleur", "showError");
        }
    }
}