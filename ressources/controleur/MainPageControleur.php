<?php

require_once PATH_VUE."/MainPageVue.php";


class MainPageControleur
{
    public static function showPage(){
        if(!isset($_SESSION["user"])){
            Routeur::redirectTo("ConnexionControleur", "displayConnexionPage");
            return;
        }
        MainPageVue::getHtml();
    }
}