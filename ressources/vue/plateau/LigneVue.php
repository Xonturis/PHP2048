<?php
require_once PATH_METIER . "/plateau/Ligne.php";
require_once "TuileVue.php";
require_once PATH_VUE."/IVue.php";

class LigneVue implements IVue
{
    public static function getHtml($ligne=NULL)
    {
        ?>
        <ligne>
            <?php
            foreach ($ligne as $case){
                TuileVue::getHtml($case);
            }
            ?>
        </ligne>
        <?php
    }
}