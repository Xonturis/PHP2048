<?php
require_once PATH_MODELE.'/UserDAO.php';

class ConnexionControleur{

    public static function connexionAttempt(){
        $result = UserDAO::getUser($_POST["username"],$_POST["password"]);
        if($result != NULL){
            $result->setCurrentUser();
            ob_clean();
            unset($_POST["controller"]);
            Routeur::routerRequete();
        } else {
            //do something
        }
    }
}
