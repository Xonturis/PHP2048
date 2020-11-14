<?php
require_once PATH_MODELE.'/UserDAO.php';

class ConnexionControleur{

    public static function connexionAttempt(){
        $result = UserDAO::getUser($_POST["username"],$_POST["password"]);
        if($result != NULL){
            $result->setCurrentUser();
        } else {
            //do something
        }
    }
}
