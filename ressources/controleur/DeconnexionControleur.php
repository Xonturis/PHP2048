<?php

class DeconnexionControleur
{
    /**
     * Déconnecte l'utilisateur
     */
    public static function disconnectUser(){
        session_destroy();
        $_SESSION = [];
        Routeur::redirectTo("MainPageControleur", "showPage");
    }
}