<?php

require_once PATH_VUE."/plateau/PlateauVue.php";
require_once PATH_VUE."/plateau/LigneVue.php";
require_once PATH_VUE."/plateau/TuileVue.php";

require_once PATH_METIER."/plateau/Plateau.php";
require_once PATH_METIER."/plateau/Ligne.php";
require_once PATH_METIER."/plateau/Tuile.php";

class PlateauControleur
{

    const HAUT = 1;
    const BAS = 2;
    const GAUCHE = 3;
    const DROITE = 4;

    public static function mouvement() {
        $mouvement = $_POST["mouvement"];
        if(preg_match("/(haut)|(bas)|(gauche)|(droite)/", $mouvement)){
            $plateau = $_SESSION["plateau"];
            try {
                $method = new ReflectionMethod("Plateau", $mouvement);
                $method->invoke($plateau);
            } catch (ReflectionException $e) {
                echo "ERROR PlateauControleur<br>";
                echo ($e->getMessage());
            }
            $plateau->aleatTuile();
        }
        PlateauVue::getHtml();
    }
}