<?php


class InscriptionVue implements IVue
{

    public static function getHtml($toDisplay = NULL)
    {
        ?>
        <form action="" method="GET" class="connexionForm">
            <div class="container">
                <p id="title">Inscription</p>
                <input type="text" placeholder="Enter Username" name="username" required>
                <input type="password" placeholder="Enter Password" name="password" required>
                <input type="hidden" name="controller" value="InscriptionControleur">
                <input type="hidden" name="method" value="registerUser">
                <button type="submit" class="createAccount">Create Account</button>
            </div>
        </form>
        <?php
    }
}