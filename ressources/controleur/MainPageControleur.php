<?php

require_once PATH_VUE."/MainPageVue.php";
require_once PATH_VUE."/classement/ClassementVue.php";
require_once PATH_VUE."/controls/OptionVue.php";


class MainPageControleur
{
    public static function showPage(){
        if(!isset($_SESSION["user"])){
            Routeur::redirectTo("ConnexionControleur", "displayConnexionPage");
            return;
        }

        MainPageVue::openMainGameContainer();

        MainPageVue::openGameContainer();
        OptionVue::getHtml();
        PlateauControleur::afficherPlateau();
        MainPageVue::closeGameContainer();

        ClassementVue::getHtml(ClassementControleur::getClassement(30));
        MainPageVue::closeMainGameContainer();
    }
}