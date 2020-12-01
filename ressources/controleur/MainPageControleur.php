<?php

require_once PATH_VUE."/MainPageVue.php";
require_once PATH_VUE."/classement/ClassementVue.php";


class MainPageControleur
{
    public static function showPage(){
        if(!isset($_SESSION["user"])){
            Routeur::redirectTo("ConnexionControleur", "displayConnexionPage");
            return;
        }
        MainPageVue::openMainGameContainer();
        PlateauControleur::afficherPlateau();
        ClassementVue::getHtml(ClassementControleur::getClassement(30));
        MainPageVue::closeMainGameContainer();
    }
}