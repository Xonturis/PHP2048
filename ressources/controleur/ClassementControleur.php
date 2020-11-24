<?php


class ClassementControleur
{
    public static $classement;

    public static function getClassement() : ?Classement
    {
        if(self::$classement == null){
            self::$classement = new Classement();
            return null;
        }
        return self::$classement;
    }

    public static function addScore(){

    }
}