<?php

require_once PATH_MODELE.'/ClassementDAO.php';

class ClassementControleur
{
    public static $classement;

    /**
     * @param $nb integer nommbre de résultat maximal voulu
     * @return Classement|null Retourne un classement.
     */
    public static function getClassement($nb) : ?Classement
    {
        return ClassementDao::getElements($nb);
    }

    /**
     * @param $score Score le score à ajouter en BDD
     */
    public static function addScore($score){
        ClassementDao::addElement($score);
    }
}