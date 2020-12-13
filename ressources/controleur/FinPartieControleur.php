<?php


class FinPartieControleur
{

    public static function perdu() {
        HeaderVueConnected::getHtml($_SESSION["user"]->getPseudo());
        DefaiteVue::getHtml($_GET["data"]);
        FooterVue::getHtml();
    }

    public static function gagne() {
        HeaderVueConnected::getHtml($_SESSION["user"]->getPseudo());
        VictoireVue::getHtml($_GET["data"]);
        FooterVue::getHtml();
    }

}