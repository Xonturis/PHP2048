<?php
require_once "SqliteConnexion.php";
require_once PATH_METIER."/User.php";

class UserDAO
{
    /**
     * Permets d'obtenir l'utilisateur en testant la connexion
     * @param $pseudo String le pseudo de l'utilisateur
     * @param $password String Le mot de passe
     * @return User|null L'utilisateur
     */
    public static function getUser($pseudo,$password) : ?User{
        $statement = SqliteConnexion::getInstance()->getConnexion()->prepare('SELECT password FROM JOUEURS where pseudo = :pseudo;');
        $statement->bindParam(':pseudo', $pseudo);
        $statement->execute();
        $fetched=$statement->fetch(PDO::FETCH_ASSOC);

        if(!$fetched) {
            return NULL; // todo bad login
        }

        if(password_verify($password, $fetched["password"])){
            return new User($pseudo);
        }
        return NULL; // todo bad password
    }

    /**
     * Ajoute l'utilisateur à la bdd
     * @param $pseudo String Le pseudo du joueur
     * @param $password String le mot de passe du joueur
     * @return bool|null Si l'ajout est fait ou non
     */
    public static function addUser($pseudo,$password) : ?bool{
        $statement = SqliteConnexion::getInstance()->getConnexion()->prepare('INSERT INTO JOUEURS values (:pseudo,:password);');
        $statement->bindParam(':pseudo', $pseudo);
        $hashPassword = password_hash($password,PASSWORD_DEFAULT);
        $statement->bindParam(':password', $hashPassword);
        try {
            $statement->execute();
        }catch (PDOException $e){
            return false;
        }
        return true;
        
    }

}