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

require_once PATH_CONTROLEUR."/MainPageControleur.php";
require_once PATH_CONTROLEUR."/ClassementControleur.php";


class PlateauControleur
{

    private static $plateau;

    public static function reset() {
        $user = $_SESSION["user"];
        PlateauDAO::removeAllRewinds($user);
        self::$plateau = PlateauDAO::getOrCreateCurrentPlateau($user);
        self::$plateau->reset();
        PlateauDAO::savePlateauToDB(self::$plateau, $_SESSION["user"]);
        MainPageControleur::showPage();
    }

    public static function mouvement() {
        $mouvement = $_GET["mouvement"];
        $user = $_SESSION["user"];
        if(preg_match("/(haut)|(bas)|(gauche)|(droite)/", $mouvement)){
            $direction = array_search($mouvement, array("haut", "bas", "gauche", "droite"));
            self::$plateau = PlateauDAO::getOrCreateCurrentPlateau($user);

            PlateauDAO::addRewind(self::$plateau, $_SESSION["user"]);
            self::$plateau->unflagMergeTuiles();
            if(self::$plateau->move($direction)) {
                self::$plateau->aleatTuile();
            }
            PlateauDAO::savePlateauToDB(self::$plateau, $_SESSION["user"]);

            if(self::$plateau->perdu()) {
                ClassementControleur::addScore(new Score($user->getPseudo(),self::$plateau->getScore(),self::$plateau->getMaxTuile() >= 2048));
                PlateauDAO::removeAllRewinds($user);
                self::afficherFin(self::$plateau);
                self::$plateau->reset();
            }else {
                MainPageControleur::showPage();
            }
        }
    }

    public static function rewind() {
        $user = $_SESSION["user"];
        if(!PlateauDAO::hasRewinds($user)) {
            MainPageControleur::showPage();
            return;
        }
        $rewindCount = 0;
        self::$plateau = PlateauDAO::getOrCreateCurrentPlateau($_SESSION["user"]);
        if(self::$plateau != null) {
            $rewindCount = self::$plateau->getRewindCount();
        }

        self::$plateau = PlateauDAO::getRewind($user);
        self::$plateau->incrementRewindCount($rewindCount);
        PlateauDAO::savePlateauToDB(self::$plateau, $_SESSION["user"]);
        MainPageControleur::showPage();
    }

    public static function afficherPlateau() {
        if(self::$plateau == null) {
            self::$plateau = PlateauDAO::getOrCreateCurrentPlateau($_SESSION["user"]);
        }
        $data = array("maxTuile" => self::$plateau->getMaxTuile(), "score" => self::$plateau->getScore(), "grid" => self::$plateau->getIntegerGrid());
        PlateauVue::getHtml($data);
    }

    private static function afficherFin(Plateau $plateau){
        $_GET["data"] = array("maxTuile" => $plateau->getMaxTuile(), "score" => $plateau->getScore());
        Routeur::redirectTo("FinPartieControleur", $plateau->getMaxTuile() >= 2048?"gagne":"perdu");
    }
}