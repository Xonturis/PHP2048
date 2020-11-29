<?php
require "config/config.php";
require_once "modele/UserDAO.php";
require_once "modele/ClassementDAO.php";
require_once PATH_VUE."/plateau/PlateauVue.php";
require_once PATH_METIER . "/plateau/Plateau.php";
require_once PATH_METIER . "/classement/Classement.php";
require_once PATH_METIER . "/classement/Score.php";
require_once PATH_VUE."/controls/ControlsVue.php";
require_once PATH_VUE."/structure/HeaderVueConnected.php";
require_once PATH_VUE."/structure/HeaderVue.php";
require_once PATH_VUE."/structure/FooterVue.php";
require_once PATH_VUE."/utilisateurs/ConnexionVue.php";
require_once PATH_VUE."/utilisateurs/InscriptionVue.php";
require_once PATH_CONTROLEUR."/Routeur.php";

session_start();

Routeur::routerRequete();