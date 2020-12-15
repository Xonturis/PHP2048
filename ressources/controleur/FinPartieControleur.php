<?php


class FinPartieControleur
{

    public static function perdu() {
        $user = $_SESSION["user"];
        HeaderVueConnected::getHtml($user->getPseudo());
        DefaiteVue::getHtml($_GET["data"]);
        FooterVue::getHtml();
        $plateau = PlateauDAO::getOrCreateCurrentPlateau($user);
        $plateau->reset();
        PlateauDAO::savePlateauToDB($plateau, $user);
    }

    public static function gagne() {
        $user = $_SESSION["user"];
        HeaderVueConnected::getHtml($user->getPseudo());
        VictoireVue::getHtml($_GET["data"]);
        FooterVue::getHtml();
        $plateau = PlateauDAO::getOrCreateCurrentPlateau($user);
        $plateau->reset();
        PlateauDAO::savePlateauToDB($plateau, $user);
    }

}