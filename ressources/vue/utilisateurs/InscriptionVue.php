<?php


class InscriptionVue implements IVue
{

    public static function getHtml($toDisplay = NULL)
    {
        ?>
        <form method="GET" class="connexionForm">
            <div class="container">
                <h3 id="title">S'inscrire</h3>
                <div class="form-group">
                    <label for="exampleInputEmail1">Pseudo</label>
                    <input class="form-control" name="username">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Mot de passe</label>
                    <input class="form-control" type="password" name="password">
                </div>
                <input type="hidden" name="controller" value="InscriptionControleur">
                <input type="hidden" name="method" value="registerUser">
                <button type="submit" class="btn btn-warning">Créer un compte</button>
            </div>
        </form>
        <?php
    }
}