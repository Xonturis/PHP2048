<?php

require_once PATH_VUE . "/IVue.php";
require_once PATH_VUE . "/structure/HeaderVueConnected.php";
require_once PATH_VUE . "/structure/HeaderVue.php";
require_once PATH_VUE . "/structure/FooterVue.php";

class ErreurVue implements IVue
{

    public static function getHtml($toDisplay = NULL)
    {
        if ($toDisplay["connecte"]) {
            HeaderVueConnected::getHtml($toDisplay["pseudo"]);
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
                    <p>Une erreur s'est produite : <strong><?= $toDisplay ?></strong> <br>
                        Si ça marche pas chez nous, vous pouvez aller voir ailleurs : <a
                                href="https://2048.loicyeu.fr">https://2048.loicyeu.fr</a></p>
                    <form method="GET">
                        <button id="signUpButton" type="submit" class="btn btn-warning">Revenir en arrière</button>
                        <input type="hidden" name="controller" value="MainPageControleur">
                        <input type="hidden" name="method" value="showPage">
                    </form>
                </div>
        </div>
        <?php

        FooterVue::getHtml();
    }
}