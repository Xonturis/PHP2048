<?php

require_once PATH_VUE."/plateau/PlateauVue.php";
require_once PATH_VUE."/plateau/LigneVue.php";
require_once PATH_VUE."/plateau/TuileVue.php";

require_once PATH_METIER."/plateau/Plateau.php";
require_once PATH_METIER."/plateau/Ligne.php";
require_once PATH_METIER."/plateau/Tuile.php";

require_once PATH_MODELE."/PlateauDAO.php";

class PlateauControleur
{

    const HAUT = 1;
    const BAS = 2;
    const GAUCHE = 3;
    const DROITE = 4;

    public static function mouvement() {
        $mouvement = $_GET["mouvement"];
        if(preg_match("/(haut)|(bas)|(gauche)|(droite)/", $mouvement)){
            $direction = array_search($mouvement, array("haut", "bas", "gauche", "droite"));
            $plateau = PlateauDAO::getOrCreateCurrentPlateau($_SESSION["user"]);

            $plateau->unflagMergeTuiles();
            $plateau->move($direction);
            $plateau->aleatTuile();

            $start = time();
            PlateauDAO::savePlateauToDB($plateau);
            $end = time();
            $total = $end-$start;
            echo $total;
            if($plateau->perdu()) {
                self::afficherFin($plateau);
            }else {
                self::afficherPlateau($plateau);
            }
        }
    }

    public static function afficherPlateau(Plateau $plateau = NULL) {
        if($plateau == null)
            $plateau = PlateauDAO::getOrCreateCurrentPlateau($_SESSION["user"]);
        PlateauVue::getHtml($plateau->getIntegerGrid());
    }

    private static function afficherFin(Plateau $plateau){
        if($plateau->getMaxTuile() >= 2048) {
            VictoireVue::getHtml(array("maxTuile" => $plateau->getMaxTuile(), "score" => $plateau->getScore()));
        } else {
            DefaiteVue::getHtml(array("maxTuile" => $plateau->getMaxTuile(), "score" => $plateau->getScore()));
        }
        PlateauVue::getHtml($plateau->getIntegerGrid());
    }
}