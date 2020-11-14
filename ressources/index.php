<?php
require "config/config.php";
require_once "modele/UserDAO.php";
require_once PATH_VUE."/plateau/PlateauVue.php";
require_once PATH_METIER."/Plateau.php";
require_once PATH_VUE."/controls/ControlsVue.php";
require_once PATH_VUE."/structure/HeaderVue.php";
require_once PATH_VUE."/structure/FooterVue.php";
require_once PATH_VUE."/ConnexionVue.php";
require_once PATH_CONTROLEUR."/Routeur.php";

session_start();

Routeur::routerRequete();