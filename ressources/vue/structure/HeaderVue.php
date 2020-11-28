<?php
require_once PATH_VUE."/IVue.php";


class HeaderVue implements IVue
{

    public static function getHtml($toDisplay = NULL)
    {
        ?>
        <nav class="header navbar navbar-light bg-light">
            <span class="title navbar-brand">2048, LE JEU</span>
            <div class="navItemContainer">
                <form method="GET">
                    <button id="connectButton" type="submit" class="btn btn-warning">Se connecter</button>
                    <input type="hidden" name="controller" value="ConnexionControleur">
                    <input type="hidden" name="method" value="connexionAttempt">
                </form>
                <form method="GET">
                    <button id="signUpButton" type="submit" class="btn btn-warning">S'inscrire</button>
                    <input type="hidden" name="controller" value="InscriptionControleur">
                    <input type="hidden" name="method" value="showSignUpPage">
                </form>
            </div>
        </nav>
        <?php
    }
}