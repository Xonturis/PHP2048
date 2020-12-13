<?php

require_once PATH_METIER.'/classement/Classement.php';
require_once PATH_METIER.'/classement/Score.php';

class ClassementDao{

    public static function getElements(int $nb) : ?Classement{
        $statement = SqliteConnexion::getInstance()->getConnexion()->prepare('SELECT pseudo,score FROM PARTIES where gagne=1 ORDER BY score ASC LIMIT :nb;');;
        $statement->bindParam(':nb', $nb);
        $statement->execute();
        $result = $statement->fetchAll();

        $classment = new Classement();
        foreach ($result as $value){
            $classment->addScore(new Score($value["pseudo"],$value["score"]));
        }
        return $classment;
    }

    public static function addElement($score){
        $statement = SqliteConnexion::getInstance()->getConnexion()->prepare('INSERT INTO PARTIE VALUES();');;
        $statement->bindParam(':nb', $nb);
        $statement->execute();
    }
}
