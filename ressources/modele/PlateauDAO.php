<?php

require_once "SqliteConnexion.php";
require_once PATH_METIER."/plateau/Plateau.php";

class PlateauDAO
{

    /**
     * Sauvegarde le plateau en base
     * @param Plateau $plateau
     * @param User $user
     */
    public static function savePlateauToDB(Plateau $plateau, User $user) {
        $serialized = serialize($plateau);
        $pseudo = $user->getPseudo();

        $statement = SqliteConnexion::getInstance()->getConnexion()->prepare('REPLACE INTO PARTIES_EN_COURS(pseudo, partie_blob) VALUES(:pseudo, :partie_blob);');
        $statement->bindParam(':pseudo', $pseudo);
        $statement->bindParam(':partie_blob', $serialized);
        $statement->execute();
    }

    /**
     * Récupère la partie en cours du user ou en créée une nouvelle
     * @param User $user
     * @return Plateau
     */
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

    /**
     * Récupère le plateau avant le dernier mouvement et supprime le "rewind" de la base
     * @param User $user
     * @return Plateau
     */
    public static function getRewind(User $user) : Plateau {
        $statement = SqliteConnexion::getInstance()->getConnexion()->prepare('SELECT blob FROM REWIND WHERE pseudo = :pseudo ORDER BY mouvement DESC LIMIT 1');
        $pseudo = $user->getPseudo();
        $statement->bindParam(':pseudo', $pseudo);
        $statement->execute();
        $fetched=$statement->fetch(PDO::FETCH_ASSOC);
        self::removeRewind($user);
        return unserialize($fetched["blob"]); // rewinded
    }

    /**
     * Supprime le "rewind" le plus récent de l'user
     * @param User $user
     */
    public static function removeRewind(User $user) {
        $statement = SqliteConnexion::getInstance()->getConnexion()->prepare('DELETE FROM REWIND WHERE pseudo = :pseudo AND mouvement = (SELECT mouvement FROM REWIND WHERE pseudo = :pseudo ORDER BY mouvement DESC LIMIT 1)');
        $pseudo = $user->getPseudo();
        $statement->bindParam(':pseudo', $pseudo);
        $statement->execute();
    }

    /**
     * Supprime de la base de tous les rewinds de l'user
     * @param User $user
     */
    public static function removeAllRewinds(User $user) {
        $statement = SqliteConnexion::getInstance()->getConnexion()->prepare('DELETE FROM REWIND WHERE pseudo = :pseudo');
        $pseudo = $user->getPseudo();
        $statement->bindParam(':pseudo', $pseudo);
        $statement->execute();
    }

    /**
     * Ajoute un rewind a la base
     * @param Plateau $plateau
     * @param User $user
     */
    public static function addRewind(Plateau $plateau, User $user) {
        $statement = SqliteConnexion::getInstance()->getConnexion()->prepare('INSERT INTO REWIND VALUES(:pseudo, (SELECT coalesce(max(mouvement),0) as mouvement FROM REWIND WHERE pseudo = :pseudo) + 1, :blob)');
        $pseudo = $user->getPseudo();
        $serialized = serialize($plateau);
        $statement->bindParam(':pseudo', $pseudo);
        $statement->bindParam(':blob', $serialized);
        $statement->execute();
    }

    /**
     * @param User $user
     * @return bool true si l'user a un rewind (a fait au moins un mouvement en gros) false sinon
     */
    public static function hasRewinds(User $user) : bool {
        $statement = SqliteConnexion::getInstance()->getConnexion()->prepare('SELECT null FROM REWIND WHERE pseudo = :pseudo LIMIT 1');
        $pseudo = $user->getPseudo();
        $statement->bindParam(':pseudo', $pseudo);
        $statement->execute();
        $fetch = $statement->fetch();
        return $fetch != NULL && count($fetch)>0;
    }

}