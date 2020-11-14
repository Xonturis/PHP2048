<?php
require_once PATH_METIER."/Tuile.php";
require_once PATH_VUE."/IVue.php";

class TuileVue implements IVue
{
    public static function getHtml($tuile=NULL)
    {
        ?>
        <tuile class="tuile-<?=$tuile->getScore()?>"><p><?=$tuile->getScore()?></p></tuile>
        <?php
    }
}