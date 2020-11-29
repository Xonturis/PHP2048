<?php


class ClassementVue implements IVue
{
    public static function getHtml($toDisplay = NULL)
    {
        $toDisplay = $toDisplay->getTab();
        ?>
        <div class="tableContainer">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Score</th>
                </tr>
                </thead>
                <tbody>
                <?php
                for ($i = 0; $i < 20; $i++) {
                    ?>
                    <tr>
                        <th scope="row"><?php echo $i+1 ?></th>
                        <?php

                        if (isset($toDisplay[$i])) {
                            ?>
                            <td><?php echo $toDisplay[$i]->getName() ?></td>
                            <td><?php echo $toDisplay[$i]->getScore() ?></td>
                            <?php
                        } else {
                            ?>
                            <td>???</td>
                            <td>???</td>
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