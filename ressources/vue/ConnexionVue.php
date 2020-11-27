<?php

class ConnexionVue implements IVue
{
    public static function getHtml($toDisplay=NULL)
    {
        ?>
        <form action="" method="GET">
            <div class="container">
                <label for="uname"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="username" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>

                <input type="hidden" name="controller" value="ConnexionControleur">
                <input type="hidden" name="method" value="connexionAttempt">
                <button type="submit" class="login">Login</button>
            </div>
        </form>
        <?php
    }
}