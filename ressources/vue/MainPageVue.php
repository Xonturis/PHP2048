<?php
require_once PATH_VUE . "/plateau/PlateauVue.php";
require_once PATH_VUE . "/classement/ClassementVue.php";

class MainPageVue implements IVue
{

    public static function openMainGameContainer() {
        ?>
        <div class="mainGameContainer">
        <?php
    }

    public static function closeMainGameContainer() {
        ?>
        </div>
        <?php
    }

    public static function getHtml($toDisplay = NULL)
    {
    }
}