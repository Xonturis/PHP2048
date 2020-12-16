<?php
require_once PATH_VUE.'/IVue.php';

class FooterVue implements IVue
{

    public static function getHtml($toDisplay=NULL)
    {
        ?>

        <nav class="footer navbar navbar-light bg-light">
            <div class="footerItemContainer">
                <div class="footer-right">Made with ❤️, pour être original</div>
                <div class="author">Lylian Siffre, Beaujoin Milo, Lucas Gazeau</div>
            </div>

        </nav>
        <?php
    }
}