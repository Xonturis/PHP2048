<?php

require_once "SqliteConnexion.php";
require_once PATH_METIER.'/classement/Classement.php';
require_once PATH_METIER.'/classement/Score.php';

class ClassementDao{

    /**
     * Retourne un classement contenant les "nb" premiers scores
     * @param int $nb nombre de score à récuperer
     * @return Classement|null  le classement
     */
    public static function getElements(int $nb) : ?Classement{
        $statement = SqliteConnexion::getInstance()->getConnexion()->prepare('SELECT pseudo,score,gagne FROM PARTIES ORDER BY score DESC LIMIT :nb;');
        // Pour afficher uniquement le meilleur score des joueurs dans le classement
//        $statement = SqliteConnexion::getInstance()->getConnexion()->prepare('SELECT pseudo,score,gagne FROM PARTIES GROUP BY pseudo HAVING max(score) ORDER BY score DESC LIMIT :nb;');
        $statement->bindParam(':nb', $nb);
        $statement->execute();
        $result = $statement->fetchAll();
        $classment = new Classement();
        foreach ($result as $value){
            $classment->addScore(new Score($value["pseudo"],$value["score"],$value["gagne"]));
        }
        return $classment;
    }


    /**
     * Ajoute le score à a bdd
     * @param $score Score le score
     */
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
