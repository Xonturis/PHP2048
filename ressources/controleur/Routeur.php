<?php



class Routeur {

    private static function startOb() {
        ob_clean();
        ob_start();
    }

    private static  function processPageToDisplay() {
        self::startOb();
        self::callReflectiveController();
    }

    public static function redirectTo(string $controller, string $method) {
        $_GET["controller"] = $controller;
        $_GET["method"] = $method;
        self::processPageToDisplay();
    }

    private static function displayPage() {
        $content = ob_get_clean();
        require(HOME_SITE . "/vue/templates/site_template.php");
    }

    // Traite une requête entrante
    public static function routerRequete() {
        self::applyDefaults();
        self::processPageToDisplay();
        self::displayPage();
    }

    private static function callReflectiveController() {
        $ctrlName = $_GET["controller"];
        $mthdName = $_GET["method"];

        try {
            $path = PATH_CONTROLEUR. '/' . $ctrlName.".php";
            require_once($path);
            $reflectionClass = new ReflectionClass($ctrlName);
            $method = $reflectionClass->getMethod($mthdName);
            $method->invoke(NULL);
        } catch (Exception $exp) {
            ErreurVue::getHtml();
        }
    }

    private static function applyDefaults() {
        if(!isset($_GET["controller"])){
            $_GET["controller"] = "MainPageControleur";
            $_GET["method"] = "showPage";
        }
    }
}