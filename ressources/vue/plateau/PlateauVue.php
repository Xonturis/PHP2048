<?php
require_once PATH_METIER."/Plateau.php";
require_once "LigneVue.php";
require_once "IDisplayable.php";

class PlateauVue implements IDisplayable
{
    public static function getHtml($plateau)
    {
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