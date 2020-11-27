<?php

// Visiblement le seul moyen d'importer tous les fichiers d'un dossier
// https://stackoverflow.com/questions/2692332/require-all-files-in-a-folder
foreach (scandir(PATH_CONTROLEUR) as $filename) {
    $path = PATH_CONTROLEUR. '/' . $filename;
    if (is_file($path)) {
        require_once($path);
    }
}

class Routeur {

    private static function startOb() {
        ob_clean();
        ob_start();
    }

    private static  function processPageToDisplay() {
        self::startOb();
        HeaderVue::getHtml();
        self::callReflectiveController();
    }

    public static function redirectTo(string $controller, string $method) {
        $_GET["controller"] = $controller;
        $_GET["method"] = $method;
        self::processPageToDisplay();
    }

    private static function displayPage() {
        FooterVue::getHtml();
        $content = ob_get_clean();
        require (HOME_SITE."/site_template.php");
    }

    // Traite une requête entrante
    public static function routerRequete() {
        self::applyDefaults();
        self::processPageToDisplay();
        self::displayPage();
    }

// todo remove after approval
 //  region To Remove
//    public static function routerRequete() {
//        ob_start();
//
//        HeaderVue::getHtml();
//
//        var_dump($_GET);
//
//        // Default controller
//        self::applyDefaults();
//
//        $ctrlName = $_GET["controller"];
//        $mthdName = $_GET["method"];
//
//        try {
//            $reflectionClass = new ReflectionClass($ctrlName);
//            $method = $reflectionClass->getMethod($mthdName);
//            $method->invoke(NULL);
//        } catch (ReflectionException $exp) {
//            echo("ERROR<br>");
//            echo($exp->getMessage());
//            // todo handle err
//        }
//
//
//        FooterVue::getHtml();
//        $content = ob_get_clean();
//        require (HOME_SITE."/site_template.php");
//    }
//endregion

    private static function callReflectiveController() {
        $ctrlName = $_GET["controller"];
        $mthdName = $_GET["method"];

        try {
            $reflectionClass = new ReflectionClass($ctrlName);
            $method = $reflectionClass->getMethod($mthdName);
            $method->invoke(NULL);
        } catch (ReflectionException $exp) {
            echo("ERROR<br>");
            echo($exp->getMessage());
            // todo handle err
        }
    }

    private static function applyDefaults() {
        if(!isset($_GET["controller"])){
            $_GET["controller"] = "MainPageControleur";
            $_GET["method"] = "showPage";
        }
    }
}