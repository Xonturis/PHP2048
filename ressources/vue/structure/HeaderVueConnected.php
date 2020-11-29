<?php
require_once PATH_VUE."/IVue.php";

class HeaderVueConnected implements IVue
{
    public static function getHtml($toDisplay=NULL)
    {
        $userName = "Non Connecté";
        if(session_status() == PHP_SESSION_ACTIVE && isset($_SESSION["user"]))
            $userName = $_SESSION["user"]->getPseudo();

        ?>
        <nav class="header navbar navbar-light bg-light">
            <span class="title navbar-brand">2048, LE JEU</span>
            <div class="navItemContainer">
                <p id="userName"> test : <?php{echo $userName;}?> </p>
                <form method="get">
                    <button id="disconnectButton" type="submit" class="btn btn-warning">Déconnexion</button>
                    <input type="hidden" name="controller" value="DeconnexionControleur">
                    <input type="hidden" name="method" value="disconnectUser">
                </form>
            </div>
        </nav>
        <?php
    }
}