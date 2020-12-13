<?php

require_once PATH_METIER.'/classement/Classement.php';
require_once PATH_METIER.'/classement/Score.php';

class ClassementDao{

    public static function getElements(int $nb) : ?Classement{
        $statement = SqliteConnexion::getInstance()->getConnexion()->prepare('SELECT pseudo,score FROM PARTIES ORDER BY score ASC LIMIT :nb;');
        $statement->bindParam(':nb', $nb);
        $statement->execute();
        $result = $statement->fetchAll();

        $classment = new Classement();
        foreach ($result as $value){
            $classment->addScore(new Score($value["pseudo"],$value["score"],0));
        }
        return $classment;
    }

    public static function addElement($score){
        $statement = SqliteConnexion::getInstance()->getConnexion()->prepare('INSERT INTO PARTIES (pseudo,gagne,score) VALUES(:pseudo,:gagne,:score);');
        $pseudo = $score->getName();
        $gagne = $score->getGagne();
        $score = $score->getScore();

        $statement->bindParam(':pseudo', $pseudo);
        $statement->bindParam(':gagne', $gagne);
        $statement->bindParam(':score', $score);

        try{
            $statement->execute();
        } catch (PDOException $e){

        }
    }
}
