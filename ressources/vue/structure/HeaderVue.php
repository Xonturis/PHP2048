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
        <div class="header">
            <div class="title">2048, LE JEU</div>
            <div class="user"><?=$userName?></div>
        </div>
        <?php
    }
}