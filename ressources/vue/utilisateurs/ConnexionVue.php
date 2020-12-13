<?php
require_once PATH_VUE.'/IVue.php';
require_once PATH_VUE.'/structure/FooterVue.php';
require_once PATH_VUE.'/structure/HeaderVue.php';

class ConnexionVue implements IVue
{
    public static function getHtml($toDisplay = NULL)
    {
        HeaderVue::getHtml();
        ?>
        <form method="GET" class="connexionForm">
            <div class="container">
                <h3 id="title">Se connecter</h3>
                <div class="form-group">
                    <label for="exampleInputEmail1">Pseudo</label>
                    <input class="form-control" name="username">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Mot de passe</label>
                    <input class="form-control" type="password" name="password">
                </div>
                <input type="hidden" name="controller" value="ConnexionControleur">
                <input type="hidden" name="method" value="connexionAttempt">
                <button type="submit" class="btn btn-warning">Se connecter</button>
            </div>
        </form>
        <?php
        FooterVue::getHtml();
    }
}