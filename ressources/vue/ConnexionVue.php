<?php

class ConnexionVue
{
    public static function getHtml($toDisplay)
    {
        ?>
        <form action="" method="post">
            <div class="container">
                <label for="uname"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="username" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>

                <button type="submit" class="login">Login</button>
            </div>
        </form>
        <?php
    }
}