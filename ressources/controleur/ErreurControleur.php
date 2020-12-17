<?php
require_once PATH_VUE."/ErreurVue.php";

class ErreurControleur
{
    public static function showError()
    {
        $toDisplay = array();
        if(isset($_GET["erreur"])){
            $toDisplay["erreur"] = $_GET["erreur"];
        }

        if(isset($_GET["user"])){
            $toDisplay["connected"] = 1;
        }
        else{
            $toDisplay["connected"] = 0;
        }

        ErreurVue::getHtml($toDisplay);
    }
}