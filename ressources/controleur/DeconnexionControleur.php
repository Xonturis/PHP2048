<?php

require_once PATH_VUE.'/structure/FooterVue.php';
require_once PATH_VUE.'/structure/HeaderVue.php';

class DeconnexionControleur
{
    public static function disconnectUser(){
        session_destroy();
        $_SESSION = [];
        HeaderVue::getHtml();
        Routeur::redirectTo("MainPageControleur", "showPage");
        FooterVue::getHtml();
    }
}