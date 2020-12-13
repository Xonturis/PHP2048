<?php


class OptionVue implements IVue
{

    public static function getHtml($toDisplay = NULL)
    {
        ?>
        <div class="optionContainer">
            <form class="control-reset btn btn-warning" action="" method="GET">
                <input type="hidden" name="controller" value="PlateauControleur">
                <input type="hidden" name="method" value="reset">
                <input type="submit" value="↻" class="btn btn-warning"/>
            </form>

            <form class="control-reset btn btn-warning" action="" method="GET">
                <input type="hidden" name="controller" value="PlateauControleur">
                <input type="hidden" name="method" value="beforeAction">
                <input type="submit" value="♲" class="btn btn-warning"/>
            </form>
        </div>
        <?php
    }
}