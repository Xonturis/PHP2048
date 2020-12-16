<?php

require_once PATH_CONTROLEUR."/PlateauControleur.php";
require_once PATH_CONTROLEUR."/ClassementControleur.php";

require_once PATH_VUE."/MainPageVue.php";
require_once PATH_VUE."/classement/ClassementVue.php";
require_once PATH_VUE."/controls/OptionVue.php";


class MainPageControleur
{
    /**
     * Affiche la page principale
     */
    public static function showPage(){
        if(!isset($_SESSION["user"])){
            Routeur::redirectTo("ConnexionControleur", "displayConnexionPage");
            return;
        }
        $user = $_SESSION["user"];

        HeaderVueConnected::getHtml($user->getPseudo());
        MainPageVue::openMainGameContainer();

        MainPageVue::openGameContainer();
        OptionVue::getHtml(PlateauDAO::hasRewinds($user));
        PlateauControleur::afficherPlateau();
        MainPageVue::closeGameContainer();

        ClassementVue::getHtml(ClassementControleur::getClassement(30));
        MainPageVue::closeMainGameContainer();
    }
}