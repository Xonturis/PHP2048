<?php


class FooterVue implements IVue
{

    public static function getHtml($toDisplay=NULL)
    {
        ?>
        <div class="footer">
            <div class="title">2048, LE JEU</div>
            <div class="footer-right">Made with <3, pour être original</div>
        </div>
        <?php
    }
}