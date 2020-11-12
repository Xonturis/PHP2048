<?php
require_once PATH_METIER."/Tuile.php";
require_once "IDisplayable.php";

class TuileVue implements IDisplayable
{
    public static function getHtml($tuile)
    {
        ?>
        <tuile class="tuile-<?=$tuile->getScore()?>"><p><?=$tuile->getScore()?></p></tuile>
        <?php
    }
}