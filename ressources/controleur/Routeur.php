<?php

// Visiblement le seul moyen d'importer tous les fichiers d'un dossier
// https://stackoverflow.com/questions/2692332/require-all-files-in-a-folder
foreach (scandir(dirname(PATH_CONTROLEUR."/")) as $filename) {
    $path = dirname(PATH_CONTROLEUR."/") . $filename;
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
        if(!isset($_SESSION["user"])){
            // Router vers la connexion
            ConnexionVue::getHtml();
            $isConnected = false;
        }


        // ?controller=.....&methode=.....
//        if(isset($_GET["controller"])) {
//            switch ($_GET["controller"]) {
//                case "ControleurAuthentification":
//                    switch ($_GET["method"]) {
//                        case "authPseudo":
//                            $this->ctrlAuthentification->authPseudo();
//                            break;
//                    }
//                    break;
//
//                case "ControleurMessage";
//                    switch ($_GET["method"]) {
//                        case "afficher":
//                            $this->ctrlMessage->afficher();
//                            break;
//                        case "ajoutMessage":
//                            $this->ctrlMessage->ajoutMessage();
//                            $this->ctrlMessage->afficher();
//                            break;
//                    }
//            }
//        }else{
//            $this->ctrlAuthentification->accueil();
//        }

        if($isConnected) {
            $ctrlName = $_POST["controller"];
            $mthdName = $_POST["method"];

            $reflectionClass = new ReflectionClass($ctrlName);
            try {
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