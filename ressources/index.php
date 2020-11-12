<?php
require "config/config.php";
require_once "modele/UserDAO.php";
require_once PATH_VUE."/plateau/PlateauVue.php";
require_once PATH_METIER."/Plateau.php";
require_once PATH_VUE."/controls/ControlsVue.php";
require_once PATH_VUE."/structure/HeaderVue.php";
require_once PATH_VUE."/structure/FooterVue.php";

$plateau = new Plateau();

ob_start();
$toDisplay = array();
$toDisplay["user"] = UserDAO::getUser("toto");
$toDisplay["plateau"] = $plateau;
HeaderVue::getHtml($toDisplay);
PlateauVue::getHtml($toDisplay);

$content = ob_get_clean();
require ("plateau_template.php");
ControlsVue::displayControls();
FooterVue::getHtml($toDisplay);