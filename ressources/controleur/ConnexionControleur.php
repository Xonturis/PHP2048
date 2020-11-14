<?php
require_once PATH_MODELE.'/UserDAO.php';

class ConnexionControleur{

    public static function connexionAttempt(){
        $result = UserDAO::getUser($_POST["username"],$_POST["password"]);
        if($result != NULL){
            $result->setCurrentUser();
            header("location: localhost/2048/index.php");
        } else {
            //do something
        }
    }
}
