<?php

require_once PATH_VUE."/MainPageVue.php";


class MainPageControleur
{
    public static function showPage(){
        MainPageVue::getHtml();
    }
}