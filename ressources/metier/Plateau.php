<?php
require_once "Ligne.php";

class Plateau
{
    private $lignes;

    /**
     * PlateauVue constructor.
     * @param $lignes
     */
    public function __construct($lignes=array())
    {
        if(empty($lignes)) {
            array_push($lignes, new Ligne(), new Ligne(), new Ligne(), new Ligne());
        }
        $this->lignes = $lignes;
    }


    public function haut() {

    }
    public function bas() {

    }
    public function gauche() {

    }
    public function droite() {

    }
    public function reset() {

    }
    public function getScore() {

    }
    public function getMaxTuile() {

    }

    /**
     * @return array|mixed
     */
    public function getLignes()
    {
        return $this->lignes;
    }
}