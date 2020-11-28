<?php

class ClassementDao{
    public static function getElements(int $nb) : ?Classement{
        $statement = SqliteConnexion::getInstance()->getConnexion()->prepare('SELECT pseudo,score FROM PARTIES where gagne=1 ORDER BY score ASC LIMIT :nb;');;
        $statement->bindParam(':nb', $nb);
        $statement->execute();
        $fetched=$statement->fetch(PDO::FETCH_ASSOC);

    }
}
