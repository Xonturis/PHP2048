<?php
require_once PATH_VUE."/IVue.php";

class HeaderVue implements IVue
{
    public static function getHtml($toDisplay=NULL)
    {
        $userName = "Non Connecté";
        if(session_status() == PHP_SESSION_ACTIVE && isset($_SESSION["user"]))
            $userName = $_SESSION["user"]->getPseudo();

        ?>
        <nav class="header navbar navbar-light bg-light">
            <span class="title navbar-brand">2048, LE JEU</span>
            <div>
                <p>user</p>
                <a>disconnect</a>
            </div>

        </nav>
        <?php
    }
}