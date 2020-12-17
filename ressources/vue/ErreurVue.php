<?php

require_once PATH_VUE . "/IVue.php";
require_once PATH_VUE . "/structure/HeaderVueConnected.php";
require_once PATH_VUE . "/structure/HeaderVue.php";

class ErreurVue implements IVue
{

    public static function getHtml($toDisplay = NULL)
    {
        if (isset($toDisplay["connected"]) && $toDisplay["connected"] == 1) {
            HeaderVueConnected::getHtml();
        } else {
            HeaderVue::getHtml();
        }

        if(isset($toDisplay["erreur"])){
            $toDisplay = $toDisplay["erreur"];
        }
        else{
            $toDisplay = "";
        }


        ?>
        <div class="erreur">
                <div class="text-center text-danger border border-danger bg-white">
                    Une erreur s'est produite : <strong><?= $toDisplay ?></strong> Si ça marche pas chez nous, vous pouvez allez voir ailleurs : <a
                                href="https://2048.loicyeu.fr">https://2048.loicyeu.fr</a></p>
                </div>
        </div>
        <?php

        FooterVue::getHtml();
    }
}