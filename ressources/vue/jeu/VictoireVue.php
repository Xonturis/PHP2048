<?php
require_once PATH_VUE."/IVue.php";


class VictoireVue implements IVue
{

    public static function getHtml($toDisplay = NULL)
    {
        echo "GAGNÉ";
    }
}