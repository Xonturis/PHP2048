<?php
require_once "SqliteConnexion.php";
require_once PATH_METIER."/User.php";

class UserDAO
{

    public static function getUser($pseudo,$password) : ?User{
        $statement = SqliteConnexion::getInstance()->getConnexion()->prepare('SELECT password FROM JOUEURS where pseudo = :pseudo;');;
        $statement->bindParam(':pseudo', $pseudo);
        $statement->execute();
        $fetched=$statement->fetch(PDO::FETCH_ASSOC);

//        var_dump($fetched);

        if($fetched == false)
            return NULL; // todo bad login

        if(password_verify($password, $fetched["password"])){
            return new User($pseudo);
        }
        return NULL; // todo bad password
    }

}