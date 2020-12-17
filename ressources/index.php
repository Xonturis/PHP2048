<?php
require "config/config.php";
require_once PATH_METIER."/User.php";
require_once PATH_CONTROLEUR."/Routeur.php";

session_start();

Routeur::routerRequete();