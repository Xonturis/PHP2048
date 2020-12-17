<?php

require_once PATH_VUE."/IVue.php";

class ErreurVue implements IVue
{

    public static function getHtml($toDisplay = NULL)
    {
        ?>
        Ah, une erreur ! :o
        <?php
    }
}