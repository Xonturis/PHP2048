<?php
require_once PATH_VUE . "/plateau/PlateauVue.php";
require_once PATH_VUE . "/classement/ClassementVue.php";
require_once PATH_VUE.'/structure/FooterVue.php';
require_once PATH_VUE.'/structure/HeaderVueConnected.php';
require_once PATH_VUE.'/IVue.php';

class MainPageVue implements IVue
{

    public static function openMainGameContainer() {
        HeaderVueConnected::getHtml($_SESSION["user"]);
        ?>
        <div class="mainGameContainer">
        <?php
    }

    public static function closeMainGameContainer() {
        ?>
        </div>
        <?php
        FooterVue::getHtml();
    }

    public static function openGameContainer() {
        ?>
        <div class="gameContainer">
        <?php
    }

    public static function closeGameContainer() {
        ?>
        </div>
        <?php
    }

    public static function getHtml($toDisplay = NULL)
    {
    }
}