<?php
require_once PATH_VUE."/ErreurVue.php";

class ErreurControleur
{
    public static function showError($toDisplay = array())
    {
        if(isset($_GET["erreur"])){
            $toDisplay["erreur"] = $_GET["erreur"];
        }

        $connecte = isset($_SESSION["user"]);
        $toDisplay["connecte"] = $connecte;
        if($connecte) {
            $toDisplay["pseudo"] = $_SESSION["user"]->getPseudo();
        }

        ErreurVue::getHtml($toDisplay);
    }
}