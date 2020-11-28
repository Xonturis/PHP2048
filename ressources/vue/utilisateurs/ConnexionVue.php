<?php

class ConnexionVue implements IVue
{
    public static function getHtml($toDisplay = NULL)
    {
        ?>
        <form action="" method="GET" class="connexionForm">
            <div class="container">
                <p id="title">Connexion</p>
                <input type="text" placeholder="Enter Username" name="username" required>
                <input type="password" placeholder="Enter Password" name="password" required>
                <input type="hidden" name="controller" value="ConnexionControleur">
                <input type="hidden" name="method" value="connexionAttempt">
                <button type="submit" class="login">Login</button>
            </div>
        </form>
        <?php
    }
}