<?php
require_once PATH_VUE . "/plateau/PlateauVue.php";
require_once PATH_VUE . "/classement/ClassementVue.php";

class MainPageVue implements IVue
{
    public static function getHtml($toDisplay = NULL)
    {
        ?>
        <div class="mainGameContainer">
            <?php
                PlateauControleur::afficherPlateau();
                ClassementVue::getHtml();
            ?>
        </div>

        <?php
    }
}