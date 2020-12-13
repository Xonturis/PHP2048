<?php
require_once PATH_METIER . "/plateau/Plateau.php";
require_once "LigneVue.php";
require_once PATH_VUE . "/IVue.php";
require_once PATH_VUE.'/controls/ControlsVue.php';

class PlateauVue implements IVue
{
    public static function getHtml($toDisplay = NULL)
    {
        ?>
        <div class="Game">
            <plateau>
                <?php
                foreach ($toDisplay as $ligne) {
                    LigneVue::getHtml($ligne);
                }
                ?>
            </plateau>
            <?php
            ControlsVue::getHtml();
            ?>
        </div>
        <?php
    }
}