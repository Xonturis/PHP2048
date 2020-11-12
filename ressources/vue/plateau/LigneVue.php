<?php
require_once PATH_METIER."/Ligne.php";
require_once "TuileVue.php";
require_once "IDisplayable.php";

class LigneVue implements IDisplayable
{
    public static function getHtml($ligne)
    {
        ?>
        <ligne>
            <?php
            foreach ($ligne->getCases() as $case){
                TuileVue::getHtml($case);
            }
            ?>
        </ligne>
        <?php
    }
}