<?php
require_once PATH_VUE."/ErreurVue.php";

class ErreurControleur
{
    public static function showError()
    {
        if(isset($_GET["erreur"])){
            $toDisplay = $_GET["erreur"];
        }
        else{
            $toDisplay = NULL;
        }
        ErreurVue::getHtml($toDisplay);
    }
}