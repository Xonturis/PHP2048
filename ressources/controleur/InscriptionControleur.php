<?php
require_once PATH_MODELE.'/UserDAO.php';


class InscriptionControleur
{
    public static function showSignUpPage(){
        InscriptionVue::getHtml();
    }

    public static function registerUser(){
        UserDAO::addUser($_GET["username"],$_GET["password"]);
        Routeur::redirectTo("MainPageControleur", "showPage");
    }
}