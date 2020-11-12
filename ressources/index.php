<?php
require "config/config.php";
require_once "modele/UserDAO.php";
require_once PATH_VUE."/plateau/PlateauVue.php";
require_once PATH_METIER."/Plateau.php";
require_once PATH_VUE."/controls/ControlsVue.php";

$plateau = new Plateau();

ob_start();
PlateauVue::getHtml($plateau);

$content = ob_get_clean();

require ("plateau_template.php");

ControlsVue::displayControls();