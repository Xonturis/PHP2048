<?php

require_once PATH_VUE . "/IVue.php";

class ErreurVue implements IVue
{

    public static function getHtml($toDisplay = NULL)
    {
        if (isset($_GET["user"])) {
            HeaderVueConnected::getHtml();
        } else {
            HeaderVue::getHtml();
        }


        ?>
        <div class="erreur">
            <?php if ($toDisplay == NULL) { ?>
                <div class="text-center text-danger border border-danger bg-white">
                    <p>Une erreur s'est produite ! Si ça marche pas chez nous, vous pouvez allez voir ailleurs : <a href="https://2048.loicyeu.fr">https://2048.loicyeu.fr</a></p>
                </div>
            <?php }
            else { ?>
                <div class="text-center text-danger border border-danger">
                    <p>Une erreur s'est produite ! <?php $toDisplay ?> </p>
                </div>
            <?php } ?>
        </div>
        <?php

        FooterVue::getHtml();
    }
}