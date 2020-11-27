<?php


class ControlsVue implements IVue
{

    public static function getHtml($toDisplay = NULL)
    {
        require(HOME_SITE."/controls.html");
    }
}