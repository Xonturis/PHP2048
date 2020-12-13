<?php

class DeconnexionControleur
{
    public static function disconnectUser(){
        session_destroy();
        $_SESSION = [];
        Routeur::redirectTo("MainPageControleur", "showPage");
    }
}