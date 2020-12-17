<?php

require_once "SqliteConnexion.php";
require_once PATH_METIER."/plateau/Plateau.php";

class PlateauDAO
{

    public static function savePlateauToDB(Plateau $plateau, User $user) {
        $serialized = serialize($plateau);
        $pseudo = $user->getPseudo();

        $statement = SqliteConnexion::getInstance()->getConnexion()->prepare('REPLACE INTO PARTIES_EN_COURS(pseudo, partie_blob) VALUES(:pseudo, :partie_blob);');
        $statement->bindParam(':pseudo', $pseudo);
        $statement->bindParam(':partie_blob', $serialized);
        $statement->execute();
    }

    public static function getOrCreateCurrentPlateau(User $user) : Plateau {
        $statement = SqliteConnexion::getInstance()->getConnexion()->prepare('SELECT partie_blob FROM PARTIES_EN_COURS WHERE pseudo = :pseudo;');
        $pseudo = $user->getPseudo();
        $statement->bindParam(':pseudo', $pseudo);
        $statement->execute();
        $fetched=$statement->fetch(PDO::FETCH_ASSOC);

        if(!$fetched) {
            return new Plateau(); // no current game
        }

        return unserialize($fetched["partie_blob"]); // current game
    }

    public static function getRewind(User $user) : Plateau {
        $statement = SqliteConnexion::getInstance()->getConnexion()->prepare('SELECT blob FROM REWIND WHERE pseudo = :pseudo ORDER BY mouvement DESC LIMIT 1');
        $pseudo = $user->getPseudo();
        $statement->bindParam(':pseudo', $pseudo);
        $statement->execute();
        $fetched=$statement->fetch(PDO::FETCH_ASSOC);
        self::removeRewind($user);
        return unserialize($fetched["blob"]); // rewinded
    }

    public static function removeRewind(User $user) {
        $statement = SqliteConnexion::getInstance()->getConnexion()->prepare('DELETE FROM REWIND WHERE pseudo = :pseudo AND mouvement = (SELECT mouvement FROM REWIND WHERE pseudo = :pseudo ORDER BY mouvement DESC LIMIT 1)');
        $pseudo = $user->getPseudo();
        $statement->bindParam(':pseudo', $pseudo);
        $statement->execute();
    }

    public static function removeAllRewinds(User $user) {
        $statement = SqliteConnexion::getInstance()->getConnexion()->prepare('DELETE FROM REWIND WHERE pseudo = :pseudo');
        $pseudo = $user->getPseudo();
        $statement->bindParam(':pseudo', $pseudo);
        $statement->execute();
    }

    public static function addRewind(Plateau $plateau, User $user) {
        $statement = SqliteConnexion::getInstance()->getConnexion()->prepare('INSERT INTO REWIND VALUES(:pseudo, (SELECT coalesce(max(mouvement),0) as mouvement FROM REWIND WHERE pseudo = :pseudo) + 1, :blob)');
        $pseudo = $user->getPseudo();
        $serialized = serialize($plateau);
        $statement->bindParam(':pseudo', $pseudo);
        $statement->bindParam(':blob', $serialized);
        $statement->execute();
    }

    public static function hasRewinds(User $user) : bool {
        $statement = SqliteConnexion::getInstance()->getConnexion()->prepare('SELECT null FROM REWIND WHERE pseudo = :pseudo LIMIT 1');
        $pseudo = $user->getPseudo();
        $statement->bindParam(':pseudo', $pseudo);
        $statement->execute();
        $fetch = $statement->fetch();
        return $fetch != NULL && count($fetch)>0;
    }

}