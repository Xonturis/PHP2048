<?php
require_once PATH_VUE."/IVue.php";

class HeaderVue implements IVue
{
    public static function getHtml($toDisplay)
    {
        $user = $toDisplay["user"];
        ?>
        <div class="header">
            <div class="title">2048, LE JEU</div>
            <div class="user"><?=$user->getPseudo()?></div>
        </div>
        <?php
    }
}