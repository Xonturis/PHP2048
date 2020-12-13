<?php

require_once PATH_VUE."/plateau/PlateauVue.php";
require_once PATH_VUE."/plateau/LigneVue.php";
require_once PATH_VUE."/plateau/TuileVue.php";

require_once PATH_VUE."/jeu/DefaiteVue.php";
require_once PATH_VUE."/jeu/VictoireVue.php";

require_once PATH_METIER."/plateau/Plateau.php";
require_once PATH_METIER."/plateau/Ligne.php";
require_once PATH_METIER."/plateau/Tuile.php";

require_once PATH_MODELE."/PlateauDAO.php";

class PlateauControleur
{

    private static $plateau;

    public static function reset() {
        self::$plateau = PlateauDAO::getOrCreateCurrentPlateau($_SESSION["user"]);
        self::$plateau->reset();
        MainPageControleur::showPage();
    }

    public static function mouvement() {
        $mouvement = $_GET["mouvement"];
        if(preg_match("/(haut)|(bas)|(gauche)|(droite)/", $mouvement)){
            $direction = array_search($mouvement, array("haut", "bas", "gauche", "droite"));
            self::$plateau = PlateauDAO::getOrCreateCurrentPlateau($_SESSION["user"]);

            self::$plateau->unflagMergeTuiles();
            self::$plateau->move($direction);
            self::$plateau->aleatTuile();

            if(self::$plateau->perdu()) {
                ClassementControleur::addScore(new Score($_SESSION["user"]->getPseudo(),self::$plateau->getScore(),self::$plateau->getMaxTuile() >= 2048));
                self::afficherFin(self::$plateau);
                self::$plateau->reset();
            }else {
                MainPageControleur::showPage();
            }
        }
    }

    public static function afficherPlateau() {
        if(self::$plateau == null)
            self::$plateau = PlateauDAO::getOrCreateCurrentPlateau($_SESSION["user"]);
        PlateauVue::getHtml(self::$plateau->getIntegerGrid());
        PlateauDAO::savePlateauToDB(self::$plateau, $_SESSION["user"]);
    }

    private static function afficherFin(Plateau $plateau){
        $_GET["data"] = array("maxTuile" => $plateau->getMaxTuile(), "score" => $plateau->getScore());
        Routeur::redirectTo("FinPartieControleur", $plateau->getMaxTuile() >= 2048?"gagne":"perdu");
    }
}