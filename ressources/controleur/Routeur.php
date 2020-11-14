<?php

foreach (scandir(dirname(PATH_CONTROLEUR)) as $filename) {
    $path = dirname(PATH_CONTROLEUR) . '/' . $filename;
    if (is_file($path)) {
        require_once($path);
    }
}

class Routeur {

    // Traite une requête entrante
    public static function routerRequete() {
        ob_start();
        HeaderVue::getHtml();

        if(!isset($_SESSION["user"])){
            // Router vers la connexion
            ConnexionVue::getHtml();
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

        $ctrlName = $_POST["controller"];
        $mthdName = $_POST["method"];

        $reflectionClass = new ReflectionClass($ctrlName);
        try {
            $method = $reflectionClass->getMethod($mthdName);
            $method->invoke(NULL);
        }catch (ReflectionException $exp) {
            // todo handle err
        }

        FooterVue::getHtml();
        $content = ob_get_clean();
        require (HOME_SITE."/site_template.php");
    }
}