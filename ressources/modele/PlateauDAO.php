<?php

require_once PATH_METIER."/plateau/Plateau.php";

class PlateauDAO
{

    public static function savePlateauToDB(Plateau $plateau) {
        $serialized = serialize($plateau);
        $pseudo = $_SESSION["user"]->getPseudo();

        $statement = SqliteConnexion::getInstance()->getConnexion()->prepare('REPLACE INTO PARTIES_EN_COURS(pseudo, partie_blob) VALUES(:pseudo, :partie_blob);');;
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

//        var_dump($fetched);

        if($fetched == false)
            return new Plateau(); // no current game

        return unserialize($fetched["partie_blob"]); // current game
    }

}