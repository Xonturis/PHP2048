<?php
require_once PATH_METIER . "/plateau/Tuile.php";
require_once PATH_VUE."/IVue.php";

class TuileVue implements IVue
{
    public static function getHtml($tuile=NULL)
    {
        ?>
        <tuile class="tuile-<?=$tuile?>"><p><?=$tuile?></p></tuile>
        <?php
    }
}