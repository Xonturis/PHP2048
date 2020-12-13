<?php

require_once PATH_MODELE.'/ClassementDAO.php';

class ClassementControleur
{
    public static $classement;

    public static function getClassement($nb) : ?Classement
    {
        return ClassementDao::getElements($nb);
    }

    public static function addScore($score){
        ClassementDao::addElement($score);
    }
}