<?php


class ClassementVue implements IVue
{
    public static function getHtml($toDisplay = NULL)
    {
        $toDisplay = $toDisplay->getTab();
        ?>
        <div class="tableContainer">
            <table class="table">
                <caption>Classement des parties</caption>
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Score</th>
                </tr>
                </thead>
                <tbody>
                <?php
                for ($i = 0; $i < 100; $i++) {
                    ?>
                    <tr>
                        <th scope="row"><?php echo $i+1 ?></th>
                        <?php

                        if (isset($toDisplay[$i])) {
                            ?>
                            <td class="score"><?php echo $toDisplay[$i]->getName() ?></td>
                            <td class="score"><?php echo $toDisplay[$i]->getScore() ?></td>
                            <?php
                        } else {
                            ?>
                            <td class="score">???</td>
                            <td class="score">???</td>
                            <?php
                        }
                        ?>

                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
        <?php
    }
}