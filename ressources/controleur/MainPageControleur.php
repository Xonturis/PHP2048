<?php

require_once PATH_VUE."/MainPageVue.php";
require_once PATH_VUE."/classement/ClassementVue.php";
require_once PATH_VUE.'/structure/FooterVue.php';
require_once PATH_VUE.'/structure/HeaderVueConnected.php';


class MainPageControleur
{
    public static function showPage(){
        if(!isset($_SESSION["user"])){
            Routeur::redirectTo("ConnexionControleur", "displayConnexionPage");
            return;
        }

        HeaderVueConnected::getHtml($_SESSION["user"]);
        MainPageVue::openMainGameContainer();
        PlateauControleur::afficherPlateau();
        ClassementVue::getHtml(ClassementControleur::getClassement(30));
        MainPageVue::closeMainGameContainer();
        FooterVue::getHtml();
    }
}