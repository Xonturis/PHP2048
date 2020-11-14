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

    // Traite une requête entrante
    public static function routerRequete() {
        ob_start();

        HeaderVue::getHtml();

        $isConnected = true;
        var_dump($_POST);
        if(!isset($_SESSION["user"]) && !isset($_POST["controller"])) {
            // Router vers la connexion
            ConnexionVue::getHtml();
            $isConnected = false;
        }

        if($isConnected) {
            echo isset($_SESSION["user"]);
            $ctrlName = $_POST["controller"];
            $mthdName = $_POST["method"];

            try {
                $reflectionClass = new ReflectionClass($ctrlName);
                $method = $reflectionClass->getMethod($mthdName);
                $method->invoke(NULL);
            } catch (ReflectionException $exp) {
                // todo handle err
            }
        }

        FooterVue::getHtml();
        $content = ob_get_clean();
        require (HOME_SITE."/site_template.php");
    }
}