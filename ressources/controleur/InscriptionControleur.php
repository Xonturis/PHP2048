<?php
require_once PATH_MODELE.'/UserDAO.php';
require_once PATH_VUE.'/structure/FooterVue.php';
require_once PATH_VUE.'/structure/HeaderVue.php';


class InscriptionControleur
{
    public static function showSignUpPage(){
        HeaderVue::getHtml();
        InscriptionVue::getHtml();
        FooterVue::getHtml();
    }

    public static function registerUser(){
        UserDAO::addUser($_GET["username"],$_GET["password"]);
        Routeur::redirectTo("MainPageControleur", "showPage");
    }
}