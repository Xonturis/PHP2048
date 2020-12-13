<?php
require_once PATH_VUE."/IVue.php";

class DefaiteVue implements IVue
{

    public static function getHtml($toDisplay = NULL)
    {
        $score = $toDisplay["score"];
        $maxTuile = $toDisplay["maxTuile"];
        include PATH_VUE."/templates/defaite_template.php";
    }
}