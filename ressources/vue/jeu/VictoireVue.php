<?php
require_once PATH_VUE."/IVue.php";


class VictoireVue implements IVue
{

    public static function getHtml($toDisplay = NULL)
    {
        $score = $toDisplay["score"];
        $maxTuile = $toDisplay["maxTuile"];
        include PATH_VUE."/templates/victoire_template.php";
    }
}