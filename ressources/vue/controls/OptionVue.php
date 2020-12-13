<?php


class OptionVue implements IVue
{

    public static function getHtml($canRewind = NULL)
    {
        ?>
        <div class="optionContainer">
            <form class="control-reset btn btn-warning" action="" method="GET">
                <input type="hidden" name="controller" value="PlateauControleur">
                <input type="hidden" name="method" value="reset">
                <input type="submit" value="🗑" class="btn btn-warning"/>
            </form>
            <?php if($canRewind){?>
                <form class="control-reset btn btn-warning" action="" method="GET">
                    <input type="hidden" name="controller" value="PlateauControleur">
                    <input type="hidden" name="method" value="rewind">
                    <input type="submit" value="↻" class="btn btn-warning"/>
                </form>
            <?php }?>
        </div>
        <?php
    }
}