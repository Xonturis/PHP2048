<?php

require_once PATH_VUE.'/structure/FooterVue.php';
require_once PATH_VUE.'/structure/HeaderVue.php';

class InscriptionVue implements IVue
{

    public static function getHtml($toDisplay = NULL)
    {
        HeaderVue::getHtml();
        ?>
        <form method="GET" class="connexionForm">
            <div class="container">
                <div class="text-center text-danger border border-danger">
                    <?php  if(isset($_GET["error"]) && $_GET["error"]){
                        echo "L'utilisateur existe déjà !";
                    }?>
                </div>
                <h3 id="title">S'inscrire</h3>
                <div class="form-group">
                    <label for="exampleInputEmail1">Pseudo</label>
                    <input class="form-control" name="username">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Mot de passe</label>
                    <input class="form-control" type="password" name="password">
                </div>
                <input type="hidden" name="controller" value="InscriptionControleur">
                <input type="hidden" name="method" value="registerUser">
                <button type="submit" class="btn btn-warning">Créer un compte</button>
            </div>
        </form>
        <?php
        FooterVue::getHtml();
    }
}