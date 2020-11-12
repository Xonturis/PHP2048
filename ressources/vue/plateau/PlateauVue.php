<?php
require_once PATH_METIER."/Plateau.php";
require_once "LigneVue.php";
require_once PATH_VUE."/IVue.php";

class PlateauVue implements IVue
{
    public static function getHtml($toDisplay)
    {
        $plateau = $toDisplay["plateau"];
        ?>
        <plateau>
            <?php
            foreach ($plateau->getLignes() as $ligne){
                LigneVue::getHtml($ligne);
            }
            ?>
        </plateau>
        <?php
    }
}